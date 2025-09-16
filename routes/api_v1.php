<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TodoController;

Route::get('/status', function () {
    return response()->json([
        'message' => 'API is running:)'
    ]);
});

Route::post('/db/reset', function () {
    try {
        Artisan::call('migrate:fresh --seed');
        return response()->json([
            'message' => 'Database has been reset',
            'timeOfReset' => now()->toDateTimeString()
        ]);
    } catch (Throwable $e) {
        return response()->json([
            'message' => 'Database reset failed'
        ], 500);
    }
});

Route::prefix('auth')->controller(AuthController::class)->group(base_path('routes/auth.php'));
Route::prefix('categories')->middleware('auth:sanctum')->controller(CategoryController::class)->group(base_path('routes/categories.php'));
Route::prefix('todos')->middleware('auth:sanctum')->controller(TodoController::class)->group(base_path('routes/todos.php'));
