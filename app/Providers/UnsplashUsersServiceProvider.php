<?php

namespace App\Providers;

use App\Utilities\UnsplashUsers;
use Illuminate\Support\ServiceProvider;

class UnsplashUsersServiceProvider extends ServiceProvider
{
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('UnsplashUsers', function () {
            return new UnsplashUsers();
        });
    }
}
