<?php

namespace App\Http\Controllers\Backend;

use App\Models\Notify;
use App\User;
use Auth;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class NotificationsController extends Controller
{

    /**
     * Create a new authentication controller instance.
     */
    public function __construct()
    {
        view()->share('currentUser', Auth::user());

        view()->share('notifications_count',Auth::user()->notifyTo()->where('new','=',1)->count());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notifications = Notify::where('to','=',1)->latest()->paginate(8);

        return view('admin.notifications.index', compact('notifications'));
    }

    /**
     * Display the specified resource.
     *
     * @param Notify $notification
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Notify $notification)
    {
        $notification->update(['new' => 0]);

        return view('admin.notifications.show',compact('notification','show'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user_id = $request->input('user_id') ? $request->input('user_id') : '';

        return view('admin.notifications.create',compact('user_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $to = $request->input('user_id') ? $request->input('user_id') : User::all(['id'])->toArray();

        Notify::notify(1, $to , $request->user(), '<i class="fa fa-lock" aria-hidden="true"></i> '. $request->input('body'));

        flash()->overlay('You has successfully notified user', 'Notification');

        return redirect()->route('admin.notification.index');
    }
}
