<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ActorController;

Route::get('/admin/reviews', [ReviewController::class, 'index'])->name('reviews.index');
Route::delete('/admin/reviews/{id}', [ReviewController::class, 'destroy'])->name('reviews.destroy');

// Route::resource('/reviews', ReviewController::class)->only(['index', 'destroy']); 
Route::resource('/films', FilmController::class);
Route::resource('/actors', ActorController::class);
// Route::resource('films', FilmController::class);


Route::get('/', function () {
    return view('user.base');
})->name('home');

Route::get('/detail/{id}', [FilmController::class, 'show'])->name('detailfilm');
Route::post('/detail/{id}', [ReviewController::class, 'store'])->name('review_post')->middleware('auth');;

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
