<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
  public function show(Request $request)
  {
    $cart = app(CartController::class)->indexApi($request)->getData();
    return view('checkout.index', compact('cart'));
  }

  public function submit(Request $request)
  {
    $request->validate([
      'first_name' => 'required',
      'last_name' => 'required',
      'phone' => 'required',
      'address' => 'required',
      'city' => 'required',
      'governorate' => 'required',
    ]);

    $cart = Cart::where('user_id', optional($request->user())->id)
      ->orWhere('guest_id', $request->cookie('guest_id'))
      ->with('items.product')
      ->first();

    if (!$cart || $cart->items->isEmpty()) {
      return back()->withErrors('Cart is empty');
    }

    $order = Order::create([
      'user_id' => optional($request->user())->id,
      'email' => $request->email,
      'first_name' => $request->first_name,
      'last_name' => $request->last_name,
      'phone' => $request->phone,
      'address' => $request->address,
      'apartment' => $request->apartment,
      'city' => $request->city,
      'governorate' => $request->governorate,
      'postal_code' => $request->postal_code,
      'payment_method' => $request->payment_method,
      'total' => $cart->total(),
    ]);

    foreach ($cart->items as $item) {
      $order->items()->create([
        'product_id' => $item->product_id,
        'name' => $item->product->name,
        'price' => $item->price_snapshot,
        'quantity' => $item->quantity,
        'options' => $item->options,
      ]);
    }

    $cart->items()->delete();

    return redirect()
      ->route('checkout.success', $order->id)
      ->with([
        'name' => $request->first_name,
        'phone' => $request->phone,
      ]);
  }
  public function success(Request $request)
  {
    $name = session('name');   // جايه من with()
    $phone = session('phone');

    return view("checkout.success", compact("name", "phone"));
  }



}
