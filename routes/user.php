<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\FilmController;
use App\Http\Controllers\User\ReviewController;


Route::middleware('auth')->group(function () {
    Route::get('/', [FilmController::class, 'index'])->name('home');
    Route::get('/films', [FilmController::class, 'index'])->name('films.index');
    Route::get('/films/{id}', [FilmController::class, 'show'])->name('films.show');
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
});
