<?php

use Src\Route;
use Controller\Site;
use Controller\Auth;
use Controller\Admin;
use Controller\Patient;
use Controller\Visit;
use Controller\Doctor;

Route::add('', [Site::class, 'index']);
Route::add('login', [Auth::class, 'login']);
Route::add('logout', [Auth::class, 'logout']);

Route::add('admin', [Admin::class, 'index']);
Route::add('admin/create-user', [Admin::class, 'create']);

Route::add('patients', [Patient::class, 'index']);
Route::add('patients/create', [Patient::class, 'create']);

Route::add('visits', [Visit::class, 'index']);
Route::add('visits/create', [Visit::class, 'create']);
Route::add('visits/delete', [Visit::class, 'delete']);

Route::add('doctors', [Doctor::class, 'index']);
Route::add('doctors/create', [Doctor::class, 'create']);

Route::add('go', [Site::class, 'go']);