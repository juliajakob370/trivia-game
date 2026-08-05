<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\TriviaController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

// Named "dashboard" for Breeze's auth-flow redirects (see ADR 0003), but
// renders Home — the category picker — not a stats dashboard.
Route::get('/dashboard', [TriviaController::class, 'home'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/play/{category}', [TriviaController::class, 'index'])->name('trivia.play');
    Route::post('/submit-game', [TriviaController::class, 'store'])->name('trivia.submit');
    Route::get('/leaderboard', [TriviaController::class, 'leaderboard'])->name('trivia.leaderboard');
});

require __DIR__.'/auth.php';
