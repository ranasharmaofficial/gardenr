@extends('admin.include.master')
@section('title', 'View Student Details')
@section('content')

<style>
.txt-center {
    text-align: center;
}
.border- {
    border: 1px solid #000 !important;
}
.padding {
    padding: 15px;
}
.mar-bot {
    margin-bottom: 15px;
}
.admit-card {
    border: 2px solid #000;
    padding: 15px;
    margin: 20px 0;
}
.BoxA h5, .BoxA p {
    margin: 0;
}
h5 {
    text-transform: uppercase;
}
table img {
    width: 100%;
    margin: 0 auto;
}
.table-bordered td, .table-bordered th, .table thead th {
    border: 1px solid #000000 !important;
}
b{
	color:blue;
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

							<section>
	<div class="container">
		<div class="admit-card">
		{{--<div class="BoxA border- padding mar-bot">
				<div class="row">
					<div class="col-sm-4">
						<h5>MEWAR UNIVERSITY</h5>
						<p>NH - 79 Gangrar Chittorgarh - 312901 <br> RAJASTHAN, INDIA</p>
					</div>
					<div class="col-sm-4 txt-center">
						<img src="http://peoplehelp.in/mewaruni/assets/images/mewaruniversity.jpg" width="100px;" />
					</div>
					<div class="col-sm-4">
						<h5>Admit Card</h5>
						<p>B.Tech - 2019</p>
					</div>
				</div>
			</div>--}}
			<div class="BoxC border- padding mar-bot">
				<div class="row">
					<div class="col-sm-6">
						<h5>Enrollment No : {{ $student->enrollment_number}}</h5>
					</div>
				</div>
			</div>
			<div class="BoxD border- padding mar-bot">
				<div class="row">
					<div class="col-sm-10">
						<table class="table table-bordered">
						  <tbody>
							<tr>
							  <td><b>ENROLLMENT NO : {{ $student->enrollment_number}}</b></td>
							  <td><b>Course Fee: </b> {{ $student->fee }}</td>
							</tr>
							<tr>
							  <td><b>Course: </b>{{ $course->courseTitle }}</td>
							  <td><b>Sub Course: </b>{{ $subcourse->title }}</td>
							</tr>
							<tr>
							  <td><b>English Name: </b> {{ $student->english_name}}</td>
							  <td><b>Hindi Name: </b>{{ $student->hindi_name }}</td>
							</tr>
							<tr>
							  <td><b>Mobile No.: </b> {{ $student->mobile}}</td>
							  <td><b>Email: </b>{{ $student->email }}</td>
							</tr>
							<tr>
							  <td><b>Aadhar No.: </b> {{ $student->aadhar_no }}</td>
							  <td><b>Pan No.: </b>{{ $student->pan_no }}</td>
							</tr>
							<tr>
							  <td><b>Gender: </b>{{ $student->gender }}</td>
							  <td><b>Date of Birth: </b>{{ date('d M, Y', strtotime($student->dob)) }}</td>
							</tr>
							<tr>
							  <td><b>Father's Name: </b>{{ $student->fathers_name }}</td>
							  <td><b>Mother's Name: </b>{{ $student->mothers_name }}</td>
							</tr>
							<tr>
							  <td><b>Marital Status: </b>{{ $student->marital_status }}</td>
							  <td><b>Category: </b>{{ $student->category }}</td>
							</tr>
							<tr>
							  <td><b>Whether Handicapped: </b>{{ $student->whether_handicapped }}</td>
							  <td><b>Blood Group: </b>{{ $student->blood_group }}</td>
							</tr>
							<tr>
							  <td colspan="2" style="    height: 125px;"><b>Father's/Husband's Occupation: </b>{{ $student->father_husband_occupation }}</td>
							</tr>
							<tr>
							  <td colspan="2" style="    height: 125px;"><b>Name & Address of Local Guardian: </b>{{ $student->name_address_guardian }}</td>
							</tr>
						  </tbody>
						</table>
					</div>
					<div class="col-sm-2 txt-center">
						<table class="table table-bordered">
						  <tbody>
							<tr>
							  <th scope="row txt-center"><img src="{{ static_asset('uploads/tender/'.$student->image) }}" width="123px" height="165px" /></th>
							</tr>
							{{--<tr>
							  <th scope="row txt-center"><img src="http://peoplehelp.in/mewaruni/images/signature.png" /></th>
							</tr>--}}
						  </tbody>
						</table>
					</div>
				</div>
			</div>
			{{--<div class="BoxE border- padding mar-bot txt-center">
				<div class="row">
					<div class="col-sm-12">
						<h5>EXAMINATION VENUE</h5>
						<p>NH - 79 Gangrar Chittorgarh - 312901 <br> RAJASTHAN, INDIA</p>
					</div>
				</div>
			</div>--}}
			<div class="BoxF border- padding mar-bot txt-center">
				<div class="row">
					<div class="col-sm-12">
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
                                            <td>{{ $student->matric_subject }}</td>
                                            <td>{{ $student->matric_year }}</td>
                                            <td>{{ $student->matric_org }}</td>
                                            <td>{{ $student->matric_board }}</td>
                                            <td>{{ $student->matric_score }}</td>
                                            <td>{{ $student->matric_percent}}</td>
                                        </tr>
                                        <tr>
                                            <th>Intermediate</th>
                                            <td>Pcb,Pcm,arts,commerce</td>
                                            <td>{{ $student->inter_passing_year }} </td>
                                            <td>{{ $student->inter_org }} </td>
                                            <td>{{ $student->inter_board }} </td>
                                            <td>{{ $student->inter_score }} </td>
                                            <td>{{ $student->inter_percent }} </td>
                                        </tr>
                                        <tr>
                                            <th>Graduation</th>
                                            <td>{{ $student->grad_subject }} </td>
                                            <td>{{ $student->grad_year }} </td>
                                            <td>{{ $student->grad_org }} </td>
                                            <td>{{ $student->grad_board }} </td>
                                            <td>{{ $student->grad_score }} </td>
                                            <td>{{ $student->grad_percent }} </td>
                                        </tr>
                                        <tr>
                                            <th>PG/Others</th>
                                            <td>{{ $student->other_subject }} </td>
                                            <td>{{ $student->other_year }} </td>
                                            <td>{{ $student->other_org }} </td>
                                            <td>{{ $student->other_board }} </td>
                                            <td>{{ $student->other_score }} </td>
                                            <td>{{ $student->other_percent }} </td>
										</tr>
                                    </tbody>
                                </table>
						 
					</div>
				</div>
			</div>
			<footer class="txt-center">
				<p></p>
			</footer>

		</div>
	</div>

</section>

                                 
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End:: row-2 -->



                </div>
            </div>
            <!--APP-CONTENT CLOSE-->


@endsection

