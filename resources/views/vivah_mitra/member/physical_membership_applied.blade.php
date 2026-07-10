@extends('vivah_mitra.layouts.master')
@section('title') Apply Physical Membership Card @endsection

@section('meta_tags')

@endsection
@section('content')
	<style >
	.features-box {
		background: #fff;
		border-radius: 14px;
		padding: 5px;
		box-shadow: 0 6px 14px rgba(0,0,0,0.08);
		transition: 0.3s;
		text-align: center;
	}
	
	/* Wrapper */
	.modern-stepper {
		display: flex;
		justify-content: space-between;
		align-items: center;
		margin: 15px auto;
		max-width: 900px;
		position: relative;
		flex-wrap: wrap;
		padding: 0 10px;
	}

	/* Connecting Line */
	.modern-stepper::before {
		content: "";
		position: absolute;
		top: 35px;
		left: 5%;
		width: 90%;
		height: 5px;
		background: #e5e7eb;
		border-radius: 3px;
		z-index: 0;
	}

	/* Each Step */
	.step-item {
		position: relative;
		z-index: 2;
		text-align: center;
		flex: 1;
		min-width: 120px;
	}

	/* Step Circle */
	.step-circle {
		width: 55px;
		height: 55px;
		border-radius: 50%;
		display: flex;
		justify-content: center;
		align-items: center;
		font-weight: 700;
		font-size: 20px;
		color: white;
		margin: 0 auto;
		transition: 0.3s ease;
		box-shadow: 0px 4px 10px rgba(0,0,0,0.08);
	}

	/* Active State */
	.step-item.active .step-circle {
		background: linear-gradient(135deg, #2563eb, #3b82f6);
		transform: scale(1.08);
	}

	/* Completed State */
	.step-item.completed .step-circle {
		background: linear-gradient(135deg, #16a34a, #22c55e);
	}
	.step-item.completed .step-circle::before {
		content: "✓";
		font-size: 22px;
		font-weight: bold;
	}

	/* Inactive */
	.step-circle.default {
		background: #d1d5db;
	}

	/* Labels */
	.step-label {
		margin-top: 10px;
		font-size: 15px;
		font-weight: 600;
		color: #1e293b;
	}

	/* ----------------------------- */
	/*       RESPONSIVE DESIGN       */
	/* ----------------------------- */
	/* Tablet + Mobile Shared Rules */
	@media (max-width: 992px) {

		.modern-stepper {
			display: flex;
			justify-content: space-between;
			align-items: center;
			max-width: 100%;
			padding: 0 5px;
			overflow: hidden;
		}

		.step-item {
			flex: 1;
			min-width: 0;           /* Prevents overflow */
			padding: 0 4px;
			text-align: center;
		}

		.step-label {
			font-size: 11px;
			white-space: nowrap;    /* Prevent label wrapping down */
			overflow: hidden;
			text-overflow: ellipsis;
			max-width: 70px;        /* Label width limit */
			margin: 5px auto 0 auto;
		}

		.modern-stepper::before {
			top: 22px;
			left: 3%;
			width: 94%;
			height: 3px;
		}
	}

	/* Phones (max-width: 480px) */
	@media (max-width: 480px) {

		.step-circle {
			width: 32px;
			height: 32px;
			font-size: 13px;
			font-weight: 600;
		}
	}

	/* Very Small Phones (max-width: 380px) */
	@media (max-width: 380px) {

		.step-circle {
			width: 28px;
			height: 28px;
			font-size: 12px;
		}

		.step-label {
			font-size: 10px;
			max-width: 60px;
		}
	}

	/* Extra small devices (max-width: 330px – older phones) */
	@media (max-width: 330px) {

		.step-circle {
			width: 25px;
			height: 25px;
			font-size: 11px;
		}

		.step-label {
			font-size: 9px;
			max-width: 55px;
		}
	}


	.pretty-input {
		width: 100%;
		padding: 8px 10px;
		border: 2px solid #ff4d6d;
		border-radius: 10px;
		font-size: 16px;
		outline: none;
		transition: 0.3s ease;
	}

	.pretty-input:focus {
		border-color: #d6336c;
		box-shadow: 0 0 8px rgba(214, 51, 108, 0.3);
	}

	.pretty-input::placeholder {
		color: #b282e5;
		font-weight: 500;
	}
	.pretty-label {
		font-size: 15px;
		font-weight: 600;
		color: #d6336c;
		margin-bottom: 5px;
		display: inline-block;
	}

	.package-options {
		display: flex;
		gap: 20px;
		flex-wrap: wrap;
	}

	.package-box {
		display: flex;
		align-items: center;
		gap: 8px;
		background: #fff0f3;
		padding: 10px 18px;
		border: 2px solid #ff4d6d;
		border-radius: 10px;
		cursor: pointer;
		transition: 0.3s ease;
		font-weight: 600;
	}

	.package-box input[type="radio"] {
		width: 18px;
		height: 18px;
		accent-color: #d6336c; /* modern pink radio */
		cursor: pointer;
	}

	.package-box:hover {
		background: #ffe6ea;
		border-color: #d6336c;
	}

	.package-box input[type="radio"]:checked + span {
		color: #d6336c;
	}

	.physical-card-box {
		background: #fff0f3;
		padding: 25px;
		border-radius: 12px;
		border: 2px solid #ffb3c1;
		box-shadow: 0 4px 12px rgba(255, 0, 76, 0.1);
	}

	.section-title {
		color: #d6336c;
		font-weight: 700;
		margin-bottom: 20px;
		font-size: 28px;
		line-height: 1.6;
	}

	.hindi-text {
		font-size: 18px;
		line-height: 1.8;
		color: #555;
		white-space: pre-line;
	}

	.hindi-text .line {
		display: inline-block;
		width: 120px;
		border-bottom: 2px dashed #d6336c;
		margin: 0 5px;
	}

	.highlight {
		color: #d6336c;
		font-weight: 700;
		font-size: 20px;
	}

	.btn-area {
		display: flex;
		justify-content: space-between;
		margin-top: 25px;
	}

	.btn-lg {
		padding: 10px 30px;
		font-size: 18px;
		border-radius: 10px;
	}

	.membership-success {
		color: green !important;
	}
	.membership-error {
		color: red !important;
	}
	label{
		float: left;
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
                        <h5 class="mb-0">फिज़िकल मेम्बर्शिप अप्लाइड </h5>
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
                    <div class="features-box  mt-3">
						<div class="row m-b20 g-3">
							<div class="container">
								<div id="form-step-1">
									<div class="physical-card-box">
										 
										<h3 class="section-title mb-3">बधाई हो</h3>

										<p class="hindi-text">
											प्रिय <span class="highlight">{{ $member->name }}</span> आयुष्मति मेंबरशिप कार्ड के लिए आपका आवेदन सफलता पूर्वक स्वीकार कर लिया गया है। आपका मेंबरशिप  नंबर <span style="font-size:18px;font-weight:bold;" class="highlight">{{ $member->membership_number }} </span> है।
										
										</p>
										<a href="{{ url('member/apply-physical-membership') }}" class="btn btn-danger btn-lg">New Physical Membership Apply</a>
									</div>
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
	<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<script>

	 

</script>

    @include('vivah_mitra.includes.home_footer_menu')

    @endsection
