@extends('admin.include.master')
@section('title') {{ $page_title }} @endsection
@section('content')

!-- Page Header -->
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
								   data-bs-target="#designationModal"
								   onclick="openAddDesignationModal()">
								   Add Designation
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
									@include('admin.master.designation.designation_table_ajax', ['designayion_list' => $designayion_list])
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

		<!-- Designation Modal -->
<div class="modal fade" id="designationModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="designationModalTitle">Add Designation</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">

        <div class="alert alert-danger d-none" id="designationError"></div>

        <form id="designationForm">

            <input type="hidden" id="designation_id">

			<div class="mb-3">
                <label class="form-label">Select Type</label>
                <select id="user_type" name="type" required class="form-control">
                    <option value="">---Select Type---</option>
                    @foreach($user_type as $val)
						<option value="{{ $val->id }}">{{ $val->name }}</option>
					@endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Designation Name</label>
                <input type="text" id="designation_name" class="form-control" placeholder="Teacher / HOD / Doctor">
            </div>
			
			<div class="mb-3">
                <label class="form-label">Incentive</label>
                <input type="number" step="0.01" id="incentive" class="form-control" placeholder="Incentive">
            </div>

			<div class="mb-3">
                <label class="form-label">Status</label>
                <select id="designation_status" class="form-control">
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>

        </form>

      </div>

      <div class="modal-footer">
        <button class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
        <button class="btn btn-primary" id="saveDesignationBtn" onclick="saveDesignation()">Save</button>
        <button class="btn btn-primary" id="updateDesignationBtn" onclick="updateDesignation()" style="display:none;">Update</button>
      </div>

    </div>
  </div>
</div>




<script>
function openAddDesignationModal() {
    $('#designation_id').val('');
    $('#incentive').val('');
    $('#designation_name').val('');
    $('#designation_status').val('1');
    $('#user_type').val('');

    $("#designationModalTitle").text("Add Designation");
    $('#saveDesignationBtn').show();
    $('#updateDesignationBtn').hide();

    $("#designationError").addClass("d-none").html("");
}

function saveDesignation() {

    $("#designationError").addClass("d-none").html("");

    let btn = $("#saveDesignationBtn");
    let original = btn.text();

    btn.prop("disabled", true).text("Saving...");

    $.ajax({
        url: "{{ route('admin.designations.store') }}",
        type: "POST",
        data: {
            name: $('#designation_name').val(),
            incentive: $('#incentive').val(),
            status: $('#designation_status').val(),
            user_type: $('#user_type').val(),
            _token: "{{ csrf_token() }}"
        },

        success: function(res){
            btn.prop("disabled", false).text(original);

            if(res.success){
                $('#designationModal').modal('hide');

                Swal.fire({
                    icon: "success",
                    title: "Success",
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

function editDesignation(id){

    $("#designationError").addClass("d-none").html("");

    $.ajax({
        url: "{{ url('admin/designations/edit') }}/" + id,
        type: "GET",

        success: function(res){

            $('#designation_id').val(res.id);
            $('#designation_name').val(res.name);
            $('#incentive').val(res.incentive);
            $('#designation_status').val(res.status);
            $('#user_type').val(res.user_type);

            $("#designationModalTitle").text("Edit Designation");

            $('#saveDesignationBtn').hide();
            $('#updateDesignationBtn').show();

            $('#designationModal').modal('show');
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
            incentive: $('#incentive').val(),
            status: $('#designation_status').val(),
            user_type: $('#user_type').val(),
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


/* fetching designation data area start */

 function fetchUsers(page = 1) {
        let type = $('#type').val();
        let search = $('#search').val();

        $.ajax({
            url: "{{ route('admin.designation.fetch') }}?page=" + page,
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

/* fetching designation data area end*/

</script>




@endsection

