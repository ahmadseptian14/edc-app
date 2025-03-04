<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StokController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PengajuanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [DashboardController::class, 'index'])->name('index');

Route::prefix('stok-gudang')->group(function () {
    Route::get('/', [StokController::class, 'index'])->name('stok.index');
    Route::get('/get-stoks', [StokController::class, 'get_stoks'])->name('stok.get-stoks');
    Route::post('/import', [StokController::class, 'import'])->name('stok.import');
});

Route::prefix('pengajuan-baru')->group(function () {
    Route::get('/', [PengajuanController::class, 'index'])->name('pengajuan.index');
    Route::get('/get-pengajuan', [PengajuanController::class, 'get_pengajuan_baru'])->name('stok.get-pengajuan');
    Route::get('/create', [PengajuanController::class, 'create'])->name('pengajuan.create');
    Route::post('/store', [PengajuanController::class, 'store'])->name('pengajuan.store');
    Route::post('/import', [PengajuanController::class, 'import'])->name('pengajuan.import');
});



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
