@extends('admin.include.master')
@section('title')
	{{ $page_title }}
@endsection
@section('content')

<style>

    .shop-header-card{
        background:#fff;
        border-radius:20px;
        padding:20px;
        margin-bottom:25px;
        box-shadow:0 5px 20px rgba(0,0,0,0.06);
        border:1px solid #ececec;
    }

    .shop-image img{
        width:100%;
        height:220px;
        object-fit:cover;
        border-radius:18px;
        border:3px solid #fff;
        box-shadow:0 5px 15px rgba(0,0,0,0.08);
    }

    .shop-title{
        font-size:32px;
        font-weight:800;
        color:#071c4d;
        margin-bottom:15px;
    }

    .shop-info{
        font-size:18px;
        font-weight:600;
        color:#555;
        margin-bottom:10px;
    }

    .status-badge{
        display:inline-block;
        padding:8px 20px;
        border-radius:30px;
        color:#fff;
        font-weight:700;
        font-size:14px;
    }

    .active{
        background:linear-gradient(135deg,#20bf55,#01baef);
    }

    .blocked{
        background:linear-gradient(135deg,#ff4d4d,#d10000);
    }

    .info-mini-box{
        background:#f8f9ff;
        border-radius:16px;
        padding:15px;
        text-align:center;
        border:1px solid #e3e8ff;
        height:100%;
    }

    .mini-title{
        font-size:15px;
        color:#666;
        margin-bottom:8px;
        font-weight:600;
    }

    .mini-value{
        font-size:24px;
        font-weight:800;
        color:#111;
    }

    .product-card{
        background:#fff;
        border-radius:18px;
        padding:15px;
        border:1px solid #ececec;
        box-shadow:0 3px 10px rgba(0,0,0,0.05);
        height:100%;
        transition:0.3s;
    }

    .product-card:hover{
        transform:translateY(-4px);
    }

    .product-image img{
        width:100%;
        height:220px;
        object-fit:cover;
        border-radius:14px;
    }

    .product-name{
        font-size:20px;
        font-weight:700;
        margin-top:15px;
        color:#111;
    }

    .product-detail{
        font-size:14px;
        color:#666;
        margin-bottom:8px;
        font-weight:600;
    }

    .price{
        font-size:18px;
        font-weight:800;
        color:#28a745;
    }

    .product-status{
        display:inline-block;
        padding:6px 14px;
        border-radius:30px;
        color:#fff;
        font-size:12px;
        font-weight:700;
    }

    .in-stock{
        background:#28c76f;
    }

    .out-stock{
        background:#ea5455;
    }

    .page-heading{
        font-size:28px;
        font-weight:800;
        margin-bottom:25px;
        color:#071c4d;
    }

    @media(max-width:767px){

        .shop-title{
            font-size:24px;
            margin-top:15px;
        }

        .shop-info{
            font-size:15px;
        }

        .mini-value{
            font-size:18px;
        }

        .product-image img{
            height:180px;
        }

    }

</style>
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
								<h2 class="page-heading">
        {{ $page_title }}
    </h2>

    <!-- SHOP INFO -->
    <div class="shop-header-card">

        <div class="row align-items-center">

            <div class="col-md-3">
                <div class="shop-image">
                    <img src="{{ static_asset($shop->investor_photo) }}">
                </div>
            </div>

            <div class="col-md-5">

                <h2 class="shop-title">
                    {{ $shop->name }}
                </h2>

                <div class="shop-info">
                    👤 Investor :
                    <strong>{{ $shop->investor_name }}</strong>
                </div>

                <div class="shop-info">
                    📅 Opening Date :
                    <strong>
                        {{ date('d M, Y', strtotime($shop->opening_date)) }}
                    </strong>
                </div>

                <div class="shop-info">
                    📍 Shop Address :
                    <strong>{{ $shop->address ?? 'N/A' }}</strong>
                </div>

                <span class="status-badge {{ $shop->shop_status == 'active' ? 'active' : 'blocked' }}">
                    {{ ucfirst($shop->shop_status) }}
                </span>

            </div>

            <div class="col-md-4">

                <div class="row">

                    <div class="col-6 mb-3">
                        <div class="info-mini-box">
                            <div class="mini-title">
                                Total Products
                            </div>

                            <div class="mini-value">
                                {{ count($products) }}
                            </div>
                        </div>
                    </div>

                    <div class="col-6 mb-3">
                        <div class="info-mini-box">
                            <div class="mini-title">
                                Total Sell
                            </div>

                            <div class="mini-value">
                                {{ $products->where('status','sold')->count() }}
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="info-mini-box">
                            <div class="mini-title">
                                Pending Products
                            </div>

                            <div class="mini-value">
                                {{ $products->where('status','pending')->count() }}
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="info-mini-box">
                            <div class="mini-title">
                                Profit Amount
                            </div>

                            <div class="mini-value">
                                ₹ {{ number_format($products->sum('profit_amount')) }}
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>



    <!-- PRODUCT LIST -->
    <div class="row">

        @forelse($products as $product)

        <div class="col-md-3 col-sm-6 mb-4">

            <div class="product-card">

                <div class="product-image">
                    <img src="{{ static_asset($product->thumbnail) }}">
                </div>

                <div class="product-name">
                    {{ $product->name }}
                </div>

                <div class="product-detail">
                    Category :
                    <strong>{{ $product->category_name }}</strong>
                </div>

                <div class="product-detail">
                    Brand :
                    <strong>{{ $product->brand_name }}</strong>
                </div>

                <div class="product-detail">
                    Product Code :
                    <strong>{{ $product->product_code }}</strong>
                </div>

                <div class="product-detail">
                    Quantity :
                    <strong>{{ $product->quantity }}</strong>
                </div>

                <div class="product-detail">
                    Stop Price 45%:
                    <span class="price">
                        ₹ {{ number_format($product->price_45) }}
                    </span>
                </div>
				
				<div class="product-detail">
                    Green Price 50%:
                    <span class="price">
                        ₹ {{ number_format($product->price_50) }}
                    </span>
                </div>
				
				<div class="product-detail">
                    Blue Price 62%:
                    <span class="price">
                        ₹ {{ number_format($product->price_50) }}
                    </span>
                </div>
				
				<div class="product-detail">
                    Red Price 80%:
                    <span class="price">
                        ₹ {{ number_format($product->price_80) }}
                    </span>
                </div>

                <div class="mt-3 d-flex justify-content-between align-items-center">

                    <span class="product-status {{ $product->status == 'sold' ? 'in-stock' : 'out-stock' }}">
                        {{ ucfirst($product->status) }}
                    </span>

                    <a href="{{ url('admin/product/edit/'.$product->id) }}"
                       class="btn btn-primary btn-sm">
                        View
                    </a>

                </div>

            </div>

        </div>

        @empty

        <div class="col-md-12">
            <div class="alert alert-danger">
                No Products Found
            </div>
        </div>

        @endforelse

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

