@extends('frontend.layouts.master')
@section('title') Verification @endsection
@section('content')
<style>
.student-card {
  max-width: 450px;
  margin: 0 auto;
  border-radius: 1rem;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
}

.student-title {
  background-color: #2c74f7; /* change this to match your theme */
}

.student-field {
  background: #ffffff;
  padding: 0.75rem 1rem;
  border-radius: 0.75rem;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
  margin-bottom: 1rem;
}

.field-label {
  font-size: 0.85rem;
  color: #6c757d;
  display: block;
  margin-bottom: 0.25rem;
}

.field-value {
  font-size: 1rem;
  color: #212529;
}

@media (max-width: 576px) {
  .student-card {
    padding: 1rem;
  }
  .field-value {
    font-size: 0.95rem;
  }
  .field-label {
    font-size: 0.8rem;
  }
}

</style>
<!-- Start of Header section
  ============================================= -->
<section id="ed-breadcrumb" class="ed-breadcrumb-sec" data-background="{{ static_asset('assets/assets_web/images/header-about5.jpg') }}">
		<div class="container">
			<div class="ed-breadcrumb-content">
				<div class="ed-breadcrumb-text text-center headline ul-li">
					<h2 class="bread_title">Verification</h2>
					<ul>
						<li><a href="{{ url('') }}">Home</a></li>
						<li>Verification </li>
					</ul>
				</div>
			</div>
		</div>
	</section>

<!-- Start of Feature section
  ============================================= -->

<!-- Start of Contact Form section
	============================================= -->
	<section id="ed-cp-form" class="py-4">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-sm-10 col-md-8 col-lg-6">
        <div class="student-card shadow-sm rounded-4 p-4 bg-white">
          <div class="text-center mb-4">
            <h5 class="student-title fw-bold text-white py-2 px-3 rounded-3">
              Student Details
            </h5>
          </div>

          <div class="student-field mb-3">
            <label class="field-label">Enrollment Number</label>
            <div class="field-value fw-bold">{{ $student->enrollment_number }}</div>
          </div>

          <div class="student-field mb-3">
            <label class="field-label">Student Name</label>
            <div class="field-value fw-bold">{{ $student->english_name }}</div>
          </div>

          <div class="student-field mb-3">
            <label class="field-label">Father's Name</label>
            <div class="field-value fw-bold">{{ $student->fathers_name }}</div>
          </div>

          <div class="student-field mb-3">
            <label class="field-label">Course</label>
            <div class="field-value fw-bold">{{ $student->course_name }}</div>
          </div>

          <div class="student-field">
            <label class="field-label">Sub Course</label>
            <div class="field-value fw-bold">{{ $student->subcourse_name }}</div>
          </div>

        </div>
      </div>
    </div>
  </div>
</section>




