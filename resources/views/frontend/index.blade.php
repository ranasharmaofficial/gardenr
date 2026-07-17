@extends('frontend.layouts.master')
@section('title') Home @endsection

@section('meta_tags')

@endsection
@section('content')

    <!-- ========== DYNAMIC BANNER SLIDER ========== -->
    <main class="main">
        <div class="rm-banner-wrapper">
            <div class="home-slider slide-animate owl-carousel owl-theme show-nav-hover nav-big mb-2 text-uppercase rm-dynamic-slider" data-owl-options="{
				'loop': true,
				'autoplay': true,
				'autoplayTimeout': 5000,
				'autoplayHoverPause': true,
				'animateOut': 'fadeOut',
				'animateIn': 'fadeIn',
				'nav': true,
				'dots': true
			}">

                {{-- SLIDE 1 - Fresh Plants Sale --}}
                <div class="home-slide home-slide1 banner rm-slide">
                    <div class="rm-slide-bg" style="background: linear-gradient(to right, rgba(0,0,0,0.55) 40%, rgba(0,0,0,0.15) 100%), url('{{ static_asset('assets/assets_web/images/demoes/demo4/slider/slide-2.jpg') }}') center/cover no-repeat; height: 560px;"></div>
                    <div class="rm-slide-content container">
                        <div class="rm-slide-text appear-animate" data-animation-name="fadeInLeftShorter" data-animation-delay="300">
                            <span class="rm-slide-tag"><i class="fa fa-leaf"></i> NEW SEASON COLLECTION</span>
                            <h4 class="rm-slide-sub">Bring Nature Closer to Your Home!</h4>
                            <h2 class="rm-slide-title">Fresh <span>Plant</span> Collection</h2>
                            <h3 class="rm-slide-offer">Up To <strong>50% Off</strong> — Limited Time</h3>
                            <div class="rm-slide-info">
                                <span><i class="fa fa-truck"></i> Free Delivery</span>
                                <span><i class="fa fa-leaf"></i> 500+ Varieties</span>
                                <span><i class="fa fa-shield-alt"></i> Quality Assured</span>
                            </div>
                            <div class="rm-slide-actions">
                                <a href="{{ route('shop') }}" class="rm-slide-btn rm-slide-btn-primary">
                                    <i class="fa fa-shopping-bag"></i> Shop Now
                                </a>
                                <a href="{{ url('about-us') }}" class="rm-slide-btn rm-slide-btn-outline">
                                    Learn More <i class="fa fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- SLIDE 2 - Pots & Planters --}}
                <div class="home-slide home-slide2 banner rm-slide">
                    <div class="rm-slide-bg" style="background: linear-gradient(to left, rgba(0,0,0,0.55) 40%, rgba(0,0,0,0.15) 100%), url('{{ static_asset('assets/assets_web/images/garden.jpg') }}') center/cover no-repeat; height: 560px;"></div>
                    <div class="rm-slide-content container">
                        <div class="rm-slide-text rm-slide-text-right appear-animate" data-animation-name="fadeInRightShorter" data-animation-delay="300">
                            <span class="rm-slide-tag rm-slide-tag-gold"><i class="fa fa-star"></i> SPECIAL OFFER</span>
                            <h4 class="rm-slide-sub">Premium Quality Pots & Planters</h4>
                            <h2 class="rm-slide-title">Green Garden <span style="color:#81c784;">Sale</span></h2>
                            <h3 class="rm-slide-offer"><strong>30% Off</strong> on All Pots & Planters</h3>
                            <div class="rm-slide-info">
                                <span><i class="fa fa-palette"></i> 100+ Designs</span>
                                <span><i class="fa fa-cube"></i> All Materials</span>
                                <span><i class="fa fa-smile"></i> 5000+ Happy Customers</span>
                            </div>
                            <div class="rm-slide-actions">
                                <a href="{{ route('shop') }}" class="rm-slide-btn rm-slide-btn-gold">
                                    <i class="fa fa-shopping-bag"></i> Explore Collection
                                </a>
                                <a href="{{ route('contact') }}" class="rm-slide-btn rm-slide-btn-outline">
                                    Contact Us <i class="fa fa-phone-alt"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- SLIDE 3 - Business / Join Us --}}
                <div class="home-slide home-slide3 banner rm-slide">
                    <div class="rm-slide-bg" style="background: linear-gradient(135deg, rgba(27,94,32,0.88) 0%, rgba(46,125,50,0.75) 50%, rgba(0,0,0,0.4) 100%), url('{{ static_asset('assets/assets_web/images/demoes/demo4/banners/banner-4.jpg') }}') center/cover no-repeat; height: 560px;"></div>
                    <div class="rm-slide-content container">
                        <div class="rm-slide-text rm-slide-text-center appear-animate" data-animation-name="fadeInUpShorter" data-animation-delay="300">
                            <span class="rm-slide-tag rm-slide-tag-white"><i class="fa fa-chart-line"></i> BUSINESS OPPORTUNITY</span>
                            <h4 class="rm-slide-sub" style="color:#a5d6a7;">Join India's Growing Plant Business Network</h4>
                            <h2 class="rm-slide-title">Grow Your <span style="color:#a5d6a7;">Business</span></h2>
                            <h3 class="rm-slide-offer">Earn <strong>₹15,000–₹1,50,000+</strong> Monthly</h3>
                            <div class="rm-slide-info">
                                <span><i class="fa fa-users"></i> 10,000+ Partners</span>
                                <span><i class="fa fa-rupee-sign"></i> Attractive Commission</span>
                                <span><i class="fa fa-headset"></i> 24/7 Support</span>
                            </div>
                            <div class="rm-slide-actions">
                                <a href="{{ route('register') }}" class="rm-slide-btn rm-slide-btn-primary">
                                    <i class="fa fa-user-plus"></i> Join Now
                                </a>
                                <a href="{{ url('business-plan') }}" class="rm-slide-btn rm-slide-btn-outline">
                                    View Plan <i class="fa fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            {{-- End .home-slider --}}
        </div>



        <div class="container">
            <div class="info-boxes-slider owl-carousel owl-theme mb-2" data-owl-options="{
					'dots': false,
					'loop': false,
					'responsive': {
						'576': {
							'items': 2
						},
						'992': {
							'items': 3
						}
					}
				}">
                <div class="info-box info-box-icon-left">
                    <i class="icon-shipping"></i>

                    <div class="info-box-content">
                        <h4>FREE SHIPPING &amp; RETURN</h4>
                        <p class="text-body">Free shipping on all orders over ₹99.</p>
                    </div>
                    <!-- End .info-box-content -->
                </div>
                <!-- End .info-box -->

                <div class="info-box info-box-icon-left">
                    <i class="icon-money"></i>

                    <div class="info-box-content">
                        <h4>MONEY BACK GUARANTEE</h4>
                        <p class="text-body">100% money back guarantee</p>
                    </div>
                    <!-- End .info-box-content -->
                </div>
                <!-- End .info-box -->

                <div class="info-box info-box-icon-left">
                    <i class="icon-support"></i>

                    <div class="info-box-content">
                        <h4>ONLINE SUPPORT 24/7</h4>
                        <p class="text-body">Lorem ipsum dolor sit amet.</p>
                    </div>
                    <!-- End .info-box-content -->
                </div>
                <!-- End .info-box -->
            </div>
            <!-- End .info-boxes-slider -->

            <!--<div class="banners-container mb-2">
                <div class="banners-slider owl-carousel owl-theme" data-owl-options="{'dots': false}">
                    <div class="banner banner1 banner-sm-vw d-flex align-items-center appear-animate" style="background-color: #ccc;" data-animation-name="fadeInLeftShorter" data-animation-delay="500">
                        <figure class="w-100">
                            <img src="{{ static_asset('assets/assets_web/images/demoes/demo4/banners/b1.jpg') }}" alt="banner" />
                        </figure>
                        <div class="banner-layer">
                            <h3 class="m-b-2">Rich Money</h3>
                            <h4 class="m-b-3 text-primary">
                            <sup class="text-dark"><del>20%</del></sup>40%<sup>OFF</sup></h4>
                            <p class="mb-3">
                                Indoor & Outdoor Plants
                            </p>
                            <a href="" class="btn btn-sm btn-dark">Shop Plants</a>
                        </div>
                    </div>


                    <div class="banner banner2 banner-sm-vw text-uppercase d-flex align-items-center appear-animate" data-animation-name="fadeInUpShorter" data-animation-delay="200">
                        <figure class="w-100">
                            <img src="{{ static_asset('assets/assets_web/images/demoes/demo4/banners/b2.jpg') }}" style="background-color: #ccc;" alt="banner" />
                        </figure>
                        <div class="banner-layer text-center">
                            <div class="row align-items-lg-center">

                                <div class="col-lg-7 text-lg-right">
                                    <h3>Special Plant Offers</h3>
                                    <h4 class="pb-4 pb-lg-0 mb-0 text-body">Starting at ₹199</h4>
                                </div>

                                <div class="col-lg-5 text-lg-left px-0 px-xl-3">
                                    <a href="#" class="btn btn-sm btn-dark">Shop Plants</a>
                                </div>

                            </div>
                        </div>
                    </div>


                    <div class="banner banner3 banner-sm-vw d-flex align-items-center appear-animate" style="background-color: #ccc;" data-animation-name="fadeInRightShorter" data-animation-delay="500">
                        <figure class="w-100">
                            <img src="{{ static_asset('assets/assets_web/images/demoes/demo4/banners/b3.jpg') }}" alt="banner" />
                        </figure>
                        <div class="banner-layer text-right">
                            <h3 class="m-b-2">Indoor Plants</h3>
                            <h4 class="m-b-2 text-secondary text-uppercase">Starting at ₹149</h4>
                           <a href="#" class="btn btn-sm btn-dark">Shop Plants</a>
                        </div>
                    </div>

                </div>
            </div>-->
        </div>
        <!-- End .container -->
        <section class="py-4">
            <div class="container">
                <div class="row g-4">
                    <div class="col-lg-4">
                        <div class="rm-home-highlight h-100">
                            <div style="font-size:1.8rem; color:#4caf50; margin-bottom:10px;"><i class="fa fa-leaf"></i></div>
                            <h4 style="font-weight:700; color:#2e7d32;">Fresh & Healthy Plants</h4>
                            <p class="mb-0" style="color:#5d695f;">Bring home vibrant greenery with expert care and safe delivery.</p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="rm-home-highlight h-100">
                            <div style="font-size:1.8rem; color:#4caf50; margin-bottom:10px;"><i class="fa fa-hand-holding-heart"></i></div>
                            <h4 style="font-weight:700; color:#2e7d32;">Easy Plant Guidance</h4>
                            <p class="mb-0" style="color:#5d695f;">Helpful support for plant care, repotting, and healthy growth.</p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="rm-home-highlight h-100">
                            <div style="font-size:1.8rem; color:#4caf50; margin-bottom:10px;"><i class="fa fa-truck"></i></div>
                            <h4 style="font-weight:700; color:#2e7d32;">Fast Doorstep Delivery</h4>
                            <p class="mb-0" style="color:#5d695f;">Reliable shipping to make your indoor garden setup stress-free.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- =========================
