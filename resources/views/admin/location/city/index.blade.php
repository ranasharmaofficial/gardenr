@extends('admin.include.master')
@section('title', 'District List')
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
					<h4 class="fw-medium mb-2">District</h4>
					<div class="ms-sm-1 ms-0">
						<nav>
							<ol class="breadcrumb mb-0">
								<li class="breadcrumb-item"><a href="javascript:void(0);">Location</a></li>
								<li class="breadcrumb-item active fw-normal" aria-current="page">Add District</li>
							</ol>
						</nav>
					</div>
				</div>
			</div>
		<!-- Page Header Close -->
	<div class="main-content app-content">	
        <div class="app-body">
			<div class="row gx-3">
            <div class="col-md-12">
                <div class="card card-table">
					<div class="card-header d-flex align-items-center justify-content-between">
						<h5 class="card-title">District</h5>
						<a href="javascript:void(0);" class="btn btn-primary ms-auto" data-bs-toggle="modal" data-bs-target="#addModal">
							Add District
						</a>
					</div>
                    <div class="card-body booking_card">

						<form method="GET" class="form">
                            <div class="row">
                                 
                                <div class="col-md-6">
									<label>Select State</label>
                                    <select class="form-control" name="search" id="state-select">
										<option value="">Select State</option>
										@foreach ($states as $key => $value)
											<option value="{{ $value->id }}"
												@if(isset($request) && $request->search == $value->id) selected @endif>
												{{ $value->name }}
											</option>
										@endforeach
									</select>
                                </div>
                            </div>
                        </form>

                        <div class="table-responsive mt-3">
                            <table id="basicExample2" class="table truncate m-0 align-middle">
                                <thead>
                                    <tr>
                                        <th>#</th>
										<th>State Name</th>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
								{{--@foreach ($states as $key => $value)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $value->name }}</td>
                                    </tr>
                                    @endforeach--}}
                                </tbody>
                            </table>

                            

                        </div>

                    </div>
                </div>
            </div>
        </div>
		</div>

    </div>
</div>


<!-- Add City Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="addForm">
		@csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addModalLabel">Add New District</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        
        <div class="modal-body">
          <div class="mb-3">
            <label for="state_id" class="form-label">Select State</label>
            <select name="state_id" class="form-control" required>
              <option value="">Select State</option>
              @foreach($states as $state)
                  <option value="{{ $state->id }}">{{ $state->name }}</option>
              @endforeach
            </select>
          </div>

          <div class="mb-3">
            <label for="city_name" class="form-label">City Name</label>
            <input type="text" name="name" class="form-control" required>
          </div>

          <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" name="status" id="statusSwitch" checked>
            <label class="form-check-label" for="statusSwitch">Active</label>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save City</button>
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
            <h5>Edit City</h5>
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

    var table; // ✅ Define table in outer scope

    function loadDataTable(state_id = '') {
        if ($.fn.dataTable.isDataTable('#basicExample2')) {
            $('#basicExample2').DataTable().clear().destroy();
        }

        table = $('#basicExample2').DataTable({  // ✅ assign to outer variable
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ route("admin.cities.ajax") }}',
                data: { state_id: state_id }
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'state_name', name: 'state_name' },
                { data: 'name', name: 'name' },
                { data: 'status', name: 'status', orderable: false, searchable: false },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });
    }

    $(document).ready(function () {
        loadDataTable({{ $biharId ?? 1 }});

        $('#state-select').change(function () {
            var selectedState = $(this).val();
            loadDataTable(selectedState);
        });
    });

    $(document).on('click', '.editBtn', function () {
        let id = $(this).data('id');
        let name = $(this).data('name');
        let status = $(this).data('status');

        $('#edit_id').val(id);
        $('#edit_name').val(name);
        $('#edit_status').prop('checked', status == 1);
        $('#editModal').modal('show');
    });

    $('#editForm').submit(function (e) {
        e.preventDefault();

        var formData = $(this).serialize();
        $.ajax({
            url: "{{ route('admin.cities.update') }}",
            method: "POST",
            data: formData,
            success: function (response) {
                console.log(response);
                if (response) {
                    $('#editModal').modal('hide');
                    table.ajax.reload(null, false); // ✅ Now this works!
                    toastr.success('Record updated successfully!');
                }
            },
            error: function (xhr) {
                alert('Something went wrong!');
            }
        });
    });

    $(document).on('change', '.toggle-status', function () {
        let stateId = $(this).data('id');
        let status = $(this).is(':checked') ? 1 : 0;
        $.ajax({
            url: "{{ route('admin.cities.toggle-status') }}",
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
	
	
	// Submit add form
	$('#addForm').submit(function(e) {
		e.preventDefault();

		var formData = $(this).serialize();

		$.ajax({
			url: '{{ route("admin.cities.store") }}', // 🔁 Make sure this route exists
			method: 'POST',
			data: formData,
			success: function(response) {
				if (response.success) {
					$('#addModal').modal('hide');
					$('#addForm')[0].reset();
					table.ajax.reload(null, false);
					//toastr.success('City added successfully!');
					Swal.fire({
						icon: "success",
						title: "Success",
						text: 'Added Successfully!',
						timer: 1500,
						showConfirmButton: false
					});
				} else {
					toastr.error('Failed to add city.');
					Swal.fire({
						icon: "error",
						title: "Success",
						text: 'Failed to add city!',
						timer: 1500,
						showConfirmButton: false
					});
				}
			},
			error: function() {
				toastr.error('Something went wrong while saving the city.');
			}
		});
	});





});
</script>

@endsection

