@extends('frontend.layouts.master')
@section('title') Marksheet Verification @endsection
@section('content')
<!-- Start of Header section
  ============================================= -->
<section id="ed-breadcrumb" class="ed-breadcrumb-sec" data-background="{{ static_asset('assets/assets_web/images/header-about5.jpg') }}">
		<div class="container">
			<div class="ed-breadcrumb-content">
				<div class="ed-breadcrumb-text text-center headline ul-li">
					<h2 class="bread_title">Marksheet Verification</h2>
					<ul>
						<li><a href="{{ url('') }}">Home</a></li>
						<li>Marksheet Verification </li>
					</ul>
				</div>
			</div>
		</div>
	</section>

<!-- Start of Feature section
  ============================================= -->

<!-- Start of Contact Form section
	============================================= -->
	<section id="ed-cp-form" class="ed-cp-form-sec position-relative">
		<div class="container">
		<div class="row">
		<div class="col-lg-6">
			<div class="ed-cp-form-content  pb-155 position-relative">
				<div class="ed-cp-form position-relative">
					<div class="gt-client-review-form cp_ver mt-40">
						<h3>Marksheet Verification</h3>
						<form method="get" enctype="multipart/form-data" action="">
							@csrf
							<div class="row">
								<div class="col-md-12">
									<input type="text" name="enrollment_number" value="{{ $request->enrollment_number }}" required placeholder="Enrollment No.*">
								</div>
								<div class="col-md-12">
									 <input type="date" required value="{{ $request->dob }}" name="dob" placeholder="Date of birth *" />
								</div>


								<div class="col-md-12">
									<button>Verify Now</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			</div>
			@if($request == null)
				<div class="col-lg-6">
					<img src="{{ static_asset('assets/assets_web/images/student-login.jpg') }}">
				</div>
			@else
				@if($checkStudent)
					<div class="col-xl-6 col-lg-6">
						<div class="ed-cp-form-content  pb-155 position-relative">
							<div class="ed-cp-form position-relative">
								<div class="gt-client-review-form cp_ver mt-40">
									<h3>Student Details</h3>
									<div class="table-responsive">
								<table class="table table-bordered">
									<tr>
										<td><b>Enrollment Number</b></td>
										<td>{{ $checkStudent->enrollment_number }}</td>
									</tr>
									<tr>
										<td><b>Student Name</b></td>
										<td>{{ $checkStudent->english_name }}</td>
									</tr>
									<tr>
										<td><b>Father's Name</b></td>
										<td>{{ $checkStudent->fathers_name }}</td>
									</tr>
									<tr>
										<td><b>Course</b></td>
										<td>{{ $checkStudent->course_name }}</td>
									</tr>
									<tr>
										<td><b>Sub Course</b></td>
										<td>{{ $checkStudent->subcourse_name }}</td>
									</tr>
									<tr>
										<td><b>Result</b></td>
										<td>{{ $result_details->result }}</td>
									</tr>
									<tr>
										<td><b>Course Duration</b></td>
										<td>{{ $result_details->semester }}</td>
									</tr>
									<tr>
										<td><b>Marks Obtained</b></td>
										<td>{{ $result_details->total_marks_obtained }}</td>
									</tr>
									<tr>
										<td><b>Percentage</b></td>
										<td>{{ $result_details->total_percentage }}</td>
									</tr>
									<tr>
										<td><b>Issue Date</b></td>
										<td>{{ date('d M, Y', strtotime($result_details->issue_date)) }}</td>
									</tr>
									<tr>
										<td><b>Remarks</b></td>
										<td>{{ $result_details->remarks }}</td>
									</tr>
								</table>
							</div>
								</div>
							</div>
						</div>
						
					</div>
				@endif
				@if($request->has('enrollment_number') && $request->has('dob') && $flag == 0 && !$checkStudent)
					<div class="col-xl-6 col-lg-6">
						<div class="ed-cp-form-content  pb-155 position-relative">
							<div class="ed-cp-form position-relative">
								<div class="gt-client-review-form cp_ver mt-40">
									<h3>Marksheet Verification</h3>
									<div class="table-responsive">
										<table class="table table-bordered">
											<tr>
												<td style="color:red;font-size:22px;"><b>No data found!</b></td>
												<td style="color:blue">
													<a class="btn btn-primary" href="{{ url('marksheet-verification') }}">Refresh</a>
												</td>
											</tr>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				@endif
			@endif
			</div>
		</div>
	</section>

 
@endsection