PLANT INFO GRID SECTION
========================= -->
<section class="gxs-service-area">

    <div class="gxs-heading-wrap">
        <h2 class="gxs-main-title">Our Services</h2>
        <p class="gxs-sub-title">
            Complete Green Solutions For Homes, Farms & Commercial Spaces
        </p>
    </div>

    <div class="gxs-grid-layout">

        <!-- CARD 01 -->
        <div class="gxs-card-item">
            <div class="gxs-image-box">
                <!-- <img src="https://gardenr.in/public/assets/assets_web/images/s1.jpg" alt=""> -->
                <img src="{{ static_asset('assets/assets_web/images/s1.jpg') }}" alt="">

                <div class="gxs-dark-layer"></div>

                <a href="#" class="gxs-hover-link">
                    View Details →
                </a>

                <span class="gxs-count-badge">01</span>
            </div>

            <div class="gxs-content-box">
               <h3>Plant Sales</h3>
                <p>Wide range of indoor, outdoor, flowering, ornamental,
                    fruit plants, succulents, herbs and seasonal plants.</p>
            </div>
        </div>

        <!-- CARD 02 -->
        <div class="gxs-card-item">
            <div class="gxs-image-box">
                <img src="{{ static_asset('assets/assets_web/images/s2.jpg') }}" alt="">

                <div class="gxs-dark-layer"></div>

                <a href="#" class="gxs-hover-link">
                    View Details →
                </a>

                <span class="gxs-count-badge">02</span>
            </div>

            <div class="gxs-content-box">
                <h3>Plant Care</h3>
                <p>
                    Expert advice on watering, pruning, repotting,
                    pest control and complete plant health management.
                </p>

            </div>
        </div>

        <!-- CARD 03 -->
        <div class="gxs-card-item">
            <div class="gxs-image-box">
                <!-- <img src="https://gardenr.in/public/assets/assets_web/images/s3.jpg" alt=""> -->
                <img src="{{ static_asset('assets/assets_web/images/s3.jpg') }}" alt="">

                <div class="gxs-dark-layer"></div>

                <a href="#" class="gxs-hover-link">
                    View Details →
                </a>

                <span class="gxs-count-badge">03</span>
            </div>

            <div class="gxs-content-box">
                <h3>Garden Design</h3>
                <p>
                    Beautiful, sustainable and customized garden designs
                    for homes, offices and commercial spaces.
                </p>
            </div>
        </div>

        <!-- CARD 04 -->
        <div class="gxs-card-item">
            <div class="gxs-image-box">
                <!-- <img src="https://gardenr.in/public/assets/assets_web/images/s4.jpg" alt=""> -->
                <img src="{{ static_asset('assets/assets_web/images/s4.jpg') }}" alt="">

                <div class="gxs-dark-layer"></div>

                <a href="#" class="gxs-hover-link">
                    View Details →
                </a>

                <span class="gxs-count-badge">04</span>
            </div>

            <div class="gxs-content-box">
                <h3>Maintenance & Care</h3>
                <p>
                    Regular maintenance services to keep your plants
                    and gardens healthy, clean and thriving.
                </p>

            </div>
        </div>

        <!-- CARD 05 -->
        <div class="gxs-card-item">
            <div class="gxs-image-box">
                <!-- <img src="https://gardenr.in/public/assets/assets_web/images/s5.jpg" alt=""> -->

                <img src="{{ static_asset('assets/assets_web/images/s5.jpg') }}" alt="">

                <div class="gxs-dark-layer"></div>

                <a href="#" class="gxs-hover-link">
                    View Details →
                </a>

                <span class="gxs-count-badge">05</span>
            </div>

            <div class="gxs-content-box">
                  <h3>Terrace & Balcony Gardening</h3>
                <p>
                    Smart solutions to transform terraces and balconies
                    into lush green productive spaces.
                </p>
            </div>
        </div>

        <!-- CARD 06 -->
        <div class="gxs-card-item">
            <div class="gxs-image-box">
                <!-- <img src="https://gardenr.in/public/assets/assets_web/images/s6.jpg" alt=""> -->
                <img src="{{ static_asset('assets/assets_web/images/s6.jpg') }}" alt="">

                <div class="gxs-dark-layer"></div>

                <a href="#" class="gxs-hover-link">
                    View Details →
                </a>

                <span class="gxs-count-badge">06</span>
            </div>

            <div class="gxs-content-box">
                <h3>Urban Farming</h3>
                <p>
                    End-to-end setup and maintenance of kitchen gardens,
                    hydroponics, grow bags and more.
                </p>
            </div>
        </div>
        
         <div class="gxs-card-item">
            <div class="gxs-image-box">
                <!-- <img src="https://gardenr.in/public/assets/assets_web/images/s7.jpg" alt=""> -->
                <img src="{{ static_asset('assets/assets_web/images/s7.jpg') }}" alt="">

                <div class="gxs-dark-layer"></div>

                <a href="#" class="gxs-hover-link">
                    View Details →
                </a>

                <span class="gxs-count-badge">06</span>
            </div>

            <div class="gxs-content-box">
                <h3>Soil Nutritional Management</h3>
                <p>
                    Soil testing, nutrient analysis and customized
                    organic solutions for soil health.
                </p>
            </div>
        </div>
        
         <div class="gxs-card-item">
            <div class="gxs-image-box">
                <!-- <img src="https://gardenr.in/public/assets/assets_web/images/s8.jpg" alt=""> -->
                <img src="{{ static_asset('assets/assets_web/images/s8.jpg') }}" alt="">

                <div class="gxs-dark-layer"></div>

                <a href="#" class="gxs-hover-link">
                    View Details →
                </a>

                <span class="gxs-count-badge">06</span>
            </div>

            <div class="gxs-content-box">
              <h3>Grafted Vegetable Plants</h3>
                <p>
                    Highly-yield and disease resistant grafted vegetable
                    plants for better productivity.
                </p>
            </div>
        </div>

    </div>

