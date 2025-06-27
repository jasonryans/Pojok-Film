<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\FilmController;
use App\Http\Controllers\User\ReviewController;


Route::middleware('auth')->group(function () {
    Route::get('/', [FilmController::class, 'index'])->name('home');
    Route::get('/films', [FilmController::class, 'index'])->name('films.index');
    Route::get('/films/{id}', [FilmController::class, 'show'])->name('films.show');
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::get('/profile', [\App\Http\Controllers\User\ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [\App\Http\Controllers\User\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [\App\Http\Controllers\User\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [\App\Http\Controllers\User\ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/picture/edit', [\App\Http\Controllers\User\ProfilePictureController::class, 'edit'])->name('profile.picture.edit');
    Route::post('/profile/picture', [\App\Http\Controllers\User\ProfilePictureController::class, 'update'])->name('profile.picture.update');
});
