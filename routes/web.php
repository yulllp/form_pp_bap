<?php

use App\Http\Controllers\BeritaController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\OngoingController;
use App\Http\Controllers\OSController;
use App\Http\Controllers\PermintaanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\UserController;
use App\Models\BeritaAcara;
use App\Models\Type;
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
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'updateProfile'])->name('profile.update');
    Route::put('/profile/changePassword', [ProfileController::class, 'updatePassword'])->name('password.update');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

Route::middleware('is_profile_complete')->group(function () {
    Route::get('/ongoing', [OngoingController::class, 'index'])->name('ongoing');
    Route::get('/create/permintaan/', [PermintaanController::class, 'index'])->name('permintaan');
    Route::post('/create/permintaan/', [PermintaanController::class, 'store'])->name('permintaan.store');
    Route::get('/approval/permintaan/{id}', [PermintaanController::class, 'approvalIndex'])->name('permintaan.approval');
    Route::get('/edit/permintaan/{id}', [PermintaanController::class, 'editIndex'])->name('permintaan.edit');
    Route::put('/approval/permintaan/{id}', [PermintaanController::class, 'update'])->name('permintaan.update');
    Route::get('/history', [HistoryController::class, 'index'])->name('history');
    Route::get('/print/{id}', [PermintaanController::class, 'printpp'])->name('printpp');
    Route::get('/printpp/{id}', [PermintaanController::class, 'printpp'])->name('printpp');
    Route::get('/bap/ongoing', [BeritaController::class, 'onGoingIndex'])->name('ongoing.bap');
    Route::get('/printbap/{id}', [BeritaController::class, 'printbap'])->name('printbap');
    Route::get('/bap/approve/{id}', [BeritaController::class, 'approveIndex'])->name('approveIndex.bap');
    Route::put('/bap/approve/{id}', [BeritaController::class, 'approve'])->name('bap.approve');
    Route::put('/bap/reject/{id}', [BeritaController::class, 'reject'])->name('bap.reject');
    Route::get('/bap/history', [BeritaController::class, 'historyIndex'])->name('history.bap');
});

Route::group(['middleware' => 'is_admin'], function () {
    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users');
    Route::post('/admin/users', [UserController::class, 'store'])->name('store.user');
    Route::put('/admin/users/{id}', [UserController::class, 'update'])->name('update.user');
    Route::delete('/admin/users/{id}', [UserController::class, 'destroy'])->name('destroy.user');
    Route::get('/admin/departments', [DepartmentController::class, 'index'])->name('admin.departments');
    Route::post('/admin/departments', [DepartmentController::class, 'store'])->name('store.department');
    Route::put('/admin/departments/{id}', [DepartmentController::class, 'update'])->name('update.department');
    Route::delete('/admin/departments/{id}', [DepartmentController::class, 'destroy'])->name('destroy.department');
    Route::get('/admin/companies', [CompanyController::class, 'index'])->name('admin.companies');
    Route::post('/admin/companies', [CompanyController::class, 'store'])->name('store.company');
    Route::put('/admin/companies/{id}', [CompanyController::class, 'update'])->name('update.company');
    Route::delete('/admin/companies/{id}', [CompanyController::class, 'destroy'])->name('destroy.company');
    Route::get('/admin/brands', [BrandController::class, 'index'])->name('admin.brands');
    Route::post('/admin/brands', [BrandController::class, 'store'])->name('store.brand');
    Route::put('/admin/brands/{id}', [BrandController::class, 'update'])->name('update.brand');
    Route::delete('/admin/brands/{id}', [BrandController::class, 'destroy'])->name('destroy.brand');
    Route::get('/admin/types', [TypeController::class, 'index'])->name('admin.types');
    Route::post('/admin/types', [TypeController::class, 'store'])->name('store.type');
    Route::put('/admin/types/{id}', [TypeController::class, 'update'])->name('update.type');
    Route::delete('/admin/types/{id}', [TypeController::class, 'destroy'])->name('destroy.type');
    Route::get('/admin/OS', [OSController::class, 'index'])->name('admin.os');
    Route::post('/admin/OS', [OSController::class, 'store'])->name('store.os');
    Route::put('/admin/OS/{id}', [OSController::class, 'update'])->name('update.os');
    Route::delete('/admin/OS/{id}', [OSController::class, 'destroy'])->name('destroy.os');
    Route::get('/admin/office', [OfficeController::class, 'index'])->name('admin.office');
    Route::post('/admin/office', [OfficeController::class, 'store'])->name('store.office');
    Route::put('/admin/office/{id}', [OfficeController::class, 'update'])->name('update.office');
    Route::delete('/admin/office/{id}', [OfficeController::class, 'destroy'])->name('destroy.office');
});

Route::group(['middleware' => 'is_IT'], function () {
    Route::get('/create/berita', [DashboardController::class, 'showForm'])->name('form.bap');
    Route::post('/create/berita', [BeritaController::class, 'store'])->name('store.bap');
    Route::get('/edit/berita/{id}', [DashboardController::class, 'showEditForm'])->name('editform.bap');
    Route::get('/bap/edit/{id}', [BeritaController::class, 'editIndex'])->name('bap.editIndex');
    Route::put('/bap/edit/{id}', [BeritaController::class, 'update'])->name('update.bap');
});