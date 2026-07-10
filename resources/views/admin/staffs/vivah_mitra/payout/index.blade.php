@extends('admin.include.master')
@section('title', 'Vivah Mitra Payout List')
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
        <h4 class="fw-medium mb-2">{{ $page_title }}</h4>
        <div class="ms-sm-1 ms-0">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">{{ $page_title }}</a></li>
                    <li class="breadcrumb-item active fw-normal" aria-current="page">Vivah Mitra Payout</li>
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
										<h5 class="card-title">Vivah Mitra Payout List</h5>
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
												
												<div class="col-md-3">
													<div class="form-group">
														<label>User Designation <span class="text-danger">*</span></label>
														<select class="form-control" id="user_designation_id" name="user_designation_id">
															<option value="">Select Designation</option>
														</select>
													</div>
												</div>

												<div class="col-md-4 mb-3">
													<div class="form-group">
														<label>Search <span class="text-danger">*</span></label>
														<div class="input-group">
															<input type="text" class="form-control" name="search" id="search" placeholder="Search by Name, Mobile, Email">
														</div>
													</div>
												</div>
												<div class="col-md-2">
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
												@include('admin.staffs.vivah_mitra.payout.user_table', ['users' => $users])
											</div>
											 
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

  <!-- Pay Modal -->
    <div class="modal fade" id="payModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <form id="payForm" enctype="multipart/form-data" method="POST"
                    action="{{ route('admin.transactions.store') }}">
                    @csrf

                    <div class="modal-header bg-info text-white">
                        <h5 class="modal-title">Pay User</h5>
                        <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                    </div>

                    <div class="modal-body">

                        <input type="hidden" name="user_id" id="user_id">

                        <div class="form-group">
                            <label><strong>Name :</strong> <span class="text-success" id="first_name"></span></label>
                        </div>

                        <div class="form-group">
                            <label><strong>UPI Details :</strong> <span class="text-success"
                                    id="upi_details"></span></label>
                        </div>

                        <div class="form-group">
                            <label><strong>Bank Name :</strong> <span class="text-success" id="bank_name"></span></label>
                        </div>

                        <div class="form-group">
                            <label><strong>Account Number :</strong> <span class="text-success"
                                    id="account_number"></span></label>
                        </div>

                        <div class="form-group">
                            <label><strong>IFSC Code :</strong> <span class="text-success" id="ifsc"></span></label>
                        </div>

                        <div class="form-group">
                            <label><strong>Available Amount :</strong> <span class="text-success"
                                    id="current_balance"></span></label>
                        </div>

                        <div class="form-group">
                            <label>Select Paying Area</label>
                            <select id="paying_area" name="paying_area" class="form-control" required>
                                <option value="">Select Paying Area</option>
                                <option value="bank_account">Bank Account</option>
                                <option value="upi_details">UPI Details</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Amount</label>
                            <input type="number" placeholder="Enter Amount" name="amount" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>UTR No.</label>
                            <input type="text" placeholder="Enter UTR No." name="utr_no" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Payment Screenshot</label>
                            <input type="file" placeholder="Enter Screenshot" name="screenshot" class="form-control"
                                required>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-success">Confirm Pay</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>


    <script>


        $(document).on('click', '.payBtn', function () {

            let id = $(this).data('id');

            $.get("{{ url('admin/user-bank-details') }}/" + id, function (res) {

                $('#user_id').val(res.id);
                $('#first_name').text(res.first_name);
                $('#upi_details').text(res.upi_details);
                $('#bank_name').text(res.bank_name);
                $('#account_number').text(res.account_number);
                $('#current_balance').text(res.current_balance);
                $('#ifsc').text(res.ifsc_code);

                $('#payModal').modal('show');
            });

        });




        let typingTimer;

        function loadData(page = '') {

            $.ajax({
                url: "{{ route('admin.vivahMitraIncentive') }}?page=" + page,
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    name: $('#name').val(),
                    designation: $('#designation').val(),
                    status: $('#status').val()
                },
                success: function (res) {
                    $('#table-data').html(res);
                }
            });
        }

        $('#name').on('keyup', function () {

            clearTimeout(typingTimer);

            typingTimer = setTimeout(function () {
                loadData();
            }, 400);

        });

        $('#designation,#status').on('change', function () {
            loadData();
        });

        $(document).on('click', '.pagination a', function (e) {
            e.preventDefault();
            let page = $(this).attr('href').split('page=')[1];
            loadData(page);
        });


        $('#payForm').on('submit', function (e) {

            e.preventDefault(); // stop normal submit

            let form = this;
            let formData = new FormData(form);

            $.ajax({
                url: $(form).attr('action'),
                type: "POST",
                data: formData,
                processData: false, // REQUIRED for file
                contentType: false, // REQUIRED for file
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },

                beforeSend: function () {
                    $('.btn-success').prop('disabled', true).text('Processing...');
                },

                success: function (res) {


                    if (res.status) {

                        $('#payForm')[0].reset();
                        $('#payModal').modal('hide');
                        $('.btn-success').prop('disabled', false).text('Confirm Pay');
                        Swal.fire({
                            icon: "success",
                            title: "Updated!",
                            text: res.message,
                            timer: 1500,
                            showConfirmButton: false
                        });

                        setTimeout(() => location.reload(), 1500);
                        $('.btn-success').prop('disabled', false).text('Confirm Pay');
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Alert!",
                            text: res.message,
                            timer: 1500,
                            showConfirmButton: false
                        });
                    }


                },

                error: function (xhr) {

                    $('.btn-success').prop('disabled', false).text('Confirm Pay');

                    let res = xhr.responseJSON;

                    if (res && res.message) {
                        Swal.fire({
                            icon: "error",
                            title: "Alert!",
                            text: res.message,
                            timer: 1500,
                            showConfirmButton: false
                        });
                        return;
                        $('.btn-success').prop('disabled', false).text('Confirm Pay');
                    }

                    // validation errors
                    let errors = xhr.responseJSON?.errors;

                    if (errors) {
                        let msg = '';
                        $.each(errors, function (key, val) {
                            msg += val[0] + "\n";
                        });

                        Swal.fire({
                            icon: "error",
                            title: "Validation Error",
                            text: msg
                        });
                    }
                }
            });
        });

    </script>
	 
<script>

	 

    function fetchUsers(page = 1) {
        let user_type_id = $('#user_type_id').val();
        let user_designation_id = $('#user_designation_id').val();
        let search = $('#search').val();

        $.ajax({
            url: "{{ route('admin.emp.fetchVivahMitraPayout') }}?page=" + page,
            method: "GET",
            data: {
                user_type_id,
                user_designation_id,
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
    $('#user_type_id, #user_designation_id').change(function () {
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
        $('#search').val('');
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


</script>


@endsection
