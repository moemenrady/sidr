@extends('layouts.admin')

@section('style')
<style>
body { background: var(--bg-body); }

.section-card {
    background: var(--bg-card);
    border-radius: 14px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.05);
}
</style>
@endsection

@section('content')

<div class="container py-5">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Order #{{ $order->id }}</h3>

        <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
            @csrf
            @method('PUT')

            <select name="status" onchange="this.form.submit()" class="form-select rounded-pill">
                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="deposited" {{ $order->status == 'deposited' ? 'selected' : '' }}>Deposited</option>
                <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
        </form>
    </div>


    <div class="row g-4">

        {{-- Customer Info --}}
        <div class="col-lg-4">
            <div class="section-card p-4">
                <h5 class="mb-3">Customer Info</h5>

                <p><strong>Name:</strong> {{ $order->first_name }} {{ $order->last_name }}</p>
                <p><strong>Email:</strong> {{ $order->email }}</p>
                <p><strong>Phone:</strong> {{ $order->phone }}</p>

                <hr>

                <p><strong>Address:</strong></p>
                <p class="text-muted small">
                    {{ $order->address }},
                    {{ $order->apartment }},
                    {{ $order->city }},
                    {{ $order->country }},
                    {{ $order->postal_code }}
                </p>

                <p><strong>Payment:</strong> {{ ucfirst($order->payment_method) }}</p>
            </div>
        </div>


        {{-- Order Items --}}
        <div class="col-lg-8">
            <div class="section-card p-4">

                <h5 class="mb-4">Order Items</h5>

                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Qty</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($order->items as $item)
                        <tr>
                            <td>
                                {{ $item->name }}
                                @if($item->options)
                                    <div class="text-muted small">
                                        @foreach($item->options as $key => $value)
                                            {{ $key }}: {{ $value }} <br>
                                        @endforeach
                                    </div>
                                @endif
                            </td>
                            <td>${{ $item->price }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>
                                ${{ $item->price * $item->quantity }}
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>

                <hr>

                <div class="text-end">
                    <h5>Total: ${{ $order->total }}</h5>
                </div>

            </div>
        </div>

    </div>

</div>

@endsection