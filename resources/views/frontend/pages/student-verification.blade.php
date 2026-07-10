@extends('frontend.layouts.master')
@section('title') Student Verification @endsection
@section('content')
<main>
    <div class="it-breadcrumb-area fix it-breadcrumb-bg p-relative" data-background="{{static_asset('assets/assets_web/images/breadcrumb.jpg')}}">
        <div class="it-breadcrumb-shape-1 d-none d-md-block">
            <img src="{{static_asset('assets/assets_web/images/shape-1-21.png')}}" alt="">
        </div>
        <div class="it-breadcrumb-shape-2 d-none d-md-block">
            <img src="{{static_asset('assets/assets_web/images/shape-1-22.png')}}" alt="">
        </div>
        <div class="it-breadcrumb-shape-3 d-none d-md-block">
            <img src="{{static_asset('assets/assets_web/images/shape-1-3.png')}}" alt="">
        </div>
        <div class="it-breadcrumb-shape-4 d-none d-md-block">
            <img src="{{static_asset('assets/assets_web/images/shape-1-4.png')}}" alt="">
        </div>
        <div class="container">
            <div class="row ">
                <div class="col-md-12">
                    <div class="it-breadcrumb-content z-index-3 text-center">
                        <div class="it-breadcrumb-title-box">
                            <h3 class="it-breadcrumb-title">Student Verification</h3>
                        </div>
                        <div class="it-breadcrumb-list-wrap">
                            <div class="it-breadcrumb-list">
                                <span><a href="{{url('/')}}">home</a></span>
                                <span class="dvdr">//</span>
                                <span>Student Verification</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- slider-area-end -->

    <div class="it-signup-area pt-20 pb-120">
        <div class="container">
            <div class="it-signup-bg p-relative">
                <div class="it-signup-thumb d-none d-lg-block">
                    <img src="{{static_asset('assets/assets_web/images/thumb-1-1.jpg')}}" alt="">
                </div>
                <div class="row">
                    <div class="col-xl-6 col-lg-6">
                        <form action="#">
                            <div class="it-signup-wrap">
                                <h4 class="it-signup-title">student Verification</h4>
                                <div class="it-signup-input-wrap">
                                    <div class="it-signup-input mb-20">
                                        <input type="password" placeholder="Enrollment Number">
                                    </div>
                                    <div class="it-signup-input mb-20">
                                        <input type="password" placeholder="Date of Birth (DD-MM-YYYY)">
                                    </div>
                                </div>

                                <div
                                    class="it-signup-btn d-sm-flex justify-content-between align-items-center mb-40">
                                    <button type="submit" class="ed-btn-theme">
                                        Verify
                                        <i>
                                            <svg width="17" height="14" viewBox="0 0 17 14" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path d="M11 1.24023L16 7.24023L11 13.2402" stroke="currentcolor"
                                                    stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path d="M1 7.24023H16" stroke="currentcolor" stroke-width="1.5"
                                                    stroke-miterlimit="10" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                        </i>
                                    </button>

                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- newsletter-area-end -->
</main>
@endsection
