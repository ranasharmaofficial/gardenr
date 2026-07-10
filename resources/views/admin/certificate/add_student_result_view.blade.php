@extends('admin.include.master')
@section('title', 'Add Student Result')
@section('content')
 
<!-- Page Header -->
            <div style="background:linear-gradient(45deg, #f33057, rgb( 56, 88, 249 ) );"  class="d-sm-flex d-block align-items-center justify-content-between page-header-breadcrumb">
                <div>
                    <h4 class="fw-medium mb-2">Result</h4>
                    <div class="ms-sm-1 ms-0">
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Result</a></li>
                                <li class="breadcrumb-item active fw-normal" aria-current="page">Add Student Result</li>
                            </ol>
                        </nav>
                    </div>
                </div>

            </div>
            <!-- Page Header Close -->

<form method="post" action="{{ route('admin.saveStudentResult') }}">
@csrf
            <!--APP-CONTENT START-->
            <div class="main-content app-content">
                <div class="container-fluid">

@php
									$course = \App\Models\Course::where('id', $student->course_id)->first();
									$subcourse = \App\Models\SubCourse::where('id', $student->subcourse_id)->first();
								@endphp
                   <!-- Start:: row-2 -->
                <div class="row">
										
                    <div class="col-xl-12">
                        <div class="card custom-card">
                            <div class="card-header">
                                <div class="card-title">
                                    Add Student Result
                                </div>
								<a style="right: 5px;position: absolute;float: right;" href="{{ url('admin/generate-certificate') }}" class="btn btn-danger-light btn-wave btn-sm float-right">Student List</a>
                            </div>
                            <div class="card-body row">
							 
							<div class="col-md-12 mb-2">
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
							@php
								$courseName = \App\Models\Course::where('id', $student->course_id)->pluck('courseTitle')->first();
								$SubCourseName = \App\Models\SubCourse::where('id', $student->subcourse_id)->pluck('title')->first();
							@endphp
							<div class="col-md-6 mb-2">		
								<label class="font-weight-bold"><b>Course:</b></label>
								<input type="text" class="form-control" value="{{ $courseName}}" disabled readonly id="student-name">
							</div>
							<div class="col-md-6 mb-2">		
								<label class="font-weight-bold"><b>Sub Course:</b></label>
								<input type="text" class="form-control" value="{{ $SubCourseName}}" disabled readonly id="student-name">
							</div>
							<div class="col-md-6 mb-2">		
								<label class="font-weight-bold"><b>Name of Student</b></label>
								<input type="text" class="form-control" value="{{ $student->english_name}}" disabled readonly id="student-name">
							</div>
							<div class="col-md-6 mb-2">		
								<label class="font-weight-bold"><b>Father's Name</b></label>
								<input type="text" class="form-control" value="{{ $student->fathers_name}}" disabled readonly id="student-name">
							</div>
							<div class="col-md-6 mb-2">		
								<label class="font-weight-bold"><b>DOB</b></label>
								<input type="text" class="form-control" value="{{ date('d M, Y', strtotime($student->dob)) }}" disabled readonly id="student-name">
							</div>
							<div class="col-md-6 mb-2">		
								<label class="font-weight-bold"><b>Enrollment No</b></label>
								<input type="text" class="form-control" value="{{ $student->enrollment_number }}" disabled readonly id="student-name">
							</div>
							@php
								$session_list = \App\Models\Session::where('status', 1)->get();
								$semester_details = \App\Models\MasterSemester::where('id', $semester)->first();
							@endphp
							<div class="col-md-6 mb-2">		
								<label class="font-weight-bold"><b>Session</b></label>
								<select required type="text" placeholder="Enter Result" class="form-control" name="session">
									@foreach($session_list as $session)
										<option value="{{ $session->id }}">{{ $session->session }}</option>
									@endforeach
								</select>
							</div>
							
							<div class="col-md-6 mb-2">		
								<label class="font-weight-bold"><b>Semester</b></label>
								<select required  type="text" placeholder="Enter Result" class="form-control" name="semester">
									 
										<option selected value="{{ $semester_details->id }}">{{ $semester_details->semester }}</option>
									 
								</select>
							</div>
							
							<div class="col-md-6 mb-2">		
								<label class="font-weight-bold"><b>Result</b></label>
								<input type="text" placeholder="Enter Result" required class="form-control" name="result" value="{{ old('result') }}">
							</div>
							
							<div class="col-md-6 mb-2">		
								<label class="font-weight-bold"><b>Passing Year</b></label>
								<input type="text" placeholder="Enter Passing Year" required  class="form-control" name="passing_year" value="{{ old('passing_year') }}">
							</div>
							 

								 

								<div style="display: flex;">
									 
										<input type="hidden" name="student_id" value="{{ $student->id }}">
										<input type="hidden" name="franchise_id" value="{{ $student->franchise_id }}">
										<input type="hidden" name="course_id" value="{{ $student->course_id }}">
										<input type="hidden" name="subcourse_id" value="{{ $student->subcourse_id }}">
								</div>

								
								@php
									$master_subject_list = \App\Models\Subject::where('course_id', $student->course_id)->where('sub_course_id', $student->subcourse_id)->where('semester', $semester)->get();
									// dd($master_subject_list);
								@endphp
								
								
								<table class="table table-bordered" id="marks-table">
									<thead style="background-color:red;" class="bg-secondary">
										<tr style="background-color:red;">
											<th>Subject Code</th>
											<th>Subject Name</th>
											<th>Full Marks</th>
											<th>Pass Marks</th>
											<th>Marks Obtained</th>
											<th>Grade</th>
										</tr>
									</thead>
									<tbody>
										<!-- Dynamic rows will be added here -->
										@if($master_subject_list)
											@foreach($master_subject_list as $subject)
												<tr>
													<td><input class="form-control" type="text" required value="{{ $subject->subject_code }}" placeholder="Subject Code" name="subject_code[]"></td>
													<td><input class="form-control" type="text" required value="{{ $subject->name }}" placeholder="Subject Code" name="subject_name[]"></td>
													<td><input class="form-control full-marks" required type="number" value="{{ $subject->full_marks }}" oninput="calculateTotal()" placeholder="Full Marks" name="full_marks[]" class="full-marks" oninput="calculateTotal()"></td>
													<td><input class="form-control" type="number" required value="{{ $subject->pass_marks }}" placeholder="Passing Marks" name="pass_marks[]" class="pass-marks"></td>
													<td><input class="form-control marks-obtained" required type="number" placeholder="Makrs Obtained"  oninput="calculateTotal()" name="marks_obtained[]" class="marks-obtained" oninput="calculateTotal()"></td>
													<td><input class="form-control" required type="text" placeholder="Grade" name="grade[]" readonly></td>
												</tr>
											@endforeach
										@else
											<tr>
												<td>Subject Not added, Please add subject first in the particular course and subcourse</td>
											</tr>
										@endif
											<tr>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td><b>Total : </b><input type="text" readonly id="total-marks-obtained" name="total_marks_obtained"></td>
												<td><b>Percentage :</b> <input type="text" readonly  id="total-percentage" name="total_percentage"></td>
											</tr>
									</tbody>
								</table>

								 
								<button type="submit" class="btn btn-success mt-3" name="submit">Save Details</button>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- End:: row-2 -->



                </div>
            </div>
            <!--APP-CONTENT CLOSE-->


