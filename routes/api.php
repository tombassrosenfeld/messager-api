<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ChatController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\MessageController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'users'], function() {
    Route::get('', [UserController::class, 'index']);
    Route::get('{user}', [UserController::class, 'show']);
});

Route::group(['prefix' => 'chats'], function() {
    Route::get('', [ChatController::class, 'index']);
    Route::get('{chat}', [ChatController::class, 'show']);
});

Route::group(['prefix' => 'messages'], function() {
    Route::post('', [MessageController::class, 'store']);
});