<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OngoingController;
use App\Http\Controllers\PermintaanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
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
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'updateProfile'])->name('profile.update');
    Route::put('/profile/changePassword', [ProfileController::class, 'updatePassword'])->name('password.update');
    Route::get('/approval/permintaan/{id}', [PermintaanController::class, 'editIndex'])->name('permintaan.edit');
    Route::put('/approval/permintaan/{id}', [PermintaanController::class, 'update'])->name('permintaan.update');
    Route::get('/print/{id}',[PermintaanController::class,'printpp'])->name('printpp');
    Route::get('/printpp/{id}',[PermintaanController::class,'printpp'])->name('printpp');
    Route::get('/admin/users',[UserController::class,'index'])->name('admin.users');
    Route::post('/admin/users',[UserController::class,'store'])->name('store.user');
    Route::put('/admin/users/{id}',[UserController::class,'update'])->name('update.user');
    Route::delete('/admin/users/{id}',[UserController::class,'destroy'])->name('destroy.user');
    Route::get('/admin/departments',[DepartmentController::class,'index'])->name('admin.departments');
    Route::post('/admin/departments',[DepartmentController::class,'store'])->name('store.department');
    Route::put('/admin/departments/{id}',[DepartmentController::class,'update'])->name('update.department');
    Route::delete('/admin/departments/{id}',[DepartmentController::class,'destroy'])->name('destroy.department');
    Route::get('/admin/companies',[CompanyController::class,'index'])->name('admin.companies');
    Route::post('/admin/companies',[CompanyController::class,'store'])->name('store.company');
    Route::put('/admin/companies/{id}',[CompanyController::class,'update'])->name('update.company');
    Route::delete('/admin/companies/{id}',[CompanyController::class,'destroy'])->name('destroy.company');
});
