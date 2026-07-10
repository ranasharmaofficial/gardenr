@extends('admin.include.master')
@section('title', 'Master Post List')
@section('content')
<div class="app-container">
    <div class="content container-fluid">
        <!-- App hero header starts -->
          <div class="app-hero-header d-flex align-items-center">

            <!-- Breadcrumb starts -->
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <i class="ri-home-8-line lh-1 pe-3 me-3 border-end"></i>
                <a href="{{ url('admin/dashboard') }}">Home</a>
              </li>
              <li class="breadcrumb-item text-primary" aria-current="page">
                Master Post List
              </li>
            </ol>
            <!-- Breadcrumb ends -->


          </div>

        <div class="app-body">
			<div class="row gx-3">
            <div class="col-md-12">
                <div class="card card-table">
					<div class="card-header d-flex align-items-center justify-content-between">
						<h5 class="card-title">Master Post</h5>
						<a href="javascript:void(0);" class="btn btn-primary ms-auto" data-bs-toggle="modal" data-bs-target="#addModal">
							Add Post
						</a>
					</div>
                    <div class="card-body booking_card">

					{{--<form method="GET" class="form">
                            <div class="row">
                                 
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="search" placeholder="Search" value="@isset($request){{$request->search}}@endisset">
                                </div>
                            </div>
                        </form>--}}

                        <div class="table-responsive mt-3">
                            <table id="basicExampless2" class="table truncate m-0 align-middle">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                {{--<tbody>
                                    @foreach ($states as $key => $value)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $value->name }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>--}}
                            </table>

                            

                        </div>

                    </div>
                </div>
            </div>
        </div>
		</div>

    </div>
</div>


<!-- Add Post Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="addForm">
		@csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addModalLabel">Add New Post</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        
        <div class="modal-body">
           <div class="mb-3">
            <label for="city_name" class="form-label">Post Name</label>
            <input type="text" name="name" class="form-control" required>
          </div>

          <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" name="status" id="statusSwitch" checked>
            <label class="form-check-label" for="statusSwitch">Active</label>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save Post</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1">
  <div class="modal-dialog">
    <form id="editForm">
      <div class="modal-content">
        <div class="modal-header">
            <h5>Edit Master Post</h5>
        </div>
        <div class="modal-body">
            @csrf
            <input type="hidden" name="id" id="edit_id">
            <div class="form-group">
                <label for="edit_name">Name</label>
                <input type="text" name="name" id="edit_name" class="form-control" required>
            </div>
            <div class="form-group mt-2">
                <label>Status</label><br>
                <input type="checkbox" name="status" id="edit_status"> Active
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-success">Update</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </form>
  </div>
</div>

<script>
$(function () {
    var table;

    // Destroy previous DataTable instance if it exists
    if ($.fn.dataTable.isDataTable('#basicExampless2')) {
        $('#basicExampless2').DataTable().clear().destroy();
    }

    // ✅ Assign to table variable
    table = $('#basicExampless2').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route("admin.posts.ajax") }}',
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'name', name: 'name' },
            { data: 'status', name: 'status', orderable: false, searchable: false },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ]
    });

    // ✅ Now table.ajax.reload() will work below

    // Click on Edit button
    $(document).on('click', '.editBtn', function () {
        let id = $(this).data('id');
        let name = $(this).data('name');
        let status = $(this).data('status');

        $('#edit_id').val(id);
        $('#edit_name').val(name);
        $('#edit_status').prop('checked', status == 1);

        $('#editModal').modal('show');
    });

    // Submit form to update record
    $('#editForm').submit(function (e) {
        e.preventDefault();

        var formData = $(this).serialize();
        $.ajax({
            url: "{{ route('admin.posts.update') }}",
            method: "POST",
            data: formData,
            success: function (response) {
                if (response.success) {
                    $('#editModal').modal('hide');
                    table.ajax.reload(null, false); // ✅ Now this works
                    alert('Record updated successfully!');
                }
            },
            error: function (xhr) {
                alert('Something went wrong!');
            }
        });
    });

    // Submit add form
    $('#addForm').submit(function (e) {
        e.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            url: '{{ route("admin.posts.store") }}',
            method: 'POST',
            data: formData,
            success: function (response) {
                if (response.success) {
                    $('#addModal').modal('hide');
                    $('#addForm')[0].reset();
                    table.ajax.reload(null, false);  // ✅ Now this works too
                    toastr.success('Post added successfully!');
                } else {
                    toastr.error('Failed to add post.');
                }
            },
            error: function () {
                toastr.error('Something went wrong while saving the post.');
            }
        });
    });

    // Toggle switch
    $(document).on('change', '.toggle-status', function () {
        let stateId = $(this).data('id');
        let status = $(this).is(':checked') ? 1 : 0;
        $.ajax({
            url: "{{ route('admin.posts.toggle-status') }}",
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                id: stateId,
                status: status
            },
            success: function (res) {
                console.log('Status updated');
            }
        });
    });
});
</script>

@endsection

