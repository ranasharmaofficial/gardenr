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
  $corporate_address_phone = get_business_single_cache_value('corporate_address_phone', 'footer_setup', 'corporate_address_phone');

  $registered_address = get_business_single_cache_value('registered_address', 'footer_setup', 'registered_address');
  $registered_address_phone = get_business_single_cache_value('registered_address_phone', 'footer_setup', 'registered_address_phone');
  $footerWidgetOne = getFooterWidget('one');
  $footerWidgetTwo = getFooterWidget('two');
  $footerWidgetThree = getFooterWidget('three');
	// dd($footerWidgetOne['field_name']);
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


  <footer class="tg-footer foot-background">

    <div class="container">

        <div class="row g-4">

            <!-- Brand -->
            <div class="col-lg-3 col-md-6 tg-footer-brand">
                <img src="{{ static_asset('assets/assets_web/images/logo.png') }}" alt="Rich Money">
                    <p class="tg-text">
                        Premium indoor &amp; outdoor plants, gardening tools, seeds and eco-friendly solutions for a greener lifestyle.
                    </p>

                    <div class="tg-social mt-3">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                    </div>
            </div>

            <!-- Quick Links -->
            <div class="col-lg-3 col-md-6">
                <h4 class="tg-title mb-3">Quick Links</h4>
                <ul class="tg-list">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li><a href="{{ route('shop') }}">Shop Plants</a></li>
                    <li><a href="{{ route('category.slug', 'tools-accessories') }}">Gardening Tools</a></li>
                    <li><a href="{{ route('category.slug', 'seeds') }}">Seeds Collection</a></li>
                    <li><a href="{{ route('contact') }}">Contact</a></li>
                </ul>
            </div>

            <!-- Categories -->
            <div class="col-lg-3 col-md-6">
                <h4 class="tg-title mb-3">Categories</h4>
                <ul class="tg-list">
                    <li><a href="{{ route('category.slug', 'indoor-plants') }}">Indoor Plants</a></li>
                    <li><a href="{{ route('category.slug', 'plants') }}">Outdoor Plants</a></li>
                    <li><a href="{{ route('category.slug', 'plants-by-type') }}">Flower Plants</a></li>
                    <li><a href="{{ route('category.slug', 'plants') }}">Medicinal Plants</a></li>
                    <li><a href="{{ route('category.slug', 'pots-by-material') }}">Pots &amp; Planters</a></li>
                    <li><a href="{{ route('category.slug', 'seeds') }}">Seeds</a></li>
                </ul>
            </div>

            <!-- Contact -->
            <div class="col-lg-3 col-md-6">
                <h4 class="tg-title mb-3">Contact Us</h4>

                <p class="contactus"><i class="fa fa-map-marker-alt"></i> Purnea, Bihar</p>
                <p class="contactus"><i class="fa fa-phone"></i> +91 9835034894</p>
                <p class="contactus"><i class="fa fa-envelope"></i> kasule@richmoney.in</p>
                <p class="contactus"><i class="fa fa-clock"></i> Mon - Sun: 9AM - 8PM</p>

                <div class="footer-badges">
                    <span class="footer-badge">COD</span>
                    <span class="footer-badge">Fresh Plants</span>
                    <span class="footer-badge">Secure Checkout</span>
                </div>
            </div>

        </div>

        <hr class="tg-hr">

        <!-- Bottom Bar -->
        <div class="tg-bottom d-flex flex-column flex-md-row justify-content-between align-items-center">

            <div class="tg-copy">
                &copy; 2026 Rich Money. All Rights Reserved.
            </div>

            <div class="tg-policy">
                <a href="{{ route('privacyPolicy') }}">Privacy Policy</a>
            </div>

        </div>


    </div>
