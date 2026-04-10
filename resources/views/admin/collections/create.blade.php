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
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
            transition: .3s;
        }

        .admin-card:hover {
            transform: translateY(-3px);
        }

        .btn-primary-custom {
            background: var(--primary);
            color: #fff;
            transition: .3s;
        }

        .btn-primary-custom:hover {
            background: #2a645c;
        }

        .collection-badge {
            background: var(--soft-grey);
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            color: var(--text-main);
        }
    </style>
@endsection

@section('content')
    <div class="container py-5">

        {{-- Page Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 style="color: var(--text-main); font-weight:700;">
                Manage Collections
            </h2>
        </div>

        {{-- Success Message --}}
        @if (session('success'))
            <div class="alert alert-success rounded-3 shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        <div class="row g-4">

            {{-- Add Collection Form --}}
            <div class="col-lg-4">
                <div class="admin-card p-4">
                    <h5 class="mb-4" style="color: var(--primary); font-weight:600;">
                        Add New Collection
                    </h5>

                    <form action="{{ route('admin.collections.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Collection Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter collection name"
                                required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Collection Image</label>
                            <input type="file" name="image" class="form-control" accept="image/*" required>
                        </div>
                        <button type="submit" class="btn btn-primary-custom w-100 rounded-pill">
                            Add Collection
                        </button>
                    </form>
                </div>
            </div>


            {{-- Collections List --}}
            <div class="col-lg-8">
                <div class="row g-4">

                    @forelse($collections as $collection)
                        <div class="col-md-6">
                            <div class="admin-card p-4 h-100">
                                @if ($collection->bannarItem && $collection->bannarItem->image)
                                    <img src="{{ asset('storage/' . $collection->bannarItem->image) }}"
                                        class="w-100 mb-3 rounded" style="height:180px; object-fit:cover;">
                                @endif
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 style="color: var(--text-main); font-weight:600;">
                                        {{ $collection->name }}
                                    </h5>

                                    <span class="collection-badge">
                                        {{ $collection->products->count() }} Products
                                    </span>
                                </div>

                                <div class="text-muted small mb-3">
                                    Created: {{ $collection->created_at->format('M d, Y') }}
                                </div>

                                <div class="d-flex gap-2">
                                    <a href="{{ route('admin.collections.show', $collection->id) }}"
                                        class="btn btn-sm btn-outline-secondary rounded-pill">
                                        View
                                    </a>

                                    <a href="{{ route('admin.collections.edit', $collection->id) }}"
                                        class="btn btn-sm btn-outline-primary rounded-pill">
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.collections.destroy', $collection->id) }}" method="POST"
                                        onsubmit="return confirm('Delete this collection?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="admin-card p-5 text-center">
                                <h5 class="text-muted">
                                    No collections added yet.
                                </h5>
                            </div>
                        </div>
                    @endforelse

                </div>
            </div>

        </div>
    </div>
@endsection
