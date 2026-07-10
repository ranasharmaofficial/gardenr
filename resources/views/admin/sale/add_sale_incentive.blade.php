@extends('admin.include.master')
@section('title', 'Sale Incentive')
@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script src="https://unpkg.com/lottie-web@5.12.2/build/player/lottie.min.js"></script>

<!-- Page Header -->
            <div style="background:linear-gradient(45deg, #f33057, rgb( 56, 88, 249 ) );" class="d-sm-flex d-block align-items-center justify-content-between page-header-breadcrumb">
                <div>
                    <h4 class="fw-medium mb-2">Sale Incentive</h4>
                    <div class="ms-sm-1 ms-0">
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a class="" href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item  active fw-normal" aria-current="page">Sale Incentive</li>
                            </ol>
                        </nav>
                    </div>
                </div>

            </div>
            <!-- Page Header Close -->



            <!--APP-CONTENT START-->
            <div class="main-content app-content">
        <div class="row gx-3 mt-3">
            <div class="col-xl-12">
                            <div class="card custom-card">
                                <div class="card-header">
                                    <div class="card-title">
                                        Sale Incentive
									</div>
									{{--<a style="right: 5px;position: absolute;float: right;" href="{{ url('admin/customer') }}" class="btn btn-danger-light btn-wave btn-sm float-right">Customer List</a>--}}
                                </div>

								<form class="card-body" id="product-branch-form" method="post" action="" enctype="multipart/form-data">
                                    @csrf

									<div class="row formtype justify-content-center">
										<div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                <label>Enter Vivah Mitra Code <span class="text-danger">*</span></label>
                                                <input class="form-control" placeholder="Enter Vivah Mitra Code" type="number" name="employee_code" id="employee_code">
											</div>
                                        </div>
										<div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                <button type="button" id="checkEmployeeBtn" class="btn btn-danger mt-3">CHECK</button>
											</div>
                                        </div>


										<div class="col-md-12 text-center mt-3" id="lottie-loader" style="display:none;">
											<div id="lottie-check" style="width:120px;margin:auto;"></div>
											<p class="text-muted mt-2">Checking Vivah Mitra...</p>
										</div>
										<div class="col-md-12 mt-4 " id="employee-card-box" style="display:none;">
											<div class="card shadow border-0" style="background: linear-gradient(135deg, #7f00ff, #e100ff);
