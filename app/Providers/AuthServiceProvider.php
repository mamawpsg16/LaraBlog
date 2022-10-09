<?php

namespace App\Providers;
use App\Models\Post;

// use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Policies\PostPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Post::class => PostPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Gate::define('is_admin',function(User $user){
        //     return $user->role_id ! 2 ;
        // });
        Gate::define('admin', function (User $user) {
            return in_array(User::IS_ADMIN,$user->roles->pluck('id')->toArray());
        });
    }
}
