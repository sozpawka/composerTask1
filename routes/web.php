<?php

use Src\Route;
use Controller\Site;
use Controller\Auth;
use Controller\Admin;

Route::add('', [Site::class, 'index']);
Route::add('login', [Auth::class, 'login']);
Route::add('logout', [Auth::class, 'logout']);

Route::add('admin', [Admin::class, 'index']);
Route::add('admin/create-user', [Admin::class, 'create']);