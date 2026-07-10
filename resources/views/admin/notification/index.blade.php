@extends('admin.include.master')
@section('title', 'Notification List')
@section('content')

<!-- Page Header -->
            <div style="background:linear-gradient(45deg, #f33057, rgb( 56, 88, 249 ) );"  class="d-sm-flex d-block align-items-center justify-content-between page-header-breadcrumb">
                <div>
                    <h4 class="fw-medium mb-2">Notification</h4>
                    <div class="ms-sm-1 ms-0">
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Notification</a></li>
                                <li class="breadcrumb-item active fw-normal" aria-current="page">Notification List</li>
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
                                    Notification
                                </div>
								<a style="right: 5px;position: absolute;float: right;" href="{{ url('admin/add-notification') }}" class="btn btn-danger-light btn-wave btn-sm float-right">Add Notification</a>
                            </div>
                            <div class="card-body">

                                <table id="responsiveDataTable" class="table table-bordered text-nowrap mt-3" style="width:100%">
                                    <thead>
                                        <tr>
											<th scope="col">#</th>
											<th scope="col">Title</th>
											<th scope="col">Links</th>
											<th scope="col">Status</th>
											<th scope="col">Created At</th>
											<th scope="col" class="text-right">Actions</th>
										</tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($notificationList as $key => $value)
										<tr>
											<td>{{ $key + 1 }}</td>
											<td>{{ $value->title }}</td>
											<td>{{ $value->links }}</td>
											<td>
												<div class="actions"> @if($value->status == 1) <a href="#" class="btn btn-sm bg-success-light mr-2">Active</a> @else <a href="#" class="btn btn-sm bg-danger-light mr-2">Inactive</a> @endif </div>
											</td>
											<td>{{ date('d M Y', strtotime($value->created_at)) }}</td>
											<td class="text-right">
												<div class="dropdown dropdown-action">
												   <a class="text-primary" href="{{ url('admin/edit-notification/'.$value->id) }}"><i class="fas fa-pencil-alt m-r-5"></i> Edit</a>
													{{-- <a class="text-danger" onclick="return confirm('Are you sure, you want to delete this?')" href="{{route('admin.galleries.delete',$value->id)}}"><i class="fas fa-trash-alt m-r-5"></i>Delete</a>--> --}}
													<a onclick="return confirm('Are you sure, you want to delete this?')" href="{{ url('admin/deleteNotification/'.$value->id)}}" class="btn btn-icon btn-sm btn-danger-light rounded-pill"><i class="ri-delete-bin-line"></i></a>
												</div>
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

