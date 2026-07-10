@extends('admin.include.master')
@section('title', 'Attendance Users')

@section('content')
<style>
    .group-header{
        background:#d794ea !important;
        color:#fff;
        font-size:15px;
        letter-spacing:1px;
    }
</style>
    <div style="background:linear-gradient(45deg,#f33057,rgb(56,88,249));"
        class="d-sm-flex d-block align-items-center justify-content-between page-header-breadcrumb">
        <div>
            <h4 class="fw-medium mb-2">Attendance</h4>
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Attendance</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="main-content app-content">
        <div class="content container-fluid">

            <div class="card custom-card">
                <div class="card-header">
                    <div class="card-title">Attendance List</div>
                </div>

                <div class="card-body">

                    <form method="GET" class="row g-2 mb-3">
                        <div class="col-md-3">
                            <input type="date" name="date" value="{{ request('date', now()->toDateString()) }}"
                                class="form-control">
                        </div>
                        <div class="col-md-3">
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search Name"
                                class="form-control">
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-primary">Search</button>
                        </div>
                    </form>
                    <table class="table table-bordered table-hover">

    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Code</th>
            <th>Status</th>
            <th>IN time</th>
            <th>Check In</th>
            <th>Check Out</th>
            <th>Mark</th>
        </tr>
    </thead>

    <tbody>

@foreach($users as $typeId => $group)

    {{-- Group Header --}}
    @php
        $typeName = App\Models\UserType::where('id', $typeId)->value('name');
    @endphp
    <tr style="font-weight:600">
        <td colspan="8" style="background:#d7aae3 !important;color:#fff;" class="text-center group-header">
            USER TYPE : {{ $typeName }} ({{ count($group) }} users)
        </td>
    </tr>

    @foreach($group as $k => $user)

        @php $att = $user->attendances->first(); @endphp

        <tr>
            <td>{{ $k + 1 }}</td>
            <td>{{ strtoupper($user->first_name.' '.$user->last_name) }}</td>
            <td>{{ $user->employee_code }}</td>

            <td>{{ $att->status ?? '-' }}</td>

            <td>
                {{ $user->in_time ? \Carbon\Carbon::parse($user->in_time)->format('h:i A') : '-' }}
            </td>

            <td class="text-danger text-center">
                {{ $att?->check_in ? \Carbon\Carbon::parse($att->check_in)->format('h:i A') : '-' }}
            </td>

            <td>
                {{ $att?->check_out ? \Carbon\Carbon::parse($att->check_out)->format('h:i A') : '-' }}
            </td>

            <td>
                <button
                    onclick="openAttendance({{ $user->id }},{{ $att && !$att->check_out ? 1 : 0 }})"
                    class="btn btn-sm
                        @if(!$att) btn-info
                        @elseif(!$att->check_out) btn-warning
                        @else btn-success
                        @endif">

                    @if(!$att) Mark
                    @elseif(!$att->check_out) Checked In
                    @else Done
                    @endif
                </button>
            </td>
        </tr>

    @endforeach

@endforeach

</tbody>
</table>
                    @if(false)
                    <table class="table table-bordered table-hover">

                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Code</th>
                                <th>Status</th>
                                <th>IN time</th>
                                <th>Check In</th>
                                <th>Check Out</th>
                                <th>Mark</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach($users as $k => $user)
                                @php $att = $user->attendances->first();
                            @endphp

                                <tr>
                                    <td>{{ $k + 1 }}</td>
                                    <td>{{ strtoupper($user->first_name . ' ' . $user->last_name) }}</td>
                                    <td>{{ $user->employee_code }}</td>

                                    <td>{{ $att->status ?? '-' }}</td>
                                    <td>{{ $user->in_time ? \Carbon\Carbon::parse($user->in_time)->format('h:i A') : '-' }}</td>

                                    <td class="text-center text-danger">
                                        {{ $att?->check_in ? \Carbon\Carbon::parse($att->check_in)->format('h:i A') : '-' }}
                                    </td>
                                    <td>{{ $att?->check_out ? \Carbon\Carbon::parse($att->check_out)->format('h:i A') : '-' }}</td>

                                    <td>
                                        <button onclick="openAttendance({{ $user->id }},{{ $att && !$att->check_out ? 1 : 0 }})"
                                            class="btn btn-sm
                                                @if(!$att) btn-info
                                                @elseif($att && !$att->check_out) btn-warning
                                                @else btn-success
                                                @endif">
                                            @if(!$att) Mark Attendance
                                            @elseif($att && !$att->check_out) Checked In
                                            @else Completed
                                            @endif
                                        </button>
                                    </td>

                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    @endif

                </div>
            </div>

        </div>
    </div>

    <div class="modal fade" id="attendanceModal">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h5>Attendance</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body text-center">

                    <input type="hidden" id="modal_user_id">
                    <input type="hidden" id="modalPhoto">
                    <input type="hidden" id="modalLat">
                    <input type="hidden" id="modalLng">
                    <input type="hidden" id="modalAddress">
                    <input type="hidden" id="modalCheckoutAddress">


                    <video id="modalVideo" autoplay muted playsinline style="width:100%;max-height:280px;object-fit:cover;border-radius:10px"></video>
                    <canvas id="modalCanvas" style="display:none"></canvas>
                    <img id="modalPreview"style="display:none;width:100%;max-height:280px;object-fit:cover;border-radius:10px">

                    <div id="modalAddressText" class="alert alert-info mt-2">Fetching...</div>

                    <button id="modalCapture" class="btn btn-warning mt-2" disabled>Capture</button>
                    <button id="modalCancel" class="btn btn-secondary mt-2" style="display:none">Cancel</button>

                    <br><br>

                    <button id="modalCheckin" class="btn btn-success" disabled>Check In</button>
                    <button id="modalCheckout" class="btn btn-danger" style="display:none" disabled>Check Out</button>

                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
