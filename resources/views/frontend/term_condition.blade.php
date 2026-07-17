@extends('frontend.layouts.master')
@section('title') Terms & Conditions - Rich Money @endsection

@section('meta_tags')
@endsection

@section('content')
<section id="ed-breadcrumb" class="ed-breadcrumb-sec" data-background="{{ static_asset('assets/assets_web/images/header-about5.jpg') }}">
    <div class="container">
        <div class="ed-breadcrumb-content">
            <div class="ed-breadcrumb-text text-center headline ul-li">
                <h2 class="bread_title">Terms & Conditions</h2>
                <ul>
                    <li><a href="{{ url('') }}">Home</a></li>
                    <li>Terms & Conditions</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="py-5" style="background:#f7fcf7;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="rm-policy-card">
                    <span class="rm-brand-highlight" style="margin-top:0; margin-bottom:16px;"><i class="fa fa-file-contract"></i> Terms & Conditions</span>
                    <h3 style="font-size:2rem; font-weight:800; color:#2e7d32; margin-bottom:12px;">Using our platform responsibly</h3>
                    <p style="color:#5d695f; line-height:1.8;">Welcome to Rich Money. By using our website and services, you agree to follow the terms below and use the platform in a respectful and lawful way.</p>
                    <div class="mt-4">
                        <h5 style="font-weight:700; color:#2e7d32;">1. Use of the website</h5>
                        <p style="color:#5d695f;">You agree to use our website only for lawful purposes and in a way that does not harm the platform, its users, or our services.</p>
                        <h5 style="font-weight:700; color:#2e7d32;">2. Account responsibility</h5>
                        <p style="color:#5d695f;">If you create an account, you are responsible for keeping your login details secure and for all activities under your account.</p>
                        <h5 style="font-weight:700; color:#2e7d32;">3. Orders and payments</h5>
                        <p style="color:#5d695f;">All orders are subject to availability and payment completion. Prices and promotions may change as per our policy.</p>
                        <h5 style="font-weight:700; color:#2e7d32;">4. Intellectual property</h5>
                        <p style="color:#5d695f;">All content, images, and branding belong to Rich Money unless clearly stated otherwise.</p>
                        <h5 style="font-weight:700; color:#2e7d32;">5. Contact</h5>
                        <p style="color:#5d695f;">For questions, contact us at <a href="mailto:info.richmoney1@gmail.com" style="color:#4caf50;">info.richmoney1@gmail.com</a> or call <a href="tel:+919534737643" style="color:#4caf50;">+91 9534737643</a>.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
