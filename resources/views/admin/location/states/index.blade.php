@extends('admin.include.master')
@section('title', 'State List')
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
					<h4 class="fw-medium mb-2">State</h4>
					<div class="ms-sm-1 ms-0">
						<nav>
							<ol class="breadcrumb mb-0">
								<li class="breadcrumb-item"><a href="javascript:void(0);">Location</a></li>
								<li class="breadcrumb-item active fw-normal" aria-current="page">Add State</li>
							</ol>
						</nav>
					</div>
				</div>
			</div>
		<!-- Page Header Close -->

        <div class="main-content app-content">
			<div class="container-fluid">
			<div class="row gx-3">
            <div class="col-md-12">
                <div class="card card-table">
					<div class="card-header d-flex align-items-center justify-content-between">
						<h5 class="card-title">State</h5>
						<a href="" class="btn btn-primary ms-auto">Add State</a>
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
                            <table id="basicExampless" class="table truncate m-0 align-middle">
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



<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1">
  <div class="modal-dialog">
    <form id="editForm">
      <div class="modal-content">
        <div class="modal-header">
            <h5>Edit State</h5>
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
	
	// Destroy previous DataTable instance if it exists
    if ($.fn.dataTable.isDataTable('#basicExampless')) {
        $('#basicExampless').DataTable().clear().destroy();
    }
	
    $('#basicExampless').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route("admin.states.ajax") }}',
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'name', name: 'name' },
            { data: 'status', name: 'status', orderable: false, searchable: false },
			{ data: 'action', name: 'action', orderable: false, searchable: false }
        ]
    });
	
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
            url: "{{ route('admin.states.update') }}",
            method: "POST",
            data: formData,
            success: function (response) {
                if (response.success) {
                    $('#editModal').modal('hide');
                    table.ajax.reload(null, false); // reload and stay on the same page
                    alert('Record updated successfully!');
                }
            },
            error: function (xhr) {
                alert('Something went wrong!');
            }
        });
    });

    // Toggle switch
    $(document).on('change', '.toggle-status', function () {
        let stateId = $(this).data('id');
        let status = $(this).is(':checked') ? 1 : 0;
        $.ajax({
            url: "{{ route('admin.states.toggle-status') }}",
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

