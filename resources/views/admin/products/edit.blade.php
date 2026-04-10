@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2>Edit Product</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.products.update', $product->id) }}" 
          method="POST" 
          enctype="multipart/form-data">

        @csrf
        @method('PUT')

        {{-- اسم المنتج --}}
        <input type="text"
               name="name"
               value="{{ old('name', $product->name) }}"
               placeholder="اسم المنتج"
               required>

        {{-- السعر --}}
        <input type="number"
               name="price"
               value="{{ old('price', $product->price) }}"
               placeholder="السعر"
               required>

        {{-- الصورة الحالية --}}
        <div>
            <p>الصورة الحالية:</p>
            <img src="{{ asset('storage/' . $product->image) }}"
                 width="100">
        </div>

        {{-- تغيير الصورة --}}
        <input type="file" name="image">

        {{-- hover image --}}
        <div>
            <p>Hover Image الحالية:</p>
            @if($product->hover_image)
                <img src="{{ asset('products/' . $product->hover_image) }}"
                     width="100">
            @endif
        </div>

        <input type="file" name="hover_image">

        {{-- Sold Out --}}
        <label>
            <input type="checkbox"
                   name="sold_out"
                   value="1"
                   {{ $product->sold_out ? 'checked' : '' }}>
            Sold Out
        </label>

        {{-- Collection --}}
        <select name="collection_id">
            @foreach ($collections as $collection)
                <option value="{{ $collection->id }}"
                    {{ $collection->id == $product->collection_id ? 'selected' : '' }}>
                    {{ $collection->name }}
                </option>
            @endforeach
        </select>

        <button type="submit">تحديث المنتج</button>
    </form>
</div>
@endsection