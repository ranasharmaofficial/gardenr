<style>
    .app-sidebar .main-sidebar-header {
        height: 4rem;
        width: 14.95rem;
        position: fixed;
        display: flex;
        background: #9c9393 !important;
        z-index: 9;
        align-items: center;
        justify-content: center;
        padding: 1rem 1.25rem;
        border-inline-end: 1px solid var(--menu-border-color);
        border-block-end: 1px solid var(--menu-border-color);
        transition: all 0.1s ease-out;
        -webkit-backdrop-filter: blur(30px);
        backdrop-filter: blur(30px);
    }

    .li-section-title {
        padding: 8px 20px;
        font-size: 12px;
        text-transform: uppercase;
        font-weight: 600;
        color: #c63e18;
        margin-top: 10px;
        margin-bottom: 5px;
        border-bottom: 1px solid #ba9d9d;
    }
</style>

<!-- Start::app-sidebar -->
<aside class="app-sidebar sticky" id="sidebar">

    <!-- Start::main-sidebar-header -->
    <div class="main-sidebar-header">
        <a href="{{ url('admin/dashboard') }}" class="header-logo">
            <img src="{{ static_asset('assets/assets_admin/images/brand-logos/admin_logo.png') }}" alt="logo"
                class="desktop-logo">
            <img src="{{ static_asset('assets/assets_admin/images/brand-logos/toggle-logo.png') }}" alt="logo"
                class="toggle-logo">
            <img src="{{ static_asset('assets/assets_admin/images/brand-logos/desktop-dark.png') }}" alt="logo"
                class="desktop-dark">
            <img src="{{ static_asset('assets/assets_admin/images/brand-logos/toggle-dark.png') }}" alt="logo"
                class="toggle-dark">
        </a>
    </div>
    <!-- End::main-sidebar-header -->

    <!-- Start::main-sidebar -->
    <div class="main-sidebar" id="sidebar-scroll">

        <!-- Start::nav -->
        <nav class="main-menu-container nav nav-pills flex-column sub-open">
            <div class="main-sidebar-loggedin">
                <div class="app-sidebar__user">
                    <div class="dropdown user-pro-body text-center">
                        <div class="user-pic mb-2">
                            <img src="{{ static_asset('assets/assets_admin/images/faces/user.png') }}" alt="user-img"
                                class="rounded-circle mCS_img_loaded">
                        </div>
                        <div class="user-info">
                            <h6 class=" mb-0">{{session('LoggedUser')->first_name}}</h6>
                            <span class="fs-13 text-uppercase">{{session('LoggedUser')->userType}}</span>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="sidebar-navs mx-auto my-2">
                <button aria-label="button" type="button"
                    class="btn btn-icon btn-outline-light rounded-pill btn-wave m-1">
                    <i class="fe fe-settings"></i>
                </button>
                <button aria-label="button" type="button"
                    class="btn btn-icon btn-outline-light rounded-pill btn-wave m-1">
                    <i class="fe fe-mail"></i>
                </button>
                <button aria-label="button" type="button"
                    class="btn btn-icon btn-outline-light rounded-pill btn-wave m-1">
                    <i class="fe fe-user"></i>
                </button>
                <button onclick="window.location.href='{{ url('admin/logout') }}'" aria-label="button" type="button"
                    class="btn btn-icon btn-outline-light rounded-pill btn-wave m-1">
                    <i class="fe fe-power"></i>
                </button>
            </div> --}}
            <div class="slide-left" id="slide-left">
                <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                    <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"></path>
                </svg>
            </div>
            @if(session('LoggedUser')->user_type_id == 1)
                <ul class="main-menu">

                    <!-- Start::slide -->
                    <li class="slide">
                        <a href="{{ url('admin/dashboard') }}" class="side-menu__item">
                            <span class=" side-menu__icon">
                                <i class='fe fe-airplay'></i>
                            </span>
                            <span class="side-menu__label">Dashboard</span>
                        </a>
                    </li>
                    <!-- End::slide -->



                    <li class="li-section-title">Admin Menu</li>

                    <li class="slide has-sub">
                        <a href="javascript:void(0);" class="side-menu__item">
                            <span class=" side-menu__icon">
                                <i class="fe fe-box"></i>
                            </span>
                            <span class="side-menu__label">Product Management</span>
                            <i class="fe fe-chevron-right side-menu__angle"></i>
                        </a>
                        <ul class="slide-menu child1">
                            <li class="slide side-menu__label1">
                                <a href="javascript:void(0)">Product Management</a>
                            </li>
                            <li class="slide">
                                <a href="{{ url('admin/product_categories') }}" class="side-menu__item">Category</a>
                            </li>
                            <li class="slide">
                                <a href="{{ url('admin/brand') }}" class="side-menu__item">Brand</a>
                            </li>
                            <li class="slide">
                                <a href="{{ url('admin/products') }}" class="side-menu__item">Products</a>
                            </li>
                          {{--  <li class="slide">
                                <a href="{{ url('admin/product/product-transfer-to-branch') }}"
                                    class="side-menu__item">Transfer Product to Branch</a>
                            </li>
                            <li class="slide">
                                <a href="{{ url('admin/product/branch-product-list') }}" class="side-menu__item">Branch
                                    Product List</a>
                            </li>--}}
                        </ul>
                    </li>

                    <li class="slide has-sub">
                        <a href="javascript:void(0);" class="side-menu__item">
                            <span class=" side-menu__icon">
                                <i class="fe fe-users"></i>
                            </span>
                            <span class="side-menu__label">Customer & Orders</span>
                            <i class="fe fe-chevron-right side-menu__angle"></i>
                        </a>
                        <ul class="slide-menu child1">
                            <li class="slide side-menu__label1">
                                <a href="javascript:void(0)">Customer & Orders</a>
                            </li>
                            <li class="slide">
                                <a href="{{ route('admin.customer.index') }}" class="side-menu__item">Customer List</a>
                            </li>
                            <li class="slide">
                                <a href="{{ route('admin.customer.orders') }}" class="side-menu__item">All Orders</a>
                            </li>
                        </ul>
                    </li>

                    {{-- <li class="slide has-sub">
                        <a href="javascript:void(0);" class="side-menu__item">
                            <span class=" side-menu__icon">
                               <i class="ri-price-tag-line"></i>
                            </span>
                            <span class="side-menu__label">Sale</span>
                            <i class="fe fe-chevron-right side-menu__angle"></i>
                        </a>
                        <ul class="slide-menu child1">
                            <li class="slide side-menu__label1">
                                <a href="javascript:void(0)">Sale</a>
                            </li>
                            <li class="slide">
                                <a href="{{ url('admin/sale/incentive-sale') }}" class="side-menu__item">Sale with
                                    Incentive</a>
                            </li>
                            <li class="slide">
                                <a href="{{ url('admin/sale/incentive-sale-list') }}" class="side-menu__item">Incentive Sale
                                    List</a>
                            </li>
                            <li class="slide">
                                <a href="{{ url('admin/sale/cash-sale') }}" class="side-menu__item">Cash Sale</a>
                            </li>

                        </ul>
                    </li>


                   <li class="slide has-sub">
                        <a href="javascript:void(0);" class="side-menu__item">
                            <span class=" side-menu__icon">
                               <i class="ri-user-3-line"></i>
                            </span>
                            <span class="side-menu__label">Vivah Mitra Management</span>
                            <i class="fe fe-chevron-right side-menu__angle"></i>
                        </a>
                        <ul class="slide-menu child1">
                            <li class="slide side-menu__label1">
                                <a href="javascript:void(0)">Vivah Mitra Management</a>
                            </li>
                            <li class="slide">
                                <a href="{{ url('admin/bdm-list') }}" class="side-menu__item">BDM List</a>
                            </li> 
                            <li class="slide">
                                <a href="{{ url('admin/generate-vivah-mitra-code') }}" class="side-menu__item">Generate
                                    Vivah Mitra Code</a>
                            </li>
                            <li class="slide">
                                <a href="{{ url('admin/vivah-mitra-list') }}" class="side-menu__item">Vivah Mitra List</a>
                            </li>
                            <li class="slide">
                                <a href="{{ url('admin/vivahmitra_categories') }}" class="side-menu__item">Vivah Mitra
                                    Category</a>
                            </li>
                            <li class="slide">
                                <a href="{{ url('admin/vivahmitra_products') }}" class="side-menu__item">Vivah Mitra
                                    Data</a>
                            </li>
                            <li class="slide">
                                <a href="{{ url('admin/website/vivah-mitra-app-sliders') }}" class="side-menu__item">App
                                    Sliders</a>
                            </li>
                        </ul>
                    </li>

                     <li class="slide has-sub">
                        <a href="javascript:void(0);" class="side-menu__item">
                            <span class=" side-menu__icon">
                                <i class="ri-customer-service-fill"></i>
                            </span>
                            <span class="side-menu__label">Vivah Mitra Show in App</span>
                            <i class="fe fe-chevron-right side-menu__angle"></i>
                        </a>
                        <ul class="slide-menu child1">
                            <li class="slide side-menu__label1">
                                <a href="javascript:void(0)">Vivah Mitra Show in App</a>
                            </li>

                            <li class="slide">
                                <a href="{{ url('admin/vivah-mitra-in-app') }}" class="side-menu__item">Vivah Mitra In App</a>
                            </li>

                        </ul>
                    </li> 

                    <li class="slide has-sub">
                        <a href="javascript:void(0);" class="side-menu__item">
                            <span class=" side-menu__icon">
                                <i class="ri-wallet-3-fill"></i>
                            </span>
                            <span class="side-menu__label">Vivah Mitra Payout </span>
                            <i class="fe fe-chevron-right side-menu__angle"></i>
                        </a>
                        <ul class="slide-menu child1">
                            <li class="slide side-menu__label1">
                                <a href="javascript:void(0)">Vivah Mitra Payout</a>
                            </li>
                            <li class="slide">
                                <a href="{{ url('admin/vivah-mitra-payout-list') }}" class="side-menu__item">Payout</a>
                            </li>
                            <li class="slide">
                                <a href="{{ url('admin/vivah-mitra-payment-sent-list') }}" class="side-menu__item">Payout List</a>
                            </li>

                        </ul>
                    </li>

                    <li class="slide has-sub">
                        <a href="javascript:void(0);" class="side-menu__item">
                            <span class=" side-menu__icon">
                               <i class="ri-vip-crown-fill"></i>
                            </span>
                            <span class="side-menu__label">Membership Management</span>
                            <i class="fe fe-chevron-right side-menu__angle"></i>
                        </a>
                        <ul class="slide-menu child1">
                            <li class="slide side-menu__label1">
                                <a href="javascript:void(0)">Membership Management</a>
                            </li>
                            <li class="slide">
                                <a href="{{ url('admin/generate-membership-number') }}" class="side-menu__item">Generate
                                    Membership Number</a>
                            </li>
                            <li class="slide">
                                <a href="{{ url('admin/add-membership-old') }}" class="side-menu__item">Add Old Membership</a>
                            </li>
                            <li class="slide">
                                <a href="{{ url('admin/membership/add-physical-card-member') }}" class="side-menu__item">Add
                                    Physical Card Member</a>
                            </li>
                            <li class="slide">
                                <a href="{{ url('admin/membership/add-digital-card-member') }}" class="side-menu__item">Add
                                    Digital Card Member</a>
                            </li>
                            <li class="slide">
                                <a href="{{ url('admin/member-list') }}" class="side-menu__item">
                                    Member List</a>
                            </li>
                        </ul>
                    </li>

                    <li class="slide has-sub">
                        <a href="javascript:void(0);" class="side-menu__item">
                            <span class=" side-menu__icon">
                               <i class="ri-vip-crown-fill"></i>
                            </span>
                            <span class="side-menu__label">Kit Management</span>
                            <i class="fe fe-chevron-right side-menu__angle"></i>
                        </a>
                        <ul class="slide-menu child1">
                            <li class="slide side-menu__label1">
                                <a href="javascript:void(0)">Kit Management</a>
                            </li>
                            <li class="slide">
                                <a href="{{ url('admin/generate-kit-number') }}" class="side-menu__item">Generate Kit Number</a>
                            </li>

                            <li class="slide">
                                <a href="{{ url('admin/kit-transfer-history') }}" class="side-menu__item">Kit Transfer History</a>
                            </li>

                        </ul>
                    </li>

                    <li class="slide has-sub">
                        <a href="javascript:void(0);" class="side-menu__item">
                            <span class=" side-menu__icon">
                               <i class="ri-vip-crown-fill"></i>
                            </span>
                            <span class="side-menu__label">Shop Management</span>
                            <i class="fe fe-chevron-right side-menu__angle"></i>
                        </a>
                        <ul class="slide-menu child1">
                            <li class="slide side-menu__label1">
                                <a href="javascript:void(0)">Shop Management</a>
                            </li>
                            <li class="slide">
                                <a href="{{ url('admin/shop-list') }}" class="side-menu__item">Shop List</a>
                            </li>

                            <li class="slide">
                                <a href="{{ url('admin/view-shop-report') }}" class="side-menu__item">Shop Report</a>
                            </li>

                             

                        </ul>
                    </li>

                    <li class="slide has-sub">
                        <a href="javascript:void(0);" class="side-menu__item">
                            <span class=" side-menu__icon">
                               <i class="ri-vip-crown-fill"></i>
                            </span>
                            <span class="side-menu__label">Profit</span>
                            <i class="fe fe-chevron-right side-menu__angle"></i>
                        </a>
                        <ul class="slide-menu child1">
                            <li class="slide side-menu__label1">
                                <a href="javascript:void(0)">Profit</a>
                            </li>
                            <li class="slide">
                                <a href="{{ url('admin/product-profit-list') }}" class="side-menu__item">Product Profit List</a>
                            </li>

                            
                        </ul>
                    </li>

                    <li class="slide has-sub">
                        <a href="javascript:void(0);" class="side-menu__item">
                            <span class=" side-menu__icon">
                               <i class="ri-vip-crown-fill"></i>
                            </span>
                            <span class="side-menu__label">Set Employee Targets</span>
                            <i class="fe fe-chevron-right side-menu__angle"></i>
                        </a>
                        <ul class="slide-menu child1">
                            <li class="slide side-menu__label1">
                                <a href="javascript:void(0)">Set Employee Targets</a>
                            </li>
                            <li class="slide">
                                <a href="{{ url('admin/employee-target-list') }}" class="side-menu__item">Employee Targets</a>
                            </li>

                        </ul>
                    </li>

					<li class="slide has-sub">
                        <a href="javascript:void(0);" class="side-menu__item">
                            <span class=" side-menu__icon">
                               <i class="ri-profile-fill"></i>
                            </span>
                            <span class="side-menu__label">Probably Ayushmati Data</span>
                            <i class="fe fe-chevron-right side-menu__angle"></i>
                        </a>
                        <ul class="slide-menu child1">
                            <li class="slide side-menu__label1">
                                <a href="javascript:void(0)">Probably Ayushmati Data</a>
                            </li>
                            <li class="slide">
                                <a href="{{ url('admin/probably-aayushmati-data') }}" class="side-menu__item">Probably Ayushmati Data</a>
                            </li>
                        </ul>
                    </li>

                    <li class="slide has-sub">
                        <a href="javascript:void(0);" class="side-menu__item">
                            <span class=" side-menu__icon">
                                <i class="ri-user-star-fill"></i>
                            </span>
                            <span class="side-menu__label">Employee Management</span>
                            <i class="fe fe-chevron-right side-menu__angle"></i>
                        </a>
                        <ul class="slide-menu child1">
                            <li class="slide side-menu__label1">
                                <a href="javascript:void(0)">Employee Management</a>
                            </li>
                            <li class="slide">
                                <a href="{{ url('admin/staffs') }}" class="side-menu__item">Employee List</a>
                            </li>
                            <li class="slide">
                                <a href="{{ url('admin/assign-district-to-user') }}" class="side-menu__item">Assign District to Employee</a>
                            </li>
                            <li class="slide">
                                <a href="{{ url('admin/assign-shop-to-user') }}" class="side-menu__item">Assign Shop to Employee</a>
                            </li>

                            <li class="slide">
                                <a href="{{ url('admin/check-routine-work') }}" class="side-menu__item">Check Routine Work</a>
                            </li>

                            <li class="slide">
                                <a href="{{ url('admin/cash-payment-report') }}" class="side-menu__item">Cash Payment Report</a>
                            </li>

                            <li class="slide">
                                <a href="{{ url('admin/emp-online-payment-report') }}" class="side-menu__item">Online Payment Report</a>
                            </li>

                        </ul>
                    </li>

                    <li class="slide has-sub">
                        <a href="javascript:void(0);" class="side-menu__item">
                            <span class=" side-menu__icon">
                                <i class="ri-money-pound-circle-fill"></i>

                            </span>
                            <span class="side-menu__label">Company Fund</span>
                            <i class="fe fe-chevron-right side-menu__angle"></i>
                        </a>
                        <ul class="slide-menu child1">
                            <li class="slide side-menu__label1">
                                <a href="javascript:void(0)">Company Fund</a>
                            </li>
                            <li class="slide">
                                <a href="{{ url('admin/fund-transfer-to-branch') }}" class="side-menu__item">Fund Transfer
                                    to Branch</a>
                            </li>
                            <li class="slide">
                                <a href="{{ url('admin/fund-transfer-to-employee') }}" class="side-menu__item">Fund Transfer
                                    to Employee</a>
                            </li>
                            <li class="slide">
                                <a href="{{ url('admin/contact-enquiry') }}" class="side-menu__item">Fund Transfer to
                                    BDM</a>
                            </li>

                        </ul>
                    </li>

                    <li class="slide has-sub">
                        <a href="javascript:void(0);" class="side-menu__item">
                            <span class=" side-menu__icon">
                                <i class="ri-money-pound-circle-fill"></i>

                            </span>
                            <span class="side-menu__label">Wallet</span>
                            <i class="fe fe-chevron-right side-menu__angle"></i>
                        </a>
                        <ul class="slide-menu child1">
                            <li class="slide side-menu__label1">
                                <a href="javascript:void(0)">Wallet</a>
                            </li>
                            <li class="slide">
                                <a href="{{ url('admin/fund-wallet') }}" class="side-menu__item">Fund Wallet</a>
                            </li>
                            <li class="slide">
                                <a href="{{ url('admin/e-wallet') }}" class="side-menu__item">e-Wallet</a>
                            </li>
                        </ul>
                    </li>

                    <li class="slide has-sub">
                        <a href="javascript:void(0);" class="side-menu__item">
                            <span class=" side-menu__icon">
                                <i class="ri-customer-service-fill"></i>
                            </span>
                            <span class="side-menu__label">Call Management</span>
                            <i class="fe fe-chevron-right side-menu__angle"></i>
                        </a>
                        <ul class="slide-menu child1">
                            <li class="slide side-menu__label1">
                                <a href="javascript:void(0)">Call Management</a>
                            </li>

                            <li class="slide">
                                <a href="{{ url('admin/call-member-list') }}" class="side-menu__item">
                                    Member List</a>
                            </li>
                            <li class="slide">
                                <a href="{{ url('admin/member-list') }}" class="side-menu__item">
                                   Vivah Mitra</a>
                            </li>
                        </ul>
                    </li>

                    <li class="slide has-sub">
                        <a href="javascript:void(0);" class="side-menu__item">
                            <span class=" side-menu__icon">
                                <i class="ri-coupon-3-fill"></i>
                            </span>
                            <span class="side-menu__label">Set Offer</span>
                            <i class="fe fe-chevron-right side-menu__angle"></i>
                        </a>
                        <ul class="slide-menu child1">
                            <li class="slide side-menu__label1">
                                <a href="javascript:void(0)">Set Offer</a>
                            </li>

                            <li class="slide">
                                <a href="{{ url('admin/offer-list') }}" class="side-menu__item">
                                    Offer List</a>
                            </li>

                        </ul>
                    </li>

                    <li class="slide has-sub">
                        <a href="javascript:void(0);" class="side-menu__item">
                            <span class=" side-menu__icon">
                                <i class="ri-coupon-3-fill"></i>
                            </span>
                            <span class="side-menu__label">T&C Video</span>
                            <i class="fe fe-chevron-right side-menu__angle"></i>
                        </a>
                        <ul class="slide-menu child1">
                            <li class="slide side-menu__label1">
                                <a href="javascript:void(0)">Add T&C Video</a>
                            </li>

                            <li class="slide">
                                <a href="{{ url('admin/tndc-video-list') }}" class="side-menu__item">
                                    T&C Video List</a>
                            </li>

                        </ul>
                    </li>

                    <li class="slide has-sub">
                        <a href="javascript:void(0);" class="side-menu__item">
                            <span class=" side-menu__icon">
                                <i class="ri-coupon-3-fill"></i>
                            </span>
                            <span class="side-menu__label">Training Video</span>
                            <i class="fe fe-chevron-right side-menu__angle"></i>
                        </a>
                        <ul class="slide-menu child1">
                            <li class="slide side-menu__label1">
                                <a href="javascript:void(0)">Training Video</a>
                            </li>

                            <li class="slide">
                                <a href="{{ url('admin/training_video_category_list') }}" class="side-menu__item">
                                    Video Category List</a>
                            </li>

                            <li class="slide">
                                <a href="{{ url('admin/master-video-list') }}" class="side-menu__item">
                                    T&C Video List</a>
                            </li>

                        </ul>
                    </li>

                    <li class="slide has-sub">
                        <a href="javascript:void(0);" class="side-menu__item">
                            <span class=" side-menu__icon">
                                <i class="ri-coupon-3-fill"></i>
                            </span>
                            <span class="side-menu__label">Meeting</span>
                            <i class="fe fe-chevron-right side-menu__angle"></i> 
                        </a>
                        <ul class="slide-menu child1">
                            <li class="slide side-menu__label1">
                                <a href="javascript:void(0)">Meeting</a>
                            </li>

                            <li class="slide">
                                <a href="{{ url('admin/home-meeting-list') }}" class="side-menu__item">
                                    Home Meeting List</a>
                            </li>

                            <li class="slide">
                                <a href="{{ url('admin/trainer-meeting-list') }}" class="side-menu__item">
                                Trainer Meeting List</a>
                            </li>

                            <li class="slide">
                                <a href="{{ url('admin/seminar-guest-meeting-list') }}" class="side-menu__item">
                                Seminar Meeting List</a>
                            </li>



                        </ul>
                    </li>


                    <li class="slide has-sub">
                        <a href="javascript:void(0);" class="side-menu__item">
                            <span class=" side-menu__icon">
                                <i class='fe fe-box'></i>
                            </span>
                            <span class="side-menu__label">Master</span>
                            <i class="fe fe-chevron-right side-menu__angle"></i>
                        </a>
                        <ul class="slide-menu child1">
                            <li class="slide side-menu__label1">
                                <a href="javascript:void(0)">Master</a>
                            </li>
                            <li class="slide">
                                <a href="{{ url('admin/session') }}" class="side-menu__item">Session</a>
                            </li>
                            <li class="slide">
                                <a href="{{ url('admin/branch') }}" class="side-menu__item">Branch</a>
                            </li>
                            <li class="slide">
                                <a href="{{ url('admin/user-type') }}" class="side-menu__item">User Type</a>
                            </li>
                            <li class="slide">
                                <a href="{{ url('admin/designations') }}" class="side-menu__item">User Designation</a>
                            </li>
                            <li class="slide">
                                <a href="{{ url('admin/master-fund') }}" class="side-menu__item">Set Fund </a>
                            </li>
                            <li class="slide">
                                <a href="{{ url('admin/agreement-list') }}" class="side-menu__item">Agreement List</a>
                            </li>
                            <li class="slide">
                                <a href="{{ url('admin/target-list') }}" class="side-menu__item">Master Target</a>
                            </li>
                             <li class="slide">
                                <a href="{{ url('admin/master-video-list') }}" class="side-menu__item">Master Video List</a>
                            </li> 
                            <li class="slide">
                                <a href="{{ url('admin/master-yearly-bonus-list') }}" class="side-menu__item">Master Yearly
                                    Bonus List</a>
                            </li>
                            <li class="slide">
                                <a href="{{ url('admin/master-investor-investment-list') }}" class="side-menu__item">Master
                                    Investor Investment List</a>
                            </li>

                            <li class="slide">
                                <a href="{{ url('admin/location/states') }}" class="side-menu__item">State</a>
                            </li>

                            <li class="slide">
                                <a href="{{ url('admin/location/city') }}" class="side-menu__item">District</a>
                            </li>

                            <li class="slide">
                                <a href="{{ url('admin/location/blocks') }}" class="side-menu__item">Block</a>
                            </li>

                            <li class="slide">
                                <a href="{{ url('admin/location/panchayat') }}" class="side-menu__item">Panchayat</a>
                            </li>
                            <li class="slide">
                                <a href="{{ url('admin/location/ward') }}" class="side-menu__item">Ward</a>
                            </li>
                        </ul>
                    </li>
--}}
                    <!-- End::slide -->

                    <li class="slide has-sub">
                        <a href="javascript:void(0);" class="side-menu__item">
                            <span class=" side-menu__icon">
                                <i class="ri-customer-service-fill"></i>
                            </span>
                            <span class="side-menu__label">Notice</span>
                            <i class="fe fe-chevron-right side-menu__angle"></i>
                        </a>
                        <ul class="slide-menu child1">
                            <li class="slide side-menu__label1">
                                <a href="javascript:void(0)">Notice</a>
                            </li>
                            <li class="slide">
                                <a href="{{ url('admin/notice-list') }}" class="side-menu__item">Notice List</a>
                            </li>
                        </ul>
                    </li>

					{{-- <li class="slide has-sub">
                        <a href="javascript:void(0);" class="side-menu__item">
                            <span class=" side-menu__icon">
                                <i class="ri-customer-service-fill"></i>
                            </span>
                            <span class="side-menu__label">Message/SMS</span>
                            <i class="fe fe-chevron-right side-menu__angle"></i>
                        </a>
                        <ul class="slide-menu child1">
                            <li class="slide side-menu__label1">
                                <a href="javascript:void(0)">SMS List</a>
                            </li>
                            <li class="slide">
                                <a href="{{ url('admin/sms-lists') }}" class="side-menu__item">SMS List</a>
                            </li>
                        </ul>
                    </li>

                    <li class="slide has-sub">
                        <a href="javascript:void(0);" class="side-menu__item">
                            <span class=" side-menu__icon">
                                <i class="ri-customer-service-fill"></i>
                            </span>
                            <span class="side-menu__label">Vendor Management</span>
                            <i class="fe fe-chevron-right side-menu__angle"></i>
                        </a>
                        <ul class="slide-menu child1">
                            <li class="slide side-menu__label1">
                                <a href="javascript:void(0)">Vendor Management</a>
                            </li>
                            <li class="slide">
                                <a href="{{ url('admin/vendors') }}" class="side-menu__item">Vendor List</a>
                            </li>
                            <li class="slide">
                                <a href="{{ url('admin/vendors/create') }}" class="side-menu__item">Add Vendor</a>
                            </li>
                        </ul>
                    </li>

                    <li class="slide has-sub">
                        <a href="javascript:void(0);" class="side-menu__item">
                            <span class=" side-menu__icon">
                                <i class="ri-customer-service-fill"></i>
                            </span>
                            <span class="side-menu__label">Branch Strength</span>
                            <i class="fe fe-chevron-right side-menu__angle"></i>
                        </a>
                        <ul class="slide-menu child1">
                            <li class="slide side-menu__label1">
                                <a href="javascript:void(0)">Branch Strength</a>
                            </li>
                            <li class="slide">
                                <a href="{{ url('admin/vendors') }}" class="side-menu__item">Branch Strength List</a>
                            </li>
                            <li class="slide">
                                <a href="{{ url('admin/vendors/add-vendor') }}" class="side-menu__item">Add Branch
                                    Strength</a>
                            </li>
                        </ul>
                    </li>

                    <li class="slide has-sub">
                        <a href="javascript:void(0);" class="side-menu__item">
                            <span class=" side-menu__icon">
                                <i class="ri-customer-service-fill"></i>
                            </span>
                            <span class="side-menu__label">Expense Management</span>
                            <i class="fe fe-chevron-right side-menu__angle"></i>
                        </a>
                        <ul class="slide-menu child1">
                            <li class="slide side-menu__label1">
                                <a href="javascript:void(0)">Expense Management</a>
                            </li>
                            <li class="slide">
                                <a href="{{ url('admin/expense-groups') }}" class="side-menu__item">Group List</a>
                            </li>
                            <li class="slide">
                                <a href="{{ url('admin/expense-subgroups') }}" class="side-menu__item">Sub Group</a>
                            </li>
                            <li class="slide">
                                <a href="{{ url('admin/expense-list') }}" class="side-menu__item">Expense</a>
                            </li>
                        </ul>
                    </li>
                    <li class="slide has-sub">
                        <a href="javascript:void(0);" class="side-menu__item">
                            <span class=" side-menu__icon">
                                <i class="ri-customer-service-fill"></i>
                            </span>
                            <span class="side-menu__label">Term and Condition Management</span>
                            <i class="fe fe-chevron-right side-menu__angle"></i>
                        </a>
                        <ul class="slide-menu child1">
                            <li class="slide side-menu__label1">
                                <a href="javascript:void(0)">Term and Condition Management</a>
                            </li>
                            <li class="slide">
                                <a href="{{ url('admin/terms') }}" class="side-menu__item">Term and Condition List</a>
                            </li>

                        </ul>
                    </li>

                    <li class="slide has-sub">
                        <a href="javascript:void(0);" class="side-menu__item">
                            <span class=" side-menu__icon">
                                <i class="ri-customer-service-fill"></i>
                            </span>
                            <span class="side-menu__label">Attendance Management</span>
                            <i class="fe fe-chevron-right side-menu__angle"></i>
                        </a>
                        <ul class="slide-menu child1">
                            <li class="slide side-menu__label1">
                                <a href="javascript:void(0)">Attendance Management</a>
                            </li>
                            <li class="slide">
                                <a href="{{ url('admin/users') }}" class="side-menu__item">Make Attendance</a>
                            </li>
                            <li class="slide">
                                <a href="{{ url('admin/attendance-report') }}" class="side-menu__item">Attendance Report</a>
                            </li>
                            <li class="slide">
                                <a href="{{ url('admin/attendance-calendar') }}" class="side-menu__item">Attendance
                                    Calendar</a>
                            </li>
                        </ul>
                    </li>

                    <li class="slide has-sub">
                        <a href="javascript:void(0);" class="side-menu__item">
                            <span class=" side-menu__icon">
                                <i class="ri-customer-service-fill"></i>
                            </span>
                            <span class="side-menu__label">Profit & Loss</span>
                            <i class="fe fe-chevron-right side-menu__angle"></i>
                        </a>
                        <ul class="slide-menu child1">
                            <li class="slide side-menu__label1">
                                <a href="javascript:void(0)">Profit & Loss</a>
                            </li>
                            <li class="slide">
                                <a href="{{ url('admin/vendors') }}" class="side-menu__item">Profit & Loss</a>
                            </li>

                        </ul>
                    </li>

                    <li class="slide has-sub">
                        <a href="javascript:void(0);" class="side-menu__item">
                            <span class=" side-menu__icon">
                                <i class="ri-customer-service-fill"></i>
                            </span>
                            <span class="side-menu__label">Incentive Management</span>
                            <i class="fe fe-chevron-right side-menu__angle"></i>
                        </a>
                        <ul class="slide-menu child1">
                            <li class="slide side-menu__label1">
                                <a href="javascript:void(0)">Incentive Management</a>
                            </li>
                            <li class="slide">
                                <a href="{{ url('admin/vivah-mitra-incentive') }}" class="side-menu__item">Vivah Mitra Incentive</a>
                            </li>
                            <li class="slide">
                                <a href="{{ url('admin/panchayat-vivah-mitra-incentive') }}" class="side-menu__item">Panchayat Vivah Mitra
                                    Incentive</a>
                            </li>
                            <li class="slide">
                                <a href="{{ url('admin/prakhand-vivah-mitra-incentive') }}" class="side-menu__item">Prakhand Vivah Mitra Incentive</a>
                            </li>
                            <li class="slide">
                                <a href="{{ url('admin/jila-vivah-mitra-incentive') }}" class="side-menu__item">Jila Vivah Mitra
                                    Incentive</a>
                            </li>
                            <li class="slide">
                                <a href="{{ url('admin/vendors') }}" class="side-menu__item">Peon Vivah Mitra Incentive</a>
                            </li>
                            <li class="slide">
                                <a href="{{ url('admin/vendors') }}" class="side-menu__item">Assistant Sales Manager
                                    Incentive</a>
                            </li>
                            <li class="slide">
                                <a href="{{ url('admin/vendors') }}" class="side-menu__item">BM Sales Manager Incentive</a>
                            </li>
                            <li class="slide">
                                <a href="{{ url('admin/vendors') }}" class="side-menu__item">F.O Field Officer Incentive</a>
                            </li>
                            <li class="slide">
                                <a href="{{ url('admin/vendors') }}" class="side-menu__item">A.S.M Incentive</a>
                            </li>
                            <li class="slide">
                                <a href="{{ url('admin/vendors') }}" class="side-menu__item">Z.M Incentive</a>
                            </li>
                            <li class="slide">
                                <a href="{{ url('admin/vendors') }}" class="side-menu__item">Investor Incentive</a>
                            </li>

                        </ul>
                    </li>

                    <li class="slide has-sub">
                        <a href="javascript:void(0);" class="side-menu__item">
                            <span class=" side-menu__icon">
                                <i class="ri-customer-service-fill"></i>
                            </span>
                            <span class="side-menu__label">VIP Customer</span>
                            <i class="fe fe-chevron-right side-menu__angle"></i>
                        </a>
                        <ul class="slide-menu child1">
                            <li class="slide side-menu__label1">
                                <a href="javascript:void(0)">VIP Customer</a>
                            </li>
                            <li class="slide">
                                <a href="{{ url('admin/dashboard') }}" class="side-menu__item">1 Lakh List</a>
                            </li>
                            <li class="slide">
                                <a href="{{ url('admin/dashboard') }}" class="side-menu__item">2 Lakh List</a>
                            </li>
                            <li class="slide">
                                <a href="{{ url('admin/dashboard') }}" class="side-menu__item">3 Lakh List</a>
                            </li>
                            <li class="slide">
                                <a href="{{ url('admin/dashboard') }}" class="side-menu__item">4 Lakh List</a>
                            </li>
                            <li class="slide">
                                <a href="{{ url('admin/dashboard') }}" class="side-menu__item">5 Lakh List</a>
                            </li>
                            <li class="slide">
                                <a href="{{ url('admin/dashboard') }}" class="side-menu__item">6 Lakh List</a>
                            </li>
                            <li class="slide">
                                <a href="{{ url('admin/dashboard') }}" class="side-menu__item">7 Lakh List</a>
                            </li>
                            <li class="slide">
                                <a href="{{ url('admin/dashboard') }}" class="side-menu__item">8 Lakh List</a>
                            </li>
                            <li class="slide">
                                <a href="{{ url('admin/dashboard') }}" class="side-menu__item">9 Lakh List</a>
                            </li>
                            <li class="slide">
                                <a href="{{ url('admin/dashboard') }}" class="side-menu__item">10 Lakh List</a>
                            </li>
                            <li class="slide">
                                <a href="{{ url('admin/dashboard') }}" class="side-menu__item">11 Lakh List</a>
                            </li>


                        </ul>
                    </li>

                    <li class="slide has-sub">
                        <a href="javascript:void(0);" class="side-menu__item">
                            <span class=" side-menu__icon">
                                <i class="ri-customer-service-fill"></i>
                            </span>
                            <span class="side-menu__label">Navigation</span>
                            <i class="fe fe-chevron-right side-menu__angle"></i>
                        </a>
                        <ul class="slide-menu child1">
                            <li class="slide side-menu__label1">
                                <a href="javascript:void(0)">Navigation</a>
                            </li>
                            <li class="slide">
                                <a href="{{ url('admin/navigations') }}" class="side-menu__item">Manage Navigation</a>
                            </li>

                            <li class="slide">
                                <a href="{{ url('admin/navigation/user-roles') }}" class="side-menu__item">Set User
                                    Roles</a>
                            </li>


                        </ul>
                    </li>
					--}}
                    <li class="li-section-title">Website Menu</li>

                    <!-- Start::slide -->
                    <li class="slide has-sub">
                        <a href="javascript:void(0);" class="side-menu__item">
                            <span class=" side-menu__icon">
                                <i class='fe fe-box'></i>
                            </span>
                            <span class="side-menu__label">Blogs</span>
                            <i class="fe fe-chevron-right side-menu__angle"></i>
                        </a>
                        <ul class="slide-menu child1">
                            <li class="slide side-menu__label1">
                                <a href="javascript:void(0)">Blogs</a>
                            </li>
                            <li class="slide">
                                <a href="{{ url('admin/blogs') }}" class="side-menu__item">Blogs List</a>
                                <a href="{{ url('admin/blogs/create') }}" class="side-menu__item">Add Blogs</a>
                            </li>
                        </ul>
                    </li>

                    <li class="slide has-sub">
                        <a href="javascript:void(0);" class="side-menu__item">
                            <span class=" side-menu__icon">
                                <i class="ri-pages-line"></i>
                            </span>
                            <span class="side-menu__label">CMS Setting</span>
                            <i class="fe fe-chevron-right side-menu__angle"></i>
                        </a>
                        <ul class="slide-menu child1">
                            <li class="slide side-menu__label1">
                                <a href="javascript:void(0)">CMS Setting</a>
                            </li>
                            <li class="slide">
                                <a href="{{ url('admin/pages') }}" class="side-menu__item">Page List</a>
                                <a href="{{ url('admin/page_sections') }}" class="side-menu__item">Page Section List</a>
                                <a href="{{ url('admin/section_data') }}" class="side-menu__item">Page Section Data List</a>
                            </li>
                        </ul>
                    </li>

                    <!-- Start::slide -->
                    <li class="slide has-sub">
                        <a href="javascript:void(0);" class="side-menu__item">
                            <span class=" side-menu__icon">
                                <i class="ri-youtube-line"></i>
                            </span>
                            <span class="side-menu__label">Videos</span>
                            <i class="fe fe-chevron-right side-menu__angle"></i>
                        </a>
                        <ul class="slide-menu child1">
                            <li class="slide side-menu__label1">
                                <a href="javascript:void(0)">Videos</a>
                            </li>
                            <li class="slide">
                                <a href="{{ url('admin/videos-category') }}" class="side-menu__item">Video Category</a>
                                {{-- <a href="{{ url('admin/videos-of-assembly/create') }}" class="side-menu__item">Add
                                    Videos</a> --}}
                                <a href="{{ url('admin/videos-of-assembly') }}" class="side-menu__item">Videos</a>
                                <a href="{{ url('admin/videos-of-assembly/create') }}" class="side-menu__item">Add
                                    Videos</a>
                            </li>
                        </ul>
                    </li>


                    <!-- Start::slide -->
                    <li class="slide has-sub">
                        <a href="javascript:void(0);" class="side-menu__item">
                            <span class=" side-menu__icon">
                                <i class='fe fe-box'></i>
                            </span>
                            <span class="side-menu__label">Latest Events</span>
                            <i class="fe fe-chevron-right side-menu__angle"></i>
                        </a>
                        <ul class="slide-menu child1">
                            <li class="slide side-menu__label1">
                                <a href="javascript:void(0)">Latest Events</a>
                            </li>
                            <li class="slide">
                                <a href="{{ url('admin/event_categories') }}" class="side-menu__item">Event Category</a>
                                <a href="{{ url('admin/event_categories/create') }}" class="side-menu__item">Add Event
                                    Category</a>
                            </li>
                            <li class="slide">
                                <a href="{{ url('admin/event_galleries/create') }}" class="side-menu__item">Add Event
                                    Gallery</a>
                                <a href="{{ url('admin/event_galleries') }}" class="side-menu__item">Event Gallery List</a>
                            </li>
                        </ul>
                    </li>

                    <!-- Start::slide -->
                    <li class="slide has-sub">
                        <a href="javascript:void(0);" class="side-menu__item">
                            <span class=" side-menu__icon">
                                <i class='fe fe-image'></i>
                            </span>
                            <span class="side-menu__label">Gallery Photos</span>
                            <i class="fe fe-chevron-right side-menu__angle"></i>
                        </a>
                        <ul class="slide-menu child1">
                            <li class="slide side-menu__label1">
                                <a href="javascript:void(0)">Gallery Photos</a>
                            </li>
                            <li class="slide">
                                <a href="{{ url('admin/image_categories') }}" class="side-menu__item">Photo Category</a>
                                <a href="{{ url('admin/image_categories/create') }}" class="side-menu__item">Add Photo
                                    Category</a>
                            </li>
                            <li class="slide">
                                <a href="{{ url('admin/galleries/create') }}" class="side-menu__item">Add Latest Photos</a>
                                <a href="{{ url('admin/galleries') }}" class="side-menu__item">Latest Photos List</a>
                            </li>
                        </ul>
                    </li>

                    <!-- Start::slide -->
                    <li class="slide has-sub">
                        <a href="javascript:void(0);" class="side-menu__item">
                            <span class=" side-menu__icon">
                                <i class='fe fe-bell'></i>
                            </span>
                            <span class="side-menu__label">Notification</span>
                            <i class="fe fe-chevron-right side-menu__angle"></i>
                        </a>
                        <ul class="slide-menu child1">
                            <li class="slide side-menu__label1">
                                <a href="javascript:void(0)">Notification</a>
                            </li>
                            <li class="slide">
                                <a href="{{ url('admin/notification') }}" class="side-menu__item">Notification</a>
                                <a href="{{ url('admin/add-notification') }}" class="side-menu__item">Add Notification</a>
                            </li>
                        </ul>
                    </li>


                    <li class="slide has-sub">
                        <a href="javascript:void(0);" class="side-menu__item">
                            <span class=" side-menu__icon">
                                <i class='fe fe-globe'></i>
                            </span>
                            <span class="side-menu__label">Website Setting</span>
                            <i class="fe fe-chevron-right side-menu__angle"></i>
                        </a>
                        <ul class="slide-menu child1">
                            <li class="slide side-menu__label1">
                                <a href="javascript:void(0)">Website Setting</a>
                            </li>

                            <li class="slide">

                                <a href="{{ url('admin/website/header') }}" class="side-menu__item">Header</a>
                                <a href="{{ url('admin/website/footer') }}" class="side-menu__item">Footer</a>
                                <a href="{{ url('admin/website/social_media') }}" class="side-menu__item">Social Media</a>
                                <a href="{{ url('admin/website/home-banner') }}" class="side-menu__item">Home Banner</a>
                            </li>
                        </ul>
                    </li>

                    <!-- Start::slide -->
                    {{-- <li class="slide has-sub">
                        <a href="javascript:void(0);" class="side-menu__item">
                            <span class=" side-menu__icon">
                                <i class="ri-team-fill"></i>
                            </span>
                            <span class="side-menu__label">Team</span>
                            <i class="fe fe-chevron-right side-menu__angle"></i>
                        </a>
                        <ul class="slide-menu child1">
                            <li class="slide side-menu__label1">
                                <a href="javascript:void(0)">Team</a>
                            </li>
                            <li class="slide">
                                <a href="{{ url('admin/staffs') }}" class="side-menu__item">Team List</a>
                                <a href="{{ url('admin/staffs/create') }}" class="side-menu__item">Add Team</a>
                            </li>
                        </ul>
                    </li> --}}



                    <!-- End::slide -->
                    <!-- Start::slide -->
                    <li class="slide has-sub">
                        <a href="javascript:void(0);" class="side-menu__item">
                            <span class=" side-menu__icon">
                                <i class="ri-customer-service-fill"></i>
                            </span>
                            <span class="side-menu__label">Enquiry</span>
                            <i class="fe fe-chevron-right side-menu__angle"></i>
                        </a>
                        <ul class="slide-menu child1">
                            <li class="slide side-menu__label1">
                                <a href="javascript:void(0)">Enquiry</a>
                            </li>
                            {{-- <li class="slide">
                                <a href="{{ url('admin/customer/leads') }}" class="side-menu__item">Enquiry List</a>
                            </li>--}}
                            <li class="slide">
                                <a href="{{ url('admin/home-page-enquiry') }}" class="side-menu__item">Home Page Enquiry
                                    List</a>
                            </li>
                            <li class="slide">
                                <a href="{{ url('admin/complain-list') }}" class="side-menu__item">Complain List</a>
                            </li>
                            <li class="slide">
                                <a href="{{ url('admin/contact-enquiry') }}" class="side-menu__item">Contact Page List</a>
                            </li>

                        </ul>
                    </li>


                </ul>
            @else
                <ul class="main-menu">

                    <!-- Start::slide -->
                    <li class="slide">
                        <a href="{{ url('admin/dashboard') }}" class="side-menu__item">
                            <span class=" side-menu__icon">
                                <i class='fe fe-airplay'></i>
                            </span>
                            <span class="side-menu__label">Dashboard</span>
                        </a>
                    </li>



                    @foreach(user_menus() as $menu)
                        <li class="slide has-sub">
                            <a href="{{ $menu->route != '#' ? route($menu->route) : 'javascript:void(0);' }}"
                                class="side-menu__item">
                                <span class=" side-menu__icon">
                                    <i class="ri-customer-service-fill"></i>
                                </span>
                                <span class="side-menu__label">{{ $menu->name }}</span>
                                <i class="fe fe-chevron-right side-menu__angle"></i>
                            </a>
                            @if($menu->children->count())
                                <ul class="slide-menu child1">
                                    <li class="slide side-menu__label1">
                                        <a href="javascript:void(0);">{{ $menu->name }}</a>
                                    </li>
                                    @foreach($menu->children as $child)
                                        <li class="slide">
                                            <a href="{{ route($child->route) }}" class="side-menu__item">{{ $child->name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach



                </ul>


            @endif



            <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24"
                    height="24" viewBox="0 0 24 24">
                    <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"></path>
                </svg></div>
        </nav>
        <!-- End::nav -->

    </div>
    <!-- End::main-sidebar -->




</aside>
<!-- End::app-sidebar -->
