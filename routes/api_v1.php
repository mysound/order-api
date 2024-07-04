<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Models\Order;
use App\Http\Controllers\Api\V1\OrdersController;
use App\Http\Controllers\Api\V1\UsersController;

Route::middleware('auth:sanctum')->apiResource('orders', OrdersController::class);
Route::middleware('auth:sanctum')->apiResource('users', UsersController::class);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
