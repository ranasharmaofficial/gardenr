@extends('admin.include.master')
@section('title', 'Tenders List')
@section('content')
<!-- Page Header -->
<div style="background:linear-gradient(45deg, #f33057, rgb( 56, 88, 249 ) );"  class="d-sm-flex d-block align-items-center justify-content-between page-header-breadcrumb">
    <div>
        <h4 class="fw-medium mb-2">Tenders List</h4>
        <div class="ms-sm-1 ms-0">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Tenders List</a></li>
                    <li class="breadcrumb-item active fw-normal" aria-current="page">Tenders List</li>
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
                    <a class="btn btn-primary float-right" href="{{ url('admin/visits/create') }}">Add Tender</a>
                    <div class="breadcrumb mt-3 border-bottom pb-2">
                        <a href="{{ url('') }}"><i class="fa fa-home" aria-hidden="true"></i> Home</a>/Tenders List
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
                                <h4 class="card-title float-left mt-2">Tenders List</h4>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table id="hotel_table" class="table table-stripped table-bordered table-hover table-center mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Details</th>
                                        <th>File</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($allTenders as $key => $value)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $value->title }}</td>
                                        <td>{{ $value->details }}</td>
                                        <td><a href="{{ static_asset('uploads/tender/'.$value->upload) }}" class="btn btn-primary">Download File</a></td>
                                        <td>{{ date('d M, Y', strtotime($value->uploaddate)) }}</td>
                                        <td><a class="btn btn-danger btn-sm" href="{{ route('admin.tenders.edit',$value->id) }}">Edit</a></td>
                                         
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="pagination">
                                {{ $allTenders->appends(request()->input())->links() }}
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

