<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class UnsplashCollectionsFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'UnsplashCollections';
    }
}
