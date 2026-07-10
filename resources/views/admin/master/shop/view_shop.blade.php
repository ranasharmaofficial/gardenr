@extends('admin.include.master')
@section('title')
	{{ $page_title }}
@endsection
@section('content')

<style>
    .shop-card-modern{
    background:#fff;
    border-radius:20px;
    padding:15px;
    border:1px solid #ddd6ff;
    box-shadow:0 4px 15px rgba(0,0,0,0.06);
    overflow:hidden;
    margin-bottom:15px;
}

.shop-left{
    background:#fafaff;
    border-radius:16px;
    padding:14px;
    border:1px solid #ece8ff;
    height:100%;
}

.shop-image img{
    width:100%;
    height:220px;
    object-fit:cover;
    border-radius:16px;
    border:3px solid #fff;
}

.shop-main-title{
    font-size:22px;
    font-weight:700;
    margin-top:12px;
    color:#071c4d;
    margin-bottom:8px;
}

.shop-info-line{
    font-size:16px;
    color:#444;
    margin-bottom:6px;
    font-weight:600;
}

.status-badge{
    display:inline-block;
    padding:7px 16px;
    border-radius:30px;
    color:#fff;
    font-size:14px;
    font-weight:700;
    margin-top:8px;
}

.active{
    background:linear-gradient(135deg,#20bf55,#01baef);
}

.blocked{
    background:linear-gradient(135deg,#ff4d4d,#d10000);
}

.info-box{
    border-radius:16px;
    padding:12px;
    background:#fff;
    border:1px solid #ececec;
    margin-bottom:12px;
    min-height:100px;
    transition:0.3s;
}

.info-box:hover{
    transform:translateY(-2px);
    box-shadow:0 4px 15px rgba(0,0,0,0.06);
}

.box-purple{
    background:#faf7ff;
    border-color:#dccfff;
}

.box-pink{
    background:#fff7fb;
    border-color:#ffd3ea;
}

.box-blue{
    background:#f7fbff;
    border-color:#cfe2ff;
}

.box-orange{
    background:#fff9f4;
    border-color:#ffd7bc;
}

.box-green{
    background:#f7fff9;
    border-color:#c9f1d7;
}

.box-cyan{
    background:#f3feff;
    border-color:#c9f6ff;
}

.number-badge{
    width:42px;
    height:42px;
    border-radius:12px;
    color:#fff;
    font-size:22px;
    font-weight:700;
    display:flex;
    align-items:center;
    justify-content:center;
    margin-right:12px;
    flex-shrink:0;
}

.bg-purple{
    background:linear-gradient(135deg,#7b5cff,#5f27cd);
}

.bg-pink{
    background:linear-gradient(135deg,#ff4da6,#ff0080);
}

.bg-blue{
    background:linear-gradient(135deg,#2196f3,#005bea);
}

.bg-orange{
    background:linear-gradient(135deg,#ff9f43,#ff6b00);
}

.bg-green{
    background:linear-gradient(135deg,#20bf55,#01baef);
}

.bg-cyan{
    background:linear-gradient(135deg,#0abde3,#10ac84);
}

.info-title{
    font-size:15px;
    color:#666;
    margin-bottom:3px;
    font-weight:600;
}

.info-value{
    font-size:18px;
    font-weight:700;
    color:#111;
    line-height:1.3;
}

.view-btn{
    padding:8px 16px;
    border-radius:10px;
    font-size:14px;
    font-weight:700;
    text-decoration:none;
    color:#fff;
    display:inline-block;
}

.btn-blue{
    background:linear-gradient(135deg,#3a7bff,#2952ff);
}

.btn-orange{
    background:linear-gradient(135deg,#ff9800,#ff5722);
}

.btn-green{
    background:linear-gradient(135deg,#28c76f,#00b894);
}

.agreement-box{
    border-radius:14px;
    padding:12px;
    margin-top:12px;
    margin-bottom:10px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    font-size:15px;
    font-weight:600;
}

.agreement-blue{
    background:#eef4ff;
    border:1px solid #cfe0ff;
    color:#1d4ed8;
}

.agreement-green{
    background:#f0fff5;
    border:1px solid #b9f3c8;
    color:#0d8a3f;
}

.bottom-bar{
    margin-top:15px;
    background:#fff;
    border-radius:16px;
    padding:14px;
    border:1px solid #ece8ff;
}

.edit-btn{
    background:linear-gradient(135deg,#4f7cff,#6a5cff);
    color:#fff;
    border:none;
    padding:10px 22px;
    border-radius:12px;
    font-size:15px;
    font-weight:700;
    text-decoration:none;
    display:inline-block;
}

.created-date{
    margin-top:12px;
    font-size:14px;
    color:#777;
    font-weight:600;
}

@media(max-width:991px){

    .shop-image img{
        height:180px;
    }

    .shop-main-title{
        font-size:20px;
    }

    .info-value{
        font-size:16px;
    }

    .info-box{
        min-height:auto;
    }

}

@media(max-width:767px){

    .shop-card-modern{
        padding:10px;
    }

    .shop-left{
        margin-bottom:12px;
    }

    .shop-main-title{
        font-size:18px;
    }

    .shop-info-line{
        font-size:14px;
    }

    .number-badge{
        width:36px;
        height:36px;
        font-size:18px;
    }

    .info-title{
        font-size:13px;
    }

    .info-value{
        font-size:15px;
    }

    .view-btn,
    .edit-btn{
        padding:7px 14px;
        font-size:13px;
    }

    .agreement-box{
        font-size:13px;
        padding:10px;
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

									@foreach ($shop_list as $value)
									@php
										$productCount = \App\Models\Product::where('shop_id', $value->id)->count();
										$productSaleCount = \App\Models\Product::where('shop_id', $value->id)->sum('num_of_sale');
										$profitAmount = \DB::table('sale_items')
												->join('products', 'products.id', '=', 'sale_items.product_id')
												->where('products.shop_id', $value->id)
												->selectRaw('
													SUM(
														(sale_items.offer_price - products.purchase_price)
														* sale_items.quantity
													) as total_profit
												')
												->value('total_profit');
									@endphp
									<div class="col-sm-12 mb-5">
									   <div class="shop-card-modern">
										  <div class="row">
											 <!-- LEFT -->
											 <div class="col-md-4 mb-4">
												<div class="shop-left">
												   <div class="shop-image">
													  <img src="{{ static_asset($value->investor_photo) }}">
												   </div>
												   <h2 class="shop-main-title">
													  {{ $value->name }}
												   </h2>
												   <div class="shop-info-line">
													  👤 {{ $value->investor_name }}
												   </div>
												   <div class="shop-info-line">
													  📅 {{ date('d M, Y', strtotime($value->opening_date)) }}
												   </div>
												   <span class="status-badge {{ $value->shop_status == 'active' ? 'active' : 'blocked' }}">
												   {{ ucfirst($value->shop_status) }}
												   </span>
												   <!-- Agreements -->
												   <div class="agreement-box agreement-blue mt-4">
													  <span>📄 10. Digital Agreement</span>
													  <a href="{{ static_asset($value->investor_agreement) }}"
														 target="_blank"
														 class="view-btn btn-blue">
													  View
													  </a>
												   </div>
												   <div class="agreement-box agreement-green">
													  <span>📑 11. Physical Agreement</span>
													  <a href="#"
														 class="view-btn btn-green">
													  View
													  </a>
												   </div>
												</div>
											 </div>
											 <!-- RIGHT -->
											 <div class="col-md-8">
												<div class="row">
												   <!-- 1 -->
												   <div class="col-md-6">
													  <div class="info-box box-purple">
														 <div class="d-flex align-items-center">
															<div class="number-badge bg-purple">
															   1
															</div>
															<div>
															   <div class="info-title">
																  Shop Name
															   </div>
															   <div class="info-value">
																  {{ $value->name }}
															   </div>
															</div>
														 </div>
													  </div>
												   </div>
												   <!-- 2 -->
												   <div class="col-md-6">
													  <div class="info-box box-pink">
														 <div class="d-flex align-items-center">
															<div class="number-badge bg-pink">
															   2
															</div>
															<div>
															   <div class="info-title">
																  Investor Name
															   </div>
															   <div class="info-value">
																  {{ $value->investor_name }}
															   </div>
															</div>
														 </div>
													  </div>
												   </div>
												   <!-- 3 -->
												   <div class="col-md-6">
													  <div class="info-box box-blue">
														 <div class="d-flex align-items-center">
															<div class="number-badge bg-blue">
															   3
															</div>
															<div>
															   <div class="info-title">
																  Invest Amount
															   </div>
															   <div class="info-value">
																  ₹ {{ number_format($value->invest_amount ?? 0) }}
															   </div>
															</div>
														 </div>
													  </div>
												   </div>
												   <!-- 4 -->
												   <div class="col-md-6">
													  <div class="info-box box-orange">
														 <div class="d-flex align-items-center">
															<div class="number-badge bg-orange">
															   4
															</div>
															<div>
															   <div class="info-title">
																  Opening Date
															   </div>
															   <div class="info-value">
																  {{ date('d M, Y', strtotime($value->opening_date)) }}
															   </div>
															</div>
														 </div>
													  </div>
												   </div>
												   <!-- 5 -->
												    @php
														$openingDate = \Carbon\Carbon::parse($value->opening_date);
														$now = \Carbon\Carbon::now();

														$years = $openingDate->diffInYears($now);
														$months = $openingDate->copy()->addYears($years)->diffInMonths($now);
													@endphp

													 
												   <div class="col-md-6">
													  <div class="info-box box-green">
														 <div class="d-flex align-items-center">
															<div class="number-badge bg-green">
															   5
															</div>
															<div>
															   <div class="info-title">
																  Shop Age
															   </div>
															   <div class="info-value">
																  {{ $years }} Years {{ $months }} Months
															   </div>
															</div>
														 </div>
													  </div>
												   </div>
												   <!-- 6 -->
												   <div class="col-md-6">
													  <div class="info-box box-cyan">
														 <div class="d-flex justify-content-between align-items-center">
															<div class="d-flex align-items-center">
															   <div class="number-badge bg-cyan">
																  6
															   </div>
															   <div>
																  <div class="info-title">
																	 Total Products
																  </div>
																  <div class="info-value">
																	{{ $productCount }}
																  </div>
															   </div>
															</div>
															<a href="{{ url('admin/show-products-shop-wise/'.$value->id) }}" class="view-btn btn-blue">
																View
															</a>
														 </div>
													  </div>
												   </div>
												   <!-- 7 -->
												   <div class="col-md-6">
													  <div class="info-box box-blue">
														 <div class="d-flex justify-content-between align-items-center">
															<div class="d-flex align-items-center">
															   <div class="number-badge bg-blue">
																  7
															   </div>
															   <div>
																  <div class="info-title">
																	 Total Sell Products
																  </div>
																  <div class="info-value">
																  {{ $productSaleCount }}
																  </div>
															   </div>
															</div>
															<a href="#" class="view-btn btn-blue">
															View
															</a>
														 </div>
													  </div>
												   </div>
												   <!-- 8 -->
												   <div class="col-md-6">
													  <div class="info-box box-orange">
														 <div class="d-flex justify-content-between align-items-center">
															<div class="d-flex align-items-center">
															   <div class="number-badge bg-orange">
																  8
															   </div>
															   <div>
																  <div class="info-title">
																	 Total Pending Products
																  </div>
																  <div class="info-value">
																	 4
																  </div>
															   </div>
															</div>
															<a href="#" class="view-btn btn-orange">
															View
															</a>
														 </div>
													  </div>
												   </div>
												   <!-- 9 -->
												   <div class="col-md-12">
													  <div class="info-box box-purple">
														 <div class="d-flex justify-content-between align-items-center">
															<div class="d-flex align-items-center">
															   <div class="number-badge bg-purple">
																  9
															   </div>
															   <div>
																  <div class="info-title">
																	 Profitable Amount
																  </div>
																  <div class="info-value">
																	 ₹ {{ number_format($profitAmount) }}
																  </div>
															   </div>
															</div>
															<a href="{{ url('admin/view-shop-products-profit/'.$value->id) }}" class="view-btn btn-blue">
															View
															</a>
														 </div>
													  </div>
												   </div>
												</div>
											 </div>
										  </div>
										  <!-- Bottom -->
										  <div class="bottom-bar">
											 <div class="row align-items-center">
												<div class="col-md-4 mb-3 mb-md-0">
												   <a href="{{ static_asset($value->investor_agreement) }}"
													  target="_blank"
													  class="view-btn btn-orange">
												   📄 Agreement
												   </a>
												</div>
												<div class="col-md-4 text-center mb-3 mb-md-0">
												   <h2 style="font-weight:800;color:#071c4d;">
													  Total Products : {{ $productCount }}
												   </h2>
												</div>
												<div class="col-md-4 text-md-end">
												   <a href="{{ url('admin/shop/edit/'.$value->id) }}"
													  class="edit-btn">
												   ✏️ Edit
												   </a>
												</div>
											 </div>
										  </div>
										  <div class="created-date">
											 📅 Created :
											 {{ convert_datetime_to_date_format($value->created_at, 'd M Y') }}
										  </div>
									   </div>
									</div>
									@endforeach

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

