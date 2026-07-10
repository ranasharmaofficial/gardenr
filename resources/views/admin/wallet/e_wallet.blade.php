@extends('admin.include.master')

@section('title')
	{{ $page_title }}
@endsection

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
                    <h4 class="fw-medium mb-2">e-Wallet</h4>
                    <div class="ms-sm-1 ms-0">
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active fw-normal" aria-current="page">Fund transfer to Employee</li>
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
                                        e-Wallet
                                    </div>
                                </div>
								<div class="card-body" id="fund-transfer-to-employee-form" method="post" action="{{ route('admin.storeFund') }}" enctype="multipart/form-data">
                                    <div class="row justify-content-center">
										<div class="col-sm-4">
											<div class="fund-card wallet-bg text-center">
												<h6 class="mb-1">Total Earning</h6>
												<h3 class="fw-bold">₹{{ number_format($companyWallet->balance, 2) }}</h3>
											</div>
										</div>

                                        <div class="col-sm-12">
                                            <div class="table-responsive">
                                                <table id="" class="table table-bordered text-nowrap mt-3" style="width:100%">
                                                    <thead>
                                                    <tr class="text-center">
                                                        <th>#</th>
                                                        <th>Date & Time</th>
                                                        <th>Type</th>
                                                        <th>Amount</th>
                                                        <th>Balance After</th>
                                                        <th>Remarks</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($transactions as $index => $t)
                                                        <tr>
                                                            <td class="text-center">{{ $index + 1 }}</td>
                                                            <td>{{ $t->created_at->format('d-M-Y') }}</td>

                                                            <td class="text-center">
                                                                @if($t->type == 'credit')
                                                                    <span class="badge bg-success">Credit</span>
                                                                @else
                                                                    <span class="badge bg-danger">Debit</span>
                                                                @endif
                                                            </td>

                                                            <td class="text-end">₹ {{ number_format($t->amount, 2) }}</td>
                                                            <td class="text-end">₹ {{ number_format($t->balance_after, 2) }}</td>
                                                            <td>{{ $t->remarks }}</td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="6" class="text-center text-muted">
                                                                No transactions found.
                                                            </td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>


                                                </table>
                                            </div>
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
		var formData = new FormData(document.getElementById("fund-transfer-to-employee-form"));

		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

		$.ajax({
			type: "POST",
			url: "{{ route('admin.funds.transferFundtoEmployee') }}",
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
						timer: 10000,
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

		$('#user_type').on('change', function () {
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
			let userTypeId = $('#user_type').val();

			$('#user_id').html('<option value="">Loading...</option>');

			if (designationId && userTypeId) {
				$.ajax({
					url: "{{ route('admin.get.employees') }}",
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

@section('script')
    <script>

    </script>
@endsection
