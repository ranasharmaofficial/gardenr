@extends('admin.include.master')
@section('title', 'Monthly Routine List')
@section('content')

<style>
    table.table-bordered td,
    table.table-bordered th {
        border: 1px solid #dee2e6 !important;
    }
</style>

<!-- Page Header -->
<div style="background:linear-gradient(45deg, #f33057, rgb( 56, 88, 249 ) );"  class="d-sm-flex d-block align-items-center justify-content-between page-header-breadcrumb">
    <div>
        <h4 class="fw-medium mb-2">Monthly Routine List</h4>
        <div class="ms-sm-1 ms-0">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">{{ $page_title }}</a></li>
                    <li class="breadcrumb-item active fw-normal" aria-current="page">Monthly Routine</li>
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
								<div class="card card-table">
									<div class="card-header d-flex align-items-center justify-content-between">
										<h5 class="card-title">{{ $page_title }}</h5>
										{{--<a href="{{ url('admin/staffs/create') }}" class="btn btn-primary ms-auto">
											Add Staff
										</a>--}}
									</div>
									<div class="card-body booking_card">
										<div class="container">
										<form id="filterForm">
											<div class="row">
												<div class="col-md-3 mb-3">
													<div class="form-group">
														<label>User Type <span class="text-danger">*</span></label>
														<select class="form-control" name="user_type_id" id="user_type_id">
															<option value="">Select User Type</option>
															@foreach($user_type_list as $val)
																<option value="{{ $val->id }}">{{ $val->name }}</option>
															@endforeach
														</select>
													</div>
												</div>
												
												<div class="col-md-3 mb-3">
													<div class="form-group">
														<label>User Designation <span class="text-danger">*</span></label>
														<select class="form-control" name="user_designation_id" id="user_designation_id">
															<option value="">Select Designation</option>
															@foreach($designation_list as $val)
																<option value="{{ $val->id }}">{{ $val->name }}</option>
															@endforeach
														</select>
													</div>
												</div>
												
												<div class="col-md-6 mb-3">
													<div class="form-group">
														<label class="">Select Employee <span class="text-danger">*</span></label>
														<select class="form-control" id="user_id" name="user_id" required>
															<option value="">Select Employee / Staff</option>
														</select>
													</div>
												</div>

												<div class="col-md-3 mb-3">
													<div class="form-group">
														<label>Search <span class="text-danger">*</span></label>
														<div class="input-group">
															<input type="text" class="form-control" name="search" id="search" placeholder="Search by Name, Mobile, Email">
														</div>
													</div>
												</div>
												<div class="col-md-3">
													<div class="form-group mt-4">
														<button class="btn btn-danger" id="resetSearchBtn" title="Reset Search">
															Reset
														</button>
														 
													</div>
												</div>
											</div>
											</form>
										</div>
										
										<div class="table-responsive">
											<div id="user-table">
												@include('admin.employee.partials.monthly_routine_table_ajax', ['monthly_routines' => $monthly_routines])
											</div>
											 
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

 	 
<script>
    function fetchUsers(page = 1) {
        let user_id = $('#user_id').val();
         
        let search = $('#search').val();

        $.ajax({
            url: "{{ route('admin.staff.fetchMonthlyRoutines') }}?page=" + page,
            method: "GET",
            data: {
                user_id,
                search
            },
            success: function (data) {
                $('#user-table').html(data);
            }
        });
    }

    // Trigger on pagination click
    $(document).on('click', '.pagination a', function (e) {
        e.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        fetchUsers(page);
    });

    // Trigger on filter change
    $('#user_id').change(function () {
        fetchUsers();
    });

    // Trigger on search
    $('#search').on('keyup', function () {
        fetchUsers();
    });

    // Reset filters
    $('#resetSearchBtn').on('click', function (e) {
        e.preventDefault();
        $('#user_type_id').val('');
        $('#user_designation_id').val('');
        $('#user_id').val('');
        $('#search').val('');
        fetchUsers();
    });
	
	$('#user_designation_id').change(function () {

		let designationId = $(this).val();
		let userTypeId = $('#user_type_id').val();

		$('#user_id').html('<option value="">Loading...</option>');

		 
			if (designationId && userTypeId) {
				$.ajax({
					url: "{{ route('admin.get.allemployees') }}",
					type: "POST",
					data: {
						_token: "{{ csrf_token() }}",
						user_type_id: userTypeId,
						designation_id: designationId
					},
					success: function (data) {
						let options = '<option value="">Select Employee / Staff</option>';
						$.each(data, function (key, row) {
							options += `<option value="${row.id}">${row.first_name} - ${row.employee_code}</option>`;
						});
						$('#user_id').html(options);
					}
				});
			}
		 


	});

</script>


@endsection
