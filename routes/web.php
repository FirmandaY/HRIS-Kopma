<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CutiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IzinController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\KelolaController;
use App\Http\Controllers\ProfilController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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


Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/rekap/cuti', [DashboardController::class, 'cuti'])->name('rekap.cuti');
    Route::get('/rekap/izin', [DashboardController::class, 'izin'])->name('rekap.izin');

    Route::prefix('/profil')->group(function () {
        Route::get('/', [ProfilController::class, 'show'])->name('profil.show');
    });

    Route::prefix('/anggota')->middleware('can:isAdmin')->group(function () {
        Route::get('/', [KelolaController::class, 'index'])->name('kelola.index');
        
        Route::get('/trashed', [KelolaController::class, 'trashed'])->name('kelola.trashed');
        Route::get('/daftar', [KelolaController::class, 'create'])->name('kelola.daftar');
        Route::post('/daftar', [KelolaController::class, 'store'])->name('kelola.store');
        Route::get('/{user:nik}/edit', [KelolaController::class, 'edit']);
        Route::patch('/{user:nik}/edit', [KelolaController::class, 'update']);
        Route::delete('/{user:nik}/delete', [KelolaController::class, 'destroy']);
        Route::get('/{user:nik}/restore', [KelolaController::class, 'restore']);
    });

    Route::prefix('/cuti')->group(function () {
        Route::get('/', [CutiController::class, 'index'])->name('cuti.index');
        Route::get('/admin', [CutiController::class, 'admin'])->middleware('can:edit')->name('cuti.admin');
        Route::get('/create', [CutiController::class, 'create'])->middleware('can:pengajuan')->name('cuti.create');
        Route::post('/create', [CutiController::class, 'store'])->name('cuti.store');
        Route::get('/export', [CutiController::class, 'export'])->middleware('can:isAdmin')->name('cuti.export');
        Route::delete('/delete-all', [CutiController::class, 'destroyAll'])->middleware('can:isAdmin')->name('cuti.delete.all');
        Route::get('/lampiran/{cuti:slug}', [CutiController::class, 'lampiran'])->name('cuti.lampiran');
        Route::get('/{cuti:slug}', [CutiController::class, 'show']);
        Route::get('/{cuti:slug}/edit', [CutiController::class, 'edit'])->middleware('can:edit')->name('cuti.edit');
        Route::patch('/{cuti:slug}/edit', [CutiController::class, 'update'])->middleware('can:update')->name('cuti.update');
        Route::delete('/{cuti:slug}/delete', [CutiController::class, 'destroy'])->middleware('can:delete');
    });

    Route::prefix('/izin')->group(function () {
        Route::get('/', [IzinController::class, 'index'])->name('izin.index');
        Route::get('/admin', [IzinController::class, 'admin'])->middleware('can:edit')->name('izin.admin');
        Route::get('/create', [IzinController::class, 'create'])->middleware('can:pengajuan')->name('izin.create');
        Route::post('/create', [IzinController::class, 'store'])->name('izin.store');
        Route::get('/export', [IzinController::class, 'export'])->middleware('can:isAdmin')->name('izin.export');
        Route::delete('/delete-all', [IzinController::class, 'destroyAll'])->middleware('can:isAdmin')->name('izin.delete.all');
        Route::get('/lampiran/{izin:slug}', [IzinController::class, 'lampiran'])->name('izin.lampiran');
        Route::get('/{izin:slug}', [IzinController::class, 'show']);
        Route::get('/{izin:slug}/edit', [IzinController::class, 'edit'])->middleware('can:edit')->name('izin.edit');
        Route::patch('/{izin:slug}/edit', [IzinController::class, 'update'])->middleware('can:update')->name('izin.update');
        Route::delete('/{izin:slug}/delete', [IzinController::class, 'destroy'])->middleware('can:delete');
    });

    Route::prefix('/pinjam')->group(function () {
        Route::get('/', [PeminjamanController::class, 'index'])->name('pinjam.index');
        Route::get('/admin', [PeminjamanController::class, 'admin'])->middleware('can:edit')->name('pinjam.admin');
        Route::get('/create', [PeminjamanController::class, 'create'])->middleware('can:pengajuan')->name('pinjam.create');
        Route::post('/create', [PeminjamanController::class, 'store'])->name('pinjam.store');
        Route::get('/export', [PeminjamanController::class, 'export'])->middleware('can:isAdmin')->name('pinjam.export');
        Route::delete('/delete-all', [PeminjamanController::class, 'destroyAll'])->middleware('can:isAdmin')->name('pinjam.delete.all');
        Route::get('/lampiran/{pinjam:slug}', [PeminjamanController::class, 'lampiran'])->name('pinjam.lampiran');
        Route::get('/{pinjam:slug}', [PeminjamanController::class, 'show']);
        Route::get('/{pinjam:slug}/edit', [PeminjamanController::class, 'edit'])->middleware('can:edit')->name('pinjam.edit');
        Route::patch('/{pinjam:slug}/edit', [PeminjamanController::class, 'update'])->middleware('can:update')->name('pinjam.update');
        Route::delete('/{pinjam:slug}/delete', [PeminjamanController::class, 'destroy'])->middleware('can:delete');
    });
});


Auth::routes([
    'register' => false,
    'reset' => false
]);
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
