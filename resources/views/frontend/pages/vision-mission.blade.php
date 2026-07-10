@extends('frontend.layouts.master')
@section('title') Vision & Mission @endsection
@section('content')
<section id="ed-breadcrumb" class="ed-breadcrumb-sec" data-background="{{ static_asset('assets/assets_web/images/header-about5.jpg')}}">
		<div class="container">
			<div class="ed-breadcrumb-content">
				<div class="ed-breadcrumb-text text-center headline ul-li">
					<h2 class="bread_title">Vision & Mission</h2>
					<ul>
						<li><a href="{{ url('') }}">Home</a></li>
						<li>Vision & Mission </li>
					</ul>
				</div>
			</div>
		</div>
	</section>

<!-- Start of Feature section
  ============================================= -->
 
 
<!-- Start of Mission & Vision
  ============================================= -->
<section id="mission-vision" class="premium-mv-section py-120 animate-item stagger">
    <div class="container">
        <div class="row align-items-center justify-content-center g-5">

            <!-- Left Text -->
            <div class="col-lg-6 animate-item stagger">
                <div class="mv-content">
					<h2 class="mv-title">
						Our <span class="highlight">Mission</span> & <span class="highlight">Vision</span>
					</h2>

					<p class="mv-desc mt-4">
						At V2FBaazar, we are dedicated to transforming the way households across Bihar buy 
						furniture, appliances, and home essentials. We aim to make modern living accessible, 
						affordable, and reliable for every family.
					</p>

					<!-- Mission -->
					<div class="mv-box mt-4 animate-item stagger">
						<span class="mv-icon"><i class="fas fa-bullseye"></i></span>
						<div>
							<h4>Our Mission</h4>
							<p>
								To provide high-quality, durable, and affordable home products — from palang 
								to refrigerators and Godrej-style almirahs — backed by transparent pricing, 
								customer support, and safe delivery to every doorstep.
							</p>
						</div>
					</div>

					<!-- Vision -->
					<div class="mv-box mt-4 animate-item stagger">
						<span class="mv-icon"><i class="fas fa-eye"></i></span>
						<div>
							<h4>Our Vision</h4>
							<p>
								To become Bihar’s most trusted home solutions brand by offering a wide range 
								of reliable products, exceptional service, and a seamless shopping experience 
								that helps families create comfortable and modern living spaces.
							</p>
						</div>
					</div>

				</div>

            </div>

            <!-- Right Image -->
            <div class="col-lg-5 animate-item stagger">
                <div class="mv-img-wrap">
                    <img src="{{ static_asset('assets/assets_web/images/mission.jpg') }}" alt="Mission Vision">
                </div>
            </div>

        </div>
    </div>
</section>

@endsection