color: #fff;">
												<div class="card-body d-flex align-items-center">
													<img id="empPhoto"
														 src=""
														 class="rounded-circle me-4"
														 style="width:90px;height:90px;object-fit:cover;border:3px solid #eee;">

													<div>
														<h5 class="mb-1 text-white" id="empName"></h5>
														<p class="mb-1 text-white"><strong>Code:</strong> <span id="empCode"></span></p>
														<p class="mb-1 text-white"><strong>Mobile:</strong> <span id="empMobile"></span></p>
														<p class="mb-0 text-white"><strong>Address:</strong> <span id="empAddress"></span></p>
														<p class="mb-0 text-white"><strong>Email:</strong> <span id="empEmail"></span></p>
													</div>
												</div>
											</div>
										</div>


									</div>
                                    <div id="incentive-sale-box" style="display:none;" class="row formtype justify-content-center">

										<div style="display:none;" id="show-form-error" class="alert alert-danger col-md-12">
											<ul>
												<div class="errorMsgntainer"></div>
											</ul>
										</div>

										<div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                <label>Enter Membership Number <span class="text-danger">*</span></label>
                                                <input class="form-control" placeholder="Enter Membership Number" type="number" name="membership_number" id="membership_number">
											</div>
                                        </div>

										<div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                <label>Enter Sale Date <span class="text-danger">*</span></label>
                                                <input class="form-control" min="{{ date('Y-m-d') }}" value="{{ date('Y-m-d') }}" type="date" name="sale_date" id="sale_date">
											</div>
                                        </div>

										<div class="col-md-12 mt-3" id="member-card-box" style="display:none;">
											<div class="card shadow-sm border-0 bg-light">
												<div class="card-body d-flex align-items-center">
													<div class="me-3">
														<i class="ri-user-3-line fs-2 text-primary"></i>
													</div>
													<div>
														<h6 class="mb-0" id="memberName"></h6>
														<small class="text-muted">Verified Member</small>
													</div>
												</div>
											</div>
										</div>

										<div class="col-md-4 mb-3">
                                            <div class="form-group">
                                                <label>Select जिला विवाह मित्र  <span class="text-danger">*</span></label>
                                                <select class="form-control" name="district_vivah_mitra" id="district_vivah_mitra">
													<option value="">Select जिला विवाह मित्र</option>
													@foreach($district_vivah_mitra as $dvm)
														<option value="{{ $dvm->id }}">{{ $dvm->first_name }} - {{ $dvm->employee_code }}</option>
													@endforeach
												</select>
											</div>
                                        </div>

										<div class="col-md-4 mb-3">
                                            <div class="form-group">
                                                <label>Select प्रखण्ड विवाह मित्र  <span class="text-danger">*</span></label>
                                                <select class="form-control" name="prakhand_vivah_mitra" id="prakhand_vivah_mitra">
													<option value="">Select प्रखण्ड विवाह मित्र</option>
													@foreach($prakhand_vivah_mitra as $dvm)
														<option value="{{ $dvm->id }}">{{ $dvm->first_name }} - {{ $dvm->employee_code }}</option>
													@endforeach
												</select>
											</div>
                                        </div>

										<div class="col-md-4 mb-3">
                                            <div class="form-group">
                                                <label>Select पंचायत विवाह मित्र  <span class="text-danger">*</span></label>
                                                <select class="form-control" name="panchayat_vivah_mitra" id="panchayat_vivah_mitra">
													<option value="">Select पंचायत विवाह मित्र</option>
													@foreach($panchayat_vivah_mitra as $dvm)
														<option value="{{ $dvm->id }}">{{ $dvm->first_name }} - {{ $dvm->employee_code }}</option>
													@endforeach
												</select>
											</div>
                                        </div>



										<div class="col-md-4 mb-3">
                                            <div class="form-group">
                                                <label>Select Sales Manager <span class="text-danger">*</span></label>
                                                <select class="form-control" name="sales_manager" id="sales_manager">
													<option value="">Select Sales Manager</option>
													@foreach($sales_manager as $sm)
														<option value="{{ $sm->id }}">{{ $sm->first_name }} - {{ $sm->employee_code }}</option>
													@endforeach
												</select>
											</div>
                                        </div>
										<div class="col-md-4 mb-3">
                                            <div class="form-group">
                                                <label>Select Assistant Sales Manager <span class="text-danger">*</span></label>
                                                <select class="form-control" name="assistant_sales_manager" id="assistant_sales_manager">
													<option value="">Select Assistant Sales Manager</option>
													@foreach($assistant_sales_manager as $asm)
														<option value="{{ $asm->id }}">{{ $asm->first_name }} - {{ $asm->employee_code }}</option>
													@endforeach
												</select>
											</div>
                                        </div>
										<div class="col-md-4 mb-3">
                                            <div class="form-group">
                                                <label>Select Field Officer <span class="text-danger">*</span></label>
                                                <select class="form-control" name="field_officer" id="field_officer">
													<option value="">Select Field Officer</option>
													@foreach($field_officer as $fo)
														<option value="{{ $fo->id }}">{{ $fo->first_name }} - {{ $fo->employee_code }}</option>
													@endforeach
												</select>
											</div>
                                        </div>

										<div class="col-md-4 mb-3">
                                            <div class="form-group">
                                                <label>Select Zonal Manager <span class="text-danger">*</span></label>
                                                <select class="form-control" name="zonal_manager" id="zonal_manager">
													<option value="">Select Zonal Manager</option>
													@foreach($zonal_manager as $pe)
														<option value="{{ $pe->id }}">{{ $pe->first_name }} - {{ $pe->employee_code }}</option>
													@endforeach
												</select>
											</div>
                                        </div>

										<div class="col-md-4 mb-3">
                                            <div class="form-group">
                                                <label>Select Peon <span class="text-danger">*</span></label>
                                                <select class="form-control" name="peon" id="peon">
													<option value="">Select Peon</option>
													@foreach($peon as $pe)
														<option value="{{ $pe->id }}">{{ $pe->first_name }} - {{ $pe->employee_code }}</option>
													@endforeach
												</select>
											</div>
                                        </div>





										<div class="col-md-12 mb-3">
											<div class="table-responsive">
												<table class="table table-bordered" id="billingTable">
													<thead class="table-light">
														<tr>
															<th>Sl.</th>
															<th>Category</th>
															<th>Product</th>
															<th>M.R.P/Red</th>
															<th>Blue Price</th>
															<th>Green Price</th>
															<th>Stop Price</th>
															<th>Qty</th>
															<th>Total ₹</th>
															<th>Action</th>
														</tr>
													</thead>
													<tbody>
														<tr>
															<td class="slno">1</td>
															<td>
																<select class="form-control category" name="category[]">
																	<option value="">Select Type</option>
																	@foreach ($categories as $category)
																		@include('admin.product.category.partials.category_options', [
																			'category' => $category,
																			'level' => 0,
																			'data' => $data ?? null
																		])
																	@endforeach
																</select>
															</td>
															<td>
																<select class="form-control product_id" name="product_id[]">
																	<option value="">Select Product</option>
																</select>
															</td>
															<td><input type="text" readonly class="form-control price_80" name="price_80[]"></td>
															<td><input type="text" readonly class="form-control price_62" name="price_62[]"></td>
															<td><input type="text" readonly class="form-control price_50" name="price_50[]"></td>
															<td><input type="text" class="form-control offer_price" name="offer_price[]" ></td>
															<td><input type="number" class="form-control quantity" name="quantity[]" value="1" min="1"></td>

															<td><input type="text" class="form-control total" name="total[]" readonly></td>
															<td><button type="button" class="btn btn-success btn-sm addRow">+</button></td>
														</tr>
													</tbody>
													<tfoot>
														<tr>
															<td colspan="6" class="text-end"><strong>Grand Total:</strong></td>
															<td><input type="text" class="form-control" id="grand_total" name="grand_total" readonly></td>
															<td></td>
														</tr>
														 

													</tfoot>
												</table>
											</div>
											<div class="text-end mt-3 mb-3">
												<button type="submit" class="btn btn-primary transferProduct" id="saleBtn" style="display:none;">Sale</button>
											</div>

                                        </div>
									</div>

								</form>
                            </div>
                        </div>
        </div>
        </div>



	<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<script>
