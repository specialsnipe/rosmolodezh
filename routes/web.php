<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// TODO: админ панельные дела

Route::group(['as' => 'admin.', 'prefix' => 'admin'], function () {
    Route::get('/', [\App\Http\Controllers\AdminController::class, 'index'])->name('dashboard');
    Route::resource('settings', \App\Http\Controllers\SettingController::class);
    Route::resource('posts', \App\Http\Controllers\PostController::class);
    Route::resource('users', \App\Http\Controllers\UserController::class);
});

// TODO: Регистрацонные дела

// TODO: Студенческие дела
