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

// Главная страница и побочные главной.

Route::get('/', function ( ) {
    return view('welcome');
})->name('home');

// TODO: админ панельные дела

Route::group(['as' => 'admin.', 'prefix' => 'admin'], function () {
    Route::get('/', [\App\Http\Controllers\Admin\MainController::class, 'index'])->name('main.index');
    Route::resource('settings', \App\Http\Controllers\Admin\SettingController::class);
    Route::resource('posts', \App\Http\Controllers\Admin\PostController::class);
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
});

// TODO: Регистрацонные дела

Route::group(['as' => 'auth.'], function () {
    // Авторизация пользователя
    Route::group(['as'=> 'login.', 'prefix' => 'login'], function () {
        Route::get('/', [\App\Http\Controllers\Auth\LoginController::class, 'index'])->name('show');
        Route::post('/', [\App\Http\Controllers\Auth\LoginController::class, 'store'])->name('store');
    });

    // Регистрация пользователя
    Route::group(['as'=> 'register.', 'prefix' => 'register'], function () {
        Route::get('/', [\App\Http\Controllers\Auth\RegisterController::class, 'index'])->name('show');
        Route::post('/', [\App\Http\Controllers\Auth\RegisterController::class, 'store'])->name('store');
    });
});
//Route::get('/login', [Re]);

// TODO: Студенческие дела
