@extends('admin.include.master')
@section('title', 'Add Products')
@section('content')

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<style>
  .big-toggle {
      width: 3rem;
      height: 1.5rem;
  }

  .big-toggle:checked {
      background-color: #0d6efd;
  }

  .big-toggle::before {
      height: 1.3rem;
      width: 1.3rem;
      top: 0.1rem;
      left: 0.1rem;
  }

  select.form-control.selectpicker:hover {
    pointer-events: none;
}

.card-shadow, .app-footer, .card {
    /* box-shadow: 0px 2px 6px rgba(40, 90, 185, .1); */
}

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

    table.table-bordered td,
    table.table-bordered th {
        border: 1px solid #dee2e6 !important;
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
						<li class="breadcrumb-item  active fw-normal" aria-current="page">Add Product</li>
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
						<h5 class="card-title">Add Products</h5>
						<a href="{{ url('admin/products') }}" class="btn btn-primary ms-auto">Products List</a>
					</div>
                    <div class="card-body booking_card">
                        <form method="post" id="add-speciality-form" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
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
								
								<div class="col-xxl-4 col-lg-4 col-sm-6 mb-3">
                                    <div class="form-group">
                                        <label>Select Category <span class="text-danger">*</span> </label>
                                        <select placeholder="Enter Category Name" class="form-control select2" name="category_id" data-toggle="select2" data-placeholder="Choose ..." data-live-search="true">
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
								<div class="col-xxl-4 col-lg-4 col-sm-6 mb-3">
                                    <div class="form-group">
                                        <label>Select Brand <span class="text-danger">*</span> </label>
                                       <select class="form-control select2" name="brand_id" data-toggle="select2" data-placeholder="Choose ..." data-live-search="true">
											<option value="">-- Select Brand --</option>
											@foreach ($brand_list as $val)
												<option  @if($val->id==old('brand_id')) selected @endif value="{{ $val->id }}">{{ $val->name }}</option>
											@endforeach
										</select>
                                    </div>
                                </div>
								

								<div class="col-xxl-4 col-lg-4 col-sm-6 mb-3">
                                    <div class="form-group">
                                        <label>Product Name <span class="text-danger">*</span> </label>
                                        <input type="text" value="{{ old('name') }}" placeholder="Enter Product Name" class="form-control" name="name">
                                    </div>
                                </div>

								<div class="col-xxl-4 col-lg-4 col-sm-6 mb-3">
                                    <div class="form-group">
                                        <label>Product Weight <span class="text-danger">*</span> </label>
                                        <input type="text" value="{{ old('product_weight') }}" placeholder="Enter Product Weight" class="form-control" name="product_weight">
                                    </div>
                                </div>

								<div class="col-xxl-4 col-lg-4 col-sm-6 mb-3">
                                    <div class="form-group">
                                        <label>Product Unit <span class="text-danger">*</span> </label>
                                        <select type="text" class="form-control selectpicker" name="product_unit" data-live-search="true" title="Select Product Unit">
											<option value="Kg">Kilogram</option>
											<option value="g">Gram</option>
											<option value="mg">Milligram</option>
											<option value="L">Liter</option>
											<option value="ml">Milliliter</option>
											<option value="pcs">Piece</option>
											<option value="pkt">Packet</option>
											<option value="doz">Dozen</option>
											<option value="m">Meter</option>
											<option value="cm">Centimeter</option>
											<option value="mm">Millimeter</option>
											<option value="ft">Feet</option>
											<option value="inch">Inch</option>
											<option value="sqft">Square Feet</option>
											<option value="sqm">Square Meter</option>
											<option value="roll">Roll</option>
											<option value="set">Set</option>
											<option value="box">Box</option>
											<option value="bottle">Bottle</option>
											<option value="can">Can</option>
											<option value="jar">Jar</option>
											<option value="tube">Tube</option>
											<option value="bundle">Bundle</option>
											<option value="pair">Pair</option>
											<option value="strip">Strip</option>
											<option value="tablet">Tablet</option>
											<option value="capsule">Capsule</option>
										</select>
                                    </div>
                                </div>

								<div class="col-xxl-4 col-lg-4 col-sm-6 mb-3">
									<div class="form-group">
										<label>Enter Purchase Price <span class="text-danger">*</span></label>
										<input type="number" id="purchase_price" class="form-control" name="purchase_price" placeholder="Enter Purchase Price">
									</div>
								</div>

								<div class="col-xxl-4 col-lg-4 col-sm-6 mb-3">
									<div class="form-group">
										<label>Offer Price</label>
										<input type="number" placeholder="Offer Price" id="offer_price" class="form-control" name="offer_price">
									</div>
								</div>

								<div class="col-xxl-4 col-lg-4 col-sm-6 mb-3">
                                    <div class="form-group">
                                        <label>Thumbnail (Photo) <span class="text-danger">*</span> </label>
                                        <input type="file" class="form-control" name="thumbnail">
                                    </div>
                                </div>

								<div class="col-xxl-4 col-lg-4 col-sm-6 mb-3">
                                    <div class="form-group">
                                        <label>Product Gallery (Select Multiple Photos) <span class="text-danger">*</span> </label>
                                        <input type="file" class="form-control" name="images[]" multiple>
                                    </div>
                                </div>

								<div class="col-xxl-12 col-lg-12 col-sm-6 mb-3">
                                    <div class="form-group">
                                        <label>Short Description <span class="text-danger">*</span> </label>
                                        <input type="text" placeholder="Enter Short Description" class="form-control" value="{{ old('short_description') }}" name="short_description">
                                    </div>
                                </div>

								<div class="col-xxl-12 col-lg-12 col-sm-6 mb-3">
                                    <div class="form-group">
                                        <label>Description <span class="text-danger">*</span> </label>
                                        <textarea id="summernote1" placeholder="Enter " class="form-control" name="description">{{ old('description') }}</textarea>
                                    </div>
                                </div>

								<div class="col-xxl-12 col-lg-12 col-sm-6 mb-3">
                                    <div class="form-group">
                                        <label>Plant Care</label>
                                        <textarea id="summernote2" placeholder="Enter Plant Care" class="form-control" name="plant_care">{{ old('plant_care') }}</textarea>
                                    </div>
                                </div>

								<div class="col-xxl-12 col-lg-12 col-sm-6 mb-3">
                                    <div class="form-group">
                                        <label>Additional Information</label>
                                        <textarea id="summernote3" placeholder="Enter Additional Information" class="form-control" name="additional_information">{{ old('additional_information') }}</textarea>
                                    </div>
                                </div>


							</div>
						 
						
						 
	
							<div class="row">
								 
								<h4 class="mb-3" >For Product SEO</h4>
								<div class="col-xxl-4 col-lg-4 col-sm-6 mb-3">
                                    <div class="form-group">
                                        <label>Meta Title</label>
                                        <input type="text" placeholder="Enter Meta Title" class="form-control" value="{{ old('meta_title') }}" name="meta_title">
                                    </div>
                                </div>
								<div class="col-xxl-4 col-lg-4 col-sm-6 mb-3">
                                    <div class="form-group">
                                        <label>Meta Keywords</label>
                                        <input type="text" placeholder="Enter Meta Keywords" class="form-control" value="{{ old('meta_keywords') }}" name="meta_keywords">
                                    </div>
                                </div>
								<div class="col-xxl-4 col-lg-4 col-sm-6 mb-3">
                                    <div class="form-group">
                                        <label>Meta Description</label>
                                        <input type="text" placeholder="Enter Meta Description" class="form-control" value="{{ old('meta_description') }}" name="meta_description">
                                    </div>
                                </div>

								<div class="col-xxl-3 col-lg-4 col-sm-6 mb-3">
									<div class="form-group">
										<label for="is_featured" class="">Is Featured <span class="text-danger">*</span></label>
										<div class="form-check form-switch">
											<input class="form-check-input toggle-status big-toggle" type="checkbox" id="is_featured" name="is_featured" value="1">
										</div>
									</div>
								</div>

								<div class="col-xxl-3 col-lg-4 col-sm-6 mb-3">
									<div class="form-group">
										<label for="is_featured" class="">Is New <span class="text-danger">*</span></label>
										<div class="form-check form-switch">
											<input class="form-check-input toggle-status big-toggle" type="checkbox" id="is_new" name="is_new" value="1">
										</div>
									</div>
								</div>

								<div class="col-xxl-3 col-lg-4 col-sm-6 mb-3">
									<div class="form-group">
										<label for="is_featured" class="">Status <span class="text-danger">*</span></label>
										<div class="form-check form-switch">
											<input class="form-check-input toggle-status big-toggle" type="checkbox" id="status" name="status" value="1">
										</div>
									</div>
								</div>
							</div>
                            <!-- Card acrions starts -->
							<div class="d-flex gap-2 justify-content-end mt-4">
							  <button type="submit" class="btn btn-primary buttonedit1 add-buttons">Add</button>
							</div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        </div>

    </div>
</div>
<!-- jQuery -->

   
	<script>

 

	$(document).on('click', '.add-buttons', function(e) {
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
            url: "{{ route('admin.products.store') }}",
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
 
