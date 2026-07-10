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
                                <a href="{{ route('admin.product.productTransferToBranch') }}" class="btn btn-danger btn-sm float-end"> Product Transfer to Branch </a>
                            </div>


                            <div class="card-body">

							<div class="container">

								<form id="filterForm">
									<div class="row">
                                        @if(currentUserType()==1)
                                            <div class="col-md-3 mb-3">
                                                <div class="form-group">
                                                    <label>Select Branch <span class="text-danger">*</span></label>
                                                    <select class="form-control" name="branch" id="branch">
                                                        <option value="">Select Branch</option>
                                                        @foreach($branch_list as $val)
                                                            <option value="{{ $val->id }}">{{ $val->name }} ({{ $val->code }})</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        @endif

										<div class="col-md-3 mb-3">
											<div class="form-group">
												<label>Search <span class="text-danger">*</span></label>
												<div class="input-group">
													<input type="text" class="form-control" name="search" id="search" placeholder="Search by Name, Mobile, Email">
												</div>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group mt-4">
												<button class="btn btn-danger btn-sm" id="resetSearchBtn" title="Reset Search">
													Reset
												</button>

											</div>
										</div>
									</div>
								</form>

							</div>
							<div class="table-responsive">
								<div id="user-table">
									@include('admin.product.transfer.branch_product_list_ajax', ['product_list' => $product_list])
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

		 <div class="modal fade" id="updateStockModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Update Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <form id="updateStockForm">

                    <input type="hidden" id="bp_id">

                    <div class="mb-3">
                        <label class="form-label fw-bold">Product</label>
                        <input type="text" style="background-color:skyblue;" id="productName" class="form-control" readonly>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Stock</label>
                            <input type="number" id="stock" class="form-control" min="0">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Price</label>
                            <input type="number" id="price" class="form-control" min="0">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Offer Price</label>
                        <input type="number" id="offer_price" class="form-control" min="0">
                    </div>

                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="updateStockBtn">
                    Update
                </button>
            </div>

        </div>
    </div>
</div>




<script>

    $(document).on('click', '.openUpdateStockModal', function () {

        $('#bp_id').val($(this).data('id'));
        $('#productName').val($(this).data('product'));
        $('#stock').val($(this).data('stock'));
        $('#price').val($(this).data('price'));
        $('#offer_price').val($(this).data('offer'));

        $('#updateStockModal').modal('show');
    });


    $('#updateStockBtn').on('click', function () {

        let data = {
            _token: "{{ csrf_token() }}",
            id: $('#bp_id').val(),
            stock: $('#stock').val(),
            price: $('#price').val(),
            offer_price: $('#offer_price').val(),
        };

        if (data.stock === '' || data.stock < 0) {
            alert('Invalid stock');
            return;
        }

        $.ajax({
            type: "POST",
            url: "{{ route('admin.product.updateBranchStock') }}",
            data: data,
            dataType: "JSON",

            success: function (res) {
                if (res.status) {
                    $('#updateStockModal').modal('hide');
                    Swal.fire({
                        icon: 'success',
                        title: 'Updated',
                        text: res.message,
                        timer: 1200,
                        showConfirmButton: false
                    }).then(() => location.reload());
                } else {
                    Swal.fire('Error', res.message, 'error');
                }
            },

            error: function () {
                Swal.fire('Error', 'Server error occurred', 'error');
            }
        });
    });

/* fetching agreement data area start */

 function fetchUsers(page = 1) {
        let branch = $('#branch').val();
        let search = $('#search').val();
		$.ajax({
            url: "{{ route('admin.product.fetchBranchProductsHere') }}?page=" + page,
            method: "GET",
            data: {
                branch,
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
    $('#branch').change(function () {
        fetchUsers();
    });

    // Trigger on search
    $('#search').on('keyup', function () {
        fetchUsers();
    });

    // Reset filters
    $('#resetSearchBtn').on('click', function (e) {
        e.preventDefault();
        $('#branch').val('');
        $('#search').val('');
        fetchUsers();
    });

/* fetching agreement data area end*/

</script>




@endsection

