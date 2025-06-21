<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Admin;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
       {
    $this->registerPolicies();

    Role::all()->each(function ($role) {
         // تتبع تعريف الـ Gate

        Gate::define($role->slug, function ($admin) use ($role) {

            return $admin->roles->pluck('slug')->contains($role->slug);
        });
    });
}
    }
}
