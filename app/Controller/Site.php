<?php

namespace Controller;

use Model\Post;
use Src\View;
use Src\Request;
use Model\User;
use Src\Auth\Auth;
use Src\Validator\Validator;

class Site
{
    public function index(): string
    {
        return (new View())->render('site.index');
    }
    public function uploadPhoto(Request $request): void
    {
        if ($request->method === 'POST') {
            $data = array_merge($request->all(), $_FILES);
            $validator = new Validator($data, [
                'avatar' => ['required', 'img', 'max_file:2048'],
            ], [
                'required' => 'Файл не выбран',
                'img' => 'Можно загружать только JPG или PNG',
                'max_file' => 'Файл слишком тяжелый (максимум 2МБ)'
            ]);
            if ($validator->fails()) {
                $errors = $validator->errors();
                \Src\Session::set('photo_error', $errors['avatar'][0]);
                app()->route->redirect('/');
                return;
            }
            $file = $_FILES['avatar'];
            $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
            $fileName = time() . '_' . uniqid() . '.' . $ext;
            $path = realpath(__DIR__ . '/../../public/uploads') . DIRECTORY_SEPARATOR . $fileName;
            if (move_uploaded_file($file['tmp_name'], $path)) {
                $user = Auth::user();
                if ($user) {
                    $user->avatar = $fileName;
                    $user->save();
                }
            }
        }
        app()->route->redirect('/');
    }

    public function signup(Request $request): string
    {
        if ($request->method === 'POST') {
            $validator = new Validator($request->all(), [
                'name' => ['required'],
                'login' => ['required', 'unique:users,login'],
                'password' => ['required']
            ], [
                'required' => 'Поле :field пусто',
                'unique' => 'Поле :field должно быть уникально'
            ]);

            if ($validator->fails()) {
                return (new View())->render('site.signup',
                    ['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)]);
            }

            if (User::create($request->all())) {
                app()->route->redirect('/login');
                return '';
            }
        }
        return (new View())->render('site.signup');
    }
    public function login(Request $request): string
    {
        if ($request->method === 'GET') {
            return (new View())->render('site.login');
        }

        if (Auth::attempt($request->all())) {
            app()->route->redirect('/hello');
            return '';
        }

        return (new View())->render('site.login', ['message' => 'Неверный логин или пароль']);
    }
    public function logout(): void
    {
        Auth::logout();
        app()->route->redirect('/hello');
    }
}