<?php

namespace Controller;

use Src\View;

class Site
{
    public function index(): string
    {
        $user = $_SESSION['user'] ?? null;
        return (string) new \Src\View('site.index', [
            'user' => $user
        ]);
    }
}