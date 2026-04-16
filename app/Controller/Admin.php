<?php

namespace Controller;

use Src\View;
use Model\User;

class Admin
{
    public function index(): string
    {
        return (new View())->render('site.admin.index');
    }

    public function create(): string
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            User::create([
                'login' => $_POST['login'],
                'password' => $_POST['password'],
                'role' => 'receptionist'
            ]);

            header('Location: /pop-it-mvc/public/admin');
            exit;
        }

        return (new View())->render('site.admin.create-user');
    }
}