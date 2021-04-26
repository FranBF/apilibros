<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\BookController;

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


Route::middleware('auth:api')->group(function () {
    Route::resource('user', UserController::class);
    Route::resource('book', BookController::class);
    Route::put('update/{id}', [UserController::class, 'update']);
    Route::put('book/update/{id}', [BookController::class, 'update']);
    Route::delete('user/{id}', [UserController::class, 'delete']);
    Route::delete('book/{id}', [BookController::class, 'delete']);
    Route::post('books', [UserController::class, 'create']);
});
Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);
