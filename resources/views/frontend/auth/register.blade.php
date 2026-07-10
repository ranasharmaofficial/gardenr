@extends('frontend.layouts.master')
@section('title') Franchise Register @endsection

@section('content')

<section id="ed-breadcrumb" class="ed-breadcrumb-sec" data-background="{{ static_asset('assets/assets_web/images/header-about5.jpg') }}">
		<div class="container">
			<div class="ed-breadcrumb-content">
				<div class="ed-breadcrumb-text text-center headline ul-li">
					<h2 class="bread_title">Franchise Registration</h2>
					<ul>
						<li><a href="{{ url('') }}">Home</a></li>
						<li>Franchise Registration</li>
					</ul>
				</div>
			</div>
		</div>
	</section>

<!-- Start of Feature section
  ============================================= -->
<section id="ed-cp-form" class="ed-cp-form-sec position-relative">
		<div class="container">
		<div class="row">
		<div class="col-lg-8">
			<div class="ed-cp-form-content  pb-155 position-relative">
				<div class="ed-cp-form position-relative">
					<div class="gt-client-review-form cp_ver mt-40">
						<h3>Franchise Registration</h3>
						<form action="{{ route('register.post') }}" enctype="multipart/form-data" method="post">
					@csrf
				  <div class="it-signup-wrap">
                    
					<div class="col-md-12">
						@if ($errors->any())
							<div class="alert alert-danger">
								<ul>
									@foreach ($errors->all() as $error)
										<li style="list-style-type: disclosure-closed;margin-left: 8px;">{{ $error }}</li>
									@endforeach
								</ul>
							</div>
						@endif
						@if(Session::has('alert-success'))
							<div class="alert alert-success alert-dismissible fade show" role="alert">
								Registered Successfully! Contact Admin for approval.
								<button type="button" class="btn btn-info btn-close" data-bs-dismiss="alert" aria-label="Close">X</button>
							</div>
						@endif
					</div>

                    <div class="it-signup-input-wrap row">
                       
					  <div class="it-signup-input mb-20 col-sm-6">
                        <input type="text" value="{{ old('first_name') }}" required name="first_name" placeholder="First Name*" />
                      </div>
					  <div class="it-signup-input mb-20 col-sm-6">
                        <input type="text" value="{{ old('last_name') }}" required name="last_name" placeholder="Last Name*" />
                      </div>
					  <div class="it-signup-input mb-20 col-sm-6">
                        <input type="text" value="{{ old('institute_name') }}" required  name="institute_name" placeholder="Institute Name*" />
                      </div>


						<div class="it-student-regiform-item col-sm-6">
							<div class=" mb-20">
								<select class="form-control" style="border-radius: 5px;color: #0E2A46;font-size: 16px;font-style: normal;font-weight: 400;text-transform: capitalize;"  required id="fstate" name="state">
									<option selected disabled>Select State*</option>
									@foreach($state_list as $val)
										<option @if(old("state")==$val->id) selected @endif value="{{ $val->id }}">{{ $val->name }}</option>
									@endforeach
								</select>
							</div>
						</div>

						<div class="it-signup-input mb-20 col-sm-6">
							<div class="">
								<select class="form-control" style="border-radius: 5px;color: #0E2A46;font-size: 16px;font-style: normal;font-weight: 400;text-transform: capitalize;"  required id="fcity" name="city">
									<option selected disabled>Select City*</option>

								</select>
							</div>
						</div>



					  <div class="it-signup-input mb-20 col-sm-6">
                        <input type="tel" value="{{ old('pincode') }}" required name="pincode" placeholder="Pin Code*" />
                      </div>
					  <div class="it-signup-input mb-20 col-sm-6">
                        <input type="email" value="{{ old('email') }}" required name="email" placeholder="Email Address*" />
                      </div>
					  <div class="it-signup-input mb-20 col-sm-6">
                        <input type="tel" value="{{ old('mobile') }}" required name="mobile" placeholder="Mobile No.*" />
                      </div>
					  <div class="it-signup-input mb-20 col-sm-6">
						<label style="font-weight:bold">Select Center Photo</label>
                        <input onchange="loadFile(event)" required type="file" value="{{ old('center_photo') }}" accept="image/*" name="center_photo" placeholder="Center Photo*" />
						<img style="width:auto;height:80px;padding-top:5px;padding-bottom:2px;" class="img-fluid" id="picone"/>
							<script>
							  var loadFile = function(event) {
								var input = document.getElementById('picone');
								picone.src = URL.createObjectURL(event.target.files[0]);
							  };
							</script>
                      </div>
					  <div class="it-signup-input mb-20 col-sm-6">
						<label style="font-weight:bold">Select Director Photo</label>
                        <input onchange="loadFile1(event)" required type="file" value="{{ old('director_photo') }}" accept="image/*" name="director_photo" placeholder="Director Photo*" />
						<img style="width:auto;height:80px;padding-top:5px;padding-bottom:2px;" class="img-fluid" id="picone1"/>
							<script>
							  var loadFile1 = function(event) {
								var input1 = document.getElementById('picone1');
								picone1.src = URL.createObjectURL(event.target.files[0]);
							  };
							</script>
                      </div>
					  <div class="it-signup-input mb-20">
						<label style="font-weight:bold">Select Aadhar Card (Pdf Format)</label>
                        <input type="file" required value="{{ old('aadhar_card') }}" accept="application/pdf" name="aadhar_card" placeholder="Aadhar Card*" />

                      </div>
					  <div class="it-signup-input mb-20">
                        <input type="text" required value="{{ old('director_higher_qualifications') }}" name="director_higher_qualifications" placeholder="Director Higher Qualifications*" />
                      </div>
					  <div class="it-signup-input mb-20">
                        <input type="password" name="password" placeholder="Password" />
                      </div>
                    </div>

                    <div class="it-signup-btn mb-40">
                      <button type="submit" class="it-btn large">Sign Up</button>
                    </div>
                    <div class="it-signup-text">
                      <span>Have an account?<a href="{{ url('franchise-login') }}">Login</a></span>
                    </div>
                  </div>
                </form>
					</div>
				</div>
			</div>
			</div>
			<div class="col-lg-4">
			<img src="{{ static_asset('assets/assets_web/images/student-login.jpg') }}">
			</div>
			</div>
		</div>
	</section>





