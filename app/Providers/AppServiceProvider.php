<?php

namespace App\Providers;

use App\UserRole;
use Auth;
use Blade;
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
        Blade::if('role', function (string $role) {
            return Auth::check() && Auth::user()->hasRole($role);
        });
    }
}
