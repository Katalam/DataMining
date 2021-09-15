<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class UnsplashPhotosFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'UnsplashPhotos';
    }
}
