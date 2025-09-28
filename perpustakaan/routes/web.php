<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
// Dashboard User
Route::middleware(['auth', 'checkRole:user'])->get('/dashboard', function () {
    return view('dashboard.user');
})->name('dashboard.user');

// Dashboard Admin
Route::middleware(['auth', 'checkRole:admin'])->get('/admin/dashboard', function () {
    return view('dashboard.admin');
})->name('dashboard.admin');

// Dashboard Root
Route::middleware(['auth', 'checkRole:root'])->get('/root/dashboard', function () {
    return view('dashboard.root');
})->name('dashboard.root');

require __DIR__.'/auth.php';
