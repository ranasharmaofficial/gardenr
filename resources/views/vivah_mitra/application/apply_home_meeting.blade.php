@extends('vivah_mitra.layouts.master')
@section('title') Apply Home Meeting @endsection

@section('meta_tags')

@endsection
@section('content')
<style>
.letter-box{
    width:800px;
    margin:30px auto;
    background:#fff;
    padding:40px;
    border:3px solid #b30000;
    border-radius:8px;
    box-shadow:0 0 10px rgba(0,0,0,0.1);
}

.header{
    text-align:center;
    border-bottom:2px solid #b30000;
    padding-bottom:10px;
    margin-bottom:20px;
}

.header h1{
    margin:0;
    font-size:30px;
    color:#b30000;
}

.header h3{
    margin:5px 0 0;
    font-size:18px;
    font-weight:600;
}

.date{
    text-align:right;
    margin-bottom:20px;
}

.content{
    font-size:18px;
    line-height:1.8;
}

.content ul{
    margin-top:10px;
}

.content li{
    margin-bottom:6px;
}

.signature{
    margin-top:60px;
    text-align:right;
}

.signature .sign-line{
    margin-top:40px;
    border-top:1px solid #000;
    display:inline-block;
    padding-top:5px;
}

.footer{
    margin-top:40px;
    text-align:center;
    font-size:14px;
    color:#777;
}


