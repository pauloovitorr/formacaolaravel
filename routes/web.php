<?php

use App\Http\Controllers\EpisodesController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SeasonsController;
use App\Http\Controllers\SeriesController;
use App\Http\Controllers\UsersController;
use App\Http\Middleware\Autenticador;
use Illuminate\Support\Facades\Route;


// Rotas sem agrupamento

// Route::get('/series', [SeriesController::class, 'index'])->name('series.index');
// Route::get('/series/create', [SeriesController::class, 'create'])->name('series.create');
// Route::post('/series', [SeriesController::class, 'store'])->name('series.store');

// Agrupando por prefixo e controller
Route::prefix('series')
    ->controller(SeriesController::class)
    ->group(function () {

        Route::get('/', 'index')->name('series.index')
            ->middleware(Autenticador::class);

        Route::get('/create', 'create')->name('series.create');
        Route::post('/', 'store')->name('series.store');
        Route::delete('/destroy/{serie}', 'destroy')->name('series.destroy');
        Route::get('/{serie}/edit', 'edit')->name('series.edit');
        Route::put('/{serie}', 'update')->name('series.update');
    });



Route::prefix('series')
    ->controller(SeasonsController::class)
    ->group(function () {

        Route::get('/{series}/seasons', 'index')->name('seasons.index');

    });


Route::controller(EpisodesController::class)
    ->group(function () {

        Route::get('/seasons/{seasons}/episodes', 'index')->name('episodes.index');
        Route::put('/seasons/{seasons}/episodes', 'update')->name('episodes.update');

    });


Route::controller(LoginController::class)
    ->group(function () {
        Route::get('/login', 'index')->name('login');
        Route::post('/login', 'store')->name('login.store');
        Route::get('/logout', 'destroy')->name('login.destroy');
    });



Route::controller(UsersController::class)
    ->group(function () {
        Route::get('/register', 'create')->name('users.create');
        Route::post('/register', 'store')->name('users.store');
        
    });
