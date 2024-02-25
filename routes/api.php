<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{
        AuthController,
         TweetController,
        FollowController
 };

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:api')->group( function () {
    Route::controller(TweetController::class)->group(function () {
        Route::post('tweet', 'store');
        Route::post('timeline', 'timeLine');
    });

    Route::controller(FollowController::class)->group(function () {
        Route::post('follow', 'follow');
    });

});

Route::prefix('/auth')->controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
});

