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
								   data-bs-target="#generateMembershipModal"
								   onclick="openAddgenerateMembershipModal()">
								   Generate Vivah Mitra Code
								</a>


							</div>


                            <div class="card-body">

							<div class="container">
							
								<div class="row">
									<div class="col-md-3 mb-4">
										<div class="card shadow text-center p-4 border-0 rounded-4 text-white"
											 style="background: linear-gradient(45deg, #4e73df, #224abe);">

											<h6 class="mb-2">Total Vivah Mitra </h6>

											<h2 class="fw-bold">{{ $vivah_mitra }}</h2>

											<a href="" 
											   class="btn btn-light btn-sm mt-3 px-4 rounded-pill">
											   View
											</a>

										</div>
									</div>
									
									<div class="col-md-3 mb-4">
										<div class="card shadow text-center p-4 border-0 rounded-4 text-white"
											 style="background: linear-gradient(45deg, #f6c23e, #dda20a);">

											<h6 class="mb-2">Total Panchayat Mitra</h6>

											<h2 class="fw-bold">{{ $panchayat_mitra }}</h2>

											<a href="" 
											   class="btn btn-light btn-sm mt-3 px-4 rounded-pill">
											   View
											</a>

										</div>
									</div>
									
									<div class="col-md-3 mb-4">
										<div class="card shadow text-center p-4 border-0 rounded-4 text-white"
											 style="background: linear-gradient(45deg, #e74a3b, #be2617);">

											<h6 class="mb-2">Total Prakhand Mitra</h6>

											<h2 class="fw-bold">{{ $prakhand_mitra }}</h2>

											<a href="" 
											   class="btn btn-light btn-sm mt-3 px-4 rounded-pill">
											   View
											</a>

										</div>
									</div>
									
									<div class="col-md-3 mb-4">
										<div class="card shadow text-center p-4 border-0 rounded-4 text-white"
											 style="background: linear-gradient(45deg, #1cc88a, #13855c);">

											<h6 class="mb-2">Total Jila Mitra</h6>

											<h2 class="fw-bold">{{ $jila_mitra }}</h2>

											<a href="" 
											   class="btn btn-light btn-sm mt-3 px-4 rounded-pill">
											   View
											</a>

										</div>
									</div>
									
									
									
								</div>

								<form id="filterForm">
									<div class="row">
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
									@include('admin.staffs.vivah_mitra.table_ajax', ['membership_list' => $membership_list])
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
<div class="modal fade" id="generateMembershipModal" tabindex="-1">
  <div class="modal-dialog">
    <form class="modal-content" id="generate-membership-Form" enctype="multipart/form-data">
		<div class="modal-header">
			<h5 class="modal-title" id="generateMembershipModalTitle">Generate Vivah Mitra Code</h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
		</div>

        <div class="modal-body">
            <div style="display:none;" id="show-form-error" class="alert alert-danger col-md-12">
                <ul>
                    <div class="errorMsgntainer"></div>
                </ul>
            </div>

            <div class="mb-3">
                <label class="form-label">Type no of itmes you want to generate</label>
                <input type="number" value="1" name="number" required id="number" class="form-control" placeholder="Type no of itmes you want to generate">
            </div>

            <div class="mb-3">
                <label class="form-label">Select Date</label>
                <input type="date" required min="{{ date('Y-m-d') }}" name="created_date"  required id="created_date" class="form-control">
            </div>

        </div>

        <div class="modal-footer">
            <button class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-primary saveVivahMitraCodeBtn" id="saveVivahMitraCodeBtn">
                Save
            </button>
        </div>

    </form>
  </div>
</div>




<script>
	function openAddgenerateMembershipModal() {
		$('#agreement_id').val('');
		$('#agreement_name').val('');
		$('#agreement_status').val('1');

		$("#generateMembershipModalTitle").text("Generate Membership");
		$('#saveMembershipBtn').show();
		$('#updateDesignationBtn').hide();

		$("#targetError").addClass("d-none").html("");
	}

	$(document).on('click', '.saveVivahMitraCodeBtn', function(e) {
		e.preventDefault();

		Swal.fire({
			title: "Are you sure?",
			text: "Do you really want to generate?",
			icon: "warning",
			showCancelButton: true,
			confirmButtonText: "Yes, Generate",
			cancelButtonText: "Cancel",
		}).then((result) => {
			if (result.isConfirmed) {
				// Call function to submit AJAX
				submitFundTransfer();
			}
		});
	});


	function submitFundTransfer() {
		var clk_btn = $(".saveVivahMitraCodeBtn");
		clk_btn.prop('disabled', true);
		var formData = new FormData(document.getElementById("generate-membership-Form"));

		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

		$.ajax({
			type: "POST",
			url: "{{ route('admin.staffs.saveVivahMitraCode') }}",
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
						timer: 1500,
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

	$(document).ready(function () {
		$('#target_type').on('change', function () {
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



/* fetching agreement data area start */

 function fetchUsers(page = 1) {
        let branch = $('#branch').val();
        let search = $('#search').val();
		$.ajax({
            url: "{{ route('admin.staffs.fetchVivahMitraCodes') }}?page=" + page,
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

