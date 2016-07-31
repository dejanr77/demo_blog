<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Requests\ProfileRequest;
use App\Models\Profile;
use App\Repositories\Profiles\ProfileRepositoryInterface;
use Auth;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProfilesController extends Controller
{
    /**
     * @var ProfileRepositoryInterface
     */
    private $profileRepository;

    /**
     * Create a new controller instance.
     *
     * @param ProfileRepositoryInterface $profileRepository
     */
    public function __construct(ProfileRepositoryInterface $profileRepository)
    {
        $this->profileRepository = $profileRepository;

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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ProfileRequest $request)
    {
        $profile = $this->createProfile($request);

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

        return view('public.userCenters.profiles.edit',compact('profile'));
    }

    /**
     * Update the specified profile in storage.
     *
     * @param Profile $profile
     * @param ProfileRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Profile $profile, ProfileRequest $request)
    {
        $this->authorize('update',$profile);

        $this->updateProfile($profile, $request);

        return redirect()->route('public.userCenters.show',['users' => $profile->user_id]);
    }

    /**
     * Log User activity.
     *
     * @param ProfileRequest $request
     * @param Profile $profile
     * @param $content
     */
    private function logActivity(ProfileRequest $request,Profile $profile, $content)
    {
        $request->user()->activities()->create([
            'ip_address' => $request->ip(),
            'type' => class_basename($profile),
            'type_id' => $profile->id,
            'content' => $content
        ]);
    }

    /**
     * Save a new profile.
     *
     * @param ProfileRequest $request
     * @return mixed
     */
    private function createProfile(ProfileRequest $request)
    {
        $profile = $this->profileRepository->createByUser('profile',$request->all());

        $this->logActivity($request, $profile, 'Your profile was created');

        flash()->overlay('Profile has been successfully created.', 'Profile creating');

        return $profile;
    }

    /**
     * Update a profile.
     *
     * @param $profile
     * @param ProfileRequest $request
     * @return mixed
     */
    private function updateProfile($profile, ProfileRequest $request)
    {
        $profile = $this->profileRepository->update($request->all(),$profile);

        $this->logActivity($request, $profile, 'Your profile was updated');

        flash()->overlay('Profile has been successfully updated.', 'Profile updating');

        return $profile;
    }
}
