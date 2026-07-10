@extends('admin.include.master')
@section('title', 'Edit Franchise Details')
@section('content')
<style>
star{
	color:red;
}
</style>
<!-- Page Header -->
            <div style="background:linear-gradient(45deg, #f33057, rgb( 56, 88, 249 ) );"  class="d-sm-flex d-block align-items-center justify-content-between page-header-breadcrumb">
                <div>
                    <h4 class="fw-medium mb-2">Franchise</h4>
                    <div class="ms-sm-1 ms-0">
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Franchise</a></li>
                                <li class="breadcrumb-item active fw-normal" aria-current="page">Edit Franchise Details</li>
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
                                        Franchise Information
                                    </div>
                                </div>
								<form class="card-body" method="post" action="{{ route('admin.updateFranchiseDetails') }}" enctype="multipart/form-data">
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
										<input type="hidden" name="id" value="{{ $franchise->id }}">
										<div class="col-sm-6">
                                            <label for="title" class="col-form-label">Training Centre Code (TC Code)<star>*</star></label>
                                            <input class="form-control" type="text" name="partner_code" required placeholder="Training Centre Code" id="title" value="{{ $franchise->partner_code }}">
                                            <small class="text-danger form-text">@error('partner_code') {{$message}} @enderror</small>
                                        </div>
										<div class="col-sm-6">
                                            <label for="title" class="col-form-label">First Name <star>*</star></label>
                                            <input class="form-control" type="text" name="first_name" required placeholder="First Name" id="first_name" value="{{ $franchise->first_name }}">
                                            <small class="text-danger form-text">@error('first_name') {{$message}} @enderror</small>
                                        </div>
										<div class="col-sm-6">
                                            <label for="title" class="col-form-label">Last Name <star>*</star></label>
                                            <input class="form-control" type="text" name="last_name" required placeholder="Last Name" id="last_name" value="{{ $franchise->last_name }}">
                                            <small class="text-danger form-text">@error('last_name') {{$message}} @enderror</small>
                                        </div>
										<div class="col-sm-6">
                                            <label for="title" class="col-form-label">Institute Name</label>
                                            <input class="form-control" type="text" name="institute_name" placeholder="Institute Name" id="institute_name" value="{{ $franchise->institute_name }}">
                                            <small class="text-danger form-text">@error('institute_name') {{$message}} @enderror</small>
                                        </div>
										<div class="col-sm-6">
                                            <label for="title" class="col-form-label">Mobile <star>*</star></label>
                                            <input class="form-control" type="text" name="mobile" required placeholder="Mobile" id="mobile" value="{{ $franchise->mobile }}">
                                            <small class="text-danger form-text">@error('mobile') {{$message}} @enderror</small>
                                        </div>
										<div class="col-sm-6">
                                            <label for="title" class="col-form-label">Email <star>*</star></label>
                                            <input class="form-control" type="text" name="email" required placeholder="Email" id="email" value="{{ $franchise->email }}">
                                            <small class="text-danger form-text">@error('email') {{$message}} @enderror</small>
                                        </div>
										<div class="col-sm-6">
                                            <label for="course_id" class="col-form-label">Select State</label>
                                            <select class="form-control" type="text" name="state" >
                                                <option value="">Select State</option>
                                                @foreach($state_list as $val)
													<option @if($franchise->state==$val->id) selected @endif value="{{ $val->id }}">{{ $val->name }}</option>
												@endforeach
                                            </select>
                                            <small class="text-danger form-text">@error('course_id') {{$message}} @enderror</small>
                                        </div>
										<div class="col-sm-6">
                                            <label for="title" class="col-form-label">City</label>
                                            <input class="form-control" type="text" name="city" placeholder="City" id="email" value="{{ $franchise->city }}">
                                            <small class="text-danger form-text">@error('city') {{$message}} @enderror</small>
                                        </div>
										<div class="col-sm-6">
                                            <label for="title" class="col-form-label">Pincode</label>
                                            <input class="form-control" type="text" name="pincode" placeholder="Pincode" id="pincode" value="{{ $franchise->pincode }}">
                                            <small class="text-danger form-text">@error('pincode') {{$message}} @enderror</small>
                                        </div>
										
										<div class="col-sm-6">
                                            <label for="title" class="col-form-label">Username <star>*</star></label>
                                            <input class="form-control" type="text" name="username" required id="username" value="{{ $franchise_login_details->username }}">
                                            <small class="text-danger form-text">@error('username') {{$message}} @enderror</small>
                                        </div>
										
										<div class="col-sm-6">
                                            <label for="title" class="col-form-label">Password <star>*</star></label>
                                            <input class="form-control" type="text" name="password" required placeholder="Pincode" id="password" value="{{ $franchise_login_details->password }}">
                                            <small class="text-danger form-text">@error('password') {{$message}} @enderror</small>
                                        </div>
                                        
									</div>
									<button type="submit" class="btn btn-primary buttonedit1 mt-3">Update Details</button>
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
    <script>
        // tinymce.init({
        //     selector: 'textarea#description',
        // });
        $(document).ready(function () {
            /** Get Sub category list on change on parent category */
            $('#category_id').on('change', function () {
                var idCategory = this.value;
                $("#sub_category_id").html('');

                $.ajax({
                    url: "{{url('admin/blogs/fetch_subcategory')}}",
                    type: "POST",
                    data: {
                        category_id: idCategory,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',

                    success: function (result) {
                        $('#sub_category_id').html('<option value="">Choose Sub Catyegory</option>');

                        $.each(result.sub_categories, function (key, value) {
                            $("#sub_category_id").append('<option value="' + value
                                .id + '">' + value.title + '</option>');
                        });
                    }
                });
            });
        });
    </script>
@endsection
