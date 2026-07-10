@extends('admin.include.master')
@section('title', 'Home Meeting Details')

@section('content')

    <div style="background:linear-gradient(45deg,#f33057,rgb(56,88,249));"
        class="d-sm-flex d-block align-items-center justify-content-between page-header-breadcrumb">

        <div>
            <h4 class="fw-medium mb-2">Home Meeting Details</h4>
            <div class="ms-sm-1 ms-0">
                <nav>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ url('') }}"><i class="fa fa-home"></i> Home</a></li>
                        <li class="breadcrumb-item active">Home Meeting Details</li>
                    </ol>
                </nav>
            </div>
        </div>

    </div>

    <div class="main-content app-content">
        <div class="container-fluid">

            <div class="card custom-card mt-3">

                <div class="card-header">
                    <h5 class="mb-0">Home Meeting Details</h5>
                </div>

                <div class="card-body">

                    <table class="table table-bordered">
                <tr>
                    <th>User Name</th>
                    <td>{{ $meeting->first_name }}</td>
                </tr>
                <tr>
                    <th>Mobile</th>
                    <td>{{ $meeting->mobile }}</td>
                </tr>
                <tr>
                    <th>Employee Code</th>
                    <td>{{ $meeting->employee_code }}</td>
                </tr>
                <tr>
                    <th>Address</th>
                    <td>{{ $meeting->address }}</td>
                </tr>
                <tr>
                    <th>Training Place</th>
                    <td>{{ $meeting->training_place }}</td>
                </tr>
                <tr>
                    <th>Training Address</th>
                    <td>{{ $meeting->training_address }}</td>
                </tr>
                <tr>
                    <th>District</th>
                    <td>{{ $meeting->district_name }}</td>
                </tr>
                <tr>
                    <th>Date</th>
                    <td>{{ $meeting->training_date }}</td>
                </tr>
                <tr>
                    <th>Time</th>
                    <td>{{ $meeting->start_time }} - {{ $meeting->end_time }}</td>
                </tr>
                <tr>
                    <th>Total Vivah Mitra</th>
                    <td>{{ $meeting->total_vivah_mitra }}</td>
                </tr>
                <tr>
                    <th>Total Panchayat Mitra</th>
                    <td>{{ $meeting->total_panchayat_mitra }}</td>
                </tr>
                <tr>
                    <th>Total Block Vivah Mitra</th>
                    <td>{{ $meeting->total_block_vivah_mitra }}</td>
                </tr>
                <tr>
                    <th>Total District Vivah Mitra</th>
                    <td>{{ $meeting->total_district_vivah_mitra }}</td>
                </tr>
                <tr>
                    <th>Supported By</th>
                    <td>{{ $meeting->supported_by }}</td>
                </tr>
                <tr>
                    <th>Photo 1</th>
                    <td>
                        <img src="{{ static_asset($meeting->photo1) }}" width="120">
                    </td>
                </tr>
                <tr>
                    <th>Photo 2</th>
                    <td>
                        <img src="{{ static_asset($meeting->photo2) }}" width="120">
                    </td>
                </tr>
            </table>
                     

                </div>
            </div>
			
			 <div class="card mt-4">
				<div class="card-body">

					<h5>Update Status</h5>

					<form class="row" action="{{ route('admin.home.meeting.status.update') }}" method="POST">
						@csrf

						<input type="hidden" name="id" value="{{ $meeting->id }}">

						<div class="form-group col-sm-6">
							<label>Amount</label>
							<input type="number" value="{{ $meeting->amount }}" required placeholder="Enter Amount" name="amount" class="form-control">
						</div>
						
						<div class="form-group col-sm-6">
							<label>Status</label>
							<select name="status" class="form-control">
								<option value="0" {{ $meeting->status == 0 ? 'selected' : '' }}>Pending</option>
								<option value="1" {{ $meeting->status == 1 ? 'selected' : '' }}>Approved</option>
								<option value="2" {{ $meeting->status == 2 ? 'selected' : '' }}>Rejected</option>
							</select>
						</div>
						
						<div class="form-group col-sm-6">
							<label>Reason</label>
							<input type="text" value="{{ $meeting->reason }}"  required placeholder="Enter Reason" name="reason" class="form-control">
						</div>

						<button type="submit" class="btn btn-primary mt-2">Update</button>

					</form>

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