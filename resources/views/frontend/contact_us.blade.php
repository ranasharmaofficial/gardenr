@extends('frontend.layouts.master')
@section('title') Contact Us @endsection

@section('meta_tags')
@endsection

@section('content')
<style>
.terms-wrap {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 16px;
    color: #222;
    cursor: pointer;
    margin-bottom: 15px;
}

.terms-wrap input[type="checkbox"] {
    width: 18px;
    height: 18px;
    margin: 0;
    cursor: pointer;
}

.terms-wrap a {
    color: #00c9a7;
    text-decoration: underline;
    font-weight: 500;
}

/* Button state */
button:disabled {
    opacity: 0.6;
    cursor: not-allowed;
}

cursor: not-allowed;
}
<style>
.contact-section{
    padding:80px 0;
    background:#f8fafc;
}

.contact-card{
    background:#fff;
    border-radius:18px;
    padding:30px;
    box-shadow:0 15px 40px rgba(0,0,0,.08);
    height:100%;
    transition:.3s;
}

.contact-card:hover{
    transform:translateY(-8px);
    box-shadow:0 20px 45px rgba(0,0,0,.12);
}

.contact-icon{
    width:65px;
    height:65px;
    border-radius:50%;
    background:linear-gradient(135deg,#28c76f,#00cfe8);
    display:flex;
    align-items:center;
    justify-content:center;
    margin-bottom:20px;
}

.contact-icon img{
    width:30px;
}

.contact-card h4{
    font-weight:700;
    margin-bottom:15px;
}

.contact-card p{
    color:#666;
    line-height:28px;
    margin:0;
}

.form-box{
    background:#fff;
    border-radius:20px;
    padding:45px;
    box-shadow:0 15px 40px rgba(0,0,0,.08);
}

.form-box h2{
    font-weight:700;
    margin-bottom:25px;
}

.form-control,
.form-select{
    height:55px;
    border-radius:12px;
    border:1px solid #ddd;
    box-shadow:none;
    margin-bottom:20px;
}

textarea.form-control{
    height:140px;
    resize:none;
}

.form-control:focus{
    border-color:#00cfe8;
    box-shadow:none;
}

.submit-btn{
    width:100%;
    height:55px;
    border:none;
    border-radius:12px;
    background:linear-gradient(135deg,#28c76f,#00cfe8);
    color:#fff;
    font-size:17px;
    font-weight:600;
    transition:.3s;
}

.submit-btn:hover{
    transform:translateY(-2px);
    box-shadow:0 12px 30px rgba(0,207,232,.35);
}

.submit-btn:disabled{
    opacity:.6;
    cursor:not-allowed;
}

.terms-wrap{
    display:flex;
    align-items:flex-start;
    gap:12px;
    margin-bottom:20px;
}

.terms-wrap input{
    margin-top:5px;
}

.terms-wrap a{
    color:#00cfe8;
    font-weight:600;
}
</style>

<section id="ed-breadcrumb" class="ed-breadcrumb-sec" data-background="{{static_asset('assets/assets_web/images/header-about5.jpg')}}">
	<div class="container">
		<div class="ed-breadcrumb-content">
			<div class="ed-breadcrumb-text text-center headline ul-li">
				<h2 class="bread_title">Contact Us</h2>
				<ul>
					<li><a href="{{ url('') }}">Home</a></li>
					<li>Contact Us </li>
				</ul>
			</div>
		</div>
	</div>
</section>

<!-- Start of Feature section
  ============================================= -->
    <section class="contact-section">
        <div class="container">
            <div class="row g-5">
                <!-- Contact Info Cards -->
                <div class="col-lg-5">
                    <div class="row g-4">
                        <div class="col-md-12">
                            <div class="contact-card">
                                <div class="contact-icon">
                                    <img src="{{static_asset('assets/assets_web/images/cpi1.svg')}}" alt="">
                                </div>
                                <h4>Location</h4>
                                <p>N.H. 31, Kaptanpara, Below Jio Office Ground Floor, Khuskibagh Purnia - 854305</p>
                            </div>
                        </div>
                        <div class="col-md-6 mt-5">
                            <div class="contact-card">
                                <div class="contact-icon">
                                    <img src="{{static_asset('assets/assets_web/images/cpi2.svg')}}" alt="">
                                </div>
                                <h4>Phone Number</h4>
                                <p>+91 9471052961</p>
                                <p>+91 9155818830 (WA)</p>
                            </div>
                        </div>
                        <div class="col-md-6 mt-2">
                            <div class="contact-card">
                                <div class="contact-icon">
                                    <img src="{{static_asset('assets/assets_web/images/cpi3.svg')}}" alt="">
                                </div>
                                <h4>Email Address</h4>
                                <p>info@richmoney.in</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="col-lg-7">
                    <div class="form-box">
                        <h2>Get In Touch</h2>
                        <form action="#" method="get">
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="text" class="form-control" placeholder="Full Name">
                                </div>
                                <div class="col-md-6">
                                    <input type="email" class="form-control" placeholder="Email Address">
                                </div>
                                <div class="col-md-12">
                                    <textarea name="message" class="form-control" placeholder="Your Message"></textarea>
                                </div>
                                <div class="col-md-12">
                                    <label class="terms-wrap">
                                        <input type="checkbox" id="acceptTerms">
                                        <span>
                                            I accept the 
                                            <a href="{{ url('terms-condition') }}" target="_blank">Terms & Conditions</a> 
                                            and 
                                            <a href="{{ url('privacy-policy') }}" target="_blank">Privacy Policy</a>
                                        </span>
                                    </label>
                                </div>

                                <div class="col-md-12">
                                    <button class="submit-btn" id="submitBtn" disabled>Submit Review</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
	 
	<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
	<script>
	document.getElementById('acceptTerms').addEventListener('change', function () {
		document.getElementById('submitBtn').disabled = !this.checked;
	});
</script>
	<script>
		$(document).on('click', '.make_enquiry', function(e) {
			e.preventDefault();
			var clk_btn = $(".make_enquiry");
			clk_btn.prop('disabled', true);
			var formData = new FormData(document.getElementById("contact-enquiry-form"));
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}

			});
			$.ajax({
				type: "POST"
				, url: "{{ route('enq.postOnlineEnquiry') }}"
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
