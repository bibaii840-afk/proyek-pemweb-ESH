<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ScoreController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/materi', [PageController::class, 'materi'])->name('materi');
Route::get('/leaderboard', [ScoreController::class, 'leaderboard'])->name('leaderboard');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [ScoreController::class, 'dashboard'])->name('dashboard');
    Route::post('/score', [ScoreController::class, 'store'])->name('score.store');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
