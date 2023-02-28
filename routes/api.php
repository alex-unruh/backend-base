<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsersController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::post('/login', [AuthController::class, 'login'])->middleware('auth.basic');

Route::middleware('auth:sanctum')->group(function () {

    // Auth routes
    Route::post('/refresh-token', [AuthController::class, 'refreshToken']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/full-logout', [AuthController::class, 'fullLogout']);

    // Users
    Route::prefix('users')->group(function () {
        Route::controller(UsersController::class)->group(function () {
            Route::get('/', 'index');
            Route::get('/{id}/show', 'show');
            Route::post('/store', 'store');
            Route::post('/{id}/update', 'update');
            Route::post('/{id}/delete', 'destroy');
        })->middleware('can:manage-users');;
    });

});
