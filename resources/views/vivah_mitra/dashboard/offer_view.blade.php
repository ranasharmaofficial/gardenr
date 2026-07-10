@extends('vivah_mitra.layouts.master')
@section('title') Offer @endsection

@section('meta_tags')

@endsection
@section('content')
<link href="https://unpkg.com/cloudinary-video-player/dist/cld-video-player.min.css" rel="stylesheet">
<script src="https://unpkg.com/cloudinary-video-player/dist/cld-video-player.min.js"></script>
	<style >
	.features-box {
		background: #fff;
		border-radius: 14px;
		padding: 15px;
		box-shadow: 0 6px 14px rgba(0,0,0,0.08);
		transition: 0.3s;
		text-align: center;
	}

	.gallery-img {

		width: 100%;

		transition: 0.3s ease;
	}

	.gallery-item:hover .gallery-img {
		transform: scale(1.05);
	}

	.gallery-item h6 {
		font-size: 14px;
		margin-bottom: 0;
	}

/* video css */

.shorts-container {
    display: flex;
    justify-content: center;
    padding: 10px;
}

.shorts-card {
    width: 100%;
    max-width: 360px;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
    background: #000;
}

/* Perfect Shorts Ratio (9:16) */
.shorts-card iframe {
    width: 100%;
    height: 640px;
    border: none;
}

/* Mobile Optimization */
@media (max-width: 480px) {
    .shorts-card iframe {
        height: 500px;
    }
}

/* alert box */
.alert-box{
    margin:12px;
    border-radius:14px;
    overflow:hidden;
    box-shadow:0 6px 18px rgba(0,0,0,0.15);
}

