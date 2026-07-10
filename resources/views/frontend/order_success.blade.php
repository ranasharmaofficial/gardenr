@extends('frontend.layouts.master')
@section('title') Order Confirmed @endsection

@section('content')
@php
    $subtotal = $order->total_order_value - $order->shipping_charge;
    $itemCount = $order->orderDetails->sum('quantity');
@endphp

<style>
    .success-page { background: #f4f8f3; padding: 42px 0 58px; }
    .success-shell { max-width: 1180px; }
    .success-card { background: #fff; border: 1px solid #e3eadf; border-radius: 10px; box-shadow: 0 12px 30px rgba(30, 74, 47, .08); }
    .success-hero { overflow: hidden; padding: 0; }
    .success-hero-top { background: linear-gradient(135deg, #0f9f6a, #087346); color: #fff; padding: 34px 38px; }
    .success-icon { align-items: center; background: rgba(255,255,255,.18); border: 1px solid rgba(255,255,255,.35); border-radius: 50%; display: flex; font-size: 34px; height: 78px; justify-content: center; margin-bottom: 18px; width: 78px; }
    .success-title { color: #fff; font-size: 34px; font-weight: 900; margin: 0; }
    .success-copy { color: rgba(255,255,255,.86); font-size: 16px; margin: 10px 0 0; max-width: 620px; }
    .success-hero-bottom { display: grid; gap: 18px; grid-template-columns: 1.4fr 1fr 1fr; padding: 22px 38px; }
    .success-stat { background: #f7fbf5; border: 1px solid #e5eee0; border-radius: 8px; padding: 16px 18px; }
    .success-stat span { color: #6b7788; display: block; font-size: 12px; font-weight: 800; letter-spacing: .08em; margin-bottom: 7px; text-transform: uppercase; }
    .success-stat strong { color: #12233b; display: block; font-size: 18px; font-weight: 900; word-break: break-word; }
    .success-stat .green { color: #0f9f6a; }
    .success-section { margin-top: 24px; padding: 28px 30px; }
    .section-head { align-items: center; border-bottom: 1px solid #e7efe3; display: flex; justify-content: space-between; margin-bottom: 18px; padding-bottom: 16px; }
    .section-head h2 { color: #12233b; font-size: 24px; font-weight: 900; margin: 0; }
    .status-pill { background: #fff4cf; border-radius: 999px; color: #926000; font-size: 12px; font-weight: 900; padding: 7px 12px; text-transform: uppercase; }
    .success-items { display: grid; gap: 12px; }
    .success-item { align-items: center; border: 1px solid #eef3eb; border-radius: 8px; display: grid; gap: 14px; grid-template-columns: 68px 1fr auto; padding: 14px; }
    .success-item img { border: 1px solid #e6eee1; border-radius: 8px; height: 68px; object-fit: cover; width: 68px; }
    .success-item h3 { color: #14233a; font-size: 15px; font-weight: 900; line-height: 1.35; margin: 0 0 6px; }
    .success-item p { color: #69778a; font-size: 13px; margin: 0; }
    .success-item-price { color: #12233b; font-size: 17px; font-weight: 900; white-space: nowrap; }
    .success-grid { display: grid; gap: 24px; grid-template-columns: 1fr 360px; margin-top: 24px; }
    .info-grid { display: grid; gap: 18px; grid-template-columns: 1fr 1fr; }
    .info-box { background: #fff; border: 1px solid #e3eadf; border-radius: 10px; box-shadow: 0 12px 30px rgba(30, 74, 47, .06); padding: 24px; }
    .info-box h3 { color: #12233b; font-size: 18px; font-weight: 900; margin: 0 0 14px; }
    .info-box p { color: #536276; line-height: 1.75; margin: 0; }
    .total-box { background: #fff; border: 1px solid #e3eadf; border-radius: 10px; box-shadow: 0 12px 30px rgba(30, 74, 47, .06); padding: 24px; }
    .total-row { align-items: center; color: #536276; display: flex; justify-content: space-between; margin-bottom: 14px; }
    .total-row strong { color: #12233b; }
    .grand-total { border-top: 1px solid #e4ece0; margin-top: 14px; padding-top: 18px; }
    .grand-total span { color: #12233b; font-size: 18px; font-weight: 900; }
    .grand-total strong { color: #0f9f6a; font-size: 26px; font-weight: 900; }
    .success-actions { display: flex; flex-wrap: wrap; gap: 12px; justify-content: center; margin-top: 28px; }
    .success-btn { align-items: center; border-radius: 8px; display: inline-flex; font-weight: 900; justify-content: center; min-height: 48px; padding: 12px 24px; text-decoration: none; text-transform: uppercase; }
    .success-btn-primary { background: linear-gradient(135deg, #13b77b, #078a59); color: #fff; box-shadow: 0 12px 24px rgba(15, 159, 106, .22); }
    .success-btn-primary:hover { color: #fff; }
    .success-btn-light { background: #fff; border: 1px solid #ccd8c8; color: #12233b; }
    .success-btn-light:hover { color: #12233b; }
    @media (max-width: 991px) {
        .success-hero-bottom, .success-grid, .info-grid { grid-template-columns: 1fr; }
    }
    @media (max-width: 575px) {
        .success-page { padding-top: 24px; }
        .success-hero-top, .success-hero-bottom, .success-section { padding-left: 18px; padding-right: 18px; }
        .success-title { font-size: 28px; }
        .success-item { grid-template-columns: 58px 1fr; }
        .success-item img { height: 58px; width: 58px; }
        .success-item-price { grid-column: 2; }
    }
</style>

<main class="main success-page">
    <div class="container success-shell">
        <div class="success-card success-hero">
            <div class="success-hero-top">
                <div class="success-icon">&#10003;</div>
                <h1 class="success-title">Thank you, your order is confirmed.</h1>
                <p class="success-copy">We have received your order and the team will start processing it shortly. Keep the order code handy for support.</p>
            </div>

            <div class="success-hero-bottom">
                <div class="success-stat">
                    <span>Order Code</span>
                    <strong class="green">{{ $order->order_code }}</strong>
                </div>
                <div class="success-stat">
                    <span>Order Date</span>
                    <strong>{{ $order->created_at->format('d M Y, h:i A') }}</strong>
                </div>
                <div class="success-stat">
                    <span>Payment</span>
                    <strong>{{ $order->payment_method }}</strong>
                </div>
            </div>
        </div>

        <div class="success-card success-section">
            <div class="section-head">
                <h2>Order Summary</h2>
                <span class="status-pill">{{ ucfirst($order->status) }}</span>
            </div>

            <div class="success-items">
                @foreach($order->orderDetails as $detail)
                    <div class="success-item">
                        @if($detail->product && $detail->product->thumbnail)
                            <img src="{{ static_asset($detail->product->thumbnail) }}" alt="{{ $detail->product->name }}">
                        @else
                            <img src="{{ static_asset('assets/assets_web/images/placeholder.png') }}" alt="Product">
                        @endif
                        <div>
                            <h3>{{ $detail->product->name ?? 'Product' }}</h3>
                            <p>&#8377;{{ number_format($detail->price, 2) }} x {{ $detail->quantity }}</p>
                        </div>
                        <div class="success-item-price">&#8377;{{ number_format($detail->total, 2) }}</div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="success-grid">
            <div class="info-grid">
                <div class="info-box">
                    <h3>Shipping Address</h3>
                    <p>
                        <strong>{{ $order->address->name ?? '' }}</strong><br>
                        Phone: {{ $order->address->mobile ?? '' }}<br>
                        @if($order->address && $order->address->email)
                            Email: {{ $order->address->email }}<br>
                        @endif
                        {{ $order->address->address ?? '' }}<br>
                        {{ $order->address->city ?? '' }}, {{ $order->address->state ?? '' }}<br>
                        Pincode: {{ $order->address->pincode ?? '' }}
                    </p>
                </div>

                <div class="info-box">
                    <h3>What Happens Next</h3>
                    <p>
                        Your order is marked as <strong>{{ ucfirst($order->status) }}</strong>.<br>
                        Our team will verify the details and contact you on the registered mobile number if needed.<br>
                        Items: {{ $itemCount }}
                    </p>
                </div>
            </div>

            <div class="total-box">
                <div class="total-row">
                    <span>Subtotal</span>
                    <strong>&#8377;{{ number_format($subtotal, 2) }}</strong>
                </div>
                <div class="total-row">
                    <span>Delivery Charges</span>
                    <strong>
                        @if($order->shipping_charge > 0)
                            &#8377;{{ number_format($order->shipping_charge, 2) }}
                        @else
                            Free
                        @endif
                    </strong>
                </div>
                <div class="total-row">
                    <span>Payment Method</span>
                    <strong>{{ $order->payment_method }}</strong>
                </div>
                <div class="total-row grand-total">
                    <span>Total Paid</span>
                    <strong>&#8377;{{ number_format($order->total_order_value, 2) }}</strong>
                </div>
            </div>
        </div>

        <div class="success-actions">
            <a href="{{ route('shop') }}" class="success-btn success-btn-primary">Continue Shopping</a>
            <a href="{{ url('/') }}" class="success-btn success-btn-light">Back To Home</a>
        </div>
    </div>
</main>
@endsection
