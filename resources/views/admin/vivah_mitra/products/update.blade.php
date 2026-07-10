@extends('admin.include.master')
@section('title', 'Update Product')
@section('content')
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
 
 <style>
  .big-toggle {
    width: 60px !important;
    height: 32px !important;
}

.big-toggle:checked {
    background-color: #0d6efd !important;
}

.big-toggle::before {
    width: 26px !important;
    height: 26px !important;
    margin-top: -3px !important;
}

.form-switch .big-toggle {
    width: 3.2rem !important;
    height: 1.6rem !important;
}

.form-switch .big-toggle::before {
    width: 1.2rem !important;
    height: 1.2rem !important;
    transform: translateY(2px) !important;
}
 </style>
	
	<!-- Page Header -->
            <div style="background:linear-gradient(45deg, #f33057, rgb( 56, 88, 249 ) );" class="d-sm-flex d-block align-items-center justify-content-between page-header-breadcrumb">
                <div>
                    <h4 class="fw-medium mb-2">Vivah Mitra Data</h4>
                    <div class="ms-sm-1 ms-0">
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a class="" href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item  active fw-normal" aria-current="page">Update Product</li>
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
							<h5 class="card-title">Update Vivah Mitra Data</h5>
							<a href="{{ url('admin/vivahmitra_products') }}" class="btn btn-primary ms-auto">Vivah Mitra Data List</a>
						</div>
						<div class="card-body booking_card">
							<form method="post" id="update-speciality-form" action="{{ route('admin.vivahmitra_products.update',$product->id) }}" enctype="multipart/form-data">
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
											<label>Select Category <span class="text-danger">*</span> </label>
										   <select placeholder="Enter Category Name" class="form-control select2" name="category_id" data-toggle="select2" data-placeholder="Choose ..." data-live-search="true">
												<option value="">-- Select Parent --</option>
												@foreach ($categories as $category)
													@include('admin.vivah_mitra.category.partials.edit_category_options', [
														'category' => $category,
														'level' => 0,
														'data' => $product ?? null
													])
												@endforeach
											</select>
										</div>
									</div>
								
								<div class="col-xxl-12 col-lg-4 col-sm-6 mb-3">
                                    <div class="form-group">
                                        <label>Title<span class="text-danger">*</span> </label>
                                        <input type="text" placeholder="Enter Product Name" value="{{ $product['name']; }}"  class="form-control" name="name">
                                    </div>
                                </div>
								
								<div class="col-xxl-12 col-lg-4 col-sm-6 mb-3">
                                    <div class="form-group">
                                        <label>Slug (URL) <span class="text-danger">*</span> </label>
                                        <input type="text" placeholder="Enter Product Name" value="{{ $product['slug']; }}"  class="form-control" name="slug">
                                    </div>
                                </div>
								
								 
								
								<div class="col-xxl-12 col-lg-4 col-sm-6 mb-3">
                                    <div class="form-group">
                                        <label>Description <span class="text-danger">*</span> </label>
                                        <textarea id="summernote1" placeholder="Enter " class="form-control" name="description">
											{{ $product['description'] }}
										</textarea>
                                    </div>
                                </div> 
			
								  
								 
								
								
								<div class="col-xxl-6 col-lg-4 col-sm-6 mb-3">
                                    <div class="form-group">
                                        <label>Thumbnail (Photo) <span class="text-danger">*</span> </label>
                                        <input type="file" class="form-control" name="thumbnail">
										<img style="margint-top:5px;max-width: 100px;width:100px;" src="{{ static_asset($product->thumbnail) }}">
                                    </div>
                                </div>
								
								<div class="col-xxl-6 col-lg-4 col-sm-6 mb-3">
                                    <div class="form-group">
                                        <label>Product Gallery (Select Multiple Photos) <span class="text-danger">*</span> </label>
                                        <input type="file" class="form-control" name="images[]" multiple>
                                    </div>
                                </div>
								
									 
								</div>	
								
								<!-- Card acrions starts -->
								<div class="d-flex gap-2 justify-content-end mt-4">
								 
								 <button type="submit" class="btn btn-primary buttonedit1 update-button">Update</button>
								</div>
							</form>

						</div>
					</div>
				</div>
			</div>
		</div>

    </div>
</div>



 
 


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
            url: "{{ route('admin.vivahmitra_products.update',$product->id) }}",
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
	
	<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "Search Items",
            allowClear: true
        });
    });
</script>

@endsection
 