@extends('admin.include.master')
@section('title', 'Vivah Mitra Management')
@section('content')



<!-- Page Header -->
	<div style="background:linear-gradient(45deg, #f33057, rgb( 56, 88, 249 ) );"  class="d-sm-flex d-block align-items-center justify-content-between page-header-breadcrumb">
		<div>
			<h4 class="fw-medium mb-2">Vivah Mitra Management</h4>
			<div class="ms-sm-1 ms-0">
				<nav>
					<ol class="breadcrumb mb-0">
						<li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
						<li class="breadcrumb-item active fw-normal" aria-current="page">Update App Sliders</li>
					</ol>
				</nav>
			</div>
		</div>

	</div>
<!-- Page Header Close -->
	<div class="main-content app-content">

       <!--Manage Footer Logo  -->
        <div class="row mb-3">
		
            <div class="col-sm-12 w-100 mx-auto">
                <div class="card">
				<div class="card-header d-flex justify-content-between align-items-center">

					<h5 class="mb-0">Edit App Sliders</h5>

					<a href="{{ url('admin/website/vivah-mitra-app-sliders') }}"
					   class="btn btn-danger btn-sm float-end">
					   Vivah Mitra App Slider List
					</a>


				</div>
								
                    <div class="card-body booking_card">
                        <form method="post" id="update-footer-logo-form" action="{{ route('admin.updatevivahMitraAppSliders') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row formtype">

								<div class="col-md-12 mb-3">
									<div style="display:none;" id="show-footer-logo-form-error" class="alert alert-danger col-md-12">
										<ul>
											<div class="errorMsgntainer"></div>
										</ul>
									</div>
								</div>
								
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
								<input type="hidden" name="id" value="{{ $home_banner->id }}">
                                <div class="col-md-12 mb-3">
                                    <div class="form-group d-flex align-items-center">
                                        <label class="col-md-2"><strong>Title Big font </strong></label>
                                        <div class="col-md-10">
                                            <input type="text" value="{{ $home_banner->title }}" placeholder="Title Big font" class="form-control" name="title">
                                        </div>
                                    </div>
                                </div>
								
								<div class="col-md-12 mb-3">
                                    <div class="form-group d-flex align-items-center">
                                        <label class="col-md-2"><strong>Description Small font </strong></label>
                                        <div class="col-md-10">
                                            <input type="text" value="{{ $home_banner->description }}" placeholder="Description Small font" class="form-control" name="description">
                                        </div>
                                    </div>
                                </div>
								
								<div class="col-md-12 mb-3">
                                    <div class="form-group d-flex align-items-center">
                                        <label class="col-md-2"><strong>Image </strong></label>
                                        <div class="col-md-10">
                                            <input type="file" class="form-control" name="image">
											<img height="60" class="mt-3" src="{{ static_asset($home_banner->image) }}">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <button type="submit" class="btn btn-primary buttonedit1 addHomeBanner">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        

         

    </div>
 
<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<script type="text/javascript">

/* website footer script */
	/*
	$(document).on('click', '. update-footer-button', function(e) {
        e.preventDefault();
        var clk_btn = $(". update-footer-button");
        clk_btn.prop('disabled', true).text('Updating...');

        var formData = new FormData(document.getElementById("update-footer-logo-form"));
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "POST",
            url: "{{ route('admin.website.update') }}",
            data: formData,
            processData: false,
            contentType: false,
            dataType: "JSON",
            success: function(data) {
                if (data.status == true) {
                    toastr.success(data.message);
                    location.reload();
                    
                } else {
                    toastr.error(data.message);
                    clk_btn.prop('disabled', false).text('Login'); // Reset button text
                }
            },
            error: function(err) {
                document.getElementById('show-footer-logo-form-error').style = "display: block";
                clk_btn.prop('disabled', false).text('Update'); // Reset button text
                let error = err.responseJSON;
                $('.errorMsgntainer').html(''); // Clear previous errors
                $.each(error.errors, function(index, value) {
                    $('.errorMsgntainer').append('<span style="color:red;" class="text-danger">' + value + '<span>' + '<br>');
                });
            }
        });
    });
	*/

    function addNewRow(append_id){
        newRowAdd =
            '<div class="row my-2 w-100" id="row"><div class="col-md-12 d-flex">'+
            '<input type="text" class="form-control mx-1" name="widget_lables[]" placeholder="Lable">'+
            '<input type="text" class="form-control mx-1" name="widget_links[]" placeholder="Link">'+
            '<div class="input-group-prepend mx-1">'+
            '<button class="btn btn-danger" id="DeleteRow" type="button">'+
            '<i class="fa fa-trash"></i> </button>'+
            '</div></div></div>';

        $(append_id).append(newRowAdd);
    }

    $("#widget_one_row_adder").click(function () {
        addNewRow("#new_widget_one_input");
    });

    $("#widget_two_row_adder").click(function () {
        addNewRow("#new_widget_two_input");
    });

    $("#widget_three_row_adder").click(function () {
        addNewRow("#new_widget_three_input");
    });

    $("body").on("click", "#DeleteRow", function () {
        $(this).parents("#row").remove();
    })
	
	
	
	
	
	
</script>

@endsection
