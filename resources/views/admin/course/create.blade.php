@extends('admin.include.master')
@section('title', 'Add Course')
@section('content')

<!-- Page Header -->
            <div style="background:linear-gradient(45deg, #f33057, rgb( 56, 88, 249 ) );"  class="d-sm-flex d-block align-items-center justify-content-between page-header-breadcrumb">
                <div>
                    <h4 class="fw-medium mb-2">Course</h4>
                    <div class="ms-sm-1 ms-0">
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Course</a></li>
                                <li class="breadcrumb-item active fw-normal" aria-current="page">Add Course</li>
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
                                        Add Course
                                    </div>
                                </div>
								<form class="card-body" method="post" action="{{ route('admin.courseStore') }}" enctype="multipart/form-data">
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
										
										<div class="col-sm-6">
											<label for="CourseTitle" class="col-form-label">Course Title <star>*</star></label>
											<input class="form-control" type="text" name="coursetitle" required placeholder="Course Title" id="CourseTitle" value="{{old('coursetitle')}}">
											<small class="text-danger form-text">@error('coursetitle') {{$message}} @enderror</small>
										</div>
										
										<div class="col-sm-6">
											<label class="col-form-label">Course Picture <star>*</star></label>
											<input type="file" name="courseimage" class="form-control" required>
											<small class="text-danger form-text">@error('courseimage') {{$message}} @enderror</small>
										</div>
									</div>
									<button type="submit" class="btn btn-primary buttonedit1 mt-3">Add</button>
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
