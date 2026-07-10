@extends('admin.include.master')
@section('title', 'Add Fund')
@section('content')

<!-- Page Header -->
            <div style="background:linear-gradient(45deg, #f33057, rgb( 56, 88, 249 ) );"  class="d-sm-flex d-block align-items-center justify-content-between page-header-breadcrumb">
                <div>
                    <h4 class="fw-medium mb-2">Fund Transfer</h4>
                    <div class="ms-sm-1 ms-0">
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active fw-normal" aria-current="page">Fund Transfer to Branch Manager</li>
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
                                <div class="card-header">
                                    <div class="card-title">
                                        Fund Transfer to Branch Manager
                                    </div>
                                </div>
								<form class="card-body" id="fund-transfer-to-branch-form" method="post" action="{{ route('admin.storeFund') }}" enctype="multipart/form-data">
									@csrf
									<div class="row formtype">

										<div style="display:none;" id="show-form-error" class="alert alert-danger col-md-12">
											<ul>
												<div class="errorMsgntainer"></div>
											</ul>
										</div>

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

										<div class="col-sm-6">
                                            <label for="course_id" class="col-form-label">Select User Type<star>*</star></label>
                                            <select class="form-control" id="user_type" name="user_type" required >
                                                <option value="">Select User Type</option>
                                                @foreach($user_type_list as $row)
                                                    <option value="{{ $row->id }}">{{ $row->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-sm-6">
                                            <label for="course_id" class="col-form-label">Select Branch<star>*</star></label>
                                            <select class="form-control" name="branch" id="branch" required >
                                                <option value="">Select Branch</option>
                                                @foreach($branch_list as $row)
                                                    <option value="{{ $row->id }}">{{ $row->name.'-'.$row->code }}</option>
                                                @endforeach
                                            </select>
                                        </div>
										
										<div class="col-sm-6">
											<label class="col-form-label">Select Branch Manager <star>*</star></label>
											<select class="form-control" id="user_id" name="user_id" required>
												<option value="">Select Branch Manager</option>
											</select>
										</div>

										<div class="col-sm-6">
                                            <label for="course_id" class="col-form-label">Select Branch<star>*</star></label>
                                            <select class="form-control" name="type" required >
                                                <option value="">Select Type</option>
                                                <option value="credit">Credit</option>
												<option value="debit">Debit</option>
                                            </select>
                                        </div>

                                        <div class="col-sm-6">
                                            <label for="title" class="col-form-label">Enter Amount <star>*</star></label>
                                            <input class="form-control" type="text" name="amount" required placeholder="Enter amount" id="amount" value="{{ old('amount') }}">
                                        </div>

										<div class="col-sm-6">
                                            <label for="title" class="col-form-label">Enter Date <star>*</star></label>
                                            <input class="form-control" type="date" name="added_date" required placeholder="Enter amount" id="amount" value="{{ old('amount') }}">
                                        </div>
                                    </div>
									<button type="submit" class="btn btn-primary mt-3 saveFund">Add</button>
								</form>
                            </div>
                        </div>

                    </div>
                    <!-- End:: row-1 -->



                </div>
            </div>
            <!--APP-CONTENT CLOSE-->

	<script>

	$(document).on('click', '.saveFund', function(e) {
		e.preventDefault();

		Swal.fire({
			title: "Are you sure?",
			text: "Do you really want to transfer the fund?",
			icon: "warning",
			showCancelButton: true,
			confirmButtonText: "Yes, Transfer",
			cancelButtonText: "Cancel",
		}).then((result) => {
			if (result.isConfirmed) {
				// Call function to submit AJAX
				submitFundTransfer();
			}
		});
	});


	function submitFundTransfer() {
		var clk_btn = $(".saveFund");
		clk_btn.prop('disabled', true);
		var formData = new FormData(document.getElementById("fund-transfer-to-branch-form"));

		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

		$.ajax({
			type: "POST",
			url: "{{ route('admin.funds.transferFundtoBranch') }}",
			data: formData,
			processData: false,
			contentType: false,
			dataType: "JSON",

			success: function(data) {
				if (data.status == true) {
					Swal.fire({
						icon: "success",
						title: "Success",
						text: data.message,
						timer: 1500,
						showConfirmButton: false
					});
					document.getElementById('show-form-error').style = "display: none";
					location.reload();
				} else if(data.status == false) {
					Swal.fire({
						icon: "error",
						title: "Error!",
						text: data.message ?? "Something went wrong!",
						timer: 1500,
						showConfirmButton: false
					});
					clk_btn.prop('disabled', false);
				}
			},
			error: function(err) {
				document.getElementById('show-form-error').style = "display: block";
				clk_btn.prop('disabled', false);
				let error = err.responseJSON;
				$('.errorMsgntainer').html(""); // clear old errors
				$.each(error.errors, function(index, value) {
					$('.errorMsgntainer').append('<span class="text-danger">' + value + '</span><br>');
				});
			}
		});
	}
	
		$('#branch').change(function () {

			let branch = $(this).val();
			let userTypeId = $('#user_type').val();

			$('#user_id').html('<option value="">Loading...</option>');

			if (branch && userTypeId) {
				$.ajax({
					url: "{{ route('admin.get.branchmanagers') }}",
					type: "POST",
					data: {
						_token: "{{ csrf_token() }}",
						user_type_id: userTypeId,
						branch: branch
					},
					success: function (data) {
						let options = '<option value="">Select Branch Manager</option>';
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

@section('script')
    <script>

    </script>
@endsection
