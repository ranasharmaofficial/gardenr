@extends('frontend.layouts.master')
@section('title') Checkout @endsection

@section('content')
@php
    $savedAddress = $address ?? null;
    $authEmail = auth()->user()->email ?? '';
    $authEmail = \Illuminate\Support\Str::endsWith($authEmail, '@gardenr.local') ? '' : $authEmail;
    $checkoutName = old('name', $savedAddress->name ?? trim((auth()->user()->first_name ?? '').' '.(auth()->user()->last_name ?? '')));
    $checkoutMobile = old('mobile', $savedAddress->mobile ?? auth()->user()->mobile ?? '');
    $checkoutEmail = old('email', $savedAddress->email ?? $authEmail);
    $checkoutState = old('state', $savedAddress->state ?? '');
    $checkoutCity = old('city', $savedAddress->city ?? '');
    $checkoutAddress = old('address', $savedAddress->address ?? '');
    $checkoutPincode = old('pincode', $savedAddress->pincode ?? '');
@endphp

<style>
    .checkout-page { background: #f4f8f3; padding: 34px 0 54px; }
    .checkout-shell { max-width: 1320px; }
    .checkout-steps { display: flex; justify-content: center; align-items: center; gap: 14px; margin: 0 0 28px; padding: 0; list-style: none; color: #7b8794; font-weight: 700; }
    .checkout-steps li { display: flex; align-items: center; gap: 14px; }
    .checkout-steps a { color: inherit; text-decoration: none; }
    .checkout-steps .active a { color: #0f8f5f; }
    .checkout-steps .disabled { opacity: .55; }
    .checkout-steps .step-line { width: 34px; height: 2px; background: #cbd5c0; }
    .checkout-card { background: #fff; border: 1px solid #e3eadf; border-radius: 10px; box-shadow: 0 12px 30px rgba(30, 74, 47, .08); }
    .checkout-card-header { border-bottom: 1px solid #eef3eb; padding: 26px 30px 18px; }
    .checkout-eyebrow { color: #0f8f5f; display: block; font-size: 12px; font-weight: 800; letter-spacing: .08em; margin-bottom: 6px; text-transform: uppercase; }
    .checkout-title { color: #12233b; font-size: 28px; font-weight: 800; margin: 0; }
    .checkout-subtitle { color: #687487; margin: 8px 0 0; }
    .checkout-card-body { padding: 28px 30px 30px; }
    .checkout-field { margin-bottom: 20px; }
    .checkout-field label { color: #21344d; display: block; font-size: 14px; font-weight: 800; margin-bottom: 9px; }
    .checkout-required { color: #d13b3b; }
    .checkout-input, .checkout-textarea { border: 1px solid #ccd8c8; border-radius: 8px; color: #17233d; font-size: 15px; height: 52px; padding: 12px 14px; width: 100%; transition: border-color .2s ease, box-shadow .2s ease; }
    .checkout-textarea { height: 132px; resize: vertical; }
    .checkout-input:focus, .checkout-textarea:focus { border-color: #0f9f6a; box-shadow: 0 0 0 4px rgba(15, 159, 106, .12); outline: none; }
    .checkout-help { color: #7b8794; display: block; font-size: 12px; margin-top: 7px; }
    .checkout-summary { position: sticky; top: 18px; }
    .summary-item { align-items: center; border-bottom: 1px solid #eef3eb; display: grid; gap: 14px; grid-template-columns: 62px 1fr auto; padding: 16px 0; }
    .summary-item:first-child { padding-top: 0; }
    .summary-img { border: 1px solid #e6eee1; border-radius: 8px; height: 62px; object-fit: cover; width: 62px; }
    .summary-name { color: #14233a; font-size: 14px; font-weight: 800; line-height: 1.35; margin: 0 0 5px; }
    .summary-meta { color: #687487; font-size: 13px; margin: 0; }
    .summary-price { color: #12233b; font-size: 15px; font-weight: 800; white-space: nowrap; }
    .summary-row { align-items: center; color: #536276; display: flex; font-size: 15px; justify-content: space-between; margin: 15px 0; }
    .summary-row strong { color: #12233b; }
    .free-badge { background: #dff8ea; border-radius: 999px; color: #087346; font-size: 11px; font-weight: 800; margin-left: 7px; padding: 3px 8px; }
    .delivery-note { background: #ecfbf2; border: 1px solid #c9f0d7; border-radius: 8px; color: #087346; font-size: 13px; font-weight: 700; padding: 11px 13px; }
    .delivery-note.warning { background: #fff8e7; border-color: #ffe2a8; color: #9b5a00; }
    .total-row { border-top: 1px solid #e2eadf; margin-top: 22px; padding-top: 22px; }
    .total-row span { color: #12233b; font-size: 18px; font-weight: 900; }
    .total-row strong { color: #0f9f6a; font-size: 28px; font-weight: 900; }
    .payment-option { align-items: center; background: #f4fcf7; border: 2px solid #10a66f; border-radius: 8px; cursor: pointer; display: flex; justify-content: space-between; margin: 18px 0 22px; padding: 15px; }
    .payment-icon { align-items: center; background: #dff8ea; border-radius: 8px; color: #0f8f5f; display: flex; height: 42px; justify-content: center; margin-right: 13px; width: 42px; }
    .place-order-btn { background: linear-gradient(135deg, #13b77b, #078a59); border: 0; border-radius: 8px; box-shadow: 0 12px 24px rgba(15, 159, 106, .25); color: #fff; font-size: 15px; font-weight: 900; height: 54px; letter-spacing: .02em; text-transform: uppercase; width: 100%; }
    .place-order-btn:hover { background: linear-gradient(135deg, #0fa66f, #067a4f); color: #fff; }
    .secure-note { color: #7b8794; font-size: 12px; margin: 13px 0 0; text-align: center; }
    @media (max-width: 991px) { .checkout-summary { position: static; margin-top: 22px; } }
    @media (max-width: 575px) {
        .checkout-page { padding-top: 22px; }
        .checkout-steps { gap: 8px; font-size: 13px; }
        .checkout-steps .step-line { width: 18px; }
        .checkout-card-header, .checkout-card-body { padding-left: 18px; padding-right: 18px; }
        .summary-item { grid-template-columns: 54px 1fr; }
        .summary-price { grid-column: 2; }
    }
</style>

<main class="main checkout-page">
    <div class="container checkout-shell">
        <ul class="checkout-steps">
            <li><a href="{{ route('cart.page') }}">Shopping Cart</a><span class="step-line"></span></li>
            <li class="active"><a href="{{ route('checkout') }}">Checkout</a><span class="step-line"></span></li>
            <li class="disabled"><a href="javascript:void(0)">Order Complete</a></li>
        </ul>

        @if(session('alert-success'))
            <div class="alert alert-success">{{ session('alert-success') }}</div>
        @endif

        @if(session('alert-danger'))
            <div class="alert alert-danger">{{ session('alert-danger') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Please check the details below.</strong>
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('checkout.save') }}" id="checkoutForm">
            @csrf
            <div class="row">
                <div class="col-lg-7">
                    <div class="checkout-card">
                        <div class="checkout-card-header">
                            <span class="checkout-eyebrow">Delivery Details</span>
                            <h1 class="checkout-title">Billing & Shipping</h1>
                            <p class="checkout-subtitle">Add accurate details so your plants reach the right doorstep.</p>
                        </div>

                        <div class="checkout-card-body">
                            <div class="checkout-field">
                                <label for="name">Full Name <span class="checkout-required">*</span></label>
                                <input type="text" id="name" name="name" class="checkout-input" value="{{ $checkoutName }}" placeholder="Enter your full name" required autocomplete="name">
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="checkout-field">
                                        <label for="mobile">Mobile Number <span class="checkout-required">*</span></label>
                                        <input type="tel" id="mobile" name="mobile" class="checkout-input" value="{{ $checkoutMobile }}" placeholder="10-digit mobile number" pattern="[0-9]{10}" maxlength="10" required autocomplete="tel">
                                        <small class="checkout-help">We will use this for delivery updates.</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkout-field">
                                        <label for="email">Email Address <span class="text-muted">(Optional)</span></label>
                                        <input type="email" id="email" name="email" class="checkout-input" value="{{ $checkoutEmail }}" placeholder="name@example.com" autocomplete="email">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="checkout-field">
                                        <label for="state">State <span class="checkout-required">*</span></label>
                                        <input type="text" id="state" name="state" class="checkout-input" value="{{ $checkoutState }}" placeholder="Enter state" required autocomplete="address-level1">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkout-field">
                                        <label for="city">City <span class="checkout-required">*</span></label>
                                        <input type="text" id="city" name="city" class="checkout-input" value="{{ $checkoutCity }}" placeholder="Enter city" required autocomplete="address-level2">
                                    </div>
                                </div>
                            </div>

                            <div class="checkout-field">
                                <label for="address">Complete Address <span class="checkout-required">*</span></label>
                                <textarea id="address" name="address" class="checkout-textarea" placeholder="House No, Street, Landmark, Area" required autocomplete="street-address">{{ $checkoutAddress }}</textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="checkout-field mb-md-0">
                                        <label for="pincode">Pincode <span class="checkout-required">*</span></label>
                                        <input type="text" id="pincode" name="pincode" class="checkout-input" value="{{ $checkoutPincode }}" placeholder="6-digit pincode" pattern="[0-9]{6}" maxlength="6" required autocomplete="postal-code">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="checkout-card checkout-summary">
                        <div class="checkout-card-header">
                            <span class="checkout-eyebrow">Review Order</span>
                            <h2 class="checkout-title">Order Summary</h2>
                            <p class="checkout-subtitle">{{ $cartItems->sum('qty') }} item(s) in your cart</p>
                        </div>

                        <div class="checkout-card-body">
                            <div class="summary-items">
                                @foreach($cartItems as $item)
                                    <div class="summary-item">
                                        <img class="summary-img" src="{{ static_asset($item->product->thumbnail) }}" alt="{{ $item->product->name }}">
                                        <div>
                                            <h3 class="summary-name">{{ $item->product->name }}</h3>
                                            <p class="summary-meta">Qty: {{ $item->qty }} x &#8377;{{ number_format($item->price, 2) }}</p>
                                        </div>
                                        <div class="summary-price">&#8377;{{ number_format($item->qty * $item->price, 2) }}</div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="summary-row mt-4">
                                <span>Subtotal</span>
                                <strong>&#8377;{{ number_format($subtotal, 2) }}</strong>
                            </div>

                            <div class="summary-row">
                                <span>Delivery Charges
                                    @if($shipping_charge == 0)
                                        <span class="free-badge">Free</span>
                                    @endif
                                </span>
                                <strong>&#8377;{{ number_format($shipping_charge, 2) }}</strong>
                            </div>

                            @if($shipping_charge > 0)
                                <div class="delivery-note warning">
                                    Add items worth &#8377;{{ number_format(max(0, 1000 - $subtotal), 2) }} more to get free delivery.
                                </div>
                            @else
                                <div class="delivery-note">
                                    <i class="fa fa-check-circle mr-1"></i> Your order is eligible for free delivery.
                                </div>
                            @endif

                            <div class="summary-row total-row">
                                <span>Total Amount</span>
                                <strong>&#8377;{{ number_format($total, 2) }}</strong>
                            </div>

                            <label class="payment-option" for="pay_cod">
                                <span class="d-flex align-items-center">
                                    <span class="payment-icon"><i class="fa fa-money-bill-wave"></i></span>
                                    <span>
                                        <strong class="d-block">Cash on Delivery</strong>
                                        <small class="text-muted">Pay when your order arrives</small>
                                    </span>
                                </span>
                                <input type="radio" id="pay_cod" name="payment_method" value="COD" {{ old('payment_method', 'COD') == 'COD' ? 'checked' : '' }} required>
                            </label>

                            <button type="submit" id="placeOrderBtn" class="place-order-btn">
                                <i class="fa fa-lock mr-2"></i> Place Order Securely
                            </button>
                            <p class="secure-note"><i class="fa fa-shield-alt mr-1"></i> Your information is used only to process this order.</p>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</main>
@endsection
