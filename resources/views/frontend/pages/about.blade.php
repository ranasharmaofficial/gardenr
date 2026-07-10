@extends('frontend.layouts.master')
@section('title') About Us @endsection
@section('content')
<section id="ed-breadcrumb" class="ed-breadcrumb-sec" data-background="{{ static_asset('assets/assets_web/images/header-about5.jpg') }}">
		<div class="container">
			<div class="ed-breadcrumb-content">
				<div class="ed-breadcrumb-text text-center headline ul-li">
					<h2 class="bread_title">About Us</h2>
					<ul>
						<li><a href="./">Home</a></li>
						<li>About Us </li>
					</ul>
				</div>
			</div>
		</div>
	</section>
<section id="ed-about-2" class="premium-about-section py-120">
    <div class="container">
        <div class="row align-items-center justify-content-center g-5">

            <!-- Left Image -->
            <div class="col-lg-5 animate-item stagger">
                <div class="about-img-wrap">
                    <img src="{{ static_asset('assets/assets_web/images/ab2.jpg') }}" alt="About Image">
                </div>
            </div>

            <!-- Right Content -->
            <div class="col-lg-6 animate-item stagger">
                <div class="about-content">
                    <h2 class="about-title">
                        About Us – <span class="highlight">V2F BAAZAR</span>
                    </h2>

                    <p class="about-desc mt-4">
						V2FBaazar is a trusted and fast-growing home solutions brand committed to transforming 
						the shopping experience for families across Bihar. Built on the foundation of quality, 
						affordability, and customer satisfaction, we provide a wide selection of home essentials 
						designed to improve everyday living.  
						<br><br>

						Our product range includes premium palang, durable steel and Godrej-style almirahs, 
						energy-efficient refrigerators, high-performance washing machines, kitchen appliances, 
						and essential household products — all carefully selected to meet the diverse needs of 
						modern homes. Every product we offer goes through a quality check to ensure durability, 
						functionality, and long-lasting performance.  
						<br><br>

						At V2FBaazar, we believe that making a home comfortable should not be expensive or complicated. 
						That’s why we focus on transparent pricing, reliable service, and honest product value. 
						Our team is dedicated to helping customers make informed choices by providing clear 
						information, assisting in product comparison, and offering dependable after-sales support.  
						<br><br>

						We take pride in our customer-first approach — from fast and secure delivery to 
						doorstep support and personalized assistance. Whether you are furnishing a new home 
						or upgrading your existing space, V2FBaazar is your one-stop destination for trusted 
						home solutions.  
						<br><br>

						With a commitment to continuous improvement, we aim to expand our offerings, introduce 
						more trusted brands, and make modern lifestyle products accessible to families in every 
						corner of Bihar. V2FBaazar is not just a shopping destination — it is a partner in 
						building better homes, better comfort, and better living for every customer we serve.
					</p>


                    <div class="about-features mt-4">
						<div class="feature-item animate-item"><span class="feature-icon">🏆</span> <div><h5>Quality Products</h5><p>Genuine and durable items for every home</p></div></div>
						<div class="feature-item animate-item"><span class="feature-icon">💸</span> <div><h5>Best Prices</h5><p>Affordable rates with great value</p></div></div>
						<div class="feature-item animate-item"><span class="feature-icon">🚚</span> <div><h5>Fast Delivery</h5><p>Quick and safe delivery to your doorstep</p></div></div>
						<div class="feature-item animate-item"><span class="feature-icon">🔒</span> <div><h5>Trusted Brand</h5><p>Reliable service and customer-first approach</p></div></div>
					</div>

                    
                </div>
            </div>

        </div>
    </div>
</section>


 
<!-- Start of Sponsor section
  ============================================= -->
<section id="ed-cta-3" class="ed-cta-sec-3 position-relative">
    <div class="ed-sec-bg position-absolute">
        <img src="{{ static_asset('assets/assets_web/images/cta-bg.jpg') }}" alt="">
    </div>

    <div class="container">
        <div class="ed-cta-content-3 text-center">
            <div class="ed-sec-title-3 text-center headline-3 pera-content">

                <div class="subtitle ed-sec-tt-anim ed-has-anim-char">
                    Upgrade your home with premium furniture, trusted appliances, 
                    and high-quality essentials from <strong>V2FBaazar</strong>. 
                    Enjoy great prices, reliable products, and fast delivery.
                </div>

                <h2 class="sec_title text-light ed-sec-tt-anim ed-has-anim">
                    Shop Now – Bring Comfort & Quality Home
                </h2>
            </div>

            <div class="ed-btn-3">
                <a href="/products">
                    <span data-back="Browse Products" data-front="Browse Products"></span>
                    <img src="{{ static_asset('assets/assets_web/images/arrow-3.png') }}" alt="">
                </a>
            </div>
        </div>
    </div>
</section>

<!-- End of Blog section
  ============================================= -->
@endsection
