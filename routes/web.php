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

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

// TODO: админ панельные дела

Route::group(['as' => 'admin.', 'prefix' => 'admin', 'middleware' => 'admin'], function () {
    Route::get('/', [\App\Http\Controllers\Admin\MainController::class, 'index'])->name('main.index');
    Route::resource('settings', \App\Http\Controllers\Admin\SettingController::class);
    Route::resource('posts', \App\Http\Controllers\Admin\PostController::class);
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
    Route::resource('genders', \App\Http\Controllers\Admin\GenderController::class);
    Route::resource('roles', \App\Http\Controllers\Admin\RoleController::class);
    Route::resource('occupations', \App\Http\Controllers\Admin\OccupationController::class);
    Route::match(['put', 'patch'], 'users/{user}/change_password', [\App\Http\Controllers\Admin\UserController::class, 'change_password'])->name('users.change_password');
    Route::group(['as' => 'profile.', 'prefix' => 'profile'], function () {
        Route::get('/', [\App\Http\Controllers\Admin\UserController::class, 'profile'])->name('index');
    });

    Route::resource('tracks', \App\Http\Controllers\Admin\TrackController::class);
    Route::resource('tracks.blocks', \App\Http\Controllers\Admin\BlockController::class);
    Route::resource('blocks.exercises', \App\Http\Controllers\Admin\ExerciseController::class);
});

// TODO: Регистрацонные дела

Route::group(['as' => 'auth.'], function () {

    Route::group(['middleware' => 'guest'], function () {
        // Авторизация пользователя
        Route::group(['as'=> 'login.', 'prefix' => 'login'], function () {
            Route::get('/', [\App\Http\Controllers\Auth\LoginController::class, 'index'])->name('show');
            Route::post('/', [\App\Http\Controllers\Auth\LoginController::class, 'submit'])->name('submit');
        });

        // Регистрация пользователя
        Route::group(['as'=> 'register.', 'prefix' => 'register'], function () {
            Route::get('/', [\App\Http\Controllers\Auth\RegisterController::class, 'index'])->name('show');
            Route::post('/', [\App\Http\Controllers\Auth\RegisterController::class, 'store'])->name('store');
        });
    });

    Route::group(['middleware' => 'auth'], function () {
        Route::get('logout', [\App\Http\Controllers\UserController::class, 'logout'])->name('logout');
    });
});



// TODO: Студенческие дела
