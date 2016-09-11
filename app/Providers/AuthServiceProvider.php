<?php

namespace App\Providers;

use App\Models\Article;
use App\Models\Profile;
use App\Policies\ArticlePolicy;
use App\Policies\ProfilePolicy;
use App\Policies\UserCenterPolicy;
use App\User;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Article::class => ArticlePolicy::class,
        User::class => UserCenterPolicy::class,
        Profile::class => ProfilePolicy::class
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        if(\Schema::hasTable('permissions'))
        {
            $permissions = Permission::with('roles')->get();
            foreach ($permissions as $permission) {
                $gate->define($permission->slug, function($user) use ($permission) {
                    return $user->hasPermission($permission);
                });
            }
        }
    }
}
