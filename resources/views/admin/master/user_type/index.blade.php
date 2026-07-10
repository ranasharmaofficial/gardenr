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
								   data-bs-target="#userTypeModal"
								   onclick="openAddUserTypeModal()">
								   Add User Type
								</a>


							</div>

 
                            <div class="card-body">
                            <div class="table-responsive">

                                <table id="" class="table table-bordered text-nowrap mt-3" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th class="text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($user_type_list as $key => $value)
									<tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $value->name }}</td>
                                        <td>
                                            <div class="actions"> @if($value->status == 1) <a href="#" class="btn btn-sm bg-success-light mr-2">Active</a> @else <a href="#" class="btn btn-sm bg-danger-light mr-2">Inactive</a> @endif </div>
                                        </td>
                                        <td>{{ convert_datetime_to_date_format($value->created_at, 'd M Y') }}</td>
                                        <td class="text-right">
                                            <a class="btn btn-icon btn-sm btn-primary-light rounded-pill" onclick="editUserType({{ $value->id }})" href="javascript:void();"><i class="ri-edit-line"></i></a>
                                            
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>


                                </table>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End:: row-2 -->



                </div>
            </div>
            <!--APP-CONTENT CLOSE-->
		 
		<!-- User Type Modal -->
<div class="modal fade" id="userTypeModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="userTypeModalTitle">Add User Type</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">

        <div class="alert alert-danger d-none" id="userTypeError"></div>

        <form id="userTypeForm">
            <input type="hidden" id="user_type_id">

            <div class="mb-3">
                <label class="form-label">User Type Name</label>
                <input type="text" id="user_type_name" class="form-control" placeholder="Admin / Employee / BDM">
            </div>

            <div class="mb-3">
                <label class="form-label">Status</label>
                <select id="user_type_status" class="form-control">
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>

        </form>
      </div>

      <div class="modal-footer">
        <button class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
        <button class="btn btn-primary" id="saveUserTypeBtn" onclick="saveUserType()">Save</button>
        <button class="btn btn-primary" id="updateUserTypeBtn" onclick="updateUserType()" style="display:none;">Update</button>
      </div>

    </div>
  </div>
</div>



<script>
function openAddUserTypeModal() {
    $('#user_type_id').val('');
    $('#user_type_name').val('');
    $('#user_type_status').val('1');

    $("#userTypeModalTitle").text("Add User Type");
    $('#saveUserTypeBtn').show();
    $('#updateUserTypeBtn').hide();

    $("#userTypeError").addClass("d-none").html("");
}

function saveUserType() {
    $("#userTypeError").addClass("d-none").html("");

    let btn = $("#saveUserTypeBtn");
    let original = btn.text();

    btn.prop("disabled", true).text("Saving...");

    $.ajax({
        url: "{{ route('admin.user_type.store') }}",
        type: "POST",
        data: {
            name: $('#user_type_name').val(),
            status: $('#user_type_status').val(),
            _token: "{{ csrf_token() }}"
        },

        success: function(res) {
            btn.prop("disabled", false).text(original);

            if(res.success){
                $('#userTypeModal').modal('hide');

                Swal.fire({
                    icon: "success",
                    title: "Success",
                    text: res.message,
                    timer: 1500,
                    showConfirmButton: false,
                });

                setTimeout(() => location.reload(), 1500);
            }
        },

        error: function(xhr) {
            btn.prop("disabled", false).text(original);

            if(xhr.status === 422){
                let msg = "";
                $.each(xhr.responseJSON.errors, function(k, v){
                    msg += v[0] + "<br>";
                });

                $("#userTypeError").removeClass("d-none").html(msg);
            }
        }
    });
}


function editUserType(id){

    $("#userTypeError").addClass('d-none').html("");

    $.ajax({
        url: "{{ url('admin/user-type/edit') }}/" + id,
        type: "GET",

        success: function(res){

            $('#user_type_id').val(res.id);
            $('#user_type_name').val(res.name);
            $('#user_type_status').val(res.status);

            $("#userTypeModalTitle").text("Edit User Type");

            $('#saveUserTypeBtn').hide();
            $('#updateUserTypeBtn').show();

            $('#userTypeModal').modal('show');
        }
    });
}


function updateUserType() {

    $("#userTypeError").addClass("d-none").html("");

    let id = $('#user_type_id').val();

    let btn = $("#updateUserTypeBtn");
    let original = btn.text();
    btn.prop("disabled", true).text("Updating...");

    $.ajax({
        url: "{{ url('admin/user-type/update') }}/" + id,
        type: "POST",
        data: {
            name: $('#user_type_name').val(),
            status: $('#user_type_status').val(),
            _token: "{{ csrf_token() }}"
        },

        success: function(res){
            btn.prop("disabled", false).text(original);

            if(res.success){
                $('#userTypeModal').modal('hide');

                Swal.fire({
                    icon: "success",
                    title: "Updated!",
                    text: res.message,
                    timer: 1500,
                    showConfirmButton: false,
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

                $("#userTypeError").removeClass("d-none").html(msg);
            }
        }
    });
}



</script>




@endsection

