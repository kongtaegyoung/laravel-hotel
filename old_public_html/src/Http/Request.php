<?php
namespace Eclair\Http;

class Request
{
    public static function getMethod()
    {
        // return filter_input();
        return filter_input(INPUT_POST, '_method') ?: $_SERVER['REQUEST_METHOD'];
    }

    public static function getPath()
    {
        if (isset($_SERVER['REQUEST_URI'])) {
            $pathInfo = $_SERVER['REQUEST_URI'];
        } else {
            $pathInfo = '/';
        }


        return $pathInfo ?? '/';
    }
}