@extends('admin.include.master')
@section('title', 'Category List')
@section('content')
<!-- Page Header -->
	<div style="background:linear-gradient(45deg, #f33057, rgb( 56, 88, 249 ) );"  class="d-sm-flex d-block align-items-center justify-content-between page-header-breadcrumb">
		<div>
			<h4 class="fw-medium mb-2">Setup</h4>
			<div class="ms-sm-1 ms-0">
				<nav>
					<ol class="breadcrumb mb-0">
						<li class="breadcrumb-item"><a href="javascript:void(0);">Setup</a></li>
						<li class="breadcrumb-item active fw-normal" aria-current="page">Category List</li>
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
							Categories
						</div>
						<a style="right: 5px;position: absolute;float: right;" href="{{ url('admin/categories/create') }}" class="btn btn-danger-light btn-wave btn-sm float-right">Add New Category</a>
					</div>
                    <div class="card-body booking_card">
						<div class="table-responsive">
                            <table class="table table-stripped table table-hover table-center mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Type</th>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th class="text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $key => $value)
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

                                        <td>{{ $value->title }}</td>
                                        <td>
                                            <div class="actions"> @if($value->status == 1) <a href="#" class="btn btn-sm bg-success-light mr-2">Active</a> @else <a href="#" class="btn btn-sm bg-danger-light mr-2">Inactive</a> @endif </div>
                                        </td>
                                        <td>{{ convert_datetime_to_date_format($value->created_at, 'd M Y') }}</td>
                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a class="text-primary" href="{{ route('admin.categories.edit',$value->id) }}"><i class="fas fa-pencil-alt m-r-5"></i> Edit</a>
                                                &nbsp;&nbsp;<a class="text-danger" onclick="return confirm('Are you sure, you want to delete this?')" href="{{route('admin.category.delete',$value->id)}}"><i class="fas fa-trash-alt m-r-5"></i>Delete</a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                            <div class="pagination">
                                {{ $categories->appends(request()->input())->links() }}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection
