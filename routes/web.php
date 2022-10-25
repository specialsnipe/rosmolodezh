<?php

use Illuminate\Support\Facades\Http;
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

// Admin functionality

Route::group(['as' => 'admin.', 'prefix' => 'admin', 'middleware' => 'admin'], function () {
    Route::get('/', [\App\Http\Controllers\Admin\MainController::class, 'index'])->name('main.index');
    Route::resource('posts', \App\Http\Controllers\Admin\PostController::class);
    Route::get('users/deleted', [\App\Http\Controllers\Admin\UserController::class, 'indexDeleted'])->name('users.deleted');
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
    Route::match(['put', 'patch'], 'users/{user}/changeStatus', [\App\Http\Controllers\Admin\UserController::class, 'change_status'])->name('users.changeStatus');
    Route::match(['put', 'patch'], 'users/{user}/change_password', [\App\Http\Controllers\Admin\UserController::class, 'change_password'])->name('users.change_password');
    Route::group(['as' => 'profile.', 'prefix' => 'profile'], function () {
        Route::get('/', [\App\Http\Controllers\Admin\UserController::class, 'profile'])->name('index');
    });
    // SettingsController of a site constants
    Route::group(['as'=> 'settings.', 'prefix'=> 'settings'], function () {
        Route::resource('/', \App\Http\Controllers\Admin\SettingsController::class);
        Route::resource('/genders', \App\Http\Controllers\Admin\GenderController::class);
        Route::resource('/roles', \App\Http\Controllers\Admin\RoleController::class);
        Route::resource('/information', \App\Http\Controllers\Admin\InformationController::class)->only(['index', 'update']);
        Route::resource('/occupations', \App\Http\Controllers\Admin\OccupationController::class);
        Route::resource('/slider', \App\Http\Controllers\Admin\SliderController::class);
        Route::resource('/complexity', App\Http\Controllers\Admin\ComplexityController::class)->only('index');
        Route::resource('/phrases', App\Http\Controllers\Admin\PhraseController::class);
        Route::resource('/team', App\Http\Controllers\Admin\TeamController::class);
        Route::resource('/partnership', App\Http\Controllers\Admin\PartnershipController::class);
        Route::resource('/partnership/{partnership}/item', App\Http\Controllers\Admin\PartnershipItemController::class, ['as'=>'partnership'])->except(['index', 'show']);
    });




    // manage tracks
    Route::resource('tracks', \App\Http\Controllers\Admin\TrackController::class);
    Route::post('user/add/tracks/{track}', [\App\Http\Controllers\Admin\TrackController::class, 'addTrackForUser'])->name('tracks.addTrackForUser');
    // manage block of the track
    Route::resource('tracks.blocks', \App\Http\Controllers\Admin\BlockController::class);
    // manage exercises of the block
    Route::resource('blocks.exercises', \App\Http\Controllers\Admin\ExerciseController::class);
    // index, show and delete the answers of the exercise
    Route::put('exercises/{exercise}/answers/{answer}', [\App\Http\Controllers\Admin\AnswerController::class, 'changeMark'])->name('exercises.answers.changeMark');
    Route::resource('exercises.answers', \App\Http\Controllers\Admin\AnswerController::class)->except(['edit', 'update']);
});

// Authorization user

Route::group(['as' => 'auth.'], function () {
    Route::group(['middleware' => 'guest'], function () {
        // Login user
        Route::group(['as' => 'login', 'prefix' => 'login'], function () {
            Route::get('/', [\App\Http\Controllers\Auth\LoginController::class, 'index']);
            Route::post('/', [\App\Http\Controllers\Auth\LoginController::class, 'submit'])->name('.submit');
        });

        // Register user
        Route::group(['as' => 'register', 'prefix' => 'register'], function () {
            Route::get('/', [\App\Http\Controllers\Auth\RegisterController::class, 'index']);
            Route::post('/', [\App\Http\Controllers\Auth\RegisterController::class, 'store'])->name('.store');
        });

        //Forget password
        Route::group(['as' => 'forget.', 'prefix' => 'forget'], function () {
            Route::get('/', [\App\Http\Controllers\Auth\ForgetPasswordController::class, 'index'])->name('index');
            Route::post('/', [\App\Http\Controllers\Auth\ForgetPasswordController::class, 'restore'])->name('restore');
            Route::get('/change-password', [\App\Http\Controllers\Auth\ForgetPasswordController::class, 'changePassword'])->name('change-password');
            Route::post('/{user}/change-password', [\App\Http\Controllers\Auth\ForgetPasswordController::class, 'submit'])->name('submit.change-password');
        });



    });
    // logout
    Route::group(['middleware' => 'auth'], function () {
        Route::get('logout', [\App\Http\Controllers\Client\UserController::class, 'logout'])->name('logout');
    });
});

