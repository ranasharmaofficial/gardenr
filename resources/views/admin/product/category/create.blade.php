@extends('admin.include.master')
@section('title', 'Add Category')
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
        <div class="row gx-3 mt-3">
            <div class="col-sm-12">
                <div class="card">
					<div class="card-header d-flex align-items-center justify-content-between">
						<h5 class="card-title">Add Category</h5>
						<a href="{{ url('admin/product_categories') }}" class="btn btn-primary ms-auto">Category List</a>
					</div>
                    <div class="card-body booking_card">
                        <form method="post" id="add-speciality-form" action="{{ route('admin.product_categories.store') }}" enctype="multipart/form-data">
                            @csrf
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
                                        <input type="text" placeholder="Enter Category Name" class="form-control" name="name">
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
                                        <input type="text" placeholder="Enter Description" class="form-control" name="description">
                                    </div>
                                </div>

                                <div class="col-xxl-6 col-lg-4 col-sm-6 mb-3">
                                    <div class="form-group">
                                        <label>image <span class="text-danger">*</span> </label>
                                        <input type="file" placeholder="Enter image" class="form-control" name="image">
                                    </div>
                                </div>
								
								<div class="col-xxl-6 col-lg-4 col-sm-6 mb-3">
                                    <div class="form-group">
                                        <label>Status <span class="text-danger">*</span></label>
                                        <select class=" form-control" name="status">
                                            <option value="1" selected>Active</option>
                                            <option value="2">Inactive</option>
                                        </select>
                                    </div>
                                </div>

                                

                            </div>
                            <!-- Card acrions starts -->
							<div class="d-flex gap-2 justify-content-end mt-4">
							  <button type="submit" class="btn btn-primary buttonedit1 add-button">Add</button>
							</div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        </div>

     

<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
	<script>
	$(document).on('click', '.add-button', function(e) {
        e.preventDefault();
        var clk_btn = $(".add-button");
        clk_btn.prop('disabled', true).text('Adding...');

        var formData = new FormData(document.getElementById("add-speciality-form"));
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "POST",
            url: "{{ route('admin.product_categories.store') }}",
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
                    clk_btn.prop('disabled', false).text('Add'); // Reset button text
                }
            },
            error: function(err) {
                document.getElementById('show-form-error').style = "display: block";
                clk_btn.prop('disabled', false).text('Add'); // Reset button text
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
