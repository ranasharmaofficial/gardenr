@php
    $social_medias = get_business_multiple_cache_value('social_medias', 'social_media');
    $footer_logo = get_business_single_cache_value('footer_logo', 'footer_setup', 'footer_logo');
    $footer_description = get_business_single_cache_value('footer_description', 'footer_setup', 'footer_description');
    $copyright_widget = get_business_single_cache_value('copyright_widget', 'footer_setup', 'copyright_widget');

    $contact_working_hr = get_business_single_cache_value('contact_working_hr', 'footer_setup', 'contact_working_hr');
    $contact_email = get_business_single_cache_value('contact_email', 'footer_setup', 'contact_email');
    $contact_phone = get_business_single_cache_value('contact_phone', 'footer_setup', 'contact_phone');
    $contact_address = get_business_single_cache_value('contact_address', 'footer_setup', 'contact_address');

    $corporate_address = get_business_single_cache_value('corporate_address', 'footer_setup', 'corporate_address');
    $corporate_address_phone = get_business_single_cache_value(
        'corporate_address_phone',
        'footer_setup',
        'corporate_address_phone',
    );

    $registered_address = get_business_single_cache_value('registered_address', 'footer_setup', 'registered_address');
    $registered_address_phone = get_business_single_cache_value(
        'registered_address_phone',
        'footer_setup',
        'registered_address_phone',
    );
    $footerWidgetOne = getFooterWidget('one');
    $footerWidgetTwo = getFooterWidget('two');
    $footerWidgetThree = getFooterWidget('three');
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
<style>

</style>

