@extends('layouts.admin')

@section('style')
<style>
    :root {
        --primary: #357D73;
        --bg-body: #F4F7F6;
        --bg-card: #ffffff;
        --accent-orange: #E76F51;
        --text-main: #264653;
        --soft-grey: #DCE8E6;
    }

    body {
        background: var(--bg-body);
    }

    .admin-card {
        background: var(--bg-card);
        border-radius: 14px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.05);
        transition: .3s;
    }

    .admin-card:hover {
        transform: translateY(-4px);
    }

    .btn-primary-custom {
        background: var(--primary);
        color: white;
        transition: .3s;
    }

    .btn-primary-custom:hover {
        background: #2a645c;
    }

    .badge-count {
        background: var(--soft-grey);
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 600;
        color: var(--text-main);
    }
</style>
@endsection

@section('content')

<div class="container py-5">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 style="color: var(--text-main); font-weight:700;">
                {{ $collection->name }}
            </h2>

            <span class="badge-count">
                {{ $collection->products->count() }} Products
            </span>
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('admin.products.create', ['collection_id' => $collection->id]) }}"
               class="btn btn-primary-custom rounded-pill px-4">
                + Add Product
            </a>

            <a href="{{ route('admin.collections.create') }}"
               class="btn btn-outline-secondary rounded-pill">
                Back
            </a>
        </div>
    </div>


    {{-- Products Grid --}}
    <div class="row g-4">

        @forelse($collection->products as $product)

            <div class="col-md-6 col-lg-4">
                <div class="admin-card p-4 h-100">

                    {{-- Product Image --}}
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}"
                             class="img-fluid rounded mb-3"
                             style="height:200px; object-fit:cover; width:100%;">
                    @endif

                    {{-- Product Info --}}
                    <h5 style="color: var(--text-main); font-weight:600;">
                        {{ $product->name }}
                    </h5>

                    <div class="text-muted small mb-2">
                        Price: ${{ $product->price }}
                    </div>

                    <div class="text-muted small mb-3">
                        Stock: {{ $product->stock ?? 0 }}
                    </div>

                    {{-- Actions --}}
                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.products.edit', $product->id) }}"
                           class="btn btn-sm btn-outline-primary rounded-pill">
                            Edit
                        </a>

                        <form action="{{ route('admin.products.destroy', $product->id) }}"
                              method="POST"
                              onsubmit="return confirm('Delete this product?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="btn btn-sm btn-outline-danger rounded-pill">
                                Delete
                            </button>
                        </form>
                    </div>

                </div>
            </div>

        @empty

            {{-- Empty State --}}
            <div class="col-12">
                <div class="admin-card p-5 text-center">
                    <h5 class="text-muted mb-3">
                        No products inside this collection yet.
                    </h5>

                    <a href="{{ route('admin.products.create', ['collection_id' => $collection->id]) }}"
                       class="btn btn-primary-custom rounded-pill px-4">
                        Add First Product
                    </a>
                </div>
            </div>

        @endforelse

    </div>

</div>

@endsection