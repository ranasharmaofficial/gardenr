@extends('admin.include.master')
@section('title', 'Update Gallery')
@section('content')
 <div style="background:linear-gradient(45deg, #f33057, rgb( 56, 88, 249 ) );"  class="d-sm-flex d-block align-items-center justify-content-between page-header-breadcrumb">
                <div>
                    <h4 class="fw-medium mb-2">Course</h4>
                    <div class="ms-sm-1 ms-0">
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Course</a></li>
                                <li class="breadcrumb-item active fw-normal" aria-current="page">Update Course</li>
                            </ol>
                        </nav>
                    </div>
                </div>

            </div>
<div class="main-content app-content">
    <div class="">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <div class="mt-2">
                        <h4 class="card-title float-left mt-2">Update Gallery</h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body booking_card">
					
					<form action="{{ route('admin.updateCourseDetails') }}" method="post" class="row" enctype="multipart/form-data">
                                    @csrf
                                    {{-- <div class="col-sm-6">
                                        <label for="CourseName" class="col-form-label">Course Name <star>*</star>
                                        </label>
                                        <input class="form-control" type="text" name="coursename" required
                                            placeholder="Course Name" id="CourseName" value="{{$course->courseName}}">
                                        <small class="text-danger form-text">@error('coursename') {{$message}}
                                            @enderror</small>
                                    </div> --}}
                                    <input type="hidden" name="courseid" value="{{ $course->id }}" id="">
                                    <div class="col-sm-6">
                                        <label for="CourseTitle" class="col-form-label">Course Title <star>*</star>
                                        </label>
                                        <input class="form-control" type="text" name="coursetitle" required
                                            placeholder="Course Title" id="CourseTitle" value="{{$course->courseTitle}}">
                                        <small class="text-danger form-text">@error('coursetitle') {{$message}}
                                            @enderror</small>
                                    </div>
                                    
									
									<div class="col-sm-6">
                                        <label class="col-form-label">Course Picture <star>*</star></label>
                                        <input type="file" name="courseimage" class="form-control">
                                        <small class="text-danger form-text">@error('courseimage') {{$message}} @enderror</small>
                                        <img src="{{ static_asset('uploads/courses/'.$course->courseImage) }}" class="img-fluid mt-3" style="height:150px;"/>
                                    </div>

                                    <div class="col-sm-12 mt-3 text-center">
                                        <button name="update_course" type="submit" class="btn btn-info">Update Course Details</button>
                                    </div>
                                </form>
                         

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

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
