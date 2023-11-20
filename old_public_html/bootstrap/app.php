<?php

use Eclair\Application;

$app = new Application([
    \App\Providers\ErrorServiceProvider::Class,
    \App\Providers\DatabaseServiceProvider::Class,
    \App\Providers\SessionServiceProvider::Class,
    \App\Providers\ThemeServiceProvider::Class,
    \App\Providers\RouteServiceProvider::Class
]);

return $app;