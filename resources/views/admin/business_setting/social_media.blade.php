@extends('admin.include.master')
@section('title', 'Update Social Media')
@section('content')

<!-- Page Header -->
	<div style="background:linear-gradient(45deg, #f33057, rgb( 56, 88, 249 ) );"  class="d-sm-flex d-block align-items-center justify-content-between page-header-breadcrumb">
		<div>
			<h4 class="fw-medium mb-2">Business Setting</h4>
			<div class="ms-sm-1 ms-0">
				<nav>
					<ol class="breadcrumb mb-0">
						<li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
						<li class="breadcrumb-item active fw-normal" aria-current="page">Manage Social Media Icons</li>
					</ol>
				</nav>
			</div>
		</div>

	</div>
<!-- Page Header Close -->
	<div class="main-content app-content">

        <div class="row mt-3">
            <div class="col-sm-12 w-75 mx-auto">
                <div class="card">
                    <div class="card-body booking_card">
                        <form method="post" id="update-socialmedia-form" action="#">
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

                                <input type="hidden" class="form-control" name="type" value="social_media" required>

								<div class="col-md-12 mb-3">
									<div style="display:none;" id="show-form-error" class="alert alert-danger col-md-12">
										<ul>
											<div class="errorMsgntainer"></div>
										</ul>
									</div>
								</div>
								<div class="col-md-12 mb-3">
                                    <div class="form-group d-flex align-items-center">
                                        <label class="col-md-3"><strong>Facebook ID </strong></label>
                                        <div class="col-md-9">
                                            <input type="hidden" class="form-control" name="field_names[]" value="facebook" required>
                                            <input type="text" class="form-control" name="values[]" value="{{ $social_meadia_values[0]->value }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <div class="form-group d-flex align-items-center">
                                        <label class="col-md-3"><strong>Twitter ID </strong></label>
                                        <div class="col-md-9">
                                            <input type="hidden" class="form-control" name="field_names[]" value="twitter" required>
                                            <input type="text" class="form-control" name="values[]" value="{{ $social_meadia_values[1]->value }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <div class="form-group d-flex align-items-center">
                                        <label class="col-md-3"><strong>Linkedin ID </strong></label>
                                        <div class="col-md-9">
                                            <input type="hidden" class="form-control" name="field_names[]" value="linkedin" required>
                                            <input type="text" class="form-control" name="values[]" value="{{ $social_meadia_values[2]->value }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <div class="form-group d-flex align-items-center">
                                        <label class="col-md-3"><strong>Youtube </strong></label>
                                        <div class="col-md-9">
                                            <input type="hidden" class="form-control" name="field_names[]" value="youtube" required>
                                            <input type="text" class="form-control" name="values[]" value="{{ $social_meadia_values[3]->value }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <div class="form-group d-flex align-items-center">
                                        <label class="col-md-3"><strong>Instagram ID </strong></label>
                                        <div class="col-md-9">
                                            <input type="hidden" class="form-control" name="field_names[]" value="instagram" required>
                                            <input type="text" class="form-control" name="values[]" value="{{ $social_meadia_values[4]->value }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary buttonedit1 update-button">Update</button>
                        </form>

                    </div>
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
        clk_btn.prop('disabled', true).text('Updating...'); // Change text to Logging In...

        var formData = new FormData(document.getElementById("update-socialmedia-form"));
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
                    // setTimeout(function(){
                        // window.location = "{{ url('admin/dashboard') }}" },1000);
                } else {
                    toastr.error(data.message);
                    clk_btn.prop('disabled', false).text('Login'); // Reset button text
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
