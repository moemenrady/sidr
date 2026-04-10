@extends('layouts.admin')

@section('content')
    <div class="container mt-4">
        <h2>Add New </h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif



        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <input type="text" name="name" placeholder="اسم المنتج" required>

            <input type="number" name="price" placeholder="السعر" required>

            <input type="file" name="image" required>

            <select name="collection_id">
                @foreach ($collections as $collection)
                    <option value="{{ $collection->id }}">
                        {{ $collection->name }}
                    </option>
                @endforeach
            </select>

           

            <button type="submit">حفظ المنتج</button>
        </form>
    </div>
@endsection
