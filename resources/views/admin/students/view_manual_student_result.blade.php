@extends('admin.include.master')
@section('title', 'View Student Details')
@section('content')
<style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 0;
            background-color: #f9f9f9;
        }
        .container {
            max-width: 800px;
            margin: auto;
            background: #fff;
            padding: 5px;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }
        .header {
            font-size: 20px;
            font-weight: bold;
            text-align: center;
        }
        .section {
            background: #f57c00;
            color: white;
            padding: 8px;
            margin: 10px 0;
            border-radius: 5px;
            font-weight: bold;
        }
        .row {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
        .label {
            flex: 1;
            padding: 8px;
            background: #f1f1f1;
            border-radius: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background: #f57c00;
            color: white;
        }
        .footer {
            display: flex;
            justify-content: space-between;
            background: #f57c00;
            color: white;
            padding: 8px;
            border-radius: 5px;
            margin-top: 10px;
        }
        @media (max-width: 600px) {
            .row {
                flex-direction: column;
            }
        }
		
		.p-4 {
			padding: .9rem !important;
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
							 
								 <div class="container">
        <div class="header">International Council for Vocational Training (ICVT)</div>
        
        <div class="section">Name: {{ $student->english_name }}</div>
        <div class="section">Father's Name: {{ $student->fathers_name }}</div>
        
        <div class="p-4">
			<div class="row">
				<div class="label">Enrollment No.: {{ $student->enrollment_number }}</div>
				<div class="label">Roll No.: {{ $student->roll_number }}</div>
			</div>
			<div class="row mt-3">
				<div class="label">Serial No.: {{ $student->serial_number }}</div>
				<div class="label">TC Code: {{ $franchise_details }}</div>
				
			</div>
			<div class="row mt-3">
				<div class="label">DOB: {{ date('d M, Y', strtotime($student->dob)) }}</div>
			</div>
			<div class="row mt-3">
				<div class="label">Result: {{ $result_added->result }}</div>
				<div class="label">Passing Year: {{ $result_added->passing_year }}</div>
			</div>
		</div>
        
        @php
			if($result_added->semester=='1'){
				$semester = '1st Semester';
			}
			
			if($result_added->semester=='2'){
				$semester = '2nd Semester';
			}
			
			if($result_added->semester=='3'){
				$semester = '3rd Semester';
			}
			
			if($result_added->semester=='4'){
				$semester = '4th Semester';
			}
				
		@endphp
        
        <div class="section">Semester: {{ $semester }}</div>
        
        <div class="table-responsive">
			<table>
            <tr>
                <th>Subject Code</th>
                <th>Subject Name</th>
                <th>Full Marks</th>
                <th>Pass Marks</th>
                <th>Marks Obtained</th>
                <th>Grade</th>
            </tr>
            <!-- Add rows as needed -->
			@php
				$grand_total = 0;
				$total_marks = 0;
			@endphp

			@foreach($result_subjects as $item)
				<tr>
					<td>{{ $item->subject_code }}</td>
					<td>{{ $item->subject_name }}</td>
					<td>{{ $item->full_marks }}</td>
					<td>{{ $item->pass_marks }}</td>
					<td>{{ $item->marks_obtained }}</td>
					<td>{{ $item->grade }}</td>
				</tr>
				@php
					$grand_total += $item->marks_obtained;
					$total_marks += $item->full_marks;
				@endphp
			@endforeach

			@php
				$percentage = ($total_marks > 0) ? ($grand_total / $total_marks) * 100 : 0;
			@endphp

			</table>
		</div>

			<div class="footer">
				<span>Grand Total: {{ $grand_total }}</span>
				<span>Percentage: {{ number_format($percentage, 2) }}%</span>
			</div>
    </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- End:: row-2 -->



                </div>
            </div>
            <!--APP-CONTENT CLOSE-->

 

 

@endsection

