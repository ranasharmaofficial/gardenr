@extends('admin.include.master')
@section('title', 'Fund transferred List')
@section('content')
<style>
	.fund-card {
        padding: 22px;
        border-radius: 15px;
        color: #fff;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        transition: 0.3s;
    }
    .wallet-bg {
        background: linear-gradient(135deg, #07a989dc, #4df6ff);
    }
</style>
<!-- Page Header -->
            <div style="background:linear-gradient(45deg, #f33057, rgb( 56, 88, 249 ) );"  class="d-sm-flex d-block align-items-center justify-content-between page-header-breadcrumb">
                <div>
                    <h4 class="fw-medium mb-2">Fund transferred List</h4>
                    <div class="ms-sm-1 ms-0">
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active fw-normal" aria-current="page">Fund transferred List</li>
                            </ol>
                        </nav>
                    </div>
                </div>
			</div>
            <!-- Page Header Close -->



            <!--APP-CONTENT START-->
            <div class="main-content app-content">
                <div class="container-fluid">


                    <!-- Start:: row-1 -->
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card custom-card">
                                <div class="card-header  d-flex justify-content-between align-items-center">
                                    <div class="card-title">
                                        Add Fund
                                    </div>
										<a href="{{ url('admin/fund-transfer-to-employee') }}"
										   class="btn btn-primary btn-sm float-end">
										   Fund Transfer to Employee
										</a>
                                </div>
								<div class="row formtype card-body">
								 
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
												<select class="form-control" id="user_designation" name="user_designation">
													<option value="">Select Designation</option>
												</select>
											</div>
										</div>
										
										<div class="col-md-4 mb-3">
											<div class="form-group">
												<label>Select Employee<span class="text-danger">*</span></label>
												<select class="form-control" id="user_id" name="user_id" required>
													<option value="">Select Employee / Staff</option>
												</select>
											</div>
										</div>
										
										<div class="col-md-4 mb-3">
											<div class="form-group">
												<label>Select Type<span class="text-danger">*</span></label>
												<select class="form-control" id="type" name="type" required>
													<option value="">Select Type</option>
													<option value="credit">Credit</option>
													<option value="debit">Debit</option>
												</select>
											</div>
										</div>

										<div class="col-md-3">
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

									<div class="col-md-12">
										<div class="table-responsive">	
											<div id="user-table">
												@include('admin.fund.fund_transferred_list_ajax', ['transactions' => $transactions])
											</div>										
											
										
										</div>
									</div>
								</div>
                        </div>

                    </div>
                    <!-- End:: row-1 -->



                </div>
            </div>
            <!--APP-CONTENT CLOSE-->

	<script>

	function fetchUsers(page = 1) {
        let user_id = $('#user_id').val();
        let search = $('#search').val();
        let date = $('#date').val();
        let type = $('#type').val();

        $.ajax({
            url: "{{ route('admin.funds.fetchFundTransferred') }}?page=" + page,
            method: "GET",
            data: {
                user_id,
                date,
                type,
                search,
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
    $('#user_id, #date, #type').change(function () {
        fetchUsers();
    });

    // Trigger on search
    $('#search').on('keyup', function () {
        fetchUsers();
    });

    // Reset filters
    $('#resetSearchBtn').on('click', function (e) {
        e.preventDefault();
        $('#user_id').val('');
        $('#date').val('');
        $('#search').val('');
        $('#type').val('');
        fetchUsers();
    });

		$('#user_type_id').on('change', function () {
			var userTypeId = $(this).val();
			if (userTypeId) {
				$.ajax({
					url: '{{ url("admin/get-designation-by-user") }}/' + userTypeId,
					type: "GET",
					dataType: "json", 
					success: function (data) {
						$('#user_designation').empty();
						$('#user_designation').append('<option value="">Select Designation</option>');
						$.each(data, function (key, value) {
							$('#user_designation').append('<option value="' + value.id + '">' + value.name + '</option>');
						});
					}
				});
			} else {
				$('#user_designation').empty();
				$('#user_designation').append('<option value="">Select Designation</option>');
			}
		});
		
		$('#user_designation').change(function () {

			let designationId = $(this).val();
			let user_type_id = $('#user_type_id').val();

			$('#user_id').html('<option value="">Loading...</option>');

            @if(loggedCompany()==1)
                if (designationId && user_type_id) {
                    $.ajax({
                        url: "{{ route('admin.get.allemployees') }}",
                        type: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            user_type_id: user_type_id,
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
            @else
                if (designationId && user_type_id) {
                    $.ajax({
                        url: "{{ route('admin.get.employees') }}",
                        type: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            user_type_id: user_type_id,
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

            @endif


		});

		 


	</script>

@endsection

@section('script')
    <script>

    </script>
@endsection
