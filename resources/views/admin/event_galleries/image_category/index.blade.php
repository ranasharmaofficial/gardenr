@extends('admin.include.master')
@section('title', 'Add Event Category')
@section('content')

<!-- Page Header -->
            <div style="background:linear-gradient(45deg, #f33057, rgb( 56, 88, 249 ) );"  class="d-sm-flex d-block align-items-center justify-content-between page-header-breadcrumb">
                <div>
                    <h4 class="fw-medium mb-2">Event Category</h4>
                    <div class="ms-sm-1 ms-0">
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Event Category</a></li>
                                <li class="breadcrumb-item active fw-normal" aria-current="page">Add Event Category</li>
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
                                    Event Category
                                    <a style="right: 5px;position: absolute;float: right;" href="{{ url('admin/event_categories/create') }}" class="btn btn-danger-light btn-wave btn-sm float-right">Add Event Category</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="responsiveDataTable" class="table table-bordered text-nowrap" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th scope="col">Sl. No.</th>
                                            <th scope="col">Title</th>
                                            <th scope="col">Event</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $key => $value)
										<tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $value->title }}</td>
                                            <td><img style="height:50px;" src="{{ static_asset($value->image) }}" /></td>
                                            <td><div class="actions"> @if($value->status == 1) <a href="#" class="btn btn-sm bg-success-light mr-2">Active</a> @else <a href="#" class="btn btn-sm bg-danger-light mr-2">Inactive</a> @endif </div></td>
                                            <td>
												<div class="hstack gap-2 fs-15">
													<a href="{{ route('admin.event_categories.delete', $value->id) }}" onclick="return confirm('Are you sure, you want to delete this?')" class="btn btn-icon btn-sm btn-danger-light rounded-pill"><i class="ri-delete-bin-line"></i></a>
													<!--<a href="{{ url('admin/') }}" class="btn btn-icon btn-sm btn-success-light rounded-pill"><i class="ri-add-box-line"></i></a>-->
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


@if(false)
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <div class="mt-2">
                        <h4 class="card-title float-left mt-2">Add New Image Category</h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body booking_card">
                        <form method="post" action="{{ route('admin.image_categories.store') }}">
                            @csrf
                            <div class="row formtype">
                                <div class="col-md-12">
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                </div>

                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>Category Name </label>
                                        <input type="text" class="form-control" name="title" required>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Status </label>
                                        <select class=" form-control" id="status" name="status" required>
                                            <option value="1" selected>Active</option>
                                            <option value="2">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary buttonedit1">Add</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endif
@endsection
