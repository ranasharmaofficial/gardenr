@extends('admin.include.master')
@section('title', 'Vivah Mitra Category List')
@section('content')
<!-- Page Header -->
            <div style="background:linear-gradient(45deg, #f33057, rgb( 56, 88, 249 ) );" class="d-sm-flex d-block align-items-center justify-content-between page-header-breadcrumb">
                <div>
                    <h4 class="fw-medium mb-2">{{ $page_title }}</h4>
                    <div class="ms-sm-1 ms-0">
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a class="" href="javascript:void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item  active fw-normal" aria-current="page">{{ $page_title }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>

            </div>
            <!-- Page Header Close -->



            <!--APP-CONTENT START-->
            <div class="main-content app-content">
			<div class="row gx-3">
            <div class="col-md-12">
                <div class="card card-table">
					<div class="card-header d-flex align-items-center justify-content-between">
						<h5 class="card-title">Vivah Mitra Category List</h5>
						<a href="{{ url('admin/vivahmitra_categories/create') }}" class="btn btn-primary ms-auto">Add Vivah Mitra Category</a>
					</div>
                    <div class="card-body booking_card">

					{{--<form method="GET" class="form">
                            <div class="row">
                                 
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="search" placeholder="Search" value="@isset($request){{$request->search}}@endisset">
                                </div>
                            </div>
                        </form>--}}

                        <div class="table-responsive mt-3">
                            <table id="basicExample" class="table truncate m-0 align-middle">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th>Icons</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th class="text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $key => $value)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $value->name }}</td>
                                        <td>{{ $value->slug }}</td>
                                        <td><img style="max-width: 26px;width: 26px;" src="{{ static_asset($value->image) }}"></td>
                                        <td>
                                            <div class="actions"> @if($value->status == 1) <span class="badge bg-success-subtle text-success">Active</span> @else <span class="badge bg-danger-subtle text-danger">InActive</span> @endif </div>
                                        </td>
                                        <td>{{ convert_datetime_to_date_format($value->created_at, 'd M Y') }}</td>
                                        <td class="text-right">
                                            <a href="{{ route('admin.vivahmitra_categories.edit',$value->id) }}" class="btn btn-icon btn-sm btn-danger-light rounded-pill" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edit Category"><i class="ri-edit-line"></i></a>
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

    
@endsection

