@extends('vivah_mitra.layouts.master')
@section('title') जिला विवाह मित्र आवेदन @endsection

@section('meta_tags')

@endsection
@section('content')
	<style >

	.vivah-card {
    position: relative;
    overflow: hidden;
}

.vivah-card form {
    height: 100%;
}

.card-overlay-btn {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;

    border: none;
    background: transparent;
    cursor: pointer;
    z-index: 10;
}

/* Keep content above background but below button */
.card-content {
    position: relative;
    z-index: 5;
    padding: 20px;
}

	.vivah-grid {
		display: grid;
		grid-template-columns: repeat(2, 1fr); /* 🔥 TWO PER ROW */
		gap: 12px;
		padding: 10px;


}

.blinkglow{

}

.vivah-card {
    position: relative;
    display: block;
    text-decoration: none;
    padding: 18px 10px;
    border-radius: 14px;

	/*animation: gradientMove 6s ease infinite;*/
	animation: blinkGlow 1.5s infinite;
    background: linear-gradient(
        135deg,
        #ff416c,
        #ff4b2b,
        #f9d423,
        #24fe41,
        #00c6ff
    );
    color: #fff;
    text-align: center;
    box-shadow: 0 8px 22px rgba(0,0,0,0.25);

}

.vivah-card h3 {
    margin: 0;
    font-size: 15px;
    font-weight: 700;
}

.vivah-card p {
    /*margin-top: 6px;*/
    font-size: 13px;
    font-weight: 600;
}

.badge {
    position: absolute;
    top: -8px;
    right: -8px;
    background: #fff;
    color: #ff2b2b;
    font-size: 10px;
    font-weight: bold;
    padding: 4px 8px;
    border-radius: 50px;
}

/* Optional: Small phones safety */
@media (max-width: 390px) {
    .vivah-grid {
        grid-template-columns: 1fr; /* 1 per row */
    }
}

