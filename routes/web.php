<?php

//use \App\Http\Controllers\Admin\OptionController;
use \App\Http\Controllers\PropertyController;
use \App\Http\Controllers\HomeController;
use App\Http\Controllers\PictureController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;





/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/dashboard', function () {
    return redirect()->intended(route('admin.property.index'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



$idRegex = '[0-9]+';
$slugRegex = '[0-9a-z\-]+';

Route::get('/', [HomeController::class, 'index']);
Route::get('/biens', [PropertyController::class, 'index'])->name('property.index');
Route::get('/biens/{slug}{property}', [PropertyController::class, 'show'])->name('property.show')->where([
    'property' => $idRegex,
    'slug' => $slugRegex
]);

Route::post('/biens/{property}/contact', [\App\Http\Controllers\PropertyController::class, 'contact'])->name('property.contact')->where([
    'property' => $idRegex
]);

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::resource('property', \App\Http\Controllers\Admin\PropertyController::class)->except(['show']);
    Route::resource('option', \App\Http\Controllers\Admin\OptionController::class)->except(['show']);

    Route::get('property/{propertyId}/upload', [PictureController::class, 'index'])->name('property.upload');
    Route::post('property/{propertyId}/upload', [PictureController::class, 'store'])->name('property.upload.store');
    Route::delete('property/image/{propertyImageId}', [PictureController::class, 'destroy'])->name('property.image.destroy');
});


require __DIR__.'/auth.php';