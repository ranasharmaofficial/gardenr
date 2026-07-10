@extends('vivah_mitra.layouts.master')
@section('title') जिला विवाह मित्र आवेदन @endsection

@section('meta_tags')

@endsection
@section('content')
	<style>
		.card {
			background: #ffffff;
			border-radius: 14px;
			padding: 16px;
			box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
			margin-bottom: 16px;
		}

		.title {
			text-align: center;
			font-size: 18px;
			font-weight: 700;
			color: #d35400;
			margin-bottom: 10px;
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
						<h5 class="mb-0"> जिला विवाह मित्र पंजीकरण </h5>
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

		<div class="content-inner pt-0">
			<div class="container fb">

				<div class="dashboard-area m-b30">
					<!-- Features -->

					<div class="row m-b20 g-3">
						@if($vivah_mitra_details->status==1)
						<div class="container bg-white">
						
							<div id="membership-number-box" class="row formtype">
								<div class="col-md-12 mb-3">
									<h3 class="font-weight-bold text-primary">कृपया फिज़िकल मेम्बरशिप चेक करें </h3>
								</div>
								
								<div class="col-md-4 mb-3">
									<div class="form-group">
										<label><strong>Membership Number </strong> <span class="text-danger">*</span> </label>
										<input type="text" id="membership_number" id="membership_number" placeholder="Enter Membership Number" value="{{ old('name') }}"
											class="form-control">
									</div>
								</div>
								
								<div class="col-md-4 mb-3">
									<center>
										<button id="check-membership" type="submit" class="btn btn-primary">CHECK MEMBERSHIP</button>
									</center>
								</div>
								
							</div>
							
							<div class="col-md-12 text-center mt-3" id="lottie-loader" style="display:none;">
								<div id="lottie-check" style="width:120px;margin:auto;"></div>
								<p class="text-muted mt-2">Checking Membership...</p>
							</div>
							<div class="col-md-12 mt-4 " id="membership-verified-card-box" style="display:none;">
								<div class="card shadow border-0" style="background: linear-gradient(135deg, #7f00ff, #e100ff);color: #fff;">
									<div class="card-body d-flex align-items-center">
										<div>
										
										
											<h5 class="mb-1 text-white" id="empName"></h5>
											<p class="mb-1 text-white"><strong>Membership Number:</strong> <span id="mem-membership_number"></span></p>
											<p class="mb-1 text-white"><strong>Name:</strong> <span id="mem-name"></span></p>
											<p class="mb-1 text-white"><strong>Mobile:</strong> <span id="mem-mobile"></span></p>
											<p class="mb-0 text-white"><strong>Address:</strong> <span id="mem-address"></span></p>
											
										</div>
									</div>
								</div>
							</div>

							<form method="post" style="display:none;" id="save-form" action="{{ route('member.saveJilaVivahMitra') }}"
								enctype="multipart/form-data">
								@csrf

								<div class="row">
									<div style="display:none;" id="show-form-error" class="alert alert-danger col-md-12">
										<ul>
											<div class="errorMsgntainer"></div>
										</ul>
									</div>
								</div>
								
								<div class="row formtype">
									<div class="col-md-12 mb-3">
										<h3 class="font-weight-bold text-primary">Personal Details</h3>
									</div>

									<div class="col-md-4 mb-3">
										<div class="form-group">
											<label>Name <span class="text-danger">*</span> </label>
											<input type="text" readonly id="v-name" placeholder="Enter Name" class="form-control" name="name">
										</div>
									</div>

									<div class="col-md-4 mb-3">
										<div class="form-group">
											<label>Mobile <span class="text-danger">*</span> </label>
											<input type="tel" min="10" maxlength="10" pattern="[6-9]{1}[0-9]{9}" id="v-mobile" placeholder="Enter Mobile" class="form-control" name="mobile">
										</div>
									</div>

									<div class="col-md-4 mb-3">
										<div class="form-group">
											<label>Aadhar No <span class="text-danger">*</span> </label>
											<input type="text" required pattern="[2-9]{1}[0-9]{11}" maxlength="12" minlength="12" inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9]/g, '')" title="Enter Valid Aadhar No." placeholder="Enter Aadhar No." value="{{ old('aadhar_card') }}" class="form-control" name="aadhar_card">
										</div>
									</div>

									<div class="col-md-4 mb-3">
										<div class="form-group">
											<label>Address <span class="text-danger">*</span></label>
											<input type="text" readonly id="v-address"  placeholder="Address" class="form-control" name="address">
										</div>
									</div>
									
									<div class="col-md-4 mb-3">
										<div class="form-group">
											<label>State <span class="text-danger">*</span> </label>
											<select class="" name="state" id="state">
												<option value="">Select State</option>
												@foreach($state_bihar_list as $val)
													<option value="{{ $val->id }}">{{ $val->name }}</option>
												@endforeach
											</select>
										</div>
									</div>

									<div class="col-md-4 mb-3">
										<div class="form-group">
											<label>District <span class="text-danger">*</span> </label>
											<select class="" name="city" id="district">
												<option value="">Select District</option>
											</select>
										</div>
									</div>
									{{--<div class="col-md-4 mb-3">
										<div class="form-group">
											<label>Block <span class="text-danger">*</span> </label>
											<select class="" name="block" id="block">
												<option value="">Select Block</option>
											</select>
										</div>
									</div>
									
									<div class="col-md-4 mb-3">
										<div class="form-group">
											<label>Panchayat <span class="text-danger">*</span> </label>
											<select class="" name="panchayat" id="panchayat">
												<option value="">Select Panchayat</option>
											</select>
										</div>
									</div>
									
									<div class="col-md-6 mb-3">
										<div class="form-group">
											<label>Ward No.<span class="text-danger">*</span> </label>
											<input type="text" placeholder="Enter Ward No." value="{{ old('ward_no') }}" class="form-control" name="ward_no">
										</div>
									</div>
									--}}

									 

									<div class="col-md-4 mb-3">
										<div class="form-group">
											<label>Login Password <span class="text-danger">*</span></label>
											<input type="text" value="{{ old('password') }}" placeholder="Login Password"
												class="form-control" name="password">
										</div>
									</div>

									<div class="col-md-12 mb-3">
										<h3 class="font-weight-bold text-primary">Bank Details</h3>
									</div>

									<div class="col-md-4 mb-3">
										<label>Account Number *</label>
										<input type="text" placeholder="Enter Account Number" class="form-control"
											name="account_number" required>
									</div>

									<div class="col-md-4 mb-3">
										<label>IFSC Code</label>
										<input type="text" placeholder="Enter IFSC Code" class="form-control"
											name="ifsc_code">
									</div>

									<div class="col-md-4 mb-3">
										<label>Bank Name</label>
										<input type="text" placeholder="Enter Bank Name" class="form-control"
											name="bank_name">
									</div>

									<div class="col-md-4 mb-3">
										<label>Branch Name</label>
										<input type="text" placeholder="Enter Branch Name" class="form-control"
											name="branch_name">
									</div>

									<div class="col-md-4 mb-3">
										<label>Phone Pe/Google Pay UPI</label>
										<input type="text" placeholder="Enter Phone Pe/Google Pay UPI" class="form-control"
											name="upi_details">
									</div>
									
									<div class="col-md-4 mb-3">
										<label>Select Photo</label>
										<input type="file" class="form-control" accept="image/*" name="profile_pic">
									</div>
									
									<div class="col-md-4 mb-3">
										<label>Upload Your Signature (हस्ताक्षर, सादा पेपर पे होने चाहिए)</label>
										</br>
										<small style="color:red;">(PNG/JPG | Size: 200×100 to 800×400)</small>
										<input type="file" class="form-control" accept="image/*" name="signature">
										
										<img id="preview" style="height:60px; display:none;">

										<script>
											document.querySelector('input[name="signature"]').onchange = function(e){
												const [file] = this.files;
												if(file){
													document.getElementById('preview').src = URL.createObjectURL(file);
													document.getElementById('preview').style.display='block';
												}
											}
										</script>

									</div>
									
									<div class="col-md-12 mb-3">
										<div class="form-group">
											<label style="font-size: 19px;color: blue;font-weight: bold;" for="terms_and_conditions">Application Charge ₹1101 आपके फंड वॉलेट से काट लिया जाएगा।</label>
										</div>
									</div>
									
									<div class="col-md-12 mb-3">
										<div class="form-group">
											<input type="checkbox" name="terms_and_conditions" id="terms_and_conditions">
											<label for="terms_and_conditions">I agree to the terms and conditions <span
											class="text-danger">*</span></label>
										</div>
									</div>
								</div>
								<button type="submit" class="btn btn-primary saveDetails">Save Details</button>
							</form>

						</div>
						@else
							<div class="container bg-white">
						
								 
								<div style="background-color:#fff3cd; border:1px solid #ffeeba; padding:20px; border-radius:8px; margin-top:20px;">
    
									<h4 style="color:#dc3545; margin-bottom:15px;">
										⚠️ अकाउंट ब्लॉक्ड
									</h4>
									
									<p style="margin-bottom:8px; font-weight:600;">
										कारण:
									</p>
									
									<p style="margin-bottom:8px;">
										अप्लाई डेट से 30 दिनों के अंदर न्यूनतम 10 विभाग मित्र जोड़ना अनिवार्य था।
									</p>
									
									<p style="margin-bottom:0;">
										निर्धारित समय सीमा के भीतर 10 विभाग मित्र अप्लाई नहीं किए जाने के कारण आपका अकाउंट अस्थायी रूप से ब्लॉक कर दिया गया है।
									</p>

								</div>


							</div>
							
						@endif



					</div>

					<!-- Features End -->



				</div>
			</div>
		</div>

	</div>
	<!-- Page Content End-->
	<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
	<script>
		let checkAnimation = lottie.loadAnimation({
			container: document.getElementById('lottie-check'),
			renderer: 'svg',
			loop: true,
			autoplay: false,
			path: 'https://assets10.lottiefiles.com/packages/lf20_usmfx6bp.json'
		});
		
		/* check membership number exist */
		
		$(document).ready(function () {

			$('#check-membership').click(function () {

				let membership_number = $('#membership_number').val();

				if (!membership_number) {
					Swal.fire('Error', 'Please enter Membership Number', 'error');
					return;
				}

				// UI Reset
				 
				$('#save-form').hide();

				// Show loader
				$('#lottie-loader').fadeIn();
				checkAnimation.play();

				$('#check-membership').prop('disabled', true).text('Checking...');

				$.ajax({
					url: "{{ route('member.check.membershipnumber') }}",
					type: "POST",
					data: {
						_token: "{{ csrf_token() }}",
						membership_number: membership_number
					},
					success: function (res) {

						$('#lottie-loader').fadeOut();
						checkAnimation.stop();

						$('#check-membership').prop('disabled', false).text('CHECK');

						if (res.status) {

							$('#mem-name').text(res.data.name);
							$('#v-name').val(res.data.name);
							$('#mem-father_husband').text(res.data.father_husband);
							$('#mem-mobile').text(res.data.mobile);
							$('#v-mobile').val(res.data.mobile);
							$('#mem-membership_number').text(res.data.membership_number);
							$('#mem-address').text(res.data.address + ', ' + res.data.post + ', ' + res.data.district + ', ' + res.data.state + ', ' + res.data.pincode);
							$('#v-address').val(res.data.address + ', ' + res.data.post + ', ' + res.data.district + ', ' + res.data.state + ', ' + res.data.pincode);
							
							
							 
							  $('#city').val(res.data.district);

							$('#save-form').slideDown();
							$('#membership-verified-card-box').slideDown();

						} else {
							Swal.fire('Not Found', res.message, 'error');
							$('#save-form').hide();
							$('#membership-verified-card-box').hide();
						}
					},
					error: function () {

						$('#lottie-loader').fadeOut();
						checkAnimation.stop();

						$('#check-membership').prop('disabled', false).text('CHECK');

						Swal.fire('Error', 'Something went wrong', 'error');
					}
				});
			});

		});

		$(document).on('submit', '#save-form', function (e) {
			e.preventDefault();

			var clk_btns = $(".saveDetails");
			clk_btns.prop('disabled', true).text('Saving...');

			var formData = new FormData(this);

			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});

			$.ajax({
				type: "POST",
				url: "{{ route('member.saveJilaVivahMitra') }}",
				data: formData,
				processData: false,
				contentType: false,
				dataType: "JSON",
				success: function (data) {
					clk_btns.prop('disabled', false).text('Save Details');

					if (data.status === true) {
						$('#save-form')[0].reset();
						$('.errorMsgntainer').html('');
						Swal.fire({
							icon: "success",
							title: "Success",
							text: data.message,
							timer: 1500,
							showConfirmButton: false
						});
						document.getElementById('show-form-error').style.display = "none";
						location.reload();
					} else {
						Swal.fire({
							icon: "error",
							title: "Oh No!",
							text: data.message,
							timer: 1500,
							showConfirmButton: false
						});

					}
				},
				error: function (err) {
					clk_btns.prop('disabled', false).text('Save Details');
					document.getElementById('show-form-error').style.display = "block";

					let error = err.responseJSON;
					$('.errorMsgntainer').html('');
					$.each(error.errors, function (index, value) {
						$('.errorMsgntainer').append('<span class="text-danger">' + value + '</span><br>');
					});
				}
			});
		});
	</script>
	<script>

	$(document).ready(function () {
		$('#state').on('change', function () {
			var stateID = $(this).val();
			if (stateID) {
				$.ajax({
					url: '{{ url("get-district-by-state") }}/' + stateID,
					type: "GET",
					dataType: "json",
					success: function (data) {
						$('#district').empty();
						$('#district').append('<option value="">Select District</option>');
						$.each(data, function (key, value) {
							$('#district').append('<option value="' + value.id + '">' + value.name + '</option>');
						});
					}
				});
			} else {
				$('#district').empty();
				$('#district').append('<option value="">Select district</option>');
			}
		});
		
		$('#district').on('change', function () {
			var districtID = $(this).val();
			if (districtID) {
				$.ajax({
					url: '{{ url("get-blocks-by-district") }}/' + districtID,
					type: "GET",
					dataType: "json",
					success: function (data) {
						$('#block').empty();
						$('#panchayat').empty();
						$('#block').append('<option value="">Select Block</option>');
						$.each(data, function (key, value) {
							$('#block').append('<option value="' + value.id + '">' + value.name + '</option>');
						});
					}
				});
			} else {
				$('#block').empty();
				$('#block').append('<option value="">Select block</option>');
			}
		});
		
		$('#block').on('change', function () {
			var panchayatID = $(this).val();
			if (panchayatID) {
				$.ajax({
					url: '{{ url("get-panchayat-by-block") }}/' + panchayatID,
					type: "GET",
					dataType: "json",
					success: function (data) {
						$('#panchayat').empty();
						$('#panchayat').append('<option value="">Select Panchayat</option>');
						$.each(data, function (key, value) {
							$('#panchayat').append('<option value="' + value.id + '">' + value.name + '</option>');
						});
					}
				});
			} else {
				$('#panchayat').empty();
				$('#panchayat').append('<option value="">Select Panchayat</option>');
			}
		});
	});


	</script>

	@include('vivah_mitra.includes.home_footer_menu')

@endsection