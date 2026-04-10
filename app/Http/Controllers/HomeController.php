<?php

namespace App\Http\Controllers;

use App\Models\BannarItem;
use App\Models\Collection;
use App\Models\Offer;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
  public function lunching()
  {
    return view("lunching_soon");
  }
  public function index()
  {
    $bannarItems = BannarItem::with("collection")->get();
    $collections = Collection::with('products')->get();
    $offers = Offer::where('is_active', true)
      ->where(function ($query) {
        $query->whereNull('expires_at')->orWhere('expires_at', '>', now());
      })->get();

    return view('home.index', compact("bannarItems", "collections", "offers"));
  }

  public function search()
  {
    return view('search.index');
  }

  public function results(Request $request)
  {
    $query = $request->q;

    $products = Product::where('name', 'like', "%{$query}%")->get();

    $collections = Collection::where('name', 'like', "%{$query}%")->get();

    $offers = Offer::where('title', 'like', "%{$query}%")
      ->orWhere('sub_title', 'like', "%{$query}%")
      ->get();

    return response()->json([
      'products' => $products,
      'collections' => $collections,
      'offers' => $offers
    ]);
  }
}
