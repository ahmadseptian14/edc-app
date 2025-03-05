<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StokController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PengajuanController;

Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');

    Route::prefix('stok-gudang')->group(function () {
        Route::get('/', [StokController::class, 'index'])->name('stok.index');
        Route::get('/get-stoks', [StokController::class, 'get_stoks'])->name('stok.get-stoks');
        Route::post('/import', [StokController::class, 'import'])->name('stok.import');
    });

    Route::prefix('pengajuan-baru')->group(function () {
        Route::get('/', [PengajuanController::class, 'index'])->name('pengajuan.index');
        Route::get('/get-pengajuan', [PengajuanController::class, 'get_pengajuan_baru'])->name('stok.get-pengajuan');
        Route::get('/detail/{id}', [PengajuanController::class, 'detail'])->name('pengajuan.detail');
        Route::get('/create', [PengajuanController::class, 'create'])->name('pengajuan.create');
        Route::post('/store', [PengajuanController::class, 'store'])->name('pengajuan.store');
        Route::post('/import', [PengajuanController::class, 'import'])->name('pengajuan.import');
        Route::get('/{id}/edit', [PengajuanController::class, 'edit'])->name('pengajuan.edit');
        Route::post('/update', [PengajuanController::class, 'update'])->name('pengajuan.update');
        Route::delete('/{id}', [PengajuanController::class, 'destroy'])->name('pengajuan.delete');
    });
});



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
