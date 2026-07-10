@extends('vivah_mitra.layouts.master')
@section('title') कीट & ट्रैनिंग चार्ज @endsection

@section('meta_tags')

@endsection
@section('content')
<style>


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
                        <h5 class="mb-0"> कीट & ट्रैनिंग चार्ज </h5>
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
			<div class="container fb">
                <!-- Search -->
                 

                <!-- Dashboard Area -->
                <div class="dashboard-area m-b30">

					 

					<!-- Features -->
                     

					<div class="features-box  mt-3 mb-3">
						
                        <div class="row m-b20 g-3">

							@if($vivah_mitra_details->user_designation_id==10) 
								@php
									$kitcharge = 8100;
								@endphp
								<!-- Jila Mitra -->
								<div class="vivah-modern-wrapper">
									<a href="javascript:void(0);" class="vivah-modern-card gold">
										<div class="left">
											<i class="fa fa-wallet"></i>
										</div>
										<div class="middle">
											<h6>कीट & ट्रैनिंग चार्ज</h6>
											<p>Kit & Training Charge</p>
										</div>
										<div class="right">
											₹ {{ $kitcharge }}
										</div>
									</a>
									@if(count($get_transaction)>0)
										<div class="table-responsive"> 
											<table class="table table-bordered">
												<thead>
													<tr>
														<th>Sl.</th>
														<th>Date</th>
														<th>Deduct Amount</th>
													</tr>
												</thead>
												@php
													$total = 0;
												@endphp
												@foreach($get_transaction as $key => $val)
												<tr>
													<td>{{ $key+1 }}</td>
													<td>{{ date('d M, Y', strtotime($val->created_at)) }}</td>
													<td>₹&nbsp;{{ $val->commission }}</td>
												</tr>
												@php
													$total = $total+$val->commission;
												@endphp
												@endforeach
												<tr>
													<td></td>
													<td>Total</td>
													<td>₹&nbsp;{{ $total }}</td>
												</tr>
											</table>
										</div>
									
									
									<a href="{{ url('member/today-income') }}" class="vivah-modern-card green">
										<div class="left">
											<i class="fa fa-sack-dollar"></i>
										</div>
										<div class="middle">
											<h6>बकाया किट चार्ज </h6>
											<p>Dues Kit Charge </p>
										</div>
										<div class="right">
											₹ {{ $kitcharge-$total }}
										</div>
									</a>
									@endif
									
									
								</div>
							@endif
							
							@if($vivah_mitra_details->user_designation_id==9) 
								<!-- Prakhand Mitra -->
								<div class="vivah-modern-wrapper">
									<a href="javascript:void(0);" class="vivah-modern-card gold">
										<div class="left">
											<i class="fa fa-wallet"></i>
										</div>
										<div class="middle">
											<h6>कीट & ट्रैनिंग चार्ज</h6>
											<p>Kit & Training Charge</p>
										</div>
										<div class="right">
											₹ 7100.00
										</div>
									</a>
								</div>
							@endif
							
							@if($vivah_mitra_details->user_designation_id==8) 
								<!-- Panchayat Mitra -->
								<div class="vivah-modern-wrapper">
									<a href="javascript:void(0);" class="vivah-modern-card gold">
										<div class="left">
											<i class="fa fa-wallet"></i>
										</div>
										<div class="middle">
											<h6>कीट & ट्रैनिंग चार्ज</h6>
											<p>Kit & Training Charge</p>
										</div>
										<div class="right">
											₹ 6100.00
										</div>
									</a>
								</div>
							@endif
							
							@if($vivah_mitra_details->user_designation_id==7) 
								<!-- Vivah Mitra -->
								<div class="vivah-modern-wrapper">
									<a href="javascript:void(0);" class="vivah-modern-card gold">
										<div class="left">
											<i class="fa fa-wallet"></i>
										</div>
										<div class="middle">
											<h6>कीट & ट्रैनिंग चार्ज</h6>
											<p>Kit & Training Charge</p>
										</div>
										<div class="right">
											₹ 2100.00
										</div>
									</a>
								</div>
							@endif
							
							 
							
							
							
							 
							 


							 
							</br>
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
