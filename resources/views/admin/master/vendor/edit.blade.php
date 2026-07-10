@extends('admin.include.master')
@section('title', 'Edit Vendor')

@section('content')

    <div style="background:linear-gradient(45deg, #f33057, rgb(56, 88, 249));"
        class="d-sm-flex d-block align-items-center justify-content-between page-header-breadcrumb">
        <div>
            <h4 class="fw-medium mb-2">Edit Vendor</h4>
            <div class="ms-sm-1 ms-0">
                <nav>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.vendors.index') }}">Vendor List</a></li>
                        <li class="breadcrumb-item active fw-normal" aria-current="page">Edit Vendor</li>
                    </ol>
                </nav>
            </div>
        </div>

        <a href="{{ route('admin.vendors.index') }}" class="btn btn-light btn-sm">
            Back
        </a>
    </div>

    <div class="main-content app-content">
        <div class="container-fluid">

            <div class="card custom-card mt-3">

                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Update Vendor Details</h5>
                </div>

                <div class="card-body">

                    @if(session('success'))
                        <script>
                            document.addEventListener("DOMContentLoaded", function () {
                                Swal.fire({
                                    icon: "success",
                                    title: "Success",
                                    text: "{{ session('success') }}",
                                    timer: 1500,
                                    showConfirmButton: false
                                });
                            });
                        </script>
                    @endif

                    @if(session('error'))
                        <script>
                            document.addEventListener("DOMContentLoaded", function () {
                                Swal.fire({
                                    icon: "error",
                                    title: "Error",
                                    text: "{{ session('error') }}",
                                    showConfirmButton: true
                                });
                            });
                        </script>
                    @endif

                    @if ($errors->any())
                        <script>
                            document.addEventListener("DOMContentLoaded", function () {
                                Swal.fire({
                                    icon: "warning",
                                    title: "Validation Error!",
                                    html: `{!! implode('<br>', $errors->all()) !!}`,
                                    showConfirmButton: true
                                });
                            });
                        </script>
                    @endif

                    <form id="updateVendorForm" action="{{ route('admin.vendors.update', $vendor->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Branch <span class="text-danger">*</span></label>
                                <select name="branch_id" class="form-control">
                                    <option value="">Select Branch</option>
                                    @foreach($branch as $b)
                                        <option value="{{ $b->id }}" {{ old('branch_id', $vendor->branch_id) == $b->id ? 'selected' : '' }}>
                                            {{ $b->name }} ({{ $b->code }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">Owner Name <span class="text-danger">*</span></label>
                                <input type="text" name="owner_name" class="form-control"
                                    value="{{ old('owner_name', $vendor->owner_name) }}" placeholder="Enter owner name">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">Owner Email <span class="text-danger">*</span></label>
                                <input type="email" name="owner_email" class="form-control"
                                    value="{{ old('owner_email', $vendor->owner_email) }}" placeholder="Enter owner email">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">Shop Name <span class="text-danger">*</span></label>
                                <input type="text" name="shop_name" class="form-control"
                                    value="{{ old('shop_name', $vendor->shop_name) }}" placeholder="Enter shop name">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">GST</label>
                                <input type="text" name="gst" class="form-control" value="{{ old('gst', $vendor->gst) }}"
                                    placeholder="Enter GST number (optional)">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">State <span class="text-danger">*</span></label>
                                <select name="state_id" id="state_id" class="form-control">
                                    <option value="">Select State</option>
                                    @foreach($states as $state)
                                        <option value="{{ $state->id }}" {{ old('state_id', $vendor->state_id) == $state->id ? 'selected' : '' }}>
                                            {{ $state->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">District <span class="text-danger">*</span></label>
                                <select name="district_id" id="district_id" class="form-control">
                                    <option value="">Select District</option>
                                    @foreach($districts as $dist)
                                        <option value="{{ $dist->id }}" {{ old('district_id', $vendor->district_id) == $dist->id ? 'selected' : '' }}>
                                            {{ $dist->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="col-md-4 mb-3">
                                <label class="form-label">Status <span class="text-danger">*</span></label>
                                <select name="status" class="form-control">
                                    <option value="1" {{ old('status', $vendor->status) == 1 ? 'selected' : '' }}>Active
                                    </option>
                                    <option value="0" {{ old('status', $vendor->status) == 0 ? 'selected' : '' }}>Inactive
                                    </option>
                                </select>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label">Address <span class="text-danger">*</span></label>
                                <textarea name="address" class="form-control" rows="3"
                                    placeholder="Enter full address">{{ old('address', $vendor->address) }}</textarea>
                            </div>

                            <div class="col-md-12 d-flex gap-2">
                                <button type="submit" class="btn btn-danger" id="updateVendorBtn">
                                    Update Vendor
                                </button>

                                <a href="{{ route('admin.vendors.index') }}" class="btn btn-secondary">
                                    Cancel
                                </a>
                            </div>

                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>

    <script>
        $(document).ready(function () {

            function loadDistrict(state_id, selected_district = null) {
                if (!state_id) {
                    $('#district_id').html('<option value="">Select District</option>');
                    return;
                }

                $('#district_id').html('<option value="">Loading...</option>');

                $.ajax({
                    url: "{{ url('admin/get-district-by-state') }}/" + state_id,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('#district_id').empty();
                        $('#district_id').append('<option value="">Select District</option>');

                        if (data.length > 0) {
                            $.each(data, function (key, value) {
                                let selected = (selected_district == value.id) ? 'selected' : '';
                                $('#district_id').append('<option ' + selected + ' value="' + value.id + '">' + value.name + '</option>');
                            });
                        } else {
                            $('#district_id').append('<option value="">No District Found</option>');
                        }
                    }
                });
            }

            $('#state_id').on('change', function () {
                loadDistrict($(this).val());
            });

            let oldState = "{{ old('state_id', $vendor->state_id) }}";
            let oldDistrict = "{{ old('district_id', $vendor->district_id) }}";
            if (oldState) {
                loadDistrict(oldState, oldDistrict);
            }


        });
    </script>

@endsection