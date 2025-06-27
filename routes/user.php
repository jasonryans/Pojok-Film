<?php

use App\Http\Controllers\Admin\ActorController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\FilmController;
use App\Http\Controllers\User\ReviewController;

Route::get('/', [FilmController::class, 'index'])->name('home');
Route::get('/films', [FilmController::class, 'index'])->name('films.index');
Route::get('/films/{id}', [FilmController::class, 'show'])->name('films.show');
Route::get('/actors/{id}', [ActorController::class, 'detail'])->name('actors.show');

Route::middleware('auth')->group(function () {
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
});
