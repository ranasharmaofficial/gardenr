@extends('admin.include.master')
@section('title', 'Add New Blog')
@section('content')
<!-- Page Header -->
	<div style="background:linear-gradient(45deg, #f33057, rgb( 56, 88, 249 ) );"  class="d-sm-flex d-block align-items-center justify-content-between page-header-breadcrumb">
		<div>
			<h4 class="fw-medium mb-2">Blog</h4>
			<div class="ms-sm-1 ms-0">
				<nav>
					<ol class="breadcrumb mb-0">
						<li class="breadcrumb-item"><a href="javascript:void(0);">Blog</a></li>
						<li class="breadcrumb-item active fw-normal" aria-current="page">Add Blog</li>
					</ol>
				</nav>
			</div>
		</div>

	</div>
<!-- Page Header Close -->
	<div class="main-content app-content">
		<div class="row">
            <div class="col-sm-12">
                <div class="card custom-card">
					<div class="card-header">
						<div class="card-title">
							Add Blog
						</div>
						<a style="right: 5px;position: absolute;float: right;" href="{{ url('admin/blogs') }}" class="btn btn-danger-light btn-wave btn-sm float-right">Blog List</a>
					</div>
                    <div class="card-body booking_card">
                        <form method="post" action="{{ route('admin.blogs.store') }}" enctype="multipart/form-data">
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

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Type <span class="text-danger">*</span> </label>
                                        <select class="form-control" name="type" id="type">
                                            <option value="">Select Type</option>
                                            <option value="blog">Blog</option>
                                            <!--<option value="news">News</option>
                                            <option value="event">Event</option>
                                            <option value="case_study">Case Study</option>-->
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Category <span class="text-danger">*</span> </label>
                                        <select class="form-control" name="category_id" id="category_id">
                                            <option value="">Select Type First</option>

                                        </select>
                                    </div>
                                </div>

                                {{-- <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Title <span class="text-danger">*</span> </label>
                                        <input type="text" value="{{ old('english_title') }}" class="@error('english_title') is-invalid @enderror form-control" name="english_title">
                                        @error('english_title')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div> --}}

								<div class="col-md-12">
                                    <div class="form-group">
                                        <label>Title <span class="text-danger">*</span></label>
                                        <input type="text" value="{{ old('title') }}" class="@error('title') is-invalid @enderror form-control" name="title">
                                        @error('title')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Description <span class="text-danger">*</span></label>
                                        <textarea class="form-control" id="description" name="description">{{ old('description') }}"</textarea>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Blog Image </label>
                                        <input class="form-control" type="file" name="blog_image">
                                    </div>
                                </div>

								<div class="col-md-6">
                                    <div class="form-group">
                                        <label>City </label>
                                        <input class="form-control" value="{{ old('city') }}" type="text" name="city">
                                    </div>
                                </div>

                                {{--<div class="col-md-3">
                                    <div class="form-group">
                                        <label>Country </label>
                                        <select class=" form-control" name="country">
                                            <option value="">Select Country</option>
                                            @foreach($countries AS $country)
                                                <option value="{{$country->id}}">{{$country->country_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>--}}

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Status <span class="text-danger">*</span></label>
                                        <select class=" form-control" name="status">
                                            <option value="1" selected>Active</option>
                                            <option value="2">Inactive</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Tags </label>
                                        <input class="form-control" type="text" data-role="tagsinput" name="tags">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Meta Title </label>
                                        <input type="text" value="{{ old('meta_title') }}" class="form-control" name="meta_title">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Meta Tag </label>
                                        <input type="text" class="form-control" value="{{ old('meta_tag') }}" name="meta_tag">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Meta Description </label>
                                        <textarea class="form-control" name="meta_description" rows="5">{{ old('meta_description') }}</textarea>
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

@endsection

@section('script')
    <script type="text/javascript">
        // tinymce.init({
        //     selector: 'textarea#description',
        // });

        $(document).ready(function () {
            /** Get category list on change on type */
            $('#type').on('change', function () {
                var idType = this.value;
                $("#category_id").html('');

                $.ajax({
                    url: "{{url('admin/blogs/fetch_category')}}",
                    type: "POST",
                    data: {
                        type: idType,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',

                    success: function (result) {
                        $('#category_id').html('<option value="">Choose Catyegory</option>');

                        $.each(result.categories, function (key, value) {
                            $("#category_id").append('<option value="' + value
                                .id + '">' + value.title + '</option>');
                        });
                    }
                });
            });
        });

    </script>
@endsection
