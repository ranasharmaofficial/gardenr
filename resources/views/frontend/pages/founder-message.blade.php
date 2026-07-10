@extends('frontend.layouts.master')
@section('title') Founder's Message @endsection
@section('content')
<section id="ed-breadcrumb" class="ed-breadcrumb-sec" data-background="{{ static_asset('assets/assets_web/images/header-about5.jpg')}}">
		<div class="container">
			<div class="ed-breadcrumb-content">
				<div class="ed-breadcrumb-text text-center headline ul-li">
					<h2 class="bread_title">Founder's Message</h2>
					<ul>
						<li><a href="{{ url('') }}">Home</a></li>
						<li>Founder's Message </li>
					</ul>
				</div>
			</div>
		</div>
	</section>

<!-- Start of Feature section
  ============================================= -->
 
 
<!-- Start of Founder's Message
  ============================================= -->
  
  <section style="background-position: right top, right 60%, left 100%;
				   background-size: 99% 274%;
				   background-repeat: no-repeat;
				   background-color: #000;
				   background-image: url(public/assets/assets_web/images/Cloud-Solutions-Hero-BG.webp);" class="product-section py-5 premium-mv-section animate-item stagger">
    <div class="container text-center">

        <div class="mv-content justify-content-center">
            <h2 class="mv-title">
                <span style="color:#fff;">Founder's</span> <span class="highlight">Message</span>
            </h2>
        </div>

        <div class="row justify-content-center mt-4">

            <div class="col-md-6 col-10 animate-item stagger">
                <div class="founder-card">

                    <div class="founder-photo">
                        <img src="{{ static_asset('assets/assets_web/images/founder.jpg') }}" alt="Founder Photo">
                    </div>

                    <h3 class="founder-name">Mr. Pradeep Prakash</h3>
                    <p class="founder-role">Founder, V2FBaazar</p>

                    <p class="founder-message">
                        At V2FBaazar, our goal is simple — to bring premium-quality home products 
                        within the reach of every family. We believe that comfort, convenience, and 
                        durability should never be compromised, especially when it comes to creating 
                        a better living environment.
                        <br><br>
                        My vision is to build a brand that people trust — where every customer feels 
                        valued, supported, and confident about what they buy. With honesty, transparent 
                        pricing, and reliable service, we strive to make V2FBaazar a household name 
                        across Bihar.
                        <br><br>
                        Thank you for choosing V2FBaazar. Together, let’s build better homes and better lives.
                    </p>

                </div>
            </div>

        </div>

    </div>
</section>
 

@endsection
