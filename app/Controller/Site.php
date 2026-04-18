<?php

namespace Controller;

use Model\Post;
use Src\View;

class Site
{
    public function index(): string
    {
        $posts = Post::all();
        return (new View())->render('site.post', [
            'posts' => $posts
        ]);
    }
}