</section>

		<section class="featured-products-section">
			<div class="container">
				<h2 class="section-title heading-border ls-20 border-0">Featured Products</h2>

				<div class="products-slider custom-products owl-carousel owl-theme nav-outer show-nav-hover nav-image-center" data-owl-options="{
						'dots': false,
						'nav': true
					}">
					
					@foreach($featured_products as $item)
						@include('frontend.partials.product_box')
					@endforeach

					

				</div>
			</div>
		</section>

       <section class="new-products-section">
    <div class="container">

        <h2 class="section-title heading-border ls-20 border-0">New Arrivals</h2>

        <div class="products-slider custom-products owl-carousel owl-theme nav-outer show-nav-hover nav-image-center mb-2" data-owl-options="{
				'dots': false,
				'nav': true,
				'responsive': {
					'992': {
						'items': 4
					},
					'1200': {
						'items': 5
					}
				}
			}">

            @foreach($new_products as $item)
				@include('frontend.partials.product_box')
			@endforeach

        </div>

        <div class="banner banner-big-sale appear-animate" data-animation-delay="200" data-animation-name="fadeInUpShorter" style="background: #2A95CB center/cover url('{{ static_asset('assets/assets_web/images/demoes/demo4/banners/banner-4.jpg') }}');">
            <div class="banner-content row align-items-center mx-0">

                <div class="col-md-9 col-sm-8">
                    <h2 class="text-white text-uppercase text-center text-sm-left ls-n-20 mb-md-0 px-4">
                        <b class="d-inline-block mr-3 mb-1 mb-md-0">Fresh Plants</b>
                        Bring nature home with premium indoor & outdoor plants
                        <small class="text-transform-none align-middle">Healthy & Fresh Green Collection</small>
                    </h2>
                </div>

                <div class="col-md-3 col-sm-4 text-center text-sm-right">
                    <a class="btn btn-light btn-white btn-lg" href="{{ route('shop') }}">View All</a>
                </div>

            </div>
        </div>

        <h2 class="section-title categories-section-title heading-border border-0 ls-0 appear-animate"
            data-animation-delay="100" data-animation-name="fadeInUpShorter">
            Plant Categories
        </h2>

        <div class="categories-slider owl-carousel owl-theme show-nav-hover nav-outer">

            @foreach($categories as $cat)
            <div class="product-category appear-animate" data-animation-name="fadeInUpShorter">
                <a href="{{ route('category.slug', $cat->slug) }}">
                    <figure>
                        <img src="{{ static_asset('assets/assets_web/images/categories/g1.jpg') }}" alt="{{ $cat->name }}" width="280" height="240" style="width: 100%; height: 240px; object-fit: cover; object-position: center;" />
                    </figure>
                    <div class="category-content">
                        <h3>{{ $cat->name }}</h3>
                        <span><mark class="count">{{ \App\Models\Product::where('category_id', $cat->id)->where('status',1)->count() }}</mark> products</span>
                    </div>
                </a>
            </div>
            @endforeach

        </div>
    </div>
