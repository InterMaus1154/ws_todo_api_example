<?php
use Illuminate\Support\Facades\Route;

/**
 * @uses \App\Http\Controllers\AuthController
 */

Route::post('/login', 'login');
Route::post('/register', 'register');
Route::post('/logout', 'logout')->middleware('auth:sanctum');
