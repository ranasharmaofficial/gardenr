@extends('admin.include.master')
@section('title') 
	{{ $page_title }}
@endsection
@section('content')

<!-- Page Header -->
            <div style="background:linear-gradient(45deg, #f33057, rgb( 56, 88, 249 ) );" class="d-sm-flex d-block align-items-center justify-content-between page-header-breadcrumb">
                <div>
                    <h4 class="fw-medium mb-2">{{ $page_title }}</h4>
                    <div class="ms-sm-1 ms-0">
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a class="" href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item  active fw-normal" aria-current="page">{{ $page_title }}</li>
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
                            <div class="card-header d-flex justify-content-between align-items-center">

								<h5 class="mb-0">Update {{ $page_title }}</h5>

								<a href="{{ url('admin/master-video-list') }}" class="btn btn-danger btn-sm float-end">
								   {{ $page_title }} List
								</a>


							</div>

 
                            <div class="card-body">
							
							<div class="container">
								<form id="update-agreement-Form" enctype="multipart/form-data">
									<div class="row">
										<div style="display:none;" id="show-agree-form-error" class="alert alert-danger col-md-12">
											<ul>
												<div class="errorMsgntainer"></div>
											</ul>
										</div>
										
										<div class="col-md-6 mb-3">
											<div class="form-group">
												<label>User Type <span class="text-danger">*</span></label>
												<select class="form-control" name="type" id="target_type">
													<option value="">Select User Type</option>
													@foreach($user_type as $val)
														<option @if($video->user_type==$val->id) selected @endif value="{{ $val->id }}">{{ $val->name }}</option>
													@endforeach
												</select>
											</div>
										</div>
										
										<div class="col-md-6 mb-3">
											<div class="form-group">
												<label>User Designation <span class="text-danger">*</span></label>
												<select class="form-control" name="user_designation_id" id="user_designation_id">
													<option @if($video->user_designation==$user_designation_details->id) selected @endif value="{{ $user_designation_details->id }}">{{ $user_designation_details->name }}</option>
												</select>
											</div>
										</div>
										
										<div class="col-md-6 mb-3">
											<div class="form-group">
												<label>Select Video Category <span class="text-danger">*</span></label>
												<select id="category_id" name="category_id" required class="form-control">
													<option value="">---Select Video Category---</option>
													@foreach($m_video_category as $val)
														<option @if($video->category_id==$val->id) selected @endif value="{{ $val->id }}">{{ $val->name }}</option>
													@endforeach
												</select>
											</div>
										</div>
										
										@php
											$subcategory_list = \App\Models\MVideoCategory::where('status', 1)->where('parent_id', $video->category_id)->get();
										@endphp
										
										<div class="col-md-6 mb-3">
											<div class="form-group">
												<label>Select Sub Category <span class="text-danger">*</span></label>
												<select id="sub_category_id" name="sub_category_id" class="form-control">
													<option value="">---Select Sub Category---</option>
													@foreach($subcategory_list as $val)
														<option @if($video->sub_category_id==$val->id) selected @endif value="{{ $val->id }}">{{ $val->name }}</option>
													@endforeach
												</select>
											</div>
										</div>
										
										<div class="col-md-6 mb-3">
											<div class="form-group">
												<label>User Designation <span class="text-danger">*</span></label>
												<select id="video_type" name="video_type" class="form-control">
													<option value="">Select Video Type</option>
													<option @if($video->video_type=='long_video') selected @endif value="long_video">Long Video</option>
													<option @if($video->video_type=='yt_shorts') selected @endif value="yt_shorts">YT Shorts</option>
												</select>
											</div>
										</div>
										
										<input type="hidden" value="{{ $video->id }}" id="video_id">
										
										<div class="col-md-6 mb-3">
											<div class="form-group">
												<label class="">Video Title</label>
												<input type="text" value="{{ $video->video_title }}" name="video_title"  id="agreement_title" class="form-control" placeholder="Agreement Title">
											</div>
										</div>
										
										<div class="col-md-6 mb-3">
											<div class="form-group">
												<label class="">Video Url</label>
												<input type="text" value="{{ $video->video_url }}" name="video_url"  id="agreement_title" class="form-control" placeholder="Agreement Title">
											</div>
										</div>
										
										<div class="col-md-6 mb-3">
											<div class="form-group">
												<label class="">Status</label>
												<select id="agreement_status" name="status" class="form-control">
													<option @if($video->status==1) selected @endif  value="1">Active</option>
													<option @if($video->status==0) selected @endif  value="0">Inactive</option>
												</select>
											</div>
										</div>
										
										
										
										 
										<div class="col-md-3">
											<div class="form-group mt-4">
												<button class="btn btn-success updateAgreementBtn" type="submit" title="Update">
													Update
												</button>
												 
											</div>
										</div>
									</div>
								</form>
							</div>
							 
										
										
  
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End:: row-2 -->



                </div>
            </div>
            <!--APP-CONTENT CLOSE-->
		 
		
<script>
 

	$(document).on('click', '.updateAgreementBtn', function(e) {
		e.preventDefault();
		 let id = {{ $video->id }};
        var clk_btn = $(".updateAgreementBtn");
        clk_btn.prop('disabled', true);
        var formData = new FormData(document.getElementById("update-agreement-Form"));
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: "{{ url('admin/videoList/update') }}/" + id,
            data: formData,
            processData: false,
            contentType: false,
            dataType: "JSON",
			success: function(data) {
                console.log('status ' + data.status);
                if (data.status == true) {
                    Swal.fire({
						icon: "success",
						title: "Success",
						text: data.message,
						timer: 1500,
						showConfirmButton: false
					});
					document.getElementById('show-agree-form-error').style = "display: none";
                    location.reload();
                } else {
                    Swal.fire({
						icon: "error",
						title: "Oh No!",
						text: "Something went wrong!",
						timer: 1500,
						showConfirmButton: false
					});
					//toastr.error('Something went wrong.');
                }
            }, error: function(err) {

                document.getElementById('show-agree-form-error').style = "display: block";
                clk_btn.prop('disabled', false);
                let error = err.responseJSON;
                console.log(error);
                $.each(error.errors, function(index, value) {
                    $('.errorMsgntainer').append('<span class="text-danger">' + value +

                        '<span>' + '<br>');
                });

            }
        });
    });
	
	$('#category_id').on('change', function () {
		let category_id = $(this).val();

		if (category_id) {
			$.ajax({
				url: "{{ url('admin/get-sub-category') }}/" + category_id,
				type: 'GET',
				success: function (data) {

					$('#sub_category_id').empty();
					$('#sub_category_id').append('<option value="">---Select Sub Category---</option>');

					$.each(data, function (key, value) {
						$('#sub_category_id').append(
							`<option value="${value.id}">${value.name}</option>`
						);
					});
				}
			});
		} else {
			$('#sub_category_id').empty();
		}
	});
	
	$(document).ready(function () {
		$('#target_type').on('change', function () {
			var userTypeId = $(this).val();
			if (userTypeId) {
				$.ajax({
					url: '{{ url("admin/get-designation-by-user") }}/' + userTypeId,
					type: "GET",
					dataType: "json",
					success: function (data) {
						$('#user_designation_id').empty();
						$('#user_designation_id').append('<option value="">Select Designation</option>');
						$.each(data, function (key, value) {
							$('#user_designation_id').append('<option value="' + value.id + '">' + value.name + '</option>');
						});
					}
				});
			} else {
				$('#user_designation_id').empty();
				$('#user_designation_id').append('<option value="">Select Designation</option>');
			}
		});
	});
 
</script>




@endsection