</section>
        <section class="feature-boxes-container">
            <div class="container appear-animate" data-animation-name="fadeInUpShorter">
                <div class="row">
                    <div class="col-md-4">
                        <div class="feature-box px-sm-5 feature-box-simple text-center">
                            <div class="feature-box-icon">
                                <i class="icon-earphones-alt"></i>
                            </div>

                            <div class="feature-box-content p-0">
                                <h3>Plant Care Support</h3>
                                <h5>We Help Your Garden Grow</h5>

                                <p>Our gardening experts are always ready to guide you with plant care tips, watering advice, and maintenance support for a healthy green space.</p>
                            </div>
                            <!-- End .feature-box-content -->
                        </div>
                        <!-- End .feature-box -->
                    </div>
                    <!-- End .col-md-4 -->

                    <div class="col-md-4">
                        <div class="feature-box px-sm-5 feature-box-simple text-center">
                            <div class="feature-box-icon">
                                <i class="icon-credit-card"></i>
                            </div>

                            <div class="feature-box-content p-0">
                                <h3>Wide Plant Collection</h3>
                                <h5>Beautiful Plants For Every Space</h5>

                                <p>Explore a wide range of indoor plants, outdoor plants, flowering varieties, and decorative pots carefully selected for your home and garden.</p>
                            </div>
                            <!-- End .feature-box-content -->
                        </div>
                        <!-- End .feature-box -->
                    </div>
                    <!-- End .col-md-4 -->

                    <div class="col-md-4">
                        <div class="feature-box px-sm-5 feature-box-simple text-center">
                            <div class="feature-box-icon">
                                <i class="icon-action-undo"></i>
                            </div>
                            <div class="feature-box-content p-0">
                                <h3>Fresh & Healthy Plants</h3>
                                <h5>Quality You Can Trust</h5>

                                <p>We provide fresh, healthy, and well-maintained plants that bring natural beauty, freshness, and positive vibes to your living environment.</p>
                            </div>
                            <!-- End .feature-box-content -->
                        </div>
                        <!-- End .feature-box -->
                    </div>
                    <!-- End .col-md-4 -->
                </div>
                <!-- End .row -->
            </div>
            <!-- End .container-->
        </section>


        <!--<section class="promo-section bg-dark" data-parallax="{'speed': 2, 'enableOnMobile': true}" data-image-src="{{ static_asset('assets/assets_web/images/demoes/demo4/banners/banner-5.jpg') }}">
    <div class="promo-banner banner container text-uppercase">
        <div class="banner-content row align-items-center text-center">
            <div class="col-md-4 ml-xl-auto text-md-right appear-animate" data-animation-name="fadeInRightShorter" data-animation-delay="600">
                <h2 class="mb-md-0 text-white">Fresh Indoor Plants</h2>
            </div>

            <div class="col-md-4 col-xl-3 pb-4 pb-md-0 appear-animate" data-animation-name="fadeIn" data-animation-delay="300">
                <a href="#" class="btn btn-dark btn-black ls-10">Shop Now</a>
            </div>

            <div class="col-md-4 mr-xl-auto text-md-left appear-animate" data-animation-name="fadeInLeftShorter" data-animation-delay="600">
                <h4 class="mb-1 mt-1 font1 coupon-sale-text p-0 d-block ls-n-10 text-transform-none">
                    <b>Special
                        OFFER</b>
                </h4>

                <h5 class="mb-1 coupon-sale-text text-white ls-10 p-0">
                    <i class="ls-0">UP TO</i>
                    <b class="text-white bg-secondary ls-n-10">50%</b> OFF
                </h5>
            </div>
        </div>
    </div>
