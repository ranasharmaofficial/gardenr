@extends('admin.include.master')
@section('title', 'Video Category List')
@section('content')

!-- Page Header -->
            <div style="background:linear-gradient(45deg, #f33057, rgb( 56, 88, 249 ) );" class="d-sm-flex d-block align-items-center justify-content-between page-header-breadcrumb">
                <div>
                    <h4 class="fw-medium mb-2">Video Category</h4>
                    <div class="ms-sm-1 ms-0">
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a class="" href="javascript:void(0);">Video Category</a></li>
                                <li class="breadcrumb-item  active fw-normal" aria-current="page">Video Category List</li>
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

								<h5 class="mb-0">Video Category List</h5>

								<a href="javascript:void(0)" 
								   class="btn btn-danger btn-sm"
								   data-bs-toggle="modal"
								   data-bs-target="#videoCategoryModal"
								   onclick="openAddCategoryModal()">
								   Add Video Category
								</a>

							</div>

 
                            <div class="card-body">
                            <div class="table-responsive">

                                <table id="" class="table table-bordered text-nowrap mt-3" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Link</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th class="text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($video_Categorylist as $key => $value)
									<tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $value->title }}</td>
                                        <td>{{ $value->slug }}</td>
                                        <td>
                                            <div class="actions"> @if($value->status == 1) <a href="#" class="btn btn-sm bg-success-light mr-2">Active</a> @else <a href="#" class="btn btn-sm bg-danger-light mr-2">Inactive</a> @endif </div>
                                        </td>
                                        <td>{{ convert_datetime_to_date_format($value->created_at, 'd M Y') }}</td>
                                        <td class="text-right">
                                            <a class="btn btn-icon btn-sm btn-primary-light rounded-pill" onclick="editCategory({{ $value->id }})" href="javascript:void();"><i class="ri-edit-line"></i></a>
                                            
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
			<!-- Add Video Category Modal -->
			<!-- Video Category Modal -->
			<div class="modal fade" id="videoCategoryModal" tabindex="-1">
			  <div class="modal-dialog">
				<div class="modal-content">

				  <div class="modal-header">
					<h5 class="modal-title" id="modalTitle">Add Video Category</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				  </div>

				  <div class="modal-body">

				<div class="alert alert-danger d-none" id="categoryError"></div>

				<form id="videoCategoryForm">
					<input type="hidden" id="category_id">

					<div class="mb-3">
						<label class="form-label">Category Name</label>
						<input type="text" class="form-control" id="category_name">
					</div>

					<div class="mb-3">
						<label class="form-label">Status</label>
						<select class="form-control" id="status">
							<option value="1">Active</option>
							<option value="0">Inactive</option>
						</select>
					</div>
				</form>
			</div>


      <div class="modal-footer">
        <button class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
        <button class="btn btn-primary" id="saveCategoryBtn" onclick="saveCategory()">Save</button>
        <button class="btn btn-primary" id="updateCategoryBtn" style="display:none;" onclick="updateCategory()">Update</button>
      </div>

    </div>
  </div>
</div>

<script>
function openAddCategoryModal() {
    $('#category_id').val('');
    $('#category_name').val('');
    $('#status').val('1');
    $('#modalTitle').text("Add Video Category");
    $('#saveCategoryBtn').show();
    $('#updateCategoryBtn').hide();
}

/* ➤ Save Category */
	function saveCategory() {

		$("#categoryError").addClass('d-none').html(""); // reset

		let btn = $("#saveCategoryBtn");
		let originalText = btn.text();

		// Disable button + change text
		btn.prop("disabled", true).text("Saving...");

		$.ajax({
			url: "{{ route('admin.storeVideosCategory') }}",
			type: "POST",
			data: {
				category_name: $('#category_name').val(),
				status: $('#status').val(),
				_token: '{{ csrf_token() }}'
			},

			success: function(res){
				// Re-enable button & restore text
				btn.prop("disabled", false).text(originalText);

				if(res.success){
					$('#videoCategoryModal').modal('hide');
					Swal.fire({
						position: "top-end",
						icon: "success",
						title: res.message,
						showConfirmButton: false,
						timer: 3500
					});
					location.reload();
				}
			},

			error: function(xhr){
				// Re-enable button & restore text
				btn.prop("disabled", false).text(originalText);

				if(xhr.status === 422){ // validation error
					let errors = xhr.responseJSON.errors;

					let msg = "";
					$.each(errors, function(key, val){
						msg += val[0] + "<br>";
					});

					$("#categoryError").removeClass('d-none').html(msg);
				}
			}
		});
	}
 

/* ➤ Open Edit Modal */
function editCategory(id){
    $.ajax({
        url: "{{ url('admin/video-category/edit/') }}/" + id,
        type: "GET",
        success: function(cat){

            $('#modalTitle').text("Edit Video Category");
            $('#category_id').val(cat.id);
            $('#category_name').val(cat.title);
            $('#status').val(cat.status);

            $('#saveCategoryBtn').hide();
            $('#updateCategoryBtn').show();

            $('#videoCategoryModal').modal('show');
        }
    });
}

/* ➤ Update Category */
function updateCategory(){

    $("#categoryError").addClass('d-none').html(""); // reset

    let id = $('#category_id').val();

    let btn = $("#updateCategoryBtn");
    let originalText = btn.text();

    btn.prop("disabled", true).text("Updating...");

    $.ajax({
        url: "{{ url('admin/video-category/update/') }}/" + id,
        type: "POST",
        data: {
            title: $('#category_name').val(),
            status: $('#status').val(),
            _token: '{{ csrf_token() }}'
        },

        success: function(res){
            btn.prop("disabled", false).text(originalText);

            if(res.success){
                $('#videoCategoryModal').modal('hide');

                Swal.fire({
                    title: "Updated!",
                    text: res.message,
                    icon: "success",
                    timer: 1500,
                    showConfirmButton: false
                });

                setTimeout(() => location.reload(), 1500);
            }
        },

        error: function(xhr){
            btn.prop("disabled", false).text(originalText);

            if(xhr.status === 422){
                let errors = xhr.responseJSON.errors;
                let msg = "";

                $.each(errors, function(key, val){
                    msg += val[0] + "<br>";
                });

                $("#categoryError").removeClass('d-none').html(msg);
            }
        }
    });
}

</script>




@endsection

