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
							<div class="col-sm-8">
								<div class="profile-card">

									<!-- Profile Header with Image -->
									<div class="profile-header">
										<img src="{{ static_asset($staff->profile_pic) }}" alt="Profile Photo">

										<div>
											<div class="profile-name">{{ $staff->first_name }}</div>
											<div class="profile-position">{{ $staff->designation_name }}</div>
										</div>
									</div>
									
									<div class="row mt-3">
										<div class="col-sm-6">
											<!-- Details Table -->
											<table class="table table-bordered">
												<tr>
													<th>Employee Code</th>
													<td>{{ $staff->employee_code }}</td>
												</tr>
												<tr>
													<th>Type</th>
													<td>{{ $staff->user_type_name }}</td>
												</tr>
												<tr>
													<th style="color:blue !important;">Designation</th>
													<td style="color:blue !important;">{{ $staff->designation_name }}</td>
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
										@php
											$getTotalPhycicalCard = \App\Models\Member::where('leader_id', $staff->id)->where('card_type', 'physical')->count();
											$getTotalDigitalCard = \App\Models\Member::where('leader_id', $staff->id)->where('card_type', 'digital')->count();
										@endphp
										<div class="col-sm-6">
											<!-- Details Table -->
											<table class="table table-bordered">
												<tr>
													<th>Physical Card</th>
													<td>{{ $getTotalPhycicalCard }}</td>
												</tr>
												<tr>
													<th>Digital Card</th>
													<td>{{ $getTotalDigitalCard }}</td>
												</tr>
												<tr>
													<th>Total Card</th>
													<td>{{ $getTotalPhycicalCard+$getTotalDigitalCard }}</td>
												</tr>
											
											</table>
										</div>
									</div>
								</div>


							</div>
						</div>
                        
						
						<form action="{{ route('admin.emp.updateVivahMitraPromotion') }}" class="mt-3" method="POST" enctype="multipart/form-data" id="">
										@csrf
							<div class="row">
								<div style="display:none;" id="show-campaign-form-error" class="alert alert-danger col-md-12">
									<ul>
										<div class="errorMsgntainer"></div>
									</ul>
								</div>
							</div>
							<input type="hidden" name="user_id" value="{{ $staff->id }}">
							<div class="container">
								<h5>Promote to Next Designation</h5>
								<div class="row mt-3">
									<div class="col-md-4 mb-3">
										<label>Designation (पद) *</label>
										<select class="form-control" name="user_designation_id" required>
											<option value="">Select Designation (पद)</option>
											@foreach($next_designation_list as $value)
												<option value="{{ $value->id }}">{{ $value->name }}</option>
											@endforeach
										</select>
									</div>
								</div>

								<button type="submit" class="btn btn-primary nextBtn">UPDATE</button>
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
     
</script>

<script>
	 
</script>


@endsection

@section('script')
    <script type="text/javascript">
        tinymce.init({
            selector: 'textarea#answer',
        });

    </script>
@endsection
