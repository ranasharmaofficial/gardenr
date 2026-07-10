<!-- header area -->
  @php
	$header_logo = get_business_single_cache_value('header_logo', 'header_setup', 'header_logo');
  $social_medias = get_business_multiple_cache_value('social_medias', 'social_media');
  $corporate_address = get_business_single_cache_value('corporate_address', 'footer_setup', 'corporate_address');

  $contact_working_hr = get_business_single_cache_value('contact_working_hr', 'footer_setup', 'contact_working_hr');
  $contact_email = get_business_single_cache_value('contact_email', 'footer_setup', 'contact_email');
  $contact_phone = get_business_single_cache_value('contact_phone', 'footer_setup', 'contact_phone');
  $contact_address = get_business_single_cache_value('contact_address', 'footer_setup', 'contact_address');

  $header_phone = get_business_single_cache_value('header_phone', 'header_setup', 'header_phone');
  $header_email = get_business_single_cache_value('header_email', 'header_setup', 'header_email');

  $header_whatsapp = get_business_single_cache_value('whatsapp', 'header_setup', 'whatsapp');
  $header_skype = get_business_single_cache_value('skype', 'header_setup', 'skype');
  $header_address = get_business_single_cache_value('header_address', 'header_setup', 'header_address');
  $header_website = get_business_single_cache_value('header_website', 'header_setup', 'header_website');
  $header_phone = get_business_single_cache_value('header_phone', 'header_setup', 'header_phone');
  $header_email = get_business_single_cache_value('header_email', 'header_setup', 'header_email');


  @endphp

 @php
    $facebook_value = \App\Models\BusinessSetting::where('type', 'social_media')
                                        ->where('field_name', 'facebook')
                                        ->pluck('value')
                                        ->first();
    $instagram_value = \App\Models\BusinessSetting::where('type', 'social_media')
                                        ->where('field_name', 'instagram')
                                        ->pluck('value')
                                        ->first();
    $youtube_value = \App\Models\BusinessSetting::where('type', 'social_media')
                                        ->where('field_name', 'skype')
                                        ->pluck('value')
                                        ->first();
    $twitter_value = \App\Models\BusinessSetting::where('type', 'social_media')
                                        ->where('field_name', 'twitter')
                                        ->pluck('value')
                                        ->first();
