<?php

use \App\Http\Controllers\HomeController;
use \App\Http\Controllers\VehicleController; // Remplacez PropertyController par VehicleController
use App\Http\Controllers\PictureController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VehicleImageController; // Remplacez PictureController par VehicleImageController
use Illuminate\Support\Facades\Route;


/* Route pour la page d'accueil */
Route::get('/', [HomeController::class, 'index']);

/* Route pour la page de tableau de bord */
Route::get('/dashboard', function () {
    return redirect()->intended(route('admin.vehicle.index'));
})->middleware(['auth', 'verified'])->name('dashboard');

/* Routes pour les utilisateurs authentifiés */
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/* Routes pour les véhicules */
$idRegex = '[0-9]+';
$slugRegex = '[0-9a-z\-]+';

Route::get('/vehicles', [VehicleController::class, 'index'])->name('vehicle.index');
Route::get('/vehicles/{slug}{vehicle}', [VehicleController::class, 'show'])->name('vehicle.show')->where([
    'vehicle' => $idRegex,
    'slug' => $slugRegex
]);

Route::post('/vehicles/{vehicle}/contact', [VehicleController::class, 'contact'])->name('vehicle.contact')->where([
    'vehicle' => $idRegex
]);

/* Routes d'administration */
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::resource('vehicle', \App\Http\Controllers\Admin\VehicleController::class)->except(['show']);
    Route::resource('option', \App\Http\Controllers\Admin\OptionController::class)->except(['show']);

    Route::get('vehicle/{vehicleId}/upload', [VehicleImageController::class, 'index'])->name('vehicle.upload');
    Route::post('vehicle/{vehicleId}/upload', [VehicleImageController::class, 'store'])->name('vehicle.upload.store');
    Route::delete('vehicle/image/{vehicleImageId}', [VehicleImageController::class, 'destroy'])->name('vehicle.image.destroy');
});

require __DIR__.'/auth.php';