.alert-title{
    background:linear-gradient(135deg,#c0392b,#e74c3c);
    color:#fff;
    font-size:15px;
    font-weight:700;
    padding:10px;
    text-align:center;
}

.alert-marquee{
    background:#fff3cd;
    color:#8a1c1c;
    font-size:14px;
    font-weight:600;
    padding:10px;
}

/* offer style */
.offer-card {
    position: relative;
    border-radius: 16px;
    overflow: hidden;
    background: linear-gradient(135deg, #fff7e6, #ffe0b2);
    box-shadow: 0 6px 18px rgba(0,0,0,0.12);
    margin-bottom: 18px;
}

/* IMAGE FIX */
.offer-img {
    width: 100%;
    height: 220px;
    object-fit: contain; /* 🔥 full image visible */
    background: #fff;
    padding: 10px;
}

/* CONTENT */
.offer-content {
    padding: 14px;
}

.offer-title {
    font-size: 18px;
    font-weight: 700;
    color: #d84315;
}

.offer-desc {
    font-size: 13px;
    color: #555;
    margin-top: 4px;
}

/* RIBBON */
.ribbon {
    position: absolute;
    top: 12px;
    left: -30px;
    width: 140px;
    text-align: center;
    background: linear-gradient(45deg, #00c853, #64dd17);
    color: #fff;
    font-size: 12px;
    font-weight: bold;
    padding: 6px 0;
    transform: rotate(-45deg);
    box-shadow: 0 3px 8px rgba(0,0,0,0.2);
}

/* BADGE */
.offer-badge {
    display: inline-block;
    background: #ff7043;
    color: #fff;
    font-size: 11px;
    padding: 3px 8px;
    border-radius: 20px;
    margin-top: 6px;
}

	</style >
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
                        <h5 class="mb-0">ऑफर  </h5>
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

                <div class="dashboard-area m-b30">

						<div class="alert-box">
							<div class="alert-title">
								ऑफ़र पात्रता जांचें
							</div>
							<div class="alert-marquee">
							   <h4>जॉइनिंग डेट : {{ date('d M, Y', strtotime($vivah_mitra_details->verify_date)) }}</h4>
							   <h4>ऑफर स्टार्ट डेट : {{ date('d M, Y', strtotime($vivah_mitra_details->verify_date . ' +1 day')) }}</h4>
							   <h4>ऑफर समाप्त डेट : {{ date('d M, Y', strtotime($vivah_mitra_details->verify_date . ' +31 day')) }}</h4>
							</div>
						</div>

						@if($user_target_in_10_days==1)
							<div class="offer-card">
								<div class="ribbon">ACHIEVED</div>
								<img src="{{ static_asset('assets/assets_vivah_mitra/images/mixer-grinder.jpg') }}" class="offer-img">
								<div class="offer-content">
									<div class="offer-title">मिक्सर ग्राइंडर फ्री</div>
									<div class="offer-desc">आपने यह ऑफर सफलतापूर्वक प्राप्त कर लिया है</div>
									<div class="offer-badge">🎉 Congratulations</div>
								</div>

							</div>
						@endif

						@if($user_target_in_30_days==1)
							<div class="offer-card">
								<div class="ribbon">ACHIEVED</div>
								<img src="{{ static_asset('assets/assets_vivah_mitra/images/keypad-mobile.jpg') }}" class="offer-img">
								<div class="offer-content">
									<div class="offer-title">कीपैड मोबाइल फ्री</div>
									<div class="offer-desc">आपने यह ऑफर सफलतापूर्वक प्राप्त कर लिया है</div>
									<div class="offer-badge">🎉 Congratulations</div>
								</div>

							</div>
						@endif

					<!-- Features -->
                    <div class="features-box  mt-3">
						<div class="row g-3">

							@if(!empty($video_Offer))

							 
							
							@foreach($video_Offer as $key => $value)

								<h4 class="text-primary" style="line-height:1.6;">
									{{ $value->title }}
								</h4>

								<div class="shorts-container">
									<div class="shorts-card">

										<!-- Unique Video ID -->
										<video 
											id="video-player-{{ $key }}" 
											class="cld-video-player cld-fluid"
										></video>

									</div>
								</div>

							@endforeach

							@endif

						</div>
						<hr>
						<div class="row g-3">

							@foreach($image_Offer_list as $val)
								<div class="col-12 col-md-4 col-lg-3">
									<div class="gallery-item text-center">
										<!-- Image -->
										 <img src="{{ static_asset($val->file) }}"
												 alt="{{ $val->title }}"
												 class="img-fluid rounded shadow-sm gallery-img">
										</br>
										<!-- Category Name -->
										{{--
										<h6 class="mt-2 fw-bold text-dark">
											{{ $val->title }}
										</h6>--}}
										<h4 style="line-height:1.6;" class="text-info mt-3">{{ $val->title }}</h4>
										</br>
									</div>
								</div>
							@endforeach

						</div>
                    </div>
					<!-- Features End -->



				</div>
			</div>
		</div>

    </div>
    <!-- Page Content End-->
	<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
	<script>
$(document).on('submit', '#save-form', function (e) {
			e.preventDefault();

			var clk_btns = $(".saveDetails");
			clk_btns.prop('disabled', true).text('Transferng...');

			var formData = new FormData(this);

			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});

			$.ajax({
				type: "POST",
				url: "{{ route('member.transferCard') }}",
				data: formData,
				processData: false,
				contentType: false,
				dataType: "JSON",
				success: function (data) {
					clk_btns.prop('disabled', false).text('Transfer');

					if (data.status === true) {
						$('#save-form')[0].reset();
						$('.errorMsgntainer').html('');
						Swal.fire({
							icon: "success",
							title: "Success",
							text: data.message,
							timer: 1500,
							showConfirmButton: false
						});
							document.getElementById('show-form-error').style.display = "none";
					} else {
						Swal.fire({
							icon: "error",
							title: "Oh No!",
							text: data.message,
							timer: 1500,
							showConfirmButton: false
						});

					}
				},
				error: function (err) {
					clk_btns.prop('disabled', false).text('Save Details');
					document.getElementById('show-form-error').style.display = "block";

					let error = err.responseJSON;
					$('.errorMsgntainer').html('');
					$.each(error.errors, function (index, value) {
						$('.errorMsgntainer').append('<span class="text-danger">' + value + '</span><br>');
					});
				}
			});
		});


document.addEventListener("DOMContentLoaded", function () {

    var cld = cloudinary.Cloudinary.new({
        cloud_name: "dipbhlocc"
    });

    @foreach($video_Offer as $key => $value)

			var player{{ $key }} = cld.videoPlayer("video-player-{{ $key }}", {
				controls: true,
				autoplay: true,
				muted: true,
				loop: true,
				fluid: true
			});

			// Extract public_id from URL
			player{{ $key }}.source("{{ pathinfo($value->shorts_video_url, PATHINFO_FILENAME) }}");

		@endforeach

	});


	</script>

    @include('vivah_mitra.includes.home_footer_menu')

    @endsection