</section>-->

        <p style="margin: 0;"><img src="{{ static_asset('assets/assets_web/images/garden.jpg') }}" alt="Garden banner" style="display: block; width: 100%; height: 560px; object-fit: cover; object-position: center;"></p>

       <section class="blog-section pb-0">
    <div class="container">

        <h2 class="section-title heading-border border-0 appear-animate" data-animation-name="fadeInUp">
            Combo Offer
        </h2>

        <div class="owl-carousel owl-theme appear-animate" data-animation-name="fadeIn" data-owl-options="{
				'loop': false,
				'margin': 20,
				'autoHeight': true,
				'autoplay': false,
				'dots': false,
				'items': 2,
				'responsive': {
					'0': {
						'items': 1
					},
					'480': {
						'items': 2
					},
					'576': {
						'items': 3
					},
					'768': {
						'items': 4
					}
				}
			}">

            @foreach($all_products as $item)
            <article class="post">
                <div class="post-media">
                    <a href="{{ url('product/'.$item->slug) }}">
                        <img src="{{ static_asset($item->thumbnail) }}" alt="{{ $item->name }}" width="225" height="280">
                    </a>
                </div>

                <div class="post-body">
                    <h2 class="post-title" align="center">
                        <a href="{{ url('product/'.$item->slug) }}">{{ $item->name }}</a>
                    </h2>
                </div>
            </article>
            @endforeach

        </div>

        <hr class="mt-0 m-b-5">

    </div>
