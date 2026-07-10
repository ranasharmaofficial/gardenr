@extends('admin.include.master')
@section('title', 'Website Header')
@section('content')

<!-- Page Header -->
	<div style="background:linear-gradient(45deg, #f33057, rgb( 56, 88, 249 ) );"  class="d-sm-flex d-block align-items-center justify-content-between page-header-breadcrumb">
		<div>
			<h4 class="fw-medium mb-2">Business Setting</h4>
			<div class="ms-sm-1 ms-0">
				<nav>
					<ol class="breadcrumb mb-0">
						<li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
						<li class="breadcrumb-item active fw-normal" aria-current="page">Header</li>
					</ol>
				</nav>
			</div>
		</div>

	</div>
<!-- Page Header Close -->
	<div class="main-content app-content">
        <div class="row gx-3">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body booking_card">
                        <form method="post" id="update-header-form" action="#" enctype="multipart/form-data">
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

                                <input type="hidden" class="form-control" name="type" value="header_setup" required>
                                <div class="col-md-12">
									<div class="mb-3">
										<div class="form-group d-flex align-items-center">
											<label class="col-md-3"><strong>Header Logo </strong></label>
											<div class="col-md-9">
												<input type="file" class="form-control" name="header_logo">
												@if(fetch_business_setting_value('header_setup', 'header_logo') != null)
													<div>
														<img src="{{ asset('public/'.fetch_business_setting_value('header_setup', 'header_logo')) }}" height=100>
													</div>
												@endif
											</div>
										</div>
                                    </div>
                                </div>

                                <div class="col-md-12">
									<div class="mb-3">
										<div class="form-group d-flex align-items-center">
											<label class="col-md-3"><strong>Phone</strong></label>
											<div class="col-md-9">
												<input type="hidden" class="form-control" name="field_names[]" value="header_phone" required>
												<input type="text" class="form-control" name="values[]" pattern="+91[7-9]{1}[0-9]{9}" value="{{ fetch_business_setting_value('header_setup', 'header_phone') }}">
											</div>
										</div>
                                    </div>
                                </div>

                                <div class="col-md-12">
									<div class="mb-3">
										<div class="form-group d-flex align-items-center">
											<label class="col-md-3"><strong>Email</strong></label>
											<div class="col-md-9">
												<input type="hidden" class="form-control" name="field_names[]" value="header_email" required>
												<input type="email" class="form-control" name="values[]" value="{{ fetch_business_setting_value('header_setup', 'header_email') }}">
											</div>
										</div>
                                    </div>
                                </div>
								
								<div class="col-md-12">
									<div class="mb-3">
										<div class="form-group d-flex align-items-center">
											<label class="col-md-3"><strong>WhatsApp</strong></label>
											<div class="col-md-9">
												<input type="hidden" class="form-control" name="field_names[]" value="whatsapp" required>
												<input type="text" class="form-control" name="values[]" value="{{ fetch_business_setting_value('header_setup', 'whatsapp') }}">
											</div>
										</div>
                                    </div>
                                </div>
								
								<div class="col-md-12">
									<div class="mb-3">
										<div class="form-group d-flex align-items-center">
											<label class="col-md-3"><strong>Skype</strong></label>
											<div class="col-md-9">
												<input type="hidden" class="form-control" name="field_names[]" value="skype" required>
												<input type="text" class="form-control" name="values[]" value="{{ fetch_business_setting_value('header_setup', 'skype') }}">
											</div>
										</div>
                                    </div>
                                </div>
								
								<div class="col-md-12">
									<div class="mb-3">
										<div class="form-group d-flex align-items-center">
											<label class="col-md-3"><strong>Header Address</strong></label>
											<div class="col-md-9">
												<input type="hidden" class="form-control" name="field_names[]" value="header_address" required>
												<input type="text" class="form-control" name="values[]" value="{{ fetch_business_setting_value('header_setup', 'header_address') }}">
											</div>
										</div>
                                    </div>
                                </div>
								
								<div class="col-md-12">
									<div class="mb-3">
										<div class="form-group d-flex align-items-center">
											<label class="col-md-3"><strong>Header Website</strong></label>
											<div class="col-md-9">
												<input type="hidden" class="form-control" name="field_names[]" value="header_website" required>
												<input type="text" class="form-control" name="values[]" value="{{ fetch_business_setting_value('header_setup', 'header_website') }}">
											</div>
										</div>
                                    </div>
                                </div>
								
								<div class="col-md-12">
									<div class="mb-3">
										<div class="form-group d-flex align-items-center">
											<label class="col-md-3"><strong>Header Hr Enquiry</strong></label>
											<div class="col-md-9">
												<input type="hidden" class="form-control" name="field_names[]" value="header_hr" required>
												<input type="text" class="form-control" name="values[]" value="{{ fetch_business_setting_value('header_setup', 'header_hr') }}">
											</div>
										</div>
                                    </div>
                                </div>

                            </div>
							<div class="mb-3">
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


<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
	<script>
	$(document).on('click', '.update-button', function(e) {
        e.preventDefault();
        var clk_btn = $(".update-button");
        clk_btn.prop('disabled', true).text('Updating...');

        var formData = new FormData(document.getElementById("update-header-form"));
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
