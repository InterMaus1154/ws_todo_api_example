<?php
use Illuminate\Support\Facades\Route;
/**
 * @uses \App\Http\Controllers\CategoryController
 *
 */

Route::get('/', 'index');
Route::post('/', 'store');
Route::get('/{category}', 'show');
Route::put('/{category}', 'update');
Route::delete('/{category}', 'delete');
