<?php

namespace Controller;

use Src\View;
use Model\User;
use Src\Auth\Auth;

class AuthController
{
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $login = $_POST['login'] ?? '';
            $password = $_POST['password'] ?? '';

            $user = User::where('login', $login)->first();

            if (!$user || $user->password !== md5($password)) {
                return (new View())->render('site.login', [
                    'message' => 'Неверный логин или пароль'
                ]);
            }

            Auth::login($user);

            if ($user->role === 'admin') {
                header('Location: /pop-it-mvc/admin');
                exit;
            }

            if ($user->role === 'receptionist') {
                header('Location: /pop-it-mvc/patients');
                exit;
            }

            header('Location: /pop-it-mvc/');
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

    public function signup()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $login = $_POST['login'] ?? '';
            $password = $_POST['password'] ?? '';

            \Model\User::create([
                'login' => $login,
                'password' => md5($password),
            ]);

            header('Location: /pop-it-mvc/login');
            exit;
        }

        return (new \Src\View())->render('site.signup');
    }
}