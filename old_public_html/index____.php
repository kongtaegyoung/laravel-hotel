<?php

require_once './vendor/autoload.php';

use Eclair\Support\ServiceProvider;
use Eclair\Application;

class SessionServiceProvider extends ServiceProvider
{
    public function register()
    {
        // session_set_save_handler
    }

    public function boot()
    {
        session_start();
    }
}

$app = new Application([
    SessionServiceProvider::class
]);

$app->boot();
