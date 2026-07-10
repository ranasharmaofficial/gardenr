@extends('frontend.layouts.master')
@section('title') Online Registration @endsection
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
                            <h3 class="it-breadcrumb-title">Online Registration</h3>
                        </div>
                        <div class="it-breadcrumb-list-wrap">
                            <div class="it-breadcrumb-list">
                                <span><a href="{{url('/')}}">home</a></span>
                                <span class="dvdr">//</span>
                                <span>Online Registration</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- slider-area-end -->

    <div class="it-student-area it-instructor-style pt-20 pb-120">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="it-student-bg">
                        <h4 class="it-student-title">Online Registration</h4>
                        <div class="it-student-regiform">
                            <h4 class="it-student-regiform-title">Profile information</h4>
                            <form action="#">
                                <div class="it-student-regiform-wrap">
                                    <div class="row">
                                        <div class="col-xl-6">
                                            <div class="it-student-regiform-item">
                                                <label>First Name *</label>
                                                <input type="text">
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="it-student-regiform-item">
                                                <label>Last Name *</label>
                                                <input type="text">
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="it-student-regiform-item">
                                                <label>Birth Date *</label>
                                                <input type="text">
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="it-student-regiform-item">
                                                <label>Gender *</label>
                                                <div class="postbox__select">
                                                    <select>
                                                        <option>Select an option</option>
                                                        <option>Male</option>
                                                        <option>Female</option>
                                                        <option>Other</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-12">
                                            <div class="it-student-regiform-item">
                                                <label>Address *</label>
                                                <input type="email">
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="it-student-regiform-item">
                                                <label>Select Course *</label>
                                                <div class="postbox__select">
                                                    <select>
                                                        <option>Select an option</option>
                                                        <option>01 </option>
                                                        <option>02 </option>
                                                        <option>03 </option>
                                                        <option>04 </option>
                                                        <option>05 </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xl-6">
                                            <div class="it-student-regiform-item">
                                                <label>Disptrict * </label>
                                                <div class="postbox__select">
                                                    <select>
                                                        <option>Patna</option>
                                                        <option>01</option>
                                                        <option>02</option>
                                                        <option>03</option>
                                                        <option>04</option>
                                                        <option>05</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="it-student-regiform-item">
                                                <label>City *</label>
                                                <input type="text">
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="it-student-regiform-item">
                                                <label>Postcode / ZIP (optional)</label>
                                                <input type="text">
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="it-student-regiform-item">
                                                <label>Email *</label>
                                                <input type="text">
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="it-student-regiform-item">
                                                <label>Phone *</label>
                                                <input type="text">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-xl-12">
                                        <div class="it-instructor-wrap">
                                            <div class="it-signup-agree">
                                                <h4 class="it-student-subtitle">Fields with are required</h4>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        id="flexCheckDefault">
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                        I Agree
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="it-student-regiform-btn">
                                        <button class="ed-btn-theme">
                                            <span>
                                                Submit now
                                                <i>
                                                    <svg width="17" height="14" viewBox="0 0 17 14" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M11 1.24023L16 7.24023L11 13.2402"
                                                            stroke="currentcolor" stroke-width="1.5"
                                                            stroke-miterlimit="10" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                        <path d="M1 7.24023H16" stroke="currentcolor"
                                                            stroke-width="1.5" stroke-miterlimit="10"
                                                            stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
                                                </i>
                                            </span>
                                        </button>
                                        <button class="ml-25 ed-btn-theme orange">
                                            <span>
                                                Cancel
                                                <i>
                                                    <svg width="17" height="14" viewBox="0 0 17 14" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M11 1.24023L16 7.24023L11 13.2402"
                                                            stroke="currentcolor" stroke-width="1.5"
                                                            stroke-miterlimit="10" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                        <path d="M1 7.24023H16" stroke="currentcolor"
                                                            stroke-width="1.5" stroke-miterlimit="10"
                                                            stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
                                                </i>
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- newsletter-area-end -->
</main>
@endsection
