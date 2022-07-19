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
    Route::group(['as' => 'tracks.blocks.exercises', 'prefix' => 'tracks/{track}/blocks/{block}/exercises'], function() {
//        Route::get('answers', [\App\Http\Controllers\Admin\AnswerController::class, 'index'])->name('index');
        Route::get('users/{user}/answer', [\App\Http\Controllers\Admin\AnswerController::class, 'show'])->name('show');
    });
    // manage tracks
    Route::resource('tracks', \App\Http\Controllers\Admin\TrackController::class);
    // manage block of the track
    Route::resource('tracks.blocks', \App\Http\Controllers\Admin\BlockController::class);
    // manage exercises of the block
    Route::resource('blocks.exercises', \App\Http\Controllers\Admin\ExerciseController::class);
    // index, show and delete the answers of the exercise
    Route::resource('exercises.answers', \App\Http\Controllers\Admin\AnswerController::class)->except(['create', 'edit', 'store', 'update']);
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
        Route::get('logout', [\App\Http\Controllers\Client\UserController::class, 'logout'])->name('logout');
    });
});



// TODO: Студенческие дела

Route::get('/', [\App\Http\Controllers\Client\HomeController::class, 'index'])->name('home');
Route::get('/test/mail/message', [\App\Http\Controllers\TestController::class, 'test']);
Route::get('/about', [\App\Http\Controllers\Client\HomeController::class, 'about'])->name('about');

Route::resource('posts', \App\Http\Controllers\Client\PostController::class);
Route::resource('tracks', \App\Http\Controllers\Client\TrackController::class);
Route::resource('tracks.blocks', \App\Http\Controllers\Client\BlockController::class);
Route::resource('blocks.exercises', \App\Http\Controllers\Client\ExerciseController::class);
