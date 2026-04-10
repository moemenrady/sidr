@extends('layouts.app')

@section('title', 'Checkout')

@section('style')
    <style>
        .checkout-wrapper {
            display: grid;
            grid-template-columns: 1.2fr .8fr;
            gap: 32px;
            max-width: 1200px;
            margin: auto;
            padding: 16px;
        }

        /* FORM */
        .checkout-form {
            background: #fff;
            padding: 24px;
            border-radius: 16px;
            box-shadow: 0 4px 16px #00000010;
        }

        .checkout-form h2 {
            font-size: 18px;
            margin: 20px 0 10px;
            color: #1a4139;
        }

        .checkout-form input {
            width: 100%;
            padding: 12px 14px;
            border-radius: 8px;
            border: 1px solid #ddd;
            margin-bottom: 12px;
            font-size: 15px;
        }

        .checkout-form input:focus {
            outline: none;
            border-color: #1a4139;
        }

        .payment-options {
            display: flex;
            gap: 20px;
            margin-top: 10px;
        }

        .payment-options label {
            display: flex;
            align-items: center;
            gap: 6px;
            font-weight: 600;
        }

        .btn-primary {
            width: 100%;
            padding: 14px;
            background: #1a4139;
            color: white;
            border: 0;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            margin-top: 20px;
        }

        .btn-primary:hover {
            opacity: .9;
        }

        /* ORDER SUMMARY */
        .order-summary {
            background: #fff;
            padding: 20px;
            border-radius: 16px;
            box-shadow: 0 4px 16px #00000010;
            height: fit-content;
        }

        .order-summary h3 {
            font-size: 18px;
            margin-bottom: 16px;
            color: #1a4139;
        }

        .order-item {
            display: flex;
            gap: 12px;
            margin-bottom: 16px;
            align-items: center;
        }

        .order-item img {
            width: 64px;
            height: 64px;
            border-radius: 10px;
            object-fit: cover;
            background: #f4f4f4;
        }

        .order-item strong {
            font-size: 14px;
        }

        .item-price {
            font-weight: 700;
            color: #1a4139;
            font-size: 14px;
        }

        .total-line {
            margin-top: 20px;
            padding-top: 16px;
            border-top: 1px solid #eee;
            font-size: 18px;
            font-weight: 800;
            color: #1a4139;
            display: flex;
            justify-content: space-between;
        }

        /* MOBILE */
        @media (max-width: 768px) {
            .checkout-wrapper {
                grid-template-columns: 1fr;
            }

            .checkout-form {
                order: 1;
            }

            .order-summary {
                order: 2;
            }
        }
    </style>
@endsection
@section('content')

    <div class="checkout-wrapper">

        <!-- FORM -->
        <form method="POST" action="{{ route('checkout.submit') }}" class="checkout-form">
            @csrf

            <h2>Contact</h2>
            <input name="email" placeholder="Email or phone" required>

            <h2>Delivery</h2>
            <input name="first_name" placeholder="First name" required>
            <input name="last_name" placeholder="Last name" required>
            <input name="address" placeholder="Address" required>
            <input name="apartment" placeholder="Apartment (optional)">
            <input name="city" placeholder="City" required>
            <input name="governorate" placeholder="Governorate" required>
            <input name="postal_code" placeholder="Postal Code">
            <input name="phone" placeholder="Phone (WhatsApp)" required>

            <button class="btn-primary" type="submit">
                Complete Order
            </button>
        </form>

        <!-- SUMMARY -->
        <div class="order-summary">
            <h3>Your Order</h3>

            @foreach ($cart->items as $item)
                <div class="order-item">
                    <img src="{{ asset('storage/' . $item->product->image) }}">
                    <div style="flex:1">
                        <strong>{{ $item->product->name }}</strong><br>
                        <small>Qty: {{ $item->quantity }}</small>
                    </div>
                    <div class="item-price">
                        EGP {{ $item->price_snapshot * $item->quantity }}
                    </div>
                </div>
            @endforeach

            <div class="total-line">
                <span>Total</span>
                <span>EGP {{ $cart->total }}</span>
            </div>
        </div>

    </div>

@endsection
