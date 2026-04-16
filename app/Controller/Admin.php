<?php

namespace Controller;

use Src\View;

class Admin
{
    public function index(): string
    {
        $user = $_SESSION['user'] ?? null;
        if (!$user) {
            header('Location: /pop-it-mvc/login');
            exit;
        }
        return (new View())->render('site.admin.index');
    }
    public function create(): string
    {
        $user = $_SESSION['user'] ?? null;
        if (!$user) {
            header('Location: /pop-it-mvc/login');
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            \Model\User::create([
                'login' => $_POST['login'],
                'password' => $_POST['password'],
                'role' => 'admin'
            ]);

            header('Location: /pop-it-mvc/admin');
            exit;
        }

        return (new View())->render('site.admin.create-user');
    }
}