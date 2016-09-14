<?php

namespace App\Http\Controllers\Backend;

use App\Models\Acl\Permission;
use App\Models\Acl\Role;
use App\User;
use Auth;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{

    /**
     * Create a new authentication controller instance.
     */
    public function __construct()
    {
        $this->middleware('acl:user.menage', ['except' => ['show']]);

        view()->share('currentUser', Auth::user());

        view()->share('notifications_count',Auth::user()->notifyTo()->where('new','=',1)->count());
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $role_list = Role::where('name','!=','admin')->pluck('name', 'name');

        $dir = $request->input('dir') ? $request->input('dir') : 'dsc';

        $search = $request->input('search') ? $request->input('search') : '';

        $selected_role = 'subscriber';

        if($role_name = $request->input('role'))
        {
            $selected_role = $role_name;

            $role = Role::where('name','=',$role_name)->first();

            $users = $role->users()
                ->where('name','like','%'.$search.'%')
                ->orderBy('created_at',$dir)
                ->paginate(8);

            return view('admin.users.index',compact('users','role_list','dir','search','role_name','selected_role'));
        }

        $role_name = 'subscriber';

        $users = User::with('roles')
            ->where('id','!=',1)
            ->where('name','like','%'.$search.'%')
            ->orderBy('created_at',$dir)
            ->paginate(8);

        return view('admin.users.index',compact('users','role_list','dir','search','role_name','selected_role'));
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::with('profile')->findOrFail($id);

        $role_list = Role::where('name','!=','admin')->pluck('name', 'id');

        $articles = $user->articles;

        return view('admin.users.show',compact('user','role_list','articles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {

        $user->assignRole($request->input('role_id'));

        $user->update([
            'author_request' => 0
        ]);

        if ($request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => 'User "'.$user->name.'" has been successfully changed his role.'
            ],200);
        }
        flash()->overlay('User "'.$user->name.'" has been successfully changed his role.', 'User');

        return redirect()->back();
    }

    /**
     * Display all roles.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function roles()
    {
        $roles = Role::with('permissions')->orderBy('created_at', 'dsc')->paginate(8);

        return view('admin.users.roles', compact('roles'));
    }

    /**
     * Edit the specified role.
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editRole($id)
    {
        $role = Role::with('permissions')->findOrFail($id);

        $permissions = Permission::get(['id', 'name']);

        return view('admin.users.editRole', compact('role', 'permissions'));
    }

    /**
     * Update the specified role in storage.
     *
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateRole($id, Request $request)
    {
        $role = Role::findOrFail($id);

        $permission_ids = $request->input('permission_ids') ? $request->input('permission_ids') : [];

        $role->permissions()->sync($permission_ids);

        $role->update(['description' => $request->input('description')]);

        flash()->overlay('Role "'.$role->name.'" has been successfully updated.', 'Role');

        return redirect()->route('admin.user.roles');
    }
}
