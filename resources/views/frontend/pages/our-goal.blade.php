@extends('frontend.layouts.master')
@section('title') Our Goal @endsection
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
                            <h3 class="it-breadcrumb-title">Our Goal</h3>
                        </div>
                        <div class="it-breadcrumb-list-wrap">
                            <div class="it-breadcrumb-list">
                                <span><a href="{{url('/')}}">home</a></span>
                                <span class="dvdr">//</span>
                                <span>Our Goal</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- slider-area-end -->

    <!-- category-area-start -->


    <!-- about-area-start -->
    <div class="it-about-area ed-about-style-2 p-relative pt-50">
        <div class="it-about-shape-4 d-none d-md-block">
            <img src="{{static_asset('assets/assets_web/images/shape-1-4.png')}}" alt="">
        </div>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-6 col-lg-6  wow itfadeLeft" data-wow-duration=".9s" data-wow-delay=".5s">
                    <div class="ed-about-2-left p-relative text-end">
                        <img src="{{static_asset('assets/assets_web/images/ed-about-1-1.jpg')}}" alt="">
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6  wow itfadeRight" data-wow-duration=".9s" data-wow-delay=".7s">
                    <div class="it-about-right-box">
                        <div class="it-about-title-box mb-20">
                            <h4 class="ed-section-title">Our Goal</h4>
                        </div>
                        <div class="it-about-text pb-10">
                            <p>Our goal is to empower individuals with practical, industry-relevant skills through
                                high-quality vocational training, enabling them to thrive in the global workforce. We
                                aim to bridge the gap between education and employment, ensuring every learner is
                                equipped for a successful and sustainable career. </p>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- about-area-end -->



    <!-- team-area-end -->

    <!-- career-area-start -->
    <div class="it-career-area it-career-bg p-relative pt-120">
        <div class="it-career-shape-2 d-none d-xl-block">
            <img src="{{static_asset('assets/assets_web/images/shape-1-1.png')}}" alt="">
        </div>
        <div class="it-career-shape-3 d-none d-xl-block">
            <img src="{{static_asset('assets/assets_web/images/shape-1-2.png')}}" alt="">
        </div>
        <div class="it-career-shape-4 d-none d-xl-block">
            <img src="{{static_asset('assets/assets_web/images/shape-1-3.png')}}" alt="">
        </div>
        <div class="it-career-shape-5 d-none d-xl-block">
            <img src="{{static_asset('assets/assets_web/images/shape-1-4.png')}}" alt="">
        </div>
        <div class="it-career-shape-6 d-none d-xl-block">
            <img src="{{static_asset('assets/assets_web/images/shape-1-5.png')}}" alt="">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="it-career-title-box text-center mb-70">
                        <span class="ed-section-subtitle">Choose your career</span>
                        <h4 class="ed-section-title">Discover your gain
                        </h4>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 mb-30 wow itfadeLeft" data-wow-duration=".9s" data-wow-delay=".5s">
                    <div class="it-career-item theme-bg p-relative fix">
                        <div class="it-career-content">
                            <span>Start from today</span>
                            <p>Gain globally recognized <br> vocational skills<br> and unlock career</p>
                            <a class="ed-btn-yellow dark-bg" href="{{ url('student-login') }}">
                                Join now
                                <i>
                                    <svg width="17" height="14" viewBox="0 0 17 14" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M11 1.24023L16 7.24023L11 13.2402" stroke="currentcolor"
                                            stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M1 7.24023H16" stroke="currentcolor" stroke-width="1.5"
                                            stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </i>
                            </a>
                        </div>
                        <div class="it-career-thumb">
                            <img src="{{static_asset('assets/assets_web/images/thumb-1.png')}}" alt="">
                        </div>
                        <div class="it-career-shape-1">
                            <img src="{{static_asset('assets/assets_web/images/shape-1.png')}}" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 mb-30 wow itfadeRight" data-wow-duration=".9s" data-wow-delay=".7s">
                    <div class="it-career-item yellow-bg p-relative fix">
                        <div class="it-career-content">
                            <span class="text-black">Start from today</span>
                            <p class="text-black">Flexible learning options<br> tailored to suit your schedule<br>
                                &nbsp;</p>
                            <a class="ed-btn-theme" href="{{ url('student-login') }}">
                                Join now
                                <i>
                                    <svg width="17" height="14" viewBox="0 0 17 14" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M11 1.24023L16 7.24023L11 13.2402" stroke="currentcolor"
                                            stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M1 7.24023H16" stroke="currentcolor" stroke-width="1.5"
                                            stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </i>
                            </a>
                        </div>
                        <div class="it-career-thumb">
                            <img src="{{static_asset('assets/assets_web/images/thumb-2.png')}}" alt="">
                        </div>
                        <div class="it-career-shape-1">
                            <img src="{{static_asset('assets/assets_web/images/shape-1.png')}}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- career-area-end -->


    <!-- blog-area-end -->


    <!-- newsletter-area-end -->
</main>
@endsection
