@extends('frontend.layouts.master')
@section('title') Legal Documents - Rich Money @endsection

@section('content')
<section id="ed-breadcrumb" class="ed-breadcrumb-sec" data-background="{{ static_asset('assets/assets_web/images/header-about5.jpg') }}">
    <div class="container">
        <div class="ed-breadcrumb-content">
            <div class="ed-breadcrumb-text text-center headline ul-li">
                <h2 class="bread_title">Legal Documents</h2>
                <ul>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li>Legal</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="rm-legal-tabs mb-4 text-center">
                <ul class="nav nav-pills justify-content-center" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active rm-tab-pill" data-toggle="tab" href="#refund" role="tab">Refund Policy</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link rm-tab-pill" data-toggle="tab" href="#disclaimer" role="tab">Disclaimer</a>
                    </li>
                </ul>
            </div>

            <div class="tab-content">
                <div class="tab-pane fade show active" id="refund" role="tabpanel">
                    <div class="rm-legal-card">
                        <div class="rm-legal-icon"><i class="fa fa-undo-alt"></i></div>
                        <h2>Refund & Return Policy</h2>
                        <p class="rm-legal-date">Last updated: January 1, 2026</p>
                        <div class="rm-legal-section">
                            <h4>Plant Returns</h4>
                            <p>If your plant arrives damaged or unhealthy, please contact us within 48 hours with photos. We will arrange a replacement or refund at our discretion.</p>
                        </div>
                        <div class="rm-legal-section">
                            <h4>Non-returnable Items</h4>
                            <p>Live plants, seeds, and perishable items cannot be returned once they leave our facility in healthy condition.</p>
                        </div>
                        <div class="rm-legal-section">
                            <h4>Refund Timing</h4>
                            <p>Approved refunds are usually processed within 5–7 business days to the original payment method.</p>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="disclaimer" role="tabpanel">
                    <div class="rm-legal-card">
                        <div class="rm-legal-icon"><i class="fa fa-exclamation-circle"></i></div>
                        <h2>Disclaimer</h2>
                        <p class="rm-legal-date">Last updated: January 1, 2026</p>
                        <div class="rm-legal-section">
                            <h4>General Disclaimer</h4>
                            <p>All information provided on the Rich Money website is for general guidance only. We try to keep it accurate but cannot guarantee completeness or reliability.</p>
                        </div>
                        <div class="rm-legal-section">
                            <h4>Plant Care</h4>
                            <p>Plant care guidance varies by climate and environment. We are not responsible for losses caused by improper care outside our control.</p>
                        </div>
                        <div class="rm-legal-section">
                            <h4>Contact</h4>
                            <p>Address: SAMAY PUR BADLI, DELHI (110042<br>Phone: <a href="tel:+919534737643">+91 9534737643</a><br>Email: <a href="mailto:info.richmoney1@gmail.com">info.richmoney1@gmail.com</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.rm-legal-tabs .rm-tab-pill {
    background: #f5f5f5;
    color: #333;
    border-radius: 25px;
    padding: 10px 24px;
    font-weight: 600;
    margin: 5px;
    border: 2px solid transparent;
}
.rm-legal-tabs .rm-tab-pill.active,
.rm-legal-tabs .rm-tab-pill:hover {
    background: #4caf50;
    color: #fff !important;
    border-color: #4caf50;
}
.rm-legal-card {
    background: #fff;
    border-radius: 20px;
    padding: 36px 32px;
    box-shadow: 0 14px 40px rgba(0,0,0,0.08);
    border-top: 5px solid #4caf50;
}
.rm-legal-icon {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: linear-gradient(135deg, #2e7d32, #4caf50);
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.6rem;
    margin-bottom: 16px;
}
.rm-legal-card h2 { color: #2e7d32; font-weight: 800; }
.rm-legal-date { color: #7d877e; margin-bottom: 20px; }
.rm-legal-section { border-top: 1px solid #eef4ed; padding-top: 16px; margin-top: 16px; }
.rm-legal-section h4 { color: #2e7d32; font-weight: 700; }
.rm-legal-section p { color: #5d695f; line-height: 1.8; }
</style>
@endsection