</section>
    </main>

    <section class="tg-about-section">
        <div class="container">
            <div class="tg-about-wrapper">

                <div class="tg-section-title">
                    <h2>About Rich Money</h2>

                    <p>
                        Rich Money is your trusted online destination for beautiful indoor plants, flowering plants, succulents, and premium gardening essentials. We bring fresh, healthy, and carefully nurtured plants directly to your doorstep to make your home greener and
                        more vibrant. Whether you are a beginner or a passionate plant lover, Rich Money helps you create your perfect green space with ease.
                    </p>
                </div>

                <div class="row tg-feature-row">

                    <div class="col-lg-4 col-md-4 col-12">
                        <div class="tg-feature-box">
                            <div class="tg-icon">
                                <i class="fas fa-sync-alt"></i>
                            </div>

                            <h4>Easy Plant Replacement</h4>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-4 col-12">
                        <div class="tg-feature-box">
                            <div class="tg-icon">
                                <i class="icon-heart"></i>
                            </div>

                            <h4>Expert Plant Care Guidance</h4>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-4 col-12">
                        <div class="tg-feature-box">
                            <div class="tg-icon">
                                <i class="icon-star"></i>
                            </div>

                            <h4>Trusted By Plant Lovers</h4>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>
    <!-- End .main -->
<script>


    $(document).on('click', '.home_form_make_enquiry', function(e) {
        e.preventDefault();
        var clk_btn = $(".make_enquiry");
        clk_btn.prop('disabled', true);
        var formData = new FormData(document.getElementById("home-enquiry-form"));
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }

        });
        $.ajax({
            type: "POST"
            , url: "{{ route('enq.homePageEnquiry') }}"
            , data: formData
            , processData: false
            , contentType: false
            , dataType: "JSON"
            , success: function(data) {
                // console.log('status ' + data.status);
                if (data.status == true) {
                    toastr.success('Thanyou For Your Enquiry.');
                    location.reload();
                } else {
                    toastr.error('Something went wrong.');
                }
            }
            , error: function(err) {

                document.getElementById('show-contact-form-error').style = "display: block";
                clk_btn.prop('disabled', false);
                let error = err.responseJSON;
                console.log(error);
                $.each(error.errors, function(index, value) {
                    $('.errorMsgntainer').append('<span class="text-danger">' + value +

                        '<span>' + '<br>');
                });

            }
        });
    });

</script>
@endsection
