<?php

namespace App\Middlewares;

class CsrfTokenMiddleware extends \Eclair\Routing\Middleware
{
    /**
     * Csrf Token verify
     */
    public static function process()
    {
        //$csrfToken = filter_input(INPUT_POST, '_csrfToken', FILTER_SANITIZE_STRING) ?: json_decode(file_get_contents('php://input'))->_csrfToken;
        $csrfToken = htmlspecialchars($_POST['_csrfToken'] ?? json_decode(file_get_contents('php://input'))->csrfToken, ENT_QUOTES, 'UTF-8');



        if (hash_equals($csrfToken, $_SESSION['CSRF_TOKEN'])) {
            return true;
        }

        return header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}



