@extends('vivah_mitra.layouts.master')
@section('title') आज कि कमाई @endsection

@section('meta_tags')

@endsection
@section('content')
	<style>
		.features-box {
			background: #fff;
			border-radius: 14px;
			padding: 5px;
			box-shadow: 0 6px 14px rgba(0, 0, 0, 0.08);
			transition: 0.3s;
			text-align: center;
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
								<path
									d="M9.03033 0.46967C9.2966 0.735936 9.3208 1.1526 9.10295 1.44621L9.03033 1.53033L2.561 8L9.03033 14.4697C9.2966 14.7359 9.3208 15.1526 9.10295 15.4462L9.03033 15.5303C8.76406 15.7966 8.3474 15.8208 8.05379 15.6029L7.96967 15.5303L0.96967 8.53033C0.703403 8.26406 0.679197 7.8474 0.897052 7.55379L0.96967 7.46967L7.96967 0.46967C8.26256 0.176777 8.73744 0.176777 9.03033 0.46967Z"
									fill="#a19fa8"></path>
							</svg>
						</a>
					</div>
					<div class="mid-content">
						<h5 class="mb-0">आज कि कमाई </h5>
					</div>
					<div class="right-content">
						<a href="javascript:void(0);" class="menu-toggler">
							<svg width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path opacity="0.4"
									d="M16.0755 2H19.4615C20.8637 2 22 3.14585 22 4.55996V7.97452C22 9.38864 20.8637 10.5345 19.4615 10.5345H16.0755C14.6732 10.5345 13.537 9.38864 13.537 7.97452V4.55996C13.537 3.14585 14.6732 2 16.0755 2Z"
									fill="#a19fa8"></path>
								<path fill-rule="evenodd" clip-rule="evenodd"
									d="M4.53852 2H7.92449C9.32676 2 10.463 3.14585 10.463 4.55996V7.97452C10.463 9.38864 9.32676 10.5345 7.92449 10.5345H4.53852C3.13626 10.5345 2 9.38864 2 7.97452V4.55996C2 3.14585 3.13626 2 4.53852 2ZM4.53852 13.4655H7.92449C9.32676 13.4655 10.463 14.6114 10.463 16.0255V19.44C10.463 20.8532 9.32676 22 7.92449 22H4.53852C3.13626 22 2 20.8532 2 19.44V16.0255C2 14.6114 3.13626 13.4655 4.53852 13.4655ZM19.4615 13.4655H16.0755C14.6732 13.4655 13.537 14.6114 13.537 16.0255V19.44C13.537 20.8532 14.6732 22 16.0755 22H19.4615C20.8637 22 22 20.8532 22 19.44V16.0255C22 14.6114 20.8637 13.4655 19.4615 13.4655Z"
									fill="#a19fa8"></path>
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

		@php
			$designation = $designation ?? '';
		@endphp
		<div class="content-inner pt-0">
			<div class="container fb">


				<div class="dashboard-area m-b30">
					<!-- Features -->
					<div class="features-box  mt-3">
						<div class="row m-b20 g-3">
							<div class="container">
								{{-- <div class="table-responsive">
									<table class="table table-bordered">
										<thead>
											<tr>
												<th>Sl.</th>
												<th>Type</th>
												<th>Income of Sources</th>
												<th>Amount</th>
												<th>Date</th>
											</tr>
										</thead>
										<tbody>
											@php
											$total = 0;
											@endphp
											@foreach($todayIncome as $key => $val)
											<tr>
												<td style="vertical-align:middle;">{{ $key+1 }}</td>
												<td style="vertical-align:middle;">
													@if($val->type == 'credit')
													<span class="badge bg-success">Credit</span>
													@else
													<span class="badge bg-danger">Debit</span>
													@endif
												</td>
												<td style="vertical-align:middle;">{{ $val->remarks }}</td>
												<td style="vertical-align:middle;">₹&nbsp;{{ number_format($val->amount, 2)
													}}</td>
												<td style="vertical-align:middle;">{{ $val->created_at->format('d-M-Y') }}
												</td>
											</tr>
											@php
											$total = $total+$val->amount;
											@endphp
											@endforeach

											<tr>
												<td style="text-align:right !important;" colspan="4">
													<b>Total&nbsp;:&nbsp;₹&nbsp;</b>{{ number_format($total, 2) }}
												</td>
											</tr>
										</tbody>
									</table>
								</div>
								--}}

								<div class="table-responsive">
								@if($vivah_mitra_details->user_designation_id == 7)
									<h6 class="text-success mt-3 mb-3">विवाह मित्र आय सूची</h6>

									<table class="table table-bordered">
										<thead>
											<tr>
												<th>Sl.</th>
												<th>Type</th>
												<th>Income of Sources</th>
												<th>Amount</th>
												<th>Date</th>
											</tr>
										</thead>
										<tbody>

											<tr>
												<td>1</td>
												<td><span class="badge bg-success">Credit</span></td>
												<td>स्वागत आवेदन बोनस</td>
												<td>₹ {{ $today_welcome_income }}</td>
											</tr>

											<tr>
												<td>2</td>
												<td><span class="badge bg-success">Credit</span></td>
												<td>ग्रुप ऑन बोर्डिंग बोनस</td>
												<td>₹ 51.00</td>
											</tr>

											<tr>
												<td>3</td>
												<td><span class="badge bg-success">Credit</span></td>
												<td>ग्रुप बिल्डिंग आय</td>
												<td>₹ 50.00</td>
											</tr>

											<tr>
												<td>4</td>
												<td><span class="badge bg-success">Credit</span></td>
												<td>डिजिटल आय</td>
												<td>₹ {{ $today_digital_card_income }}</td>
											</tr>

											<tr>
												<td>5</td>
												<td><span class="badge bg-success">Credit</span></td>
												<td>फिजिकल कार्ड आय</td>
												<td>₹ {{ $today_physical_card_income }}</td>
											</tr>

											<tr>
												<td>6</td>
												<td><span class="badge bg-success">Credit</span></td>
												<td>शादी पैकेज बुकिंग आय</td>
												<td>₹ 501.00</td>
											</tr>

											<tr>
												<td>7</td>
												<td><span class="badge bg-success">Credit</span></td>
												<td>शादी पैकेज बिक्री आय (3%)</td>
												<td>₹ 300.00</td>
											</tr>

											<tr>
												<td>8</td>
												<td><span class="badge bg-success">Credit</span></td>
												<td>उत्पाद बिक्री आय (3%)</td>
												<td>₹ 200.00</td>
											</tr>

											<tr>
												<td>9</td>
												<td><span class="badge bg-success">Credit</span></td>
												<td>टूर / तीर्थयात्रा आय</td>
												<td>₹ 1000.00</td>
											</tr>

											<tr>
												<td>10</td>
												<td><span class="badge bg-success">Credit</span></td>
												<td>रिचार्ज / डिजिटल सेवा आय (20%)</td>
												<td>₹ 400.00</td>
											</tr>

											<tr>
												<td>11</td>
												<td><span class="badge bg-success">Credit</span></td>
												<td>ट्रेनर आय</td>
												<td>₹ 8000.00</td>
											</tr>

											<tr>
												<td>12</td>
												<td><span class="badge bg-success">Credit</span></td>
												<td>मासिक स्टार बोनस</td>
												<td>₹ 5000.00</td>
											</tr>

											<tr>
												<td>13</td>
												<td><span class="badge bg-success">Credit</span></td>
												<td>पद सम्मान वेतन पुरस्कार</td>
												<td>₹ 7000.00</td>
											</tr>

											<tr>
												<td>14</td>
												<td><span class="badge bg-success">Credit</span></td>
												<td>पद विजय पुरस्कार</td>
												<td>₹ 3000.00</td>
											</tr>

											<tr>
												<td>15</td>
												<td><span class="badge bg-success">Credit</span></td>
												<td>कन्या बचत आय</td>
												<td>₹ 2500.00</td>
											</tr>

											<tr>
												<td>16</td>
												<td><span class="badge bg-success">Credit</span></td>
												<td>इनवेस्टर आय</td>
												<td>₹ 6000.00</td>
											</tr>

											<tr>
												<td>17</td>
												<td><span class="badge bg-success">Credit</span></td>
												<td>पेट्रोल / गाड़ी आय</td>
												<td>₹ 1500.00</td>
											</tr>

											<tr>
												<td>18</td>
												<td><span class="badge bg-success">Credit</span></td>
												<td>मोबाइल रिचार्ज</td>
												<td>₹ 299.00</td>
											</tr>

											<tr>
												<td colspan="4" style="text-align:right;">
													<b>Total : ₹ 38,072.00</b>
												</td>
											</tr>

										</tbody>
									</table>

								@endif

									@if($vivah_mitra_details->user_designation_id == 8)

										<h6 class="text-success mt-3 mb-33">पंचायत विवाह मित्र आय सूची</h6>

										<table class="table table-bordered">
											<tr>
												<td>1</td>
												<td>स्वागत आवेदन बोनस</td>
												<td>₹ {{ $today_welcome_income }}</td>
											</tr>
											<tr>
												<td>2</td>
												<td>ग्रुप ऑन बोर्डिंग बोनस</td>
												<td>₹ 101</td>
											</tr>
											<tr>
												<td>3</td>
												<td>ग्रुप बिल्डिंग आय</td>
												<td>₹ 100 प्रतिदिन</td>
											</tr>
											<tr>
												<td>4</td>
												<td>डिजिटल आय</td>
												<td>₹ {{ $today_digital_card_income }}</td>
											</tr>
											<tr>
												<td>5</td>
												<td>फिजिकल कार्ड आय</td>
												<td>₹ {{ $today_physical_card_income }}</td>
											</tr>
											<tr>
												<td>6</td>
												<td>शादी पैकेज बुकिंग आय</td>
												<td>₹ 0</td>
											</tr>
											<tr>
												<td>7</td>
												<td>शादी पैकेज बिक्री आय</td>
												<td>0</td>
											</tr>
											<tr>
												<td>8</td>
												<td>उत्पाद बिक्री आय</td>
												<td>0</td>
											</tr>
											<tr>
												<td>9</td>
												<td>टूर आय</td>
												<td>0</td>
											</tr>
											<tr>
												<td>10</td>
												<td>रिचार्ज आय</td>
												<td>0</td>
											</tr>
											<tr>
												<td>11</td>
												<td>ट्रेनर आय</td>
												<td>₹ 0</td>
											</tr>
											<tr>
												<td>12 </td>
												<td>होम मीटिंग इनकम </td>
												<td>₹ {{ $today_home_meeting_income }}</td>
											</tr>
											<tr>
												<td>13 </td>
												<td>गेस्ट मीटिंग एवं सेमिनार इनकम </td>
												<td>₹ {{ $today_seminar_guest_income }}</td>
											</tr>
											<tr>
												<td>14 </td>
												<td> ट्रैनर मीटिंग आय </td>
												<td>₹ {{ $today_training_income }}</td>
											</tr>
											<tr>
												<td colspan="3" style="text-align:right;">
													<b>Total : ₹ {{ $today_home_meeting_income+$today_seminar_guest_income+$today_training_income+$today_welcome_income+$today_digital_card_income+$today_physical_card_income }}</b>
												</td>
											</tr>
										</table>

									@endif

									@if($vivah_mitra_details->user_designation_id == 9)

										<h6 class="text-success mt-3 mb-3">प्रखंड विवाह मित्र आय सूची</h6>

										<table class="table table-bordered">
											<tr>
												<td>1</td>
												<td>स्वागत आवेदन बोनस</td>
												<td>₹ {{ $today_welcome_income }}</td>
											</tr>
											<tr>
												<td>2</td>
												<td>ग्रुप ऑन बोर्डिंग बोनस</td>
												<td>₹ 0</td>
											</tr>
											<tr>
												<td>3</td>
												<td>ग्रुप बिल्डिंग आय</td>
												<td>₹ 0</td>
											</tr>
											<tr>
												<td>4</td>
												<td>डिजिटल आय</td>
												<td>₹ {{ $today_digital_card_income }}</td>
											</tr>
											<tr>
												<td>5</td>
												<td>फिजिकल कार्ड आय</td>
												<td>₹ {{ $today_physical_card_income}}</td>
											</tr>
											<tr>
												<td>6</td>
												<td>शादी पैकेज बुकिंग आय</td>
												<td>₹ 0</td>
											</tr>
											<tr>
												<td>7</td>
												<td>शादी पैकेज बिक्री आय</td>
												<td>0</td>
											</tr>
											<tr>
												<td>8</td>
												<td>उत्पाद बिक्री आय</td>
												<td>0</td>
											</tr>
											<tr>
												<td>9</td>
												<td>टूर आय</td>
												<td>0</td>
											</tr>
											<tr>
												<td>10</td>
												<td>रिचार्ज आय</td>
												<td>0</td>
											</tr>
											<tr>
												<td>11</td>
												<td>ट्रेनर आय</td>
												<td>₹ 0</td>
											</tr>
											<tr>
												<td>12 </td>
												<td>होम मीटिंग इनकम </td>
												<td>₹ {{ $today_home_meeting_income }}</td>
											</tr>
											<tr>
												<td>13 </td>
												<td>गेस्ट मीटिंग एवं सेमिनार इनकम </td>
												<td>₹ {{ $today_seminar_guest_income }}</td>
											</tr>
											<tr>
												<td>14 </td>
												<td> ट्रैनर मीटिंग आय </td>
												<td>₹ {{ $today_training_income }}</td>
											</tr>
											<tr>
												<td colspan="3" style="text-align:right;">
													<b>Total : ₹ {{ $today_home_meeting_income+$today_seminar_guest_income+$today_training_income+$today_welcome_income+$today_digital_card_income+$today_physical_card_income }}</b>
												</td>
											</tr>
										</table>

									@endif
									@if($vivah_mitra_details->user_designation_id == 10)

										<h6 class="text-success mt-3 mb-3">जिला विवाह मित्र आय सूची</h6>

										<table class="table table-bordered">
											<tr>
												<td>1</td>
												<td>स्वागत आवेदन बोनस</td>
												<td>₹ {{ $today_welcome_income }}</td>
											</tr>
											<tr>
												<td>2</td>
												<td>ग्रुप ऑन बोर्डिंग बोनस</td>
												<td>₹ 0</td>
											</tr>
											<tr>
												<td>3</td>
												<td>ग्रुप बिल्डिंग आय</td>
												<td>₹ 0</td>
											</tr>
											<tr>
												<td>4</td>
												<td>डिजिटल कार्ड आय</td>
												<td>₹ {{ $today_digital_card_income }}</td>
											</tr>
											<tr>
												<td>5</td>
												<td>फिजिकल कार्ड आय</td>
												<td>₹ {{ $today_physical_card_income }}</td>
											</tr>
											<tr>
												<td>6</td>
												<td>शादी पैकेज बुकिंग आय</td>
												<td>₹ 0</td>
											</tr>
											<tr>
												<td>7</td>
												<td>शादी पैकेज बिक्री आय</td>
												<td>0</td>
											</tr>
											<tr>
												<td>8</td>
												<td>उत्पाद बिक्री आय</td>
												<td>0</td>
											</tr>
											<tr>
												<td>9</td>
												<td>टूर आय</td>
												<td>Applicable</td>
											</tr>
											<tr>
												<td>10</td>
												<td>रिचार्ज आय</td>
												<td>0</td>
											</tr>
											<tr>
												<td>11</td>
												<td>ट्रेनर आय</td>
												<td>₹ 0</td>
											</tr>
                                            <tr>
												<td>12</td>
												<td>सैलरी  आय</td>
												<td>₹ 0</td>
											</tr>
                                            <tr>
												<td>13 </td>
												<td>कन्या बचत आय</td>
												<td>₹ 0</td>
											</tr>
                                            <tr>
												<td>14 </td>
												<td>मंथली स्टार बोनस आय</td>
												<td>₹ 0</td>
											</tr>
                                            <tr>
												<td>15 </td>
												<td>पेट्रोल / गाड़ी खर्च </td>
												<td>₹ 0</td>
											</tr>
                                            <tr>
												<td>16 </td>
												<td>इन्वेस्टर आय </td>
												<td>₹ 0</td>
											</tr>
											<tr>
												<td>17 </td>
												<td>होम मीटिंग इनकम </td>
												<td>₹ {{ $today_home_meeting_income }}</td>
											</tr>
											<tr>
												<td>18 </td>
												<td>गेस्ट मीटिंग एवं सेमिनार इनकम </td>
												<td>₹ {{ $today_seminar_guest_income }}</td>
											</tr>
											<tr>
												<td>19 </td>
												<td> ट्रैनर मीटिंग आय </td>
												<td>₹ {{ $today_training_income }}</td>
											</tr>
											<tr>
												<td colspan="3" style="text-align:right;">
													<b>Total : ₹ {{ $today_home_meeting_income+$today_seminar_guest_income+$today_training_income+$today_welcome_income+$today_digital_card_income+$today_physical_card_income }}</b>
												</td>
											</tr>
										</table>

									@endif
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
