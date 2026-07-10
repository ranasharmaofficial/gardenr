@extends('admin.include.master')
@section('title', 'Pending Student List')
@section('content')
<style>
.table-responsive::-webkit-scrollbar {
  height: 12px;
}

.table-responsive::-webkit-scrollbar-thumb {
  background: #888;
  border-radius: 6px;
}

.table-responsive::-webkit-scrollbar-thumb:hover {
  background: #555;
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
                                <li class="breadcrumb-item active fw-normal" aria-current="page">Pending Student List</li>
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
                                    Pending Student
                                </div>
								{{--<a style="right: 5px;position: absolute;float: right;" href="{{ url('admin/add-subcourse') }}" class="btn btn-danger-light btn-wave btn-sm float-right">Add Sub Course</a>--}}
                            </div>
                            <div class="card-body">
							 
                                <table id="responsiveDataTable" class="table table-bordered text-nowrap mt-3" style="width:100%">
                                    <thead>
                                        <tr>
											<th scope="col">#</th>
											<th scope="col" class="text-right">Actions</th>
												<th scope="col">Enrollment Number</th>
												 <th scope="col">Roll No.</th>
												<th scope="col">Serial No.</th>
											 
											<th scope="col">DOB</th>
											<th scope="col">English Name</th>
											<th scope="col">Franchise</th>
											<th scope="col">Course</th>
											<th scope="col">Sub Course</th>
											<th scope="col">Mobile</th>
											<th scope="col">Email</th>
											<th scope="col">Status</th>
											<th scope="col">Created At</th>
											<th scope="col" class="text-right">Actions</th>
											<th scope="col" class="text-right">View</th>
										</tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pending_student as $key => $value)
										@php
											$state = \App\Models\State::where('id', $value->state)->first();
											$courseName = \App\Models\Course::where('id', $value->course_id)->pluck('courseTitle')->first();
											$SubCourseName = \App\Models\SubCourse::where('id', $value->subcourse_id)->pluck('title')->first();
											$FranchiseDetails = \App\Models\User::where('id', $value->franchise_id)->first();
										@endphp
										<tr>
											<td>{{ $key + 1 }}</td>
											<td>
													<a title="View Student Details" target="_blank" href="{{ url('admin/view-student/'.$value->id) }}" class="btn btn-icon btn-sm btn-primary-light rounded-pill"><i class="ri-eye-line"></i></a>
													<a title="Edit Student Details" target="_blank" href="{{ url('admin/edit-student-details/'.$value->id) }}" class="btn btn-icon btn-sm btn-info-light rounded-pill"><i class="ri-edit-line"></i></a>
												</td>
												<td>{{ $value->enrollment_number }}</td>
												<td>{{ $value->roll_number }}</td>
												<td>{{ $value->serial_number }}</td>
											<td>{{ date('d-M-Y', strtotime($value->dob)) }}</td>
											<td>{{ $value->english_name }}</td>
											<td>{{ $FranchiseDetails->first_name.' '.$FranchiseDetails->last_name }}-({{$FranchiseDetails->partner_code }})</td>
											<td>{{ $courseName }}</td>
											<td>{{ $SubCourseName }}</td>
											<td>{{ $value->mobile }}</td>
											<td>{{ $value->email }}</td>
											 
											<td class="">
											@if($value->status==0)
												<p class="text-danger">Pending</p>
											@elseif($value->status==1)
												<p class="text-success">Active</p>
											@else($value->status==2)
												<p class="text-danger">Reject/Block</p>
											@endif
												
											</td>
											<td>{{ date('d M, Y', strtotime($value->created_at)) }}</td>
											<td class="text-right">
												<form method="post" action="{{ route('admin.updateStudentStatus') }}">
													@csrf
													<select class="form-control" required name="status">
														<option value="">Select Status</option>
														<option @if($value->status==1) selected @endif value="1">Approve</option>
														<option @if($value->status==2) selected @endif value="2">Reject/Block</option>
													</select>
													<input type="hidden" name="student_id" value="{{ $value->id }}">
													<button type="submit" name="submit" class="btn btn-primary mt-1">Update</button>
												</form>
											</td>
											<td><a href="{{ url('admin/view-student/'.$value->id) }}" class="btn btn-primary bt-sm">View</a></td>
										</tr>
										@endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End:: row-2 -->



                </div>
            </div>
            <!--APP-CONTENT CLOSE-->


@endsection

