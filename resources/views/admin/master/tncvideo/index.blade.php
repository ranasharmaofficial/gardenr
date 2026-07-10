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
								   Add T&C Video
								</a>


							</div>


                            <div class="card-body">

							<div class="container">
								<form id="filterForm">
									<div class="row">
										<div class="col-md-3 mb-3">
											<div class="form-group">
												<label>User Type <span class="text-danger">*</span></label>
												<select class="form-control" name="type" id="type">
													<option value="">Select User Type</option>
													@foreach($user_type as $val)
														<option value="{{ $val->id }}">{{ $val->name }}</option>
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
									@include('admin.master.tncvideo.offer_table_ajax', ['offer_list' => $offer_list])
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
		  <div class="modal-dialog">
			<form class="modal-content" id="offer-Form" enctype="multipart/form-data">
				<div class="modal-header">
					<h5 class="modal-title" id="tncVideoModalTitle">Add T&C Video</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				</div>

				<div class="modal-body">

					<div style="display:none;" id="show-form-error" class="alert alert-danger col-md-12">
						<ul>
							<div class="errorMsgntainer"></div>
						</ul>
					</div>

					<input type="hidden" id="offer_id">

					<div class="mb-3">
						<label class="form-label">Select Type</label>
						<select id="agreement_type" name="type" required class="form-control">
							<option value="">---Select Type---</option>
							@foreach($user_type as $val)
								<option value="{{ $val->id }}">{{ $val->name }}</option>
							@endforeach
						</select>
					</div>

					<div class="mb-3">
						<div class="form-group">
							<label>User Designation <span class="text-danger">*</span></label>
							<select class="form-control" id="user_designation_id" name="user_designation_id">
								<option value="">Select Designation</option>
							</select>
						</div>
					</div>

					<div class="mb-3">
						<label class="form-label">Title</label>
						<input type="text" name="title"  id="agreement_title" class="form-control" placeholder="Title">
					</div>

					<div class="mb-3">
						<label class="form-label">Video Url</label>
						<input type="text" required name="video_url" id="agreement_file" class="form-control" placeholder="Video Url">
					</div>

					<div class="mb-3">
						<label class="form-label">Status</label>
						<select id="offer_status" name="status" class="form-control">
							<option value="1">Active</option>
							<option value="0">Inactive</option>
						</select>
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

    $("#tncVideoModalTitle").text("Add T&C Video");
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
            url: "{{ route('admin.tndcVid.store') }}",
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

function updateDesignation(){
	$("#designationError").addClass("d-none").html("");
	let id = $('#designation_id').val();
	let btn = $("#updateDesignationBtn");
    let original = btn.text();
	btn.prop("disabled", true).text("Updating...");
	$.ajax({
        url: "{{ url('admin/designations/update') }}/" + id,
        type: "POST",
        data: {
            name: $('#designation_name').val(),
            body: $('#designation_body').val(),
            status: $('#designation_status').val(),
            _token: "{{ csrf_token() }}"
        },

        success: function(res){
            btn.prop("disabled", false).text(original);

            if(res.success){
                $('#designationModal').modal('hide');

                Swal.fire({
                    icon: "success",
                    title: "Updated!",
                    text: res.message,
                    timer: 1500,
                    showConfirmButton: false
                });

                setTimeout(() => location.reload(), 1500);
            }
        },

        error: function(xhr){
            btn.prop("disabled", false).text(original);

            if(xhr.status === 422){
                let msg = "";
                $.each(xhr.responseJSON.errors, function(k, v){
                    msg += v[0] + "<br>";
                });
                $("#designationError").removeClass("d-none").html(msg);
            }
        }
    });
}

	/* fetching agreement data area start */

 function fetchUsers(page = 1) {
        let type = $('#type').val();
        let search = $('#search').val();

        $.ajax({
            url: "{{ route('admin.tndcVid.fetch') }}?page=" + page,
            method: "GET",
            data: {
                type,
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
    $('#type').change(function () {
        fetchUsers();
    });

    // Trigger on search
    $('#search').on('keyup', function () {
        fetchUsers();
    });

    // Reset filters
    $('#resetSearchBtn').on('click', function (e) {
        e.preventDefault();
        $('#type').val('');
        $('#search').val('');
        fetchUsers();
    });

	/* fetching agreement data area end */





</script>




@endsection

