@extends('admin.include.master')
@section('title', 'Country List')
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
                Country List
              </li>
            </ol>
            <!-- Breadcrumb ends -->


          </div>

        <div class="app-body">
			<div class="row gx-3">
            <div class="col-md-12">
                <div class="card card-table">
					<div class="card-header d-flex align-items-center justify-content-between">
						<h5 class="card-title">Country</h5>
						{{--<a href="{{ url('admin/specialities/create') }}" class="btn btn-primary ms-auto">Add Speciality</a>--}}
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
                                        <th>Country Code</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($country as $key => $value)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $value->country_name }}</td>
                                        <td>{{ $value->country_code }}</td>
                                         
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            

                        </div>

                    </div>
                </div>
            </div>
        </div>
		</div>

    </div>
</div>
@endsection

