@extends('admin.include.master')
@section('title', 'Color List')
@section('content')
<div class="app-container">
    <div class="content container-fluid">
        <!-- App hero header starts -->
          <div class="app-hero-header d-flex align-items-center">

            <!-- Breadcrumb starts -->
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <i class="ri-home-8-line lh-1 pe-3 me-3 border-end"></i>
                <a href="{{ url('admin/dashboard') }}">Home</a>
              </li>
              <li class="breadcrumb-item text-primary" aria-current="page">
                Color List
              </li>
            </ol>
            <!-- Breadcrumb ends -->


          </div>

        <div class="app-body">
			<div class="row gx-3">
            <div class="col-md-12">
                <div class="card card-table">
					<div class="card-header d-flex align-items-center justify-content-between">
						<h5 class="card-title">Color List</h5>
						<a href="{{ url('admin/colors/create') }}" class="btn btn-primary ms-auto">Add Color</a>
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
                                        <th>Code</th>
                                        <th>Color</th>
                                        <th>Created At</th>
                                        <th class="text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($color_list as $key => $value)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $value->name }}</td>
                                        <td>{{ $value->code }}</td>
                                        <td style="background-color:{{ $value->code }}"></td>
                                        <td>{{ convert_datetime_to_date_format($value->created_at, 'd M Y') }}</td>
                                        <td class="text-right">
                                            <a href="{{ route('admin.colors.edit',$value->id) }}" class="btn btn-outline-success btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edit Page">
											  <i class="ri-edit-box-line"></i>
											</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="pagination">
                                {{ $color_list->appends(request()->input())->links() }}
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
		</div>

    </div>
</div>
@endsection

