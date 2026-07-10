@extends('admin.include.master')
@section('title', 'Gallery List')
@section('content')

<!-- Page Header -->
            <div style="background:linear-gradient(45deg, #f33057, rgb( 56, 88, 249 ) );"  class="d-sm-flex d-block align-items-center justify-content-between page-header-breadcrumb">
                <div>
                    <h4 class="fw-medium mb-2">Photo Gallery</h4>
                    <div class="ms-sm-1 ms-0">
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Gallery</a></li>
                                <li class="breadcrumb-item active fw-normal" aria-current="page">Gallery List</li>
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
                                    Gallery
                                </div>
								<a style="right: 5px;position: absolute;float: right;" href="{{ url('admin/galleries/create') }}" class="btn btn-danger-light btn-wave btn-sm float-right">Add Gallery</a>
                            </div>
                            <div class="card-body">
							<form method="GET" class="form mt-3 mb-3">
								<div class="row">
									<div class="col-md-4">
										<select class="form-control" name="category_id">
											<option value="">Select Type</option>
											@foreach($categories as $category)
												<option value="{{$category->id}}" @if($request->category_id == $category->id) selected @endif>{{$category->title}}</option>
											@endforeach
										</select>
									</div>
									<div class="col-md-4">
										<button type="submit" class="btn btn-danger-light btn-wave btn-sm"> Search </button>
										<a href="{{ url('admin/galleries') }}" class="btn btn-danger-warning btn-wave btn-sm"> Reset </a>
									</div>
								</div>
							</form>
                                <table id="responsiveDataTable" class="table table-bordered text-nowrap mt-3" style="width:100%">
                                    <thead>
                                        <tr>
											<th scope="col">#</th>
											<th scope="col">Category Name</th>
											<th scope="col">Image</th>
											<th scope="col">Status</th>
											<th scope="col">Created At</th>
											<th scope="col" class="text-right">Actions</th>
										</tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($galleries as $key => $value)
										<tr>
											<td>{{ $key + 1 }}</td>
											<td>{{ $value->parent_name }}</td>
											<td class="text-black"><img height="60" src="{{ static_asset('uploads/gallery/'.$value->image) }}"></td>
											<td>
												<div class="actions"> @if($value->status == 1) <a href="#" class="btn btn-sm bg-success-light mr-2">Active</a> @else <a href="#" class="btn btn-sm bg-danger-light mr-2">Inactive</a> @endif </div>
											</td>
											<td>{{ convert_datetime_to_date_format($value->created_at, 'd M Y') }}</td>
											<td class="text-right">
												<div class="dropdown dropdown-action">
												   <!-- <a class="text-primary" href="{{ route('admin.galleries.edit',$value->id) }}"><i class="fas fa-pencil-alt m-r-5"></i> Edit</a>
													<a class="text-danger" onclick="return confirm('Are you sure, you want to delete this?')" href="{{route('admin.galleries.delete',$value->id)}}"><i class="fas fa-trash-alt m-r-5"></i>Delete</a>-->
													<a onclick="return confirm('Are you sure, you want to delete this?')" href="{{route('admin.galleries.delete',$value->id)}}" class="btn btn-icon btn-sm btn-danger-light rounded-pill"><i class="ri-delete-bin-line"></i></a>
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

