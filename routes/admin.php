<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\TaskController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SubTaskController;
use App\Http\Controllers\Admin\UserTaskController; // Correct the namespace capitalization
use App\Http\Controllers\User\UserController as UserUserController; // Adjust namespace if it's meant to be under a different directory
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::get('login', [AuthController::class, 'login'])->name('admin.login');
Route::post('do_login', [AuthController::class, 'do_login'])->name('admin.do_login');
Route::get('logout', [AuthController::class, 'logout'])->name('admin.logout');

Route::group(['middleware' => 'auth:admin', 'prefix' => 'admin'], function() {
    Route::get('home', [HomeController::class, 'home'])->name('admin.home');
    Route::resource('admins', AdminController::class);
    Route::resource('users', UserController::class);
    Route::resource('tasks', TaskController::class);
    Route::resource('sub', SubTaskController::class);
    Route::resource('assign', UserTaskController::class);
});

/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => 'auth:user', 'prefix' => 'user'], function() {
    Route::resource('users_tasks', UserUserController::class);
    Route::get('home', [HomeController::class, 'home'])->name('user.home');
});