<footer class="rm-footer">

    {{-- Main Footer --}}
    <div class="container mt-3">
        <div class="rm-footer-spotlight">
            <div class="row align-items-center g-3">
                <div class="col-lg-8">
                    <h4 class="mb-2" style="color:#3b7c3f; font-weight:700;">Bring home fresh greenery with confidence
                    </h4>
                    <p class="mb-0" style="color:#4f6b53;">Premium plants, premium care, and friendly support — all
                        under one trusted green brand.</p>
                </div>
                <div class="col-lg-4 text-lg-right">
                    <a href="{{ route('shop') }}" class="btn btn-success px-4 py-2"
                        style="background:#4caf50; border-color:#4caf50;">Shop Now</a>
                </div>
            </div>
        </div>
    </div>
    <div class="rm-footer-main py-5" style="background:#368136;">
        <div class="container">
            <div class="row g-4">

                {{-- Brand Column --}}
                <div class="col-lg-4 col-md-6">
                    <div class="rm-footer-brand">
                        <a href="{{ url('/') }}">
                            <img src="{{ static_asset('assets/assets_web/images/logo.png') }}" alt="Rich Money"
                                class="rm-footer-logo">
                        </a>
                        <div class="rm-footer-social">
                            <a href="{{ $facebook_value ?? '#' }}" target="_blank" class="rm-fsocial-btn"
                                title="Facebook">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="{{ $instagram_value ?? '#' }}" target="_blank" class="rm-fsocial-btn"
                                title="Instagram">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="https://wa.me/919534737643" target="_blank" class="rm-fsocial-btn"
                                title="WhatsApp">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                            <a href="{{ $twitter_value ?? '#' }}" target="_blank" class="rm-fsocial-btn"
                                title="Twitter">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="{{ $youtube_value ?? '#' }}" target="_blank" class="rm-fsocial-btn"
                                title="YouTube">
                                <i class="fab fa-youtube"></i>
                            </a>
                        </div>

                    </div>
                </div>

                {{-- Quick Links --}}
                <div class="col-lg-2 col-md-6 mt-4">
                    <div class="rm-footer-widget">
                        <h4 class="rm-footer-title">Quick Links</h4>
                        <div class="rm-footer-divider"></div>
                        <ul class="rm-footer-links">
                            <li><a href="{{ url('/') }}"><i class="fa fa-angle-right"></i> Home</a></li>
                            <li><a href="{{ route('shop') }}"><i class="fa fa-angle-right"></i> Shop Plants</a></li>
                            <li><a href="{{ url('about-us') }}"><i class="fa fa-angle-right"></i> About Us</a></li>
                            <li><a href="{{ url('legal') }}"><i class="fa fa-angle-right"></i> Legal</a></li>
                            <li><a href="{{ url('business-plan') }}"><i class="fa fa-angle-right"></i> Business
                                    Plan</a></li>
                            <li><a href="{{ route('news') }}"><i class="fa fa-angle-right"></i> News</a></li>
                            <li><a href="{{ route('contact') }}"><i class="fa fa-angle-right"></i> Contact Us</a></li>
                        </ul>
                    </div>
                </div>

                {{-- Categories --}}
                <!-- <div class="col-lg-2 col-md-6">
                    <div class="rm-footer-widget">
                        <h4 class="rm-footer-title">Categories</h4>
                        <div class="rm-footer-divider"></div>
                        <ul class="rm-footer-links">
                            <li><a href="{{ route('shop') }}"><i class="fa fa-angle-right"></i> Indoor Plants</a></li>
                            <li><a href="{{ route('shop') }}"><i class="fa fa-angle-right"></i> Outdoor Plants</a></li>
                            <li><a href="{{ route('shop') }}"><i class="fa fa-angle-right"></i> Flower Plants</a></li>
                            <li><a href="{{ route('shop') }}"><i class="fa fa-angle-right"></i> Medicinal Plants</a></li>
                            <li><a href="{{ route('shop') }}"><i class="fa fa-angle-right"></i> Pots & Planters</a></li>
                            <li><a href="{{ route('shop') }}"><i class="fa fa-angle-right"></i> Seeds Collection</a></li>
                            <li><a href="{{ route('shop') }}"><i class="fa fa-angle-right"></i> Gardening Tools</a></li>
                        </ul>
                    </div>
                </div> -->

                {{-- Help & Policies --}}
                <div class="col-lg-2 col-md-6 mt-4">
                    <div class="rm-footer-widget">
                        <h4 class="rm-footer-title">Help & Info</h4>
                        <div class="rm-footer-divider"></div>
                        <ul class="rm-footer-links">
                            <li><a href="{{ route('login') }}"><i class="fa fa-angle-right"></i> Login</a></li>
                            <li><a href="{{ route('register') }}"><i class="fa fa-angle-right"></i> Register</a></li>
                            <li><a href="{{ url('wishlist') }}"><i class="fa fa-angle-right"></i> My Wishlist</a></li>
                            <li><a href="{{ route('cart.page') }}"><i class="fa fa-angle-right"></i> Cart</a></li>
                            <li><a href="{{ route('privacyPolicy') }}"><i class="fa fa-angle-right"></i> Privacy
                                    Policy</a></li>
                            <li><a href="{{ route('termsCondition') }}"><i class="fa fa-angle-right"></i> Terms &
                                    Conditions</a></li>
                            <li><a href="{{ route('blogs') }}"><i class="fa fa-angle-right"></i> Blog</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-span-1 mt-4">
                    <h3 class="text-2xl font-bold text-white">
                        Contact
                    </h3>

                    <ul class="space-y-6">

                        <li class="flex items-center">
                            <i class="fas fa-home text-orange-400 text-lg w-6 "></i>
                            <span class="ml-4 text-white">
                                SAMAY PUR BADLI, DELHI (110042)
                            </span>
                        </li>

                        <li class="flex items-center">
                            <i class="fas fa-phone text-orange-400 text-lg w-6"></i>
                            <a href="tel:+919534737643" class="ml-4 text-white hover:text-orange-400 transition">
                                +91 9534737643
                            </a>
                        </li>

                        <li class="flex items-center">
                            <i class="fas fa-envelope text-orange-400 text-lg w-6"></i>
                            <a href="mailto:info.richmoney1@gmail.com"
                                class="ml-4 text-white hover:text-orange-400 transition">
                                info.richmoney1@gmail.com
                            </a>
                        </li>

                        <li class="flex items-center">
                            <i class="fas fa-download text-orange-400 text-lg w-6"></i>
                            <a href="#" class="ml-4 text-white hover:text-orange-400 transition">
                                Download Our App
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </div>

    {{-- Footer Bottom Bar --}}
    <div class="rm-footer-bottom">
        <div class="container">
            <div class="rm-footer-bottom-inner">
                <div class="rm-copyright">
                    <i class="fa fa-leaf"></i>
                    &copy; {{ date('Y') }} <strong>Rich Money</strong>. All Rights Reserved. | Crafted with <i
                        class="fa fa-heart" style="color:#e74c3c;"></i> for Plant Lovers
                </div>
            </div>
        </div>
    </div>

</footer>
<!-- End .footer -->
</div>


<div class="mobile-menu-overlay"></div>
<!-- End .mobil-menu-overlay -->