@endphp



 	<div class="page-wrapper">
        <div class="top-notice bg-primary text-white">
            <div class="container text-center">
                <h5 class="d-inline-block">Get Up to <b>40% OFF</b> New-Season Styles</h5>

                <small>* Limited time only.</small>
                <button title="Close (Esc)" type="button" class="mfp-close">×</button>
            </div>
            <!-- End .container -->
        </div>
        <!-- End .top-notice -->

        <header class="header">
            <div class="header-top">
                <div class="container">
                    <div class="header-left d-none d-sm-block">
                        <p class="top-message text-uppercase">FREE Returns. Standard Shipping Orders above ₹199</p>
                    </div>
                    <!-- End .header-left -->

                    <div class="header-right header-dropdowns ml-0 ml-sm-auto w-sm-100">
                        <div class="header-dropdown dropdown-expanded d-none d-lg-block">
                            <a href="#">Links</a>
                            <div class="header-menu">
                                <ul>
                                    <li><a href="{{ route('profile') }}">My Account</a></li>
                                    <li><a href="{{ route('about') }}">About Us</a></li>
                                    <li><a href="{{ route('blogs') }}">Blog</a></li>
                                    <li><a href="{{ route('wishlist') }}">My Wishlist</a></li>
                                    <li><a href="{{ route('cart.page') }}">Cart</a></li>
                                    <li><a href="{{ route('login') }}">Log In</a></li>
                                </ul>
                            </div>
                            <!-- End .header-menu -->
                        </div>
                        <!-- End .header-dropown -->

                        <span class="separator"></span>

                    </div>
                    <!-- End .container -->
                </div>
                <!-- End .header-top -->

                <div class="header-middle sticky-header" data-sticky-options="{'mobile': true}">
                    <div class="container">
                        <div class="header-left col-lg-2 w-auto pl-0">
                            <button class="mobile-menu-toggler text-primary mr-2" type="button">
                                <i class="fas fa-bars"></i>
                            </button>
                            <a href="{{ url('') }}" class="logo">
                                <img src="{{ static_asset('assets/assets_web/images/logo.png') }}" alt="Porto Logo">
                            </a>
                        </div>
                        <!-- End .header-left -->

                        <div class="header-right w-lg-max">
                            <div class="header-icon header-search header-search-inline header-search-category w-lg-max text-right mt-0">
                                <a href="#" class="search-toggle" role="button"><i class="icon-search-3"></i></a>
                                <form action="#" method="get">
                                    <div class="header-search-wrapper">
                                        <input type="search" class="form-control" name="q" id="q" placeholder="Search..." required>
                                        <div class="select-custom">
                                            <select id="cat" name="cat">
                                                <option value="">All Plant Categories</option>

                                                <option value="1">Indoor Plants</option>
                                                <option value="2">Outdoor Plants</option>

                                                <option value="3">- Flowering Plants</option>
                                                <option value="4">- Decorative Plants</option>
                                                <option value="5">- Air Purifier Plants</option>

                                                <option value="6">Trees & Saplings</option>
                                                <option value="7">Fruit Plants</option>
                                                <option value="8">Medicinal Plants</option>

                                                <option value="9">Cactus & Succulents</option>
                                                <option value="10">Bonsai Plants</option>

                                                <option value="11">Seeds & Bulbs</option>
                                                <option value="12">Gardening Tools</option>

                                                <option value="13">Soil & Fertilizers</option>
                                                <option value="14">Pots & Planters</option>

                                                <option value="15">Hanging & Balcony Plants</option>
                                            </select>
                                        </div>
                                        <!-- End .select-custom -->
                                        <button class="btn icon-magnifier p-0" title="search" type="submit"></button>
                                    </div>
                                    <!-- End .header-search-wrapper -->
                                </form>
                            </div>
                            <!-- End .header-search -->

                            <div class="header-contact d-none d-lg-flex pl-4 pr-4">
                                <img alt="phone" src="{{ static_asset('assets/assets_web/images/phone.png') }}" width="30" height="30" class="pb-1">
                                <h6><span>Call us now</span><a href="tel:+91 9835034894" class="text-dark font1">+91 9835034894</a></h6>
                            </div>

                            <a href="{{ url('login') }}" class="header-icon" title="login"><i class="icon-user-2"></i></a>

                            <a href="{{ url('wishlist') }}" class="header-icon" title="wishlist"><i class="icon-wishlist-2"></i></a>
							
							<div class="dropdown cart-dropdown">

								<a href="#" title="Cart" class="dropdown-toggle dropdown-arrow cart-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                                    <i class="minicart-icon"></i>
                                    <span class="cart-count badge-circle" id="cartCount">0</span>
                                </a>

								<div class="cart-overlay"></div>

								<div class="dropdown-menu mobile-cart">

									<a href="#" class="btn-close">×</a>

									<div class="dropdownmenu-wrapper custom-scrollbar"
										 id="cartHeaderArea">

										<!-- AJAX CONTENT HERE -->
										@include('frontend.ajax.cart_header')

									</div>

								</div>

							</div>

                             
                        </div>
                        <!-- End .header-right -->
                    </div>
                    <!-- End .container -->
                </div>
                <!-- End .header-middle -->

                <div class="header-bottom sticky-header d-none d-lg-block" data-sticky-options="{'mobile': false}">
                    <div class="container container-menu">
                        <nav class="main-nav w-100">
    <ul class="menu">

        <li class="{{ request()->is('/') || request()->is('index') ? 'active' : '' }}">
            <a href="{{ url('') }}">Home</a>
        </li>

        <li class="{{ request()->is('category') || request()->is('category/*') || request()->is('shop') ? 'active' : '' }}">
            <a href="{{ route('shop') }}">Plants</a>
            <div class="megamenu megamenu-fixed-width megamenu-3cols">
                <div class="row">

                    <div class="col-lg-3">
                        <a href="{{ route('shop') }}" class="nolink">Plants By Type</a>
                        <ul class="submenu">
                            <li class=""><a class="level1" href="{{ route('shop') }}"><span>Indoor Plants</span></a></li>
                            <li class="s1" style="list-style: none;"><a class="level1" href="{{ route('shop') }}"><span>Outdoor Plants</span></a></li>
                            <!--li class="s1" style="list-style: none;"><a class="level1" href=""><span>Prosperity Plants</span></a></li-->
                            <!--li class="s1" style="list-style: none;"><a class="level1" href=""><span>Herb Plants</span></a></li-->
                            <li class="s1" style="list-style: none;"><a class="level1" href="{{ route('shop') }}"><span>Flower Plants</span></a></li>
                            <li class="s1" style="list-style: none;"><a class="level1" href="{{ route('shop') }}"><span>Low maintenance Plants</span></a></li>
                            <!--li class="s1" style="list-style: none;"><a class="level1" href="gard-oxygen-plants.html"><span>Oxygen Plants</span></a></li-->
                            <li class="s1" style="list-style: none;"><a class="level1" href="{{ route('shop') }}"><span>Air-Purifier Plants</span></a></li>
                            <li class="s1" style="list-style: none;"><a class="level1" href="{{ route('shop') }}"><span>Cactus &amp; Succulent Plants </span></a></li>
                            <li class="s1" style="list-style: none;"><a class="level1" href="{{ route('shop') }}"><span>Fruit Plants </span></a></li>
                        </ul>
                    </div>

                    <div class="col-lg-3">
                        <a href="{{ route('shop') }}" class="nolink">Essential Plants</a>
                        <ul class="submenu">
                            <li class="s1" style="list-style: none;"><a class="level1" href="{{ route('shop') }}"><span>Money Plants</span></a></li>
                            <li class="s1" style="list-style: none;"><a class="level1" href="{{ route('shop') }}"><span>Lucky Bamboo Plants</span></a></li>
                            <li class="s1" style="list-style: none;"><a class="level1" href="{{ route('shop') }}"><span>Bonsai Plants</span></a></li>
                            <!--li class="s1" style="list-style: none;"><a class="level1" href="gard-shami-plant.html"><span>Shami(Shani) Plants</span></a></li-->
                            <li class="s1" style="list-style: none;"><a class="level1" href="{{ route('shop') }}"><span>Spiritual And Vastu Plants</span></a></li>
                            <li class="s1" style="list-style: none;"><a class="level1" href="{{ route('shop') }}"><span>Flowering Plants</span></a></li>
                        </ul>
                    </div>

                    <div class="col-lg-3">
                        <a href="{{ route('shop') }}" class="nolink">Plants by Location</a>
                        <ul class="submenu">
                            <li class="s1" style="list-style: none;"><a class="level1" href="{{ route('shop') }}"><span>Bedroom Plants</span></a></li>
                            <li class="s1" style="list-style: none;"><a class="level1" href="{{ route('shop') }}"><span>Kitchen Plants</span></a></li>
                            <li class="s1" style="list-style: none;"><a class="level1" href="{{ route('shop') }}"><span>Living Room Plants</span></a></li>
                            <li class="s1" style="list-style: none;"><a class="level1" href="{{ route('shop') }}"><span>Office Desk Plants</span></a></li>
                            <!--li class="s1" style="list-style: none;"><a class="level1" href="gard-office-reception-plants.html"><span>Office Reception Plants</span></a></li>
                            <li class="s1" style="list-style: none;"><a class="level1" href="gard-office-working-area-plants.html"><span>Office Working Area Plants</span></a></li-->
                            <li class="s1" style="list-style: none;"><a class="level1" href="{{ route('shop') }}"><span>Plants For Shop</span></a></li>
                            <li class="s1" style="list-style: none;"><a class="level1" href="{{ route('shop') }}"><span>Bathroom Plants</span></a></li>
                        </ul>
                    </div>

                    <div class="col-lg-3">
                        <a href="{{ route('shop') }}" class="nolink">Plants by Season</a>
                        <ul class="submenu">
                            <li class="s1" style="list-style: none;"><a class="level1" href="{{ route('shop') }}"><span>Summer Plants</span></a></li>
                            <li class="s1" style="list-style: none;"><a class="level1" href="{{ route('shop') }}"><span>Winter Plants</span></a></li>
                            <li class="s1" style="list-style: none;"><a class="level1" href="{{ route('shop') }}"><span>All Season Plants</span></a></li>
                            <li class="s1" style="list-style: none;"><a class="level1" href="{{ route('shop') }}"><span>Small Plants</span></a></li>
                            <li class="s1" style="list-style: none;"><a class="level1" href="{{ route('shop') }}"><span>Medium Plants</span></a></li>
                        </ul>
                    </div>

                </div>
            </div>
        </li>

        <li>
            <a href="{{ route('shop') }}">Pots &amp; Planters </a>
            <ul>
                <li>
                    <p class="menu_text menu-title2" align="center"><b>Pots By Material</b></p>
                </li>
                <li class="s1" style="list-style: none;"><a class="level1" href="{{ route('shop') }}"><span>Plastic Pots</span></a></li>
                <li class="s1" style="list-style: none;"><a class="level1" href="{{ route('shop') }}"><span>Ceramic Pots</span></a></li>
                <li class="s1" style="list-style: none;"><a class="level1" href="{{ route('shop') }}"><span>Resin Pots</span></a></li>
            </ul>
        </li>

        <li>
            <a href="{{ route('shop') }}">Gifts</a>
            <ul>
                <li>
                    <p class="menu_text menu-title2" align="center"><b>PLANTS for GIFT</b></p>
                </li>
                <li class="s1" style="list-style: none;"><a class="level1" href="{{ route('shop') }}"><span>Plants for Anniversary</span></a></li>
                <li class="s1" style="list-style: none;"><a class="level1" href="{{ route('shop') }}"><span>Plants for Birthday</span></a></li>
                <li class="s1" style="list-style: none;"><a class="level1" href="{{ route('shop') }}"><span>Plants for Expressing Love</span></a></li>
                <li class="s1" style="list-style: none;"><a class="level1" href="{{ route('shop') }}"><span>Plants for Farewell</span></a></li>
                <li class="s1" style="list-style: none;"><a class="level1" href="{{ route('shop') }}"><span>Good Luck Plants</span></a></li>
                <li class="s1" style="list-style: none;"><a class="level1" href="{{ route('shop') }}"><span>Plants for Friends</span></a></li>
                <li class="s1" style="list-style: none;"><a class="level1" href="{{ route('shop') }}"><span>Plants for Get Well Soon</span></a></li>
                <li class="s1" style="list-style: none;"><a class="level1" href="{{ route('shop') }}"><span>Plants for Marriage</span></a></li>
                <li class="s1" style="list-style: none;"><a class="level1" href="{{ route('shop') }}"><span>Plants for Office</span></a></li>
            </ul>
        </li>

        <li>
            <a href="{{ route('shop') }}">Tools &amp; Accessories</a>
            <ul>
                <li class="s1" style="list-style: none; margin-top: 20px;"><a class="level1" href="{{ route('shop') }}"><span>Gardening Pebbles</span></a></li>
                <li class="s1" style="list-style: none;"><a class="level1" href="{{ route('shop') }}"><span>Watering</span></a></li>
                <li class="s1" style="list-style: none;"><a class="level1" href="{{ route('shop') }}"><span>Spray Pumps</span></a></li>
                <li class="s1" style="list-style: none;"><a class="level1" href="{{ route('shop') }}"><span>Organic Fertilizers</span></a></li>
                <li class="s1" style="list-style: none;"><a class="level1" href="{{ route('shop') }}"><span>Pruning &amp; Cutting Tools</span></a></li>
            </ul>
        </li>

        <li>
            <a href="{{ route('shop') }}">Combo Offers</a>
            <ul>
                <li class="s1" style="list-style: none; margin-top: 15px;"><a class="level1" href="{{ route('shop') }}"><span>Combo for Plants</span></a></li>
                <li class="s1" style="list-style: none;"><a class="level1" href="{{ route('shop') }}"><span>Combo for Planters </span></a></li>
            </ul>
        </li>

        <li>
            <a href="{{ route('shop') }}">Seeds</a>
            <ul>
                <li class="s1" style="list-style: none; margin-top: 15px;"><a class="level1" href="{{ route('shop') }}"><span>Vagetable Seeds</span></a></li>
                <li class="s1" style="list-style: none;"><a class="level1" href="{{ route('shop') }}"><span>Flower Seeds </span></a></li>
                <li class="s1" style="list-style: none;"><a class="level1" href="{{ route('shop') }}"><span>Herb Seeds </span></a></li>
                <li class="s1" style="list-style: none;"><a class="level1" href="{{ route('shop') }}"><span>Flower Bulbs</span></a></li>
            </ul>
        </li>

        <li>
            <a href="{{ route('shop') }}">Special Offers</a>
            <ul>
                <li class="s1" style="list-style: none; margin-top: 15px;"><a class="level1" href="{{ route('shop') }}"><span>UPTO 10% off</span></a></li>
                <li class="s1" style="list-style: none;"><a class="level1" href="{{ route('shop') }}"><span>10% to 20% Off </span></a></li>
                <li class="s1" style="list-style: none; margin-top: 15px;"><a class="level1" href="{{ route('shop') }}"><span>20% to 30% Off</span></a></li>
                <li class="s1" style="list-style: none;"><a class="level1" href="{{ route('shop') }}"><span>30% to 50% Off</span></a></li>
                <li class="s1" style="list-style: none;"><a class="level1" href="{{ route('shop') }}"><span>50% and Above</span></a></li>
            </ul>
        </li>

    </ul>
</nav>
                    </div>
                    <!-- End .container -->
                </div>
                <!-- End .header-bottom -->
        </header>
        <!-- End .header -->
