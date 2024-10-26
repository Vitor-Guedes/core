<?php

use Illuminate\Support\Facades\Route;
use Portfolio\Http\Controllers\PortfolioController;

Route::middleware([\Illuminate\Session\Middleware\StartSession::class])->group(function () {
    // home
    Route::get('tasks', [PortfolioController::class, 'index'])->name('web.portfolio.index');
    
    Route::prefix('tasks')->group(function () {
        // create template
        Route::get('create', [PortfolioController::class, 'create'])->name('web.tasks.create');
        //edit template
        Route::get('edit/{id}', [PortfolioController::class, 'edit'])->name('web.tasks.edit');
    });

    Route::post('template-response', [PortfolioController::class, 'responses'])->name('web.portfolio.responses');
    
    Route::fallback(function () {
        return redirect()->route('web.portfolio.index');
    });

});