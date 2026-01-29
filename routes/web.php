<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SeriesController;

// Rotas sem agrupamento

// Route::get('/series', [SeriesController::class, 'index'])->name('series.index');
// Route::get('/series/create', [SeriesController::class, 'create'])->name('series.create');
// Route::post('/series', [SeriesController::class, 'store'])->name('series.store');

// Agrupando por prefixo e controller
Route::prefix('series')
    ->controller(SeriesController::class)
    ->group(function () {

        Route::get('/', 'index')->name('series.index');
        Route::get('/create', 'create')->name('series.create');
        Route::post('/', 'store')->name('series.store');
        Route::delete('/destroy/{serie}', 'destroy')->name('series.destroy');
        Route::get('/{serie}/edit', 'edit')->name('series.edit');
        Route::put('/{serie}', 'update')->name('series.update');

    });
