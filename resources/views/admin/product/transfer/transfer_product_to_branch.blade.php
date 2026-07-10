@extends('admin.include.master')
@section('title', 'Transfer for Product to Branch')
@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<!-- Page Header -->
            <div style="background:linear-gradient(45deg, #f33057, rgb( 56, 88, 249 ) );" class="d-sm-flex d-block align-items-center justify-content-between page-header-breadcrumb">
                <div>
                    <h4 class="fw-medium mb-2">Transfer for Product to Branch</h4>
                    <div class="ms-sm-1 ms-0">
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a class="" href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item  active fw-normal" aria-current="page">Transfer for Product to Branch</li>
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
                                        Transfer Product to Branch
									</div>
									<a style="right: 5px;position: absolute;float: right;" href="{{ url('admin/customer') }}" class="btn btn-danger-light btn-wave btn-sm float-right">Customer List</a>
                                </div>

								<form class="card-body" id="product-branch-form" method="post" action="" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row formtype justify-content-center">
										<div class="col-md-12 mt-3 mb-3">
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

										<div style="display:none;" id="show-form-error" class="alert alert-danger col-md-12">
											<ul>
												<div class="errorMsgntainer"></div>
											</ul>
										</div>

										<div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                <label>Select Branch</label>
                                                <select class="form-control select2" placeholder="Enter Domain Name" name="branch">
													<option value="">Select Branch</option>
													@foreach($branch_list as $val)
														<option value="{{ $val->id }}">{{ $val->name.' - '.$val->code }}</option>
													@endforeach
												</select>
                                            </div>
                                        </div>

										<div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                <label>Enter Transfer Date <span class="text-danger">*</span></label>
                                                <input class="form-control" min="{{ date('Y-m-d') }}" value="{{ date('Y-m-d') }}" type="date" name="transfer_date" id="transfer_date">
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
															<th>Price with Green sell 45%</th>
															<th>Price with Blue sell 50%</th>
															<th>Price with Red sell 62%</th>
															<th>Price with MRP + 80%</th>
															<th>Qty</th>
															<th>Stock</th>
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
															<td><input type="text" placeholder="Price with Green sell 45%" class="form-control price_45" name="price_45[]"></td>
															<td><input type="text" placeholder="Price with Blue sell 50%" class="form-control price_50" name="price_50[]" ></td>
															<td><input type="text" placeholder="Price with Red sell 62%" class="form-control price_62" name="price_62[]" ></td>
															<td><input type="text" placeholder="Price with MRP + 80%" class="form-control price_80" name="price_80[]" ></td>
															<td><input type="number" class="form-control quantity" readonly name="quantity[]" value="1" min="1"></td>
															<td><input type="number" class="form-control stock" name="stock[]" value="1" min="1"></td>
															<td><input type="text" class="form-control total" name="total[]" readonly></td>
															<td><button type="button" class="btn btn-success btn-sm addRow">+</button></td>
														</tr>
													</tbody>
													<tfoot>
														<tr>
															<td colspan="7" class="text-end"><strong>Grand Total:</strong></td>
															<td><input type="text" class="form-control" id="grand_total" name="grand_total" readonly></td>
															<td></td>
														</tr>
														{{--
                                                        <tr>
															<td colspan="7" class="text-end"><strong>Advance Payment:</strong></td>
															<td><input type="number" class="form-control" id="advance_payment" name="advance_payment" ></td>
															<td></td>
														</tr>

                                                        <tr>
															<td colspan="7" class="text-end"><strong>Payment Next Due Date:</strong></td>
															<td><input type="date" class="form-control" id="next_due_date" name="next_due_date" ></td>
															<td></td>
														</tr>
														--}}

													</tfoot>
												</table>
											</div>
											<div class="text-end mt-3 mb-3">
												<button type="submit" class="btn btn-primary transferProduct">Transfer Now</button>
											</div>

                                        </div>
									</div>

								</form>
                            </div>
                        </div>
        </div>
        </div>



	{{--<script src="https://code.jquery.com/jquery-3.4.1.js"></script>--}}
	<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "Search Branch",
            allowClear: true
        });
    });
</script>

<script>

 $(document).on('click', '.transferProduct', function(e) {
		e.preventDefault();

		Swal.fire({
			title: "Are you sure?",
			text: "Do you really want to transfer products?",
			icon: "warning",
			showCancelButton: true,
			confirmButtonText: "Yes, Transfer",
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
			url: "{{ route('admin.products.transferProductsToBranch') }}",
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
				url: "{{ route('admin.get.product.details') }}",
				type: "POST",
				data: {
					product_id: product_id,
					_token: "{{ csrf_token() }}"
				},
				success: function(res) {
					// fill product details

					tr.find('.price_45').val(res.price_45);
					tr.find('.price_50').val(res.price_50);
					tr.find('.price_62').val(res.price_62);
					tr.find('.price_80').val(res.price_80);

					// calculate totals
					calculateRowTotal(tr);
					calculateGrandTotal();
				}
			});
		} else {
			// clear row if product not selected
			tr.find('.price_45, .price_50, .price_62, .price_80, .total').val('');
			tr.find('.quantity').val(1);
			tr.find('.stock').val(1);
			calculateGrandTotal();
		}
	});


	// when type changes
	$(document).on('change', '.category', function() {
		let tr = $(this).closest('tr');
		let category = $(this).val();

		if (category) {
			$.ajax({
				url: "{{ route('admin.getProductListTypeWise') }}",
				type: "POST",
				data: {
					category: category,
					_token: "{{ csrf_token() }}"
				},
				success: function(res) {
					let options = '<option value="">Select Product</option>';
					$.each(res, function(key, val) {
						options += `<option value="${val.id}">${val.name}</option>`;
					});
					tr.find('.product_id').html(options);

					// clear all input fields when type is changed
					tr.find('.hsn_code, .price, .cgst, .sgst, .cgst_value, .sgst_value, .total').val('');
					tr.find('.quantity').val(1);
					tr.find('.stock').val(1);
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
			tr.find('.stock').val(1);
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
        let price = parseFloat(tr.find('.price').val()) || 0;
        let qty = parseFloat(tr.find('.quantity').val()) || 1;
        let subtotal = price * qty;

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


