@extends('frontend.layouts.master')
@section('title') Privacy Policy - Rich Money @endsection

@section('meta_tags')
@endsection

@section('content')
<section id="ed-breadcrumb" class="ed-breadcrumb-sec" data-background="{{ static_asset('assets/assets_web/images/header-about5.jpg') }}">
    <div class="container">
        <div class="ed-breadcrumb-content">
            <div class="ed-breadcrumb-text text-center headline ul-li">
                <h2 class="bread_title">Privacy Policy</h2>
                <ul>
                    <li><a href="{{ url('') }}">Home</a></li>
                    <li>Privacy Policy</li>
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
                    <span class="rm-brand-highlight" style="margin-top:0; margin-bottom:16px;"><i class="fa fa-shield-alt"></i> Privacy Policy</span>
                    <h3 style="font-size:2rem; font-weight:800; color:#2e7d32; margin-bottom:12px;">Your privacy matters to us</h3>
                    <p style="color:#5d695f; line-height:1.8;">We collect and use your information to improve your experience, process orders, and provide better support. We respect your privacy and keep your details secure.</p>
                    <div class="mt-4">
                        <h5 style="font-weight:700; color:#2e7d32;">1. Information we collect</h5>
                        <p style="color:#5d695f;">We may collect your name, email, phone number, delivery address, and usage details to provide our services smoothly.</p>
                        <h5 style="font-weight:700; color:#2e7d32;">2. How we use your information</h5>
                        <p style="color:#5d695f;">Your information helps us process orders, respond to enquiries, improve our website, and communicate with you.</p>
                        <h5 style="font-weight:700; color:#2e7d32;">3. Security</h5>
                        <p style="color:#5d695f;">We use practical safeguards to protect your data, but we recommend keeping your passwords private and secure.</p>
                        <h5 style="font-weight:700; color:#2e7d32;">4. Contact</h5>
                        <p style="color:#5d695f;">If you have any questions, please contact us at <a href="mailto:info.richmoney1@gmail.com" style="color:#4caf50;">info.richmoney1@gmail.com</a> or <a href="tel:+919534737643" style="color:#4caf50;">+91 9534737643</a>.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
