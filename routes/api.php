<?php

use App\Http\Controllers\API\Admin\UserController;
use App\Http\Controllers\API\AuthController;
use Illuminate\Support\Facades\Route;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AUthController::class, 'login']);

Route::middleware('auth:api')->group( function () {
    Route::post('logout', [AUthController::class, 'logout']);
    Route::get('users', [UserController::class, 'index']);
});
