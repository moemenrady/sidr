<?php

use App\Http\Controllers\CollectionController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class,'create']);
Route::get('collection/{id}', [CollectionController::class,'collection'])->name('collection.show');
Route::get('search/', [HomeController::class,'search'])->name('search');
Route::get('/search/results', [HomeController::class, 'results'])->name('search.results');


// استدعاء ملف الـ product routes

require __DIR__.'/home.php';
require __DIR__.'/products.php';
require __DIR__.'/contact.php';
require __DIR__.'/color.php';
require __DIR__.'/admin.php';
require __DIR__.'/cart.php';
require __DIR__.'/checkout.php';
require __DIR__.'/user.php';
require __DIR__.'/auth.php';
require __DIR__.'/offers.php';
require __DIR__.'/orders.php';


