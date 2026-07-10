@extends('admin.include.master')
@section('title', 'Add Admit Card')
@section('content')

<style>

table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: rgb(168, 163, 153);
        }
        .btn-container {
            margin-top: 10px;
            text-align: right;
        }
        .btn {
            background-color: green;
            color: white;
            padding: 5px 10px;
            border: none;
            cursor: pointer;
            font-size: 14px;
        }
        .btn-remove {
            background-color: red;
            color: white;
            padding: 3px 8px;
            border: none;
            cursor: pointer;
            font-size: 12px;
        }
        .total-container {
            text-align: right;
            margin-top: 10px;
            font-weight: bold;
        }
</style>
<!-- Page Header -->
            <div style="background:linear-gradient(45deg, #f33057, rgb( 56, 88, 249 ) );"  class="d-sm-flex d-block align-items-center justify-content-between page-header-breadcrumb">
                <div>
                    <h4 class="fw-medium mb-2">Admit Card</h4>
                    <div class="ms-sm-1 ms-0">
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Admit Card</a></li>
                                <li class="breadcrumb-item active fw-normal" aria-current="page">Add Admit Card</li>
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
                                        Add Admit Card
                                    </div>
									<a style="right: 5px;position: absolute;float: right;" href="{{ url('admin/admit-card-list') }}" class="btn btn-danger-light btn-wave btn-sm float-right">Subject List</a>
                                </div>

									<div class="card-body">

										<form method="get" class="row formtype">

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
												<label for="semester" class="col-form-label">Select Session<star>*</star></label>
												<select class="form-control" type="text" id="session" name="session" required >
													<option value="">Select Session</option>
													@foreach(master_session_list() as $val)
														<option @if($val->id==$request->session) selected @endif value="{{ $val->id }}">{{ $val->from_session.' - '.$val->to_session }}</option>
													@endforeach
												</select>
												<small class="text-danger form-text">@error('semester') {{$message}} @enderror</small>
											</div>

											<div class="col-sm-6">
												<label for="semester" class="col-form-label">Select Semester<star>*</star></label>
												<select class="form-control" type="text" id="semester" name="semester" required >
													<option value="">Select Semester</option>
													@foreach(master_semester_list() as $val)
														<option @if($val->id==$request->semester) selected @endif value="{{ $val->id }}">{{ $val->semester }}</option>
													@endforeach
												</select>
												<small class="text-danger form-text">@error('semester') {{$message}} @enderror</small>
											</div>

											<div class="col-sm-6">
												<label for="course_id" class="col-form-label">Select Course<star>*</star></label>
												<select class="form-control" type="text" id="course_id" name="course_id" required >
													<option value="">Select Course</option>
													@foreach(\App\Models\Course::where('status', 1)->get() as $row)
														<option @if($row->id==$request->course_id) selected @endif  value="{{ $row->id }}">{{ $row->courseTitle }}</option>
													@endforeach
												</select>
												<small class="text-danger form-text">@error('course_id') {{$message}} @enderror</small>
											</div>

											<div class="col-sm-6">
												<label for="subcourse_id" class="col-form-label">Select Sub Course<star>*</star></label>
												<select class="form-control" type="text" id="subcourse_id" name="subcourse_id" required >
													<option value="">Select Course First</option>
													@php
														if ($request->subcourse_id != null) {
															$subcourses = \App\Models\SubCourse::where('course_id', $request->course_id)->where('status', 1)->get();
															foreach ($subcourses as $value) {
																$selected = ($value->id == $request->subcourse_id) ? 'selected' : '';
																echo '<option value="' . $value->id . '" ' . $selected . '>' . $value->title . '</option>';
															}
														}
													@endphp
												</select>
												<small class="text-danger form-text">@error('subcourse_id') {{$message}} @enderror</small>
											</div>
											
											<div class="col-sm-6">
												<label for="subcourse_id" class="col-form-label">Select Exam Type<star>*</star></label>
												<select class="form-control" type="text" id="exam_type" name="exam_type" required >
													<option value="">Select Exam Type</option>
													<option @if($request->exam_type=='OFFLINE') selected @endif value="OFFLINE">OFFLINE</option>
													<option @if($request->exam_type=='ONLINE') selected @endif value="ONLINE">ONLINE</option>
													 
												</select>
												<small class="text-danger form-text">@error('subcourse_id') {{$message}} @enderror</small>
											</div>

											<div class="col-sm-12 mt-3 mb-3 text-end">
											   <button type="submit" name="view" class="btn btn-primary">View Subject</button>
											</div>

										</form>


											<form method="post" action="{{ route('admin.saveAdmitCardDetails') }}" class="row formtype">
												@csrf
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

												<div class="col-sm-12">
													<table class="table" id="marks-table">
														<thead>
															<tr>
																<th>Subject Code</th>
																<th>Subject Name</th>
																<th>Exam Date</th>
																<th>Exam Time</th>
															</tr>
														</thead>
														<tbody>
															@php
																$master_subject_list = \App\Models\Subject::where('course_id', $request->course_id)->where('sub_course_id', $request->subcourse_id)->where('semester', $request->semester)->get();

															@endphp
															@if($master_subject_list)
																@foreach($master_subject_list as $subject)
																			<tr>
																				<td><input class="form-control" type="text" required readonly value="{{ $subject->subject_code }}" placeholder="Subject Code" name="subject_code[]"></td>
																				<td><input class="form-control" type="text" required readonly value="{{ $subject->name }}" placeholder="Subject Name" name="subject_name[]"></td>
																				<th><input class="form-control" required type="date" placeholder="" name="exam_date[]"></th>
																				<th><input class="form-control" required type="text" placeholder="" name="exam_time[]"></th>
																			</tr>
																@endforeach
															@else
																<tr>
																	<td>Subject Not added, Please add subject first in the particular course and subcourse</td>
																</tr>
															@endif
														</tbody>
													</table>
													<input type="hidden" name="semester" value="{{ $request->semester}}">
													<input type="hidden" name="session" value="{{ $request->session}}">
													<input type="hidden" name="course_id" value="{{ $request->course_id}}">
													<input type="hidden" name="subcourse_id" value="{{ $request->subcourse_id}}">
													<input type="hidden" name="exam_type" value="{{ $request->exam_type}}">
													
													<div class="btn-container">
														<button class="btn" type="submit">Save Details</button>
													</div>
												</div>
											</form>
										@if($check_admit_card)
											@php
												$admit_card_subjects = \App\Models\AdmitCardSubject::where('admit_card_id', $check_admit_card->id)->get()
											@endphp
											<div class="row formtype">

												<div class="col-sm-12">
													<table class="table" id="marks-table">
														<thead>
															<tr>
																<th>Subject Code</th>
																<th>Subject Name</th>
																<th>Exam Date</th>
																<th>Exam Time</th>
															</tr>
														</thead>
														<tbody>

															@if($admit_card_subjects)
																@foreach($admit_card_subjects as $subject)
																			<tr>
																				<td>{{ $subject->subject_code }}</td>
																				<td>{{ $subject->subject_name }}</td>
																				<td>{{ date('d M, Y', strtotime($subject->exam_date)) }}</td>
																				<td>{{ $subject->exam_time }}</td>
																			</tr>
																@endforeach
															@else
																<tr>
																	<td>Subject Not added, Please add subject first in the particular course and subcourse</td>
																</tr>
															@endif
														</tbody>
													</table>

												</div>
											</div>
										@endif

									</div>
							</div>
                        </div>

                    </div>
                    <!-- End:: row-1 -->



                </div>
            </div>
            <!--APP-CONTENT CLOSE-->

 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <script>

 function addRow() {
        let table = document.getElementById("marks-table").getElementsByTagName('tbody')[0];

        let row = table.insertRow();
        row.innerHTML = `
            <td><input type="text" placeholder="Subject Code" class="form-control" name="subject_code[]"></td>
            <td><input type="text" placeholder="Subject Code" class="form-control" name="name[]"></td>
            <td><input type="number" placeholder="Full Marks" class="form-control" name="full_marks[]" class="full-marks" oninput="calculateTotal()"></td>
            <td><input type="number" placeholder="Passing Marks" class="form-control" name="pass_marks[]" class="pass-marks"></td>
            <td><button class="btn-remove" onclick="removeRow(this)">X</button></td>
        `;
    }

    function removeRow(button) {
        let row = button.parentNode.parentNode;
        row.parentNode.removeChild(row);
        calculateTotal();
    }

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
