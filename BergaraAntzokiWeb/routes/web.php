<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\EkitaldiaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SarreraController;
use Illuminate\Support\Facades\Route;

Route::get('/', [EkitaldiaController::class, 'index'])->name('welcome');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
// Hau Admin bezala logeatu dienak ein dezakete:
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
    // Sarreren CRUD-a
    Route::get('/sarrerak/sortu', [SarreraController::class, 'create'])->name('sarrera.sortu');
    Route::post('/sarrerak', [SarreraController::class, 'store'])->name('sarrera.store');
    Route::get('/sarrerak/{sarrera}', [SarreraController::class, 'show'])->name('sarrera.show');
    Route::get('/sarrerak/{sarrera}/editatu', [SarreraController::class, 'edit'])->name('sarrera.edit');
    Route::put('/sarrerak/{sarrera}', [SarreraController::class, 'update'])->name('sarrera.update');
    Route::delete('/sarrerak/{sarrera}', [SarreraController::class, 'destroy'])->name('sarrera.destroy');

    // Aquí irán el resto de rutas de admin
});
require __DIR__.'/auth.php';
