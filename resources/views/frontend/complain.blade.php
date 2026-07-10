@extends('frontend.layouts.master')
@section('title') Complain @endsection

@section('meta_tags')
@endsection

@section('content')

<!-- Start Breadcrumb
    ============================================= -->
    <div class="breadcrumb-area text-center shadow dark bg-fixed text-light" style="background-image: url({{ static_asset('assets/assets_web/img/contactt.jpg') }});" id="bg-fixedd">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <h1>Complain</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li><a href="{{ url('') }}" style="color:#fff;"><i class="fas fa-home"></i> Home</a></li>
                            <li class="active" style="color:#fff;">Complain</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumb -->


    <div class="contact-area default-padding">
        <div class="container">
            <div class="row align-center justify-content-center">

                <div class="col-tact-stye-one col-lg-6 mb-md-50">
                    <div class="contact-form-style-one">
                        <h5 class="sub-title">Any Complain?</h5>
                        <h2 class="heading">Send us a Message</h2>
                        <form action="#" method="POST" id="complain-enquiry-form" class="contact-form contact-form">
                            <div class="row">
                                <div style="display:none;" id="show-contact-form-error" class="alert alert-danger col-md-12">
                                    <ul>
                                        <div class="errorMsgntainer"></div>
                                    </ul>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <input class="form-control" id="name" name="name" placeholder="Name" required type="text">

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input class="form-control" id="email" name="email" placeholder="Email*" type="email">

                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input class="form-control" id="phone" name="phone" placeholder="Phone" type="text" required>
                                        <span class="alert-error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group comments">
                                        <textarea class="form-control" id="complain" name="message" placeholder="Enter your complain details *" required></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <button type="submit" class="make_complain" name="sendmail" id="submit">
                                        <i class="fa fa-paper-plane"></i> Get in Touch
                                    </button>
                                </div>
                            </div>
                            <!-- Alert Message -->
                            <div class="col-lg-12 alert-notification">
                                <div id="message" class="alert-msg"></div>
                            </div>
                        </form>
                    </div>
                </div>

                 




            </div>
        </div>
    </div>
   

	<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
	<script>
		$(document).on('click', '.make_complain', function(e) {
			e.preventDefault();
			var clk_btn = $(".make_complain");
			clk_btn.prop('disabled', true);
			var formData = new FormData(document.getElementById("complain-enquiry-form"));
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}

			});
			$.ajax({
				type: "POST"
				, url: "{{ route('enq.poststoreComplain') }}"
				, data: formData
				, processData: false
				, contentType: false
				, dataType: "JSON"
				, success: function(data) {
					// console.log('status ' + data.status);
					if (data.status == true) {
						toastr.success('Thanyou For Your Enquiry.');
						location.reload();
					} else {
						toastr.error('Something went wrong.');
					}
				}
				, error: function(err) {

					document.getElementById('show-contact-form-error').style = "display: block";
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

	</script>

@endsection
