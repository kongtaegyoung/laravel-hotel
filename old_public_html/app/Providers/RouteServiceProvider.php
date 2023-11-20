<?php

namespace App\Providers;

use Eclair\Support\ServiceProvider;
use Eclair\Routing\Route;

class RouteServiceProvider extends ServiceProvider
{
    public static function register()
    {
        //require_once dirname(__DIR__,2) . '/routes/web.php';
        foreach ([ 'web', 'api' ] as $name) {
            require_once dirname(__DIR__, 2) . "/routes/{$name}.php";
        }
    }

    public static function boot()
    {
        Route::run();
    }
}