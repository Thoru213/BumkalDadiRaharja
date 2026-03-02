<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\CakupanController;


require __DIR__.'/auth.php';
require __DIR__.'/admin.php';

Route::get('/', [PageController::class, 'index'])->name('home');

Route::get('/cakupan/{page}', [CakupanController::class, 'show'])
    ->name('cakupan.show')
    ->where('page', '[a-z0-9\-]+');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});