$(document).ready(function() {
	$('.select2').select2({
		placeholder: "Search Branch",
		allowClear: true
	});
});

let checkAnimation = lottie.loadAnimation({
    container: document.getElementById('lottie-check'),
    renderer: 'svg',
    loop: true,
    autoplay: false,
    path: 'https://assets10.lottiefiles.com/packages/lf20_usmfx6bp.json'
});

$(document).ready(function () {

    $('#membership_number').on('blur', function () {

        let membershipNumber = $(this).val();

        if (!membershipNumber) return;

        $('#member-card-box').hide();
        $('#saleBtn').hide();

        $.ajax({
            url: "{{ route('admin.check.membership') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                membership_number: membershipNumber
            },
            success: function (res) {

                if (res.status) {

                    $('#memberName').text(res.data.name);
                    $('#member-card-box').slideDown();
                    $('#saleBtn').fadeIn();

                } else {

                    Swal.fire('Error', res.message, 'error');
                }
            },
            error: function () {
                Swal.fire('Error', 'Unable to verify membership', 'error');
            }
        });
    });

});

$('#membership_number').on('input', function () {
    $('#member-card-box').hide();
    $('#saleBtn').hide();
});
</script>

<script>

	$(document).ready(function () {

    $('#checkEmployeeBtn').click(function () {

        let employeeCode = $('#employee_code').val();

        if (!employeeCode) {
            Swal.fire('Error', 'Please enter Vivah Mitra Code', 'error');
            return;
        }

        // UI Reset
        $('#employee-card-box').hide();
        $('#incentive-sale-box').hide();

        // Show loader
        $('#lottie-loader').fadeIn();
        checkAnimation.play();

        $('#checkEmployeeBtn').prop('disabled', true).text('Checking...');

        $.ajax({
            url: "{{ route('admin.check.employee') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                employee_code: employeeCode
            },
            success: function (res) {

                $('#lottie-loader').fadeOut();
                checkAnimation.stop();

                $('#checkEmployeeBtn').prop('disabled', false).text('CHECK');

                if (res.status) {

                    $('#empName').text(res.data.name);
                    $('#empCode').text(res.data.code);
                    $('#empMobile').text(res.data.mobile);
                    $('#empEmail').text(res.data.email);
                    $('#empAddress').text(res.data.address + ', ' + res.data.district + ', ' + res.data.state);
                    $('#empPhoto').attr('src', res.data.photo);

                    $('#employee-card-box').slideDown();
                    $('#incentive-sale-box').slideDown();

                } else {
                    Swal.fire('Not Found', res.message, 'error');
                }
            },
            error: function () {

                $('#lottie-loader').fadeOut();
                checkAnimation.stop();

                $('#checkEmployeeBtn').prop('disabled', false).text('CHECK');

                Swal.fire('Error', 'Something went wrong', 'error');
            }
        });
    });

});

 $(document).on('click', '.transferProduct', function(e) {
		e.preventDefault();

		Swal.fire({
			title: "Are you sure?",
			text: "Do you really want to Sale products?",
			icon: "warning",
			showCancelButton: true,
			confirmButtonText: "Yes, Sale",
			cancelButtonText: "Cancel",
		}).then((result) => {
			if (result.isConfirmed) {
				// Call function to submit AJAX
				submitProductTransfer();
			}
		});
	});


	function submitProductTransfer() {
		var clk_btn = $(".saveFund");
		clk_btn.prop('disabled', true);
		var formData = new FormData(document.getElementById("product-branch-form"));

		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

		$.ajax({
			type: "POST",
			url: "{{ route('admin.sale.postIncentiveSale') }}",
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




</script>

<script>
$(document).ready(function() {

    // Add new row
    $(document).on('click', '.addRow', function() {
        let row = $('#billingTable tbody tr:first').clone();
        row.find('input').val('');
        row.find('select').val('');
        row.find('.slno').text($('#billingTable tbody tr').length + 1);
        row.find('.addRow').removeClass('btn-success addRow').addClass('btn-danger removeRow').text('-');
        $('#billingTable tbody').append(row);
    });

    // Remove row
    $(document).on('click', '.removeRow', function() {
        $(this).closest('tr').remove();
        updateSlNo();
        calculateGrandTotal();
    });

    function updateSlNo() {
        $('#billingTable tbody tr').each(function(index) {
            $(this).find('.slno').text(index + 1);
        });
    }

    // Product selection
    $(document).on('change', '.product_id', function() {
		let tr = $(this).closest('tr');
		let product_id = $(this).val();

		if (product_id) {
			$.ajax({
				url: "{{ route('admin.get.getBranchProductDetails') }}",
				type: "POST",
				data: {
					product_id: product_id,
					_token: "{{ csrf_token() }}"
				},
				success: function(res) {
					// fill product details
					tr.find('.price_80').val(res.price_80);
					tr.find('.price_62').val(res.price_45);
					tr.find('.price_50').val(res.price_45);
					tr.find('.price_45').val(res.price_45);
					tr.find('.offer_price').val(res.price_45);
					//tr.find('.price').val(res.price);

					// calculate totals
					calculateRowTotal(tr);
					calculateGrandTotal();
				}
			});
		} else {
			// clear row if product not selected
			tr.find('.offer_price, .price, .total').val('');
			tr.find('.quantity').val(1);
			calculateGrandTotal();
		}
	});


	// when type changes
	$(document).on('change', '.category', function() {
		let tr = $(this).closest('tr');
		let category = $(this).val();

		if (category) {
			$.ajax({
				url: "{{ route('admin.getProductListTypeBranchWise') }}",
				type: "POST",
				data: {
					category: category,
					_token: "{{ csrf_token() }}"
				},
				success: function(res) {
					let options = '<option value="">Select Product</option>';
					$.each(res, function(key, val) {
						options += `<option value="${val.product_id}">${val.product_name}</option>`;
					});
					tr.find('.product_id').html(options);

					// clear all input fields when type is changed
					tr.find('.hsn_code, .price, .cgst, .sgst, .cgst_value, .sgst_value, .total').val('');
					tr.find('.quantity').val(1);
					calculateGrandTotal();
				},
				error: function() {
					alert('Error fetching products.');
				}
			});
		} else {
			// reset if no type selected
			tr.find('.product_id').html('<option value="">Select Product</option>');
			tr.find('.hsn_code, .price, .cgst, .sgst, .cgst_value, .sgst_value, .total').val('');
			tr.find('.quantity').val(1);

			calculateGrandTotal();
		}
	});

    // Quantity change
    $(document).on('input', '.quantity', function() {
        let tr = $(this).closest('tr');
        calculateRowTotal(tr);
        calculateGrandTotal();
    });

    // Recalculate all when billing type changes
    $(document).on('change', '#billing_type', function() {
        $('#billingTable tbody tr').each(function() {
            calculateRowTotal($(this));
        });
        calculateGrandTotal();
    });

    function calculateRowTotal(tr) {
        let billingType = $('#billing_type').val();
        let offer_price = parseFloat(tr.find('.offer_price').val()) || 0;
        let qty = parseFloat(tr.find('.quantity').val()) || 1;
        let subtotal = offer_price * qty;

        if (billingType === 'taxable') {
            let cgst = parseFloat(tr.find('.cgst').val()) || 0;
            let sgst = parseFloat(tr.find('.sgst').val()) || 0;
            let cgst_amount = subtotal * (cgst / 100);
            let sgst_amount = subtotal * (sgst / 100);
            let total = subtotal + cgst_amount + sgst_amount;

            tr.find('.cgst_value').val(cgst_amount.toFixed(2));
            tr.find('.sgst_value').val(sgst_amount.toFixed(2));
            tr.find('.total').val(total.toFixed(2));
        } else {
            // Non-tax invoice (no GST)
            tr.find('.cgst_value, .sgst_value').val('0.00');
            tr.find('.total').val(subtotal.toFixed(2));
        }
    }

    function calculateGrandTotal() {
        let grandTotal = 0;
        $('#billingTable tbody tr').each(function() {
            let total = parseFloat($(this).find('.total').val()) || 0;
            grandTotal += total;
        });
        $('#grand_total').val(grandTotal.toFixed(2));
    }

});

</script>


@endsection