</style>
        <!-- Header -->
	<header class="header">
        <div class="main-bar">
            <div class="container">
                <div class="header-content">
                    <div class="left-content">
                        <a href="javascript:void(0);" class="back-btn">
                            <svg width="18" height="18" viewbox="0 0 10 16" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M9.03033 0.46967C9.2966 0.735936 9.3208 1.1526 9.10295 1.44621L9.03033 1.53033L2.561 8L9.03033 14.4697C9.2966 14.7359 9.3208 15.1526 9.10295 15.4462L9.03033 15.5303C8.76406 15.7966 8.3474 15.8208 8.05379 15.6029L7.96967 15.5303L0.96967 8.53033C0.703403 8.26406 0.679197 7.8474 0.897052 7.55379L0.96967 7.46967L7.96967 0.46967C8.26256 0.176777 8.73744 0.176777 9.03033 0.46967Z" fill="#a19fa8"></path>
							</svg>
                        </a>
                    </div>
                    <div class="mid-content">
                        <h5 class="mb-0">अप्लाइ होम मीटिंग</h5>
                    </div>
                    <div class="right-content">
                        <a href="javascript:void(0);" class="menu-toggler">
							<svg width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path opacity="0.4" d="M16.0755 2H19.4615C20.8637 2 22 3.14585 22 4.55996V7.97452C22 9.38864 20.8637 10.5345 19.4615 10.5345H16.0755C14.6732 10.5345 13.537 9.38864 13.537 7.97452V4.55996C13.537 3.14585 14.6732 2 16.0755 2Z" fill="#a19fa8"></path>
								<path fill-rule="evenodd" clip-rule="evenodd" d="M4.53852 2H7.92449C9.32676 2 10.463 3.14585 10.463 4.55996V7.97452C10.463 9.38864 9.32676 10.5345 7.92449 10.5345H4.53852C3.13626 10.5345 2 9.38864 2 7.97452V4.55996C2 3.14585 3.13626 2 4.53852 2ZM4.53852 13.4655H7.92449C9.32676 13.4655 10.463 14.6114 10.463 16.0255V19.44C10.463 20.8532 9.32676 22 7.92449 22H4.53852C3.13626 22 2 20.8532 2 19.44V16.0255C2 14.6114 3.13626 13.4655 4.53852 13.4655ZM19.4615 13.4655H16.0755C14.6732 13.4655 13.537 14.6114 13.537 16.0255V19.44C13.537 20.8532 14.6732 22 16.0755 22H19.4615C20.8637 22 22 20.8532 22 19.44V16.0255C22 14.6114 20.8637 13.4655 19.4615 13.4655Z" fill="#a19fa8"></path>
							</svg>
						</a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Header End -->
     

         @include('vivah_mitra.includes.sidebar')

    

    <!-- Page Content -->
    <div class="page-content">

        <div class="content-inner pt-0">
			<div class="container fb">
                <!-- Search -->
                 

                <!-- Dashboard Area -->
                <div class="dashboard-area m-b30">

					<div class="row m-b20 g-3">
							<div class="card">
								<div class="card-header bg-primary text-white">
									<h4 class="mb-0 text-white">होम मीटिंग फोटो इस प्रकार कि होने चाहिए </h4>
								</div>

								<div class="card-body">
									<img src="{{ static_asset('assets/assets_vivah_mitra/images/meeting/home-meeting1.jpg') }}" class="img-fluid">
								</div>
							</div>
							<div class="card">
								<div class="card-header bg-primary text-white">
									<h4 class="mb-0 text-white">होम मीटिंग नियम एवं भुगतान विवरण</h4>
								</div>

								<div class="card-body">
									<div class="custom-accordion">

										<div class="accordion-item">
											<div class="accordion-header">
												<span>1. यदि 5 से 7 दीदी की होम मीटिंग कराई जाती है, तो प्रथम पोस्ट पर ₹30/- दिया जाएगा।</span>
												<span class="icon">+</span>
											</div>
											<div class="accordion-body">
												<p>नोट:</p>
												<p>प्रति दीदी ₹5/-</p>
												<p>मीटिंग में कम से कम 5 और अधिकतम 7 से कम होनी चाहिए।</p>
											</div>
										</div>

										<div class="accordion-item">
											<div class="accordion-header">
												<span>2. यदि 5 से 7 दीदी की होम मीटिंग कराई जाती है, तो द्वितीय पोस्ट पर ₹40/- दिया जाएगा।</span>
												<span class="icon">+</span>
											</div>
											<div class="accordion-body">
												<p>नोट:</p>
												<p>प्रति दीदी ₹6.66/-</p>
												<p>मीटिंग में कम से कम 5 और अधिकतम 7 से कम होनी चाहिए।</p>
											</div>
										</div>
										
										<div class="accordion-item">
											<div class="accordion-header">
												<span>3. यदि 5 से 7 दीदी की होम मीटिंग कराई जाती है, तो तृतीय पोस्ट पर ₹50/- दिया जाएगा।</span>
												<span class="icon">+</span>
											</div>
											<div class="accordion-body">
												<p>नोट:</p>
												<p>प्रति दीदी ₹8.33/-</p>
												<p>मीटिंग में कम से कम 5 और अधिकतम 7 से कम होनी चाहिए।</p>
											</div>
										</div>
										
										<div class="accordion-item">
											<div class="accordion-header">
												<span>4. यदि 5 से 7 दीदी की होम मीटिंग कराई जाती है, तो चतुर्थ पोस्ट पर ₹60/- दिया जाएगा।</span>
												<span class="icon">+</span>
											</div>
											<div class="accordion-body">
												<p>नोट:</p>
												<p>प्रति दीदी ₹10/-</p>
												<p>मीटिंग में कम से कम 5 और अधिकतम 7 से कम होनी चाहिए।</p>
											</div>
										</div>
										
										<div class="accordion-item">
											<div class="accordion-header">
												<span>कुल भुगतान विवरण</span>
												<span class="icon">+</span>
											</div>
											<div class="accordion-body">
												<p>4 मीटिंग का फोटो पोस्ट करने पर कुल राशि = ₹180/-</p>
												<p>4 मीटिंग पूर्ण करने पर बोनस = ₹20/-</p>
												<p>कुल प्रतिदिन आय = ₹200/-</p>
												<p>मासिक आय = ₹6000/- प्रतिमाह</p>
											</div>
										</div>

									</div>
								</div>
							</div>

							<div class="card">
								<div class="card-header bg-primary text-white">
									<h4 class="mb-0 text-white">Home Meeting Form</h4>
								</div>

								<div class="card-body">
									<form action="" id="home-meet-form" method="POST" enctype="multipart/form-data">
										<div class="row">
											<div style="display:none;" id="show-contact-form-error" class="alert alert-danger col-md-12">
												<ul>
													<div class="errorMsgntainer"></div>
												</ul>
											</div>
										</div>
										<!-- Photo Upload -->
										<div class="row mb-3">
											<div class="col-md-6">
												<label class="form-label">Photo 1</label>
												<input type="file" name="photo1" class="form-control" required>
											</div>
											<div class="col-md-6">
												<label class="form-label">Photo 2</label>
												<input type="file" name="photo2" class="form-control" required>
											</div>
										</div>

										<!-- Training Place -->
										<div class="mb-3">
											<label class="form-label">Training Place</label>
											<input type="text" name="training_place" class="form-control" placeholder="Enter training place">
										</div>

										<!-- Training Address -->
										<div class="mb-3">
											<label class="form-label">Training Address</label>
											<textarea name="training_address" class="form-control" rows="2" placeholder="Enter address"></textarea>
										</div>

										<!-- District -->
										<div class="mb-3">
											<label class="form-label">District Name</label>
											<input type="text" name="district_name" placeholder="Enter District Name" class="form-control">
										</div>

										<!-- Training Date -->
										<div class="mb-3">
											<label class="form-label">Training Date</label>
											<input type="date" name="training_date" class="form-control">
										</div>

										<!-- Start & End Time -->
										<div class="row mb-3">
											<div class="col-md-6">
												<label class="form-label">Start Time</label>
												<input type="time" name="start_time" class="form-control">
											</div>
											<div class="col-md-6">
												<label class="form-label">End Time</label>
												<input type="time" name="end_time" class="form-control">
											</div>
										</div>

										<!-- Supported By -->
										<div class="mb-3">
											<label class="form-label">Supported By</label>
											<input type="text" name="supported_by" placeholder="Enter Supported By" class="form-control">
										</div>

										<!-- Counts Section -->
										<div class="row mb-3">
											<div class="col-md-3">
												<label class="form-label">Total Vivah Mitra</label>
												<input type="number" name="total_vivah_mitra" placeholder="Enter Total Vivah Mitra" class="form-control">
											</div>
											<div class="col-md-3">
												<label class="form-label">Total Panchayat Mitra</label>
												<input type="number" name="total_panchayat_mitra" placeholder="Enter Total Panchayat Mitra" class="form-control">
											</div>
											<div class="col-md-3">
												<label class="form-label">Total Block Vivah Mitra</label>
												<input type="number" name="total_block_vivah_mitra" placeholder="Enter Total Block Vivah Mitra" class="form-control">
											</div>
											<div class="col-md-3">
												<label class="form-label">Total District Vivah Mitra</label>
												<input type="number" name="total_district_vivah_mitra" placeholder="Enter Total District Vivah Mitra" class="form-control">
											</div>
										</div>

										<!-- Submit -->
										<div class="text-end">
											<button type="submit" class="btn btn-success px-4 make_enquiry">Submit</button>
										</div>

									</form>
							
								</div>
							</div>
						</div>
						 
                    </div>
					<!-- Features End -->
					 
				</div>
			</div>
		</div>

    </div>
    <!-- Page Content End-->

    @include('vivah_mitra.includes.home_footer_menu')


