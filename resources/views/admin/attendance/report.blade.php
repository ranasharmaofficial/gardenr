@extends('admin.include.master')
@section('title', 'Attendance Report')

@section('content')

    <div style="background:linear-gradient(45deg,#f33057,rgb(56,88,249));"
        class="d-sm-flex d-block align-items-center justify-content-between page-header-breadcrumb">

        <div>
            <h4 class="fw-medium mb-2">Attendance Report</h4>
        </div>

    </div>

    <div class="main-content app-content">
        <div class="content container-fluid">

            <div class="card custom-card">

                <div class="card-header">
                    <h5>Attendance Date : {{ \Carbon\Carbon::parse($date)->format('d-m-Y') }}</h5>
                </div>

                <div class="card-body">

                    <form method="GET" class="row g-2 mb-3">

                        <div class="col-md-3">
                            <input type="date" name="date" value="{{ $date }}" class="form-control">
                        </div>

                        <div class="col-md-2">
                            <button class="btn btn-primary">Search</button>
                        </div>

                    </form>

                    <div class="table-responsive">

                        <table class="table table-bordered table-hover text-center">

                            <thead class="bg-light">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Code</th>
                                    <th>Status</th>
                                    <th>Check In</th>
                                    <th>Check Out</th>
                                    <th>CheckIn Address</th>
                                    <th>CheckOut Address</th>
                                    <th>In Photo</th>
                                    <th>Out Photo</th>
                                    <th>Working Hr</th>
                                </tr>
                            </thead>

                            <tbody>

                                @forelse($attendances as $k => $att)

                                    <tr>
                                        <td>{{ $k + 1 }}</td>

                                        <td style="color:#b30000;font-weight:600">
                                            {{ strtoupper($att->user->first_name . ' ' . $att->user->last_name) }}
                                        </td>

                                        <td>{{ $att->user->employee_code }}</td>

                                        <td>
                                            @if($att->status == 'late')
                                                <span class="badge bg-danger">Late</span>
                                            @else
                                                <span class="badge bg-success">On Time</span>
                                            @endif
                                        </td>

                                        <td class="text-primary">
                                            {{ \Carbon\Carbon::parse($att->check_in)->format('h:i A') }}
                                        </td>

                                        <td class="text-danger">
                                            {{ $att->check_out ? \Carbon\Carbon::parse($att->check_out)->format('h:i A') : '-' }}
                                        </td>
                                       <td style="color:#b30000;font-weight:600">
                                            {{ strtoupper($att->address) }}
                                        </td>  
                                                                             <td style="color:#b30000;font-weight:600">
                                            {{ strtoupper($att->checkout_address) }}
                                        </td>
                                        <td>
                                            @if($att->checkin_photo)
                                                <a href="{{ url('public/storage/' . $att->checkin_photo) }}" target="_blank">
                                                    <img src="{{ url('public/storage/' . $att->checkin_photo) }}"
                                                        style="width:150px;height:150px;border-radius:6px;border:1px solid #ddd">
                                                </a>
                                            @else
                                                
                                            @endif
                                        </td>

                                        <td>
                                            @if($att->checkout_photo)
                                                <a href="{{ url('public/storage/' . $att->checkout_photo) }}" target="_blank">
                                                    <img src="{{ url('public/storage/' . $att->checkout_photo) }}"
                                                        style="width:150px;height:150px;border-radius:6px;border:1px solid #ddd">
                                                </a>
                                            @else
                                                -
                                            @endif
                                        </td>

                                        <td>
                                            @if($att->working_minutes)
                                                {{ round($att->working_minutes / 60, 2) }} Hr
                                            @else
                                                -
                                            @endif
                                        </td>

                                    </tr>

                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center">No Attendance Found</td>
                                    </tr>
                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>
            </div>

        </div>
    </div>

@endsection