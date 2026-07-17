@extends('frontend.layouts.master')
@section('title') About Us @endsection
@section('content')
<section id="ed-breadcrumb" class="ed-breadcrumb-sec" data-background="{{ static_asset('assets/assets_web/images/header-about5.jpg') }}">
    <div class="container">
        <div class="ed-breadcrumb-content">
            <div class="ed-breadcrumb-text text-center headline ul-li">
                <h2 class="bread_title">About Us</h2>
                <ul>
                    <li><a href="./">Home</a></li>
                    <li>About Us</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="row g-4 align-items-center">
            <div class="col-lg-5">
                <div class="rm-about-card">
                    <img src="{{ static_asset('assets/assets_web/images/garden.jpg') }}" alt="About Rich Money" style="border-radius:18px; width:100%; object-fit:cover; height:360px;">
                </div>
            </div>
            <div class="col-lg-7">
                <div class="rm-about-card">
                    <span class="rm-brand-highlight" style="margin-top:0; margin-bottom:16px;">
                        <i class="fa fa-leaf"></i> Why Grow With Rich Money
                    </span>
                    <h2 style="font-size:2rem; font-weight:800; color:#2e7d32; margin-bottom:16px;">A greener lifestyle starts with trusted plants and care.</h2>
                    <p style="color:#5e6b5d; line-height:1.8; margin-bottom:16px;">
                        Rich Money is a trusted plant and garden solutions brand focused on bringing healthy greenery, easy care guidance, and dependable service to every home.
                    </p>
                    <p style="color:#5e6b5d; line-height:1.8; margin-bottom:16px;">
                        From premium indoor plants to pots, planters, and gardening essentials, we make it simple to create a fresh and beautiful space with confidence.
                    </p>
                    <div class="row g-3 mt-2">
                        <div class="col-md-6">
                            <div class="p-3 border rounded-3" style="background:#f7fcf7; border-color:#dff3e2!important;">
                                <h5 class="mb-2" style="color:#2e7d32; font-weight:700;">Quality First</h5>
                                <p class="mb-0" style="color:#607060;">Healthy plants and durable products sourced with care.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 border rounded-3" style="background:#f7fcf7; border-color:#dff3e2!important;">
                                <h5 class="mb-2" style="color:#2e7d32; font-weight:700;">Friendly Support</h5>
                                <p class="mb-0" style="color:#607060;">A helpful team that guides you from selection to delivery.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-4 pb-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-3 col-md-6">
                <div class="rm-home-highlight text-center">
                    <div style="font-size:2rem; color:#4caf50; margin-bottom:10px;"><i class="fa fa-award"></i></div>
                    <h5 style="font-weight:700; color:#2e7d32;">Certified Quality</h5>
                    <p class="mb-0" style="color:#607060;">Carefully selected products that stay healthy and beautiful.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="rm-home-highlight text-center">
                    <div style="font-size:2rem; color:#4caf50; margin-bottom:10px;"><i class="fa fa-dollar-sign"></i></div>
                    <h5 style="font-weight:700; color:#2e7d32;">Best Value</h5>
                    <p class="mb-0" style="color:#607060;">Transparent pricing and affordable gardening solutions.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="rm-home-highlight text-center">
                    <div style="font-size:2rem; color:#4caf50; margin-bottom:10px;"><i class="fa fa-shipping-fast"></i></div>
                    <h5 style="font-weight:700; color:#2e7d32;">Fast Delivery</h5>
                    <p class="mb-0" style="color:#607060;">Quick and safe doorstep delivery for your green needs.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="rm-home-highlight text-center">
                    <div style="font-size:2rem; color:#4caf50; margin-bottom:10px;"><i class="fa fa-headset"></i></div>
                    <h5 style="font-weight:700; color:#2e7d32;">Always Here</h5>
                    <p class="mb-0" style="color:#607060;">Support that helps you every step of the way.</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
