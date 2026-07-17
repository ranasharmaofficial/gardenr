@extends('frontend.layouts.master')
@section('title') Contact Us @endsection

@section('meta_tags')
@endsection

@section('content')
<section id="ed-breadcrumb" class="ed-breadcrumb-sec" data-background="{{ static_asset('assets/assets_web/images/header-about5.jpg') }}">
    <div class="container">
        <div class="ed-breadcrumb-content">
            <div class="ed-breadcrumb-text text-center headline ul-li">
                <h2 class="bread_title">Contact Us</h2>
                <ul>
                    <li><a href="{{ url('') }}">Home</a></li>
                    <li>Contact Us</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="py-5" style="background:#f7fcf7;">
    <div class="container">
        <div class="row g-4 align-items-stretch">
            <div class="col-lg-5">
                <div class="rm-contact-card h-100">
                    <span class="rm-brand-highlight" style="margin-top:0; margin-bottom:16px;">
                        <i class="fa fa-leaf"></i> We are happy to help
                    </span>
                    <h3 style="font-weight:800; color:#2e7d32;">Reach our team anytime</h3>
                    <p style="color:#5d695f; line-height:1.8; margin-bottom:20px;">Whether you need plant guidance, delivery help, or business support, our team is ready to assist you with prompt responses.</p>
                    <div class="d-flex flex-column gap-3">
                        <div class="p-3 rounded-3" style="background:#f7fcf7; border:1px solid #dcf0df;">
                            <div class="fw-bold mb-1" style="color:#2e7d32;">Location</div>
                            <div style="color:#5d695f;">SAMAY PUR BADLI, DELHI (110042)</div>
                        </div>
                        <div class="p-3 rounded-3" style="background:#f7fcf7; border:1px solid #dcf0df;">
                            <div class="fw-bold mb-1" style="color:#2e7d32;">Phone</div>
                            <a href="tel:+919534737643" style="color:#4caf50;">+91 9534737643</a>
                        </div>
                        <div class="p-3 rounded-3" style="background:#f7fcf7; border:1px solid #dcf0df;">
                            <div class="fw-bold mb-1" style="color:#2e7d32;">Email</div>
                            <a href="mailto:info.richmoney1@gmail.com" style="color:#4caf50;">info.richmoney1@gmail.com</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="rm-contact-card h-100">
                    <h3 style="font-weight:800; color:#2e7d32; margin-bottom:20px;">Send us a message</h3>
                    <form action="#" method="get">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <input type="text" class="form-control" placeholder="Full Name">
                            </div>
                            <div class="col-md-6">
                                <input type="email" class="form-control" placeholder="Email Address">
                            </div>
                            <div class="col-12">
                                <textarea name="message" class="form-control" placeholder="Your Message" style="min-height:140px;"></textarea>
                            </div>
                            <div class="col-12">
                                <label class="d-flex align-items-start gap-2" style="font-size:0.95rem; color:#5d695f;">
                                    <input type="checkbox" id="acceptTerms" style="margin-top:3px;">
                                    <span>I accept the <a href="{{ url('terms-condition') }}" target="_blank" style="color:#4caf50; font-weight:600;">Terms & Conditions</a> and <a href="{{ url('privacy-policy') }}" target="_blank" style="color:#4caf50; font-weight:600;">Privacy Policy</a>.</span>
                                </label>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-success w-100 py-3" id="submitBtn" disabled style="background:#4caf50; border-color:#4caf50;">Submit Request</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<script>
    document.getElementById('acceptTerms').addEventListener('change', function () {
        document.getElementById('submitBtn').disabled = !this.checked;
    });
</script>
@endsection
