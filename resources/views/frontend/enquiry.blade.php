@extends('frontend.layouts.master')
@section('title') Enquiry - {{ env('APP_NAME') }}@endsection



@section('content')

<section class="page-title" style="background-image:url({{ static_asset('assets/assets_web/images/header-about.jpg') }})" id="page-title">
        <div class="auto-container">
			<h2>Enquiry</h2>
			<ul class="bread-crumb clearfix">
				<li><a href="{{ url('') }}">Home</a></li>
				<li>Enquiry</li>
			</ul>
        </div>
    </section>

	<!-- Contact Form One -->
	<section class="contact-form-one" id="contact" style="padding-top:0px;">
		<div class="auto-container">
			<div class="inner-container">
				
				<!-- Sec Title -->
				<div class="sec-title centered">
					<h2 class="sec-title_heading">Enquiry Form</h2>
				</div>
				
				<!-- Default Form -->
				<div class="contact-form">
					<form id="enquiry-form" method="post" action="#">
						<div class="row">
							 <div style="display:none;" id="show-form-error" class="alert alert-danger col-md-12">
								<ul>
									<div class="errorMsgntainer"></div>
								</ul>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-12 form-group">
								<input type="text" name="name" placeholder="Name" required="">
							</div>
							
							<div class="col-lg-6 col-md-6 col-sm-12 form-group">
								<input type="text" name="email" placeholder="Email" required="">
							</div>
							
							<div class="col-lg-6 col-md-6 col-sm-12 form-group">
								<input type="text" name="phone" placeholder="Phone" required="">
							</div>
							
							<div class="col-lg-6 col-md-6 col-sm-12 form-group">
								<select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="project">
								  <option selected>Select Project</option>
								  <option value="Kumar Capital Green">Kumar Capital Green</option>
								  <option value="Sundram">Sundram</option>
								</select>
							</div>
							
							<div class="col-lg-12 col-md-12 col-sm-12 form-group">
								<textarea class="" name="message" placeholder="how can i help you? Feel free to get in touch"></textarea>
							</div>
							
							<div class="col-lg-12 col-md-12 col-sm-12 form-group text-center">
								<!-- Button Box -->
								<div class="button-box">
									<button class="theme-btn btn-style-three make_enquiry" type="submit" name="sendmail">
										<span class="btn-wrap">
											<span class="text-one">get in touch</span>
											<span class="text-two">get in touch</span>
										</span>
									</button>
								</div>
							</div>
							
						</div>
					</form>
				</div>
				<!-- End Default Form -->
				
			</div>
		</div>
	</section>
 

<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<script>
    $(document).on('click', '.make_enquiry', function(e) {
        e.preventDefault();
        var clk_btn = $(".make_enquiry");
        clk_btn.prop('disabled', true);
        var formData = new FormData(document.getElementById("enquiry-form"));
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: "{{ route('contact.enquiry') }}",
            data: formData,
            processData: false,
            contentType: false,
            dataType: "JSON"
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

                document.getElementById('show-form-error').style = "display: block";
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
