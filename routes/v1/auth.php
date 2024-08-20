<?php

use App\v1\Http\Controllers\APIAuth\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/token', [AuthController::class, 'token']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/name', function (Request $request) {
    return response()->json(['name' => $request->user()->name]);
})->middleware('auth:sanctum');
