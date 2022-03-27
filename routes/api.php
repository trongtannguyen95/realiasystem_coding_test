<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ProductController;
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

Route::group(['middleware' => 'api'], function () {
    Route::prefix('item')->group(function () {
        Route::post('add', [ProductController::class, 'create']);
        Route::post('update', [ProductController::class, 'update']);
        Route::post('delete', [ProductController::class, 'delete']);
        Route::post('search', [ProductController::class, 'search']);
    });
    Route::get('items', [ProductController::class, 'list']);
});

Route::post("auth/login", [AuthController::class, 'login']);
Route::post("register", [RegisterController::class, 'register']);
