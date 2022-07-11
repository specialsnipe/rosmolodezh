<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(['middleware' => 'admin', 'prefix'=> 'admin'], function () {

    Route::apiResource('tracks', \App\Http\Controllers\Api\TrackController::class);
    Route::get('/tracks/{track}/blocks',[\App\Http\Controllers\Api\TrackController::class, 'allBlocks']);
});
