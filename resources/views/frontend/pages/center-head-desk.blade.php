@extends('frontend.layouts.master')
@section('title') Center Head Desk @endsection
@section('content')
<main>
    <div class="it-breadcrumb-area fix it-breadcrumb-bg p-relative" data-background="{{static_asset('assets/assets_web/images/breadcrumb.jpg')}}">
        <div class="container">
            <div class="row ">
                <div class="col-md-12">
                    <div class="it-breadcrumb-content z-index-3 text-center">
                        <div class="it-breadcrumb-title-box">
                            <h3 class="it-breadcrumb-title">Center Head Desk</h3>
                        </div>
                        <div class="it-breadcrumb-list-wrap">
                            <div class="it-breadcrumb-list">
                                <span><a href="{{ url('') }}">home</a></span>
                                <span class="dvdr">//</span>
                                <span>Center Head Desk</span>
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
                        <img src="{{static_asset('assets/assets_web/images/center_head.jpg')}}" alt="">
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6  wow itfadeRight" data-wow-duration=".9s" data-wow-delay=".7s">
                    <div class="it-about-right-box">

                        <div class="it-about-text pb-10">
                            <h2 id="directors-desk-title">From the Center Head's Desk</h2>

    <p>Welcome to <strong>Nascent Engineering Computer (NEC)</strong>,</p>

<p>
  As the <strong>Center Head</strong>, I feel proud to be part of an institution that is dedicated
  to shaping careers and creating opportunities through <strong>quality education</strong>
  and <strong>digital empowerment</strong>.
</p>

<p>
  At NEC, we believe that every learner has unique potential. Our focus is not only on
  delivering technical knowledge but also on building <strong>confidence, creativity, and problem-solving skills</strong>.
  These are the qualities that prepare our students to excel in both professional and personal life.
</p>

<p>
  We strive to create a supportive learning environment where students feel motivated to
  explore, experiment, and innovate. With the guidance of our dedicated trainers and
  industry-oriented curriculum, you will gain the <strong>practical exposure</strong>
  needed to meet the demands of today’s competitive world.
</p>

<p>
  I encourage you to make the most of every opportunity here at NEC and move forward with
  determination and passion. Together, we can turn knowledge into success and dreams into reality.
</p>

<p>
  Thank you for choosing NEC as your trusted partner in growth and learning.
</p>

<p>
  – <span class="center-head-name">Mr. Avdhesh Sharma</span><br />
  <em>Center Head, Nascent Engineering Computer (NEC)</em>
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
