<?php

namespace Controller;

use Src\View;
use Model\User;
use Src\Auth\Auth;
use Src\Validator\Validator;

class AuthController
{
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $validator = new Validator($_POST, [
                'login' => ['required'],
                'password' => ['required']
            ], [
                'required' => 'Поле :field обязательно для заполнения'
            ]);

            if ($validator->fails()) {
                return (new View())->render('site.login', [
                    'message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)
                ]);
            }

            $user = User::where('login', $_POST['login'])->first();

            if (!$user || $user->password !== md5($_POST['password'])) {
                return (new View())->render('site.login', [
                    'message' => 'Неверный логин или пароль'
                ]);
            }

            Auth::login($user);
            header('Location: /pop-it-mvc' . ($user->role === 'admin' ? '/admin' : ($user->role === 'receptionist' ? '/patients' : '/')));
            exit;
        }

        return (new View())->render('site.login');
    }

    public function logout()
    {
        Auth::logout();
        header('Location: /pop-it-mvc/');
        exit;
    }
}