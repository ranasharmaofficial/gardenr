@extends('admin.include.master')
@section('title', 'Page Section List')
@section('content')
<div style="background:linear-gradient(45deg, #f33057, rgb( 56, 88, 249 ) );"  class="d-sm-flex d-block align-items-center justify-content-between page-header-breadcrumb">
		<div>
			<h4 class="fw-medium mb-2">CMS Page</h4>
			<div class="ms-sm-1 ms-0">
				<nav>
					<ol class="breadcrumb mb-0">
						<li class="breadcrumb-item"><a href="javascript:void(0);">Page section</a></li>
						<li class="breadcrumb-item active fw-normal" aria-current="page">Page Section List</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
		<div class="main-content app-content">
 

        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table">
					<div class="card-header">
						Page Section List
						<a style="right: 5px;position: absolute;float: right;" href="{{ url('admin/page_sections/create') }}" class="btn btn-danger-light btn-wave btn-sm float-right">Add Page Section</a>
					</div>
                    <div class="card-body booking_card">
                         
                        <form method="GET" class="form">
                            <div class="row">
                                <div class="col-md-3">
                                    <select class="form-control" name="page_id">
                                        <option value="">Select Page</option>
                                        @foreach($cms_pages as $page)
                                            <option value="{{$page->id}}" @if($request->page_id == $page->id) selected @endif>{{$page->title}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-3">
                                    <input type="text" class="form-control" name="section" placeholder="Search Section" value="@isset($request->section){{$request->section}}@endisset">
                                </div>

                                <div class="col-md-3">
                                    <input type="text" class="form-control" name="search" placeholder="Search Title" value="@isset($request->search){{$request->search}}@endisset">
                                </div>

                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-danger"> Search </button>
                                    <a href="{{ url('admin/page_sections') }}" class="btn btn-warning"> Reset </a>
                                </div>
                            </div>
                        </form>

                        <div class="table-responsive">
                            <table class="table table-stripped table table-hover table-center mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Page Name</th>
                                        <th>Section Name</th>
                                        <th>Title</th>
                                        <th>Title Green</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th class="text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($page_sections as $key => $value)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $value->page_title }}</td>
                                        <td>{{ $value->section_name }}</td>
                                        <td>{{ $value->title }}</td>
                                        <td>{{ $value->title_green }}</td>
                                        <td>{!! \Illuminate\Support\Str::limit($value->description ?? '',50,' ...') !!}</td>
                                        <td>
                                            <div class="actions"> @if($value->status == 1) <a href="#" class="btn btn-sm bg-success-light mr-2">Active</a> @else <a href="#" class="btn btn-sm bg-danger-light mr-2">Inactive</a> @endif </div>
                                        </td>
                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                            <a class="dropdown-item" href="{{ route('admin.page_sections.edit',$value->id) }}"><i class="fas fa-pencil-alt m-r-5"></i> Edit</a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="pagination">
                                {{ $page_sections->appends(request()->input())->links() }}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

