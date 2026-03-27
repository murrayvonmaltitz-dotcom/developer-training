<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //if no user default returns false if user is not optional (?User)
        Gate::define('view-admin', function (User $user) {
            return $user->isAdmin() ? Response::allow() : Response::denyWithStatus(404);
        });
    }
}
