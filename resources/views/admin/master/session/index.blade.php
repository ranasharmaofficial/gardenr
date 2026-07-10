@extends('admin.include.master')
@section('title', 'Session List')
@section('content')

!-- Page Header -->
            <div style="background:linear-gradient(45deg, #f33057, rgb( 56, 88, 249 ) );" class="d-sm-flex d-block align-items-center justify-content-between page-header-breadcrumb">
                <div>
                    <h4 class="fw-medium mb-2">Session</h4>
                    <div class="ms-sm-1 ms-0">
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a class="" href="javascript:void(0);">Session</a></li>
                                <li class="breadcrumb-item  active fw-normal" aria-current="page">Session List</li>
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

								<h5 class="mb-0">Session List</h5>

								<a href="javascript:void(0)"
								   class="btn btn-danger btn-sm float-end"
								   data-bs-toggle="modal"
								   data-bs-target="#sessionModal"
								   onclick="openAddSessionModal()">
								   Add Session
								</a>


							</div>

 
                            <div class="card-body">
                            <div class="table-responsive">

                                <table id="" class="table table-bordered text-nowrap mt-3" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th class="text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($session_list as $key => $value)
									<tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $value->title }}</td>
                                        <td>
                                            <div class="actions"> @if($value->status == 1) <a href="#" class="btn btn-sm bg-success-light mr-2">Active</a> @else <a href="#" class="btn btn-sm bg-danger-light mr-2">Inactive</a> @endif </div>
                                        </td>
                                        <td>{{ convert_datetime_to_date_format($value->created_at, 'd M Y') }}</td>
                                        <td class="text-right">
                                            <a class="btn btn-icon btn-sm btn-primary-light rounded-pill" onclick="editSession({{ $value->id }})" href="javascript:void();"><i class="ri-edit-line"></i></a>
                                            
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
		 
			<!-- Session Modal -->
<div class="modal fade" id="sessionModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="sessionModalTitle">Add Session</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">

        <div class="alert alert-danger d-none" id="sessionError"></div>

        <form id="sessionForm">
            <input type="hidden" id="session_id">

            <div class="mb-3">
                <label class="form-label">Session (e.g. 2025-2026)</label>
                <input type="text" class="form-control" id="session_title" placeholder="2025-2026">
            </div>
        </form>

      </div>

      <div class="modal-footer">
        <button class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
        <button class="btn btn-primary" id="saveSessionBtn" onclick="saveSession()">Save</button>
        <button class="btn btn-primary" id="updateSessionBtn" onclick="updateSession()" style="display:none;">Update</button>
      </div>

    </div>
  </div>
</div>


<script>
function openAddSessionModal() {
    $('#session_id').val('');
    $('#session_title').val('');
    $('#sessionModalTitle').text("Add Session");

    $('#saveSessionBtn').show();
    $('#updateSessionBtn').hide();

    $("#sessionError").addClass('d-none').html("");
}


function saveSession() {

    $("#sessionError").addClass('d-none').html("");

    let btn = $("#saveSessionBtn");
    let original = btn.text();

    btn.prop("disabled", true).text("Saving...");

    $.ajax({
        url: "{{ route('admin.session.store') }}",
        type: "POST",
        data: {
            title: $('#session_title').val(),
            _token: '{{ csrf_token() }}'
        },

        success: function(res){
            btn.prop("disabled", false).text(original);

            if(res.success){
                $('#sessionModal').modal('hide');

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

        error: function(xhr){
            btn.prop("disabled", false).text(original);

            if(xhr.status === 422){
                let errors = xhr.responseJSON.errors;
                let msg = "";

                $.each(errors, function(i, v){
                    msg += v[0] + "<br>";
                });

                $("#sessionError").removeClass('d-none').html(msg);
            }
        }
    });
}


function editSession(id) {

    $("#sessionError").addClass('d-none').html("");

    $.ajax({
        url: "{{ url('admin/session/edit') }}/" + id,
        type: "GET",

        success: function(res){

            $('#session_id').val(res.id);
            $('#session_title').val(res.title);

            $('#sessionModalTitle').text("Edit Session");
            $('#saveSessionBtn').hide();
            $('#updateSessionBtn').show();

            $('#sessionModal').modal('show');
        }
    });
}

function updateSession() {

    $("#sessionError").addClass('d-none').html("");

    let id = $("#session_id").val();

    let btn = $("#updateSessionBtn");
    let original = btn.text();
    btn.prop("disabled", true).text("Updating...");

    $.ajax({
        url: "{{ url('admin/session/update') }}/" + id,
        type: "POST",
        data: {
            title: $('#session_title').val(),
            _token: '{{ csrf_token() }}'
        },

        success: function(res){
            btn.prop("disabled", false).text(original);

            if(res.success){
                $('#sessionModal').modal('hide');

                Swal.fire({
                    icon: "success",
                    title: "Updated",
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
                let errors = xhr.responseJSON.errors;
                let msg = "";

                $.each(errors, function(i, v){
                    msg += v[0] + "<br>";
                });

                $("#sessionError").removeClass('d-none').html(msg);
            }
        }
    });
}


</script>




@endsection

