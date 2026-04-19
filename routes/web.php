<?php

use Src\Route;
use Controller\Site;
use Controller\AuthController;
use Controller\Admin;
use Controller\Patient;
use Controller\Visit;
use Controller\Doctor;

Route::add('GET', '/', [Site::class, 'index'])->middleware('auth');

Route::add(['GET', 'POST'], '/login', [AuthController::class, 'login']);
Route::add('GET', '/logout', [AuthController::class, 'logout']);
Route::add(['GET', 'POST'], '/signup', [Site::class, 'signup']);

Route::add('GET', '/posts', [Site::class, 'posts'])->middleware('auth');

Route::add('GET', '/admin', [Admin::class, 'index'])->middleware('auth:admin');
Route::add(['GET', 'POST'], '/admin/create-user', [Admin::class, 'create'])->middleware('auth:admin');

Route::add('GET', '/patients', [Patient::class, 'index'])->middleware('auth:receptionist');
Route::add(['GET', 'POST'], '/patients/create', [Patient::class, 'create'])->middleware('auth:receptionist');

Route::add('GET', '/visits', [Visit::class, 'index'])->middleware('auth:receptionist');
Route::add(['GET', 'POST'], '/visits/create', [Visit::class, 'create'])->middleware('auth:receptionist');
Route::add('GET', '/visits/delete', [Visit::class, 'delete'])->middleware('auth:receptionist');

Route::add('GET', '/doctors', [Doctor::class, 'index'])->middleware('auth:receptionist');
Route::add(['GET', 'POST'], '/doctors/create', [Doctor::class, 'create'])->middleware('auth:receptionist');