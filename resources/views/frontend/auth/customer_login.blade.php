@extends('frontend.layouts.master')
@section('title') Student Login @endsection

@section('content')

<!-- Start of Header section
  ============================================= -->
<section id="ed-breadcrumb" class="ed-breadcrumb-sec" data-background="{{ static_asset('assets/assets_web/images/header-about5.jpg') }}">
		<div class="container">
			<div class="ed-breadcrumb-content">
				<div class="ed-breadcrumb-text text-center headline ul-li">
					<h2 class="bread_title">Student Login</h2>
					<ul>
						<li><a href="{{ url('') }}">Home</a></li>
						<li>Student Login </li>
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
						<form action="{{ route('studentlogin.post') }}" method="post">
							@csrf
							<div class="row">
								<div class="col-md-12">
									@if ($errors->any())
										<div class="alert alert-danger">
											<ul>
												@foreach ($errors->all() as $error)
													<li style="list-style-type: disclosure-closed;margin-left: 8px;">{{ $error }}</li>
												@endforeach
											</ul>
										</div>
									@endif
								</div>
								<div class="col-md-12">
									<input type="text" name="enrollment_number" required placeholder="Enrollment No.*">
								</div>
								<div class="col-md-12">
									 <input type="date" name="dob" placeholder="Date of birth *" />
								</div>


								<div class="col-md-12">
									<button type="submit">Sign In</button>
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
      <div
        class="it-breadcrumb-area it-breadcrumb-bg"
        data-background="{{ static_asset('assets/assets_web/images/breadcrumb.jpg') }}"
      >
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="it-breadcrumb-content z-index-3 text-center">
                <div class="it-breadcrumb-title-box">
                  <h3 class="it-breadcrumb-title">Student Login</h3>
                </div>
                <div class="it-breadcrumb-list-wrap">
                  <div class="it-breadcrumb-list">
                    <span><a href="{{ url('') }}">home</a></span>
                    <span class="dvdr">//</span>
                    <span>Student Login</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="it-signup-area pt-120 pb-120">
        <div class="container">
          <div class="it-signup-bg p-relative">
            <div class="it-signup-thumb d-none d-lg-block">
              <img src="{{ static_asset('assets/assets_web/images/thumb-1-1.jpg') }}" alt="" />
            </div>
            <div class="row">
              <div class="col-xl-6 col-lg-6">
                <form action="{{ route('studentlogin.post') }}" method="post">
					@csrf

                  <div class="it-signup-wrap">
                    <h4 class="it-signup-title">Student Login</h4>
					<div class="col-md-12">
						@if ($errors->any())
							<div class="alert alert-danger">
								<ul>
									@foreach ($errors->all() as $error)
										<li style="list-style-type: disclosure-closed;margin-left: 8px;">{{ $error }}</li>
									@endforeach
								</ul>
							</div>
						@endif
					</div>
                    <div class="it-signup-input-wrap">
                      <div class="it-signup-input mb-20">
						<label><strong>Enrollment Number</strong></label>
                        <input type="text" name="enrollment_number" placeholder="Enrollment No. *" />
                      </div>
                      <div class="it-signup-input mb-20">
					  <label><strong>Date of birth</strong></label>
                        <input type="date" name="dob" placeholder="Date of birth *" />
                      </div>
                    </div>
                    <div class="it-signup-forget d-flex justify-content-between flex-wrap">
					{{--<a class="mb-20" href="#">Forgot Password?</a>--}}
                      <div class="it-signup-agree mb-20">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                          <label class="form-check-label" for="flexCheckDefault" > Remember me </label>
                        </div>
                      </div>
                    </div>
                    <div class="it-signup-btn mb-40">
                      <button type="submit" class="it-btn large">sign In</button>
                    </div>
                    {{--<div class="it-signup-text">
                      <span>Don't have an account?<a href="{{ url('register') }}">Sign Up</a></span>
                    </div>--}}
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

    </main>
@endif
@endsection