<div class="mobile-menu-container">
    <div class="mobile-menu-wrapper">
        <span class="mobile-menu-close"><i class="fa fa-times"></i></span>
        <nav class="mobile-nav">
            <ul class="mobile-menu">
                <li><a href="{{ url('/') }}">Home</a></li>

                <li>
                    <a href="{{ route('shop') }}">PLANTS</a>
                    <ul>
                        <li>
                            <a href="{{ route('shop') }}" class="nolink">Plants By Type</a>
                            <ul>
                                <li style="list-style: none;"><a class="level1"
                                        href="{{ route('shop') }}"><span>Indoor Plants</span></a></li>
                                <li style="list-style: none;"><a class="level1"
                                        href="{{ route('shop') }}"><span>Outdoor Plants</span></a></li>
                                <li style="list-style: none;"><a class="level1"
                                        href="{{ route('shop') }}"><span>Flower Plants</span></a></li>
                                <li style="list-style: none;"><a class="level1"
                                        href="{{ route('shop') }}"><span>Air-Purifier Plants</span></a></li>
                                <li style="list-style: none;"><a class="level1"
                                        href="{{ route('shop') }}"><span>Cactus & Succulent Plants</span></a></li>
                                <li style="list-style: none;"><a class="level1"
                                        href="{{ route('shop') }}"><span>Fruit Plants</span></a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="{{ route('shop') }}" class="nolink">Essential Plants</a>
                            <ul>
                                <li style="list-style: none;"><a class="level1"
                                        href="{{ route('shop') }}"><span>Money Plants</span></a></li>
                                <li style="list-style: none;"><a class="level1"
                                        href="{{ route('shop') }}"><span>Lucky Bamboo Plants</span></a></li>
                                <li style="list-style: none;"><a class="level1"
                                        href="{{ route('shop') }}"><span>Bonsai Plants</span></a></li>
                                <li style="list-style: none;"><a class="level1"
                                        href="{{ route('shop') }}"><span>Flowering Plants</span></a></li>
                            </ul>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="{{ route('shop') }}">Pots & Planters</a>
                    <ul>
                        <li style="list-style: none;"><a class="level1" href="{{ route('shop') }}"><span>Plastic
                                    Pots</span></a></li>
                        <li style="list-style: none;"><a class="level1" href="{{ route('shop') }}"><span>Ceramic
                                    Pots</span></a></li>
                        <li style="list-style: none;"><a class="level1" href="{{ route('shop') }}"><span>Resin
                                    Pots</span></a></li>
                    </ul>
                </li>

                <li><a href="{{ route('shop') }}">Gifts</a></li>
                <li><a href="{{ route('shop') }}">Seeds</a></li>
                <li><a href="{{ url('legal') }}">Legal</a></li>
                <li><a href="{{ url('business-plan') }}">Plan</a></li>
                <li><a href="{{ route('news') }}">News</a></li>
                <li><a href="{{ route('contact') }}">Contact</a></li>
                <li><a href="{{ route('login') }}">Login</a></li>
                <li><a href="{{ route('register') }}">Sign Up</a></li>
            </ul>
        </nav>
        <!-- End .mobile-nav -->

        <form class="search-wrapper mb-2" action="{{ route('shop') }}">
            <input type="text" name="q" class="form-control mb-0" placeholder="Search plants..."
                required />
            <button class="btn icon-search text-white bg-transparent p-0" type="submit"></button>
        </form>

        <div class="social-icons">
            <a href="{{ $facebook_value ?? '#' }}" class="social-icon social-facebook icon-facebook"
                target="_blank"></a>
            <a href="{{ $twitter_value ?? '#' }}" class="social-icon social-twitter icon-twitter"
                target="_blank"></a>
            <a href="{{ $instagram_value ?? '#' }}" class="social-icon social-instagram icon-instagram"
                target="_blank"></a>
        </div>
    </div>
    <!-- End .mobile-menu-wrapper -->
</div>
<!-- End .mobile-menu-container -->

<div class="sticky-navbar">
    <div class="sticky-info">
        <a href="{{ url('/') }}">
            <i class="icon-home"></i>Home
        </a>
    </div>
    <div class="sticky-info">
        <a href="{{ route('shop') }}" class="">
            <i class="icon-bars"></i>Shop
        </a>
    </div>
    <div class="sticky-info">
        <a href="{{ url('wishlist') }}" class="">
            <i class="icon-wishlist-2"></i>Wishlist
        </a>
    </div>
    <div class="sticky-info">
        <a href="{{ url('login') }}" class="">
            <i class="icon-user-2"></i>Account
        </a>
    </div>
    <div class="sticky-info">
        <a href="{{ url('cart') }}" class="">
            <i class="icon-shopping-cart position-relative">
                <span class="cart-count badge-circle">3</span>
            </i>Cart
        </a>
    </div>
</div>


<a id="scroll-top" href="#top" title="Top" role="button"><i class="icon-angle-up"></i></a>
