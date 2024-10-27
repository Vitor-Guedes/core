<?php

use Illuminate\Support\Facades\Route;
use Task\Http\Controllers\TaskController;

Route::prefix('api')->group(function () {
    Route::get('/tasks', [TaskController::class, 'tasks'])->name('api.tasks.get');

    Route::delete('/tasks/{id}', [TaskController::class, 'destroy'])->name('api.tasks.delete');

    Route::put('/tasks/{id}', [TaskController::class, 'update'])->name('api.tasks.update');

    Route::post('/tasks', [TaskController::class, 'store'])->name('api.tasks.store');
    
    Route::get('/tasks-last', [TaskController::class, 'lastTask'])->name('api.tasks.get_last');

    Route::post('/tasks-filter', [TaskController::class, 'filter'])->name('api.tasks.filter');
    
    Route::post('/mass-actions', [TaskController::class, 'massAction'])->name('api.tasks.mass.delete');
});