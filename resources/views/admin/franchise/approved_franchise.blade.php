@extends('admin.include.master')
@section('title', 'Approved Franchise List')
@section('content')

<!-- Page Header -->
            <div style="background:linear-gradient(45deg, #f33057, rgb( 56, 88, 249 ) );"  class="d-sm-flex d-block align-items-center justify-content-between page-header-breadcrumb">
                <div>
                    <h4 class="fw-medium mb-2">Franchise</h4>
                    <div class="ms-sm-1 ms-0">
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Franchise</a></li>
                                <li class="breadcrumb-item active fw-normal" aria-current="page">Approved Franchise List</li>
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
                                    Approved Franchise
                                </div>
								{{--<a style="right: 5px;position: absolute;float: right;" href="{{ url('admin/add-subcourse') }}" class="btn btn-danger-light btn-wave btn-sm float-right">Add Sub Course</a>--}}
                            </div>
                            <div class="card-body">
							 
                                <table id="responsiveDataTable" class="table table-bordered text-nowrap mt-3" style="width:100%">
                                    <thead>
                                        <tr>
											<th scope="col">#</th>
											<th scope="col">First Name</th>
											<th scope="col">Last Name</th>
											<th scope="col">Mobile</th>
											<th scope="col">Email</th>
											<th scope="col">Institute Name</th>
											<th scope="col">State</th>
											<th scope="col">City</th>
											<th scope="col">Pincode</th>
											<th scope="col">Status</th>
											<th scope="col">Created At</th>
											<th scope="col" class="text-right">Actions</th>
										</tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($approved_franchise as $key => $value)
										@php
											$state = \App\Models\State::where('id', $value->state)->first();
										@endphp
										<tr>
											<td>{{ $key + 1 }}</td>
											<td>{{ $value->first_name }}</td>
											<td>{{ $value->last_name }}</td>
											<td>{{ $value->mobile }}</td>
											<td>{{ $value->email }}</td>
											<td>{{ $value->institute_name }}</td>
											<td>@if($state) {{ $state->name }} @endif</td>
											<td>{{ $value->city }}</td>
											<td>{{ $value->pincode }}</td>
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
												<form method="post" action="{{ route('admin.updateFranchiseStatus') }}">
													@csrf
													<select class="form-control" required name="status">
														<option value="">Select Status</option>
														<option @if($value->status==1) selected @endif value="1">Approve</option>
														<option @if($value->status==2) selected @endif value="2">Reject/Block</option>
													</select>
													<input type="hidden" name="user_id" value="{{ $value->id }}">
													<button type="submit" name="submit" class="btn btn-primary mt-1">Update</button>
												</form>
												</br>
												<a href="{{ url('admin/edit-franchise/'.$value->id) }}" class="btn btn-danger btn-sm">Update Franchise Details</a>
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

