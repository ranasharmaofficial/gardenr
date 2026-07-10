@extends('admin.include.master')
@section('title', 'Fund List')
@section('content')

<!-- Page Header -->
            <div style="background:linear-gradient(45deg, #f33057, rgb( 56, 88, 249 ) );"  class="d-sm-flex d-block align-items-center justify-content-between page-header-breadcrumb">
                <div>
                    <h4 class="fw-medium mb-2">Fund</h4>
                    <div class="ms-sm-1 ms-0">
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Fund</a></li>
                                <li class="breadcrumb-item active fw-normal" aria-current="page">Fund List</li>
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
                                    Fund List
                                </div>
								{{--<a style="right: 5px;position: absolute;float: right;" href="{{ url('admin/add-subcourse') }}" class="btn btn-danger-light btn-wave btn-sm float-right">Add Sub Course</a>--}}
                            </div>
                            <div class="card-body">
							 
                                <table id="responsiveDataTable" class="table table-bordered text-nowrap mt-3" style="width:100%">
                                    <thead>
                                        <tr>
											<th scope="col">#</th>
											<th scope="col">Franchise</th>
											<th scope="col">Institute Name</th>
											<th scope="col">Total Fund</th>
											<th scope="col">Created At</th>
											{{--<th scope="col" class="text-right">Actions</th>--}}
										</tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($fundList as $key => $value)
										@php
											$Franchise = \App\Models\User::where('id', $value->user_id)->first();
										@endphp
										<tr>
											<td>{{ $key + 1 }}</td>
											<td>{{ $Franchise->first_name.' '.$Franchise->last_name }}</td>
											<td>{{ $Franchise->institute_name }}</td>
											<td>{{ number_format($value->amount,2) }}</td>
											 
											<td>{{ date('d M, Y', strtotime($value->created_at)) }}</td>
												{{--<td class="text-right">
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
											</td>--}}
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

