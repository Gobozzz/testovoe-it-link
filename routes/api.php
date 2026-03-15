<?php

use App\Http\Controllers\Api\CarController;
use Illuminate\Support\Facades\Route;

Route::prefix('car')->group(function () {
    Route::post('/create', [CarController::class, 'create'])->middleware('throttle:10,1');
    Route::get('/list', [CarController::class, 'getList']);
    Route::get('/{id}', [CarController::class, 'getById']);
});