@if(false)
<style>
    .checkbox-item {
        display: block;
        margin-bottom: 5px; /* Adjust spacing as needed */
    }

	select {
		height: 58px;
		width: 100%;
		border: none;
		outline: none;
		padding: 0 20px;
		line-height: 58px;
		font-size: 14px;
		color: var(--it-common-black);
	}
</style>

 <!-- Bootstrap Select CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css" rel="stylesheet">
    <main>
      <div
        class="it-breadcrumb-area it-breadcrumb-bg"
        data-background="{{ static_asset('assets/assets_web/images/breadcrumb.jpg') }}"
      >
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="it-breadcrumb-content z-index-3 text-center">
                <div class="it-breadcrumb-title-box">
                  <h3 class="it-breadcrumb-title">Franchise Register</h3>
                </div>
                <div class="it-breadcrumb-list-wrap">
                  <div class="it-breadcrumb-list">
                    <span><a href="{{ url('') }}">home</a></span>
                    <span class="dvdr">//</span>
                    <span>Franchise Register</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="it-signup-area pt-120 pb-120">
        <div class="container">
          <div class="it-signup-bg p-relative">
            <div class="it-signup-thumb d-none d-lg-block">
              <img src="{{ static_asset('assets/assets_web/images/thumb-1-1.jpg') }}" alt="" />
            </div>
            <div class="row">
              <div class="col-xl-6 col-lg-6">
                <form action="{{ route('register.post') }}" enctype="multipart/form-data" method="post">
					@csrf
				  <div class="it-signup-wrap">
                    <h4 class="it-signup-title">Franchise Register</h4>
					<div class="col-md-12">
						@if ($errors->any())
							<div class="alert alert-danger">
								<ul>
									@foreach ($errors->all() as $error)
										<li style="list-style-type: disclosure-closed;margin-left: 8px;">{{ $error }}</li>
									@endforeach
								</ul>
							</div>
						@endif
						@if(Session::has('alert-success'))
							<div class="alert alert-success alert-dismissible fade show" role="alert">
								Registered Successfully! Contact Admin for approval.
								<button type="button" class="btn btn-info btn-close" data-bs-dismiss="alert" aria-label="Close">X</button>
							</div>
						@endif
					</div>

                    <div class="it-signup-input-wrap">
                      <div class="it-signup-input mb-20">
						<label style="font-weight:bold">Select Academy</label>
							<div class="group">
								@foreach($course_list as $key => $val)
									<div class="checkbox-item">
										<input type="checkbox" name="course_id[]" value="{{ $val->id }}" id="one{{$key+1}}" @if($key+1==1) checked @endif>
										<label for="one{{$key+1}}">{{ $val->courseTitle }}</label>
									</div>
								@endforeach
							</div>
                      </div>
					  <div class="it-signup-input mb-20">
                        <input type="text" value="{{ old('first_name') }}" required name="first_name" placeholder="First Name*" />
                      </div>
					  <div class="it-signup-input mb-20">
                        <input type="text" value="{{ old('last_name') }}" required name="last_name" placeholder="Last Name*" />
                      </div>
					  <div class="it-signup-input mb-20">
                        <input type="text" value="{{ old('institute_name') }}" required  name="institute_name" placeholder="Institute Name*" />
                      </div>


						<div class="it-student-regiform-item">
							<div class=" mb-20">
								<select class="form-control" style="border-radius: 5px;color: #0E2A46;font-size: 16px;font-style: normal;font-weight: 400;text-transform: capitalize;"  required id="fstate" name="state">
									<option selected disabled>Select State*</option>
									@foreach($state_list as $val)
										<option @if(old("state")==$val->id) selected @endif value="{{ $val->id }}">{{ $val->name }}</option>
									@endforeach
								</select>
							</div>
						</div>

						<div class="it-signup-input mb-20">
							<div class="">
								<select class="form-control" style="border-radius: 5px;color: #0E2A46;font-size: 16px;font-style: normal;font-weight: 400;text-transform: capitalize;"  required id="fcity" name="city">
									<option selected disabled>Select City*</option>

								</select>
							</div>
						</div>



					  <div class="it-signup-input mb-20">
                        <input type="tel" value="{{ old('pincode') }}" required name="pincode" placeholder="Pin Code*" />
                      </div>
					  <div class="it-signup-input mb-20">
                        <input type="email" value="{{ old('email') }}" required name="email" placeholder="Email Address*" />
                      </div>
					  <div class="it-signup-input mb-20">
                        <input type="tel" value="{{ old('mobile') }}" required name="mobile" placeholder="Mobile No.*" />
                      </div>
					  <div class="it-signup-input mb-20">
						<label style="font-weight:bold">Select Center Photo</label>
                        <input onchange="loadFile(event)" required type="file" value="{{ old('center_photo') }}" accept="image/*" name="center_photo" placeholder="Center Photo*" />
						<img style="width:auto;height:80px;padding-top:5px;padding-bottom:2px;" class="img-fluid" id="picone"/>
							<script>
							  var loadFile = function(event) {
								var input = document.getElementById('picone');
								picone.src = URL.createObjectURL(event.target.files[0]);
							  };
							</script>
                      </div>
					  <div class="it-signup-input mb-20">
						<label style="font-weight:bold">Select Director Photo</label>
                        <input onchange="loadFile1(event)" required type="file" value="{{ old('director_photo') }}" accept="image/*" name="director_photo" placeholder="Director Photo*" />
						<img style="width:auto;height:80px;padding-top:5px;padding-bottom:2px;" class="img-fluid" id="picone1"/>
							<script>
							  var loadFile1 = function(event) {
								var input1 = document.getElementById('picone1');
								picone1.src = URL.createObjectURL(event.target.files[0]);
							  };
							</script>
                      </div>
					  <div class="it-signup-input mb-20">
						<label style="font-weight:bold">Select Aadhar Card (Pdf Format)</label>
                        <input type="file" required value="{{ old('aadhar_card') }}" accept="application/pdf" name="aadhar_card" placeholder="Aadhar Card*" />

                      </div>
					  <div class="it-signup-input mb-20">
                        <input type="text" required value="{{ old('director_higher_qualifications') }}" name="director_higher_qualifications" placeholder="Director Higher Qualifications*" />
                      </div>
					  <div class="it-signup-input mb-20">
                        <input type="password" name="password" placeholder="Password" />
                      </div>
                    </div>

                    <div class="it-signup-btn mb-40">
                      <button type="submit" class="it-btn large">Sign Up</button>
                    </div>
                    <div class="it-signup-text">
                      <span>Have an account?<a href="{{ url('franchise-login') }}">Login</a></span>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

    </main>
	  @endif
 <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<!-- jQuery CDN -->

	<script>
	/*

	console.log(typeof jQuery);
	jQuery(document).ready(function($) {
    $('#state').on('change', function() {
        var state = this.value;
        $("#city").html('');
        $.ajax({
            url: "{{ url('get-cities-by-state') }}",
            type: "POST",
            data: {
                state: state,
                _token: '{{ csrf_token() }}'
            },
            dataType: 'json',
            success: function(result) {
                $('#city').html('<option value="">Select City</option>');
                $.each(result.cities, function(key, value) {
                    $("#city").append('<option value="' + value.id +
                        '">' + value.name + '</option>');
                });
            }
        });
    });
});
*/
	/*$(document).ready(function() {
        $('#state').on('change', function() {
            var state = this.value;
            $("#city").html('');
            $.ajax({
                url: "{{ url('get-cities-by-state') }}",
                type: "POST",
                data: {
                    state: state,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(result) {
                    $('#city').html('<option value="">Select City</option>');
                    $.each(result.cities, function(key, value) {
                        $("#city").append('<option value="' + value.id +
                            '">' + value.name + '</option>');
                    });
                }
            });
        });
    });
	*/

	/*
	var checkboxes = $(".group input[type='checkbox']");

$(checkboxes).click(function() {
  var checkedcheckboxcount = $(".group input[type='checkbox']:checked").size();
  if (checkedcheckboxcount < 1) {
    $(this).prop('checked', true);
  }
});
*/

	</script>
	 <!-- jQuery -->


  <!-- Bootstrap JS -->

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
 <!-- Bootstrap Select JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js"></script>
@endsection
