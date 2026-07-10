@extends('admin.include.master')
@section('title')
	{{ $page_title }}
@endsection
@section('content')

			<!-- Page Header -->
            <div style="background:linear-gradient(45deg, #f33057, rgb( 56, 88, 249 ) );" class="d-sm-flex d-block align-items-center justify-content-between page-header-breadcrumb">
                <div>
                    <h4 class="fw-medium mb-2">{{ $page_title }}</h4>
                    <div class="ms-sm-1 ms-0">
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a class="" href="javascript:void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item  active fw-normal" aria-current="page">{{ $page_title }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>

            </div>
            <!-- Page Header Close -->



            <!--APP-CONTENT START-->
            <div class="main-content app-content">
                <div class="container-fluid">
				<!-- Start:: row-2 -->
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card custom-card">
                            <div class="card-header d-flex justify-content-between align-items-center">

								<h5 class="mb-0">{{ $page_title }}</h5>

								<a href="javascript:void(0)"
								   class="btn btn-danger btn-sm float-end"
								   data-bs-toggle="modal"
								   data-bs-target="#tncVideoModal"
								   onclick="openAddTncVideoModal()">
								   Add Shop
								</a>


							</div>


                            <div class="card-body">

							<div class="container">
							{{--<form id="filterForm">
									<div class="row">
										<div class="col-md-4 mb-3">
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
								</form>--}}
								
								<div class="row">
									<div class="col-sm-12 mb-5">
										<div class="table-responsive">
											<table class="table table-bordered">
												<thead>
													<tr>
														<th>Product</th>
														<th>Purchase Price</th>
														<th>Sale Price</th>
														<th>Quantity</th>
														<th>Profit / Product</th>
														<th>Total Profit</th>
													</tr>
												</thead>
												<tbody>
													@foreach($products as $product)
													<tr>
														<td>{{ $product->name }}</td>
														<td>₹{{ $product->purchase_price }}</td>
														<td>₹{{ $product->offer_price }}</td>
														<td>{{ $product->quantity }}</td>
														<td>
															₹{{ $product->profit_per_product }}
														</td>
														<td>
															₹{{ $product->total_profit }}
														</td>
													</tr>
													@endforeach
												</tbody>
											</table>	
										</div>	
										<h4 class="mt-3 text-center">Total Profit : ₹{{ number_format($grandProfit, 2) }}</h4>
									</div>
								</div>


							</div>
							
							
							 



                            </div>
                        </div>
                    </div>
                </div>
                <!-- End:: row-2 -->



                </div>
            </div>
            <!--APP-CONTENT CLOSE-->

		<!-- Agreement Modal -->
		<div class="modal fade" id="tncVideoModal" tabindex="-1">
		  <div class="modal-dialog modal-lg">
			<form class="modal-content" id="offer-Form" enctype="multipart/form-data">
				<div class="modal-header">
					<h5 class="modal-title" id="tncVideoModalTitle">Add Shop</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				</div>

				<div class="modal-body">

					<div style="display:none;" id="show-form-error" class="alert alert-danger col-md-12">
						<ul>
							<div class="errorMsgntainer"></div>
						</ul>
					</div>

					<input type="hidden" id="offer_id">

					<div class="row">

						<div class="col-md-6 mb-3">
							<label class="">Shop Name <span class="text-danger">*</span></label>
							<input type="text" name="name" id="name" class="form-control" placeholder="Title">
						</div>

						<div class="col-md-6 mb-3">
							<label class="">Investor Name <span class="text-danger">*</span></label>
							<input type="text" name="investor_name" id="investor_name" class="form-control" placeholder="Investor Name">
						</div>

						<div class="col-md-6 mb-3">
							<label class="">Opening Date <span class="text-danger">*</span> <span class="text-danger">*</span> <span class="text-danger">*</span> <span class="text-danger">*</span></label>
							<input type="date" name="opening_date" id="opening_date" class="form-control">
						</div>

						<div class="col-md-6 mb-3">
							<label class="">No. of Stock <span class="text-danger">*</span> <span class="text-danger">*</span> <span class="text-danger">*</span></label>
							<input type="text" name="stock" id="stock" class="form-control" placeholder="No. of Stock">
						</div>

						<div class="col-md-6 mb-3">
							<label class="">Profit <span class="text-danger">*</span> <span class="text-danger">*</span></label>
							<input type="text" name="profit" id="profit" class="form-control" placeholder="Profit">
						</div>

						<div class="col-md-6 mb-3">
							<label class="">Shop Status <span class="text-danger">*</span></label>
							<select id="shop_status" name="shop_status" class="form-control">
								<option value="">Shop Status</option>
								<option value="average">Average</option>
								<option value="loss">Loss</option>
								<option value="profitable">Profitable</option>
								<option value="super_duper_idea">Super Duper Idea</option>
							</select>
						</div>

						<div class="col-md-6 mb-3">
							<label class="">Investor Photo (Photo only) <span class="text-danger">*</span></label>
							<input type="file" name="investor_photo" accept="image/*" id="investor_photo" class="form-control">
						</div>

						<div class="col-md-6 mb-3">
							<label class="">Investor Agreement (PDF only) <span class="text-danger">*</span></label>
							<input type="file" name="investor_agreement" accept="application/pdf" id="investor_agreement" class="form-control">
						</div>

					</div>

				</div>

			  <div class="modal-footer">
				<button class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
				<button type="button" class="btn btn-primary saveOfferBtn" id="saveOfferBtn">
					Save
				</button>
				<button class="btn btn-primary updateOfferBtn" id="updateOfferBtn" style="display:none;">Update</button>
			  </div>

			</form>
		  </div>
		</div>




<script>
function openAddTncVideoModal() {
    $('#offer_id').val('');
    $('#offer_name').val('');
    $('#agreement_file').val('');
    $('#offer_status').val('1');

    $("#tncVideoModalTitle").text("Add Shop");
    $('#saveOfferBtn').show();
    $('#updateDesignationBtn').hide();

    $("#offerError").addClass("d-none").html("");
}

	$(document).on('click', '.saveOfferBtn', function(e) {
		e.preventDefault();
        var clk_btn = $(".saveOfferBtn");
        clk_btn.prop('disabled', true);
        var formData = new FormData(document.getElementById("offer-Form"));
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: "{{ route('admin.shop.store') }}",
            data: formData,
            processData: false,
            contentType: false,
            dataType: "JSON",
			success: function(data) {
                console.log('status ' + data.status);
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
                } else {
                    Swal.fire({
						icon: "error",
						title: "Oh No!",
						text: "Something went wrong!",
						timer: 1500,
						showConfirmButton: false
					});
					//toastr.error('Something went wrong.');
                }
            }, error: function(err) {
				document.getElementById('show-form-error').style = "display: block";
                clk_btn.prop('disabled', false);
                let error = err.responseJSON;
                console.log(error);
                $.each(error.errors, function(index, value) {
                    $('.errorMsgntainer').append('<span class="text-danger">' + value +

                        '<span>' + '<br>');
                });
			}
        });
    });

	$(document).ready(function () {
		$('#agreement_type').on('change', function () {
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
	});

function editAgreement(id){

    $("#offerError").addClass("d-none").html("");

    $.ajax({
        url: "{{ url('admin/designations/edit') }}/" + id,
        type: "GET",

        success: function(res){

            $('#offer_id').val(res.id);
            $('#offer_name').val(res.name);
            $('#offer_status').val(res.status);

            $("#tncVideoModalTitle").text("Edit Offer");

            $('#saveOfferBtn').hide();
            $('#updateOfferBtn').show();

            $('#tncVideoModal').modal('show');
        }
    });
}
 
	/* fetching agreement data area start */

 function fetchUsers(page = 1) {
        // let type = $('#type').val();
        let search = $('#search').val();

        $.ajax({
            url: "{{ route('admin.shop.fetch') }}?page=" + page,
            method: "GET",
            data: {
                // type,
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
    // $('#type').change(function () {
        // fetchUsers();
    // });

    // Trigger on search
    $('#search').on('keyup', function () {
        fetchUsers();
    });

    // Reset filters
    $('#resetSearchBtn').on('click', function (e) {
        e.preventDefault();
        // $('#type').val('');
        $('#search').val('');
        fetchUsers();
    });

	/* fetching agreement data area end */





</script>




@endsection

