<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ColorController;
use Illuminate\Support\Facades\Route;

// routes/admin
Route::prefix('admin')->name('admin.')->group(function () {
  Route::get('products/create', [AdminController::class, 'addProduct'])->name('products.create')->middleware('admin');
  Route::post('products/store', [AdminController::class, 'storeProduct'])->name('products.store')->middleware('admin');
  Route::get('collections/create', [AdminController::class, 'addCollection'])->name('collections.create')->middleware('admin');
  Route::get('collections/{id}', [AdminController::class, 'showCollection'])->name('collections.show')->middleware('admin');
  Route::post('collections/store', [AdminController::class, 'storeCollection'])->name('collections.store')->middleware('admin');
  Route::delete('collections/destroy/{id}', [AdminController::class, 'destroyCollection'])->name('collections.destroy')->middleware('admin');
  Route::get('collections/edit/{id}', [AdminController::class, 'editCollection'])->name('collections.edit')->middleware('admin');
  Route::post('collections/update/{id}', [AdminController::class, 'updateCollection'])->name('collections.update')->middleware('admin');
  Route::get('hero', [AdminController::class, 'editHeroImage'])
    ->name('hero.edit');
  Route::post('hero', [AdminController::class, 'updateHeroImage'])
    ->name('hero.update');
});
