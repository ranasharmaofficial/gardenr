@extends('admin.include.master')
@section('title', 'View Student Certificate')
@section('content')

<!-- Page Header -->
            <div style="background:linear-gradient(45deg, #f33057, rgb( 56, 88, 249 ) );"  class="d-sm-flex d-block align-items-center justify-content-between page-header-breadcrumb">
                <div>
                    <h4 class="fw-medium mb-2">Student</h4>
                    <div class="ms-sm-1 ms-0">
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Student</a></li>
                                <li class="breadcrumb-item active fw-normal" aria-current="page">View Student Certificate</li>
                            </ol>
                        </nav>
                    </div>
                </div>

            </div>
            <!-- Page Header Close -->


            <!--APP-CONTENT START-->
            <div class="main-content app-content">
                <div class="container-fluid">

                <div class="row">

                    <div class="col-xl-12">
                        <div class="card custom-card">
                            <div class="card-header">
                                <div class="card-title">
                                    View Student Certificate
                                </div>
								{{--<a style="right: 5px;position: absolute;float: right;" href="{{ url('admin/approved-student') }}" class="btn btn-danger-light btn-wave btn-sm float-right">Student List</a>--}}
                            </div>
							<div class="card-body row">
								<form method="get" action="" class="row">
									@csrf
									<div class="col-sm-6 mb-2">
										<label for="course_id" class="col-form-label">Select Course<star>*</star></label>
										<select class="form-control" type="text" id="course_id" name="course_id" required >
											<option value="">Select Course</option>
											@foreach(\App\Models\Course::where('status', 1)->get() as $row)
												<option @if($request->course_id==$row->id) selected @endif value="{{ $row->id }}">{{ $row->courseTitle }}</option>
											@endforeach
										</select>
										<small class="text-danger form-text">@error('course_id') {{$message}} @enderror</small>
									</div>
										@php
											$get_subcourse = \App\Models\SubCourse::where('course_id', $request->course_id)->where('status', 1)->get()
										@endphp
									<div class="col-sm-6 mb-2">
										<label for="subcourse_id" class="col-form-label">Select Sub Course<star>*</star></label>
										<select class="form-control" type="text" id="subcourse_id" name="subcourse_id" required >
											@if($get_subcourse)
												@foreach($get_subcourse as $row)
													<option @if($row->id==$request->subcourse_id) selected @endif  value="{{ $row->id }}">{{ $row->title }}</option>
												@endforeach
											@else
												<option value="">Select Course First</option>
											@endif
										</select>
										<small class="text-danger form-text">@error('subcourse_id') {{$message}} @enderror</small>
									</div>

									<div class="col-md-6 mb-2">
										<label class="font-weight-bold"><b>Session</b></label>
										<select required type="text" placeholder="Enter Result" class="form-control" name="session">
											@foreach($session_list as $session)
												<option @if($request->session==$session->id) selected @endif value="{{ $session->id }}">{{ $session->from_session }} - {{ $session->to_session }}</option>
											@endforeach
										</select>
									</div>

									<div class="col-md-6 mb-2">
										<label class="font-weight-bold"><b>Semester</b></label>
										<select required  type="text" placeholder="" class="form-control" name="semester">
											@foreach(master_semester_list() as $row)
												<option @if($request->semester==$row->id) selected @endif value="{{ $row->id }}">{{ $row->semester }}</option>
											@endforeach
										</select>
									</div>
									<div class="col-md-4 mb-2">
										<button type="submit" class="btn btn-primary mt-3" name="submit">View</button>
									</div>
								</form>
                            </div>
                        </div>
                    </div>


					<div class="col-md-12">
						<div class="card">
							<div class="card-body">
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
											@if($get_results)
												@foreach($get_results as $value)
													<tr>
														<td>{{ $value->session }}</td>
														<td>{{ $value->semester }}</td>
														<td>{{ $value->english_name }}</td>
														<td>{{ $value->result }}</td>
														<td>{{ $value->passing_year }}</td>
														<td>{{ $value->total_marks_obtained }}</td>
														<td>{{ $value->total_percentage }}</td>
														<td>
															{{--<a href="{{ url('admin/view-student-result/'.$value->id) }}" class="btn btn-primary btn-sm" target="_blank">View Result</a>--}}
															@if($value->subcourse_id==13)
                                                                <a href="{{ url('admin/certficate/download_typing_certificate/'.$value->id) }}" class="btn btn-info btn-sm">Download Typing Certificate</a>
                                                            @else
                                                                <a href="{{ url('admin/certficate/download_certificate/'.$value->id) }}" class="btn btn-info btn-sm">Download Certificate</a>
                                                            @endif
														</td>
													</tr>
												@endforeach
											@else
												<tr>
													<td>Not Found</td>
												</tr>
											@endif

										</tbody>
									</table>
								</div>

							</div>
						</div>
					</div>
                </div>
                <!-- End:: row-2 -->



                </div>
            </div>
            <!--APP-CONTENT CLOSE-->





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

