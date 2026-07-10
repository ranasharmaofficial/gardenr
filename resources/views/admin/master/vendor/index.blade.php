@extends('admin.include.master')
@section('title', 'Vendor List')

@section('content')

<div style="background:linear-gradient(45deg, #f33057, rgb(56, 88, 249));"
     class="d-sm-flex d-block align-items-center justify-content-between page-header-breadcrumb">
    <div>
        <h4 class="fw-medium mb-2">Vendor List</h4>
        <div class="ms-sm-1 ms-0">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active fw-normal" aria-current="page">Vendor List</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="main-content app-content">
    <div class="container-fluid">

        <div class="card custom-card mt-3">

            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Vendor List</h5>

                <a href="{{ route('admin.vendors.create') }}" class="btn btn-danger btn-sm">
                    Add Vendor
                </a>
            </div>

            <div class="card-body">

                <form method="GET" action="{{ route('admin.vendors.index') }}">
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <input type="text"
                                   name="search"
                                   value="{{ request('search') }}"
                                   class="form-control"
                                   placeholder="Search owner/shop/email/gst">
                        </div>

                        <div class="col-md-3 d-flex gap-2">
                            <button type="submit" class="btn btn-danger">Search</button>
                            <a href="{{ route('admin.vendors.index') }}" class="btn btn-secondary">Reset</a>
                        </div>
                    </div>
                </form>

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
                                title: "Validation Error",
                                html: `{!! implode('<br>', $errors->all()) !!}`,
                                showConfirmButton: true
                            });
                        });
                    </script>
                @endif

                <div class="table-responsive">
                    <table class="table table-bordered text-nowrap" style="width:100%">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Owner</th>
                            <th>Email</th>
                            <th>Shop</th>
                            <th>GST</th>
                            <th>State</th>
                            <th>District</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th class="text-end">Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        @forelse($vendors as $key => $vendor)
                            <tr>
                                <td>{{ $vendors->firstItem() + $key }}</td>
                                <td>{{ $vendor->owner_name ?? '-' }}</td>
                                <td>{{ $vendor->owner_email ?? '-' }}</td>
                                <td>{{ $vendor->shop_name ?? '-' }}</td>
                                <td>{{ $vendor->gst ?? '-' }}</td>
                                <td>{{ $vendor->state->name ?? '-' }}</td>
                                <td>{{ $vendor->district->name ?? '-' }}</td>

                                <td>
                                    @if($vendor->status == 1)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>

                                <td>{{ $vendor->created_at ? $vendor->created_at->format('d M Y') : '-' }}</td>

                                <td class="text-end">
                                    <a href="{{ route('admin.vendors.edit',$vendor->id) }}"
                                       class="btn btn-sm btn-primary">
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.vendors.destroy',$vendor->id) }}"
                                          method="POST"
                                          class="d-inline deleteVendorForm">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center text-muted">
                                    No vendors found.
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    {{ $vendors->appends(request()->query())->links() }}
                </div>

            </div>
        </div>

    </div>
</div>

<script>
    $(document).on('submit', '.deleteVendorForm', function(e){
        e.preventDefault();
        let form = this;

        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
</script>

@endsection
