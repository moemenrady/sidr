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

body { background: var(--bg-body); }

.admin-card {
    background: var(--bg-card);
    border-radius: 14px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.05);
}

.status-badge {
    padding: 6px 14px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
}

.status-pending { background: #FFF3CD; color: #856404; }
.status-processing { background: #CCE5FF; color: #004085; }
.status-completed { background: #D4EDDA; color: #155724; }
.status-cancelled { background: #F8D7DA; color: #721C24; }
</style>
@endsection

@section('content')

<div class="container py-5">

    <h2 class="mb-4" style="color: var(--text-main); font-weight:700;">
        Orders Management
    </h2>

    <div class="admin-card p-4">

        <table class="table align-middle">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Customer</th>
                    <th>Total</th>
                    <th>Payment</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>

                @forelse($orders as $order)
                <tr>
                    <td>#{{ $order->id }}</td>
                    <td>
                        {{ $order->first_name }} {{ $order->last_name }}
                        <div class="text-muted small">{{ $order->email }}</div>
                    </td>
                    <td><strong>${{ $order->total }}</strong></td>
                    <td>{{ ucfirst($order->payment_method) }}</td>
                    <td>
                        <span class="status-badge status-{{ $order->status }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </td>
                    <td>{{ $order->created_at->format('M d, Y') }}</td>
                    <td>
                        <a href="{{ route('admin.orders.show', $order->id) }}"
                           class="btn btn-sm btn-outline-secondary rounded-pill">
                            View
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted">
                        No orders found.
                    </td>
                </tr>
                @endforelse

            </tbody>
        </table>

        {{-- {{ $orders->links() }} --}}

    </div>

</div>

@endsection