@extends('admin.include.master')
@section('title', 'Call Details')

@section('content')

    <div style="background:linear-gradient(45deg,#f33057,rgb(56,88,249));"
        class="d-sm-flex d-block align-items-center justify-content-between page-header-breadcrumb">

        <div>
            <h4 class="fw-medium mb-2">Call Details</h4>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ url('/admin/call-member-list') }}">Members</a>
                </li>
                <li class="breadcrumb-item active">
                    {{ $member->name }}
                </li>
            </ol>
        </div>

    </div>

    <div class="main-content app-content">
        <div class="container-fluid">

            <div class="card mt-3">
                <div class="card-body">
                    <div class="row">

                        <div class="col-md-4">
                            <strong>Name</strong>
                            <p class="mb-0">{{ $member->name }}</p>
                        </div>

                        <div class="col-md-4">
                            <strong>Mobile</strong>
                            <p class="mb-0">{{ $member->mobile }}</p>
                        </div>

                        <div class="col-md-4">
                            <strong>Address</strong>
                            <p class="mb-0">{{ $member->address }}</p>
                        </div>

                    </div>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header">
                    <h5 class="mb-0">Call History</h5>
                </div>

                <div class="card-body table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Start Time</th>
                                <th>End Time</th>
                                <th>Duration</th>
                                <th>Remarks</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($calls as $k => $c)
                                <tr>
                                    <td>{{ $calls->firstItem() + $k }}</td>
                                    <td>{{ \Carbon\Carbon::parse($c->call_start_time)->format('d-m-Y h:i A') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($c->call_end_time)->format('d-m-Y h:i A') }}</td>
                                    <td>
                                        <span class="badge bg-info">
                                            {{ gmdate('i:s', $c->call_duration) }}
                                        </span>
                                    </td>
                                    <td style="white-space: normal;">
                                        {{ $c->remarks }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-danger">
                                        No call records found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-3">
                        {{ $calls->links() }}
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection