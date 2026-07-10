@extends('admin.include.master')
@section('title', 'Video List')
@section('content')

!-- Page Header -->
            <div style="background:linear-gradient(45deg, #f33057, rgb( 56, 88, 249 ) );" class="d-sm-flex d-block align-items-center justify-content-between page-header-breadcrumb">
                <div>
                    <h4 class="fw-medium mb-2">Video</h4>
                    <div class="ms-sm-1 ms-0">
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a class="" href="javascript:void(0);">Video</a></li>
                                <li class="breadcrumb-item  active fw-normal" aria-current="page">Video List</li>
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
                                    Video List
									<a style="right: 5px;position: absolute;float: right;" href="{{ url('admin/testimonial/videos/create') }}" class="btn btn-danger-light btn-wave btn-sm float-right">Add Video</a>
                                </div>
                            </div>
                            <div class="card-body">
                            <div class="table-responsive">
							 
                                <table id="responsiveDataTable" class="table table-bordered text-nowrap mt-3" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Link</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th class="text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($videos as $key => $value)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $value->title }}</td>
                                        <td>{{ $value->link }}</td>
                                        <td>
                                            <div class="actions"> @if($value->status == 1) <a href="#" class="btn btn-sm bg-success-light mr-2">Active</a> @else <a href="#" class="btn btn-sm bg-danger-light mr-2">Inactive</a> @endif </div>
                                        </td>
                                        <td>{{ convert_datetime_to_date_format($value->created_at, 'd M Y') }}</td>
                                        <td class="text-right">
                                            <div class="dropdown dropdown-action"> 
                                                <a class="btn btn-icon btn-sm btn-primary-light rounded-pill" href="{{ route('admin.testimonial.videos.edit',$value->id) }}"><i class="ri-edit-line"></i></a>
                                                <a class="btn btn-icon btn-sm btn-danger-light rounded-pill" onclick="return confirm('Are you sure, you want to delete this?')" href="{{route('admin.testimonial.videos.delete',$value->id)}}"><i class="ri-delete-bin-line"></i></a>
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
                </div>
                <!-- End:: row-2 -->

                    

                </div>
            </div>
            <!--APP-CONTENT CLOSE-->
			
			
 

@endsection