<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<script>
    $(document).on('click', '.make_enquiry', function(e) {
        e.preventDefault();
        var clk_btn = $(".make_enquiry");
        clk_btn.prop('disabled', true);
        var formData = new FormData(document.getElementById("home-meet-form"));
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }

        });
        $.ajax({
            type: "POST",
			url: "{{ route('member.storeHomeMeeting') }}",
			data: formData,
			processData: false,
			contentType: false,
			dataType: "JSON",
			success: function(data) {
                // console.log('status ' + data.status);
                if (data.status == true) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: data.message,
                        confirmButtonColor: '#3085d6'
                    });
                    $('#home-meet-form')[0].reset();
					document.getElementById('show-contact-form-error').style = "display: none";
                } else {
					Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: data.message,
                        confirmButtonColor: '#3085d6'
                    });
                     
                }
            }, error: function(err) {

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


$(document).ready(function(){

    $('.accordion-header').click(function(){

        let body = $(this).next('.accordion-body');
        let icon = $(this).find('.icon');

        // Close others
        $('.accordion-body').not(body).slideUp();
        $('.icon').not(icon).text('+');

        // Toggle current
        body.slideToggle();

        if(icon.text() === '+'){
            icon.text('-');
        } else {
            icon.text('+');
        }

    });

});

</script>


    @endsection
