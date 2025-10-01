<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BidangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MuridController;
use App\Http\Controllers\PerizinanController;
use Illuminate\Support\Facades\Route;

Route::get('/',[AuthController::class,'showLoginForm'])->name('loginForm');
Route::post('/',[AuthController::class,'login'])->name('login');
Route::get('/logout',[AuthController::class,'logout'])->name('logout');
Route::middleware(['auth'])->group(function() {

    // --- Rute Dashboard ---
    Route::middleware(['checkRole:murid'])->group(function() {
        Route::get('/murid/dashboard', [DashboardController::class, 'muridDashboard'])->name('murid.dashboard');
    });

    Route::middleware(['checkRole:guru'])->group(function() {
        Route::get('/guru/dashboard', [DashboardController::class, 'guruDashboard'])->name('guru.dashboard');
    });

    // --- Rute Khusus Admin ---
    Route::middleware(['checkRole:admin'])->group(function() {
        Route::get('/admin/dashboard', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard');
        Route::get('/history', [HistoryController::class, 'index'])->name('history.index');
        
        // Rute untuk Account
        Route::get('/account', [AccountController::class, 'index'])->name('account.index');
        Route::get('/account/create', [AccountController::class, 'create'])->name('account.create');
        Route::post('/account', [AccountController::class, 'store'])->name('account.store');
        Route::post('/admin/users/{user}/reset-password', [AccountController::class, 'resetPassword'])->name('account.reset');
        Route::delete('/account/{user}', [AccountController::class, 'destroy'])->name('account.destroy');

        // Rute untuk Murid
        Route::get('/murid', [MuridController::class, 'index'])->name('murid.index');
        Route::get('/murid/{murid}/edit', [MuridController::class, 'edit'])->name('murid.edit');
        Route::put('/murid/{murid}', [MuridController::class, 'update'])->name('murid.update');
        
        // Rute untuk Guru
        Route::get('/guru', [GuruController::class, 'index'])->name('guru.index');
        Route::get('/guru/{guru}/edit', [GuruController::class, 'edit'])->name('guru.edit');
        Route::put('/guru/{guru}', [GuruController::class, 'update'])->name('guru.update');

        // Rute untuk Bidang
        Route::get('/bidang', [BidangController::class, 'index'])->name('bidang.index');
        Route::get('/bidang/create', [BidangController::class, 'create'])->name('bidang.create');
        Route::post('/bidang', [BidangController::class, 'store'])->name('bidang.store');
        Route::get('/bidang/{bidang}/edit', [BidangController::class, 'edit'])->name('bidang.edit');
        Route::put('/bidang/{bidang}', [BidangController::class, 'update'])->name('bidang.update');
        Route::delete('/bidang/{bidang}', [BidangController::class, 'destroy'])->name('bidang.destroy');

        // Rute untuk Kelas
        Route::get('/kelas', [KelasController::class, 'index'])->name('kelas.index');
        Route::get('/kelas/create', [KelasController::class, 'create'])->name('kelas.create');
        Route::post('/kelas', [KelasController::class, 'store'])->name('kelas.store');
        Route::get('/kelas/{kelas}/edit', [KelasController::class, 'edit'])->name('kelas.edit');
        Route::put('/kelas/{kelas}', [KelasController::class, 'update'])->name('kelas.update');
        Route::delete('/kelas/{kelas}', [KelasController::class, 'destroy'])->name('kelas.destroy');
    });

    // --- Rute untuk Admin dan Guru ---
    Route::middleware(['role:admin,guru'])->group(function() {
        Route::post('/perizinan/update-status/{id}', [PerizinanController::class, 'updateStatus'])->name('perizinan.update-status');
        // Rute ini juga bisa diakses oleh murid, tapi kita akan filter di controller
        Route::get('/perizinan', [PerizinanController::class, 'index'])->name('perizinan.index');
    });

    // --- Rute untuk Semua ---
    Route::middleware(['role:murid,guru,admin'])->group(function() {
        Route::get('/perizinan/create', [PerizinanController::class, 'create'])->name('perizinan.create');
        Route::post('/perizinan/store', [PerizinanController::class, 'store'])->name('perizinan.store');
        // Rute ini juga bisa diakses oleh admin dan guru
        Route::get('/izin', [PerizinanController::class, 'show'])->name('perizinan.all');
    });

    

});