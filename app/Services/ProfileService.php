<?php

namespace App\Services;


use App\Http\Requests\ProfileRequest;
use App\Repositories\Profiles\ProfileRepositoryInterface;

class ProfileService
{
    /**
     * @var ProfileRepositoryInterface
     */
    private $profileRepository;
    /**
     * @var UserActivityService
     */
    private $userActivity;

    /**
     * Create a new controller instance.
     *
     * @param ProfileRepositoryInterface $profileRepository
     * @param UserActivityService $userActivity
     */
    public function __construct(ProfileRepositoryInterface $profileRepository,UserActivityService $userActivity)
    {
        $this->profileRepository = $profileRepository;
        $this->userActivity = $userActivity;
    }


    /**
     * Save a new profile.
     *
     * @param ProfileRequest $request
     * @return mixed
     */
    public function createProfile(ProfileRequest $request)
    {
        $profile = $this->profileRepository->createByUser('profile',$request->all());

        $this->userActivity->log($request, $profile, 'Your profile was created');

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
    public function updateProfile($profile, ProfileRequest $request)
    {
        $profile = $this->profileRepository->update($request->all(),$profile);

        $this->userActivity->log($request, $profile, 'Your profile was updated');

        flash()->overlay('Profile has been successfully updated.', 'Profile updating');

        return $profile;
    }
}