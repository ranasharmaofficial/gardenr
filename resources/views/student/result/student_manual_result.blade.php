@extends('student.include.master')
@section('title', 'Approved Student List')
@section('content')

<!-- Page Header -->
            <div style="background:linear-gradient(45deg, #f33057, rgb( 56, 88, 249 ) );"  class="d-sm-flex d-block align-items-center justify-content-between page-header-breadcrumb">
                <div>
                    <h4 class="fw-medium mb-2">Student</h4>
                    <div class="ms-sm-1 ms-0">
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Student</a></li>
                                <li class="breadcrumb-item active fw-normal" aria-current="page">Approved Student List</li>
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
                                    Approved Student
                                </div>
								{{--<a style="right: 5px;position: absolute;float: right;" href="{{ url('admin/add-subcourse') }}" class="btn btn-danger-light btn-wave btn-sm float-right">Add Sub Course</a>--}}
                            </div>
                            <div class="card-body">
								<div class="table-responsive">
									<table id="responsiveDataTabless" class="table table-bordered text-nowrap mt-3" style="width:100%">
										<thead>
											<tr>
												<th scope="col">Enrollment Number</th>
												<th scope="col">DOB</th>
												<th scope="col">English Name</th>
												<th scope="col">Course</th>
												<th scope="col">Sub Course</th>
												<th scope="col">Mobile</th>
												<th scope="col">Email</th>
												<th scope="col">Status</th>
												<th scope="col" class="text-right">Result</th>
											</tr>
										</thead>
										<tbody>

											@php
												$state = \App\Models\State::where('id', $student_list->state)->first();
												$courseName = \App\Models\Course::where('id', $student_list->course_id)->pluck('courseTitle')->first();
												$SubCourseName = \App\Models\SubCourse::where('id', $student_list->subcourse_id)->pluck('title')->first();
											@endphp
											<tr>
												<td>{{ $student_list->enrollment_number }}</td>
												<td>{{ date('d-M-Y', strtotime($student_list->dob)) }}</td>
												<td>{{ $student_list->english_name }}</td>
												<td>{{ $courseName }}</td>
												<td>{{ $SubCourseName }}</td>
												<td>{{ $student_list->mobile }}</td>
												<td>{{ $student_list->email }}</td>

												<td class="">
												@if($student_list->status==0)
													<p class="text-danger">Pending</p>
												@elseif($student_list->status==1)
													<p class="text-success">Active</p>
												@else($value->status==2)
													<p class="text-danger">Reject/Block</p>
												@endif

												</td>
												<td>
                                                    <a target="_blank" href="{{ url('student/view-manual-result-details?student_id='.$student_list->id.'&semester=1') }}" class="badge bg-info">First Semester</a>
                                                    <a target="_blank" href="{{ url('student/view-manual-result-details?student_id='.$student_list->id.'&semester=2') }}" class="badge bg-info">Second Semester</a>
												</td>
											</tr>

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


@endsection

