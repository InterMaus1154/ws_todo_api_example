<?php

use Illuminate\Support\Facades\Route;


Route::post('/login', 'login');
Route::post('/register', 'register');
Route::post('/logout', 'logout')->middleware('auth:sanctum');
