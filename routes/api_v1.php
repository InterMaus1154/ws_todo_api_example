<?php

use Illuminate\Support\Facades\Route;

Route::get('/status', function(){
   return response()->json([
        'message' => 'API is running:)'
   ]);
})->middleware('auth:sanctum');
