<?php

use Illuminate\Support\Facades\Route;

/**
 * @uses \App\Http\Controllers\TodoController
 */
Route::get('/', 'index');
Route::get('/{todo}', 'show');
Route::post('/', 'store');
Route::put('/{todo}', 'update');
Route::delete('/{todo}', 'delete');
Route::patch('/{todo}', 'toggleStatus');
