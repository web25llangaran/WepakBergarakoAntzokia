<?php


use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EkitaldiaController;


// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', function () {
    // Admin-a paneletik publikora irteten bada, saioa itxi (AuthenticatedSessionController@destroy bezala).
    if (auth()->check() && auth()->user()->rola === 'admin') {
        auth()->guard('web')->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
    }

    return app(EkitaldiaController::class)->index();
})->name('welcome');


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
// Zona de administración: solo usuarios logueados Y admin
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');


    // Aquí irán el resto de rutas de admin
});
require __DIR__.'/auth.php';



