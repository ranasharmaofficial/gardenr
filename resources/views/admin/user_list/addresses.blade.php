@extends('admin.include.master')
@section('title', 'User Addresses - ' . $user->first_name)
@section('content')

<!-- Page Header -->
<div style="background:linear-gradient(45deg, #f33057, rgb( 56, 88, 249 ) );" class="d-sm-flex d-block align-items-center justify-content-between page-header-breadcrumb">
    <div>
        <h4 class="fw-medium mb-2">Addresses - {{ $user->first_name }} {{ $user->last_name }}</h4>
        <div class="ms-sm-1 ms-0">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.customer.index') }}">User List</a></li>
                    <li class="breadcrumb-item active fw-normal" aria-current="page">Addresses</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- Page Header Close -->

<!--APP-CONTENT START-->
<div class="main-content app-content">
    <div class="row gx-3">
        <div class="col-md-12">
            <div class="card card-table">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title">
                        Addresses for: <strong>{{ $user->first_name }} {{ $user->last_name }}</strong>
                        <small class="text-muted">({{ $user->mobile }})</small>
                    </h5>
                    <a href="{{ route('admin.customer.index') }}" class="btn btn-secondary ms-auto">
                        <i class="ri-arrow-left-line"></i> Back to Customers
                    </a>
                </div>
                <div class="card-body booking_card">
                    <div class="table-responsive mt-3">
                        <table class="table truncate m-0 align-middle">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Mobile</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th>City</th>
                                    <th>State</th>
                                    <th>Pincode</th>
                                    <th>Added On</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($addresses as $key => $addr)
                                <tr>
                                    <td>{{ $addresses->firstItem() + $key }}</td>
                                    <td>{{ $addr->name }}</td>
                                    <td>{{ $addr->mobile }}</td>
                                    <td>{{ $addr->email ?? '-' }}</td>
                                    <td>{{ $addr->address }}</td>
                                    <td>{{ $addr->city }}</td>
                                    <td>{{ $addr->state }}</td>
                                    <td>{{ $addr->pincode }}</td>
                                    <td>{{ $addr->created_at ? $addr->created_at->format('d M Y') : '-' }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="9" class="text-center text-muted py-4">No addresses found for this user.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>

                        <div class="pagination mt-3">
                            {{ $addresses->appends(request()->input())->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
