<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\UsersController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::post('/login', [AuthController::class, 'login'])->middleware('auth.basic');

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('admin')->group(function () {
        Route::controller(UsersController::class)->group(function () {
            Route::get('/users', 'index');
            Route::get('/users/{id}', 'show');
            Route::post('/users/store', 'store');
            Route::post('/users/{id}/update', 'update');
            Route::post('/users/{id}/delete', 'destroy');
        })->middleware('can:manage-users');;
    });
});
