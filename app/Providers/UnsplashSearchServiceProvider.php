<?php

namespace App\Providers;

use App\Utilities\UnsplashSearch;
use Illuminate\Support\ServiceProvider;

class UnsplashSearchServiceProvider extends ServiceProvider
{
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('UnsplashSearch', function () {
            return new UnsplashSearch();
        });
    }
}
