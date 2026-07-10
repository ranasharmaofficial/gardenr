@extends('admin.include.master')
@section('title', 'View Student Details')
@section('content')
<style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: auto;
            border: 2px solid black;
            padding: 15px;
        }
        .header {
            font-size: 20px;
            font-weight: bold;
            text-align: center;
        }
        .orange-box {
            background-color: rgb(176, 172, 166);
            font-weight: bold;
            padding: 5px;
        }
        input {
            width: 95%;
            padding: 5px;
            margin: 5px 0;
            border: 1px solid black;
        }
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
                    <h4 class="fw-medium mb-2">Student</h4>
                    <div class="ms-sm-1 ms-0">
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Student</a></li>
                                <li class="breadcrumb-item active fw-normal" aria-current="page">View Student</li>
                            </ol>
                        </nav>
                    </div>
                </div>

            </div>
            <!-- Page Header Close -->

<form method="post" action="{{ route('admin.saveManualStudentResult') }}">
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
                                    View Student
                                </div>
								<a style="right: 5px;position: absolute;float: right;" href="{{ url('admin/approved-student') }}" class="btn btn-danger-light btn-wave btn-sm float-right">Student List</a>
                            </div>
                            <div class="card-body">
							<div class="header">International Council for Vocational Training (ICVT)</div>
							
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
										
							 <div class="orange-box">Name of Student:</div>
								<input type="text" value="{{ $student->english_name}}" readonly id="student-name">

								<div>Father's Name:</div>
								<input type="text" name="" readonly value="{{ $student->fathers_name }}" id="father-name">

								<div style="display: flex;">
									<div style="width: 50%;">
										DOB: <input type="text" readonly value="{{ date('d M, Y', strtotime($student->dob)) }}" id="dob" placeholder="XX/XX/XXXX">
									</div>
									<div style="width: 50%;">
										Enrollment No: <input type="text" value="{{ $student->enrollment_number}}" id="enrollment-no">
									</div>
								</div>

								<div style="display: flex;">
									<div style="width: 50%;" class="orange-box">Result: <input required type="text" placeholder="Enter Result" name="result" value="{{ old('result') }}"></div>
									<div style="width: 50%;" class="orange-box">Passing Year: <input required type="text" placeholder="Enter Passing Year" name="passing_year" value="{{ old('passing_year') }}"></div>
									<div class="orange-box">Semester: <select class="form-control" type="text" required  placeholder="Enter Semester" name="semester">
										<option value="1">First Semester</option>
										<option value="2">Second Semester</option>
										<option value="3">Third Semester</option>
										<option value="4">Fourth Semester</option>
									</select>
									</div>
									<input type="hidden" name="student_id" value="{{ $student->id }}">
										<input type="hidden" name="franchise_id" value="{{ $student->franchise_id }}">
										<input type="hidden" name="course_id" value="{{ $student->course_id }}">
										<input type="hidden" name="subcourse_id" value="{{ $student->subcourse_id }}">
								</div>

								
								
								
								<table id="marks-table">
									<thead>
										<tr>
											<th>Subject Code</th>
											<th>Subject Name</th>
											<th>Full Marks</th>
											<th>Pass Marks</th>
											<th>Marks Obtained</th>
											<th>Grade</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<!-- Dynamic rows will be added here -->
									</tbody>
								</table>

								<div class="btn-container">
									<div class="btn" onclick="addRow()">Add More</div>
								</div>

								<div class="total-container">
									Grand Total: <span id="grand-total">0</span> | Percentage: <span id="percentage">00.00%</span>
								</div>

								<button type="submit" class="btn btn-success w-85" name="submit">Save Details</button>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- End:: row-2 -->



                </div>
            </div>
            <!--APP-CONTENT CLOSE-->


<script>
    function addRow() {
        let table = document.getElementById("marks-table").getElementsByTagName('tbody')[0];

        let row = table.insertRow();
        row.innerHTML = `
            <td><input type="text" placeholder="Subject Code" name="subject_code[]"></td>
            <td><input type="text" placeholder="Subject Code" name="subject_name[]"></td>
            <td><input type="number" placeholder="Full Marks" name="full_marks[]" class="full-marks" oninput="calculateTotal()"></td>
            <td><input type="number" placeholder="Passing Marks" name="pass_marks[]" class="pass-marks"></td>
            <td><input type="number" placeholder="Makrs Obtained" name="marks_obtained[]" class="marks-obtained" oninput="calculateTotal()"></td>
            <td><input type="text" placeholder="Grade" name="grade[]" readonly></td>
            <td><button class="btn-remove" onclick="removeRow(this)">X</button></td>
        `;
    }

    function removeRow(button) {
        let row = button.parentNode.parentNode;
        row.parentNode.removeChild(row);
        calculateTotal();
    }

    function calculateTotal() {
        let fullMarks = document.querySelectorAll(".full-marks");
        let marksObtained = document.querySelectorAll(".marks-obtained");
        let passMarks = document.querySelectorAll(".pass-marks");

        let totalMarks = 0;
        let obtainedMarks = 0;
        let passed = true;

        fullMarks.forEach((input, index) => {
            let fullMark = parseInt(input.value) || 0;
            let obtainedMark = parseInt(marksObtained[index].value) || 0;
            let passMark = parseInt(passMarks[index].value) || 0;

            totalMarks += fullMark;
            obtainedMarks += obtainedMark;

            let gradeInput = input.parentNode.parentNode.querySelector("[name='grade[]']");
            gradeInput.value = getGrade(obtainedMark, fullMark);

            if (obtainedMark < passMark) {
                passed = false;
            }
        });

        document.getElementById("grand-total").innerText = obtainedMarks;
        let percentage = totalMarks > 0 ? ((obtainedMarks / totalMarks) * 100).toFixed(2) : "00.00";
        document.getElementById("percentage").innerText = percentage + "%";

        let resultBox = document.querySelector(".orange-box:nth-child(9)");
        resultBox.innerText = passed ? "Result: Pass" : "Result: Fail";
    }

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
</script>

</form>

@endsection

