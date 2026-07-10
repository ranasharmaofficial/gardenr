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
                    <h4 class="fw-medium mb-2">Products</h4>
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
							<h5 class="card-title">Update Product</h5>
							<a href="{{ url('admin/products') }}" class="btn btn-primary ms-auto">Product List</a>
						</div>
						<div class="card-body booking_card">
							<form method="post" id="update-speciality-form" action="{{ route('admin.products.update',$product->id) }}" enctype="multipart/form-data">
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
									
									<div class="col-xxl-4 col-lg-4 col-sm-6 mb-3">
										<div class="form-group">
											<label>Select Category <span class="text-danger">*</span> </label>
										   <select placeholder="Enter Category Name" class="form-control select2" name="category_id" data-toggle="select2" data-placeholder="Choose ..." data-live-search="true">
												<option value="">-- Select Parent --</option>
												@foreach ($categories as $category)
													@include('admin.product.category.partials.edit_category_options', [
														'category' => $category,
														'level' => 0,
														'data' => $product ?? null
													])
												@endforeach
											</select>
										</div>
									</div>
								
								<div class="col-xxl-4 col-lg-4 col-sm-6 mb-3">
                                    <div class="form-group">
                                        <label>Select Brand <span class="text-danger">*</span> </label>
                                       <select class="form-control select2" name="brand_id" data-toggle="select2" data-placeholder="Choose ..." data-live-search="true">
											<option value="">-- Select Brand --</option>
											@foreach ($brand_list as $val)
												<option @if($product['brand_id']==$val->id) selected @endif  value="{{ $val->id }}">{{ $val->name }}</option>
											@endforeach
										</select>
                                    </div>
                                </div>
								
								<div class="col-xxl-12 col-lg-4 col-sm-6 mb-3">
                                    <div class="form-group">
                                        <label>Product Name <span class="text-danger">*</span> </label>
                                        <input type="text" placeholder="Enter Product Name" value="{{ $product['name']; }}"  class="form-control" name="name">
                                    </div>
                                </div>
								
								<div class="col-xxl-12 col-lg-4 col-sm-6 mb-3">
                                    <div class="form-group">
                                        <label>Slug (URL) <span class="text-danger">*</span> </label>
                                        <input type="text" placeholder="Enter Product Name" value="{{ $product['slug']; }}"  class="form-control" name="slug">
                                    </div>
                                </div>
								
								<div class="col-xxl-4 col-lg-4 col-sm-6 mb-3">
                                    <div class="form-group">
                                        <label>Product Weight <span class="text-danger">*</span> </label>
                                        <input type="text" placeholder="Enter Product Weight" value="{{ $product['product_weight']; }}"  class="form-control" name="product_weight">
                                    </div>
                                </div>
								
								<div class="col-xxl-4 col-lg-4 col-sm-6 mb-3">
                                    <div class="form-group">
                                        <label>Product Unit <span class="text-danger">*</span> </label>
                                        <select type="text" class="form-control selectpicker" name="product_unit" data-live-search="true" title="Select Product Unit">
											<option @if($product['product_unit']=='Kg') selected @endif value="Kg">Kilogram</option>
											<option @if($product['product_unit']=='g') selected @endif value="g">Gram</option>
											<option @if($product['product_unit']=='mg') selected @endif value="mg">Milligram</option>
											<option @if($product['product_unit']=='L') selected @endif value="L">Liter</option>
											<option @if($product['product_unit']=='ml') selected @endif value="ml">Milliliter</option>
											<option @if($product['product_unit']=='pcs') selected @endif value="pcs">Piece</option>
											<option @if($product['product_unit']=='pkt') selected @endif value="pkt">Packet</option>
											<option @if($product['product_unit']=='doz') selected @endif value="doz">Dozen</option>
											<option @if($product['product_unit']=='m') selected @endif value="m">Meter</option>
											<option @if($product['product_unit']=='cm') selected @endif value="cm">Centimeter</option>
											<option @if($product['product_unit']=='mm') selected @endif value="mm">Millimeter</option>
											<option @if($product['product_unit']=='ft') selected @endif value="ft">Feet</option>
											<option @if($product['product_unit']=='inch') selected @endif value="inch">Inch</option>
											<option @if($product['product_unit']=='sqft') selected @endif value="sqft">Square Feet</option>
											<option @if($product['product_unit']=='sqm') selected @endif value="sqm">Square Meter</option>
											<option @if($product['product_unit']=='roll') selected @endif value="roll">Roll</option>
											<option @if($product['product_unit']=='set') selected @endif value="set">Set</option>
											<option @if($product['product_unit']=='box') selected @endif value="box">Box</option>
											<option @if($product['product_unit']=='bottle') selected @endif value="bottle">Bottle</option>
											<option @if($product['product_unit']=='can') selected @endif value="can">Can</option>
											<option @if($product['product_unit']=='jar') selected @endif value="jar">Jar</option>
											<option @if($product['product_unit']=='tube') selected @endif value="tube">Tube</option>
											<option @if($product['product_unit']=='bundle') selected @endif value="bundle">Bundle</option>
											<option @if($product['product_unit']=='pair') selected @endif value="pair">Pair</option>
											<option @if($product['product_unit']=='strip') selected @endif value="strip">Strip</option>
											<option @if($product['product_unit']=='tablet') selected @endif value="tablet">Tablet</option>
											<option @if($product['product_unit']=='capsule') selected @endif value="capsule">Capsule</option>
										</select>
                                    </div>
                                </div>
								
								
								
								<div class="col-xxl-4 col-lg-4 col-sm-6 mb-3">
									<div class="form-group">
										<label>Enter Purchase Price <span class="text-danger">*</span></label>
										<input type="number" value="{{ $product['purchase_price']; }}" id="purchase_price" class="form-control"
											   name="purchase_price" placeholder="Enter Purchase Price">
									</div>
								</div>
								
								

								<div class="col-xxl-4 col-lg-4 col-sm-6 mb-3">
									<div class="form-group">
										<label>Offer Price</label>
										<input type="number" value="{{ $product['offer_price']; }}" id="offer_price" class="form-control" name="offer_price">
									</div>
								</div>
								
								 
								
								<div class="col-xxl-12 col-lg-12 col-sm-6 mb-3">
                                    <div class="form-group">
                                        <label>Short Description <span class="text-danger">*</span> </label>
                                        <input type="text" value="{{ $product['short_description']; }}" placeholder="Enter Short Description" class="form-control" name="short_description">
                                    </div>
                                </div> 
								
								<div class="col-xxl-12 col-lg-12 col-sm-6 mb-3">
                                    <div class="form-group">
                                        <label>Description <span class="text-danger">*</span> </label>
                                        <textarea id="summernote1" placeholder="Enter " class="form-control" name="description">
											{{ $product['description'] }}
										</textarea>
                                    </div>
                                </div> 

								<div class="col-xxl-12 col-lg-12 col-sm-6 mb-3">
                                    <div class="form-group">
                                        <label>Plant Care</label>
                                        <textarea id="summernote2" placeholder="Enter Plant Care" class="form-control" name="plant_care">
											{{ $product['plant_care'] }}
										</textarea>
                                    </div>
                                </div> 

								<div class="col-xxl-12 col-lg-12 col-sm-6 mb-3">
                                    <div class="form-group">
                                        <label>Additional Information</label>
                                        <textarea id="summernote3" placeholder="Enter Additional Information" class="form-control" name="additional_information">
											{{ $product['additional_information'] }}
										</textarea>
                                    </div>
                                </div> 
			
								  
								<h4 class="mb-3" >For Product SEO</h4>
								<div class="col-xxl-4 col-lg-4 col-sm-6 mb-3">
                                    <div class="form-group">
                                        <label>Meta Title</label>
                                        <input type="text" placeholder="Enter Meta Title" value="{{ $product['meta_title']; }}" class="form-control" name="meta_title">
                                    </div>
                                </div>
								<div class="col-xxl-4 col-lg-4 col-sm-6 mb-3">
                                    <div class="form-group">
                                        <label>Meta Keywords</label>
                                        <input type="text" placeholder="Enter Meta Keywords" value="{{ $product['meta_keywords']; }}" class="form-control" name="meta_keywords">
                                    </div>
                                </div>
								<div class="col-xxl-4 col-lg-4 col-sm-6 mb-3">
                                    <div class="form-group">
                                        <label>Meta Description</label>
                                        <input type="text" value="{{ $product['meta_description']; }}" placeholder="Enter Meta Description" class="form-control" name="meta_description">
                                    </div>
                                </div>
                                
								<div class="col-xxl-3 col-lg-4 col-sm-6 mb-3">
									<div class="form-group">
										<label for="is_featured" class="form-label">Is Featured <span class="text-danger">*</span></label>
										<div class="form-check form-switch">
											<input class="form-check-input toggle-status big-toggle" @if($product['is_featured']=='1') checked @endif type="checkbox" id="is_featured" name="is_featured" value="1">
										</div>
									</div>
								</div>
								
								<div class="col-xxl-3 col-lg-4 col-sm-6 mb-3">
									<div class="form-group">
										<label for="is_featured" class="form-label">Is New <span class="text-danger">*</span></label>
										<div class="form-check form-switch">
											<input class="form-check-input toggle-status big-toggle" @if($product['is_new']=='1') checked @endif type="checkbox" id="is_new" name="is_new" value="1">
										</div>
									</div>
								</div>
								
								<div class="col-xxl-3 col-lg-4 col-sm-6 mb-3">
									<div class="form-group">
										<label for="is_featured" class="form-label">Status <span class="text-danger">*</span></label>
										<div class="form-check form-switch">
											<input class="form-check-input toggle-status big-toggle" @if($product['status']=='1') checked @endif type="checkbox" id="status" name="status" value="1">
										</div>
									</div>
								</div>
								
								
								<div class="col-xxl-6 col-lg-4 col-sm-6 mb-3">
                                    <div class="form-group">
                                        <label>Thumbnail (Photo) <span class="text-danger">*</span> </label>
                                        <input type="file" class="form-control" name="thumbnail">
										<img style="margint-top:5px;max-width: 100px;width:100px;" src="{{ static_asset($product->thumbnail) }}">
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
            url: "{{ route('admin.products.update',$product->id) }}",
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
	
	/* price calculations */
	
	document.getElementById('purchase_price').addEventListener('input', function () {
		let purchasePrice = parseFloat(this.value);

		if (isNaN(purchasePrice) || purchasePrice <= 0) {
			document.getElementById('price_45').value = '';
			document.getElementById('price_50').value = '';
			document.getElementById('price_62').value = '';
			document.getElementById('price_80').value = '';
			return;
		}

		document.getElementById('price_45').value = (purchasePrice * 1.45).toFixed(2);
		document.getElementById('price_50').value = (purchasePrice * 1.50).toFixed(2);
		document.getElementById('price_62').value = (purchasePrice * 1.62).toFixed(2);
		document.getElementById('price_80').value = (purchasePrice * 1.80).toFixed(2);
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
 