<script>

let stream = null;

function openAttendance(id, isCheckout) {

    $('#attendanceModal').modal('show');
    modal_user_id.value = id;

    resetModal();

    navigator.mediaDevices.getUserMedia({ video: true }).then(s => {
        stream = s;
        modalVideo.srcObject = s;
        modalVideo.play();
    });

    if (isCheckout == 1) {

    modalCheckin.style.display = 'none';
    modalCheckout.style.display = 'inline-block';

    modalAddressText.innerHTML = "Fetching checkout location...";

    modalPhoto.value = '';
    modalCapture.disabled = true;

    navigator.geolocation.getCurrentPosition(p => {

        fetch(`{{ url('admin/reverse-geocode') }}?lat=${p.coords.latitude}&lng=${p.coords.longitude}`)
        .then(r=>r.json())
        .then(d=>{

            let a=[];
            if(d.address.suburb) a.push(d.address.suburb);
            if(d.address.city) a.push(d.address.city);
            if(d.address.state) a.push(d.address.state);
            if(d.address.country) a.push(d.address.country);

            let addr=a.join(', ');

            modalCheckoutAddress.value = addr;

            modalAddressText.innerHTML="<b>Checkout Location:</b><br>"+addr;

            modalCapture.disabled=false;
        });

    });

    return;
}


    modalCheckin.style.display = 'inline-block';
    modalCheckout.style.display = 'none';

    navigator.geolocation.getCurrentPosition(p => {

        modalLat.value = p.coords.latitude;
        modalLng.value = p.coords.longitude;

        fetch(`{{ url('admin/reverse-geocode') }}?lat=${p.coords.latitude}&lng=${p.coords.longitude}`)
        .then(r => r.json())
        .then(d => {

            let a=[];
            if(d.address.suburb) a.push(d.address.suburb);
            if(d.address.city) a.push(d.address.city);
            if(d.address.state) a.push(d.address.state);
            if(d.address.country) a.push(d.address.country);

            let addr = a.join(', ');

            modalAddress.value = addr;
            modalAddressText.innerHTML = "<b>Location:</b><br>"+addr;

            modalCapture.disabled = false;
        });

    });

}

function resetModal(){

    modalPhoto.value = '';

    modalPreview.style.display = 'none';
    modalVideo.style.display = 'block';

    modalCapture.style.display = 'inline-block';
    modalCancel.style.display = 'none';

    modalCheckin.disabled = true;
    modalCheckout.disabled = true;

    modalCapture.disabled = true;
    modalAddressText.innerHTML = 'Fetching...';
}

modalCapture.onclick = function(){

    modalCanvas.width = modalVideo.videoWidth;
    modalCanvas.height = modalVideo.videoHeight;

    modalCanvas.getContext('2d').drawImage(modalVideo,0,0);

    let img = modalCanvas.toDataURL('image/png');

    modalPhoto.value = img;

    modalPreview.src = img;
    modalPreview.style.display='block';
    modalVideo.style.display='none';

    stream.getTracks().forEach(t=>t.stop());

    modalCapture.style.display='none';
    modalCancel.style.display='inline-block';

    if(modalCheckout.style.display=='inline-block'){
        modalCheckout.disabled=false;
    }else{
        modalCheckin.disabled=false;
    }
}

modalCancel.onclick=function(){

    modalPreview.style.display='none';
    modalVideo.style.display='block';

    modalCapture.style.display='inline-block';
    modalCancel.style.display='none';

    navigator.mediaDevices.getUserMedia({video:true}).then(s=>{
        stream=s;
        modalVideo.srcObject=s;
        modalVideo.play();
    });
}
modalCheckin.onclick = function(){

    $.ajax({
        url: "{{ url('admin/attendance/checkin') }}",
        type: "POST",
        data: {
            _token: "{{ csrf_token() }}",
            user_id: modal_user_id.value,
            photo: modalPhoto.value,
            latitude: modalLat.value,
            longitude: modalLng.value,
            address: modalAddress.value
        },

        success:function(res){

            if(res.status === 'error'){

                Swal.fire({
                    icon: 'error',
                    title: 'Oops!',
                    text: res.message,
                });

                return;
            }

            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: res.message,
                timer: 1500,
                showConfirmButton: false
            }).then(() => {
                location.reload();
            });

        },

        error:function(){
            Swal.fire({
                icon: 'error',
                title: 'Server Error',
                text: 'Something went wrong'
            });
        }
    });

}


modalCheckout.onclick = function(){

    if(!modalPhoto.value){
        Swal.fire('Error','Please capture checkout photo','error');
        return;
    }

    navigator.geolocation.getCurrentPosition(function(pos){

        $.ajax({
            url: "{{ url('admin/attendance/checkout') }}",
            type: "POST",
            dataType: "json",
            data:{
                _token:"{{ csrf_token() }}",
                user_id: modal_user_id.value,
                photo: modalPhoto.value,
                latitude: pos.coords.latitude,
                longitude: pos.coords.longitude,
                checkout_address: modalCheckoutAddress.value
            },

            success:function(res){

                if(res.status === 'error'){
                    Swal.fire('Error',res.message,'error');
                    return;
                }

                Swal.fire({
                    icon:'success',
                    title:'Success',
                    text:res.message,
                    timer:1500,
                    showConfirmButton:false
                }).then(()=>location.reload());

            },

            error:function(){
                Swal.fire('Server Error','Something went wrong','error');
            }
        });

    },function(){
        Swal.fire('Error','Location permission denied','error');
    });

}


</script>
@endsection
