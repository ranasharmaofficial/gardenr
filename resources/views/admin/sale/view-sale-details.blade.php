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
						<div class="card mb-3">
							<div class="card-header">
								<h5 class="card-title mb-0">Sale Details</h5>
							</div>

							<div class="card-body">
								<div class="row mb-2">
									<div class="col-md-4"><b>Sale ID:</b> {{ $sale->id }}</div>
									<div class="col-md-4"><b>Sale Type:</b> {{ ucfirst(str_replace('_',' ', $sale->sale_type)) }}</div>
									<div class="col-md-4"><b>Sale Date:</b> {{ $sale->sale_date }}</div>
								</div>

								<div class="row mb-2">
									<div class="col-md-4"><b>Total Amount:</b> ₹{{ number_format($sale->total_amount,2) }}</div>
									<div class="col-md-4"><b>Incentive Amount:</b> ₹{{ number_format($sale->incentive_amount,2) }}</div>
									<div class="col-md-4"><b>Branch:</b> {{ $sale->branch }}</div>
								</div>
							</div>
						</div>

						<!-- Sale Items -->
						<div class="card">
							<div class="card-header">
								<h5 class="card-title mb-0">Sale Items</h5>
							</div>

							<div class="card-body table-responsive">
								<table class="table table-bordered table-striped">
									<thead class="table-dark">
										<tr>
											<th>#</th>
											<th>Product</th>
											<th>Price</th>
											<th>Offer Price</th>
											<th>Qty</th>
											<th>Total</th>
										</tr>
									</thead>

									<tbody>
										@forelse($saleItems as $key => $item)
											<tr>
												<td>{{ $key + 1 }}</td>
												<td>{{ $item->product_name ?? 'N/A' }}</td>
												<td>₹{{ number_format($item->price,2) }}</td>
												<td>₹{{ number_format($item->offer_price,2) }}</td>
												<td>{{ $item->quantity }}</td>
												<td>₹{{ number_format($item->total,2) }}</td>
											</tr>
										@empty
											<tr>
												<td colspan="6" class="text-center text-danger">
													No items found
												</td>
											</tr>
										@endforelse
									</tbody>

									<tfoot>
										<tr>
											<th colspan="5" class="text-end">Grand Total</th>
											<th>₹{{ number_format($sale->total_amount,2) }}</th>
										</tr>
									</tfoot>
								</table>
							</div>
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
					tr.find('.offer_price').val(res.offer_price);
					tr.find('.price').val(res.price);
					 
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

 
