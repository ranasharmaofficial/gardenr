@extends('admin.include.master')
@section('title', 'SMS List')
@section('content')

<style>
    table.table-bordered td,
    table.table-bordered th {
        border: 1px solid #dee2e6 !important;
    }
</style>

<div style="background:linear-gradient(45deg, #f33057, rgb(56, 88, 249));"
     class="d-sm-flex d-block align-items-center justify-content-between page-header-breadcrumb">
    <div>
        <h4 class="fw-medium mb-2">{{ $page_title }}</h4>
        <div class="ms-sm-1 ms-0">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="javascript:void(0);">{{ $page_title }}</a>
                    </li>
                    <li class="breadcrumb-item active fw-normal">
                        SMS
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="main-content app-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="card-title">SMS List</h5>
                    </div>

                    <div class="card-body booking_card">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Membership No</th>
                                        <th>Message</th>
                                        <th>Sent By</th>
                                        <th>Sent Date</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse($messages as $key => $sms)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $sms->membership_number ?? '-' }}</td>
                                            <td>{{ $sms->messages }}</td>
                                            <td>{{ $sms->user->name ?? '-' }}</td>
                                            <td>{{ $sms->created_at->format('d-m-Y h:i A') }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center text-danger">
                                                No SMS records found
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>

                            <div class="mt-3">
                                {{ $messages->links() }}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
