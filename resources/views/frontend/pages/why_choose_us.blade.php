@extends('frontend.layouts.master')
@section('title') Why Choose Us @endsection
@section('content')
<section id="ed-breadcrumb" class="ed-breadcrumb-sec" data-background="{{ static_asset('assets/assets_web/images/header-about5.jpg') }}">
		<div class="container">
			<div class="ed-breadcrumb-content">
				<div class="ed-breadcrumb-text text-center headline ul-li">
					<h2 class="bread_title">Why Choose Us</h2>
					<ul>
						<li><a href="{{ url('') }}">Home</a></li>
						<li>Why Choose Us </li>
					</ul>
				</div>
			</div>
		</div>
	</section>

<!-- Start of Feature section
  ============================================= -->
<section class="why-choose modern-section py-5 premium-mv-section">
    <div class="container text-center">
         <h2 class="mv-title animate-item stagger">
                        Why Choose <span class="highlight">V2FBaazar</span>
                    </h2>
					 
        <p class="section-subtitle mb-5 animate-item stagger">
            Smart choices for your home — quality, comfort, and trust delivered to you.
        </p>

       <div class="row justify-content-center gradient-section">

    <div class="col-md-3 col-6 mb-4 animate-item stagger">
        <div class="gradient-box">
            <div class="gradient-icon">
                <i class="fas fa-th-large"></i>
            </div>
            <h5>Wide Product Range</h5>
            <p>Everything you need for your home in one place.</p>
        </div>
    </div>

    <div class="col-md-3 col-6 mb-4 animate-item stagger">
        <div class="gradient-box">
            <div class="gradient-icon">
                <i class="fas fa-tags"></i>
            </div>
            <h5>Best Prices</h5>
            <p>Top quality at unbeatable prices.</p>
        </div>
    </div>

    <div class="col-md-3 col-6 mb-4 animate-item stagger">
        <div class="gradient-box">
            <div class="gradient-icon">
                <i class="fas fa-shield-alt"></i>
            </div>
            <h5>Reliable Quality</h5>
            <p>Durable products from trusted brands.</p>
        </div>
    </div>

    <div class="col-md-3 col-6 mb-4 animate-item stagger">
        <div class="gradient-box">
            <div class="gradient-icon">
                <i class="fas fa-truck-fast"></i>
            </div>
            <h5>Fast Delivery</h5>
            <p>Quick & safe delivery to your doorstep.</p>
        </div>
    </div>

</div>



    </div>
</section>
 
@endsection