// Verification email

Route::group(['middleware' => 'auth', 'as' => 'verification.', 'prefix' => 'email'], function () {
    Route::get('/verify/{id}/{hash}', [\App\Http\Controllers\EmailController::class, 'verify'])->middleware('signed')->name('verify');
    Route::get('/verify', [\App\Http\Controllers\EmailController::class, 'notice'])->name('notice');
    Route::post('/verification-notification', [\App\Http\Controllers\EmailController::class, 'send'])->middleware('throttle:6,1')->name('send');
});


// Client side

Route::get('/', [\App\Http\Controllers\Client\HomeController::class, 'index'])->name('home');
Route::get('/test/mail/message', [\App\Http\Controllers\TestController::class, 'test']);
Route::get('/about', [\App\Http\Controllers\Client\HomeController::class, 'about'])->name('about');
Route::get('/contacts', [\App\Http\Controllers\Client\HomeController::class, 'contacts'])->name('contacts');
Route::get('/teams', [\App\Http\Controllers\Client\HomeController::class, 'teams'])->name('teams');
Route::get('/partnership', [\App\Http\Controllers\Client\HomeController::class, 'partnership'])->name('partnership');
Route::get('/rules-of-usable', [\App\Http\Controllers\Client\HomeController::class, 'rules'])->name('rules');
Route::get('/search', [\App\Http\Controllers\Client\HomeController::class, 'search'])->name('search');
Route::get('/search/exercises', [\App\Http\Controllers\Client\HomeController::class, 'exercisesSearch'])->name('exercises.search');
Route::get('/search/posts', [\App\Http\Controllers\Client\HomeController::class, 'postsSearch'])->name('posts.search');

Route::resource('posts', \App\Http\Controllers\Client\PostController::class);
Route::resource('tracks', \App\Http\Controllers\Client\TrackController::class);
// manage tracks' user
Route::post('user/add/tracks/{track}', [\App\Http\Controllers\Client\TrackController::class, 'sendRequest'])->name('tracks.sendRequest');
Route::post('user/add/tracks/{track}/refuse', [\App\Http\Controllers\Client\TrackController::class, 'sendRefuseRequest'])->name('tracks.sendRefuseRequest');
Route::match(['put', 'patch'], 'user/add/tracks/{track}/user/{user}/accept', [\App\Http\Controllers\Client\TrackController::class, 'userAccepted'])
    ->name('tracks.userAccepted');

// Profile
Route::group(['middleware' => 'auth'], function () {
    Route::group(['as' => 'profile.',  'prefix' => 'profile'], function () {

        Route::get('data', [\App\Http\Controllers\Client\UserController::class, 'data'])->name('data');
        Route::get('progress', [\App\Http\Controllers\Client\UserController::class, 'profile'])->name('progress');
        Route::get('progress/track/{track}', [\App\Http\Controllers\Client\ProfileTrackController::class, 'show'])
            ->name('track.show')
            ->can('view','track');
        Route::get('progress/user/track/{track}', [\App\Http\Controllers\Client\ProfileTrackController::class, 'userShow'])
            ->name('user.track.show');
        Route::match(['put', 'patch'], 'user/update', [\App\Http\Controllers\Client\UserController::class, 'update'])->name('user.update');
        Route::match(['put', 'patch'], 'user/changePassword', [\App\Http\Controllers\Client\UserController::class, 'changePassword'])->name('user.change_password');
        Route::match(['put', 'patch'], 'user/updateAvatar', [\App\Http\Controllers\Client\UserController::class, 'updateAvatar'])->name('user.update_avatar');
        Route::get('user/{user}', [\App\Http\Controllers\Client\UserController::class, 'show'])
            ->name('user.show')
            ->can('view', 'user');
        Route::resource('tracks.blocks', \App\Http\Controllers\Client\BlockController::class);
        Route::resource('blocks.exercises', \App\Http\Controllers\Client\ExerciseController::class);
    });
});

// todo: Сделать пути которые будут защищены от пользователей которые не подтвердили почту, middleware:verified


// todo: telegram webhook
Route::get('/set/webhook', function () {
    $url = 'https://nethammer.online';
    $bot_token = config('bots.bot');
    $http = Http::get('http://api.tlgr.org/bot' . $bot_token .'/setWebhook?url=' . $url . '/webhook');
    dd($http->body());
});

Route::post('/webhook', [\App\Http\Controllers\TelegramController::class, 'index']);
