<!-- Start::app-sidebar -->
<style>
.app-sidebar {
    width: 15rem;
    height: 100%;
    background: #2b2c54;
    border-inline-end: 1px solid var(--menu-border-color);
    position: fixed;
    inset-block-start: 0;
    inset-inline-start: 0;
    z-index: 103;
    transition: all 0.1s ease-out;
}

.app-sidebar .side-menu__label {
    white-space: nowrap;
    align-items: center;
    color: #abb8c7;
    position: relative;
    font-size: 0.875rem;
    font-weight: 500;
    line-height: 1;
    vertical-align: middle;
}

.app-sidebar .side-menu__icon {
    margin-inline-end: 0.625rem;
    font-size: 1.125rem;
    text-align: center;
    color: #c7cff1;
    fill: var(--menu-prime-color);
    border-radius: 0.4rem;
    line-height: 0;
}

.app-sidebar .main-sidebar-header {
    height: 4rem;
    width: 14.95rem;
    position: fixed;
    display: flex;
    background: #2b2c54;
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

.app-sidebar .side-menu__item {
    padding: 12px 22px 12px 18px;
    position: relative;
    display: flex;
    align-items: center;
    text-decoration: none;
    font-size: 0.78rem;
    color: #abb8c7;
    font-weight: 400;
    border-radius: 0.4rem;
}

</style>
	  <aside  class="app-sidebar sticky" id="sidebar">

            <!-- Start::main-sidebar-header -->
            <div class="main-sidebar-header">
                <a href="{{ url('admin/dashboard') }}" class="header-logo">
                    <img src="{{ static_asset('assets/assets_admin/images/brand-logos/desktop-logo.png') }}" alt="logo" class="desktop-logo">
                    <img src="{{ static_asset('assets/assets_admin/images/brand-logos/toggle-logo.png') }}" alt="logo" class="toggle-logo">
                    <img src="{{ static_asset('assets/assets_admin/images/brand-logos/desktop-dark.png') }}" alt="logo" class="desktop-dark">
                    <img src="{{ static_asset('assets/assets_admin/images/brand-logos/toggle-dark.png') }}" alt="logo" class="toggle-dark">
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
                                    <img src="{{ static_asset('assets/assets_admin/images/faces/user.png') }}" alt="user-img" class="rounded-circle mCS_img_loaded">
                                </div>
                                <div class="user-info">
                                    <h6 class=" mb-0 text-white">{{session('LoggedStudent')->english_name}}</h6>
                                    <span class="fs-13 text-uppercase text-white">STUDENT PANEL</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="sidebar-navs mx-auto my-2">
                        <button aria-label="button" type="button" class="btn btn-icon btn-outline-light rounded-pill btn-wave m-1">
                            <i class="fe fe-settings"></i>
                        </button>
                        <button aria-label="button" type="button" class="btn btn-icon btn-outline-light rounded-pill btn-wave m-1">
                            <i class="fe fe-mail"></i>
                        </button>
                        <button aria-label="button" type="button" class="btn btn-icon btn-outline-light rounded-pill btn-wave m-1">
                            <i class="fe fe-user"></i>
                        </button>
                        <button onclick="window.location.href='{{ url('admin/logout') }}'" aria-label="button" type="button" class="btn btn-icon btn-outline-light rounded-pill btn-wave m-1">
                            <i class="fe fe-power"></i>
                        </button>
                    </div>
                    <div class="slide-left" id="slide-left">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24"> <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"></path> </svg>
                    </div>

					<ul class="main-menu">

                        <!-- Start::slide -->
                        <li class="slide">
                            <a href="{{ url('student/dashboard') }}" class="side-menu__item">
                                <span class=" side-menu__icon">
                                    <i class='fe fe-airplay' ></i>
                                </span>
                                <span class="side-menu__label">Dashboard</span>
                            </a>
                        </li>
                        <!-- End::slide -->
                        
                        <li class="slide has-sub">
                            <a href="javascript:void(0);" class="side-menu__item">
                                <span class=" side-menu__icon">
                                    <i class="ri-team-fill"></i>
                                </span>
                                 <span class="side-menu__label">My Profile</span>
                                <i class="fe fe-chevron-right side-menu__angle"></i>
                            </a>
                            <ul class="slide-menu child1">
                                <li class="slide side-menu__label1">
                                    <a href="javascript:void(0)">Profile</a>
                                </li>
                                <li class="slide">
                                    <a href="{{ url('student/my-profile') }}" class="side-menu__item">My Profile</a>
                                    <a href="{{ url('student/id-card') }}" class="side-menu__item">Id Card</a>
                                </li>
                            </ul>
                        </li>


                        <li class="slide has-sub">
                            <a href="javascript:void(0);" class="side-menu__item">
                                <span class=" side-menu__icon">
                                    <i class="ri-team-fill"></i>
                                </span>
                                 <span class="side-menu__label">Study Material</span>
                                <i class="fe fe-chevron-right side-menu__angle"></i>
                            </a>
                            <ul class="slide-menu child1">
                                <li class="slide side-menu__label1">
                                    <a href="javascript:void(0)">Study Material</a>
                                </li>
                                <li class="slide">
                                    <a href="{{ url('student/study-material') }}" class="side-menu__item">View Study Material</a>
                                    {{-- <a href="{{ url('admin/tenders/create') }}" class="side-menu__item">Add Student</a> --}}
                                </li>
                            </ul>
                        </li>
                        
                        <li class="slide has-sub">
                            <a href="javascript:void(0);" class="side-menu__item">
                                <span class=" side-menu__icon">
                                    <i class="ri-team-fill"></i>
                                </span>
                                 <span class="side-menu__label">Admit Card</span>
                                <i class="fe fe-chevron-right side-menu__angle"></i>
                            </a>
                            <ul class="slide-menu child1">
                                <li class="slide side-menu__label1">
                                    <a href="javascript:void(0)">Admit Card</a>
                                </li>
                                <li class="slide">
                                    <a href="{{ url('student/admit-card') }}" class="side-menu__item">Admit Card</a>
                                </li>
                            </ul>
                        </li>
                        
                        <li class="slide has-sub">
                            <a href="javascript:void(0);" class="side-menu__item">
                                <span class=" side-menu__icon">
                                    <i class="ri-team-fill"></i>
                                </span>
                                 <span class="side-menu__label">Exam</span>
                                <i class="fe fe-chevron-right side-menu__angle"></i>
                            </a>
                            <ul class="slide-menu child1">
                                <li class="slide side-menu__label1">
                                    <a href="javascript:void(0)">Exam</a>
                                </li>
                                <li class="slide">
                                    <a href="{{ url('student/study-material') }}" class="side-menu__item">View Study Material</a>
                                    {{-- <a href="{{ url('admin/tenders/create') }}" class="side-menu__item">Add Student</a> --}}
                                </li>
                            </ul>
                        </li>

                        <li class="slide has-sub">
                            <a href="javascript:void(0);" class="side-menu__item">
                                <span class=" side-menu__icon">
                                    <i class="ri-team-fill"></i>
                                </span>
                                 <span class="side-menu__label">Result</span>
                                <i class="fe fe-chevron-right side-menu__angle"></i>
                            </a>
                            <ul class="slide-menu child1">
                                <li class="slide side-menu__label1">
                                    <a href="javascript:void(0)">Result</a>
                                </li>
                                <li class="slide">
                                    <a href="{{ url('student/view-result') }}" class="side-menu__item">View Result</a>
                                    <!--<a href="{{ url('student/view-manual-result') }}" class="side-menu__item">View Result</a>-->
                                </li>
                            </ul>
                        </li>

                    </ul>


                    <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24"> <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"></path> </svg></div>
                </nav>
                <!-- End::nav -->

            </div>
            <!-- End::main-sidebar -->




        </aside>
        <!-- End::app-sidebar -->

