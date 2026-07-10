@extends('admin.include.master')
@section('title')
    {{ $page_title }}
@endsection

@section('content')

<!-- Page Header -->
<div style="background:linear-gradient(45deg, #f33057, rgb( 56, 88, 249 ) );"
     class="d-sm-flex d-block align-items-center justify-content-between page-header-breadcrumb">
    <div>
        <h4 class="fw-medium mb-2">{{ $page_title }}</h4>
        <div class="ms-sm-1 ms-0">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active fw-normal" aria-current="page">{{ $page_title }}</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- Page Header Close -->

<div class="main-content app-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-xl-12">
                <div class="card custom-card">

                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">{{ $page_title }}</h5>
                        <a href="{{ url('admin/notice-list') }}" class="btn btn-danger btn-sm float-end">
                            Notice List
                        </a>
                    </div>

                    <div class="card-body">

                        <div class="container">
                            <form id="update-notice-form" enctype="multipart/form-data">
                                @csrf

                                <div class="row">

                                   

                                    {{-- Type --}}
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label>Type <span class="text-danger">*</span></label>
                                            <select class="form-control" name="type" id="notice_type">
                                                <option value="">Select Type</option>
                                                @foreach($type as $val)
                                                    <option value="{{ $val }}" @if($notice->type == $val) selected @endif>
                                                        {{ $val }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    {{-- Title --}}
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label>Notice Title <span class="text-danger">*</span></label>
                                            <input type="text"
                                                   value="{{ $notice->title }}"
                                                   name="title"
                                                   id="notice_title"
                                                   class="form-control"
                                                   placeholder="Notice Title">
                                        </div>
                                    </div>

                                    {{-- File --}}
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label>Notice File</label>
                                            <input type="file" name="file" id="notice_file" class="form-control">

                                           @if($notice->file)
											<a target="_blank" class="btn btn-primary btn-sm mt-3"
											href="{{ asset('public/'.$notice->file) }}">
												Check Current File
											</a>
										@endif

                                        </div>
                                    </div>

                                    {{-- Status --}}
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label>Status <span class="text-danger">*</span></label>
                                            <select id="notice_status" name="status" class="form-control">
                                                <option value="1" @if($notice->status == 1) selected @endif>Active</option>
                                                <option value="0" @if($notice->status == 0) selected @endif>Inactive</option>
                                            </select>
                                        </div>
                                    </div>

                                    {{-- Submit --}}
                                    <div class="col-md-3">
                                        <div class="form-group mt-4">
                                            <button class="btn btn-success" id="updateNoticeBtn" type="submit">
                                                Update
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>

                    </div>

                </div>
            </div>
        </div>

    </div>
</div>

<script>
    $(document).on('submit', '#update-notice-form', function (e) {
        e.preventDefault();

        let id = {{ $notice->id }};
        let btn = $("#updateNoticeBtn");

        // reset errors
        $('.errorMsgntainer').html('');
        $('#show-notice-form-error').hide();

        btn.prop('disabled', true).text("Updating...");

        let formData = new FormData(this);

        $.ajax({
            type: "POST",
            url: "{{ url('admin/noticeList/update') }}/" + id,
            data: formData,
            processData: false,
            contentType: false,
            dataType: "JSON",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

             success: function(res) {
    btn.prop('disabled', false).text("Update");

    if (res.status == true) {
        Swal.fire({
            icon: "success",
            title: "Updated!",
            text: res.message,
            timer: 1500,
            showConfirmButton: false
        });

        setTimeout(() => {
            window.location.href = "{{ url('admin/notice-list') }}";
        }, 1500);

    } else {
        Swal.fire({
            icon: "error",
            title: "Oh No!",
            text: res.message ?? "Something went wrong!",
            showConfirmButton: true
        });
    }
},

error: function(err) {
    btn.prop('disabled', false).text("Update");

    $('#show-notice-form-error').show();   
    $('.errorMsgntainer').html('');      

    let errors = err.responseJSON?.errors;
    if (errors) {
        $.each(errors, function(index, value) {
            $('.errorMsgntainer').append('<div class="text-danger">' + value + '</div>');
        });

        Swal.fire({
            icon: "warning",
            title: "Validation Error!",
            text: "Please fill all required fields.",
            showConfirmButton: true
        });
    } else {
        Swal.fire({
            icon: "error",
            title: "Server Error!",
            text: "Something went wrong. Please try again.",
            showConfirmButton: true
        });
    }
}

        });
    });
</script>

@endsection
