<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\FilmController;
use App\Http\Controllers\Admin\ActorController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\GenreController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\DashboardController;

Route::name('admin.')
->middleware(['auth', 'admin'])
->prefix('admin')
->group(function () {
    Route::get('reviews', [ReviewController::class, 'index'])->name('reviews.index');
    Route::delete('reviews/{id}', [ReviewController::class, 'destroy'])->name('reviews.destroy');

    Route::resource('/films', FilmController::class);
    Route::resource('/actors', ActorController::class);
    Route::resource('/admins', AdminController::class);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/genres', [GenreController::class, 'index'])->name('genres.index');
    Route::post('/genres', [GenreController::class, 'store'])->name('genres.store');
    Route::put('/genres/{id}', [GenreController::class, 'update'])->name('genres.update');
    Route::delete('/genres/{id}', [GenreController::class, 'destroy'])->name('genres.destroy');
});
