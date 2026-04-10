<?php

namespace App\Http\Controllers;

use App\Helpers\ImageHelper;
use App\Models\BannarItem;
use App\Models\Collection;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function addProduct()
    {
        $collections = Collection::all();
        return view('admin.products.create', compact('collections'));
    }

    public function storeProduct(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'image' => 'required|image',
        ]);

        $imagePath = ImageHelper::upload($request->file('image'), 'products');

        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'image' => $imagePath,
            'hover_image' => $imagePath,
            'collection_id' => $request->collection_id,
        ]);

        return back()->with('success', 'Added product successfully');
    }

    public function addCollection()
    {
        $collections = Collection::latest()->get();
        return view('admin.collections.create', compact('collections'));
    }



    public function storeCollection(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'required|image',
        ]);

        $imagePath = ImageHelper::upload($request->file('image'), 'collections');

        $collection = Collection::create([
            'name' => $request->name,
        ]);

        BannarItem::create([
            'image' => $imagePath,
            'collection_id' => $collection->id,
        ]);

        return redirect()
            ->route('admin.collections.create')
            ->with('success', 'Added collection successfully');
    }
    public function showCollection($id)
    {
        $collection = Collection::findOrFail($id);
        return view('admin.collections.show', compact('collection'));
    }

    public function editCollection($id)
    {
        $collection = Collection::with('bannarItem')->findOrFail($id);
        return view('admin.collections.edit', compact('collection'));
    }
    public function updateCollection(Request $request, $id)
{
    $request->validate([
        'name' => 'required',
        'image' => 'nullable|image',
    ]);

    $collection = Collection::findOrFail($id);

    $collection->update([
        'name' => $request->name,
    ]);

    $banner = $collection->bannarItem;

    if ($request->hasFile('image')) {
        if ($banner) {
            $newImage = ImageHelper::replace(
                $banner->image,
                $request->file('image'),
                'collections'
            );

            $banner->update([
                'image' => $newImage
            ]);
        } else {
            BannarItem::create([
                'image' => ImageHelper::upload($request->file('image'), 'collections'),
                'collection_id' => $collection->id,
            ]);
        }
    }

    return redirect()
        ->route('admin.collections.create')
        ->with('success', 'Collection updated successfully');
}
    public function  indexOrders()
    {
        $orders = Order::with("items")->get();
        return view('admin.orders.index', compact('orders'));
    }


    public function editHeroImage()
    {
        return view('admin.hero.edit');
    }

    public function updateHeroImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:png,jpg,jpeg,webp|max:4096',
        ]);

        $path = public_path('home');
        $fileName = 'base_image.png';

        if (!file_exists($path)) {
            mkdir($path, 0755, true);
        }

        $request->file('image')->move($path, $fileName);

        return back()->with('success', 'Hero image updated successfully');
    }
}
