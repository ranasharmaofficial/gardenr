@extends('admin.include.master')
@section('title', 'Edit Notification')
@section('content')

<!-- Page Header -->
            <div style="background:linear-gradient(45deg, #f33057, rgb( 56, 88, 249 ) );"  class="d-sm-flex d-block align-items-center justify-content-between page-header-breadcrumb">
                <div>
                    <h4 class="fw-medium mb-2">Notification</h4>
                    <div class="ms-sm-1 ms-0">
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Notification</a></li>
                                <li class="breadcrumb-item active fw-normal" aria-current="page">Edit Notification</li>
                            </ol>
                        </nav>
                    </div>
                </div>

            </div>
            <!-- Page Header Close -->



            <!--APP-CONTENT START-->
            <div class="main-content app-content">
                <div class="container-fluid">


                    <!-- Start:: row-1 -->
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card custom-card">
                                <div class="card-header">
                                    <div class="card-title">
                                        Edit Notification
                                    </div>
                                </div>
								<form class="card-body" method="post" action="{{ route('admin.updateNotification') }}" enctype="multipart/form-data">
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
                                        <input type="hidden" name="id" value="{{ $data->id }}">
										<div class="col-md-6">
											<div class="form-group">
												<label>Enter Title </label>
												<input class="form-control" value="{{ $data->title }}" placeholder="Enter Title" type="text" name="title">
											</div>
										</div>

                                        <div class="col-md-6">
											<div class="form-group">
												<label>Enter Link </label>
												<input class="form-control" value="{{ $data->links }}" placeholder="Enter Link" type="text" name="links">
											</div>
										</div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Status </label>
                                                <select class=" form-control" name="status" required>
                                                    <option value="1" @if($data->status == 1) selected @endif>Active</option>
                                                    <option value="2" @if($data->status == 2) selected @endif>Inactive</option>
                                                </select>
                                            </div>
                                        </div>
									</div>
                                    <input type="hidden" name="id" value="{{ $data->id }}">
									<button type="submit" class="btn btn-primary buttonedit1">Add</button>
								</form>
                            </div>
                        </div>

                    </div>
                    <!-- End:: row-1 -->



                </div>
            </div>
            <!--APP-CONTENT CLOSE-->



@endsection

@section('script')

@endsection
