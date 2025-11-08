<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PertanianController;
use App\Http\Controllers\Admin\PariwisataController;
use App\Http\Controllers\Admin\UMKMController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\GaleriController;

// Redirect /admin/login to main login
Route::get('/admin/login', function () {
    return redirect()->route('login');
});

// Admin routes - all require authentication
Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    
    // CRUD Resources
    Route::resource('admin/pertanian', PertanianController::class)->names('admin.pertanian');
    Route::resource('admin/pariwisata', PariwisataController::class)->names('admin.pariwisata');
    Route::resource('admin/umkm', UMKMController::class)->names('admin.umkm');
    Route::resource('admin/galeri', GaleriController::class)->names('admin.galeri');
    
    // Settings
    Route::get('admin/settings/tentang-kami', [SettingController::class, 'tentangKami'])->name('admin.settings.tentang-kami');
    Route::post('admin/settings/tentang-kami', [SettingController::class, 'updateTentangKami'])->name('admin.settings.tentang-kami.update');
    Route::get('admin/settings/kontak', [SettingController::class, 'kontak'])->name('admin.settings.kontak');
    Route::post('admin/settings/kontak', [SettingController::class, 'updateKontak'])->name('admin.settings.kontak.update');
});
