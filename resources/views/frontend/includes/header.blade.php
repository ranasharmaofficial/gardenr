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

    <header class="header">

        {{-- =================== TOP INFO BAR (THEME COLOR) =================== --}}
        <div class="rm-top-bar">
            <div class="container">
                <div class="rm-top-left">
                    <a href="tel:+919534737643" class="rm-top-item">
                        <i class="fa fa-phone-alt"></i>
                        <span>+91 9534737643</span>
                    </a>
                    <a href="mailto:info.richmoney1@gmail.com" class="rm-top-item">
                        <i class="fa fa-envelope"></i>
                        <span>info.richmoney1@gmail.com</span>
                    </a>
                    <span class="rm-top-item d-none d-lg-flex">
                        <i class="fa fa-map-marker-alt"></i>
                        <span>SAMAY PUR BADLI, DELHI (110042)</span>
                    </span>
                </div>
                <div class="rm-top-right">
                    @if ($facebook_value)
                        <a href="{{ $facebook_value }}" target="_blank" class="rm-social-btn"><i
                                class="fab fa-facebook-f"></i></a>
                    @else
                        <a href="#" class="rm-social-btn"><i class="fab fa-facebook-f"></i></a>
                    @endif
                    @if ($instagram_value)
                        <a href="{{ $instagram_value }}" target="_blank" class="rm-social-btn"><i
                                class="fab fa-instagram"></i></a>
                    @else
                        <a href="#" class="rm-social-btn"><i class="fab fa-instagram"></i></a>
                    @endif
                    <a href="https://wa.me/919534737643" target="_blank" class="rm-social-btn"><i
                            class="fab fa-whatsapp"></i></a>
                    <a href="{{ route('login') }}" class="rm-login-btn">
                        <i class="fa fa-user"></i> Login / Register
                    </a>
                </div>
            </div>
        </div>
        {{-- =================== END TOP BAR =================== --}}

        <div class="header-middle sticky-header" data-sticky-options="{'mobile': true}">
            <div class="container">
                <div class="header-left col-lg-2 w-auto pl-0">
                    <button class="mobile-menu-toggler text-primary mr-2" type="button">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div>
                        <a href="{{ url('') }}" class="logo">
                            <img src="{{ static_asset('assets/assets_web/images/logo.png') }}" alt="Rich Money">
                        </a>
                        <div class="rm-brand-highlight">
                            <i class="fa fa-leaf"></i> Fresh plants • trusted service
                        </div>
                    </div>
                </div>
                <!-- End .header-left -->

                <div class="header-right w-lg-max">
                    <div
                        class="header-icon header-search header-search-inline header-search-category w-lg-max text-right mt-0">
                        <a href="#" class="search-toggle" role="button"><i class="icon-search-3"></i></a>
                        <form action="{{ route('shop') }}" method="get">
                            <div class="header-search-wrapper">
                                <input type="search" class="form-control" name="q" id="q"
                                    placeholder="Search plants, seeds, tools..." required>
                                <div class="select-custom">
                                    <select id="cat" name="cat">
                                        <option value="">All Categories</option>
                                        <option value="1">Indoor Plants</option>
                                        <option value="2">Outdoor Plants</option>
                                        <option value="3">Flowering Plants</option>
                                        <option value="4">Pots & Planters</option>
                                        <option value="5">Seeds & Bulbs</option>
                                        <option value="6">Gardening Tools</option>
                                    </select>
                                </div>
                                <button class="btn icon-magnifier p-0" title="search" type="submit"></button>
                            </div>
                        </form>
                    </div>

                    {{-- Call Us Section - Improved Design --}}
                    <div class="rm-call-box d-none d-lg-flex">
                        <div class="rm-call-icon">
                            <i class="fa fa-phone-alt"></i>
                        </div>
                        <div class="rm-call-info">
                            <span class="rm-call-label">Call Us Now</span>
                            <a href="tel:+919534737643" class="rm-call-number">+91 9534737643</a>
                        </div>
                    </div>

                    <a href="{{ url('login') }}" class="header-icon" title="login"><i class="icon-user-2"></i></a>

                    <a href="{{ url('wishlist') }}" class="header-icon" title="wishlist"><i
                            class="icon-wishlist-2"></i></a>

                    <div class="dropdown cart-dropdown">

                        <a href="#" title="Cart" class="dropdown-toggle dropdown-arrow cart-toggle"
                            role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                            data-display="static">
                            <i class="minicart-icon"></i>
                            <span class="cart-count badge-circle" id="cartCount">0</span>
                        </a>

                        <div class="cart-overlay"></div>

                        <div class="dropdown-menu mobile-cart">

                            <a href="#" class="btn-close">×</a>

                            <div class="dropdownmenu-wrapper custom-scrollbar" id="cartHeaderArea">

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

                        <li
                            class="{{ request()->is('category') || request()->is('category/*') || request()->is('shop') ? 'active' : '' }}">
                            <a href="{{ route('shop') }}">Plants</a>
                            <div class="megamenu megamenu-fixed-width megamenu-3cols">
                                <div class="row">

                                    <div class="col-lg-3">
                                        <a href="{{ route('shop') }}" class="nolink">Plants By Type</a>
                                        <ul class="submenu">
                                            <li class=""><a class="level1"
                                                    href="{{ route('shop') }}"><span>Indoor Plants</span></a></li>
                                            <li class="s1" style="list-style: none;"><a class="level1"
                                                    href="{{ route('shop') }}"><span>Outdoor Plants</span></a></li>
                                            <li class="s1" style="list-style: none;"><a class="level1"
                                                    href="{{ route('shop') }}"><span>Flower Plants</span></a></li>
                                            <li class="s1" style="list-style: none;"><a class="level1"
                                                    href="{{ route('shop') }}"><span>Low maintenance Plants</span></a>
                                            </li>
                                            <li class="s1" style="list-style: none;"><a class="level1"
                                                    href="{{ route('shop') }}"><span>Air-Purifier Plants</span></a>
                                            </li>
                                            <li class="s1" style="list-style: none;"><a class="level1"
                                                    href="{{ route('shop') }}"><span>Cactus & Succulent Plants
                                                    </span></a></li>
                                            <li class="s1" style="list-style: none;"><a class="level1"
                                                    href="{{ route('shop') }}"><span>Fruit Plants </span></a></li>
                                        </ul>
                                    </div>

                                    <div class="col-lg-3">
                                        <a href="{{ route('shop') }}" class="nolink">Essential Plants</a>
                                        <ul class="submenu">
                                            <li class="s1" style="list-style: none;"><a class="level1"
                                                    href="{{ route('shop') }}"><span>Money Plants</span></a></li>
                                            <li class="s1" style="list-style: none;"><a class="level1"
                                                    href="{{ route('shop') }}"><span>Lucky Bamboo Plants</span></a>
                                            </li>
                                            <li class="s1" style="list-style: none;"><a class="level1"
                                                    href="{{ route('shop') }}"><span>Bonsai Plants</span></a></li>
                                            <li class="s1" style="list-style: none;"><a class="level1"
                                                    href="{{ route('shop') }}"><span>Spiritual And Vastu
                                                        Plants</span></a></li>
                                            <li class="s1" style="list-style: none;"><a class="level1"
                                                    href="{{ route('shop') }}"><span>Flowering Plants</span></a></li>
                                        </ul>
                                    </div>

                                    <div class="col-lg-3">
                                        <a href="{{ route('shop') }}" class="nolink">Plants by Location</a>
                                        <ul class="submenu">
                                            <li class="s1" style="list-style: none;"><a class="level1"
                                                    href="{{ route('shop') }}"><span>Bedroom Plants</span></a></li>
                                            <li class="s1" style="list-style: none;"><a class="level1"
                                                    href="{{ route('shop') }}"><span>Kitchen Plants</span></a></li>
                                            <li class="s1" style="list-style: none;"><a class="level1"
                                                    href="{{ route('shop') }}"><span>Living Room Plants</span></a>
                                            </li>
                                            <li class="s1" style="list-style: none;"><a class="level1"
                                                    href="{{ route('shop') }}"><span>Office Desk Plants</span></a>
                                            </li>
                                            <li class="s1" style="list-style: none;"><a class="level1"
                                                    href="{{ route('shop') }}"><span>Plants For Shop</span></a></li>
                                            <li class="s1" style="list-style: none;"><a class="level1"
                                                    href="{{ route('shop') }}"><span>Bathroom Plants</span></a></li>
                                        </ul>
                                    </div>

                                    <div class="col-lg-3">
                                        <a href="{{ route('shop') }}" class="nolink">Plants by Season</a>
                                        <ul class="submenu">
                                            <li class="s1" style="list-style: none;"><a class="level1"
                                                    href="{{ route('shop') }}"><span>Summer Plants</span></a></li>
                                            <li class="s1" style="list-style: none;"><a class="level1"
                                                    href="{{ route('shop') }}"><span>Winter Plants</span></a></li>
                                            <li class="s1" style="list-style: none;"><a class="level1"
                                                    href="{{ route('shop') }}"><span>All Season Plants</span></a></li>
                                            <li class="s1" style="list-style: none;"><a class="level1"
                                                    href="{{ route('shop') }}"><span>Small Plants</span></a></li>
                                            <li class="s1" style="list-style: none;"><a class="level1"
                                                    href="{{ route('shop') }}"><span>Medium Plants</span></a></li>
                                        </ul>
                                    </div>

                                </div>
                            </div>
                        </li>

                        <li>
                            <a href="{{ route('shop') }}">Pots & Planters </a>
                            <ul>
                                <li>
                                    <p class="menu_text menu-title2" align="center"><b>Pots By Material</b></p>
                                </li>
                                <li class="s1" style="list-style: none;"><a class="level1"
                                        href="{{ route('shop') }}"><span>Plastic Pots</span></a></li>
                                <li class="s1" style="list-style: none;"><a class="level1"
                                        href="{{ route('shop') }}"><span>Ceramic Pots</span></a></li>
                                <li class="s1" style="list-style: none;"><a class="level1"
                                        href="{{ route('shop') }}"><span>Resin Pots</span></a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="{{ route('shop') }}">Gifts</a>
                            <ul>
                                <li>
                                    <p class="menu_text menu-title2" align="center"><b>PLANTS for GIFT</b></p>
                                </li>
                                <li class="s1" style="list-style: none;"><a class="level1"
                                        href="{{ route('shop') }}"><span>Plants for Anniversary</span></a></li>
                                <li class="s1" style="list-style: none;"><a class="level1"
                                        href="{{ route('shop') }}"><span>Plants for Birthday</span></a></li>
                                <li class="s1" style="list-style: none;"><a class="level1"
                                        href="{{ route('shop') }}"><span>Plants for Expressing Love</span></a></li>
                                <li class="s1" style="list-style: none;"><a class="level1"
                                        href="{{ route('shop') }}"><span>Plants for Farewell</span></a></li>
                                <li class="s1" style="list-style: none;"><a class="level1"
                                        href="{{ route('shop') }}"><span>Good Luck Plants</span></a></li>
                                <li class="s1" style="list-style: none;"><a class="level1"
                                        href="{{ route('shop') }}"><span>Plants for Office</span></a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="{{ route('shop') }}">Seeds</a>
                            <ul>
                                <li class="s1" style="list-style: none; margin-top: 15px;"><a class="level1"
                                        href="{{ route('shop') }}"><span>Vegetable Seeds</span></a></li>
                                <li class="s1" style="list-style: none;"><a class="level1"
                                        href="{{ route('shop') }}"><span>Flower Seeds </span></a></li>
                                <li class="s1" style="list-style: none;"><a class="level1"
                                        href="{{ route('shop') }}"><span>Herb Seeds </span></a></li>
                                <li class="s1" style="list-style: none;"><a class="level1"
                                        href="{{ route('shop') }}"><span>Flower Bulbs</span></a></li>
                            </ul>
                        </li>

                        <li class="{{ request()->is('legal') ? 'active' : '' }}">
                            <a href="{{ url('legal') }}">Legal</a>
                        </li>

                        <li class="{{ request()->is('business-plan') ? 'active' : '' }}">
                            <a href="{{ url('business-plan') }}">Plan</a>
                        </li>

                        <li class="{{ request()->is('news') || request()->is('news/*') ? 'active' : '' }}">
                            <a href="{{ route('news') }}">News</a>
                        </li>

                        <li class="{{ request()->is('contact') ? 'active' : '' }}">
                            <a href="{{ route('contact') }}">Contact</a>
                        </li>

                    </ul>
                </nav>
            </div>
            <!-- End .container -->
        </div>
        <!-- End .header-bottom -->
    </header>
    <!-- End .header -->
