<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

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
