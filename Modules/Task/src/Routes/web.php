<?php

use Illuminate\Support\Facades\Route;
use Task\Http\Controllers\TaskController;

Route::middleware([\Illuminate\Session\Middleware\StartSession::class])->group(function () {
    // home
    Route::get('tasks', [TaskController::class, 'index'])->name('web.task.index');
    
    Route::prefix('tasks')->group(function () {
        // create template
        Route::get('create', [TaskController::class, 'create'])->name('web.tasks.create');
        //edit template
        Route::get('edit/{id}', [TaskController::class, 'edit'])->name('web.tasks.edit');
    });

    Route::post('template-response', [TaskController::class, 'responses'])->name('web.task.responses');
    
    Route::fallback(function () {
        return redirect()->route('web.task.index');
    });

});