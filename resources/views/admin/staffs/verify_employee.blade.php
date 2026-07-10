@extends('admin.include.master')
@section('title')
	{{ $page_title }}
@endsection

@section('content')
<style>
    .stepper-vertical .step {
        position: relative;
        padding-left: 2.5rem;
        margin-bottom: 2rem;
    }
    .stepper-vertical .step::before {
        content: attr(data-step);
        position: absolute;
        left: 0;
        top: 0;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        border: 2px solid #6f42c1;
        color: #6f42c1;
        display: flex;
        justify-content: center;
        align-items: center;
        background: white;
        font-weight: 600;
    }
    .stepper-vertical .line {
        position: absolute;
        left: 15px;
        top: 35px;
        width: 2px;
        height: calc(100% - 10px);
        background: #d1c4e9;
    }
	
	tr th{
		font-size:15px !important;
	}
	
	.highlight-check {
        display: flex;
        gap: 10px;
        padding: 14px 16px;
        border: 2px solid #d4dcee;
        border-radius: 12px;
        cursor: pointer;
        font-size: 18px;
        font-weight: 600;
        color: #0a2a61;
        transition: 0.25s;
    }

    .highlight-check input[type="checkbox"] {
        width: 22px;
        height: 22px;
        accent-color: #315bff;
    }

    .highlight-check:has(input:checked) {
        background: #e8edff;
        border-color: #315bff;
        box-shadow: 0px 4px 8px rgba(0,0,0,0.1);
    }
	
	.profile-card {
		width: 100%;
		max-width: 720px;
		margin: 20px auto;
		background: linear-gradient(135deg, #e0f2ff, #f5f5ff);
		padding: 25px;
		border-radius: 18px;
		box-shadow: 0 4px 25px rgba(0, 0, 0, 0.1);
		font-family: 'Inter', sans-serif;
	}

	.profile-header {
		display: flex;
		align-items: center;
		gap: 20px;
	}

	.profile-header img {
		width: 110px;
		height: 110px;
		border-radius: 14px;
		object-fit: cover;
		border: 3px solid white;
		box-shadow: 0 3px 12px rgba(0,0,0,0.15);
	}

	.profile-name {
		font-size: 24px;
		font-weight: 700;
		color: #1f2937;
	}

	.profile-position {
		font-size: 16px;
		font-weight: 600;
		color: #2563eb;
	}

	.profile-table {
		width: 100%;
		margin-top: 20px;
		border-collapse: collapse;
	}

	.profile-table th {
		text-align: left;
		padding: 10px 5px;
		font-weight: 600;
		color: #374151;
		width: 30%;
	}

	.profile-table td {
		padding: 10px 5px;
		font-weight: 500;
		color: #1d4ed8;
	}

	.profile-card:hover {
		transform: translateY(-3px);
		transition: 0.25s;
	}

</style>

<!-- Page Header -->
<div style="background:linear-gradient(45deg, #f33057, rgb( 56, 88, 249 ) );"  class="d-sm-flex d-block align-items-center justify-content-between page-header-breadcrumb">
    <div>
        <h4 class="fw-medium mb-2">{{ $page_title }}</h4>
        <div class="ms-sm-1 ms-0">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active fw-normal" aria-current="page">Update {{ $page_title }}</li>
                </ol>
            </nav>
        </div>
    </div>

</div>
<!-- Page Header Close -->


<div class="main-content app-content">
    <div class="container-fluid">
     <div class="row">
            <div class="col-sm-12">
                <div class="card">
				<div class="card-header d-flex align-items-center justify-content-between">
						<h5 class="card-title">{{ $page_title }}</h5>
						<a href="{{ url('admin/staffs') }}" class="btn btn-primary ms-auto">
							{{ $page_title }} List
						</a>
					</div>
                    <div class="card-body booking_card">
						<div class="row justify-content-center">
							<div class="col-sm-6">
								<div class="profile-card">

									<!-- Profile Header with Image -->
									<div class="profile-header">
										<img src="{{ static_asset($staff->profile_pic) }}" alt="Profile Photo">

										<div>
											<div class="profile-name">{{ $staff->first_name }}</div>
											<div class="profile-position">{{ $staff->designation_name }}</div>
										</div>
									</div>

									<!-- Details Table -->
									<table class="profile-table">
										<tr>
											<th>Employee Code</th>
											<td>{{ $staff->employee_code }}</td>
										</tr>
										<tr>
											<th>Type</th>
											<td>{{ $staff->user_type_name }}</td>
										</tr>
										<tr>
											<th>Branch</th>
											<td>{{ $staff->branch_name }}</td>
										</tr>
										<tr>
											<th>Session</th>
											<td>{{ $staff->session_name }}</td>
										</tr>
										<tr>
											<th>Mobile</th>
											<td>{{ $staff->mobile }}</td>
										</tr>
										<tr>
											<th>Email</th>
											<td>{{ $staff->email }}</td>
										</tr>
									</table>
								</div>


							</div>
						</div>
                        
						
						<form action="" class="mt-3" method="POST" enctype="multipart/form-data" id="stepForm">
										@csrf
							<div class="row">
								<div style="display:none;" id="show-campaign-form-error" class="alert alert-danger col-md-12">
									<ul>
										<div class="errorMsgntainer"></div>
									</ul>
								</div>
							</div>
							<input type="hidden" name="user_id" value="{{ $staff->id }}">
							<div class="stepper-vertical">

								<!-- STEP 1 -->
								<div class="step" data-step="1">
									<div class="line"></div>
									<h5>Bank Details</h5>
									<div class="row mt-3">
										<div class="col-md-4 mb-3">
											<label>Account Number *</label>
											<input type="text" placeholder="Enter Account Number" class="form-control" name="account_number" required>
										</div>

										<div class="col-md-4 mb-3">
											<label>IFSC Code</label>
											<input type="text" placeholder="Enter IFSC Code" class="form-control" name="ifsc_code">
										</div>
										
										<div class="col-md-4 mb-3">
											<label>Bank Name</label>
											<input type="text" placeholder="Enter Bank Name" class="form-control" name="bank_name">
										</div>
										
										<div class="col-md-4 mb-3">
											<label>Branch Name</label>
											<input type="text" placeholder="Enter Branch Name" class="form-control" name="branch_name">
										</div>
										
										<div class="col-md-4 mb-3">
											<label>Phone Pe/Google Pay UPI</label>
											<input type="text" placeholder="Enter Phone Pe/Google Pay UPI" class="form-control" name="upi_details">
										</div>
									</div>

									<button type="button" class="btn btn-primary nextBtn">Next</button>
								</div>

								<!-- STEP 2 -->
								<div class="step d-none" data-step="2">
									<div class="line"></div>
									<h5>Location Verification</h5>

									<div class="row mt-3">
										<div class="col-md-4 mb-3">
											<label>Branch</label>
											<input type="text" placeholder="Enter Branch" class="form-control" name="branch">
										</div>
										<div class="col-md-4 mb-3">
											<label>To City</label>
											<input type="text" placeholder="To City" class="form-control" name="to_city">
										</div>
										<div class="col-md-4 mb-3">
											<label>KM</label>
											<input type="number" placeholder="KM" class="form-control" name="km1">
										</div>
										
										<div class="col-md-4 mb-3">
											<label>City</label>
											<input type="text" placeholder="Enter City" class="form-control" name="city">
										</div>
										<div class="col-md-4 mb-3">
											<label>To Village</label>
											<input type="text" placeholder="To Village" class="form-control" name="to_village">
										</div>
										<div class="col-md-4 mb-3">
											<label>KM</label>
											<input type="number" placeholder="KM" class="form-control" name="km2">
										</div>
										
										<div class="col-md-4 mb-3">
											<label>Village</label>
											<input type="text" placeholder="Enter Village" class="form-control" name="village">
										</div>
										<div class="col-md-4 mb-3">
											<label>To Home</label>
											<input type="text" placeholder="To Home" class="form-control" name="to_home">
										</div>
										<div class="col-md-4 mb-3">
											<label>KM</label>
											<input type="number" placeholder="KM" class="form-control" name="km3">
										</div>
										
										<div class="col-md-4 mb-3">
											<label>Ward Member Name</label>
											<input type="text" placeholder="Ward Member Name" class="form-control" name="ward_member_name">
										</div>
										
										<div class="col-md-4 mb-3">
											<label>Near By</label>
											<input type="text" placeholder="Near by" class="form-control" name="near_by">
										</div>
										
										<div class="col-md-4 mb-3">
											<label>Emp. Mark of Identifcation</label>
											<input type="text" placeholder="Emp. Mark of Identifcation" class="form-control" name="mark_of_identification">
										</div>
										
									</div>
									
									<button type="button" class="btn btn-secondary prevBtn">Previous</button>
									<button type="button" class="btn btn-primary nextBtn">Next</button>
								</div>

								<!-- STEP 3 -->
								<div class="step d-none" data-step="3">
									<div class="line"></div>
									<h5>Upload KYC & Educational Document</h5>

									<div class="row mt-3">
										<div class="col-md-4 mb-3">
											<label>Aadhar Card <small class="text-danger">(PDF Format Maximum 2MB)</small></label>
											<input type="file" class="form-control" name="aadhar_card" accept="application/pdf">
											
										</div>
										<div class="col-md-4 mb-3">
											<label>Pan Card <small class="text-danger">(PDF Format Maximum 2MB)</small></label>
											<input type="file" class="form-control" name="pan_card" accept="application/pdf">
										</div>
										<div class="col-md-4 mb-3">
											<label>Driving License <small class="text-danger">(PDF Format Maximum 2MB)</small></label>
											<input type="file" class="form-control" name="driving_license" accept="application/pdf">
										</div>
										<div class="col-md-4 mb-3">
											<label>Vehicle RC <small class="text-danger">(PDF Format Maximum 2MB)</small></label>
											<input type="file" class="form-control" name="vehicle_rc" accept="application/pdf">
										</div>
										<div class="col-md-4 mb-3">
											<label>Matriculation Marksheet <small class="text-danger">(PDF Format Maximum 2MB)</small></label>
											<input type="file" class="form-control" name="matriculation_marksheet" accept="application/pdf">
										</div>
										<div class="col-md-4 mb-3">
											<label>Intermediate Marksheet <small class="text-danger">(PDF Format Maximum 2MB)</small></label>
											<input type="file" class="form-control" name="intermediate_marksheet" accept="application/pdf">
										</div>
										<div class="col-md-4 mb-3">
											<label>Graduation Marksheet</label>
											<input type="file" class="form-control" name="graduation_marksheet" accept="application/pdf">
										</div>
									</div>

									<button type="button" class="btn btn-secondary prevBtn">Previous</button>
									<button type="button" class="btn btn-primary nextBtn">Next</button>
								</div>

								<!-- STEP 4 -->
								<div class="step d-none" data-step="4">
									<div class="line"></div>
									<h5>Security Money</h5>

									<div class="row">
										 
										<div class="col-md-4 mb-3">
											<label>Select Security Money</label>
											<select class="form-select" required placeholder="Enter Address" name="security_money">
												<option value="">Select Security Money</option>
												<option value="2500">2500</option>
												<option value="3100">3100</option>
												<option value="4100">4100</option>
												<option value="5100">5100</option>
												<option value="6100">6100</option>
												<option value="7100">7100</option>
												<option value="8100">8100</option>
												<option value="9100">9100</option>
												<option value="10100">10100</option>
												<option value="11100">11100</option>
												<option value="12100">12100</option>
												<option value="13100">13100</option>
												<option value="14100">14100</option>
												<option value="15100">15100</option>
											</select>
										</div>
										<div class="col-md-4 mb-3">
											<label>Screenshot of Payment <small class="text-danger">(JPG,PNG Format Maximum 2MB)</small></label>
											<input type="file" class="form-control" name="screenshot_of_payment">
										</div>
										
										<div class="col-md-4 mb-3">
											<label>Uniform Cloth</label>
											<input type="text" placeholder="Uniform Cloth" class="form-control" name="uniform">
										</div>
										
										<div class="col-md-4 mb-3">
											<label>Shoe/Juti</label>
											<input type="text" placeholder="Shoe/Juti" class="form-control" name="shoe">
										</div>
										
										<div class="col-md-4 mb-3">
											<label>Sewing Charge</label>
											<input type="text" placeholder="Sewing Charge" class="form-control" name="sewing_charge">
										</div>
										
										<div class="col-md-4 mb-3">
											<label>Insurance</label>
											<input type="text" placeholder="Insurance" class="form-control" name="insurance">
										</div>
										
										<div class="col-md-4 mb-3">
											<label>Coat</label>
											<input type="text" placeholder="Coat" class="form-control" name="coat">
										</div>
										
										<div class="col-md-4 mb-3">
											<label>Training</label>
											<input type="text" placeholder="Training" class="form-control" name="training">
										</div>
										
										<div class="col-md-4 mb-3">
											<label>I Card</label>
											<input type="text" placeholder="I Card" class="form-control" name="i_card">
										</div>
										
										
									</div>

									<button type="button" class="btn btn-secondary prevBtn">Previous</button>
									<button type="button" class="btn btn-primary nextBtn">Next</button>
								</div>

								<!-- STEP 5 -->
								<div class="step d-none" data-step="5">
									<div class="line"></div>
									<h5>Assign Senior Employee Details</h5>

									<div class="row mt-3">
										<div class="col-md-6 mb-3">
											<label>Reporting Officer</label>
											<select name="reporting_officer" class="form-select">
												<option value="">Select Type</option>
												@foreach($reporting_officer as $val)
													<option value="{{ $val->id }}">{{ $val->first_name }}-{{ $val->employee_code }}</option>
												@endforeach
											</select>
										</div>
										
										<div class="col-md-6 mb-3">
											<label>Trainer Officer</label>
											<select name="trainer_officer" class="form-select">
												<option value="">Select Type</option>
												@foreach($trainer_officer as $val)
													<option value="{{ $val->id }}">{{ $val->first_name }}-{{ $val->employee_code }}</option>
												@endforeach
											</select>
										</div>
										
										<div class="col-md-6 mb-3">
											<label>Home Verification</label>
											<select name="home_verification_officer" class="form-select">
												<option value="">Select Type</option>
												@foreach($home_verification as $val)
													<option value="{{ $val->id }}">{{ $val->first_name }}-{{ $val->employee_code }}</option>
												@endforeach
											</select>
										</div>
										
										<div class="col-md-6 mb-3">
											<label>Junior Office Employee</label>
											<select name="junior_office_employee" class="form-select">
												<option value="">Select Type</option>
												@foreach($junior_office_employee as $val)
													<option value="{{ $val->id }}">{{ $val->first_name }}-{{ $val->employee_code }}</option>
												@endforeach
											</select>
										</div>
									
									</div>

									<button type="button" class="btn btn-secondary prevBtn">Previous</button>
									<button type="button" class="btn btn-primary nextBtn">Next</button>
								</div>

								<!-- STEP 6 -->
								<div class="step d-none" data-step="6">
									<h5>Assign Training Video</h5>
									<div class="line"></div>
									<div class="row mt-3">
										@foreach ($video_list as $video)
											<div class="col-md-4 mb-3">
												<label class="highlight-check">
													<input type="checkbox" name="video_id[]" value="{{ $video->id }}">
													{{ $video->video_title }}
												</label>
											</div>
										@endforeach
									</div>
									
									<button type="button" class="btn btn-secondary prevBtn">Previous</button>
									<button type="button" class="btn btn-primary nextBtn">Next</button>

								</div>
								
								<!-- STEP 7 -->
								<div class="step d-none" data-step="7">
									<h5>Add Yearly Bonus</h5>
									<div class="line"></div>
									<div class="row mt-3">
										@foreach ($yearly_bonus_list as $bonus)
											<div class="col-md-4 mb-3">
												<label class="highlight-check">
													<input type="checkbox" name="bonus_id[]" value="{{ $bonus->id }}"
														@if(in_array($bonus->id, $selected_videos ?? [])) checked @endif>
													{{ $bonus->title }} {{ $bonus->value }}/- 
												</label>
											</div>
										@endforeach
										 
									</div>

									<button type="button" class="btn btn-secondary prevBtn">Previous</button>
									<button type="button" class="btn btn-primary nextBtn">Next</button>
								</div>
								
								<!-- STEP 8 -->
								<div class="step d-none" data-step="8">
									<h5>Add Partership Program in %</h5>
									<div class="line"></div>
									<div class="row mt-3">
										<div class="col-md-4 mb-3">
											<label>Incentive in %</label>
											<input type="number" step="0.01" value="{{ $staff->staff_incentive }}" class="form-control" name="staff_incentive">
										</div>
										
										<div class="col-md-4 mb-3">
											<label>Verify Date</label>
											<input type="date" value="{{ $staff->verify_date }}" class="form-control" name="verify_date">
										</div>
										 
									</div>

									<button type="button" class="btn btn-secondary prevBtn">Previous</button>
									<button type="submit" class="btn btn-success saveCampaign">Save Details</button>
								</div>

							</div>
						</form>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
</div>
<script>
    let currentStep = 1;
    const totalSteps = 8;

    function showStep(step) {
        document.querySelectorAll('.step').forEach(s => s.classList.add('d-none'));
        document.querySelector(`.step[data-step="${step}"]`).classList.remove('d-none');
    }

    document.querySelectorAll('.nextBtn').forEach(btn => {
        btn.addEventListener('click', () => {
            if (currentStep < totalSteps) {
                currentStep++;
                showStep(currentStep);
            }
        });
    });

    document.querySelectorAll('.prevBtn').forEach(btn => {
        btn.addEventListener('click', () => {
            if (currentStep > 1) {
                currentStep--;
                showStep(currentStep);
            }
        });
    });

    showStep(1);
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
						$('#city').empty();
						$('#city').append('<option value="">Select City</option>');
						$.each(data, function (key, value) {
							$('#city').append('<option value="' + value.id + '">' + value.name + '</option>');
						});
					}
				});
			} else {
				$('#city').empty();
				$('#city').append('<option value="">Select City</option>');
			}
		});
		
		$('#user_type_id').on('change', function () {
			var userTypeId = $(this).val();
			if (userTypeId) {
				$.ajax({
					url: '{{ url("admin/get-designation-by-user") }}/' + userTypeId,
					type: "GET",
					dataType: "json", //getDesignationByUserType
					success: function (data) {
						$('#user_designation_id').empty();
						$('#user_designation_id').append('<option value="">Select Designation</option>');
						$.each(data, function (key, value) {
							$('#user_designation_id').append('<option value="' + value.id + '">' + value.name + '</option>');
						});
					}
				});
			} else {
				$('#user_designation_id').empty();
				$('#user_designation_id').append('<option value="">Select Designation</option>');
			}
		});
	});
	
	
	$(document).on('submit', '#stepForm', function(e) {
		e.preventDefault();

		var clk_btns = $(".saveCampaign");
		clk_btns.prop('disabled', true).text('Processing...');

		var formData = new FormData(this);

		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

		$.ajax({
			type: "POST",
			url: "{{ route('admin.emp.SaveEmployeeDetails') }}",
			data: formData,
			processData: false,
			contentType: false,
			dataType: "JSON",
			success: function(data) {
				clk_btns.prop('disabled', false).text('Save Details');

				if (data.status === true) {
					$('#stepForm')[0].reset();
					$('.errorMsgntainer').html('');
					Swal.fire({
						icon: "success",
						title: "Success",
						text: data.message,
						timer: 1500,
						showConfirmButton: false
					});
					// location.href = "{{ url('brand/campaign-preview') }}/" + data.lastId;
				} else {
					// toastr.success(data.message || "Something went wrong!");
					Swal.fire({
						icon: "error",
						title: "Oh No!",
						text: "Something went wrong!",
						timer: 1500,
						showConfirmButton: false
					});
					
				}
			},
			error: function(err) {
				clk_btns.prop('disabled', false).text('Save Details');
				document.getElementById('show-campaign-form-error').style.display = "block";

				let error = err.responseJSON;
				$('.errorMsgntainer').html('');
				$.each(error.errors, function(index, value) {
					$('.errorMsgntainer').append('<span class="text-danger">' + value + '</span><br>');
				});
			}
		});
	});
</script>


@endsection

@section('script')
    <script type="text/javascript">
        tinymce.init({
            selector: 'textarea#answer',
        });

    </script>
@endsection
