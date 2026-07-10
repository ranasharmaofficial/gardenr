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
                    <li class="breadcrumb-item"><a href="javascript:void(0);">{{ $page_title }}</a></li>
                    <li class="breadcrumb-item active fw-normal" aria-current="page">Add {{ $page_title }}</li>
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
						<h5 class="card-title">Add {{ $page_title }}</h5>
						<a href="{{ url('admin/staffs') }}" class="btn btn-primary ms-auto">
							{{ $page_title }} List
						</a>
					</div>
                    <div class="card-body booking_card">
                        <form method="post" action="{{ route('admin.staffs.storeVivahMitraData') }}" enctype="multipart/form-data">
                            @csrf
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
												<option @if(old('brand')==$val->branch) selected @endif value="{{ $val->id }}">{{ $val->name }} ({{ $val->code }})</option>
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
												<option @if(old('session')==$val->id) selected @endif value="{{ $val->id }}">{{ $val->title }}</option>
											@endforeach
                                        </select>
                                    </div>
                                </div>
								
								<div class="col-md-4">
									<div class="form-group">
										<label>Vivah Mitra Code <span class="text-danger">*</span> </label>
										<input style="background-color:#f8efeff7;" type="text" placeholder="Enter Name" value="{{ $employee_code }}" readonly class="form-control" name="employee_code">
									</div>
								</div>
								
								<div class="col-md-4">
									<div class="form-group">
										<label>Name <span class="text-danger">*</span> </label>
										<input type="text" placeholder="Enter Name" value="{{ old('name') }}" class="form-control" name="name">
									</div>
								</div>

								<div class="col-md-4">
									<div class="form-group">
										<label>Mobile <span class="text-danger">*</span> </label>
										<input type="text" placeholder="Enter Mobile" value="{{ old('mobile') }}" class="form-control" name="mobile">
									</div>
								</div>

								<div class="col-md-4">
									<div class="form-group">
										<label>Email <span class="text-danger">*</span> </label>
										<input type="text" placeholder="Enter Email" value="{{ old('email') }}" class="form-control" name="email">
									</div>
								</div>

								<div class="col-md-4">
									<div class="form-group">
										<label>Experience <span class="text-danger">*</span> </label>
										<input type="text" value="{{ old('experience') }}" class="form-control" placeholder="Enter Experience" name="experience">
									</div>
								</div>

								<div class="col-md-4">
									<div class="form-group">
										<label>Address <span class="text-danger">*</span></label>
										<input type="text" value="{{ old('address') }}" placeholder="Address"  class="form-control" name="address">
									</div>
								</div>
								
								<div class="col-md-4">
									<div class="form-group">
										<label>State <span class="text-danger">*</span></label>
										<select class=" form-control" name="state" id="state">
											@foreach($state_list as $val)
												<option value="{{ $val->id }}">{{ $val->name }}</option>
											@endforeach
										</select>
									</div>
								</div>
								
								<div class="col-md-4">
									<div class="form-group">
										<label>City <span class="text-danger">*</span></label>
										<select class=" form-control" name="city" id="city">
											<option value="">Select City</option>
										</select>
									</div>
								</div>

								<div class="col-md-4">
									<div class="form-group">
										<label>Login Password <span class="text-danger">*</span></label>
										<input type="text" value="{{ old('password') }}" placeholder="Login Password" class="form-control" name="password">
									</div>
								</div>
								
								<div class="col-md-4">
									<div class="form-group">
										<label>Working Hour <span class="text-danger">*</span></label>
										<input type="number" value="{{ old('working_hour') }}" placeholder="Working Hour" class="form-control" name="working_hour">
									</div>
								</div>
								
								<div class="col-md-4">
									<div class="form-group">
										<label>Salary <span class="text-danger">*</span></label>
										<input type="number" value="{{ old('salary') }}" placeholder="salary" class="form-control" name="salary">
									</div>
								</div>
								
								<div class="col-md-4">
									<div class="form-group">
										<label>Training Fee <span class="text-danger">*</span></label>
										<select class=" form-control" name="training_fee">
											<option value="1500" >Rs 1500/-</option>
											<option value="0" >Free</option>
										</select>
									</div>
								</div>
								
								<div class="col-md-4">
									<div class="form-group">
										<label>Status <span class="text-danger">*</span></label>
										<select class=" form-control" name="status">
											<option @if(old('status')=='1') selected @endif value="1" >Active</option>
											<option  @if(old('status')=='2') selected @endif value="2">Inactive</option>
										</select>
									</div>
								</div>
 

                            </div>
                            <button type="submit" class="btn btn-primary buttonedit1">Add</button>
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
					dataType: "json", 
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
