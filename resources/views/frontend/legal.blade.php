@extends('frontend.layouts.master')
@section('title')
    Legal Documents - Rich Money
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="rm-legal-wrapper">

                    <div class="text-center mb-5">
                        <h1 class="rm-title mt-3">
                            Refund Policy & Disclaimer
                        </h1>

                        <p class="rm-subtitle">
                            Please read these legal documents carefully before using our services.
                        </p>
                    </div>

                    <!-- Refund Policy -->

                    <div class="rm-legal-card mb-5">
                        <h2>Refund & Return Policy</h2>

                        <p class="rm-date">
                            Last Updated : January 1, 2026
                        </p>

                        <div class="rm-box">
                            <h4>Plant Returns</h4>

                            <p>
                                If your plant arrives damaged or unhealthy, please contact us
                                within 48 hours with photos. We will arrange a replacement or
                                refund at our discretion.
                            </p>
                        </div>

                        <div class="rm-box">
                            <h4>Non-returnable Items</h4>

                            <p>
                                Live plants, seeds and perishable items cannot be returned
                                once they leave our facility in healthy condition.
                            </p>
                        </div>

                        <div class="rm-box">
                            <h4>Refund Timing</h4>

                            <p>
                                Approved refunds are processed within 5–7 business days.
                            </p>
                        </div>

                    </div>

                    <!-- Disclaimer -->

                    <div class="rm-legal-card">

                        <div class="rm-icon bg-warning">
                            <i class="fa fa-exclamation-circle"></i>
                        </div>

                        <h2>Disclaimer</h2>

                        <p class="rm-date">
                            Last Updated : January 1, 2026
                        </p>

                        <div class="rm-box">
                            <h4>General Disclaimer</h4>

                            <p>
                                Information available on Rich Money is provided only for
                                general guidance. We do not guarantee complete accuracy.
                            </p>
                        </div>

                        <div class="rm-box">
                            <h4>Plant Care</h4>

                            <p>
                                Plant growth depends on climate, watering and maintenance.
                                Results may vary according to environmental conditions.
                            </p>
                        </div>

                        <div class="rm-box">
                            <h4>Contact Information</h4>

                            <ul class="rm-contact-list">
                                <li><i class="fa fa-map-marker-alt"></i> SAMAY PUR BADLI, DELHI (110042)</li>
                                <li><i class="fa fa-phone"></i> +91 9534737643</li>
                                <li><i class="fa fa-envelope"></i> info.richmoney1@gmail.com</li>
                            </ul>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

    <style>
        body {
            background: #f7faf7;
        }

        .rm-legal-wrapper {
            padding: 12px 0;
        }

        .rm-badge {
            background: #e8f5e9;
            color: #2e7d32;
            padding: 8px 22px;
            border-radius: 40px;
            font-weight: 600;
        }

        .rm-title {
            font-size: 42px;
            font-weight: 800;
            color: #234;
        }

        .rm-subtitle {
            color: #6c757d;
            max-width: 650px;
            margin: auto;
        }

        .rm-legal-card {
            background: #fff;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 15px 45px rgba(0, 0, 0, .08);
            margin-bottom: 35px;
            position: relative;
        }

        .rm-icon {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 28px;
            margin-bottom: 20px;
        }

        .rm-date {
            color: #888;
            margin-bottom: 25px;
        }

        .rm-box {
            background: #f8faf8;
            border-left: 5px solid #4caf50;
            padding: 22px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .rm-box h4 {
            color: #2e7d32;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .rm-box p {
            margin: 0;
            color: #555;
            line-height: 1.8;
        }

        .rm-contact-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .rm-contact-list li {
            margin-bottom: 15px;
            color: #555;
        }

        .rm-contact-list i {
            color: #4caf50;
            width: 24px;
        }
    </style>
@endsection
