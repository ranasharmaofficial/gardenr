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
						<h5 class="card-title">Add {{ $page_title }}</h5>
						<a href="{{ url('admin/navigations') }}" class="btn btn-primary ms-auto btn-sm">{{ $page_title }} List</a>
					</div>
                    <div class="card-body booking_card">
                        <form method="post" id="add-navigation-form" action="" enctype="multipart/form-data">
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
								
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
										  <label>Navigation Title<span class="text-danger">*</span></label>
										  <input type="text" name="name" id="name" class="form-control" placeholder="Navigation Title" required="" autofocus="true">
										</div>  
									</div>

									<div class="col-md-4">
										<div class="form-group">
										  <label>Navigation Icon</label>
										  <input type="text" name="icon" id="icon" class="form-control" placeholder="Navigation Icon">
										</div>  
									</div>

									<div class="col-md-4">
										<div class="form-group">
										  <label>Navigation Order</label>
										  <input type="number" name="sort_order" id="sort_order" class="form-control" placeholder="Navigation Order" min="0" value="0">
										</div>  
									</div>

								</div> 
								<div class="row">
								
								<div class="col-md-4">
									  <div class="form-group">
										  <label>Head</label>
											<select name="parent_id" id="parent_id" class="form-control" title="Select Head">
												 
													<option value="0">Own</option>
												 
											</select>
									  </div>  
									</div>
									
									
									
									

									 

									<div class="col-md-4">
									  <div class="form-group">
										  <label>Status</label>
										  <select name="status" id="status" class="form-control" title="Select Status">
											 <option value="1">Active</option>
											 <option value="0">In-Active</option>
										  </select>
									  </div>  
									</div>

								</div> 
								<div class="row">

									<div class="col-md-6">
									  <div class="form-group">
										  <label>Link (Route)</label>
										  <input name="route"  id="route" class="form-control" placeholder="Link" />
									  </div>  
									</div>
									 
								</div>

							</div>
                            <!-- Card acrions starts -->
							<div class="d-flex gap-2 justify-content-end mt-4">
							  <button type="submit" id="btn-add-navigation" class="btn btn-primary buttonedit1 add-button">Add</button>
							</div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        </div>

    

<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
	<script>
	$(document).on('click', '#btn-add-navigation', function(e) {
        e.preventDefault();
        var clk_btn = $("#btn-add-navigation");
        clk_btn.prop('disabled', true).text('Adding...');

        var formData = new FormData(document.getElementById("add-navigation-form"));
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "POST",
            url: "{{ route('admin.navigations.store') }}",
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

 
