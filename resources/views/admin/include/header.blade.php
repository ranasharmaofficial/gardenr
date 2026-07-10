<!-- app-header -->
         <header class="app-header">

            <!-- Start::main-header-container -->
            <div class="main-header-container container-fluid">

                <!-- Start::header-content-left -->
                <div class="header-content-left">

                    <!-- Start::header-element -->
                    <div class="header-element">
                        <div class="horizontal-logo">
                            <a href="index.html" class="header-logo">
                                <img src="{{ static_asset('assets/assets_admin/images/brand-logos/desktop-logo.png') }}" alt="logo" class="desktop-logo">
                                <img src="{{ static_asset('assets/assets_admin/images/brand-logos/toggle-logo.png') }}" alt="logo" class="toggle-logo">
                                <img src="{{ static_asset('assets/assets_admin/images/brand-logos/desktop-dark.png') }}" alt="logo" class="desktop-dark">
                                <img src="{{ static_asset('assets/assets_admin/images/brand-logos/toggle-dark.png') }}" alt="logo" class="toggle-dark">
                            </a>
                        </div>
                    </div>
                    <!-- End::header-element -->

                    <!-- Start::header-element -->
                    <div class="header-element">
                        <!-- Start::header-link -->
                        <a aria-label="anchor" href="javascript:void(0);" class="sidemenu-toggle header-link" data-bs-toggle="sidebar">
                            <span class="open-toggle me-2">
                                <i class="fe fe-align-left header-link-icon border-0"></i>
                              </span>
                        </a>
                        <!-- End::header-link -->
                    </div>
                    <!-- End::header-element -->

                     

                </div>
                <!-- End::header-content-left -->

                <!-- Start::header-content-right -->
                <div class="header-content-right">

                     <!-- Start::header-element -->
                     <div class="header-element header-search d-sm-flex d-none">
                        <!-- Start::header-link -->
                        <a href="javascript:void(0);" class="header-link" data-bs-toggle="modal" data-bs-target="#searchModal">
                            <i class="fe fe-search header-link-icon"></i>
                        </a>
                        <!-- End::header-link -->
                    </div>
                    <!-- End::header-element -->

                     

                    <!-- Start::header-element -->
                    <div class="header-element header-theme-mode">
                        <!-- Start::header-link|layout-setting -->
                        <a aria-label="anchor" href="javascript:void(0);" class="header-link layout-setting">
                                <!-- Start::header-link-icon -->
                                    <i class="fe fe-sun bx-flip-horizontal header-link-icon ionicon  dark-layout"></i>
                                <!-- End::header-link-icon -->
                                <!--  Start::header-link-icon -->
                                    <i class="fe fe-moon bx-flip-horizontal header-link-icon ionicon light-layout"></i>
                                <!-- End::header-link-icon -->
                        </a>
                        <!-- End::header-link|layout-setting -->
                    </div>
                    <!-- End::header-element -->
					{{--
                    <!-- Start::header-element -->
                    <div class="header-element cart-dropdown">
                        <!-- Start::header-link|dropdown-toggle -->
                        <a href="javascript:void(0);" class="header-link dropdown-toggle" data-bs-toggle="dropdown" data-bs-auto-close="outside">
                                <i class="fe fe-shopping-cart header-link-icon ionicon"></i>
                              <span class="badge bg-danger rounded-pill header-icon-badge" id="cart-icon-badge">5</span>
                        </a>
                        <!-- End::header-link|dropdown-toggle -->
                        <!-- Start::main-header-dropdown -->
                        <div class="main-header-dropdown dropdown-menu dropdown-menu-arrow  border-0 dropdown-menu-end" data-popper-placement="none">
                            <div class="p-3 menu-header-content">
                                <div class="d-flex align-items-center justify-content-between">
                                    <p class="mb-0 fs-17 fw-semibold text-fixed-white">Cart Items</p>
                                    <span class="badge bg-success" id="cart-data">5 Items</span>
                                </div>
                            </div>
                            <div><hr class="dropdown-divider"></div>
                            <ul class="list-unstyled mb-0" id="header-cart-items-scroll">
                                <li class="dropdown-item">
                                    <div class="d-flex align-items-start cart-dropdown-item">
                                        <span class="avatar avatar-md bd-gray-200 p-1">
                                            <img src="{{ static_asset('assets/assets_admin/images/ecommerce/cart/1.png') }}" alt="">
                                        </span>
                                        <div class="flex-grow-1 ms-3">
                                            <div class="d-flex align-items-start justify-content-between mb-0">
                                                <div class=" fs-15 fw-semibold">
                                                    <a href="product-cart.html">Glass Decor Item</a>
                                                </div>
                                                <div>
                                                    <a aria-label="anchor" href="javascript:void(0);" class="header-cart-remove float-end dropdown-item-close">
                                                        <i class="fe fe-trash-2"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="min-w-fit-content align-items-start">
                                                <div class="fs-13">$1,229</div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="dropdown-item">
                                    <div class="d-flex align-items-start cart-dropdown-item">
                                        <span class="avatar avatar-md bd-gray-200 p-1">
                                            <img src="{{ static_asset('assets/assets_admin/images/ecommerce/cart/2.png') }}" alt="">
                                        </span>
                                        <div class="flex-grow-1 ms-3">
                                            <div class="d-flex align-items-start justify-content-between mb-0">
                                                <div class=" fs-15 fw-semibold">
                                                    <a href="product-cart.html">Modern Chair</a>
                                                </div>
                                                <div>
                                                    <a aria-label="anchor" href="javascript:void(0);" class="header-cart-remove float-end dropdown-item-close">
                                                        <i class="fe fe-trash-2"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="min-w-fit-content align-items-start">
                                                <div class="fs-13">$219</div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="dropdown-item">
                                    <div class="d-flex align-items-start cart-dropdown-item">
                                        <span class="avatar avatar-md bd-gray-200 p-1">
                                            <img src="{{ static_asset('assets/assets_admin/images/ecommerce/cart/3.png') }}" alt="">
                                        </span>
                                        <div class="flex-grow-1 ms-3">
                                            <div class="d-flex align-items-start justify-content-between mb-0">
                                                <div class=" fs-15 fw-semibold">
                                                    <a href="product-cart.html">Branded Black Headset</a>
                                                </div>
                                                <div>
                                                    <a aria-label="anchor" href="javascript:void(0);" class="header-cart-remove float-end dropdown-item-close">
                                                        <i class="fe fe-trash-2"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="min-w-fit-content align-items-start">
                                                <div class="fs-13">$39.99</div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="dropdown-item">
                                    <div class="d-flex align-items-start cart-dropdown-item">
                                        <span class="avatar avatar-md bd-gray-200 p-1">
                                            <img src="{{ static_asset('assets/assets_admin/images/ecommerce/cart/4.png') }}" alt="">
                                        </span>
                                        <div class="flex-grow-1 ms-3">
                                            <div class="d-flex align-items-start justify-content-between mb-0">
                                                <div class=" fs-15 fw-semibold">
                                                    <a href="product-cart.html">Sun Glasses</a>
                                                </div>
                                                <div>
                                                    <a aria-label="anchor" href="javascript:void(0);" class="header-cart-remove float-end dropdown-item-close">
                                                        <i class="fe fe-trash-2"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="min-w-fit-content align-items-start">
                                                <div class="fs-13">$439.8</div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="dropdown-item">
                                    <div class="d-flex align-items-start cart-dropdown-item">
                                        <span class="avatar avatar-md bd-gray-200 p-1">
                                            <img src="{{ static_asset('assets/assets_admin/images/ecommerce/cart/5.png') }}" alt="">
                                        </span>
                                        <div class="flex-grow-1 ms-3">
                                            <div class="d-flex align-items-start justify-content-between mb-0">
                                                <div class=" fs-15 fw-semibold">
                                                    <a href="product-cart.html">Coffe Cup</a>
                                                </div>
                                                <div>
                                                    <a aria-label="anchor" href="javascript:void(0);" class="header-cart-remove float-end dropdown-item-close">
                                                        <i class="fe fe-trash-2"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="min-w-fit-content align-items-start">
                                                <div class="fs-13">$225.2</div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <div class="p-3 empty-header-item border-top">
                                <div class="d-grid">
                                    <a href="check-out.html" class="btn btn-primary">Checkout</a>
                                </div>
                            </div>
                            <div class="p-5 empty-item d-none">
                                <div class="text-center">
                                    <span class="avatar avatar-xxl avatar-rounded bg-warning-transparent">
                                        <i class="bx bx-cart bx-tada fs-2"></i>
                                    </span>
                                    <h6 class="fw-bold mb-2 mt-3">Your Cart is Empty</h6>
                                    <a href="products.html" class="btn btn-primary btn-wave btn-sm m-1" data-abc="true">continue shopping <i class="bi bi-arrow-right ms-1"></i></a>
                                </div>
                            </div>
                        </div>
                        <!-- End::main-header-dropdown -->
                    </div>
                    <!-- End::header-element -->
					--}}

                    <!-- Start::header-element -->
                    <div class="header-element notifications-dropdown">
                        <!-- Start::header-link|dropdown-toggle -->
                        <a href="javascript:void(0);" class="header-link dropdown-toggle" data-bs-toggle="dropdown" data-bs-auto-close="outside" id="messageDropdown" aria-expanded="false">
                             <i class="fe fe-bell header-link-icon ionicon"></i>
                           <span class="badge bg-info rounded-pill header-icon-badge pulse pulse-secondary" id="notification-icon-badge">5</span>
                        </a>
                        <!-- End::header-link|dropdown-toggle -->
                        <!-- Start::main-header-dropdown -->
                        <div class="main-header-dropdown dropdown-menu dropdown-menu-arrow border-0 dropdown-menu-end" data-popper-placement="none">
                            <div class="p-3 menu-header-content">
                                <div class="d-flex align-items-center justify-content-between">
                                    <p class="mb-0 fs-17 fw-semibold text-fixed-white">Notifications</p>
                                    <span class="badge bg-warning" id="notifiation-data">0 Unread</span>
                                </div>
                            </div>
                            <div class="dropdown-divider"></div>
                            <ul class="list-unstyled mb-0" id="header-notification-scroll">
                                <li class="dropdown-item p-3">
                                    <div class="d-flex align-items-start">
                                         <div class="pe-2">
                                             <span class="avatar avatar-md bg-success-transparent avatar-rounded"><i class="la la-shopping-basket text-success fs-21"></i></span>
                                         </div>
                                         <div class="flex-grow-1 d-flex align-items-center justify-content-between">
                                            <div>
                                                <p class="mb-0 fs-14 fw-semibold"><a href="notifications.html">Coming Soon</a></p>
                                                <span class="text-muted fw-normal fs-12 header-notification-text">1 hour ago</span>
                                            </div>
                                            <div>
                                                <a href="javascript:void(0);" class="min-w-fit-content text-muted me-1"><i class="las la-angle-right fs-13"></i></a>
                                            </div>
                                         </div>
                                    </div>
                                </li>
                                 
                            </ul>
                            <div class="p-3 empty-header-item1 border-top">
                                <div class="d-grid">
                                    <a href="notifications.html" class="btn btn-primary">View All</a>
                                </div>
                            </div>
                            <div class="p-5 empty-item1 d-none">
                                <div class="text-center">
                                    <span class="avatar avatar-xl avatar-rounded bg-secondary-transparent">
                                        <i class="bx bx-bell-off bx-tada fs-2"></i>
                                    </span>
                                    <h6 class="fw-semibold mt-3">No New Notifications</h6>
                                </div>
                            </div>
                        </div>
                        <!-- End::main-header-dropdown -->
                    </div>
                    <!-- End::header-element -->
                     

                    

                    <!-- Start::header-element -->
                    <div class="header-element mainuserProfile">
                        <!-- Start::header-link|dropdown-toggle -->
                        <a href="javascript:void(0);" class="header-link dropdown-toggle" id="mainHeaderProfile" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                            <div class="d-flex align-items-center">
                                <div class="d-sm-flex wd-100p lh-0">
                                    <div class="avatar avatar-md"><img alt="avatar" class="rounded-circle" src="{{ static_asset('assets/assets_admin/images/faces/user.png') }}"></div>
                                    <div class="ms-2 my-auto d-none d-xl-flex">
                                        <h6 class="text-danger font-weight-semibold mb-0 fs-13 user-name d-sm-block d-none">{{session('LoggedUser')->first_name}}</h6>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <!-- End::header-link|dropdown-toggle -->
                        <div class="main-header-dropdown dropdown-menu pt-0 border-0 header-profile-dropdown dropdown-menu-end dropdown-menu-arrow" aria-labelledby="mainHeaderProfile">
                            <div class="p-3 menu-header-content text-fixed-white rounded-top text-center">
                                <div class="">
                                    <div class="avatar avatar-xl rounded-circle"><img alt="" class="rounded-circle"  src="{{ static_asset('assets/assets_admin/images/faces/user.png') }}"></div>
                                    <p class="text-fixed-white fs-18 fw-semibold mb-0">{{session('LoggedUser')->first_name}}</p>
                                    <span class="fs-13 text-fixed-white text-uppercase">{{session('LoggedUser')->userType}}</span>
                                </div>
                            </div>
                            <div><hr class="dropdown-divider"></div>
                            <div>
                                {{-- <a class="dropdown-item" href="profile.html"><i class="fa fa-user me-1"></i> My
                                    Profile</a> --}}
                                <a class="dropdown-item" href="{{ url('admin/reset-password') }}"><i class="fa fa-edit me-1"></i> Reset Password</a>
                                {{-- <a class="dropdown-item" href="notifications.html"><i
                                        class="fa fa-clock me-1"></i> Activity Logs</a>
                                <a class="dropdown-item" href="settings.html"><i
                                        class="fa fa-sliders-h me-1"></i> Account Settings</a> --}}
                                <a class="dropdown-item" href="{{ url('admin/logout') }}"><i
                                        class="fa fa-sign-out-alt me-1"></i> Sign Out</a>
                            </div>
                        </div>
                    </div>
                    <!-- End::header-element -->

                    <!-- Start::header-element -->
                    <div class="header-element d-flex header-settings">
                        <a aria-label="anchor"  href="javascript:void(0);" class="header-link nav-link icon me-1" data-bs-toggle="offcanvas" data-bs-target="#sidebar-right" aria-controls="sidebar-right">
                         <i class="fe fe-align-right header-link-icon"></i>
                        </a>
                    </div>
                   <!-- End::header-element -->

                    <!-- Start::header-element -->
                    <div class="header-element">
                        <!-- Start::header-link|switcher-icon -->
                        <a aria-label="anchor" href="javascript:void(0);" class="header-link switcher-icon ms-1" data-bs-toggle="offcanvas" data-bs-target="#switcher-canvas">
                             <i class="fe fe-settings fe-spin header-link-icon"></i>
                          </a>
                        <!-- End::header-link|switcher-icon -->
                    </div>
                    <!-- End::header-element -->

                </div>
                <!-- End::header-content-right -->

            </div>
            <!-- End::main-header-container -->

        </header>
        <!-- /app-header -->