</footer>
<!-- End .footer -->
</div>
<!-- End .page-wrapper -->


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
                        <li style="list-style: none;"><a class="level1" href="{{ route('shop') }}"><span>Indoor Plants</span></a></li>
                        <li style="list-style: none;"><a class="level1" href="{{ route('shop') }}"><span>Outdoor Plants</span></a></li>
                        <li style="list-style: none;"><a class="level1" href="{{ route('shop') }}"><span>Flower Plants</span></a></li>
                        <li style="list-style: none;"><a class="level1" href="{{ route('shop') }}"><span>Low maintenance Plants</span></a></li>
                        <li style="list-style: none;"><a class="level1" href="{{ route('shop') }}"><span>Air-Purifier Plants</span></a></li>
                        <li style="list-style: none;"><a class="level1" href="{{ route('shop') }}"><span>Cactus &amp; Succulent Plants</span></a></li>
                        <li style="list-style: none;"><a class="level1" href="{{ route('shop') }}"><span>Fruit Plants</span></a></li>
                    </ul>
                </li>

                <li>
                    <a href="{{ route('shop') }}" class="nolink">Essential Plants</a>
                    <ul>
                        <li style="list-style: none;"><a class="level1" href="{{ route('shop') }}"><span>Money Plants</span></a></li>
                        <li style="list-style: none;"><a class="level1" href="{{ route('shop') }}"><span>Lucky Bamboo Plants</span></a></li>
                        <li style="list-style: none;"><a class="level1" href="{{ route('shop') }}"><span>Bonsai Plants</span></a></li>
                        <li style="list-style: none;"><a class="level1" href="{{ route('shop') }}"><span>Spiritual And Vastu Plants</span></a></li>
                        <li style="list-style: none;"><a class="level1" href="{{ route('shop') }}"><span>Flowering Plants</span></a></li>
                    </ul>
                </li>

                <li>
                    <a href="{{ route('shop') }}" class="nolink">Plants by Location</a>
                    <ul>
                        <li style="list-style: none;"><a class="level1" href="{{ route('shop') }}"><span>Bedroom Plants</span></a></li>
                        <li style="list-style: none;"><a class="level1" href="{{ route('shop') }}"><span>Kitchen Plants</span></a></li>
                        <li style="list-style: none;"><a class="level1" href="{{ route('shop') }}"><span>Living Room Plants</span></a></li>
                        <li style="list-style: none;"><a class="level1" href="{{ route('shop') }}"><span>Office Desk Plants</span></a></li>
                        <li style="list-style: none;"><a class="level1" href="{{ route('shop') }}"><span>Plants For Shop</span></a></li>
                        <li style="list-style: none;"><a class="level1" href="{{ route('shop') }}"><span>Bathroom Plants</span></a></li>
                    </ul>
                </li>

                <li>
                    <a href="{{ route('shop') }}" class="nolink">Plants by Season</a>
                    <ul>
                        <li style="list-style: none;"><a class="level1" href="{{ route('shop') }}"><span>Summer Plants</span></a></li>
                        <li style="list-style: none;"><a class="level1" href="{{ route('shop') }}"><span>Winter Plants</span></a></li>
                        <li style="list-style: none;"><a class="level1" href="{{ route('shop') }}"><span>All Season Plants</span></a></li>
                        <li style="list-style: none;"><a class="level1" href="{{ route('shop') }}"><span>Small Plants</span></a></li>
                        <li style="list-style: none;"><a class="level1" href="{{ route('shop') }}"><span>Medium Plants</span></a></li>
                    </ul>
                </li>
            </ul>
        </li>

        <li>
            <a href="{{ route('shop') }}">Pots &amp; Planters</a>
            <ul>
                <li>
                    <p class="menu_text menu-title1" align="center"><b>Pots By Material</b></p>
                </li>
                <li style="list-style: none;"><a class="level1" href="{{ route('shop') }}"><span>Plastic Pots</span></a></li>
                <li style="list-style: none;"><a class="level1" href="{{ route('shop') }}"><span>Ceramic Pots</span></a></li>
                <li style="list-style: none;"><a class="level1" href="{{ route('shop') }}"><span>Resin Pots</span></a></li>
            </ul>
        </li>

        <li>
            <a href="{{ route('shop') }}">Gifts</a>
            <ul class="custom-scrollbar">
                <li>
                    <p class="menu_text menu-title1" align="center"><b>Plants for Gift</b></p>
                </li>
                <li style="list-style: none;"><a class="level1" href="{{ route('shop') }}"><span>Plants for Anniversary</span></a></li>
                <li style="list-style: none;"><a class="level1" href="{{ route('shop') }}"><span>Plants for Birthday</span></a></li>
                <li style="list-style: none;"><a class="level1" href="{{ route('shop') }}"><span>Plants for Expressing Love</span></a></li>
                <li style="list-style: none;"><a class="level1" href="{{ route('shop') }}"><span>Plants for Farewell</span></a></li>
                <li style="list-style: none;"><a class="level1" href="{{ route('shop') }}"><span>Good Luck Plants</span></a></li>
                <li style="list-style: none;"><a class="level1" href="{{ route('shop') }}"><span>Plants for Friends</span></a></li>
                <li style="list-style: none;"><a class="level1" href="{{ route('shop') }}"><span>Plants for Get Well Soon</span></a></li>
                <li style="list-style: none;"><a class="level1" href="{{ route('shop') }}"><span>Plants for Marriage</span></a></li>
                <li style="list-style: none;"><a class="level1" href="{{ route('shop') }}"><span>Plants for Office</span></a></li>
            </ul>
        </li>

        <li>
            <a href="{{ route('shop') }}">Tools &amp; Accessories</a>
            <ul>
                <li style="list-style: none; margin-top: 20px;"><a class="level1" href="{{ route('shop') }}"><span>Gardening Pebbles</span></a></li>
                <li class="menu-item menu-item-has-children menu-parent-item" style="list-style: none;"><a class="level1" href="{{ route('shop') }}"><span>Watering</span></a></li>
                <li class="menu-item menu-item-has-children menu-parent-item" style="list-style: none;"><a class="level1" href="{{ route('shop') }}"><span>Spray Pumps</span></a></li>
                <li class="menu-item menu-item-has-children menu-parent-item" style="list-style: none;"><a class="level1" href="{{ route('shop') }}"><span>Organic Fertilizers</span></a></li>
                <li class="menu-item menu-item-has-children menu-parent-item" style="list-style: none;"><a class="level1" href="{{ route('shop') }}"><span>Pruning &amp; Cutting Tools</span></a></li>
            </ul>
        </li>

        <li>
            <a href="{{ route('shop') }}">Combo Offers</a>
            <ul>
                <li style="list-style: none; margin-top: 15px;"><a class="level1" href="{{ route('shop') }}"><span>Combo for Plants</span></a></li>
                <li style="list-style: none;"><a class="level1" href="{{ route('shop') }}"><span>Combo for Planters</span></a></li>
            </ul>
        </li>

        <li>
            <a href="{{ route('shop') }}">Seeds</a>
            <ul>
                <li style="list-style: none; margin-top: 15px;"><a class="level1" href="{{ route('shop') }}"><span>Vagetable Seeds</span></a></li>
                <li style="list-style: none;"><a class="level1" href="{{ route('shop') }}"><span>Flower Seeds</span></a></li>
                <li style="list-style: none;"><a class="level1" href="{{ route('shop') }}"><span>Herb Seeds</span></a></li>
                <li style="list-style: none;"><a class="level1" href="{{ route('shop') }}"><span>Flower Bulbs</span></a></li>
            </ul>
        </li>

        <li>
            <a href="{{ route('shop') }}">Special Offers</a>
            <ul>
                <li style="list-style: none; margin-top: 15px;"><a class="level1" href="{{ route('shop') }}"><span>UPTO 10% off</span></a></li>
                <li style="list-style: none;"><a class="level1" href="{{ route('shop') }}"><span>10% to 20% Off</span></a></li>
                <li style="list-style: none; margin-top: 15px;"><a class="level1" href="{{ route('shop') }}"><span>20% to 30% Off</span></a></li>
                <li style="list-style: none;"><a class="level1" href="{{ route('shop') }}"><span>30% to 50% Off</span></a></li>
                <li style="list-style: none;"><a class="level1" href="{{ route('shop') }}"><span>50% and Above</span></a></li>
            </ul>
        </li>
    </ul>
</nav>
        <!-- End .mobile-nav -->

        <form class="search-wrapper mb-2" action="#">
            <input type="text" class="form-control mb-0" placeholder="Search..." required />
            <button class="btn icon-search text-white bg-transparent p-0" type="submit"></button>
        </form>

        <div class="social-icons">
            <a href="#" class="social-icon social-facebook icon-facebook" target="_blank">
            </a>
            <a href="#" class="social-icon social-twitter icon-twitter" target="_blank">
            </a>
            <a href="#" class="social-icon social-instagram icon-instagram" target="_blank">
            </a>
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
            <i class="icon-bars"></i>Categories
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
