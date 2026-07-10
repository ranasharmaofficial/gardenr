@extends('admin.include.master')
@section('title', 'Vivah Mitra Data List')
@section('content')
<!-- Page Header -->
            <div style="background:linear-gradient(45deg, #f33057, rgb( 56, 88, 249 ) );" class="d-sm-flex d-block align-items-center justify-content-between page-header-breadcrumb">
                <div>
                    <h4 class="fw-medium mb-2">Vivah Mitra Data</h4>
                    <div class="ms-sm-1 ms-0">
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a class="" href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item  active fw-normal" aria-current="page">Vivah Mitra Data List</li>
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
						<h5 class="card-title">Vivah Mitra Data List</h5>
						<a href="{{ url('admin/vivahmitra_products/create') }}" class="btn btn-primary ms-auto">Add Vivah Mitra Data</a>
					</div>
                    <div class="card-body booking_card">
						@php
							// dd($data['category_id']);
						@endphp
						<form method="GET" class="form">
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <select placeholder="Enter Category Name" class="form-control selectpicker" name="category_id" data-toggle="select2" data-placeholder="Choose ..." data-live-search="true">
										<option value="">-- Select Category --</option>
										@foreach ($categories as $category)
											@include('admin.product.category.partials.edit_category_options', [
												'category' => $category,
												'level' => 0,
												'data' => $data ?? null
											])
										@endforeach
									</select>
                                </div> 
								<div class="col-md-3 mb-3">
                                    <select class="form-control selectpicker" name="brand_id" data-toggle="select2" data-placeholder="Choose ..." data-live-search="true">
											<option value="">-- Select Brand --</option>
											@foreach ($brand_list as $val)
												<option value="{{ $val->id }}">{{ $val->name }}</option>
											@endforeach
										</select>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <input type="text" class="form-control" name="search" placeholder="Search" value="@isset($request){{$request->search}}@endisset">
                                </div>
								<div class="col-md-3 mb-3">
                                    <button type="submit" class="btn btn-primary" name="search">Search</button>
                                </div>
                            </div>
                        </form>

                        <div class="table-responsive mt-3">
                            <table id="basicExample" class="table truncate m-0 align-middle">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Category</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Logo</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th class="text-right">Actions</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $key => $value)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $value->category->name }}</td>
                                       <td>{{ $value->name }}</td>
                                       <td>{!! $value->description !!}</td>
                                        <td><img style="max-width: 26px;width: 26px;" src="{{ static_asset($value->thumbnail) }}"></td>
                                        <td>
                                            <div class="actions"> @if($value->status == 1) <span class="badge bg-success-subtle text-success">Active</span> @else <span class="badge bg-danger-subtle text-danger">InActive</span> @endif </div>
                                        </td>
                                        <td>{{ convert_datetime_to_date_format($value->created_at, 'd M Y') }}</td>
                                        <td class="text-right">
                                            <a href="{{ route('admin.vivahmitra_products.edit',$value->id) }}" class="btn btn-icon btn-sm btn-danger-light rounded-pill" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edit Product"><i class="ri-edit-line"></i></a>
                                        </td>
										 
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="pagination">
                                {{ $products->appends(request()->input())->links() }}
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
	</div>

    
@endsection

