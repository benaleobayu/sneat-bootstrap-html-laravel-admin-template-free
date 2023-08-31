<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DayController;
use App\Http\Controllers\FlowerController;
use App\Http\Controllers\KurirController;
use App\Http\Controllers\LanggananController;
use App\Http\Controllers\MyprofileController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\RegencyController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Auth::routes();

Route::middleware('auth')->group( function () {
    $controller_path = 'App\Http\Controllers';
    
    Route::get('/', [LanggananController::class, 'index']);
   
    Route::resource('/myprofile', MyprofileController::class);

    /* Data Center */
    Route::resource('/pelanggan', PelangganController::class);
    Route::resource('/langganan', LanggananController::class);
    Route::resource('/kurir', KurirController::class);
    
    /* Pemesanan */
    Route::resource('/pesanan', PesananController::class);
    Route::resource('/pembayaran', LanggananController::class);

    Route::get('/pesanan/h/create', [DayController::class, 'create'])->name('Create.Hari');
    Route::get('/pesanan/h/{slug}/edit', [DayController::class, 'edit'])->name('Edit.Hari');
    Route::put('/pesanan/h/{slug}', [DayController::class, 'update'])->name('Update.Hari');
    Route::get('/pesanan/h/{slug}', [DayController::class, 'destroy'])->name('Delete.Hari');

    Route::get('/pesanan/{slug}/invoice', [PesananController::class, 'invoice'])->name('Invoice');

    /* Settings */
    Route::resource('/admin', UserController::class);
    Route::resource('/roles', RoleController::class);
    Route::resource('/setting/roles', RoleController::class);
    Route::resource('/bunga', FlowerController::class);
    Route::resource('/daerah', RegencyController::class);
    Route::resource('/hari', DayController::class)->parameters(['hari' => 'slug']);
    
    Route::get('/logout', [LoginController::class, 'logout']);
});