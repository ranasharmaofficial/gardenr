@extends('vivah_mitra.layouts.master')
@section('title') Home @endsection

@section('meta_tags')

@endsection
@section('content')
<style>
.district-card{
    position: relative;
    background: linear-gradient(135deg,#43cea2,#185a9d);
    border-radius: 20px;
    padding: 30px;
    height: 150px;
    overflow: hidden;
    transition: all .3s ease;
    box-shadow: 0 8px 20px rgba(0,0,0,0.15);
}

.district-card:hover{
    transform: translateY(-6px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.25);
}

.card-icon{
    width:50px;
    height:50px;
    background: rgba(255,255,255,0.2);
    border-radius:12px;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:22px;
    color:#fff;
}

.district-name{
    color:#fff;
    font-weight:600;
    margin-top:15px;
    font-size:20px;
}

.view-btn{
    position:absolute;
    bottom:20px;
    right:20px;
    background:#fff;
    color:#333;
    padding:6px 18px;
    border-radius:20px;
    font-size:14px;
    font-weight:600;
    text-decoration:none;
    transition:all .3s ease;
}

.view-btn:hover{
    background:#000;
    color:#fff;
}


/* shop css here */

/* =========================
   Shop Section
========================= */

.shop-section{
    padding: 10px 5px;
}

/* Heading */

.section-heading h3{
    color:#111827;
    font-size:28px;
}

.section-heading p{
    font-size:14px;
}

/* Card */

.shop-card{
    background: linear-gradient(135deg, #14b8a6, #2563eb);
    border-radius: 22px;
    padding: 18px;
    display:flex;
    align-items:center;
    justify-content:space-between;
    box-shadow:0 8px 20px rgba(0,0,0,0.08);
    transition:0.3s ease;
}

.shop-card:hover{
    transform:translateY(-3px);
}

/* Left Side */

.shop-left{
    display:flex;
    align-items:center;
    gap:14px;
}

/* Icon */

.shop-icon{
    width:60px;
    height:60px;
    border-radius:18px;
    background:rgba(255,255,255,0.18);
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:24px;
    color:#fff;
}

/* Info */

.shop-title{
    color:#fff;
    font-weight:700;
    margin-bottom:6px;
    font-size:22px;
}

.shop-badge{
    background:rgba(255,255,255,0.18);
    color:#fff;
    padding:4px 12px;
    border-radius:30px;
    font-size:12px;
    font-weight:600;
}

/* Button */

.shop-btn{
    background:#fff;
    color:#111827;
    text-decoration:none;
    padding:10px 22px;
    border-radius:30px;
    font-weight:700;
    transition:0.3s ease;
    display:inline-block;
}

.shop-btn:hover{
    background:#111827;
    color:#fff;
}

/* Mobile */

@media(max-width:576px){

    .shop-card{
        padding:16px;
    }

    .shop-title{
        font-size:20px;
    }

    .shop-btn{
        padding:8px 18px;
        font-size:14px;
    }
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
@if(count($vivah_mitra_app_sliders) > 0)
						<div id="mainCarousel" class="carousel slide mt-3" data-bs-ride="carousel">

							<!-- Indicators -->
							<div class="carousel-indicators">
								@foreach($vivah_mitra_app_sliders as $key => $item)
									<button
										type="button"
										data-bs-target="#mainCarousel"
										data-bs-slide-to="{{ $key }}"
										class="{{ $key == 0 ? 'active' : '' }}"
										aria-current="{{ $key == 0 ? 'true' : 'false' }}"
										aria-label="Slide {{ $key + 1 }}">
									</button>
								@endforeach
							</div>

							<!-- Slides -->
							<div class="carousel-inner">
								@foreach($vivah_mitra_app_sliders as $key => $item)
									<div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
										<img src="{{ static_asset($item->image) }}" class="d-block w-100" alt="Slide {{ $key + 1 }}">
									</div>
								@endforeach
							</div>

							<!-- Controls -->
							<button class="carousel-control-prev" type="button" data-bs-target="#mainCarousel" data-bs-slide="prev">
								<span class="carousel-control-prev-icon"></span>
							</button>

							<button class="carousel-control-next" type="button" data-bs-target="#mainCarousel" data-bs-slide="next">
								<span class="carousel-control-next-icon"></span>
							</button>

						</div>
						@endif
        <div class="content-inner pt-0">
			<div class="container fb">
                <!-- Search -->
                 

                <!-- Dashboard Area -->
                <div class="dashboard-area m-b30">

					

					<!-- Features -->
                    <div class="features-box  mt-3">
						<div class="row mb-2">
							<div class="col text-center">
								<h2 class="fw-bold">विवाह मित्र सेवाएं</h2>
								{{--<p class="text-muted">हमारी प्रमुख श्रेणियाँ</p>--}}
							</div>
						</div>
                        <div class="row g-4 wedding-wrapper">

							@foreach($vivah_mitra_categories as $item)
								<div class="col-6 col-md-4">

									<a href="{{ url('member/category-view/'.$item->slug) }}" class="wedding-link">

										<div class="wedding-tile">

											<div class="tile-icon">
												<img src="{{ static_asset($item->image) }}" alt="">
											</div>

											<h6 class="tile-title">
												{{ $item->name }}
											</h6>

										</div>

									</a>

								</div>
							@endforeach

						</div>


                    </div>
					
					@if(count($employee_districts)>0)
						<div class="row mb-2">
							<div class="col text-center">
								<h2 class="fw-bold">Allotted District </h2>
							</div>
						</div>
						
						<div class="row mb-2">
							@foreach($employee_districts as $val)
								<div class="col-md-6 mb-4">
									<div class="district-card">
										<div class="card-icon">
											<i class="fas fa-map-marker-alt"></i>
										</div>
										<div class="card-content">
											<h5 class="district-name">{{ $val->district_name }}</h5>
										</div>
										<a href="{{ url('member/show-data-for-employee/'.$val->district_id) }}" class="view-btn">
											View
										</a>
									</div>
								</div>
							@endforeach

						</div>
					@endif
					
					@if(count($employee_allotted_shops)>0)

    <!-- Allotted Shop Section -->
    <div class="shop-section mt-4">

        <!-- Heading -->
        <div class="section-heading text-center mb-4">
            <h3 class="fw-bold mb-1">🏬 Allotted Shops</h3>
            <p class="text-muted small mb-0">
                Shops assigned to employee
            </p>
        </div>

        <!-- Shop List -->
        <div class="row">
            @foreach($employee_allotted_shops as $val)

				<div class="col-12 mb-3">
					<div class="shop-card">

						<!-- Left -->
						<div class="shop-left">
							<div class="shop-icon">
								<i class="fas fa-store"></i>
							</div>

							<div class="shop-info">
								<h5 class="shop-title">
									{{ $val->shop_name }}
								</h5>

								<span class="shop-badge">
									Allotted Shop
								</span>
							</div>
						</div>

						<!-- Right -->
						<div class="shop-right">
							<a href="javascript:void(0);" class="shop-btn">
								View
							</a>
						</div>

					</div>
				</div>

			@endforeach
		</div>

			</div>

		@endif
					
					 

					<div class="features-box  mt-3">
						<div class="row mb-2">
							<div class="col text-center">
								<h2 class="fw-bold">अन्य सेवाएँ </h2>
								{{--<p class="text-muted">हमारी प्रमुख श्रेणियाँ</p>--}}
							</div>
						</div>

						<div class="vivah-modern-wrapper">

							<!-- Fund Wallet -->
							<a href="{{ url('member/fund-wallet') }}" class="vivah-modern-card gold">
								<div class="left">
									<i class="fa fa-wallet"></i>
								</div>
								<div class="middle">
									<h6>फंड वॉलेट</h6>
									<p>Check balance instantly</p>
								</div>
								<div class="right">
									₹ {{ $vivah_mitra_fundWallet }}
								</div>
							</a>
							
							

							<!-- Recharge -->
							<a href="{{ url('member/fund-recharge') }}" class="vivah-modern-card pink">
								<div class="left">
									<i class="fa fa-bolt"></i>
								</div>
								<div class="middle">
									<h6>फंड रिचार्ज</h6>
									<p>Add money fast</p>
								</div>
								<div class="right">
									₹ 0
								</div>
							</a>

							<!-- Today Income -->
							<a href="{{ url('member/today-income') }}" class="vivah-modern-card green">
								<div class="left">
									<i class="fa fa-sack-dollar"></i>
								</div>
								<div class="middle">
									<h6>आज की कमाई</h6>
									<p>Today's earnings</p>
								</div>
								<div class="right">
									₹ {{ $todayIncome }}
								</div>
							</a>

							<!-- Total Income -->
							<a href="{{ url('member/my-income') }}" class="vivah-modern-card purple">
								<div class="left">
									<i class="fa fa-chart-line"></i>
								</div>
								<div class="middle">
									<h6 class="text-white">कुल कमाई</h6>
									<p>Total income</p>
								</div>
								<div class="right">
									₹ {{ $vivah_mitra_ewallet }}
								</div>
							</a>

							<!-- Total Income -->
							<a href="{{ url('member/received-income') }}" class="vivah-modern-card purple22">
								<div class="left">
									<i class="fa fa-chart-line"></i>
								</div>
								<div class="middle">
									<h6 class="text-white">बैंक खाते में कुल प्राप्त राशि</h6>
									<p>Total Received in Bank Account</p>
								</div>
								<div class="right">
									₹ {{ $totalReceivedInBank }}
								</div>
							</a>
						@if($vivah_mitra_details->user_type_id==5)
							<!-- Total Income -->
							<a href="{{ url('member/incentive-district-wise') }}" class="vivah-modern-card purple22">
								<div class="left">
									<i class="fa fa-chart-line"></i>
								</div>
								<div class="middle">
									<h6 class="text-white">इंसेंटिव डिस्ट्रिक्ट वाइज़ </h6>
									<p>Incentive District Wise</p>
								</div>
								<div class="right">
									₹ {{ $totalReceivedInBank }}
								</div>
							</a>
							
							<!-- Total Income -->
							<a href="{{ url('member/employee-target') }}" class="vivah-modern-card pink">
								<div class="left">
									<i class="fa fa-chart-line"></i>
								</div>
								<div class="middle">
									<h6 class="text-white">टारगेट  </h6>
									<p>Check Your Target</p>
								</div>
								<div class="right">
									 
								</div>
							</a>
							
							<!-- Total Income -->
							<a href="{{ url('member/important-work') }}" class="vivah-modern-card pink">
								<div class="left">
									<i class="fa fa-chart-line"></i>
								</div>
								<div class="middle">
									<h6 class="text-white"> इंपॉर्टेंट कार्य  </h6>
									<p>Important Work</p>
								</div>
								<div class="right">
									 
								</div>
							</a>
							<a href="{{ url('member/pending-kit-received') }}" class="vivah-modern-card pink">
								<div class="left">
									<i class="fa fa-chart-line"></i>
								</div>
								<div class="middle">
									<h6 class="text-white">कीट रिसीव्ड </h6>
									<p>Check Kit Received</p>
								</div>
								<div class="right">
									 
								</div>
							</a>
							
							
						@endif
						
						<a href="{{ url('member/pending-card-received') }}" class="vivah-modern-card pink">
							<div class="left">
								<i class="fa fa-chart-line"></i>
							</div>
							<div class="middle">
								<h6 class="text-white">फिज़िकल कार्ड रिसीव्ड </h6>
								<p>Check Physical Received</p>
							</div>
							<div class="right">
								 
							</div>
						</a>
							

						</div>
					
						@php
							//dd($vivah_mitra_details);
						@endphp
					@if($vivah_mitra_details->user_type_id!=5)
						<div class="row mb-2">
							<div class="col text-center">
								<h2 class="fw-bold">अन्य आवेदन </h2>
							</div>
						</div>

						<div class="vivah-modern-wrapper">
							@if($vivah_mitra_details->user_designation_id==10)
								<!-- Fund Wallet -->
								<a href="{{ url('member/prakhand-vivah-mitra-aavedan') }}" class="vivah-modern-card gold">
									<div class="left">
										<i class="fa fa-user"></i> 
									</div>
									<div class="middle">
										<h6>प्रखण्ड विवाह मित्र आवेदन </h6>
										<p>Apply District Vivah Mitra</p>
									</div>
								</a>
							@endif
							@if($vivah_mitra_details->user_designation_id==9)
								<a href="{{ url('member/prakhand-vivah-mitra-aavedan') }}" class="vivah-modern-card gold">
									<div class="left">
										<i class="fa fa-user"></i> 
									</div>
									<div class="middle">
										<h6>पंचायत विवाह मित्र आवेदन </h6>
										<p>Apply Panchayat Vivah Mitra</p>
									</div>
								</a>
							@endif
							@if($vivah_mitra_details->user_designation_id==8)
								<!-- Recharge -->
								<a href="{{ url('member/vivah-mitra-aavedan') }}" class="vivah-modern-card pink">
									<div class="left">
										<i class="fa fa-user"></i> 
									</div>
									<div class="middle">
										<h6>विवाह मित्र आवेदन</h6>
										<p>Apply Vivah Mitra</p>
									</div>
									 
								</a>
							@endif
							
							
								<!-- Recharge -->
								<a href="{{ url('member/apply-home-meeting') }}" class="vivah-modern-card pink">
									<div class="left">
										<i class="fa fa-home"></i> 
									</div>
									<div class="middle">
										<h6>होम मीटिंग  </h6>
										<p>Apply Home Meeting</p>
									</div>
									 
								</a>
							 

							<!-- Today Income -->
							<a href="{{ url('member/seminar-guest-meet') }}" class="vivah-modern-card green">
								<div class="left">
									<i class="fa fa-microphone"></i>
								</div>
								<div class="middle">
									<h6>सेमिनार/गेस्ट मीटिंग</h6>
									<p>Apply Seminar Guest Meeting</p>
								</div>
							</a>

							<!-- Total Income -->
							<a href="{{ url('member/apply-trainer-meet') }}" class="vivah-modern-card purple">
								<div class="left">
									<i class="fa fa-briefcase"></i>
								</div>
								<div class="middle">
									<h6 class="text-white">ट्रैनर मीटिंग </h6>
									<p>Apply Trainer Meeting</p>
								</div>
							</a>

							 

						</div>
					@endif
                        <div class="row m-b20 g-3">

							<!-- Income Sources -->
							<div class="col-6">
								<div class="app-card wallet-card">
									<div class="top-section">
										<div class="icon-box">
											<i class="fas fa-wallet"></i>
										</div>
										<!--<span class="amount">₹ 23,505</span>-->
									</div>
									<h6>आय के श्रोत </h6>
									<p>Income Source</p>
									<a href="{{ url('member/income-sources') }}" class="visit-btn">View</a>
								</div>
							</div>

							<!-- Aavedan -->
							<div class="col-6">
								<div class="app-card recharge-card">
									<div class="top-section">
										<div class="icon-box">
											<i class="fas fa-bolt"></i>
										</div>
										<!--<span class="amount">₹ 0</span>-->
									</div>
									<h6>आवेदन </h6>
									<p>Apply Here</p>
									<a href="{{ url('member/all-application-apply') }}" class="visit-btn">View</a>
								</div>
							</div>
							
							<!-- Aavedan -->
							<div class="col-6">
								<div class="app-card work-details">
									<div class="top-section">
										<div class="icon-box">
											<i class="fas fa-bolt"></i>
										</div>
										<!--<span class="amount">₹ 0</span>-->
									</div>
									<h6>कार्य विवरण </h6>
									<p>Work Details</p>
									<a href="{{ url('member/work-details') }}" class="visit-btn">View</a>
								</div>
							</div>
							
							<!-- Aavedan -->
							<div class="col-6">
								<div class="app-card transfer-card">
									<div class="top-section">
										<div class="icon-box">
											<i class="fas fa-bolt"></i>
										</div>
										<!--<span class="amount">₹ 0</span>-->
									</div>
									<h6>ट्रांसफ़र  </h6>
									<p>All types of Transfer</p>
									<a href="{{ url('member/all-types-of-transfer') }}" class="visit-btn">View</a>
								</div>
							</div>
							
							<!-- Training Video -->
							<div class="col-6">
								<div class="app-card training-video">
									<div class="top-section">
										<div class="icon-box">
											<i class="fas fa-bolt"></i>
										</div>
										{{--<span class="amount">₹ 0</span>--}}
									</div>
									<h6>प्रशिक्षण विडिओ</h6>
									<p>Training Video</p>
									<a href="{{ url('member/training-video') }}" class="visit-btn">View</a>
								</div>
							</div>
							
							<!-- Photo Gallery -->
							<div class="col-6">
								<div class="app-card photo-gallery">
									<div class="top-section">
										<div class="icon-box">
											<i class="fas fa-bolt"></i>
										</div>
										{{--<span class="amount">₹ 0</span>--}}
									</div>
									<h6>फोटो गैलरी </h6>
									<p>Photo Gallery</p>
									<a href="{{ url('member/photo-gallery') }}" class="visit-btn">View</a>
								</div>
							</div>
							
							<!-- Photo Gallery -->
							<div class="col-6">
								<div class="app-card district-vm-aay">
									<div class="top-section">
										<div class="icon-box">
											<i class="fas fa-bolt"></i>
										</div>
										<!--<span class="amount">₹ 0</span>-->
									</div>
									<h6>जिला विवाह मित्र आय </h6>
									<p> District VM Income </p>
									<a href="{{ url('member/prakhand-vivah-mitra-se-income') }}" class="visit-btn">View</a>
								</div>
							</div>
							
							<!-- Photo Gallery -->
							<div class="col-6">
								<div class="app-card others-card">
									<div class="top-section">
										<div class="icon-box">
											<i class="fas fa-bolt"></i>
										</div>
										<!--<span class="amount">₹ 0</span>-->
									</div>
									<h6>अन्य विवरण   </h6>
									<p> Other Details </p>
									<a href="{{ url('member/other-details') }}" class="visit-btn">View</a>
								</div>
							</div>
		
						 
							
						</div>
						
					 
					</div>
					<!-- Features End -->
					 
				</div>
			</div>
		</div>

    </div>
    <!-- Page Content End-->

    @include('vivah_mitra.includes.home_footer_menu')

    @endsection
