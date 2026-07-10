@extends('admin.include.master')
@section('title', 'Add Student')
@section('content')

<!-- Page Header -->
            <div style="background:linear-gradient(45deg, #f33057, rgb( 56, 88, 249 ) );"  class="d-sm-flex d-block align-items-center justify-content-between page-header-breadcrumb">
                <div>
                    <h4 class="fw-medium mb-2">Student</h4>
                    <div class="ms-sm-1 ms-0">
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Student</a></li>
                                <li class="breadcrumb-item active fw-normal" aria-current="page">Edit Student</li>
                            </ol>
                        </nav>
                    </div>
                </div>

            </div>
            <!-- Page Header Close -->



            <!--APP-CONTENT START-->
            <div class="main-content app-content">
                <div class="container-fluid">


                    <!-- Start:: row-1 -->
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card custom-card">
                                <div class="card-header">
                                    <div class="card-title">
                                        Edit Student Details
                                    </div>
                                </div>
								<form class="card-body" method="post" action="{{ route('admin.updateStudentDetails') }}" enctype="multipart/form-data">
									@csrf
									<div class="row formtype">

										<div class="col-md-12">
											@if ($errors->any())
												<div class="alert alert-danger">
													<ul>
														@foreach ($errors->all() as $error)
															<li>{{ $error }}</li>
														@endforeach
													</ul>
												</div>
											@endif
										</div>

										<div class="col-sm-6">
                                            <label for="course_id" class="col-form-label">Select Course<star>*</star></label>
                                            <select class="form-control" type="text" name="course_id" id="course_id" data-live-search="true" title="Choose one..." required >
                                                <option value="">Select Course</option>
                                                @foreach(\App\Models\Course::where('status', 1)->get() as $row)
                                                    <option @if($row->id==$student->course_id) selected @endif value="{{ $row->id }}">{{ $row->courseTitle }}</option>
                                                @endforeach
                                            </select>
                                            <small class="text-danger form-text">@error('course_id') {{$message}} @enderror</small>
                                        </div>
										@php
											$get_subcourse = \App\Models\SubCourse::where('course_id', $student->course_id)->where('status', 1)->get()
										@endphp
										<div class="col-sm-6">
                                            <label for="subcourse_id" class="col-form-label">Select Sub Course<star>*</star></label>
                                            <select class="form-control" type="text" id="subcourse_id" name="subcourse_id" required >
                                                <option value="">Select Course</option>
                                                @foreach($get_subcourse as $row)
                                                    <option @if($row->id==$student->subcourse_id) selected @endif  value="{{ $row->id }}">{{ $row->title }}</option>
                                                @endforeach
                                            </select>
                                            <small class="text-danger form-text">@error('subcourse_id') {{$message}} @enderror</small>
                                        </div>
										<div class="col-sm-4">
                                            <label for="title" class="col-form-label">Enrollment Number <star>*</star></label>
                                            <input class="form-control" style="background:#ccc;" type="text"  readonly value="{{ $student->enrollment_number }}">
                                        </div>
										<div class="col-sm-4">
                                            <label for="title" class="col-form-label">Roll Number <star>*</star></label>
                                            <input class="form-control" style="background:#ccc;" type="text"  readonly value="{{ $student->roll_number }}">
                                        </div>
										<div class="col-sm-4">
                                            <label for="title" class="col-form-label">Serial Number <star>*</star></label>
                                            <input class="form-control" style="background:#ccc;" type="text"  readonly value="{{ $student->serial_number }}">
                                        </div>
										<div class="col-sm-4">
                                            <label for="title" class="col-form-label">Student Name <star>*</star></label>
                                            <input class="form-control" type="text" name="english_name" required placeholder="Name in English" id="english_name" value="{{ $student->english_name }}">
                                            <small class="text-danger form-text">@error('english_name') {{$message}} @enderror</small>
                                        </div>
                                        {{-- <div class="col-sm-4"> --}}
                                            {{-- <label for="title" class="col-form-label">Name in Hindi <star>*</star></label> --}}
                                            <input hidden class="form-control" type="text" name="hindi_name" placeholder="Name in Hindi" id="hindi_name" value="{{ $student->hindi_name }}">
                                            {{-- <small class="text-danger form-text">@error('hindi_name') {{$message}} @enderror</small> --}}
                                        {{-- </div> --}}
										<div class="col-sm-4">
                                            <label for="title" class="col-form-label">Father's Name <star>*</star></label>
                                            <input class="form-control" type="text" name="fathers_name" required placeholder="Father's Name" id="fathers_name" value="{{ $student->fathers_name }}">
                                            <small class="text-danger form-text">@error('fathers_name') {{$message}} @enderror</small>
                                        </div>
										<div class="col-sm-4">
                                            <label for="title" class="col-form-label">Mother's Name <star>*</star></label>
                                            <input class="form-control" type="text" name="mothers_name" required placeholder="Mother's Name" id="mothers_name" value="{{ $student->mothers_name }}">
                                            <small class="text-danger form-text">@error('mothers_name') {{$message}} @enderror</small>
                                        </div>
										<div class="col-sm-4">
                                            <label for="title" class="col-form-label">Date of Birth <star>*</star></label>
                                            <input class="form-control" type="date" name="dob" required placeholder="" id="dob" value="{{ $student->dob }}">
                                            <small class="text-danger form-text">@error('dob') {{$message}} @enderror</small>
                                        </div>
										<div class="col-sm-4">
                                            <label for="title" class="col-form-label">Gender <star>*</star></label>
												<select class="form-control" type="text" name="gender" required >
													<option value="">Select Gender</option>
													<option @if($student->gender=='Male') selected @endif value="Male">Male</option>
                                                    <option @if($student->gender=='Female') selected @endif value="Female">Female</option>

												</select>
                                            <small class="text-danger form-text">@error('gender') {{$message}} @enderror</small>
                                        </div>
										<div class="col-sm-4">
                                            <label for="title" class="col-form-label">Marital Status <star>*</star></label>
												<select class="form-control" type="text" name="marital_status" required >
													<option value="">Select Marital Status</option>
													<option @if($student->marital_status=='Single') selected @endif value="Single">Single</option>
                                                    <option @if($student->marital_status=='Married') selected @endif value="Married">Married</option>

												</select>
                                            <small class="text-danger form-text">@error('marital_status') {{$message}} @enderror</small>
                                        </div>

										<div class="col-sm-4">
                                            <label for="title" class="col-form-label">Nationality <star>*</star></label>
                                            <input class="form-control" type="text" name="nationality" required placeholder="Nationality" id="nationality" value="{{ $student->nationality }}">
                                            <small class="text-danger form-text">@error('nationality') {{$message}} @enderror</small>
                                        </div>
										<div class="col-sm-4">
                                            <label for="title" class="col-form-label">Category <star>*</star></label>
                                            <input class="form-control" type="text" name="category" required placeholder="Category" id="category" value="{{ $student->category }}">
                                            <small class="text-danger form-text">@error('category') {{$message}} @enderror</small>
                                        </div>
										<div class="col-sm-4">
                                            <label for="title" class="col-form-label">Whether Handicapped <star>*</star></label>
                                            <input class="form-control" type="text" name="whether_handicapped" placeholder="Whether Handicapped" id="whether_handicapped" value="{{ $student->whether_handicapped }}">
                                            <small class="text-danger form-text">@error('whether_handicapped') {{$message}} @enderror</small>
                                        </div>
										<div class="col-sm-4">
                                            <label for="title" class="col-form-label">Aadhar Number <star>*</star></label>
                                            <input class="form-control" type="tel" name="aadhar_no" required placeholder="Aadhar Number" id="aadhar_no" value="{{ $student->aadhar_no }}">
                                            <small class="text-danger form-text">@error('aadhar_no') {{$message}} @enderror</small>
                                        </div>
										<div class="col-sm-4">
                                            <label for="title" class="col-form-label">Pan Number <star>*</star></label>
                                            <input class="form-control" type="text" name="pan_no" placeholder="Pan Number" id="pan_no" value="{{ $student->pan_no }}">
                                            <small class="text-danger form-text">@error('pan_no') {{$message}} @enderror</small>
                                        </div>
										<div class="col-sm-4">
                                            <label for="title" class="col-form-label">Blood Group <star>*</star></label>
                                            <input class="form-control" type="text" name="blood_group" placeholder="Blood Group" id="blood_group" value="{{ $student->blood_group }}">
                                            <small class="text-danger form-text">@error('blood_group') {{$message}} @enderror</small>
                                        </div>
										<div class="col-sm-4">
                                            <label for="title" class="col-form-label">Email <star>*</star></label>
                                            <input class="form-control" type="email" name="email" placeholder="Email" id="email" value="{{ $student->email }}">
                                            <small class="text-danger form-text">@error('email') {{$message}} @enderror</small>
                                        </div>
										<div class="col-sm-4">
                                            <label for="title" class="col-form-label">Mobile No. <star>*</star></label>
                                            <input class="form-control" type="tel" name="mobile" required placeholder="Mobile No." id="mobile" value="{{ $student->mobile }}">
                                            <small class="text-danger form-text">@error('mobile') {{$message}} @enderror</small>
                                        </div>

										<div class="col-sm-12">
                                            <h2 for="title" class="col-form-label text-primary">Details of Qualification <star>*</star></h2>

											<div class="table-responsive">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Examinations</th>
                                                            <th style="width: 150px;">Faculty/Subject</th>
                                                            <th style="width: 131px;">Year&nbsp;Of&nbsp;Passing</th>
                                                            <th>Organization/Institute</th>
                                                            <th>Board/University</th>
                                                            <th>Marks&nbsp;Obtained</th>
                                                            <th>Percentage</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <th>Matric</th>
                                                            <td><input type="text" class="form-control" value="{{ $student->matric_subject }}" name="matric_subject"  id="matric_subject" placeholder="Ex .matriculation" ></td>
                                                            <td><input type="text" class="form-control" value="{{  $student->matric_year }}" name="matric_year" id="matric_year" maxlength="4" placeholder="2019" onkeypress="return numberonly(event);" required></td>
                                                            <td><input type="text" class="form-control" value="{{  $student->matric_org }}" name="matric_org" maxlength="36" id="matric_org" onKeyPress="return onlyAlphabets(event,this)" placeholder="abc school" required></td>
                                                            <td><input type="text" class="form-control" value="{{  $student->matric_board }}" name="matric_board" maxlength="13" id="matric_board" onKeyPress="return onlyAlphabets(event,this)" placeholder="bseb"  required></td>
                                                            <td><input type="text" class="form-control" value="{{  $student->matric_score }}" name="matric_score" id="matric_score" onkeypress="return numberonly(event);" maxlength="3" placeholder="400"  required></td>
                                                            <td><input type="text" class="form-control" value="{{  $student->matric_percent }}" name="matric_percent" id="matric_percent" placeholder="75.5" required></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Intermediate</th>
                                                            <td><input type="text" class="form-control" name="inter_subject" value="{{ $student->inter_subject }}" id="inter_subject" maxlength="13" onKeyPress="return onlyAlphabets(event,this)" placeholder="Pcb,Pcm,arts,commerce"></td>
                                                            <td><input type="text" class="form-control" value="{{  $student->inter_passing_year }}" placeholder="2019" name="inter_passing_year" id="inter_passing_year" maxlength="4" onkeypress="return numberonly(event);" ></td>
                                                            <td><input type="text" class="form-control" value="{{  $student->inter_org }}" name="inter_org" placeholder="abc" maxlength="36" id="inter_org" onKeyPress="return onlyAlphabets(event,this)" ></td>
                                                            <td><input type="text" class="form-control" value="{{  $student->inter_board }}" name="inter_board" placeholder="bseb" maxlength="13" id="inter_board" onKeyPress="return onlyAlphabets(event,this)" ></td>
                                                            <td><input type="text" class="form-control" value="{{  $student->inter_score }}" name="inter_score" placeholder="300" id="inter_score" onkeypress="return numberonly(event);" maxlength="3" ></td>
                                                            <td><input type="text" class="form-control" value="{{  $student->inter_percent }}" name="inter_percent" id="inter_percent" value="" ></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Graduation</th>
                                                            <td><input type="text" class="form-control" value="{{  $student->grad_subject }}" name="grad_subject" id="grad_subject" onKeyPress="return onlyAlphabets(event,this)" maxlength="15" placeholder="math,bio,chem,geo..." ></td>
                                                            <td><input type="text" class="form-control" value="{{  $student->grad_year }}" name="grad_year" id="grad_year" placeholder="2019" onkeypress="return numberonly(event);" maxlength="4" ></td>
                                                            <td><input type="text" class="form-control" value="{{  $student->grad_org }}" name="grad_org" maxlength="36" id="grad_org" onKeyPress="return onlyAlphabets(event,this)" ></td>
                                                            <td><input type="text" class="form-control" value="{{  $student->grad_board }}" name="grad_board" placeholder="MU,PU" id="grad_board" maxlength="13" onKeyPress="return onlyAlphabets(event,this)" ></td>
                                                            <td><input type="text" class="form-control" value="{{  $student->grad_score }}" name="grad_score" id="grad_score" onkeypress="return numberonly(event);" maxlength="4"  ></td>
                                                            <td><input type="text" class="form-control" value="{{  $student->grad_percent }}" name="grad_percent" id="grad_percent" value="" ></td>
                                                        </tr>
                                                        <tr>
                                                            <th>PG/Others</th>
                                                            <td><input type="text" class="form-control" value="{{  $student->other_subject }}" name="other_subject" id="other_subject" maxlength="13" onKeyPress="return onlyAlphabets(event,this)" value=""></td>
                                                            <td><input type="text" class="form-control" value="{{  $student->other_year }}" name="other_year" id="other_year" maxlength="4" placeholder="2019" onkeypress="return numberonly(event);" value=""></td>
                                                            <td><input type="text" class="form-control" value="{{  $student->other_org }}" name="other_org" maxlength="36" id="other_org" onKeyPress="return onlyAlphabets(event,this)" value=""></td>
                                                            <td><input type="text" class="form-control" value="{{  $student->other_board }}" name="other_board" id="other_board" maxlength="13" onKeyPress="return onlyAlphabets(event,this)" value=""></td>
                                                            <td><input type="text" class="form-control" value="{{  $student->other_score }}" name="other_score" id="other_score" maxlength="4" onkeypress="return numberonly(event);" value=""></td>
                                                            <td><input type="text" class="form-control" value="{{  $student->other_percent }}" name="other_percent" id="other_percent" value=""></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>

										<div class="col-sm-6">
                                            <label for="title" class="col-form-label">Father's/Husband's Occupation. <star>*</star></label>
                                            <input class="form-control" type="text" placeholder="Father's/Husband's Occupation" name="father_husband_occupation" required id="father_husband_occupation" value="{{ $student->father_husband_occupation }}">
                                            <small class="text-danger form-text">@error('father_husband_occupation') {{$message}} @enderror</small>
                                        </div>

										<div class="col-sm-6">
                                            <label for="title" class="col-form-label">Name & Address of Local Guardian. <star>*</star></label>
                                            <input class="form-control" placeholder="Name & Address of Local Guardian" type="text" name="name_address_guardian" required id="name_address_guardian" value="{{ $student->name_address_guardian }}">
                                            <small class="text-danger form-text">@error('name_address_guardian') {{$message}} @enderror</small>
                                        </div>


                                        <div class="col-sm-6">
                                            <label class="col-form-label">Picture <star>*</star></label>
                                            <input onchange="loadFile(event)" type="file" name="image" class="form-control">
                                            <small class="text-danger form-text">@error('image') {{$message}} @enderror</small>
											<img src="{{ static_asset('uploads/tender/'.$student->image) }}" style="width:auto;height:100px;padding-top:5px;padding-bottom:2px;" class="img-fluid" id="picone"/>
											<script>
											  var loadFile = function(event) {
												var input = document.getElementById('picone');
												picone.src = URL.createObjectURL(event.target.files[0]);
											  };
											</script>
                                        </div>
                                        <input type="hidden" name="student_id" value="{{ $student->id }}">
									</div>
									<button type="submit" class="btn btn-success buttonedit1 mt-3">Update Student Details</button>
								</form>
                            </div>
                        </div>

                    </div>
                    <!-- End:: row-1 -->



                </div>
            </div>
            <!--APP-CONTENT CLOSE-->

 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <script>
 $(document).ready(function() {
            $('#course_id').on('change', function() {
                var course = this.value;
                $("#subcourse_id").html('');
                $.ajax({
                    url: "{{ url('get-subcourse') }}",
                    type: "POST",
                    data: {
                        course: course,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(result) {
                        $('#subcourse_id').html('<option value="">Select Sub Course</option>');
                        $.each(result.subcourse, function(key, value) {
                            $("#subcourse_id").append('<option value="' + value.id +
                                '">' + value.title + '</option>');
                        });
                    }
                });
            });
        });
 </script>

@endsection


@section('script')
    <script>
        // tinymce.init({
        //     selector: 'textarea#description',
        // });
        $(document).ready(function () {
            /** Get Sub category list on change on parent category */
            $('#category_id').on('change', function () {
                var idCategory = this.value;
                $("#sub_category_id").html('');

                $.ajax({
                    url: "{{url('admin/blogs/fetch_subcategory')}}",
                    type: "POST",
                    data: {
                        category_id: idCategory,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',

                    success: function (result) {
                        $('#sub_category_id').html('<option value="">Choose Sub Catyegory</option>');

                        $.each(result.sub_categories, function (key, value) {
                            $("#sub_category_id").append('<option value="' + value
                                .id + '">' + value.title + '</option>');
                        });
                    }
                });
            });
        });
    </script>
@endsection

