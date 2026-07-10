@extends('admin.include.master')
@section('title', 'Attribute List')
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
                Attribute List
              </li>
            </ol>
            <!-- Breadcrumb ends -->


          </div>

        <div class="app-body">
			<div class="row">
	<div class="col-md-7">
		<div class="card">
			<div class="card-header">
				<h5 class="mb-0 h6">Attributes</h5>
			</div>
			<div class="card-body">
				<table class="table aiz-table mb-0">
					<thead>
						<tr>
							<th>#</th>
							<th>Name</th>
							<th>Values</th>
							<th class="text-right">Options</th>
						</tr>
					</thead>
					<tbody>
						@foreach($attributes as $key => $attribute)
							<tr>
								<td>{{$key+1}}</td>
								<td>{{ $attribute->name }}</td>
								<td>
									@foreach($attribute->values as $key => $value)
									<span class="badge bg-info-subtle text-info">{{ $value->value }}</span>
									@endforeach
								</td>
								<td class="text-right">
									<a class="btn btn-soft-info btn-icon btn-circle btn-sm" href="{{route('admin.attributes.show', $attribute->id)}}" title="Attribute values">
										<i style="font-size:18px;" class="ri-settings-2-line"></i>
									</a>
									<a class="btn btn-soft-primary btn-icon btn-circle btn-sm editAttributeBtn"
									   href="javascript:void(0);"
									   data-id="{{ $attribute->id }}"
									   title="Edit">
										<i style="font-size:18px;" class="ri-edit-box-line"></i>
									</a>
									{{--<a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="{{route('admin.attributes.destroy', $attribute->id)}}" title="Delete">
										<i class="ri-delete-bin-fill"></i>
									</a>--}}
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
					<h5 class="mb-0 h6">Add New Attribute</h5>
			</div>
			<div class="card-body">
				<form action="{{ route('admin.attributes.store') }}" method="POST">
					@csrf
					<div class="form-group mb-3">
						<label for="name">Name</label>
						<input type="text" placeholder="Name" id="name" name="name" class="form-control" required>
					</div>
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
</div>

<!-- Edit Attribute Modal -->
<div class="modal fade" id="editAttributeModal" tabindex="-1" aria-labelledby="editAttributeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Attribute</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="editAttributeBody">
        <!-- AJAX content will be loaded here -->
        <div class="text-center">
            <div class="spinner-border text-primary" role="status"></div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function () {
    $('.editAttributeBtn').on('click', function () {
        var attributeId = $(this).data('id');
        var url = "{{ route('admin.attributes.edit', ':id') }}".replace(':id', attributeId);

        $('#editAttributeBody').html('<div class="text-center"><div class="spinner-border text-primary" role="status"></div></div>');
        $('#editAttributeModal').modal('show');

        $.ajax({
            url: url,
            type: 'GET',
            success: function (response) {
                $('#editAttributeBody').html(response);
            },
            error: function () {
                $('#editAttributeBody').html('<div class="alert alert-danger">Something went wrong. Please try again.</div>');
            }
        });
    });
});
</script>
@endsection

