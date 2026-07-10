@extends('admin.include.master')
@section('title', 'Staff List')
@section('content')

<style>
    table.table-bordered td,
    table.table-bordered th {
        border: 1px solid #dee2e6 !important;
    }
</style>

<!-- Page Header -->
<div style="background:linear-gradient(45deg, #f33057, rgb( 56, 88, 249 ) );"  class="d-sm-flex d-block align-items-center justify-content-between page-header-breadcrumb">
    <div>
        <h4 class="fw-medium mb-2">{{ $page_title }}</h4>
        <div class="ms-sm-1 ms-0">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">{{ $page_title }}</a></li>
                    <li class="breadcrumb-item active fw-normal" aria-current="page">Add {{ $page_title }}</li>
                </ol>
            </nav>
        </div>
    </div>

</div>
<!-- Page Header Close -->


<div class="main-content app-content">
		 
					<div class="container-fluid">
						<div class="row">
							<div class="col-sm-12">
								<div class="card card-table">
									<div class="card-header d-flex align-items-center justify-content-between">
										<h5 class="card-title">Incentive Sale List</h5>
										<a href="{{ url('admin/sale/incentive-sale') }}" class="btn btn-primary ms-auto">
											Add Incentive Sale
										</a>
									</div>
									<div class="card-body booking_card">
										<div class="container">
										<form id="filterForm">
											<div class="row">
												<div class="col-md-3 mb-3">
													<div class="form-group">
														<label>Vivah Mitra</label>
														<select class="form-control" name="vivah_mitra" id="vivah_mitra">
															<option value="">Select Vivah Mitra</option>
															@foreach($vivah_mitra_list as $val)
																<option value="{{ $val->id }}">{{ $val->first_name.' - '.$val->employee_code }}</option>
															@endforeach
														</select>
													</div>
												</div>
												
												<div class="col-md-3 mb-3">
													<div class="form-group">
														<label>Memer</label>
														<select class="form-control" name="member" id="member">
															<option value="">Select Memer</option>
														</select>
													</div>
												</div>
												
												<div class="col-md-3 mb-3">
													<div class="form-group">
														<label>Date From</label>
														<input type="date" class="form-control" name="date_from" id="date_from">
													</div>
												</div>
												
												<div class="col-md-3 mb-3">
													<div class="form-group">
														<label>Date To</label>
														<input type="date" class="form-control" name="date_to" id="date_to">
													</div>
												</div>

												<div class="col-md-3 mb-3">
													<div class="form-group">
														<label>Search <span class="text-danger">*</span></label>
														<div class="input-group">
															<input type="text" class="form-control" name="search" id="search" placeholder="Search by Name, Mobile, Email">
														</div>
													</div>
												</div>
												<div class="col-md-3 mb-3">
													<div class="form-group mt-3">
														<button class="btn btn-danger" id="resetSearchBtn" title="Reset Search">
															Reset
														</button>
														 
													</div>
												</div>
											</div>
											</form>
										</div>
										
										<div class="table-responsive">
											<div id="user-table">
												@include('admin.sale.branch_incentive_sale_list_ajax', ['sales_list' => $sales_list])
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

 	 
<script>
	$('#vivah_mitra').change(function () {
		let vivah_mitra = $(this).val();
		$('#member').html('<option value="">Loading...</option>');
		if (vivah_mitra) {
			$.ajax({
				url: "{{ route('admin.sale.getMemberList') }}",
				type: "POST",
				data: {
					_token: "{{ csrf_token() }}",
					vivah_mitra: vivah_mitra
				},
				success: function (data) {
					let options = '<option value="">Select Member</option>';
					$.each(data, function (key, row) {
						options += `<option value="${row.id}">${row.name} - ${row.membership_number}</option>`;
					});
					$('#member').html(options);
				}
			});
		}
	});
	
    function fetchUsers(page = 1) {
		let vivah_mitra = $('#vivah_mitra').val();
		let member      = $('#member').val();
		let search      = $('#search').val();
		let date_from   = $('#date_from').val();
		let date_to     = $('#date_to').val();

		$.ajax({
			url: "{{ route('admin.sale.fetchincentiveSaleList') }}?page=" + page,
			method: "GET",
			data: {
				vivah_mitra,
				member,
				search,
				date_from,
				date_to
			},
			success: function (data) {
				$('#user-table').html(data);
			}
		});
	}

	/* Pagination */
	$(document).on('click', '.pagination a', function (e) {
		e.preventDefault();
		let page = $(this).attr('href').split('page=')[1];
		fetchUsers(page);
	});

	/* Filters change */
	$('#vivah_mitra, #member, #date_from, #date_to').change(function () {
		fetchUsers();
	});

	/* Search */
	$('#search').on('keyup', function () {
		fetchUsers();
	});

	/* Reset */
	$('#resetSearchBtn').on('click', function (e) {
		e.preventDefault();
		$('#vivah_mitra').val('');
		$('#member').val('');
		$('#search').val('');
		$('#date_from').val('');
		$('#date_to').val('');
		fetchUsers();
	});
	
	
	 
</script>


@endsection
