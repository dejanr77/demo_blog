<?php
namespace App\Policies;


use App\Models\Profile;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProfilePolicy 
{
    use HandlesAuthorization;
    
    public function edit(User $user, Profile $profile)
    {
        return $user->own($profile);
    }

    public function update(User $user, Profile $profile)
    {
        return $user->own($profile);
    }

}