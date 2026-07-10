@extends('frontend.layouts.master')
@section('title') Director's Desk @endsection
@section('content')
<main>
    <div class="it-breadcrumb-area fix it-breadcrumb-bg p-relative" data-background="{{static_asset('assets/assets_web/images/breadcrumb.jpg')}}">
        <div class="container">
            <div class="row ">
                <div class="col-md-12">
                    <div class="it-breadcrumb-content z-index-3 text-center">
                        <div class="it-breadcrumb-title-box">
                            <h3 class="it-breadcrumb-title">Director's Desk</h3>
                        </div>
                        <div class="it-breadcrumb-list-wrap">
                            <div class="it-breadcrumb-list">
                                <span><a href="{{ url('') }}">home</a></span>
                                <span class="dvdr">//</span>
                                <span>Director's Desk</span>
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
                <div class="col-xl-4 col-lg-4 wow itfadeLeft" data-wow-duration=".9s" data-wow-delay=".5s">
                    <div class="ed-about-2-left p-relative text-end">
                        <img src="{{static_asset('assets/assets_web/images/director-photo.jpg')}}" alt="">
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6  wow itfadeRight" data-wow-duration=".9s" data-wow-delay=".7s">
                    <div class="it-about-right-box">

                        <div class="it-about-text pb-10">
                            <h2 id="directors-desk-title">From the Director’s Desk</h2>

    <p>Welcome to <strong>Nascent Engineering Computer (NEC)</strong>,</p>
    <p>
      It gives me immense pleasure to extend a warm welcome to you. At NEC, our
      vision is simple yet powerful – to make <strong>quality computer education</strong>
      and <strong>digital skills</strong> accessible to everyone.
    </p>

    <p>
      In today’s fast-evolving digital era, computer knowledge is not just an
      additional skill, it’s a necessity. Our goal is to empower students,
      professionals, and entrepreneurs with the <strong>technical expertise</strong>
      and <strong>practical exposure</strong> needed to thrive in the modern world.
    </p>

    <p>
      We take pride in our <strong>industry-focused curriculum</strong>, experienced
      trainers, and hands-on learning approach. Whether you are starting with the
      basics or aiming to master advanced technologies, NEC is here to guide you
      every step of the way.
    </p>

    <p>
      Together, let us build a future where knowledge meets innovation, and every
      learner becomes a confident contributor to the digital economy.
    </p>

    <p>Thank you for trusting NEC as your partner in this learning journey.</p>

    <p>
      – <span class="director-name">Mr. Raj Kumar Singh</span><br />
      <em>Director, Nascent Engineering Computer (NEC)</em>
    </p>


                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- about-area-end -->



    <!-- team-area-end -->




    <!-- blog-area-end -->


    <!-- newsletter-area-end -->
</main>
@endsection
