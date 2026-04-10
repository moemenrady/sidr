<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;

  Route::get('/checkout', [CheckoutController::class, 'show'])->name('checkout.show');
  Route::post('/checkout', [CheckoutController::class, 'submit'])->name('checkout.submit');
  Route::get('/checkout/success/{order}', fn($order) => "Order #$order created");
  Route::get('/checkout-success', [CheckoutController::class, 'success'])->name('checkout.success');

