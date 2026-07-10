@extends('franchise.include.master')
@section('title', 'Pending Student List')
@section('content')

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
								<a style="right: 5px;position: absolute;float: right;" href="{{ url('franchise/add-student') }}" class="btn btn-danger-light btn-wave btn-sm float-right">Add Student</a>
                            </div>
                            <div class="card-body">

                                <table id="responsiveDataTable" class="table table-bordered text-nowrap mt-3" style="width:100%">
                                    <thead>
                                        <tr>
											<th scope="col">#</th>
											<th scope="col">Enrollment No.</th>
											<th scope="col">Roll No.</th>
											<th scope="col">Serial No.</th>
											<th scope="col">Name</th>
											{{-- <th scope="col">Hindi Name</th> --}}
											<th scope="col">Mobile</th>
											<th scope="col">Email</th>
											<th scope="col">Father's Name</th>
											<th scope="col">Mother's Name</th>
											<th scope="col">DOB</th>
											<th scope="col">Gender</th>
											<th scope="col">Status</th>
											<th scope="col">Created At</th>
											<th scope="col">Action</th>

										</tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($student_list as $key => $value)
										@php
											//$state = \App\Models\State::where('id', $value->state)->first();
										@endphp
										<tr>
											<td>{{ $key + 1 }}</td>
											<td>{{ $value->enrollment_number }}</td>
											<td>{{ $value->roll_number }}</td>
											<td>{{ $value->serial_number }}</td>
											<td>{{ $value->english_name }}</td>
											{{-- <td>{{ $value->hindi_name }}</td> --}}
											<td>{{ $value->mobile }}</td>
											<td>{{ $value->email }}</td>
											<td>{{ $value->fathers_name }}</td>
											<td>{{ $value->mothers_name }}</td>
											<td>{{ $value->dob }}</td>
											<td>{{ $value->gender }}</td>
											<td class="">
											@if($value->status==0)
												<p class="text-danger">Pending</p>
											@else
												<p class="text-success">Approved</p>
											@endif

											</td>
											<td>{{ date('d M, Y', strtotime($value->created_at)) }}</td>
											<td>
												<a class="btn btn-primary btn-sm" href="{{ url('franchise/view-student/'.$value->id) }}">View&nbsp;Details</a>
											</td>
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

