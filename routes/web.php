<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CutiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IzinController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\KelolaController;
use App\Http\Controllers\PengajuanAnggaranController;
use App\Http\Controllers\RealisasiAnggaranController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\WelcomeController;
use App\Models\Pengajuan_anggaran;
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

Route::get('/', [WelcomeController::class, 'index'])->name('welcome.page');
Route::get('/gatewaytosystem', [LoginController::class, 'showLoginForm'])->name('login');
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/rekap/cuti', [DashboardController::class, 'cuti'])->name('rekap.cuti');
    Route::get('/rekap/izin', [DashboardController::class, 'izin'])->name('rekap.izin');
    Route::get('/rekap/pinjam', [DashboardController::class, 'pinjam'])->middleware('can:isAdmin')->name('rekap.pinjam');
    Route::get('/rekap/cutiPengurus', [DashboardController::class, 'cutiPengurus'])->name('rekap.cutiPengurus');
    Route::get('/rekap/pengajuan-anggaran', [DashboardController::class, 'pengajuanAnggaran'])->name('rekap.pengajuanAnggaran');
    Route::get('/rekap/realisasi-anggaran', [DashboardController::class, 'realisasiAnggaran'])->name('rekap.realisasiAnggaran');

    Route::prefix('/profil')->group(function () {
        Route::get('/', [ProfilController::class, 'show'])->name('profil.show');
    });

    Route::prefix('/anggota')->middleware('can:isAdmin')->group(function () {
        Route::get('/pengurus', [KelolaController::class, 'indexPengurus'])->name('kelola.indexPengurus');
        Route::get('/karyawan', [KelolaController::class, 'index'])->name('kelola.index');
        
        Route::get('/trashed', [KelolaController::class, 'trashed'])->name('kelola.trashed');

        Route::get('/daftarKaryawan', [KelolaController::class, 'create'])->name('kelola.daftarKaryawan');
        Route::get('/daftarPengurus', [KelolaController::class, 'createPengurus'])->name('kelola.daftarPengurus');

        Route::post('/daftar', [KelolaController::class, 'store'])->name('kelola.store');
        Route::get('/{user:nik}/edit', [KelolaController::class, 'edit'])->name('kelola.edit');
        Route::patch('/{user:nik}/edit', [KelolaController::class, 'update'])->name('kelola.update');
        Route::delete('/{user:nik}/delete', [KelolaController::class, 'destroy'])->name('kelola.delete');
        Route::get('/{user:nik}/restore', [KelolaController::class, 'restore']);
    });

    Route::prefix('/cuti')->group(function () {
        Route::get('/', [CutiController::class, 'index'])->name('cuti.index');
        Route::get('/admin', [CutiController::class, 'admin'])->middleware('can:edit')->name('cuti.admin');
        Route::get('/create', [CutiController::class, 'create'])->middleware('can:pengajuanUniversal')->name('cuti.create');
        Route::post('/create', [CutiController::class, 'store'])->name('cuti.store');
        Route::get('/export', [CutiController::class, 'export'])->middleware('can:isAdmin')->name('cuti.export');
        Route::delete('/delete-all', [CutiController::class, 'destroyAll'])->middleware('can:isAdmin')->name('cuti.delete.all');
        Route::get('/lampiran/{cuti:slug}', [CutiController::class, 'lampiran'])->name('cuti.lampiran');
        Route::get('/{cuti:slug}', [CutiController::class, 'show'])->name('cuti.show');
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
        Route::get('/{izin:slug}', [IzinController::class, 'show'])->name('izin.show');
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
        Route::get('/{pinjam:slug}', [PeminjamanController::class, 'show'])->name('pinjam.show');
        Route::get('/{pinjam:slug}/edit', [PeminjamanController::class, 'edit'])->middleware('can:edit')->name('pinjam.edit');
        Route::patch('/{pinjam:slug}/edit', [PeminjamanController::class, 'update'])->middleware('can:update')->name('pinjam.update');
        Route::delete('/{pinjam:slug}/delete', [PeminjamanController::class, 'destroy'])->middleware('can:delete');
    });

    Route::prefix('/pengajuan')->group(function () {
        Route::get('/', [PengajuanAnggaranController::class, 'index'])->name('pengajuan.index');
        Route::get('/admin', [PengajuanAnggaranController::class, 'adminkeu'])->middleware('can:adminAnggaran')->name('pengajuan.adminkeu');
        Route::get('/create', [PengajuanAnggaranController::class, 'create'])->middleware('can:pengajuanAnggaran')->name('pengajuan.create');
        Route::post('/create', [PengajuanAnggaranController::class, 'store'])->name('pengajuan.store');
        Route::get('/export', [PengajuanAnggaranController::class, 'export'])->middleware('can:isAdminkeu')->name('pengajuan.export');
        Route::delete('/delete-all', [PengajuanAnggaranController::class, 'destroyAll'])->middleware('can:isAdminkeu')->name('pengajuan.delete.all');
        Route::get('/lampiran/{pengajuan:slug}', [PengajuanAnggaranController::class, 'lampiran'])->name('pengajuan.lampiran');
        Route::get('/{pengajuan:slug}', [PengajuanAnggaranController::class, 'show'])->name('pengajuan.show');
        Route::get('/{pengajuan:slug}/edit', [PengajuanAnggaranController::class, 'edit'])->middleware('can:adminAnggaran')->name('pengajuan.edit');
        Route::get('/{pengajuan:slug}/revisi', [PengajuanAnggaranController::class, 'revisi'])->middleware('can:isBidang')->name('pengajuan.revisi');
        Route::patch('/{pengajuan:slug}/edit', [PengajuanAnggaranController::class, 'update'])->middleware('can:adminAnggaran')->name('pengajuan.update');
        Route::patch('/{pengajuan:slug}/revisi', [PengajuanAnggaranController::class, 'updatePengajuan'])->middleware('can:editPengajuan')->name('pengajuan.update.revisi');
        Route::delete('/{pengajuan:slug}/delete', [PengajuanAnggaranController::class, 'destroy'])->middleware('can:adminAnggaran');
    });

    Route::prefix('/realisasi')->group(function () {
        Route::get('/', [RealisasiAnggaranController::class, 'index'])->name('realisasi.index');
        Route::get('/admin', [RealisasiAnggaranController::class, 'adminkeu'])->middleware('can:adminAnggaran')->name('realisasi.adminkeu');
        Route::get('/create', [RealisasiAnggaranController::class, 'create'])->middleware('can:pengajuanAnggaran')->name('realisasi.create');
        Route::post('/create', [RealisasiAnggaranController::class, 'store'])->name('realisasi.store');
        Route::get('/export', [RealisasiAnggaranController::class, 'export'])->middleware('can:isAdminkeu')->name('realisasi.export');
        Route::delete('/delete-all', [RealisasiAnggaranController::class, 'destroyAll'])->middleware('can:isAdminkeu')->name('realisasi.delete.all');
        Route::get('/lampiran/{realisasi:slug}', [RealisasiAnggaranController::class, 'lampiran'])->name('realisasi.lampiran');
        Route::get('/{realisasi:slug}', [RealisasiAnggaranController::class, 'show'])->name('realisasi.show');
        Route::get('/{realisasi:slug}/edit', [RealisasiAnggaranController::class, 'edit'])->middleware('can:adminAnggaran')->name('realisasi.edit');
        Route::get('/{realisasi:slug}/revisi', [RealisasiAnggaranController::class, 'revisi'])->middleware('can:isBidang')->name('realisasi.revisi');
        Route::patch('/{realisasi:slug}/edit', [RealisasiAnggaranController::class, 'update'])->middleware('can:editRealisasi')->name('realisasi.update');
        Route::patch('/{realisasi:slug}/revisi', [RealisasiAnggaranController::class, 'updateRevisi'])->middleware('can:editRealisasi')->name('realisasi.update.revisi');
        Route::delete('/{realisasi:slug}/delete', [RealisasiAnggaranController::class, 'destroy'])->middleware('can:adminAnggaran');
    });
});


Auth::routes([
    'register' => false,
    'reset' => false,
    // 'login' => false,
]);
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
