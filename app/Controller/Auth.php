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
            $user = User::findByLogin($login);
            if (!$user || $user['password'] !== md5($password)) {
                return (new View())->render('site.login', [
                    'message' => 'Неверный логин или пароль'
                ]);
            }
            $user['role'] = $user['role'] ?? 'guest';
            $_SESSION['user'] = $user;
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
}