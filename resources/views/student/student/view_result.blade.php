@extends('student.include.master')
@section('title', 'Student Result')
@section('content')




<!-- Page Header -->
            <div style="background:linear-gradient(45deg, #f33057, rgb( 56, 88, 249 ) );"  class="d-sm-flex d-block align-items-center justify-content-between page-header-breadcrumb">
                <div>
                    <h4 class="fw-medium mb-2">Student</h4>
                    <div class="ms-sm-1 ms-0">
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Student</a></li>
                                <li class="breadcrumb-item active fw-normal" aria-current="page">Student Result</li>
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
                            <div class="card-header">
                                <div class="card-title">
                                    Download Result
                                </div>
								<a style="right: 5px;position: absolute;float: right;" href="{{ url('student/view-result') }}" class="btn btn-danger-light btn-wave btn-sm float-right">Refresh</a>
                            </div>
                            <div class="card-body">


								<form method="get" action="" class="row">
										@csrf
											<div class="col-sm-6">
												<label for="semester" class="col-form-label">Select Session<star>*</star></label>
												<select class="form-control" type="text" id="session" name="session" required >
													<option value="">Select Session</option>
													@foreach(master_session_list() as $val)
														<option @if($request->session==$val->id) selected @endif value="{{ $val->id }}">{{ $val->from_session.' - '.$val->to_session }}</option>
													@endforeach
												</select>
												<small class="text-danger form-text">@error('semester') {{$message}} @enderror</small>
											</div>

											<div class="col-sm-6">
												<label for="semester" class="col-form-label">Select Semester<star>*</star></label>
												<select class="form-control" type="text" id="semester" name="semester" required >
													<option value="">Select Semester</option>
													@foreach(master_semester_list() as $val)
														<option @if($request->semester==$val->id) selected @endif value="{{ $val->id }}">{{ $val->semester }}</option>
													@endforeach
												</select>
												<small class="text-danger form-text">@error('semester') {{$message}} @enderror</small>
											</div>
											@php
												$state = \App\Models\State::where('id', $student_list->state)->first();
												$courseName = \App\Models\Course::where('id', $student_list->course_id)->first();
												$SubCourseName = \App\Models\SubCourse::where('id', $student_list->subcourse_id)->first();
											@endphp
											<div class="col-sm-6">
												<label for="course_id" class="col-form-label">Select Course<star>*</star></label>
												<select class="form-control" type="text" id="course_id" name="course_id" required >
													<option selected value="{{ $courseName->id }}">{{ $courseName->courseTitle }}</option>
												</select>
											</div>

											<div class="col-sm-6">
												<label for="subcourse_id" class="col-form-label">Select Sub Course<star>*</star></label>
												<select class="form-control" type="text" id="subcourse_id" name="subcourse_id" required >


													<option value="{{ $SubCourseName->id }}">{{ $SubCourseName->title }}</option>

												</select>
											</div>
											<input type="hidden" name="student_id" value="{{ $student_list->id }}">
											<div class="col-sm-6 mt-3 mb-3">
												<button type="submit" name="submit" class="btn btn-primary">Download</button>
											</div>
								</form>
								@php
									//dd($check_result);
								@endphp
							@if(isset($check_result) && $check_result->isNotEmpty())
								<div class="row">
									<div class="col-sm-12">
										<div class="table-responsive">
											<table class="table table-bordered" id="marks-table">
												<thead style="background-color:red;" class="bg-secondary">
													<tr style="background-color:red;">
														<th>Session</th>
														<th>Semester</th>
														<th>Student</th>
														<th>Result</th>
														<th>Passing Year</th>
														<th>Marks Obtained</th>
														<th>Percentage</th>
														<th>View</th>
													</tr>
												</thead>
												<tbody>
													<!-- Dynamic rows will be added here -->

														@foreach($check_result as $value)
															<tr>
																<td>{{ $value->session }}</td>
																<td>{{ $value->semester }}</td>
																<td>{{ $value->english_name }}</td>
																<td>{{ $value->result }}</td>
																<td>{{ $value->passing_year }}</td>
																<td>{{ $value->total_marks_obtained }}</td>
																<td>{{ $value->total_percentage }}</td>
																<td>
                                                                    @if($value->subcourse_id==13)
                                                                        <a href="{{ url('student/stresult/typing_certificate_download/'.$value->id) }}" class="btn btn-info btn-sm">Download Typing Certificate</a>
                                                                    @else
																	<a href="{{ url('student/stresult/certificate_download/'.$value->id) }}" class="btn btn-primary btn-sm">Download Certificate</a>
																	<a href="{{ url('student/stresult/result_download/'.$value->id) }}" class="btn btn-info btn-sm">Download Result</a>
                                                                    @endif
																</td>
															</tr>
														@endforeach


												</tbody>
											</table>
										</div>
									</div>
								</div>
							@elseif(isset($check_result))
								<!-- Show "Result not Found" only if $check_result exists but is empty -->
								<div class="row">
									<div class="col-sm-12">
										<h4 class="text-center text-danger">Result not Found</h4>
									</div>
								</div>
							@endif


                            </div>
                        </div>
                    </div>
                </div>
                <!-- End:: row-2 -->



                </div>
            </div>


@endsection

