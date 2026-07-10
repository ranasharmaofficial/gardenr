@extends('admin.include.master')
@section('title', 'Attendance Report')

@section('content')

    <div style="background:linear-gradient(45deg,#f33057,rgb(56,88,249));"
        class="d-sm-flex d-block align-items-center justify-content-between page-header-breadcrumb">
        <div>
            <h4 class="fw-medium mb-2">Attendance Calendar</h4>
        </div>
    </div>

    <div class="main-content app-content">
        <div class="content container-fluid">

            <div class="card custom-card">

                <div class="card-header">
                    <h5 class="mb-0">Monthly Attendance</h5>
                </div>

                <div class="card-body">

                    <form class="row mb-3">

                        <div class="col-md-3">
                            <select name="Month" class="form-control">
                                @for($m = 1; $m <= 12; $m++)
                                    <option value="{{ sprintf('%02d', $m) }}" {{ sprintf('%02d', $m) == $month ? 'selected' : '' }}>
                                        {{ date('F', mktime(0, 0, 0, $m, 1)) }}
                                    </option>
                                @endfor
                            </select>
                        </div>

                        <div class="col-md-3">
                            <select name="Year" class="form-control">
                                @for($y = date('Y') - 2; $y <= date('Y') + 1; $y++)
                                    <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>{{ $y }}</option>
                                @endfor
                            </select>
                        </div>

                        <div class="col-md-2">
                            <button class="btn btn-primary">Search</button>
                        </div>

                    </form>

                    <div class="mb-2">
                        <span class="badge bg-success">P</span> Present
                        <span class="badge bg-danger ms-2">A</span> Absent
                        <span class="ms-2">- No Entry
                    </div>

                    <div class="table-responsive" style="max-height:70vh">

                        <table class="table table-bordered text-center small">

                            <thead class="bg-light sticky-top">
                                <tr>
                                    <th style="min-width:160px">Name</th>

                                    @for($d = 1; $d <= $daysInMonth; $d++)
                                        <th>{{ $d }}</th>
                                    @endfor
                                    <th style="min-width:90px;">
                                    <span class="text-success fw-bold">T P</span><br>
                                </th>

                                <th style="min-width:90px; ">
                                    <span class="text-danger fw-bold">T A</span><br>
                                </th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach($users as $user)
                                        @php
                                        $present = 0;
                                        $absent = 0;
                                        @endphp
                                    <tr>

                                        <td style="font-weight:600;color:#b30000;white-space:nowrap">
                                            {{ strtoupper($user->first_name . ' ' . $user->last_name) }}
                                        </td>

                                        @for($d = 1; $d <= $daysInMonth; $d++)

                                            @php
                                                $date = $year . '-' . $month . '-' . sprintf('%02d', $d);
                                                $cellDate = \Carbon\Carbon::parse($date)->startOfDay();
                                                $today = now()->startOfDay();

                                                $att = $user->attendances->firstWhere('date', $date);

                                                $nowTime = now();
                                                $officeTime = $user->in_time
                                                    ? \Carbon\Carbon::createFromFormat('H:i:s', $user->in_time)
                                                    : null;
                                            @endphp

                                            <td @if($cellDate->isToday()) style="background:#e8f3ff" @endif>

                                                @if($cellDate->gt($today))
                                                    -

                                                @elseif($cellDate->isSunday())
                                                    -

                                                @elseif($att && $att->check_in)
                                                    @php $present++; @endphp
                                                    <span class="text-success fw-bold">P</span>
                                                @elseif($cellDate->isToday() && $officeTime && $nowTime->lt($officeTime))
                                                    -

                                                @elseif($cellDate->isToday() && $officeTime && $nowTime->gte($officeTime))
                                                    @php $absent++; @endphp
                                                    <span class="text-danger fw-bold">A</span>

                                                @else
                                                     @php $absent++; @endphp

                                                    <span class="text-danger fw-bold">A</span>
                                                @endif

                                            </td>

                                        @endfor
                                        <td class="fw-bold text-success">{{ $present }}</td>
                                    <td class="fw-bold text-danger">{{ $absent }}</td>


                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                </div>
            </div>

        </div>
    </div>

@endsection