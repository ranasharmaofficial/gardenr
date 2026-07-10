@extends('admin.include.master')
@section('title', 'Career Enquiry List')
@section('content')

<!-- Page Header -->
<div style="background:linear-gradient(45deg, #f33057, rgb( 56, 88, 249 ) );"  class="d-sm-flex d-block align-items-center justify-content-between page-header-breadcrumb">
    <div>
        <h4 class="fw-medium mb-2">Career Enquiry</h4>
        <div class="ms-sm-1 ms-0">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Career Enquiry</a></li>
                    <li class="breadcrumb-item active fw-normal" aria-current="page">Career Enquiry List</li>
                </ol>
            </nav>
        </div>
    </div>

</div>
<!-- Page Header Close -->

<!--APP-CONTENT START-->
<div class="main-content app-content">
    <div class="container-fluid">
    <!-- Start:: row-2 -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header">
                    <div class="card-title">
                        Career Enquiry
                    </div>
                </div>
                <div class="card-body">

                    <table id="responsiveDataTable" class="table table-bordered text-nowrap mt-3" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Contct</th>
                                <th>Apply For</th>
                                <th>Resume</th>
                                <th>Message</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($enquiries as $key => $value)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $value->first_name.' '.$value->last_name }}</td>
                                    <td>{{ $value->email }}</td>
                                    <td>{{ $value->phone }}</td>
                                    <td>{{ $value->apply_for }}</td>
                                    <td>
                                        @if($value->resume)
                                            <a class="btn btn-success" target="_blank" href="{{ static_asset('uploads/resume/'.$value->resume) }}">View Resume</a>
                                        @endif
                                    </td>
                                    <td>{{ $value->message }}</td>
                                    <td>{{ convert_datetime_to_date_format($value->created_at, 'd M Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- End:: row-2 -->



    </div>
</div>
<!--APP-CONTENT CLOSE-->

@endsection

