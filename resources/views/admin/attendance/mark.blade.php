@extends('admin.include.master')
@section('title', 'Mark Attendance')

@section('content')

    <div style="background:linear-gradient(45deg,#f33057,rgb(56,88,249));"
        class="d-sm-flex d-block align-items-center justify-content-between page-header-breadcrumb">
        <div>
            <h4 class="fw-medium mb-2">Attendance</h4>
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active"><a href="{{ url('admin/users') }}">Users</a></li>
                    <li class="breadcrumb-item active">Attendance</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="main-content app-content">
        <div class="content container-fluid">

            <div class="row">

                <div class="col-md-6">

                    <div class="card custom-card">
                        <div class="card-header">
                            <div class="card-title">{{ $user->first_name }} {{ $user->last_name }}</div>
                        </div>

                        <div class="card-body text-center">

                            @if(!$attendance)

                                <form method="POST" action="{{ url('admin/attendance/checkin') }}">
                                    @csrf

                                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                                    <input type="hidden" name="photo" id="photo">
                                    <input type="hidden" name="latitude" id="lat">
                                    <input type="hidden" name="longitude" id="lng">
                                    <input type="hidden" name="address" id="address">

                                    <video id="video" autoplay muted playsinline width="100%" class="rounded"></video>
                                    <canvas id="canvas" style="display:none"></canvas>
                                    <img id="preview" style="display:none;width:100%" class="rounded" />

                                    <div id="liveAddress" class="alert alert-info mt-2">Fetching location...</div>

                                    <button type="button" id="captureBtn" onclick="capture()" class="btn btn-warning mt-2"
                                        disabled>Capture</button>

                                    <button type="button" id="cancelBtn" onclick="cancelPhoto()" style="display:none"
                                        class="btn btn-secondary mt-2">Cancel</button>

                                    <br><br>

                                    <button class="btn btn-success" id="checkinBtn" disabled>Check In</button>

                                </form>

                            @elseif($attendance && !$attendance->check_out)

                                <form method="POST" action="{{ url('admin/attendance/checkout') }}">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                                    <button class="btn btn-danger">Check Out</button>
                                </form>

                            @else
                                <div class="alert alert-success">Today Attendance Completed</div>
                            @endif

                        </div>
                    </div>

                </div>

                <div class="col-md-6">

                    <div class="card custom-card">
                        <div class="card-header">
                            <div class="card-title">Today Summary</div>
                        </div>

                        <div class="card-body">

                            @if($attendance)

                                <div class="row g-2">

                                    <div class="col-6">
                                        <div class="alert alert-light">Date<br><b>{{ $attendance->date }}</b></div>
                                    </div>

                                    <div class="col-6">
                                        <div class="alert alert-light">Status<br>
                                            @if($attendance->status == 'late')
                                                <span class="badge bg-danger">Late</span>
                                            @else
                                                <span class="badge bg-success">On Time</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="alert alert-light">Check In<br><b>{{ $attendance->check_in }}</b></div>
                                    </div>
                                    <div class="col-6">
                                        <div class="alert alert-light">Check Out<br><b>{{ $attendance->check_out ?? '-' }}</b>
                                        </div>
                                    </div>

                                    @if($attendance->working_minutes)
                                        <div class="col-12">
                                            <div class="alert alert-light">
                                                Working Hours<br><b>{{ round($attendance->working_minutes / 60, 2) }} Hr</b>
                                            </div>
                                        </div>
                                    @endif

                                    @if($attendance->checkin_photo)
                                        <div class="col-12 text-center">
                                            <img src="{{ url('public/storage/' . $attendance->checkin_photo) }}"
                                                style="max-width:280px;border-radius:10px;border:1px solid #ddd;padding:5px">
                                        </div>
                                    @endif

                                    <div class="col-12">
                                        <div class="alert alert-light">
                                            <b>Location:</b><br>
                                            {{ $attendance->address ?? 'N/A' }}
                                        </div>
                                    </div>

                                </div>

                            @else
                                No Attendance Today
                            @endif

                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>

        let video = document.getElementById('video');
        let preview = document.getElementById('preview');
        let canvas = document.getElementById('canvas');
        let captureBtn = document.getElementById('captureBtn');
        let cancelBtn = document.getElementById('cancelBtn');

        @if(!$attendance)
            navigator.mediaDevices.getUserMedia({ video: true }).then(s => {
                video.srcObject = s; video.play(); window.stream = s;
            });
        @endif

            function capture() {
                canvas.width = video.videoWidth;
                canvas.height = video.videoHeight;
                canvas.getContext('2d').drawImage(video, 0, 0);
                let img = canvas.toDataURL('image/png');
                photo.value = img;
                preview.src = img; preview.style.display = 'block';
                window.stream.getTracks().forEach(t => t.stop());
                video.style.display = 'none';
                captureBtn.style.display = 'none';
                cancelBtn.style.display = 'inline-block';
            }

        function cancelPhoto() {
            preview.style.display = 'none';
            video.style.display = 'block';
            captureBtn.style.display = 'inline-block';
            cancelBtn.style.display = 'none';
            navigator.mediaDevices.getUserMedia({ video: true }).then(s => {
                video.srcObject = s; video.play(); window.stream = s;
            });
        }

        navigator.geolocation.getCurrentPosition(function (p) {

            lat.value = p.coords.latitude;
            lng.value = p.coords.longitude;

            fetch(`{{ url('admin/reverse-geocode') }}?lat=${p.coords.latitude}&lng=${p.coords.longitude}`)
                .then(res => res.json())
                .then(data => {
                    if (data.address) {
                        let addr = [];
                        if (data.address.suburb) addr.push(data.address.suburb);
                        if (data.address.city) addr.push(data.address.city);
                        if (data.address.state) addr.push(data.address.state);
                        if (data.address.country) addr.push(data.address.country);

                        liveAddress.innerHTML = "<b>Live Location:</b><br>" + addr.join(', ');
                        address.value = addr.join(', ');
                        checkinBtn.disabled = false;
                        captureBtn.disabled = false;

                    }
                });

        }, function () {
            alert('Allow browser location');
        });

    </script>
@endsection