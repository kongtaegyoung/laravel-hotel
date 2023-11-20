<?php

namespace  App\Controllers;

use Eclair\Support\Theme;
use App\Services\IndexService;

class IndexController
{
    public static function index()
    {
        $page = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT) ?: 0;
        //include_once dirname(__DIR__,2) . '/resources/index.php';
        
        return Theme::view('index', [
            'posts' => IndexService::getPosts($page, 3)
        ]);
    }
}