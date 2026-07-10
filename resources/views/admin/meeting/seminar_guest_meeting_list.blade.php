@extends('admin.include.master')
@section('title', 'Seminar Guest Meeting List')

@section('content')

    <div style="background:linear-gradient(45deg,#f33057,rgb(56,88,249));"
        class="d-sm-flex d-block align-items-center justify-content-between page-header-breadcrumb">

        <div>
            <h4 class="fw-medium mb-2">Seminar Guest Meeting List</h4>
            <div class="ms-sm-1 ms-0">
                <nav>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ url('') }}"><i class="fa fa-home"></i> Home</a></li>
                        <li class="breadcrumb-item active">Seminar Guest Meeting List</li>
                    </ol>
                </nav>
            </div>
        </div>

    </div>

    <div class="main-content app-content">
        <div class="container-fluid">

            <div class="card custom-card mt-3">

                <div class="card-header">
                    <h5 class="mb-0">Seminar Guest Meeting List</h5>
                </div>

                <div class="card-body">

                    <!-- FILTER -->
                    <div class="row mb-3">

                        <div class="col-md-3">
                            <input id="name" class="form-control" placeholder="Search Name">
                        </div>

                        {{-- <div class="col-md-3">
                            <select id="designation" class="form-control">
                                <option value="">All Designation</option>
                                @foreach(DB::table('master_designations')->where('user_type', 6)->get() as $d)
                                <option value="{{ $d->id }}">{{ $d->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3">
                            <select id="status" class="form-control">
                                <option value="">All Status</option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div> --}}

                        <div class="col-md-2">
                            <button id="search" class="btn btn-danger">Search</button>
                        </div>

                    </div>

                    <!-- TABLE -->
                    <div class="table-responsive">

                        <table class="table table-bordered text-nowrap" style="width:100%">

                            <thead>
                                <tr>
                                    <th>Sl.</th>
									<th>Photo 1</th>
									<th>Photo 2</th>
									<th>Training Place</th>
									<th>Training Address</th>
									<th>District Name</th>
									<th>Training Date</th>
									<th>Start Time</th>
									<th>End Time</th>
									<th>Supported By</th>
									<th>Total Vivah Mitra</th>
									<th>Total Panchayat Mitra</th>
									<th>Total Block VM</th>
									<th>Total District VM</th>
									<th>Status</th>
									<th>Created At</th>
									<th>Action</th>
                                </tr>
                            </thead>

                            <tbody id="table-data">
                                @include('admin.meeting.seminar_meeting_table_ajax', ['meeting_list' => $meeting_list])
                            </tbody>

                        </table>

                    </div>

                </div>
            </div>

        </div>
    </div>
	
	<!-- Pay Modal -->
<div class="modal fade" id="payModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <form id="payForm" enctype="multipart/form-data" method="POST" action="{{ route('admin.transactions.store') }}">
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
                        <label><strong>UPI Details :</strong> <span class="text-success" id="upi_details"></span></label>
                    </div>
					
					<div class="form-group">
                        <label><strong>Bank Name :</strong> <span class="text-success" id="bank_name"></span></label>
                    </div>
					
					<div class="form-group">
                        <label><strong>Account Number :</strong> <span class="text-success" id="account_number"></span></label>
                    </div>
					
					<div class="form-group">
                        <label><strong>IFSC Code :</strong> <span class="text-success" id="ifsc"></span></label>
                    </div>
					
					<div class="form-group">
                        <label><strong>Available Amount :</strong> <span class="text-success" id="current_balance"></span></label>
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
                        <input type="file" placeholder="Enter Screenshot" name="screenshot" class="form-control" required>
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
	
	$(document).on('click','.payBtn',function(){

		let id = $(this).data('id');

	$.get("{{ url('admin/user-bank-details') }}/" + id, function(res){

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
		
		
		$('#payForm').on('submit', function(e) {

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

				beforeSend: function() {
					$('.btn-success').prop('disabled', true).text('Processing...');
				},

				success: function(res) {


					if(res.status){
						 
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
					}else{
						Swal.fire({
							icon: "error",
							title: "Alert!",
							text: res.message,
							timer: 1500,
							showConfirmButton: false
						});
					}
					 

				},

				error: function(xhr) {

					$('.btn-success').prop('disabled', false).text('Confirm Pay');

					let res = xhr.responseJSON;

					if(res && res.message){
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

					if(errors){
						let msg = '';
						$.each(errors, function(key,val){
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


@endsection