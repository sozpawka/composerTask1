<?php

namespace Middlewares;

use Src\Auth\Auth;
use Src\Request;

class AuthMiddleware
{
    public function handle(Request $request, $role = null)
    {
        if (!Auth::check()) {
            app()->route->redirect('/login');
            exit;
        }
        if ($role && Auth::user()->role !== $role) {
            echo 'Нет доступа';
            exit;
        }
    }
}