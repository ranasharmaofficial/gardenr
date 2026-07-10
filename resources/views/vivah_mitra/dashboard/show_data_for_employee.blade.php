@extends('vivah_mitra.layouts.master')
@section('title') Show Data @endsection

@section('meta_tags')

@endsection
@section('content')
<style>
.dash-box{
    position:relative;
    border-radius:18px;
    padding:20px;
    height:140px;
    color:#fff;
    overflow:hidden;
    box-shadow:0 6px 15px rgba(0,0,0,0.15);
}

.income-box{
   background: linear-gradient(135deg, #d4af37, #c79a2b);
    border-radius: 5px;
	padding:5px;
}

.apply-box{
    background:linear-gradient(135deg,#ff5f8f,#f4436c);
}

.icon-box{
    width:40px;
    height:40px;
    background:rgba(255,255,255,0.3);
    border-radius:10px;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:18px;
}

.count{
    font-size:28px;
    font-weight:700;
    margin-top:10px;
	color:#fff;
}

.dash-box h6{
    font-size:14px;
    margin:0;
	color:#fff;
}

.view-btn{
    position:absolute;
    bottom:15px;
    right:15px;
    background:#fff;
    color:#333;
    padding:4px 14px;
    border-radius:20px;
    font-size:12px;
    font-weight:600;
    text-decoration:none;
}
</style>
        <!-- Header -->
	<header class="header transparent">
		<div class="main-bar">
			<div class="container">
				<div class="header-content">
					<div class="left-content">
						<a href="javascript:void(0);" class="menu-toggler">
							<svg width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path opacity="0.4" d="M16.0755 2H19.4615C20.8637 2 22 3.14585 22 4.55996V7.97452C22 9.38864 20.8637 10.5345 19.4615 10.5345H16.0755C14.6732 10.5345 13.537 9.38864 13.537 7.97452V4.55996C13.537 3.14585 14.6732 2 16.0755 2Z" fill="#a19fa8"></path>
								<path fill-rule="evenodd" clip-rule="evenodd" d="M4.53852 2H7.92449C9.32676 2 10.463 3.14585 10.463 4.55996V7.97452C10.463 9.38864 9.32676 10.5345 7.92449 10.5345H4.53852C3.13626 10.5345 2 9.38864 2 7.97452V4.55996C2 3.14585 3.13626 2 4.53852 2ZM4.53852 13.4655H7.92449C9.32676 13.4655 10.463 14.6114 10.463 16.0255V19.44C10.463 20.8532 9.32676 22 7.92449 22H4.53852C3.13626 22 2 20.8532 2 19.44V16.0255C2 14.6114 3.13626 13.4655 4.53852 13.4655ZM19.4615 13.4655H16.0755C14.6732 13.4655 13.537 14.6114 13.537 16.0255V19.44C13.537 20.8532 14.6732 22 16.0755 22H19.4615C20.8637 22 22 20.8532 22 19.44V16.0255C22 14.6114 20.8637 13.4655 19.4615 13.4655Z" fill="#a19fa8"></path>
							</svg>
						</a>
					</div>
					<div class="mid-content">
					</div>
					<div class="right-content">
                        <a href="javascript:void(0);" class="theme-color" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom" aria-controls="offcanvasBottom">
                            <svg class="color-plate" enable-background="new 0 0 512.214 512.214" height="24" viewbox="0 0 512.214 512.214" width="24" xmlns="http://www.w3.org/2000/svg"><g id="Color_Palette_1_"><g><path d="m247.523 512.214c-1.552 0-3.111-.04-4.68-.12-18.018-.919-36.245-3.725-54.178-8.339-92.826-23.89-161.982-96.467-182.181-189.601-9.88-45.557-8.432-90.341 4.304-133.109 23.822-80.001 86.489-145.327 170.276-170.276 42.766-12.735 87.55-14.183 133.108-4.303 93.122 20.195 165.672 89.343 189.565 182.18 4.615 17.933 7.421 36.161 8.339 54.177 1.854 36.362-17.939 68.259-51.657 83.242-34.298 15.243-73.443 8.112-99.723-18.167-15.537-15.538-37.242-15.538-52.779 0-15.611 15.597-15.676 37.153-.007 52.811.003.002.004.004.006.006 26.278 26.278 33.41 65.42 18.168 99.721-14.337 32.263-44.159 51.778-78.561 51.778zm7.237-472.209c-57.565 0-111.211 21.694-152.127 62.61-52.797 52.797-73.594 126.81-57.058 203.062 16.995 78.361 75.644 139.417 153.059 159.341 15.342 3.948 30.9 6.347 46.245 7.129 19.745 1.012 36.427-9.444 44.651-27.953 6.736-15.161 7.675-37.622-9.898-55.194-31.279-31.26-31.212-78.199.007-109.391 31.161-31.163 78.172-31.165 109.343.006 17.572 17.573 40.033 16.634 55.194 9.898 18.509-8.225 28.959-24.917 27.953-44.652-.782-15.344-3.181-30.902-7.13-46.244-23.476-91.222-104.657-158.612-210.239-158.612z"></path></g><g><path d="m156.197 396.178c-33.084 0-60-26.916-60-60s26.916-60 60-60 60 26.916 60 60-26.916 60-60 60zm0-80c-11.028 0-20 8.972-20 20s8.972 20 20 20 20-8.972 20-20-8.972-20-20-20z"></path></g><g><path d="m156.197 236.179c-33.084 0-60-26.916-60-60s26.916-60 60-60 60 26.916 60 60-26.916 60-60 60zm0-80c-11.028 0-20 8.972-20 20s8.972 20 20 20 20-8.972 20-20-8.972-20-20-20z"></path></g><g><path d="m316.197 216.179c-33.084 0-60-26.916-60-60s26.916-60 60-60 60 26.916 60 60-26.916 60-60 60zm0-80c-11.028 0-20 8.972-20 20s8.972 20 20 20 20-8.972 20-20-8.972-20-20-20z"></path></g></g></svg>
                        </a>
                        <a href="javascript:void(0);" class="theme-btn">
                            <svg class="dark" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
                            </svg>
                        <svg class="light" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="5"></circle><line x1="12" y1="1" x2="12" y2="3"></line><line x1="12" y1="21" x2="12" y2="23"></line><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line><line x1="1" y1="12" x2="3" y2="12"></line><line x1="21" y1="12" x2="23" y2="12"></line><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line></svg>
                        </a>
					</div>
				</div>
			</div>
		</div>
	</header>
    <!-- Header End -->

         @include('vivah_mitra.includes.sidebar')

    <!-- Banner -->
        <div class="banner-wrapper author-notification">
            <div class="container inner-wrapper">
                <div class="dz-info">
                    <span>{{ timeGreeting() }}</span>
                    <h2 class="name mb-0">{{ $vivah_mitra_details->first_name }}</h2>
                    <h2 class="name mb-0">{{ $vivah_mitra_details->designation_name }}</h2>
                    <h2 class="name mb-0">{{ $vivah_mitra_details->employee_code }}</h2>
                </div>
                <div class="dz-media media-45 rounded-circle">
                    <a  href="{{ url('member/my-profile') }}">
						<img style="width: 60px;height: 60px;border-radius: 50%;object-fit: cover;border: 1px solid #fff;position: absolute;transform: translateX(-50%);background: #fff;" src="{{ !empty($vivah_mitra_details->profile_pic)
							? static_asset($vivah_mitra_details->profile_pic)
							: static_asset('assets/assets_vivah_mitra/images/author/pic1.png') }}"
						alt="Profile Picture">
					</a>
                </div>
            </div>
        </div>
    <!-- Banner End -->

    <!-- Page Content -->
    <div class="page-content">
 
        <div class="content-inner pt-0">
			<div class="container fb">
                <!-- Search -->
                 

                <!-- Dashboard Area -->
                <div class="dashboard-area m-b30">

					

					 
					
					<div class="features-box  mt-3">
						 
						<div class="container mt-3">
    <div style="margin-top: 58px;" class="row">

		<div class="col-12 mb-3">
            <div class="income-box">
                <h6 style="font-size: 1.3rem;margin-top: 10px;color:#fff;">Showing Data of {{ $check_district->name ?? ''}}</h6>
			</div>
        </div>
		
        <div class="col-12 mb-3">
            <div class="dash-box apply-box">
                <div class="icon-box">
                    <i class="fas fa-wallet"></i>
                </div>

                <h3 class="count">{{ $physical_membership }}</h3>
                <h6>Physical Membership</h6>

                <a href="javascript:void(0);" class="view-btn">View</a>
            </div>
        </div>

        <div class="col-12 mb-3">
            <div class="dash-box apply-box">
                <div class="icon-box">
                    <i class="fas fa-bolt"></i>
                </div>

                <h3 class="count">{{ $digital_membership }}</h3>
                <h6>Digital Membership</h6>

                <a href="javascript:void(0);" class="view-btn">View</a>
            </div>
        </div>
		
		<div class="col-12 mb-3">
            <div class="dash-box apply-box">
                <div class="icon-box">
                    <i class="fas fa-bolt"></i>
                </div>

                <h3 class="count">{{ $jila_vivah_mitra }}</h3>
                <h6>Jila Vivah Mitra</h6>

                <a href="javascript:void(0);" class="view-btn">View</a>
            </div>
        </div>
		
		<div class="col-12 mb-3">
            <div class="dash-box apply-box">
                <div class="icon-box">
                    <i class="fas fa-bolt"></i>
                </div>

                <h3 class="count">{{ $prakhand_vivah_mitra }}</h3>
                <h6>Prakhand Vivah Mitra</h6>

                <a href="javascript:void(0);" class="view-btn">View</a>
            </div>
        </div>
		
		<div class="col-12 mb-3">
            <div class="dash-box apply-box">
                <div class="icon-box">
                    <i class="fas fa-bolt"></i>
                </div>

                <h3 class="count">{{ $panchayat_vivah_mitra }}</h3>
                <h6>Panchayat Vivah Mitra</h6>

                <a href="javascript:void(0);" class="view-btn">View</a>
            </div>
        </div>
		
		<div class="col-12 mb-3">
            <div class="dash-box apply-box">
                <div class="icon-box">
                    <i class="fas fa-bolt"></i>
                </div>

                <h3 class="count">{{ $vivah_mitra }}</h3>
                <h6>Vivah Mitra</h6>

                <a href="javascript:void(0);" class="view-btn">View</a>
            </div>
        </div>

    </div>
</div>
					</div>
					 
					
					  
					 
				</div>
			</div>
		</div>

    </div>
    <!-- Page Content End-->

    @include('vivah_mitra.includes.home_footer_menu')

    @endsection
