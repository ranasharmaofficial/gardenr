@extends('admin.include.master')
@section('title', 'Update Category')
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
			<div class="row">
				<div class="col-sm-12">
					<div class="card">
						<div class="card-header d-flex align-items-center justify-content-between">
							<h5 class="card-title">Update Category</h5>
							<a href="{{ url('admin/product_categories') }}" class="btn btn-primary ms-auto">Category List</a>
						</div>
						<div class="card-body booking_card">
							<form method="post" id="update-speciality-form" action="{{ route('admin.product_categories.update',$data->id) }}" enctype="multipart/form-data">
								@csrf
								@method('put')
								<div class="row formtype">
									<div class="col-md-12">
										@if ($errors->any())
											<div class="alert alert-danger">
												<ul>
													@foreach ($errors->all() as $error)
														<li>{{ $error }}</li>
													@endforeach
												</ul>
											</div>
										@endif
									</div>
									
									<div class="col-md-12 mb-3">
										<div style="display:none;" id="show-form-error" class="alert alert-danger col-md-12">
											<ul>
												<div class="errorMsgntainer"></div>
											</ul>
										</div>
									</div>
									
									<div class="col-xxl-6 col-lg-4 col-sm-6 mb-3">
                                    <div class="form-group">
                                        <label>Category Name <span class="text-danger">*</span> </label>
                                        <input type="text" value="{{ $data->name }}" placeholder="Enter Category Name" class="form-control" name="name">
                                    </div>
                                </div>
								
								<div class="col-xxl-6 col-lg-4 col-sm-6 mb-3">
                                    <div class="form-group">
                                        <label>Parent Category <span class="text-danger">*</span> </label>
                                        <select placeholder="Enter Category Name" class="form-control" name="parent_id" data-toggle="select2" data-placeholder="Choose ..." data-live-search="true">
											<option value="">-- Select Parent --</option>
											@foreach ($categories as $category)
												@include('admin.product.category.partials.category_options', [
													'category' => $category,
													'level' => 0,
													'data' => $data ?? null
												])
											@endforeach
										</select>
                                    </div>
                                </div>
								
								<div class="col-xxl-6 col-lg-4 col-sm-6 mb-3">
                                    <div class="form-group">
                                        <label>Description </label>
                                        <input type="text" value="{{ $data->description }}" placeholder="Enter Description" class="form-control" name="description">
                                    </div>
                                </div>

									 
									
								<div class="col-xxl-6 col-lg-4 col-sm-6 mb-3">
									<div class="form-group">
										<label>Slug <span class="text-danger">*</span> </label>
										<input type="text" value="{{ $data->slug }}" placeholder="Enter" class="form-control" name="slug">
									</div>
								</div>
									
									
									

									<div class="col-xxl-6 col-lg-4 col-sm-6 mb-3">
										<div class="form-group">
											<label>Icons <span class="text-danger">*</span> </label>
											<input type="file" value="{{ $data->image }}" placeholder="Enter Icons" class="form-control" name="image">
											<img style="margint-top:5px;max-width: 30px;width:30px;" src="{{ static_asset($data->image) }}">
										</div>
									</div>
								

									<div class="col-xxl-6 col-lg-4 col-sm-6 mb-3">
										<div class="form-group">
											<label class="form-label" for="a1">Status <span class="text-danger">*</span></label>
											<select class=" form-control" name="status" required>
												<option value="1" @if($data->status == 1) selected @endif>Active</option>
												<option value="2" @if($data->status == 2) selected @endif>Inactive</option>
											</select> 
										</div>
									</div>

									 

								</div>	
								
								<!-- Card acrions starts -->
								<div class="d-flex gap-2 justify-content-end mt-4">
								  <a href="{{ url('admin/product_categories') }}" class="btn btn-outline-secondary">
									Cancel
								  </a>
								 <button type="submit" class="btn btn-primary buttonedit1 update-button">Update</button>
								</div>
							</form>

						</div>
					</div>
				</div>
			</div>
		</div>

     


<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
	<script>
	$(document).on('click', '.update-button', function(e) {
        e.preventDefault();
        var clk_btn = $(".update-button");
        clk_btn.prop('disabled', true).text('Updating...');

        var formData = new FormData(document.getElementById("update-speciality-form"));
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "POST",
            url: "{{ route('admin.product_categories.update',$data->id) }}",
            data: formData,
            processData: false,
            contentType: false,
            dataType: "JSON",
            success: function(data) {
                if (data.status == true) {
                    Swal.fire({
						icon: "success",
						title: "Success",
						text: data.message,
						timer: 1500,
						showConfirmButton: false
					});
                    location.reload();
                    
                } else {
                     Swal.fire({
						icon: "error",
						title: "Oh! No",
						text: data.message,
						timer: 1500,
						showConfirmButton: false
					});
                    clk_btn.prop('disabled', false).text('Update'); // Reset button text
                }
            },
            error: function(err) {
                document.getElementById('show-form-error').style = "display: block";
                clk_btn.prop('disabled', false).text('Update'); // Reset button text
                let error = err.responseJSON;
                $('.errorMsgntainer').html(''); // Clear previous errors
                $.each(error.errors, function(index, value) {
                    $('.errorMsgntainer').append('<span style="color:red;" class="text-danger">' + value + '<span>' + '<br>');
                });
            }
        });
    });

	</script>
@endsection

@section('script')
    <script>
        tinymce.init({
            selector: 'textarea#description',
        });
    </script>
@endsection