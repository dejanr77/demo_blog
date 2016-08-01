<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserCenterPolicy
{
    use HandlesAuthorization;

    public function self(User $user, User $u)
    {
        return $user->id === $u->id;
    }

}