<script>
     
	function getGrade(marks, fullMarks) {
		let percentage = (marks / fullMarks) * 100;

		if (percentage >= 90) return "A+";
		else if (percentage >= 80) return "A";
		else if (percentage >= 70) return "B+";
		else if (percentage >= 60) return "B";
		else if (percentage >= 50) return "C+";
		else if (percentage >= 30) return "C";
		else return "F";
	}

	function calculateTotal() {
		let totalObtained = 0;
		let totalFullMarks = 0;

		const rows = document.querySelectorAll('tbody tr');
		rows.forEach((row) => {
			const obtainedInput = row.querySelector('.marks-obtained');
			const fullMarksInput = row.querySelector('.full-marks');
			const gradeInput = row.querySelector('[name="grade[]"]');

			if (obtainedInput && fullMarksInput && gradeInput) {
				let marks = parseFloat(obtainedInput.value) || 0;
				let fullMarks = parseFloat(fullMarksInput.value) || 0;

				// Only calculate if both are present
				if (fullMarks > 0) {
					let grade = getGrade(marks, fullMarks);
					gradeInput.value = grade;

					totalObtained += marks;
					totalFullMarks += fullMarks;
				}
			}
		});

		document.getElementById('total-marks-obtained').value = totalObtained;
		document.getElementById('total-percentage').value = 
			totalFullMarks > 0 ? ((totalObtained / totalFullMarks) * 100).toFixed(2) + '%' : '0%';
	}
</script> 
</script>

</form>

@endsection

