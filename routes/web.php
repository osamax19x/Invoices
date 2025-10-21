<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SectionsController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RedirectAuth;


Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

use App\Http\Controllers\PhotoController;

Route::resource('invoices',InvoicesController::class);

Route::resource('sections',SectionsController::class);

Route::resource('products', ProductsController::class);

Route::get('/{page}', [AdminController::class, 'index']);


Route::middleware('auth')->group(function () {
    Route::get('/{page}', [AdminController::class, 'index']);
});

require __DIR__.'/auth.php';
