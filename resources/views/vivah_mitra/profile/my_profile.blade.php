@extends('vivah_mitra.layouts.master')
@section('title') My Profile @endsection

@section('meta_tags')

@endsection
@section('content')
	<style >
	.features-box {
		background: #fff;
		border-radius: 14px;
		padding: 5px;
		box-shadow: 0 6px 14px rgba(0,0,0,0.08);
		transition: 0.3s;
		text-align: center;
	}
	
	.profile-card-section{
    padding:16px;
}

.profile-card{
    background:#fff;
    border-radius:22px;
    box-shadow:0 12px 30px rgba(0,0,0,0.08);
    overflow:hidden;
}

/* Top gradient */
.profile-top{
    background:linear-gradient(135deg,#7b4cc9,#8f6be0);
    height:90px;
    position:relative;
}

/* Avatar */
.profile-avatar{
    width:110px;
    height:110px;
    border-radius:50%;
    object-fit:cover;
    border:5px solid #fff;
    position:absolute;
    left:50%;
    bottom:-55px;
    transform:translateX(-50%);
    background:#fff;
}

/* Body */
.profile-body{
    padding:70px 20px 22px;
}

.profile-name{
    font-weight:600;
    margin-bottom:6px;
}

/* Designation badge */
.designation-badge{
    display:inline-block;
    background:#eae3ff;
    color:#6a3dd9;
    padding:4px 12px;
    border-radius:20px;
    font-size:13px;
    margin-bottom:18px;
}

/* Info rows */
.profile-info{
    margin-bottom:18px;
}

.info-row{
    display:flex;
    justify-content:space-between;
    padding:10px 14px;
    border-radius:12px;
    background:#f6f7fb;
    margin-bottom:10px;
    font-size:14px;
}

.info-label{
    color:#666;
}

.info-value{
    font-weight:500;
    color:#111;
}

/* Actions */
.profile-actions{
    text-align:center;
}
	
	.profile-area {
		margin-top: -112px !important;
		margin-bottom: 30px !important;
	}
	
	 
	</style>

   <!-- Header -->
    <header class="header">
        <div class="main-bar">
            <div class="container">
                <div class="header-content">
                    <div class="left-content">
                        <a href="javascript:void(0);" class="back-btn">
                            <svg width="18" height="18" viewbox="0 0 10 16" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M9.03033 0.46967C9.2966 0.735936 9.3208 1.1526 9.10295 1.44621L9.03033 1.53033L2.561 8L9.03033 14.4697C9.2966 14.7359 9.3208 15.1526 9.10295 15.4462L9.03033 15.5303C8.76406 15.7966 8.3474 15.8208 8.05379 15.6029L7.96967 15.5303L0.96967 8.53033C0.703403 8.26406 0.679197 7.8474 0.897052 7.55379L0.96967 7.46967L7.96967 0.46967C8.26256 0.176777 8.73744 0.176777 9.03033 0.46967Z" fill="#a19fa8"></path>
							</svg>
                        </a>
                    </div>
                    <div class="mid-content">
                        <h5 class="mb-0">My Profile</h5>
                    </div>
                    <div class="right-content">
                        <a href="javascript:void(0);" class="menu-toggler">
							<svg width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path opacity="0.4" d="M16.0755 2H19.4615C20.8637 2 22 3.14585 22 4.55996V7.97452C22 9.38864 20.8637 10.5345 19.4615 10.5345H16.0755C14.6732 10.5345 13.537 9.38864 13.537 7.97452V4.55996C13.537 3.14585 14.6732 2 16.0755 2Z" fill="#a19fa8"></path>
								<path fill-rule="evenodd" clip-rule="evenodd" d="M4.53852 2H7.92449C9.32676 2 10.463 3.14585 10.463 4.55996V7.97452C10.463 9.38864 9.32676 10.5345 7.92449 10.5345H4.53852C3.13626 10.5345 2 9.38864 2 7.97452V4.55996C2 3.14585 3.13626 2 4.53852 2ZM4.53852 13.4655H7.92449C9.32676 13.4655 10.463 14.6114 10.463 16.0255V19.44C10.463 20.8532 9.32676 22 7.92449 22H4.53852C3.13626 22 2 20.8532 2 19.44V16.0255C2 14.6114 3.13626 13.4655 4.53852 13.4655ZM19.4615 13.4655H16.0755C14.6732 13.4655 13.537 14.6114 13.537 16.0255V19.44C13.537 20.8532 14.6732 22 16.0755 22H19.4615C20.8637 22 22 20.8532 22 19.44V16.0255C22 14.6114 20.8637 13.4655 19.4615 13.4655Z" fill="#a19fa8"></path>
							</svg>
						</a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Header End -->

     @include('vivah_mitra.includes.sidebar')

    <!-- Page Content -->
    <div class="page-content bottom-content ">
        <div class="dz-banner-heading">
            <div class="overlay-black-light">
                <img src="{{ static_asset('assets/assets_vivah_mitra/images/bg2.png') }}" class="bnr-img" alt="">
            </div>
        </div>
        <div class="container profile-area">
			{{--<div class="profile">
                <div class="media media-100">
                    <img src="{{ static_asset('assets/assets_vivah_mitra/images/author/pic1.png') }}" alt="{{ $vivah_mitra_details->first_name }}">    
                </div>
                <div class="mb-2">
                    <h4 class="mb-0">{{ $vivah_mitra_details->first_name }}</h4>
					
                     
                    <p><span class="detail">{{ $vivah_mitra_details->employee_code }}</span></p>
                </div>
            </div>--}}
			
			<section class="profile-card-section">
				<div class="profile-card">

					<div class="profile-top">
						<img src="{{ static_asset($vivah_mitra_details->profile_pic) }}" class="profile-avatar" alt="Profile">
					</div>

					@php	
						$designationName = \App\Models\MasterDesignation::where('id', $vivah_mitra_details->user_designation_id)->value('name');
					@endphp

					<div class="profile-body text-center">
						<h4 class="profile-name">{{ $vivah_mitra_details->first_name }}</h4>

						<span class="designation-badge">
							{{ $designationName }}
						</span>

						<div class="profile-info">
							<div class="info-row">
								<span class="info-label">Employee Code</span>
								<span class="info-value">{{ $vivah_mitra_details->employee_code }}</span>
							</div>

							<div class="info-row">
								<span class="info-label">Mobile</span>
								<span class="info-value">{{ $vivah_mitra_details->mobile }}</span>
							</div>
						</div>

						<div class="profile-actions">
							<a href="{{ url('member/edit-profile') }}" class="btn btn-primary btn-sm">Edit Profile</a>
						</div>
					</div>

				</div>
			</section>

             
             
             
        </div>
    </div>
    <!-- Page Content End-->
	
 


    <!-- Page Content End-->
	<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
	 

    @include('vivah_mitra.includes.home_footer_menu')

    @endsection
