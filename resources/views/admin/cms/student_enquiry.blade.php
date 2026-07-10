@extends('admin.include.master')
@section('title', 'Home Page Enquiry List')
@section('content')

<!-- Page Header -->
<div style="background:linear-gradient(45deg, #f33057, rgb( 56, 88, 249 ) );" class="d-sm-flex d-block align-items-center justify-content-between page-header-breadcrumb">
    <div>
        <h4 class="fw-medium mb-2">Home Page Enquiry</h4>
        <div class="ms-sm-1 ms-0">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Home Page Enquiry</a></li>
                    <li class="breadcrumb-item active fw-normal" aria-current="page">Home Page Enquiry List</li>
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
                        Home Page Enquiry
                    </div>
                </div>
                <div class="card-body">

                    <table id="responsiveDataTable" class="table table-bordered text-nowrap mt-3" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Message</th>

                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($online_enquiry as $key => $value)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $value->first_name.' '.$value->last_name }}</td>
                                <td>{{ $value->email }}</td>
                                <td>{{ $value->phone }}</td>
                                <td>{{ $value->message }}</td>
                                <td>{{ date('d M Y', strtotime($value->created_at)) }}</td>
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