/* Animation */
/* Gradient animation */
@keyframes gradientMove {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

/* Blinking glow animation */
@keyframes blinkGlow {
    0%   { transform: scale(1); box-shadow: 0 0 10px rgba(255,65,108,0.6); }
    50%  { transform: scale(1.05); box-shadow: 0 0 25px rgba(36,254,65,0.9); }
    100% { transform: scale(1); box-shadow: 0 0 10px rgba(0,198,255,0.6); }
}

.alert-box{
    margin:12px;
    border-radius:14px;
    overflow:hidden;
    box-shadow:0 6px 18px rgba(0,0,0,0.15);
}

.alert-box-primary{
    margin:12px;
    border-radius:14px;
    overflow:hidden;
    box-shadow:0 6px 18px rgba(0,0,0,0.15);
}

.alert-title-primary{
    background:linear-gradient(135deg,#2b67c0,#247878);
    color:#fff;
    font-size:15px;
    font-weight:700;
    padding:10px;
    text-align:center;
}

.alert-title-secondary{
    background:linear-gradient(135deg,#af2bc0,#a6116b);
    color:#fff;
    font-size:18px;
    font-weight:800;
    padding:10px;
    text-align:center;
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

.vivah-card.applied {
    background: #e9f9ee;
    border: 2px solid #28a745;
    cursor: not-allowed;
    opacity: 0.8;

}

.vivah-card.my-box {
    background: #e8f1ff;
    border: 2px solid #007bff;
}

.vivah-card.applied:hover,
.vivah-card.my-box:hover {
    transform: none;
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
                        <h5 class="mb-0"> जिला विवाह मित्र आवेदन </h5>
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
					<!-- Features -->


					@if($vivah_mitra_details->verify_date!=null)
						<div class="alert-box">
							<div class="alert-title">
								⚠️ जिला विवाह मित्र – कृपया ध्यान दें
							</div>

							<marquee class="alert-marquee" behavior="scroll" direction="left" scrollamount="4">
								30 दिन के अंदर 10 जिला विवाह मित्र आवेदन करना अनिवार्य है।
							</marquee>
							@if($remaining_days > 0)
								<h4 style="font-weight:800;" class="text-center text-danger">मात्र बचे हैं {{ $remaining_days }} दिन</h4>
							@else
								<h4 style="font-weight:800;" class="text-center text-danger">आपकी समय सीमा समाप्त हो चुकी है</h4>
							@endif

							<h4 style="font-weight:800;line-height:1.6" class="text-center text-danger"> </h4>
						</div>
					@endif

						<div class="alert-box-primary">
							@php
								if (!session()->has('last_number')) {
									session(['last_number' => 10]);
								}

								$increment = rand(1, 5); // small random increase
								$newNumber = session('last_number') + $increment;

								session(['last_number' => $newNumber]);
							@endphp
							<div class="alert-title-primary">
								<h4 style="font-weight:800;line-height:1.6" class="text-center text-white">इस पद हेतु {{ $newNumber }} नए आवेदन प्राप्त हो चुके हैं, जिन्हें वर्तमान में वेटिंग/लंबित सूची में रखा गया है।</h4>
							</div>
						</div>

						<div class="alert-box">

							<div class="alert-title-secondary">
								कृपया 30 दिनों के भीतर कार्य पूर्ण करें, अन्यथा आपका स्थान स्वतः निरस्त कर अन्य योग्य आवेदक को प्रदान कर दिया जाएगा।
							</div>
						</div>


						<div class="row m-b20 g-3">

						@if($vivah_mitra_details->status == 0)
							<div class="vivah-grid">
								@foreach($prakhand_vivah_mitra_box_first10 as $box)
									@if($box->is_filled == 1)

									@php
										$member_details = \App\Models\User::where('box_key', $box->box_key)->first();
                                    @endphp
										<div class="vivah-card applied">
											<!--<span style="top: 5px;right: 6px;opacity:.1;" class="badge badge-success">APPLIED</span>-->
											<h3 style="color:green">प्रखण्ड विवाह मित्र</h3>
											<p style="color:green">{{ $member_details?->first_name ?? '-' }}</p>
											<p style="color:green;">{{ $member_details?->employee_code ?? '-' }}</p>
										</div>

									@else
										{{-- AVAILABLE BOX --}}
                                        <div class="vivah-card blinkglow">
											<form method="POST" action="{{ route('member.jila.jilaSBox') }}">
												@csrf
												<input type="hidden" name="box_key" value="{{ $box->box_key }}">

												<button type="submit" class="card-overlay-btn"></button>

												<div class="card-content">
													<span class="badge badge-warning">AVAILABLE</span>
													<h3>जिला विवाह मित्र </h3>
													<p style="color:green;">&nbsp;</p>
													<p style="margin-top: -25px;">यहाँ आवेदन करें</p>
												</div>
											</form>
										</div>
									@endif



								@endforeach
							</div>
						@else
							<div class="vivah-grid">
								@foreach($prakhand_vivah_mitra_box_first10 as $box)
									@if($box->is_filled == 1)
										{{-- APPLIED BOX --}}
									@php
										$member_details = \App\Models\User::where('box_key', $box->box_key)->first();
                                    @endphp
										<div class="vivah-card applied">
											<!--<span class="badge badge-success">APPLIED</span>-->
											<h3 style="color:green">जिला विवाह मित्र</h3>
											<p style="color:green">{{ $member_details?->first_name ?? '-' }}</p>
											<p style="color:green;">{{ $member_details?->employee_code ?? '-' }}</p>
										</div>

									@else
										{{-- AVAILABLE BOX --}}
                                        <div class="vivah-card blinkglow">
											<form method="POST" action="{{ route('member.jila.jilaSBox') }}">
												@csrf
												<input type="hidden" name="box_key" value="{{ $box->box_key }}">

												<button type="submit" class="card-overlay-btn"></button>

												<div class="card-content">
													<span class="badge badge-warning">AVAILABLE</span>
													<h3>जिला विवाह मित्र </h3>
													<p style="color:green;">&nbsp;</p>
													<p style="margin-top: -25px;">यहाँ आवेदन करें</p>
												</div>
											</form>
										</div>
									@endif


								@endforeach
							</div>


						@endif



						</div>

						<div class="alert-box">
							<div class="alert-title">
								⚠️ जिला विवाह मित्र – कृपया ध्यान दें
							</div>

							<p class="alert-marquee">
								पास कराने के लिए कुल 10 प्रखण्ड मित्र आवश्यक हैं।
								परंतु, भविष्य में यदि कोई प्रखण्ड मित्र कार्य छोड़ देता है या सक्रिय रूप से कार्य नहीं करता है, तो ऐसी स्थिति में आपकी प्रमोशन प्रक्रिया बाधित न हो, इसके लिए कम से कम 6 प्रखण्ड मित्र अतिरिक्त (बैकअप) के रूप में चयनित व सक्रिय रखें।

								अतः कुल 16 प्रखण्ड मित्र (10 अनिवार्य + 6 बैकअप) बनाए रखना अनिवार्य है।
							</p>
						</div>

						<div class="row m-b20 g-3">

							<div class="vivah-grid">

								@foreach($prakhand_vivah_mitra_box_next_6 as $box)
									@if($box->is_filled == 1)
										{{-- APPLIED BOX --}}
									@php
										$member_details = \App\Models\User::where('box_key', $box->box_key)->first();
									@endphp
										<div class="vivah-card applied">
											<!--<span class="badge badge-success">APPLIED</span>-->
											<h3 style="color:green">जिला विवाह मित्र</h3>
											<p style="color:green">{{ $member_details?->first_name ?? '-' }}</p>
											<p style="color:green;">{{ $member_details?->employee_code ?? '-' }}</p>
										</div>

									@else
										{{-- AVAILABLE BOX --}}
										<div class="vivah-card blinkglow">
											<form method="POST" action="{{ route('member.jila.jilaSBox') }}">
												@csrf
												<input type="hidden" name="box_key" value="{{ $box->box_key }}">

												<button type="submit" class="card-overlay-btn"></button>

												<div class="card-content">
													<span class="badge badge-warning">AVAILABLE</span>
													<h3>जिला विवाह मित्र </h3>
													<p style="color:green;">&nbsp;</p>
													<p style="margin-top: -25px;">यहाँ आवेदन करें</p>
												</div>
											</form>
										</div>
									@endif


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



</script>

    @include('vivah_mitra.includes.home_footer_menu')

    @endsection
