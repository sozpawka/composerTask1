<?php

namespace Controller;

use Src\View;
use Src\Auth\Auth;

class Admin
{
    public function __construct()
    {
        if (!Auth::check()) {
            header('Location: /pop-it-mvc/login');
            exit;
        }

        if (Auth::user()->role !== 'admin') {
            header('Location: /pop-it-mvc/');
            exit;
        }
    }

    public function index(): string
    {
        header('Location: /pop-it-mvc/admin/create-user');
        exit;
    }

    public function create(): string
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            \Model\User::create([
                'name' => $_POST['name'],
                'login' => $_POST['login'],
                'password' => $_POST['password'],
                'role' => $_POST['role']
            ]);

            return (new View())->render('site.admin.create-user', [
                'message' => 'Пользователь создан'
            ]);
        }

        return (new View())->render('site.admin.create-user');
    }
}