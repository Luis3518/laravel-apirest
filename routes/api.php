<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/users', [ApiController::class, 'users']);
    Route::post('/users', [ApiController::class, 'createUser']);
    Route::put('/users/{id}', [ApiController::class, 'updateUser']);
    Route::delete('/users/{id}', [ApiController::class, 'deleteUser']);
});

Route::post('/login',[ApiController::class,'login']);