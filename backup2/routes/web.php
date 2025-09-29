<?php

use Illuminate\Support\Facades\Route;

// Panggil semua controller
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BookController as AdminBookController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\AdminController as RootAdminController;

// RUTE PUBLIK
Route::get('/', [BookController::class, 'index'])->name('home');
Route::get('/book/{book}', [BookController::class, 'show'])->name('book.show');

// RUTE UNTUK USER LOGIN
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/book/{book}/review', [ReviewController::class, 'store'])->name('review.store');
});

// RUTE ADMIN & ROOT
Route::prefix('admin')->middleware(['auth', 'role:admin,root'])->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('books', AdminBookController::class);
    Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
    Route::delete('/users/{user}', [AdminUserController::class, 'destroy'])->name('users.destroy');

    // RUTE KHUSUS ROOT
    Route::middleware('role:root')->group(function() {
        Route::get('/admins', [RootAdminController::class, 'index'])->name('admins.index');
        Route::post('/admins', [RootAdminController::class, 'store'])->name('admins.store');
        Route::delete('/admins/{user}', [RootAdminController::class, 'destroy'])->name('admins.destroy');
    });
});

require __DIR__.'/auth.php';