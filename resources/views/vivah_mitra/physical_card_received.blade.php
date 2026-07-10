@extends('vivah_mitra.layouts.master')
@section('title') Physical Card Received @endsection

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
	
	.stat-card {
            border-radius: 12px;
            padding: 20px;
            color: #fff;
            position: relative;
            overflow: hidden;
            transition: 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .stat-icon {
            font-size: 40px;
            opacity: 0.3;
            position: absolute;
            right: 20px;
            bottom: 10px;
        }

        .stat-title {
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 8px;
            opacity: 0.9;
        }

        .stat-value {
            font-size: 28px;
            font-weight: 700;
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
                        <h5 class="mb-0">Physical Card Received </h5>
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
                 
                <div class="dashboard-area m-b30">
					<!-- Features -->
                    <div class="features-box  mt-3">
						<div class="row m-b20 g-3 justify-content-center">
							<div class="col-md-4">
								<div class="stat-card" style="background: linear-gradient(45deg,#4e73df,#224abe);">
									<div class="stat-title">Available Physical Card</div>
									<div class="stat-value">{{ $userStock->quantity ?? 0 }}</div>
									<i class="fas fa-id-card stat-icon"></i>
								</div>
							</div>
							<div class="container">
								<div class="table-responsive">
									<table class="table table-bordered">
										<thead>
											<tr>
												<th>Sl.</th>
												<th>Sent By</th>
												<th>Received By</th>
												<th>Type</th>
												<th>Note</th>
												<th>Quantity</th>
												<th>Date</th>
											</tr>
										</thead>
										<tbody>
											@php
												$total = 0;
											@endphp
											@foreach($transactions as $key => $val)
												<tr>
													<td style="vertical-align:middle;">{{ $key+1 }}</td>
													<td style="vertical-align:middle;">		
														@if($val->from_user_id!=null)
															@php
																$fromUserName = \App\Models\User::where('id', $val->from_user_id)->first();
															@endphp
															{{ $fromUserName->first_name }} - {{ $fromUserName->employee_code }}
														@else
															COMPANY
														@endif
														 
													</td>
													<td style="vertical-align:middle;">		
														@if($val->to_user_id!=null)
															@php
																$fromUserName = \App\Models\User::where('id', $val->to_user_id)->first();
															@endphp
															{{ $fromUserName->first_name }} - {{ $fromUserName->employee_code }}
														@else
															COMPANY
														@endif
														 
													</td>
													<td style="vertical-align:middle;">		
														<span style="text-transform:uppercase;" class="badge bg-success">{{ $val->type }}</span>
													</td>
													<td style="vertical-align:middle;">{{ $val->note }}</td>
													<td style="vertical-align:middle;">{{ $val->quantity }}</td>
													<td style="vertical-align:middle;">{{ $val->created_at->format('d-M-Y') }}</td>
												</tr>
											@php
												$total = $total+$val->quantity;
											@endphp
											@endforeach
											
											@if(false)
											<tr>
												<td style="text-align:right !important;" colspan="4"><b>Total&nbsp;:</b>{{ number_format($total, 2) }}</td>
											</tr>
											@endif
										</tbody>
									</table>
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
	<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
	<script>

		 
	</script>

    @include('vivah_mitra.includes.home_footer_menu')

    @endsection
