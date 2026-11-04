<?php

use App\Http\Controllers\EkitaldiaController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SarreraController;
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
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
    // Route::get('/sarrera/sortu', [SarreraController::class, 'create'])->name('sarrera.sortu'); 
    Route::post('', [SarreraController::class, 'store'])->name('sarrera.store');

    // Aquí irán el resto de rutas de admin
});
require __DIR__.'/auth.php';
