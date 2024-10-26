<?php

use Illuminate\Support\Facades\Route;
use Portfolio\Http\Controllers\PortfolioController;

Route::prefix('api')->group(function () {
    Route::get('/tasks', [PortfolioController::class, 'tasks'])->name('api.tasks.get');

    Route::delete('/tasks/{id}', [PortfolioController::class, 'destroy'])->name('api.tasks.delete');

    Route::put('/tasks/{id}', [PortfolioController::class, 'update'])->name('api.tasks.update');

    Route::post('/tasks', [PortfolioController::class, 'store'])->name('api.tasks.store');
    
    Route::get('/tasks-last', [PortfolioController::class, 'lastTask'])->name('api.tasks.get_last');

    Route::post('/tasks-filter', [PortfolioController::class, 'filter'])->name('api.tasks.filter');
});