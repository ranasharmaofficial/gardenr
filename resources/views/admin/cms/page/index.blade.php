@extends('admin.include.master')
@section('title', 'CMS Page List')
@section('content')
<!-- Page Header -->
	<div style="background:linear-gradient(45deg, #f33057, rgb( 56, 88, 249 ) );"  class="d-sm-flex d-block align-items-center justify-content-between page-header-breadcrumb">
		<div>
			<h4 class="fw-medium mb-2">CMS Page</h4>
			<div class="ms-sm-1 ms-0">
				<nav>
					<ol class="breadcrumb mb-0">
						<li class="breadcrumb-item"><a href="javascript:void(0);">CMS Page</a></li>
						<li class="breadcrumb-item active fw-normal" aria-current="page">Page List</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
<!-- Page Header Close -->
	<div class="main-content app-content">
		<div class="row">
            <div class="col-md-12">
                <div class="card card-table">
					<div class="card-header">
						Page List
						<a style="right: 5px;position: absolute;float: right;" href="{{ url('admin/pages/create') }}" class="btn btn-danger-light btn-wave btn-sm float-right">Add Page</a>
					</div>
                    <div class="card-body booking_card">

                        <form method="GET" class="form mt-3">
                            <div class="row">
                                <div class="col-md-6">
                                     
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="search" placeholder="Search" value="@isset($request){{$request->search}}@endisset">
                                </div>
                            </div>
                        </form>

                        <div class="table-responsive">
                            <table class="table table-stripped table table-hover table-center mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th class="text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pages as $key => $value)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $value->title }}</td>
                                        <td>
                                            <div class="actions"> @if($value->status == 1) <a href="#" class="btn btn-sm bg-success-light mr-2">Active</a> @else <a href="#" class="btn btn-sm bg-danger-light mr-2">Inactive</a> @endif </div>
                                        </td>
                                        <td>{{ convert_datetime_to_date_format($value->created_at, 'd M Y') }}</td>
                                        <td class="text-right">
                                            <div class="dropdown dropdown-action"> 
                                            <a class="dropdown-item" href="{{ route('admin.pages.edit',$value->id) }}"><i class="fas fa-pencil-alt m-r-5"></i> Edit</a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="pagination">
                                {{ $pages->appends(request()->input())->links() }}
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
 
@endsection

