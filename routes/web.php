<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/client/dashboard', [ClientController::class, 'index'])->middleware(['auth', 'verified', 'rolemanager:coustomer'])->name('dashboard');
Route::get('/user/dashboard', [UserController::class, 'index'])->middleware(['auth', 'verified', 'rolemanager:user'])->name('user');
Route::get('/admin/dashboard', [AdminController::class, 'index'])->middleware(['auth', 'verified', 'rolemanager:admin'])->name('admin');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
