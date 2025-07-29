<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;


Route::get('/', function () {
    return view('welcome');
});

// GET /api/users
Route::get('/users', [UserController::class, 'index']);

// GET /api/users/{id}
Route::get('/users/{id}', [UserController::class, 'show']);

// POST /api/users
Route::post('/users', [UserController::class, 'store']);

// Update 만들기
Route::put('/users/{id}', [UserController::class, 'update']);

// Delete 만들기
Route::delete('/users/{id}', [UserController::class, 'destroy']);
