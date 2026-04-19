<?php

namespace Controller;

use Model\Post;
use Src\View;
use Src\Request;
use Model\User;
use Src\Auth\Auth;
class Site
{
    public function index(): string
    {
        return (new View())->render('site.index');
    }
    public function posts(Request $request): string
    {
        $id = $request->get('id');

        if ($id) {
            $posts = Post::where('id', $id)->get();
        } else {
            $posts = Post::all();
        }

        return (new View())->render('site.post', ['posts' => $posts]);
    }

    public function signup(Request $request): string
    {
        if ($request->method === 'POST' && User::create($request->all())) {
            return new View('site.signup', ['message' => 'Вы успешно зарегистрированы']);
        }

        return new View('site.signup');
    }
    public function login(Request $request): string
    {
        if ($request->method === 'GET') {
            return new View('site.login');
        }

        if (Auth::attempt($request->all())) {
            app()->route->redirect('/hello');
        }

        return new View('site.login', [
            'message' => 'Неверный логин или пароль'
        ]);
    }
    public function logout(): void
    {
        Auth::logout();
        app()->route->redirect('/hello');
    }
}