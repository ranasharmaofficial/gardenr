@extends('admin.include.master')
@section('title')
	{{ $page_title }}
@endsection
@section('content')
<style>
/* Wrapper */
.modern-stepper {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin: 40px auto;
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

</style>
<!-- Page Header -->
            <div style="background:linear-gradient(45deg, #f33057, rgb( 56, 88, 249 ) );" class="d-sm-flex d-block align-items-center justify-content-between page-header-breadcrumb">
                <div>
                    <h4 class="fw-medium mb-2">{{ $page_title }}</h4>
                    <div class="ms-sm-1 ms-0">
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a class="" href="javascript:void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item  active fw-normal" aria-current="page">{{ $page_title }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>

            </div>
            <!-- Page Header Close -->



            <!--APP-CONTENT START-->
            <div class="main-content app-content">
                <div class="container-fluid">
				<!-- Start:: row-2 -->
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card custom-card">
                            <div class="card-header d-flex justify-content-between align-items-center">
								<h5 class="mb-0">{{ $page_title }}</h5>
							</div>


                            <div class="card-body">

								<form method="post" action="" id="save-members-Form" enctype="multipart/form-data">
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
												<div class="step-label">Digital Card</div>
											</div>

										</div>

										<div style="display:none;" id="show-form-error" class="alert alert-danger col-md-12">
											<ul>
												<div class="errorMsgntainer"></div>
											</ul>
										</div>

										<div id="form-step-1">
											<div class="physical-card-box">
												<div>
													<h3 class="section-title text-center">{{ $page_title }}</h3>
												</div>
												<h3 class="section-title">Applicant Details</h3>

												<div class="row mb-3">
													<div class="col-md-6">
														<div class="form-group">
															<label class="pretty-label">विवाह मित्र का चुनाव करें  <span class="text-danger">*</span></label>
															<select class="pretty-input" name="leader_id">
																<option value="">Select Vivah Mitra</option>
																@foreach($vivah_mitra_list as $val)
																	<option @if(old('brand')==$val->branch) selected @endif value="{{ $val->id }}">{{ $val->first_name }} ({{ $val->employee_code }})</option>
																@endforeach
															</select>
														</div>
													</div>

                                                    <div class="col-md-6">
														<div class="form-group">
															<label class="pretty-label">आयुष्मती मेम्बर्शिप कार्ड चार्ज <span class="text-danger">*</span></label>
															<select class="pretty-input" required name="card_price">
																<option value="">Select आयुष्मती मेम्बर्शिप कार्ड चार्ज</option>
																<option selected value="2999">2999/-</option>
															</select>
														</div>
													</div>

													{{--
													<div class="col-md-6">
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
													--}}

												</div>

												<div class="row mb-3">
													<div class="col-md-6 mb-3">
														<label class="pretty-label">दीदी का नेम </label>
														<input type="text" name="name" style="" placeholder="दीदी का नेम" class="pretty-input ">
													</div>
													<div class="col-md-6 mb-3">
														<label class="pretty-label">पिता / पति </label>
														<input type="text" name="father_husband" placeholder="पिता / पति" class="pretty-input">
													</div>
												</div>

												<div class="row mb-3">
													<div class="col-md-6 mb-3">
														<label class="pretty-label">पूरा पता </label>
														<input type="text" name="address" placeholder="पूरा पता" class="pretty-input">
													</div>
													<div class="col-md-6 mb-3">
														<label class="pretty-label">पोस्ट </label>
														<input type="text" name="post" placeholder="पोस्ट" class="pretty-input">
													</div>
												</div>

												<div class="row mb-3">
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

												<div class="row mb-3">
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
														<button type="button" class="btn btn-primary btn-lg float-end" onclick="goStep2()">Next</button>
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
														<input type="text" name="ayushmati_qualification" placeholder="योग्यता" class="pretty-input">
													</div>
													<div class="col-md-4 mb-3">
														<label class="pretty-label">पेशा (क्या करती है )</label>
														<input type="text" name="ayushmati_father_occupation" placeholder="पेशा (क्या करती है )" class="pretty-input">
													</div>
													<div class="col-md-4 mb-3">
														<label class="pretty-label">पिता/पति का नाम </label>
														<input type="text" name="ayushmati_father_husband_name" placeholder="पिता/पति का नाम " class="pretty-input">
													</div>
												</div>

												<div class="row mb-3">
													<div class="col-md-6">
														<label class="pretty-label">शुभ विवाह महिना (संभावना )</label>
														<input type="month" name="ayushmati_expected_marriage_month" placeholder="शुभ विवाह महिना (संभावना )" class="pretty-input">
													</div>
													<div class="col-md-6">
														<label class="pretty-label">शुभ विवाह वर्ष (संभावना )</label>
														<input type="year" name="ayushmati_expected_marriage_year" placeholder="शुभ विवाह वर्ष (संभावना )" class="pretty-input">
													</div>
												</div>

												<button type="button" class="btn btn-secondary btn-lg" onclick="backStep1()">Back</button>
												<button type="button" class="btn btn-primary btn-lg float-end" onclick="goStep3()">Next</button>
											</div>
										</div>



										<div id="form-step-3" class="d-none">
											<div class="physical-card-box">
												<h3 class="section-title">बहन का विवरण</h3>

												<div class="row mb-3">
													<div class="col-md-4 mb-3">
														<label class="pretty-label">नाम </label>
														<input type="text" name="sister_name_1" placeholder="नाम" class="pretty-input">
													</div>
													<div class="col-md-4 mb-3">
														<label class="pretty-label">योग्यता </label>
														<input type="text" name="sister_qualification_1" placeholder="योग्यता" class="pretty-input">
													</div>
													<div class="col-md-4 mb-3">
														<label class="pretty-label">उम्र </label>
														<input type="number" name="sister_age_1" placeholder="उम्र" class="pretty-input">
													</div>
												</div>

												<div class="row mb-3">
													<div class="col-md-4 mb-3">
														<label class="pretty-label">नाम </label>
														<input type="text" name="sister_name_2" placeholder="नाम" class="pretty-input">
													</div>
													<div class="col-md-4 mb-3">
														<label class="pretty-label">योग्यता </label>
														<input type="text" name="sister_qualification_2" placeholder="योग्यता" class="pretty-input">
													</div>
													<div class="col-md-4 mb-3">
														<label class="pretty-label">उम्र </label>
														<input type="number" name="sister_age_2" placeholder="उम्र" class="pretty-input">
													</div>
												</div>

												<div class="row mb-3">
													<div class="col-md-4 mb-3">
														<label class="pretty-label">नाम </label>
														<input type="text" name="sister_name_3" placeholder="नाम" class="pretty-input">
													</div>
													<div class="col-md-4 mb-3">
														<label class="pretty-label">योग्यता </label>
														<input type="text" name="sister_qualification_3" placeholder="योग्यता" class="pretty-input">
													</div>
													<div class="col-md-4 mb-3">
														<label class="pretty-label">उम्र </label>
														<input type="number" name="sister_age_3" placeholder="उम्र" class="pretty-input">
													</div>
												</div>

												<!-- Add more sister rows if needed -->

												<button type="button" class="btn btn-secondary btn-lg" onclick="backStep2()">Back</button>
												<button type="button" class="btn btn-primary btn-lg float-end" onclick="goStep4()">Next</button>
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


												<button type="button" class="btn btn-secondary btn-lg" onclick="backStep3()">Back</button>
												<button type="button" class="btn btn-primary btn-lg float-end" onclick="goStep5()">Next</button>
											</div>
										</div>

										<div id="form-step-5" class="d-none">
											<div class="physical-card-box">
												<h3 class="section-title">Digital Card</h3>

												<p class="hindi-text">
													मैं <span class="line">____________</span>, (विवाह मित्र) संस्थान <span class="line">____________</span> से
													सविनय निवेदन करता/करती हूं कि मुझे फिजिकल आयुष्मति कार्ड प्रदान किया जाए।

													मुझे बताया गया है कि कार्ड की कीमत <strong>₹2,999</strong> है,
													लेकिन अभी विशेष प्रस्ताव के तहत <strong class="highlight">₹499</strong> में उपलब्ध है।

													मैं कार्ड प्राप्त करने के लिए सहमत हूं और राशि का भुगतान करने के लिए तैयार हूं।
													कृपया मुझे कार्ड प्रदान करने की व्यवस्था करें।
												</p>

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
                    </div>
                </div>
                <!-- End:: row-2 -->



                </div>
            </div>
            <!--APP-CONTENT CLOSE-->


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
            url: "{{ route('admin.members.storeDigitalCardMemberData') }}",
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
                    location.reload();
                } else {
                    Swal.fire({
						icon: "error",
						title: "Oh No!",
						text: "Something went wrong!",
						timer: 1500,
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
	/*
	$('#membership-number').on('keyup change', function () {

		let number = $(this).val();

		// Hide status text
		$('#membership-status').text('').css('color', 'red');

		// Disable submit button
		$('#submit-btn').prop('disabled', true);

		// Hide loader if length < 12
		if (number.length != 12) {
			$('#membership-loader').hide();
			return;
		}

		// Show loader
		$('#membership-loader').show();

		$.ajax({
			url: "",
			type: "POST",
			data: {
				membership_number: number,
				_token: "{{ csrf_token() }}"
			},
			success: function (res) {

				// Hide loader after response
				$('#membership-loader').hide();

				if (res.status === 'not_found') {
					$('#membership-status').text('❌ Invalid Membership Number');
					$('#submit-btn').prop('disabled', true);
				}

				else if (res.status === 'used') {
					$('#membership-status').html(
						`❌ Already used by <b>${res.member_name}</b>`
					);
					$('#submit-btn').prop('disabled', true);
				}

				else if (res.status === 'unused') {
					// $('#membership-status')
						// .text('✔ Available')
						// .css('color', 'green');

					$('#membership-status')
					.removeClass('membership-error')
					.addClass('membership-success')
					.text('✔ Available');

					$('#submit-btn').prop('disabled', false);
				}
			}
		});

	});
	*/




</script>

<script>
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

</script>



@endsection