@if(false)
<main>
    <div class="it-breadcrumb-area fix it-breadcrumb-bg p-relative" data-background="{{static_asset('assets/assets_web/images/breadcrumb.jpg')}}">
        <div class="container">
            <div class="row ">
                <div class="col-md-12">
                    <div class="it-breadcrumb-content z-index-3 text-center">
                        <div class="it-breadcrumb-title-box">
                            <h3 class="it-breadcrumb-title">Marksheet Verification</h3>
                        </div>
                        <div class="it-breadcrumb-list-wrap">
                            <div class="it-breadcrumb-list">
                                <span><a href="{{url('/')}}">home</a></span>
                                <span class="dvdr">//</span>
                                <span>Marksheet Verification</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- slider-area-end -->

    <div class="it-signup-area pt-20 pb-120">
        <div class="container">
            <div class="it-signup-bg p-relative">
                <!--<div class="it-signup-thumb d-none d-lg-block">
                    <img src="{{static_asset('assets/assets_web/images/thumb-1-1.jpg')}}" alt="">
                </div>-->
                <div class="row">
                    <div class="col-xl-6 col-lg-6">
                        <form method="get" enctype="multipart/form-data" action="">
							@csrf
                            <div class="it-signup-wrap">
                                <h4 class="it-signup-title">Marksheet Verification</h4>
                                <div class="it-signup-input-wrap">
                                    <div class="it-signup-input mb-20">
                                        <input type="text" name="enrollment_number" value="{{ $request->enrollment_number }}" placeholder="Enrollment No.">
                                    </div>
                                </div>

								<div class="it-signup-input-wrap">
                                    <div class="it-signup-input mb-20">
                                        <input type="text" name="dob" value="{{ $request->dob }}" id="dob" placeholder="Date of Birth" onfocus="(this.type='date')" onblur="if(!this.value) this.type='text'">
									</div>
                                </div>

                                <div
                                    class="it-signup-btn d-sm-flex justify-content-between align-items-center mb-40">
                                    <button type="submit" class="ed-btn-theme">
                                        Verify
                                        <i>
                                            <svg width="17" height="14" viewBox="0 0 17 14" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path d="M11 1.24023L16 7.24023L11 13.2402" stroke="currentcolor"
                                                    stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path d="M1 7.24023H16" stroke="currentcolor" stroke-width="1.5"
                                                    stroke-miterlimit="10" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                        </i>
                                    </button>

                                </div>

                            </div>
                        </form>
                    </div>
					@if($checkStudent)
					<div class="col-xl-6 col-lg-6">
						<div class="it-signup-wrap">
							<h4 class="it-signup-title">Student Details</h4>
							<div class="table-responsive">
							<table class="table table-bordered">
								<tr>
									<td><b>Enrollment Number</b></td>
									<td>{{ $checkStudent->enrollment_number}}  </td>
								</tr>
								<tr>
									<td><b>Student Name</b></td>
									<td>{{ $checkStudent->english_name }}</td>
								</tr>
								<tr>
									<td><b>Father's Name</b></td>
									<td>{{ $checkStudent->fathers_name }}</td>
								</tr>
								<tr>
									<td><b>Course</b></td>
									<td>{{ $checkStudent->course_name }}</td>
								</tr>
								<tr>
									<td><b>Sub Course</b></td>
									<td>{{ $checkStudent->subcourse_name }}</td>
								</tr>
								@if($first_semester)
									@php
										$first_grand_total = \App\Models\ManualResultSubject::where('result_id', $first_semester->id)->sum('marks_obtained');
									@endphp
									<tr>
										<td style="color:blue;"><b>First Semester</b></td>
									</tr>
									<tr>
										<td><b>Result</b></td>
										<td><b>{{ $first_semester->result }}</b></td>
									</tr>
									@if($first_grand_total)
									<tr>
										<td><b>Grand Total</b></td>
										<td><b>{{ $first_grand_total }}</b></td>
									</tr>
									@endif
								@endif

								@if($second_semester)
									@php
										$second_grand_total = \App\Models\ManualResultSubject::where('result_id', $second_semester->id)->sum('marks_obtained');
									@endphp
									<tr>
										<td style="color:blue;"><b>Second Semester</b></td>
									</tr>
									<tr>
										<td><b>Result</b></td>
										<td><b>{{ $second_semester->result }}</b></td>
									</tr>
									@if($second_grand_total)
									<tr>
										<td><b>Grand Total</b></td>
										<td><b>{{ $second_grand_total }}</b></td>
									</tr>
									@endif
								@endif

							</table>
						</div>

						</div>

                    </div>
					@endif
						@if($flag=='0' && $checkStudent)
							<div class="col-xl-6 col-lg-6">
								<div class="it-signup-wrap">
									<h4 class="it-signup-title">Student Details</h4>
									<div class="table-responsive">
										<table class="table table-bordered">
											<tr>
												<td style="color:red"><b>No data found</b></td>
												<td style="color:blue"><a href="{{ url('marksheet-verification') }}" class="">Refresh</a></td>

											</tr>


										</table>
									</div>

								</div>
							</div>
						@endif


                </div>
            </div>
        </div>
    </div>
    <!-- newsletter-area-end -->
</main>
@endif
@endsection
