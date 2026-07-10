@extends('admin.include.master')
@section('title') 
	{{ $page_title }}
@endsection
@section('content')

<!-- Page Header -->
            <div style="background:linear-gradient(45deg, #f33057, rgb( 56, 88, 249 ) );" class="d-sm-flex d-block align-items-center justify-content-between page-header-breadcrumb">
                <div>
                    <h4 class="fw-medium mb-2">{{ $page_title }}</h4>
                    <div class="ms-sm-1 ms-0">
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a class="" href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item  active fw-normal" aria-current="page">{{ $page_title }}</li>
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

								<h5 class="mb-0">{{ $page_title }}</h5>

								<a href="{{ url('admin/shop-list') }}" class="btn btn-danger btn-sm float-end">
								   Shop List
								</a>


							</div>

 
                            <div class="card-body">
							
							<div class="container">
								<form id="update-agreement-Form" enctype="multipart/form-data">
									<div class="row">
									
										<div style="display:none;" id="show-agree-form-error" class="alert alert-danger col-md-12">
											<ul>
												<div class="errorMsgntainer"></div>
											</ul>
										</div>
										
										<input type="hidden" value="{{ $shop->id }}" name="shop_id">

										<div class="col-md-6 mb-3">
											<label class="">Shop Name <span class="text-danger">*</span></label>
											<input type="text" name="name" value="{{ $shop->name }}" id="name" class="form-control" placeholder="Title">
										</div>

										<div class="col-md-6 mb-3">
											<label class="">Investor Name <span class="text-danger">*</span></label>
											<input type="text" name="investor_name" value="{{ $shop->investor_name }}" id="investor_name" class="form-control" placeholder="Investor Name">
										</div>

										<div class="col-md-6 mb-3">
											<label class="">Opening Date <span class="text-danger">*</span> </label>
											<input type="date" name="opening_date" value="{{ $shop->opening_date }}" id="opening_date" class="form-control">
										</div>

										<div class="col-md-6 mb-3">
											<label class="">No. of Stock <span class="text-danger">*</span></label>
											<input type="text" name="stock" value="{{ $shop->stock }}" id="stock" class="form-control" placeholder="No. of Stock">
										</div>

										<div class="col-md-6 mb-3">
											<label class="">Profit <span class="text-danger">*</span></label>
											<input type="text" name="profit" value="{{ $shop->profit }}" id="profit" class="form-control" placeholder="Profit">
										</div>

										<div class="col-md-6 mb-3">
											<label class="">Shop Status <span class="text-danger">*</span></label>
											<select id="shop_status" name="shop_status" class="form-control">
												<option value="">Shop Status</option>
												<option @if($shop->shop_status=='average') selected @endif value="average">Average</option>
												<option @if($shop->shop_status=='loss') selected @endif value="loss">Loss</option>
												<option @if($shop->shop_status=='profitable') selected @endif value="profitable">Profitable</option>
												<option @if($shop->shop_status=='super_duper_idea') selected @endif value="super_duper_idea">Super Duper Idea</option>
											</select>
										</div>

										<div class="col-md-6 mb-3">
											<label class="">Investor Photo (Photo only) <span class="text-danger">*</span></label>
											<input type="file" name="investor_photo" accept="image/*" id="investor_photo" class="form-control">
											<img style="height:120px;" src="{{ static_asset($shop->investor_photo) }}" class="img-fluid mt-3" alt="">
										</div>

										<div class="col-md-6 mb-3">
											<label class="">Investor Agreement (PDF only) <span class="text-danger">*</span></label>
											<input type="file" name="investor_agreement" accept="application/pdf" id="investor_agreement" class="form-control">
											<a href="{{ static_asset($shop->investor_agreement) }}" target="_blank" class="btn btn-danger btn-sm mt-3">Check Agreement</a>
										</div>

									</div>
									
									<div class="row">
									
										
										
										<div class="col-md-3">
											<div class="form-group mt-4">
												<button class="btn btn-success updateAgreementBtn" type="submit" title="Update">
													Update
												</button>
												 
											</div>
										</div>
									</div>
								</form>
							</div>
							 
										
										
  
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End:: row-2 -->



                </div>
            </div>
            <!--APP-CONTENT CLOSE-->
		 
		
<script>
 

	$(document).on('click', '.updateAgreementBtn', function(e) {
		e.preventDefault();
		 let id = {{ $shop->id }};
        var clk_btn = $(".updateAgreementBtn");
        clk_btn.prop('disabled', true);
        var formData = new FormData(document.getElementById("update-agreement-Form"));
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: "{{ url('admin/shop-list/update') }}/" + id,
            data: formData,
            processData: false,
            contentType: false,
            dataType: "JSON",
			success: function(data) {
                console.log('status ' + data.status);
                if (data.status == true) {
                    Swal.fire({
						icon: "success",
						title: "Success",
						text: data.message,
						timer: 1500,
						showConfirmButton: false
					});
					document.getElementById('show-agree-form-error').style = "display: none";
                    // location.reload();
					clk_btn.prop('disabled', false);
                } else {
                    Swal.fire({
						icon: "error",
						title: "Oh No!",
						text: "Something went wrong!",
						timer: 1500,
						showConfirmButton: false
					});
					//toastr.error('Something went wrong.');
					clk_btn.prop('disabled', false);
                }
            }, error: function(err) {

                document.getElementById('show-agree-form-error').style = "display: block";
                clk_btn.prop('disabled', false);
                let error = err.responseJSON;
                console.log(error);
                $.each(error.errors, function(index, value) {
                    $('.errorMsgntainer').append('<span class="text-danger">' + value +

                        '<span>' + '<br>');
                });

            }
        });
    });
	
	$(document).ready(function () {
		$('#type').on('change', function () {
			var userTypeId = $(this).val();
			if (userTypeId) {
				$.ajax({
					url: '{{ url("admin/get-designation-by-user") }}/' + userTypeId,
					type: "GET",
					dataType: "json", 
					success: function (data) {
						$('#user_designation_id').empty();
						$('#user_designation_id').append('<option value="">Select Designation</option>');
						$.each(data, function (key, value) {
							$('#user_designation_id').append('<option value="' + value.id + '">' + value.name + '</option>');
						});
					}
				});
			} else {
				$('#user_designation_id').empty();
				$('#user_designation_id').append('<option value="">Select Designation</option>');
			}
		});
	});
 
</script>




@endsection

