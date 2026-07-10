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
                        <h5 class="mb-0">फिज़िकल मेम्बर्शिप अप्लाइ </h5>
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

							<form method="post" action="" autocomplete="off" id="save-members-Form" enctype="multipart/form-data">
									<div class="container">

										<div class="modern-stepper">

											<div class="step-item active" id="m-step-1">
												<div class="step-circle">1</div>
												<div class="step-label">Applicant Details</div>
											</div>

											<div class="step-item" id="m-step-2">
												<div class="step-circle default">2</div>
												<div class="step-label">Family Details</div>
											</div>

											<div class="step-item" id="m-step-3">
												<div class="step-circle default">3</div>
												<div class="step-label">Sister Details</div>
											</div>

											<div class="step-item" id="m-step-4">
												<div class="step-circle default">4</div>
												<div class="step-label">Gift Package</div>
											</div>

											<div class="step-item" id="m-step-5">
												<div class="step-circle default">5</div>
												<div class="step-label">Physical Card</div>
											</div>

										</div>

										<div style="display:none;" id="show-form-error" class="alert alert-danger col-md-12">
											<ul>
												<div class="errorMsgntainer"></div>
											</ul>
										</div>

										<div id="form-step-1">

												<div class="row">
													<div class="col-md-6 mb-3">
														<div class="form-group">
															<label class="pretty-label">
																मएम्बेररशिप नंबर दर्ज करें <span class="text-danger">*</span>
															</label>
															<input type="tel" minlength="12" name="membership_number" maxlength="12"
																   id="membership-number"
																   placeholder="मएम्बेररशिप नंबर दर्ज करें"
																   class="pretty-input">

															<small id="membership-status" class="text-danger"></small>

															<!-- Loader -->
															<div id="membership-loader" style="display:none; margin-top:5px;">
																<img src="https://i.gifer.com/ZZ5H.gif" width="28">
															</div>
														</div>
													</div>

													<div class="col-md-6 mb-3">
														<div class="form-group">
															<button type="button" id="checkMembershipBtn" class="btn btn-danger mt-3">CHECK</button>
														</div>
													</div>

													<div class="col-md-12 text-center mt-3" id="lottie-loader" style="display:none;">
														<div id="lottie-check" style="width:120px;margin:auto;"></div>
														<p class="text-muted mt-2">Checking Membership...</p>
													</div>

												</div>
											<div id="physical-membership-card-box" style="display:none;" class="physical-card-box">

												<h3 class="section-title mb-3">Applicant Details</h3>



												<div class="row">
													<div class="col-md-6 mb-3">
														<div class="form-group">
															<label class="pretty-label">विवाह मित्र  <span class="text-danger">*</span></label>
															<input type="hidden" name="leader_id" value="{{ $vivah_mitra_details->id }}">
															<input type="text" readonly style="background-color: aliceblue;" value="{{ $vivah_mitra_details->first_name.' - '.$vivah_mitra_details->employee_code }}" class="pretty-input ">
														</div>
													</div>

                                                    <div class="col-md-6 mb-3">
														<div class="form-group">
															<label class="pretty-label">आयुष्मती मेम्बर्शिप कार्ड चार्ज <span class="text-danger">*</span></label>
															<select class="pretty-input" required name="card_price">
																<option value="">Select आयुष्मती मेम्बर्शिप कार्ड चार्ज</option>
																<option selected value="2999">2999/-</option>
															</select>
														</div>
													</div>

												</div>

												<div class="row">
													<div class="col-md-6 mb-3">
														<label class="pretty-label">दीदी का नेम </label>
														<input type="text" name="name" id="didi-name" style="" placeholder="दीदी का नेम" class="pretty-input ">
													</div>
													<div class="col-md-6 mb-3">
														<label class="pretty-label">पिता / पति </label>
														<input type="text" name="father_husband" placeholder="पिता / पति" class="pretty-input">
													</div>
												</div>

												<div class="row">
													<div class="col-md-6 mb-3">
														<label class="pretty-label">पूरा पता </label>
														<input type="text" name="address" placeholder="पूरा पता" class="pretty-input">
													</div>
													<div class="col-md-6 mb-3">
														<label class="pretty-label">पोस्ट </label>
														<input type="text" name="post" placeholder="पोस्ट" class="pretty-input">
													</div>
												</div>

												<div class="row">
													<div class="col-md-6 mb-3">
														<label class="pretty-label">राज्य </label>
														<select class="pretty-input" name="state" id="state">
															@foreach($state_bihar_list as $val)
																<option value="{{ $val->id }}">{{ $val->name }}</option>
															@endforeach
														</select>
													</div>
													<div class="col-md-6 mb-3">
														<label class="pretty-label">जिला </label>
														<select class="pretty-input" required name="district" id="district">
															<option value="">Select District</option>
															@foreach($district_bihar_list as $val)
																<option value="{{ $val->id }}">{{ $val->name }}</option>
															@endforeach
														</select>
													</div>

													<div class="col-md-6  mb-3">
														<label class="pretty-label">पिन कोड  </label>
														<input type="text" name="pincode" placeholder="पिन कोड" class="pretty-input">
													</div>

												</div>

												<div class="row">
													<div class="col-md-6 mb-3">
														<label class="pretty-label">मोबाईल नंबर </label>
														<input type="tel" min="10" maxlength="10" name="mobile" placeholder="मोबाईल नंबर" class="pretty-input">
													</div>
													<div class="col-md-6 mb-3">
														<label class="pretty-label">व्हाट्सप्प नंबर </label>
														<input type="tel" min="10" maxlength="10" name="whatsapp" placeholder="व्हाट्सप्प नंबर" class="pretty-input">
													</div>

												</div>
												<div class="row mb-3">
													<div class="col-md-12">
														<button type="button" class="btn btn-primary float-end" onclick="goStep2()">Next</button>
													</div>
												</div>
											</div>
										</div>

										<div id="form-step-2" class="d-none">
											<div class="physical-card-box">
												<h3 class="section-title">आयुष्मती विवरण</h3>

												<div class="row mb-3">
													<div class="col-md-4 mb-3">
														<label class="pretty-label">आयुष्मती (लड़की का नेम )</label>
														<input type="text" name="ayushmati_girl_name"  placeholder="आयुष्मती (लड़की का नेम )" class="pretty-input">
													</div>
													<div class="col-md-4 mb-3">
														<label class="pretty-label">उम्र </label>
														<input type="number" name="ayushmati_age" placeholder="उम्र" class="pretty-input">
													</div>
													<div class="col-md-4 mb-3">
														<label class="pretty-label">योग्यता </label>
														<select type="text" name="ayushmati_qualification" placeholder="योग्यता" class="pretty-input">
                                                            <option value="">Select योग्यता</option>
                                                            <option value="Post Graduation">Post Graduation</option>
                                                            <option value="Graduation">Graduation</option>
                                                            <option value="Intermediate">Intermediate</option>
                                                            <option value="Matric">Matric</option>
                                                            <option value="Study">Study</option>
                                                            <option value="Other">Other</option>
                                                        </select>
													</div>
													<div class="col-md-4 mb-3">
														<label class="pretty-label">पेशा (क्या करती है )</label>
														<select type="text" name="ayushmati_father_occupation" placeholder="पेशा (क्या करती है )" class="pretty-input">
                                                            <option value="">Select पेशा (क्या करती है )</option>
                                                            <option value="House Wife">House Wife</option>
                                                            <option value="Govt. Job">Govt. Job</option>
                                                            <option value="Private Job">Private Job</option>
                                                            <option value="Farmer">Farmer</option>
                                                            <option value="Business">Business</option>
                                                            <option value="Teaching">Teaching</option>
                                                            <option value="Silai">Silai/Kadhai</option>
                                                            <option value="Jeevika">Jeevika</option>
                                                            <option value="NM">NM</option>
                                                            <option value="Doctor">Doctor</option>
                                                            <option value="Other">Other</option>
                                                        </select>
													</div>
												</div>

												<div class="row mb-3">
													<div class="col-md-6 mb-3">
														<label class="pretty-label">शुभ विवाह महिना (संभावना )</label>
														<input type="month" name="ayushmati_expected_marriage_month" placeholder="शुभ विवाह महिना (संभावना )" class="pretty-input">
													</div>
													<div class="col-md-6 mb-3">
														<label class="pretty-label">शुभ विवाह वर्ष (संभावना )</label>
														<select type="year" name="ayushmati_expected_marriage_year" placeholder="शुभ विवाह वर्ष (संभावना )" class="pretty-input">
															<option value="">Select Year</option>
															<option value="2026">2026</option>
															<option value="2027">2027</option>
															<option value="2028">2028</option>
															<option value="2029">2029</option>
															<option value="2030">2030</option>
															<option value="2031">2031</option>
															<option value="2032">2032</option>
															<option value="2033">2033</option>
															<option value="2034">2034</option>
														</select>
													</div>
												</div>


												<div class="row mb-3">
													<div class="col-6">
														<button type="button" class="btn btn-secondary" onclick="backStep1()">Back</button>
													</div>
													<div class="col-6">
														<button type="button" class="btn btn-primary float-end" onclick="goStep3()">Next</button>
													</div>
												</div>
											</div>
										</div>



										<div id="form-step-3" class="d-none">
											<div class="physical-card-box">
												<h3 class="section-title">बहन का विवरण</h3>

												<div class="row">
													<div class="col-md-4 mb-3">
														<label class="pretty-label">पहला बहन का नाम </label>
														<input type="text" name="sister_name_1" placeholder="पहला बहन का नाम" class="pretty-input">
													</div>
													<div class="col-md-4 mb-3">
														<label class="pretty-label">योग्यता </label>
														<select type="text" name="sister_qualification_1" placeholder="योग्यता" class="pretty-input">
                                                            <option value="">Select योग्यता</option>
                                                            <option value="Post Graduation">Post Graduation</option>
                                                            <option value="Graduation">Graduation</option>
                                                            <option value="Intermediate">Intermediate</option>
                                                            <option value="Matric">Matric</option>
                                                            <option value="Study">Study</option>
                                                            <option value="Other">Other</option>
                                                        </select>
													</div>
													<div class="col-md-4 mb-3">
														<label class="pretty-label">उम्र </label>
														<input type="number" name="sister_age_1" placeholder="उम्र" class="pretty-input">
													</div>
												</div>

												<div class="row mb-3">
													<div class="col-md-4 mb-3">
														<label class="pretty-label">दूसरा बहन का नाम </label>
														<input type="text" name="sister_name_2" placeholder="दूसरा बहन का नाम" class="pretty-input">
													</div>
													<div class="col-md-4 mb-3">
														<label class="pretty-label">योग्यता </label>
														<select type="text" name="sister_qualification_2" placeholder="योग्यता" class="pretty-input">
                                                            <option value="">Select योग्यता</option>
                                                            <option value="Post Graduation">Post Graduation</option>
                                                            <option value="Graduation">Graduation</option>
                                                            <option value="Intermediate">Intermediate</option>
                                                            <option value="Matric">Matric</option>
                                                            <option value="Study">Study</option>
                                                            <option value="Other">Other</option>
                                                        </select>
													</div>
													<div class="col-md-4 mb-3">
														<label class="pretty-label">उम्र </label>
														<input type="number" name="sister_age_2" placeholder="उम्र" class="pretty-input">
													</div>
												</div>

												<div class="row mb-3">
													<div class="col-md-4 mb-3">
														<label class="pretty-label">तीसरा बहन का नाम </label>
														<input type="text" name="sister_name_3" placeholder="तीसरा बहन का नाम" class="pretty-input">
													</div>
													<div class="col-md-4 mb-3">
														<label class="pretty-label">योग्यता </label>
														<select type="text" name="sister_qualification_3" placeholder="योग्यता" class="pretty-input">
                                                            <option value="">Select योग्यता</option>
                                                            <option value="Post Graduation">Post Graduation</option>
                                                            <option value="Graduation">Graduation</option>
                                                            <option value="Intermediate">Intermediate</option>
                                                            <option value="Matric">Matric</option>
                                                            <option value="Study">Study</option>
                                                            <option value="Other">Other</option>
                                                        </select>
													</div>
													<div class="col-md-4 mb-3">
														<label class="pretty-label">उम्र </label>
														<input type="number" name="sister_age_3" placeholder="उम्र" class="pretty-input">
													</div>
												</div>

												<!-- Add more sister rows if needed -->
												<div class="row mb-3">
													<div class="col-6">
														<button type="button" class="btn btn-secondary" onclick="backStep2()">Back</button>
													</div>
													<div class="col-6">
														<button type="button" class="btn btn-primary float-end" onclick="goStep4()">Next</button>
													</div>
												</div>
											</div>
										</div>

										<div id="form-step-4" class="d-none">
											<div class="physical-card-box">
												<h3 class="section-title">शादी में देने वाला गिफ्ट पैकेज लेने की संभावना</h3>
												<div class="package-options mt-3 mb-3">
													<label class="package-box">
														<input type="radio" name="expected_marriage_package" value="51000">
														<span>₹51,000 Package</span>
													</label>

													<label class="package-box">
														<input type="radio" name="expected_marriage_package" value="99000">
														<span>₹99,000 Package</span>
													</label>

													<label class="package-box">
														<input type="radio" name="expected_marriage_package" value="175000">
														<span>₹1,75,000 Package</span>
													</label>
												</div>

												<div class="row mb-3">
													<div class="col-6">
														<button type="button" class="btn btn-secondary" onclick="backStep3()">Back</button>
													</div>
													<div class="col-6">
														<button type="button" class="btn btn-primary float-end" onclick="goStep5()">Next</button>
													</div>
												</div>


											</div>
										</div>

										<div id="form-step-5" class="d-none">
											<div class="physical-card-box">
												<h3 class="section-title">Physical Card</h3>


												<p class="hindi-text">
													मैं <span style="font-weight:bold;" class="highlight" id="shows-name">  </span>,  संस्थान <span class="highlight"> GHAR AANGAN FOUNDATION  </span> से
													सविनय निवेदन करता/करती हूं कि मुझे फिजिकल आयुष्मति कार्ड प्रदान किया जाए।

													मुझे बताया गया है कि कार्ड की कीमत <strong>₹2,999</strong> है,
													लेकिन अभी विशेष प्रस्ताव के तहत <strong class="highlight">₹999</strong> में उपलब्ध है।

													मैं कार्ड प्राप्त करने के लिए सहमत हूं और राशि का भुगतान करने के लिए तैयार हूं।
													कृपया मुझे कार्ड प्रदान करने की व्यवस्था करें।
												</p>



												<div class="row mb-3 justify-content-center">
													<div class="col-md-6 mb-3">
														<label class="pretty-label">रिसीव्ड कार्ड चार्ज प्राइस </label>
														<input type="number" readonly value="999" name="received_card_amount" style="" placeholder="रिसीव्ड कार्ड चार्ज प्राइस" class="pretty-input ">
													</div>
												</div>

												<div class="row mb-3">
													<div class="col-md-4 mb-3">
														<label>Select Photo</label>
														<input type="file" class="form-control" required accept="image/*" name="profile_pic">
													</div>
												</div>


												<div class="btn-area">
													<button type="button" class="btn btn-secondary btn-lg" onclick="backStep4()">Back</button>
													<button type="submit" id="submit-btn"  class="btn btn-success btn-lg saveMembersBtn">Submit</button>
												</div>
											</div>
										</div>

									</div>
								</form>




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

	$(document).on('click', '.saveMembersBtn', function(e) {
		e.preventDefault();
        var clk_btn = $(".saveMembersBtn");
        clk_btn.prop('disabled', true);
        var formData = new FormData(document.getElementById("save-members-Form"));
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: "{{ route('member.storePhysicalCardMemberData') }}",
            data: formData,
            processData: false,
            contentType: false,
            dataType: "JSON",
			success: function(data) {
                console.log('status ' + data.status);
                if (data.status == true) {
                    Swal.fire({
						icon: "success",
						title: "Success",
						text: data.message,
						timer: 1500,
						showConfirmButton: false
					});
					document.getElementById('show-form-error').style = "display: none";
                    // location.reload();
					let member = data.member;
					setTimeout(function () {
						window.location.href = "{{ url('member/physical-member-applied') }}/" + member;
					}, 1500);
                } else {
                    Swal.fire({
						icon: "error",
						title: "Oh No!",
						text: data.message,
						timer: 10000, // 10 seconds
						showConfirmButton: false
					});
				}
            }, error: function(err) {

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

	let checkAnimation = lottie.loadAnimation({
		container: document.getElementById('lottie-check'),
		renderer: 'svg',
		loop: true,
		autoplay: false,
		path: 'https://assets10.lottiefiles.com/packages/lf20_usmfx6bp.json'
	});

	$(document).ready(function () {

		$('#checkMembershipBtn').click(function () {

			let membershipNumber = $('#membership-number').val();

			if (!membershipNumber) {
				Swal.fire('Error', 'Please enter Membership No.', 'error');
				return;
			}

			// UI Reset
			$('#physical-membership-card-box').hide();

			// Show loader
			$('#lottie-loader').fadeIn();
			checkAnimation.play();

			$('#checkMembershipBtn').prop('disabled', true).text('Checking...');

			$.ajax({
				url: "{{ route('member.check.vivahmitra.membership') }}",
				type: "POST",
				data: {
					_token: "{{ csrf_token() }}",
					membership_number: membershipNumber
				},
				success: function (res) {

					$('#lottie-loader').fadeOut();
					checkAnimation.stop();

					$('#checkMembershipBtn').prop('disabled', false).text('CHECK');

					if (res.status === 'not_found') {
						$('#membership-status').text('❌ Invalid Membership Number');
						$('#submit-btn').prop('disabled', true);
						Swal.fire('Invalid Membership Number', res.message, 'error');
						$('#physical-membership-card-box').hide();
					}

					else if (res.status === 'used') {
						$('#membership-status').html(
							`❌ Already used by <b>${res.member_name}</b>`
						);
						$('#physical-membership-card-box').hide();
						$('#submit-btn').prop('disabled', true);
					}

					else if (res.status === 'unused') {
						$('#membership-status')
						.removeClass('membership-error')
						.addClass('membership-success')
						.text('✔ Available');
						$('#physical-membership-card-box').slideDown();
						$('#submit-btn').prop('disabled', false);
					}

					/*if (res.status) {

						$('#empName').text(res.data.name);
						$('#empCode').text(res.data.code);
						$('#empMobile').text(res.data.mobile);
						$('#empEmail').text(res.data.email);
						$('#empAddress').text(res.data.address + ', ' + res.data.district + ', ' + res.data.state);
						$('#empPhoto').attr('src', res.data.photo);

						$('#employee-card-box').slideDown();
						$('#incentive-sale-box').slideDown();

					} else {
						Swal.fire('Not Found', res.message, 'error');
					}
					*/
				},
				error: function () {

					$('#lottie-loader').fadeOut();
					checkAnimation.stop();

					$('#checkEmployeeBtn').prop('disabled', false).text('CHECK');

					Swal.fire('Error', 'Something went wrong', 'error');
				}
			});
		});
	});




function setStep(step) {
    let steps = [1, 2, 3, 4, 5];

    steps.forEach(num => {
        let el = document.getElementById(`m-step-${num}`);
        el.classList.remove("active", "completed");

        if (num < step) el.classList.add("completed");
        if (num === step) el.classList.add("active");
    });

    // Show form section
    steps.forEach(num => {
        document.getElementById(`form-step-${num}`).classList.add("d-none");
    });
    document.getElementById(`form-step-${step}`).classList.remove("d-none");
}

function goStep2() { setStep(2); }
function goStep3() { setStep(3); }
function goStep4() { setStep(4); }
function goStep5() { setStep(5); }
function backStep1() { setStep(1); }
function backStep2() { setStep(2); }
function backStep3() { setStep(3); }
function backStep4() { setStep(4); }

document.addEventListener("DOMContentLoaded", function () {
    // ===== ELEMENTS =====

    const firstNameInput     = document.getElementById("didi-name");

    // ===== SUMMARY DISPLAY ELEMENTS =====
    const showNameEl       = document.getElementById("shows-name");



    // ===== SUMMARY UPDATE =====
    function updateSummary() {
        const firstName = firstNameInput.value.trim();
        console.log(firstName);
        showNameEl.textContent = `${firstName}`.trim() || "—";

    }

    [firstNameInput].forEach(input => {
        input.addEventListener("input", updateSummary);
    });

    // ===== ERROR HANDLING =====
    function showError(input, message) {
		// find the correct parent for grouped inputs (like phone + country code)
		let parent = input.closest('.form-group, .input-group, div');

		// remove any existing error first
		let existingError = parent.querySelector('.text-danger');
		if (existingError) existingError.remove();

		// create new error
		const errorEl = document.createElement('div');
		errorEl.className = 'text-danger mt-1 small w-100';
		errorEl.style.display = 'block';
		errorEl.textContent = message;

		// append the error directly below the input group or field
		parent.appendChild(errorEl);

		// red border for invalid field
		input.classList.add('is-invalid');
	}






});

</script>

    @include('vivah_mitra.includes.home_footer_menu')

    @endsection
