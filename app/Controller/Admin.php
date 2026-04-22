<?php

namespace Controller;

use Src\View;
use Src\Auth\Auth;
use Src\Validator\Validator;
use Model\User;

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
            $validator = new Validator($_POST, [
                'name' => ['required'],
                'login' => ['required', 'unique:users,login'],
                'password' => ['required']
            ], [
                'required' => 'Поле :field не заполнено',
                'unique' => 'Логин :value уже занят'
            ]);

            if ($validator->fails()) {
                return (new View())->render('site.admin.create-user', [
                    'errors' => $validator->errors()
                ]);
            }

            if (User::create($_POST)) {
                return (new View())->render('site.admin.create-user', [
                    'message' => 'Сотрудник успешно создан'
                ]);
            }
        }

        return (new View())->render('site.admin.create-user');
    }
}