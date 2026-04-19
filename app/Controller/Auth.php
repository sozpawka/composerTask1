<?php

namespace Controller;

use Src\View;
use Model\User;

class Auth
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
            $user->role = $user->role ?? 'guest';
            $_SESSION['user'] = [
                'id' => $user->id,
                'login' => $user->login,
                'role' => $user->role ?? 'guest'
            ];
            header('Location: /pop-it-mvc/');
            exit;
        }
        return (new View())->render('site.login');
    }
    public function logout()
    {
        unset($_SESSION['user']);
        session_destroy();
        header('Location: /pop-it-mvc/');
        exit;
    }
    public function signup()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $login = $_POST['login'] ?? '';
            $password = $_POST['password'] ?? '';

            $user = \Model\User::create([
                'login' => $login,
                'password' => md5($password),
            ]);

            header('Location: /pop-it-mvc/login');
            exit;
        }

        return (new \Src\View())->render('site.signup');
    }
}