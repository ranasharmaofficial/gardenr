@extends('vivah_mitra.layouts.master')
@section('title') जिला विवाह मित्र आवेदन @endsection

@section('meta_tags')

@endsection
@section('content')
	<style >
	  .card-wrapper {
        max-width: 420px;
        margin: auto;
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .rank-card {
        display: flex;
        align-items: center;
        padding: 16px;
        border-radius: 16px;
        color: #fff;
        position: relative;
        box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    }

     

    .rank-card.blue {
    background: linear-gradient(135deg, #5fa8ff, #6dd5ed);
	}

	.rank-card.pink {
		background: linear-gradient(135deg, #ff5f9e, #ff8fb1);
	}

	.rank-card.purple {
		background: linear-gradient(135deg, #9d6cff, #c77dff);
	}

	.rank-card.orange {
		background: linear-gradient(135deg, #ff9f43, #ffbe76);
	}

	.avatar {
		width: 56px;
		height: 56px;
		border-radius: 50%;
		background: rgba(255,255,255,0.25);
		display: flex;
		align-items: center;
		justify-content: center;
		margin-right: 14px;
		overflow: hidden;
	}

	.avatar img {
		width: 34px;
		height: 34px;
		border-radius: 50%;
		object-fit: cover;
	}

	.avatar-text {
		font-size: 22px;
		font-weight: 700;
		color: #fff;
		text-transform: uppercase;
	}

    .content {
        flex: 1;
    }

    .content h3 {
        font-size: 16px;
        font-weight: 600;
    }

    .content p {
        font-size: 13px;
        opacity: 0.9;
        margin-top: 2px;
    }

    .stats {
        display: flex;
        gap: 16px;
        margin-top: 10px;
        font-size: 12px;
    }

    .stats div {
        text-align: center;
    }

    .stats span {
        display: block;
        font-weight: bold;
        font-size: 13px;
    }

    .rank {
        text-align: center;
        font-size: 14px;
        font-weight: bold;
        opacity: 0.95;
    }

    .rank span {
        display: block;
        font-size: 24px;
        font-weight: 700;
    }

    .menu {
        position: absolute;
        top: 12px;
        right: 12px;
        font-size: 18px;
        opacity: 0.8;
        cursor: pointer;
    }
	 
	</style >
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
                        <h5 class="mb-0"> जिला विवाह मित्र लिस्ट </h5>
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
    <div class="page-content">

        <div class="content-inner pt-0">
			<div style="margin-top: 15px;" class="container fb">
                 
                <div class="dashboard-area m-b30">
					<!-- Features -->
						<div class="card-wrapper">
						
						@php
							$colors = ['blue', 'pink', 'purple', 'orange'];
						@endphp

						@foreach($jila_vivah_mitra_list as $index => $val)
							<div class="rank-card {{ $colors[$index % count($colors)] }}">
								<div class="menu">⋮</div>

								<div class="avatar">
									@if(!empty($val->profile_image) && file_exists(public_path($val->profile_image)))
										<img src="{{ asset($val->profile_image) }}" alt="{{ $val->first_name }}">
									@else
										<span class="avatar-text">
											{{ strtoupper(substr($val->first_name, 0, 1)) }}
										</span>
									@endif
								</div>

								<div class="content">
									<h3>{{ $val->first_name }}</h3>
									<p>Code: {{ $val->employee_code }}</p>

									<div class="stats">
										<div><span>0</span>Vivah Mitra</div>
										<div><span>0</span>Physical Card</div>
										<div><span>0</span>Digital Card</div>
									</div>
								</div>
							</div>
						@endforeach

     

</div>
						
                    
					<!-- Features End -->

					 

				</div>
			</div>
		</div>

    </div>
    <!-- Page Content End-->
	<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<script>

	 

</script>

    @include('vivah_mitra.includes.home_footer_menu')

    @endsection
