<?php

namespace App\Models\Acl;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    /**
     * The roles that belong to permission.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany('App\Models\Acl\Role');
    }
}
