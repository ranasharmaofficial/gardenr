@extends('admin.include.master')
@section('title')
	{{ $page_title }}
@endsection

@section('content')

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
						<h5 class="card-title">Update {{ $page_title }}</h5>
						<a href="{{ url('admin/staffs') }}" class="btn btn-primary ms-auto">
							{{ $page_title }} List
						</a>
					</div>
                    <div class="card-body booking_card">
                        <form method="post" action="{{ route('admin.staffs.update', $staff->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="row formtype">
                                <div class="col-md-12">
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Branch <span class="text-danger">*</span></label>
                                        <select class=" form-control" name="branch">
                                            <option value="">Select Branch</option>
											@foreach($branch_list as $val)
												<option @if($staff->branch==$val->id) selected @endif value="{{ $val->id }}">{{ $val->name }} ({{ $val->code }})</option>
											@endforeach
                                        </select>
                                    </div>
                                </div>

								<div class="col-md-4">
                                    <div class="form-group">
                                        <label>Session <span class="text-danger">*</span></label>
                                        <select class=" form-control" name="session">
                                            <option value="">Select Session</option>
											@foreach($session_list as $val)
												<option @if($staff->session==$val->id) selected @endif value="{{ $val->id }}">{{ $val->title }}</option>
											@endforeach
                                        </select>
                                    </div>
                                </div>
								<div class="col-md-4">
									<div class="form-group">
										<label>User Type <span class="text-danger">*</span></label>
										<select class=" form-control" id="user_type_id" name="user_type_id">
											@foreach($user_type_list as $val)
												<option @if($staff->user_type_id==$val->id) selected @endif  value="{{ $val->id }}">{{ $val->name }}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>User Designation <span class="text-danger">*</span></label>
										<select class="form-control" id="user_designation_id" name="user_designation_id">

												<option @if($designation_details->id==$staff->user_designation_id) selected @endif  value="{{ $designation_details->id }}">{{ $designation_details->name }}</option>

										</select>
									</div>
								</div>

								<div class="col-md-4">
									<div class="form-group">
										<label>Employee Code <span class="text-danger">*</span> </label>
										<input style="background-color:#dce1de;" type="text" placeholder="Enter Employee Code" readonly value="{{ $staff->employee_code }}" class="form-control" name="employee_code">
									</div>
								</div>

								<div class="col-md-4">
									<div class="form-group">
										<label>Name <span class="text-danger">*</span> </label>
										<input type="text" placeholder="Enter Name" value="{{ $staff->first_name }}" class="form-control" name="name">
									</div>
								</div>

								<div class="col-md-4">
									<div class="form-group">
										<label>Mobile <span class="text-danger">*</span> </label>
										<input type="text" placeholder="Enter Mobile" value="{{ $staff->mobile }}" class="form-control" name="mobile">
									</div>
								</div>

								<div class="col-md-4">
									<div class="form-group">
										<label>Email <span class="text-danger">*</span> </label>
										<input type="text" placeholder="Enter Email" value="{{ $staff->email }}" class="form-control" name="email">
									</div>
								</div>

								<div class="col-md-4">
									<div class="form-group">
										<label>Experience <span class="text-danger">*</span> </label>
										<input type="text" value="{{ $staff->experience }}" class="form-control" placeholder="Enter Experience" name="experience">
									</div>
								</div>

								<div class="col-md-4">
									<div class="form-group">
										<label>Address <span class="text-danger">*</span></label>
										<input type="text" value="{{ $staff->address }}" placeholder="Address"  class="form-control" name="address">
									</div>
								</div>

								<div class="col-md-4">
									<div class="form-group">
										<label>State <span class="text-danger">*</span></label>
										<select class=" form-control" name="state" id="state">
											@foreach($state_list as $val)
												<option @if($staff->state==$val->id) selected @endif value="{{ $val->id }}">{{ $val->name }}</option>
											@endforeach
										</select>
									</div>
								</div>

								<div class="col-md-4">
									<div class="form-group">
										<label>City <span class="text-danger">*</span></label>
										<select class=" form-control" name="city" id="city">
											<option value="{{ $city_details->id }}">{{ $city_details->name }}</option>
										</select>
									</div>
								</div>

								<div class="col-md-4">
									<div class="form-group">
										<label>Login Username <span class="text-danger">*</span></label>
										<input type="text" value="{{ $staff->username }}" placeholder="Login Username" class="form-control" name="username">
									</div>
								</div>

								<div class="col-md-4">
									<div class="form-group">
										<label>Login Password <span class="text-danger">*</span></label>
										<input type="text" value="{{ $staff->password }}" placeholder="Login Password" class="form-control" name="password">
									</div>
								</div>

								<div class="col-md-4">
									<div class="form-group">
										<label>Working Hour <span class="text-danger">*</span></label>
										<input type="number" value="{{ $staff->working_hour }}" placeholder="Working Hour" class="form-control" name="working_hour">
									</div>
								</div>

                                <div class="col-md-4">
									<div class="form-group">
										<label>Set In Time <span class="text-danger">*</span></label>
										<input type="time" value="{{ $staff->in_time }}" placeholder="Set In Time" class="form-control" name="in_time">
									</div>
								</div>

								<div class="col-md-4">
									<div class="form-group">
										<label>Salary <span class="text-danger">*</span></label>
										<input type="number" value="{{ $staff->salary }}" placeholder="salary" class="form-control" name="salary">
									</div>
								</div>

								<div class="col-md-4">
									<div class="form-group">
										<label>Status <span class="text-danger">*</span></label>
										<select class=" form-control" name="status">
											<option @if($staff->status=='1') selected @endif value="1" >Active</option>
											<option @if($staff->status=='2') selected @endif value="2">Inactive</option>
										</select>
									</div>
								</div>



                            </div>
                            <button type="submit" class="btn btn-primary buttonedit1">UPDATE</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
</div>

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
</script>


@endsection

@section('script')
    <script type="text/javascript">
        tinymce.init({
            selector: 'textarea#answer',
        });

    </script>
@endsection
