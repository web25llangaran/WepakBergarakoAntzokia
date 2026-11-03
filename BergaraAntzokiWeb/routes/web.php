<?php

use App\Http\Controllers\EkitaldiaController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/', [EkitaldiaController::class, 'index'])->name('welcome');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
// Zona de administración: solo usuarios logueados Y admin
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Route::get('/', function () {
    //     return view('admin.admin');
    // })->name('dashboard');
    Route::GET('/', [AdminController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

    // Aquí irán el resto de rutas de admin
});
require __DIR__.'/auth.php';
