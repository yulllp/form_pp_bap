<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OngoingController;
use App\Http\Controllers\PermintaanController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Login routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('login');
});

// Default routes
Route::get('/', function () {
    if (Auth::check()) {
        // User is authenticated
        return to_route('dashboard');
    } else {
        // User is not authenticated
        return to_route('login');
    }
});

// Authenticate routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/ongoing', [OngoingController::class, 'index'])->name('ongoing');
    Route::get('/create/permintaan/', [PermintaanController::class, 'index'])->name('permintaan');
    Route::post('/create/permintaan/', [PermintaanController::class, 'store'])->name('permintaan.store');
});
