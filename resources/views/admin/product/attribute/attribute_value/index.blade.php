@extends('admin.include.master')
@section('title', 'Attribute Details')
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
                Attribute Details
              </li>
            </ol>
            <!-- Breadcrumb ends -->


          </div>
<div class="row">
    <!-- Small table -->
    <div class="col-md-7">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">
                    {{ $attribute->name }}
                </strong>
            </div>

            <div class="card-body">
                <table class="table aiz-table mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Value</th>
                            <th class="text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($all_attribute_values as $key => $attribute_value)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{ $attribute_value->value }}</td>
							<td class="text-right">
                                <a class="btn btn-soft-primary btn-icon btn-circle btn-sm editAttrValueBtn"
								   href="javascript:void(0);"
								   data-id="{{ $attribute_value->id }}"
								   title="Edit">
									<i style="font-size:18px;" class="ri-edit-box-line"></i>
								</a>
								<a href="javascript:void(0);"
								   class="btn btn-soft-danger btn-icon btn-circle btn-sm deleteAttrValueBtn"
								   data-id="{{ $attribute_value->id }}"
								   data-url="{{ route('admin.destroy-attribute-value', $attribute_value->id) }}"
								   title="Delete">
									<i style="font-size:18px;" class="ri-delete-bin-fill"></i>
								</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <div class="col-md-5">
		<div class="card">
			<div class="card-header">
					<h5 class="mb-0 h6">Add New Attribute Value</h5>
			</div>
			<div class="card-body">
				<form action="{{ route('admin.store-attribute-value') }}" method="POST">
				 	@csrf
				 	<div class="form-group mb-3">
				 		<label for="name">Attribute Name</label>
				 		<input type="hidden" name="attribute_id" value="{{ $attribute->id }}">
				 		<input type="text" placeholder="Name" name="name" value="{{ $attribute->name }}"class="form-control" readonly>
				 	</div>
				 	<div class="form-group mb-3">
				 		<label for="name">Attribute Value</label>
				 		<input type="text" placeholder="Name" id="value" name="value" class="form-control" required>
				 	</div>
					@if($attribute->id=='2')
						<div class="form-group mb-3">
							<label for="name">Color Code</label>
							<input type="color" placeholder="Name" id="color" name="color" class="form-control">
						</div>
					@endif
				 	<div class="form-group mb-3 text-right">
				 		<button type="submit" class="btn btn-primary">Save</button>
				 	</div>
				</form>
			</div>
		</div>
	</div>
</div>
</div>
</div>

<!-- Edit Attribute Value Modal -->
<div class="modal fade" id="editAttrValueModal" tabindex="-1" aria-labelledby="editAttrValueModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Attribute Value</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="editAttrValueBody">
        <div class="text-center">
            <div class="spinner-border text-primary" role="status"></div>
        </div>
      </div>
    </div>
  </div>
</div>


<script>
$(document).ready(function () {
    $('.editAttrValueBtn').on('click', function () {
        var attrValId = $(this).data('id');
        var url = "{{ route('admin.edit-attribute-value', ':id') }}".replace(':id', attrValId);

        $('#editAttrValueBody').html('<div class="text-center"><div class="spinner-border text-primary" role="status"></div></div>');
        $('#editAttrValueModal').modal('show');

        $.ajax({
            url: url,
            type: 'GET',
            success: function (response) {
                $('#editAttrValueBody').html(response);
            },
            error: function () {
                $('#editAttrValueBody').html('<div class="alert alert-danger">Something went wrong.</div>');
            }
        });
    });
});
</script>

<script>
$(document).ready(function () {
    // CSRF token setup for Laravel
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    });

    // Handle delete
    $('.deleteAttrValueBtn').on('click', function () {
        const id = $(this).data('id');
        const url = $(this).data('url');
        const row = $(this).closest('tr');

        if (confirm('Are you sure you want to delete this attribute value?')) {
            $.ajax({
                url: url,
                type: 'DELETE',
                success: function (response) {
                    // Optional: Show success message
                    alert('Attribute value deleted successfully');
                    row.remove();
                },
                error: function () {
                    alert('Failed to delete. Please try again.');
                }
            });
        }
    });
});
</script>

@endsection

 
