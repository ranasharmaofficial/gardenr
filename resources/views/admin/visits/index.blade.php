@extends('admin.include.master')
@section('title', 'Doctor Visit List')
@section('content')
<!-- Page Header -->
<div style="background:linear-gradient(45deg, #f33057, rgb( 56, 88, 249 ) );"  class="d-sm-flex d-block align-items-center justify-content-between page-header-breadcrumb">
    <div>
        <h4 class="fw-medium mb-2">Doctor Visit List</h4>
        <div class="ms-sm-1 ms-0">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Doctor Visit List</a></li>
                    <li class="breadcrumb-item active fw-normal" aria-current="page">Doctor Visit List List</li>
                </ol>
            </nav>
        </div>
    </div>

</div>
<!-- Page Header Close -->

<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <a class="btn btn-primary float-right" href="{{ url('admin/visits/create') }}">Add Doctor Visit</a>
                    <div class="breadcrumb mt-3 border-bottom pb-2">
                        <a href="{{ url('') }}"><i class="fa fa-home" aria-hidden="true"></i> Home</a>/Doctor Visit List
                    </div>
                </div>
            </div>
        </div>
<div class="main-content app-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table">
                    <div class="card-body booking_card">

                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="card-title float-left mt-2">Doctor Visit List</h4>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table id="hotel_table" class="table table-stripped table-bordered table-hover table-center mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Mobile</th>
                                        <th>Email</th>
                                        <th>Expertise</th>
                                        <th>Experience</th>
                                        <th>Picture</th>
                                        <th>Visit Date</th>
                                        <th>Visit Time</th>
                                        <th>Remarks</th>
                                        <th>Created At</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($staffs as $key => $value)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $value->first_name }}</td>
                                        <td>{{ $value->mobile }}</td>
                                        <td>{{ $value->email }}</td>
                                        <td>{{ $value->expertise }}</td>
                                        <td>{{ $value->experience }}</td>
                                        <td><img src="{{ static_asset($value->picture) }}" height="100" width="100"></td>
                                        <td>{{ $value->visit_date }}</td>
                                        <td>{{ $value->visit_time }}</td>
                                        <td>{{ $value->remarks }}</td>
                                       <td>{{ convert_datetime_to_date_format($value->created_at, 'd M Y') }}</td>
                                         
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="pagination">
                                {{ $staffs->appends(request()->input())->links() }}
                            </div>

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

