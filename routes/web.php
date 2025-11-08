<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\CakupanController;

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/
// Check if auth.php exists, if not we'll handle it gracefully
if (file_exists(__DIR__.'/auth.php')) {
    require __DIR__.'/auth.php';
}

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
require __DIR__.'/admin.php';

/*
|--------------------------------------------------------------------------
| Public Frontend Routes
|--------------------------------------------------------------------------
*/

// Homepage
Route::get('/', [PageController::class, 'index'])->name('home');

// Cakupan pages
Route::get('/cakupan/{page}', [CakupanController::class, 'show'])
    ->name('cakupan.show')
    ->where('page', '[a-z0-9\-]+'); // Only allow lowercase, numbers, and hyphens

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

/*
|--------------------------------------------------------------------------
| Backward Compatibility Redirects (Optional - Remove after migration)
|--------------------------------------------------------------------------
*/

// Redirect old .html URLs to clean URLs
Route::get('/cakupan/{page}.html', function ($page) {
    return redirect('/cakupan/' . $page, 301);
})->where('page', '.*');

Route::get('/{page}.html', function ($page) {
    return redirect('/' . $page, 301);
})->where('page', '.*');
