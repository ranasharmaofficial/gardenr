@extends('admin.include.master')
@section('title', 'Speech List')
@section('content')
<!-- Page Header -->
	<div style="background:linear-gradient(45deg, #f33057, rgb( 56, 88, 249 ) );"  class="d-sm-flex d-block align-items-center justify-content-between page-header-breadcrumb">
		<div>
			<h4 class="fw-medium mb-2">Blog</h4>
			<div class="ms-sm-1 ms-0">
				<nav>
					<ol class="breadcrumb mb-0">
						<li class="breadcrumb-item"><a href="javascript:void(0);">Blog</a></li>
						<li class="breadcrumb-item active fw-normal" aria-current="page">Blog List</li>
					</ol>
				</nav>
			</div>
		</div>

	</div>
<!-- Page Header Close -->

<div class="main-content app-content">
    <div class="content container-fluid">
		<div class="row">
            <div class="col-sm-12">
                <div class="card custom-card">
				<div class="card-header">
						<div class="card-title">
							Blog List
						</div>
						<a style="right: 5px;position: absolute;float: right;" href="{{ url('admin/blogs/create') }}" class="btn btn-danger-light btn-wave btn-sm float-right">Add New Blog</a>
					</div>
                    <div class="card-body booking_card">



                        <form method="GET" class="form">
                            <div class="row">
                                <div class="col-md-3">
                                    <select class="form-control" name="type" id="type">
                                        <option value="">Select Type</option>
                                        <option value="blog" @if($request->type == "blog") selected @endif>Blog</option>
                                        <option value="news" @if($request->type == "news") selected @endif>News</option>
                                        <option value="case_study" @if($request->type == "case_study") selected @endif>Case Study</option>
                                    </select>
                                </div>

                                <div class="col-md-3">
                                    <select class="form-control" name="category" id="category_id">
                                        <option value="">Select Type</option>
                                    </select>
                                </div>

                                <div class="col-md-3">
                                    <input type="text" class="form-control" name="search" placeholder="Search Title" value="@isset($request->search){{$request->search}}@endisset">
                                </div>

                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-danger"> Search </button>
                                    <a href="{{ url('admin/blogs') }}" class="btn btn-warning"> Reset </a>
                                </div>
                            </div>
                        </form>

                        <div class="table-responsive">
                            <table id="hotel_table" class="table table-stripped table table-hover table-center mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Type</th>
                                        <th>Category Name</th>
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th class="text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($blogs as $key => $value)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>

                                        @if($value->type == "blog")
                                        <td>Blog</td>
                                        @elseif($value->type == "news")
                                        <td>News</td>
                                        @elseif($value->type == "event")
                                        <td>Event</td>
                                        @elseif($value->type == "case_study")
                                        <td>Case Study</td>
                                        @else
                                        <td></td>
                                        @endif

                                        <td>{{ $value->parent_name }}</td>
                                        <td>{{ $value->title }}</td>
                                        <td>
                                            <div class="actions"> @if($value->status == 1) <a href="#" class="btn btn-sm bg-success-light mr-2">Active</a> @else <a href="#" class="btn btn-sm bg-danger-light mr-2">Inactive</a> @endif </div>
                                        </td>
                                        <td>{{ convert_datetime_to_date_format($value->created_at, 'd M Y') }}</td>
                                        <td class="text-right">

										<a href="{{ route('admin.blogs.edit',$value->id) }}" class="btn btn-icon btn-sm btn-info-light rounded-pill"><i class="ri-edit-line"></i></a>
										<a onclick="return confirm('Are you sure, you want to delete this?')" href="{{route('admin.blog.delete',$value->id)}}" class="btn btn-icon btn-sm btn-danger-light rounded-pill"><i class="ri-delete-bin-line"></i></a>

										{{--<div class="dropdown dropdown-action"> <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v ellipse_color"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="{{ route('admin.blogs.edit',$value->id) }}"><i class="fas fa-pencil-alt m-r-5"></i> Edit</a>
                                                    <a class="dropdown-item" target="_blank" href="{{ route('admin.blogs.show_likes',$value->id) }}"><i class="fas fa-thumbs-up m-r-5"></i> Show Likes</a>
                                                    <a class="dropdown-item" target="_blank" href="{{ route('admin.blogs.show_views',$value->id) }}"><i class="fas fa-eye m-r-5"></i> Show Views</a>
                                                    <a class="dropdown-item" target="_blank" href="{{ route('admin.blogs.show_comments',$value->id) }}"><i class="fas fa-comment m-r-5"></i> Show Comments</a>
                                                    <a class="dropdown-item" onclick="return confirm('Are you sure, you want to delete this?')" href="{{route('admin.blog.delete',$value->id)}}"><i class="fas fa-trash-alt m-r-5"></i>Delete</a>
                                                </div>
                                            </div>--}}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="pagination">
                                {{ $blogs->appends(request()->input())->links() }}
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function () {
            /** Get category list on change on type */
            // var idType = "{{$request->type}}";
            // getCategory(idType);

            $('#type').on('change', function () {
                var idType = this.value;
                getCategory(idType);
            });

            function getCategory(idType){
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
                            // if(value.id == {{$request->category}}){
                            //     var output = '<option value="' + value.id + '" selected>' + value.title + '</option>';
                            // }else{
                                var output = '<option value="' + value.id + '">' + value.title + '</option>';
                            // }
                            $("#category_id").append(output);
                        });
                    }
                });
            }
        });

    </script>
@endsection

