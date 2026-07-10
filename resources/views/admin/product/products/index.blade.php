@extends('admin.include.master')
@section('title', 'Products List')
@section('content')
<!-- Page Header -->
            <div style="background:linear-gradient(45deg, #f33057, rgb( 56, 88, 249 ) );" class="d-sm-flex d-block align-items-center justify-content-between page-header-breadcrumb">
                <div>
                    <h4 class="fw-medium mb-2">Products</h4>
                    <div class="ms-sm-1 ms-0">
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a class="" href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item  active fw-normal" aria-current="page">Product List</li>
                            </ol>
                        </nav>
                    </div>
                </div>

            </div>
            <!-- Page Header Close -->



            <!--APP-CONTENT START-->
	<div class="main-content app-content">
		<div class="row gx-3">
            <div class="col-md-12">
                <div class="card card-table">
					<div class="card-header d-flex align-items-center justify-content-between">
						<h5 class="card-title">Product List</h5>
						<a href="{{ url('admin/products/create') }}" class="btn btn-primary ms-auto">Add Product</a>
					</div>
                    <div class="card-body booking_card">
						 
						<form id="filterForm" class="form">
                            <div class="row">
                                <div class="col-md-4 mb-3">
									<div class="form-group">
									   <label>Select Shop <span class="text-danger">*</span> </label>
									   <select class="form-control select2" name="shop_id" id="shop_id" data-toggle="select2" data-placeholder="Choose ..." data-live-search="true">
											<option value="">-- Select Shop --</option>
											@foreach ($shop_list as $val)
												<option value="{{ $val->id }}">{{ $val->name }} - {{ $val->investor_name }}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-md-4 mb-3">
									<label>Select Category <span class="text-danger">*</span> </label>
									<select placeholder="Enter Category Name" class="form-control selectpicker" name="category_id" id="category_id" data-toggle="select2" data-placeholder="Choose ..." data-live-search="true">
										<option value="">-- Select Category --</option>
										@foreach ($categories as $category)
											@include('admin.product.category.partials.edit_category_options', [
												'category' => $category,
												'level' => 0,
												'data' => $data ?? null
											])
										@endforeach
									</select>
                                </div> 
								<div class="col-md-4 mb-3">
									<label>Select Brand <span class="text-danger">*</span> </label>
                                    <select class="form-control selectpicker" name="brand_id" id="brand_id" data-toggle="select2" data-placeholder="Choose ..." data-live-search="true">
											<option value="">-- Select Brand --</option>
											@foreach ($brand_list as $val)
												<option value="{{ $val->id }}">{{ $val->name }}</option>
											@endforeach
										</select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="input-group">
										<input type="text" class="form-control" name="search" id="search" placeholder="Search by Product Name">
									</div>
                                </div>
								<div class="col-md-2">
									<div class="form-group mt-4">
										<button class="btn btn-danger" id="resetSearchBtn" title="Reset Search">
											Reset
										</button>
										 
									</div>
								</div>
                            </div>
                        </form>
						
						<div class="table-responsive">
							<div id="user-table">
								@include('admin.product.products.product_table_ajax', ['products' => $products])
							</div>
							 
						</div>

                         

                    </div>
                </div>
            </div>
        </div>
	</div>

	<script>
	function fetchUsers(page = 1) {
        let shop_id = $('#shop_id').val();
        let category_id = $('#category_id').val();
        let brand_id = $('#brand_id').val();
        let search = $('#search').val();

        $.ajax({
            url: "{{ route('admin.product.fetchProducts') }}?page=" + page,
            method: "GET",
            data: {
                shop_id,
                category_id,
                brand_id,
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
		$('#shop_id, #category_id, #brand_id').change(function () {
			fetchUsers();
		});

		// Trigger on search
		$('#search').on('keyup', function () {
			fetchUsers();
		});

		// Reset filters
		$('#resetSearchBtn').on('click', function (e) {
			e.preventDefault();
			$('#shop_id').val('');
			$('#category_id').val('');
			$('#brand_id').val('');
			fetchUsers();
		});
	</script>
    
@endsection

