<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Requests\ProfileRequest;
use App\Models\Profile;
use App\Services\ProfileService;
use Auth;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProfilesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        view()->share('currentUser', Auth::user());
    }


    /**
     * Show the form for creating a new profile.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('public.userCenters.profiles.create');
    }

    /**
     * Store a newly created profile in storage.
     *
     * @param ProfileRequest $request
     * @param ProfileService $profileService
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ProfileRequest $request, ProfileService $profileService)
    {
        $profile = $profileService->createProfile($request);

        return redirect()->route('public.userCenters.show',['users' => $profile->user_id]);
    }


    /**
     * Show the form for editing the specified profile.
     *
     * @param Profile $profile
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Profile $profile)
    {
        $this->authorize('edit',$profile);

        $user = $profile->user;

        return view('public.userCenters.profiles.edit',compact('profile','user'));
    }

    /**
     * Update the specified profile in storage.
     *
     * @param Profile $profile
     * @param ProfileRequest $request
     * @param ProfileService $profileService
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Profile $profile, ProfileRequest $request, ProfileService $profileService)
    {
        $this->authorize('update',$profile);

        $profileService->updateProfile($profile, $request);

        return redirect()->route('public.userCenters.show',['users' => $profile->user_id]);
    }
}
