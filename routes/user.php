<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\FilmController;
use App\Http\Controllers\User\ReviewController;


Route::get('/', function () {
    return view('user.coba');
})->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/films/{id}', [FilmController::class, 'show'])->name('films.show');
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
});
