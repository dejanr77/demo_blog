<?php

namespace App;

use App\Models\Acl\Permission;
use App\Models\Acl\Role;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laracasts\Presenter\PresentableTrait;

class User extends Authenticatable
{
    use PresentableTrait;

    protected $presenter = 'App\Presenters\UserPresenter';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get articles for user
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function articles()
    {
        return $this->hasMany('App\Models\Article');
    }

    /**
     * Get likes for user
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function likes()
    {
        return $this->hasMany('App\Models\Like');
    }

    /**
     * Get dislikes for user
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function dislikes()
    {
        return $this->hasMany('App\Models\Dislike');
    }


    /**
     * Get tags for user
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tags()
    {
        return $this->hasMany('App\Models\Tag');
    }

    /**
     * Get comments for user
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    /**
     * Get the activities for user
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function activities()
    {
        return $this->hasMany('App\Models\UserActivity');
    }

    /**
     * Get the profile associated with the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function profile()
    {
        return $this->hasOne('App\Models\Profile');
    }

    /**
     * Check, is it owner.
     *
     * @param $releted
     * @return bool
     */
    public function own($releted)
    {
        return $this->id === $releted->user_id;
    }

    /**
     * Get all roles for the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany('App\Models\Acl\Role');
    }

    /**
     * Checks does the user have role.
     *
     * @param $role
     * @return bool
     */
    public function hasRole($role)
    {
        if (is_null($role)) {
            return false;
        }
        if (is_string($role)) {
            return $this->roles->contains('slug', $role);
        }
        return !! $role->intersect($this->roles)->count();
    }

    /**
     * @param null $permission
     * @return bool
     */
    public function userCan($permission = null)
    {
        return !is_null($permission) && $this->hasPermission($permission);
    }

    /**
     * Checks does the user have permission.
     *
     * @param $permission
     * @return bool
     */
    public function hasPermission($permission)
    {
        if (is_null($permission)) {
            return false;
        }
        if (is_string($permission)) {
            $permission = Permission::whereSlug($permission)->firstOrFail();
        }
        return $this->hasRole($permission->roles);
    }

    /**
     * Assigns a new role.
     *
     * @param $role_id
     * @return array
     */
    public function assignRole($role_id)
    {
        return $this->roles()->sync([$role_id]);
    }

    /**
     * Checks is the user admin.
     *
     * @return bool
     */
    public function isAdmin()
    {
        return $this->hasRole('admin');
    }
}
