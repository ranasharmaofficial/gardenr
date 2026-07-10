
@extends('master')

@section('title')
Franchise Login
@endsection

@section('description')
@endsection


@section('content')

<section id="ed-breadcrumb" class="ed-breadcrumb-sec" data-background="{{ static_asset('assets/assets_web/images/header-about5.jpg') }}">
		<div class="container">
			<div class="ed-breadcrumb-content">
				<div class="ed-breadcrumb-text text-center headline ul-li">
					<h2 class="bread_title">Franchise Login</h2>
					<ul>
						<li><a href="{{ url('') }}">Home</a></li>
						<li>Franchise Login </li>
					</ul>
				</div>
			</div>
		</div>
	</section>

<!-- Start of Feature section
  ============================================= -->

<!-- Start of Contact Form section
	============================================= -->
	<section id="ed-cp-form" class="ed-cp-form-sec position-relative">
		<div class="container">
		<div class="row">
		<div class="col-lg-6">
			<div class="ed-cp-form-content  pb-155 position-relative">
				<div class="ed-cp-form position-relative">
					<div class="gt-client-review-form cp_ver mt-40">
						<h3>Student Login</h3>
						<form action="#" method="get">
							<div class="row">
								<div class="col-md-12">
									<input type="text" placeholder="Email Id*">
								</div>
								<div class="col-md-12">
									 <input type="text" placeholder="Password*">
								</div>


								<div class="col-md-12">
									<button>Sign In</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			</div>
			<div class="col-lg-6">
			<img src="{{ static_asset('assets/assets_web/images/student-login.jpg') }}">
			</div>
			</div>
		</div>
	</section>


@if(false)
<main>
    <div class="it-breadcrumb-area fix it-breadcrumb-bg p-relative" data-background="{{asset('public/front_assets/images/breadcrumb.jpg')}}">
        <div class="container">
            <div class="row ">
                <div class="col-md-12">
                    <div class="it-breadcrumb-content z-index-3 text-center">
                        <div class="it-breadcrumb-title-box">
                            <h3 class="it-breadcrumb-title">Marksheet Verification</h3>
                        </div>
                        <div class="it-breadcrumb-list-wrap">
                            <div class="it-breadcrumb-list">
                                <span><a href="{{url('/')}}">home</a></span>
                                <span class="dvdr">//</span>
                                <span>Marksheet Verification</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- slider-area-end -->

    <div class="it-signup-area pt-30 pb-50">
        <div class="container">
            <div class="it-signup-bg p-relative">
                <div class="it-signup-thumb d-none d-lg-block">
                    <img src="{{asset('public/front_assets/images/thumb-1-1.jpg')}}" alt="">
                </div>
                <div class="row">
                    <div class="col-xl-6 col-lg-6">
                        <form action="#">
                            <div class="it-signup-wrap">
                                <h4 class="it-signup-title">Marksheet Verification</h4>
                                <div class="it-signup-input-wrap">
                                    <div class="it-signup-input mb-20">
                                        <input type="password" placeholder="Registration No.">
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
@endif
@endsection
