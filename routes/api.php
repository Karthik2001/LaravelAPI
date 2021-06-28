<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UsersController;
use App\Http\Controllers\OperationsController;
use App\Http\Controllers\ChatController;
use App\Events\Message;
use Illuminate\Http\Response; 

use App\Http\Controllers\SendEmailController;



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


Route::group(['prefix' => 'v1'], function () {
    Route::post('/login', [UsersController::class, 'login']);
    Route::post('/register', [UsersController::class, 'register']);
    Route::get('/logout', [UsersController::class, 'logout'])->middleware('auth:api');
});

Route::group(['prefix' => 'operations'], function () {
    Route::post('/fetchusers', [OperationsController::class, 'fetchusers']);
    Route::post('/rightswipe', [OperationsController::class, 'addrightswipes']);
    Route::post('/fetchmatches', [OperationsController::class, 'fetchmatches']);
});

Route::group(['prefix' => 'chat'], function () {
    Route::post('/sendmessage', [ChatController::class, 'sendmessage'])->middleware('auth:api');
    Route::get('/fetchchatdata', [ChatController::class, 'fetchchatdata'])->middleware('auth:api');
    Route::get('/fetchmessages', [ChatController::class, 'fetchmessages'])->middleware('auth:api');
});