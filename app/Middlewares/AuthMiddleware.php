<?php

namespace Middlewares;

use Src\Auth\Auth;
use Src\Request;

class AuthMiddleware
{
    public function handle(Request $request)
    {
        $uri = $_SERVER['REQUEST_URI'];

        if ($uri === '/pop-it-mvc/login' || $uri === '/login') {
            return;
        }

        if (!Auth::check()) {
            app()->route->redirect('/login');
            exit;
        }
    }
}