@extends('admin.include.master')
@section('title', 'Customer List')
@section('content')
<!-- Page Header -->
<div style="background:linear-gradient(45deg, #f33057, rgb( 56, 88, 249 ) );" class="d-sm-flex d-block align-items-center justify-content-between page-header-breadcrumb">
    <div>
        <h4 class="fw-medium mb-2">Customer List</h4>
        <div class="ms-sm-1 ms-0">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active fw-normal" aria-current="page">Customer List</li>
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
                    <h5 class="card-title">Customer List</h5>
                    <a href="{{ route('admin.customer.orders') }}" class="btn btn-primary ms-auto">
                        <i class="ri-shopping-cart-2-line"></i> All Orders
                    </a>
                </div>
                <div class="card-body booking_card">
                    <div class="table-responsive mt-3">
                        <table id="basicExample" class="table truncate m-0 align-middle">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th>Registered On</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $key => $user)
                                <tr>
                                    <td>{{ $users->firstItem() + $key }}</td>
                                    <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->mobile }}</td>
                                    <td>{{ $user->created_at ? $user->created_at->format('d M Y') : '-' }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.customer.addresses', $user->id) }}" class="btn btn-icon btn-sm btn-info-light rounded-pill" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="View Addresses">
                                            <i class="ri-map-pin-line"></i>
                                        </a>
                                        <a href="{{ route('admin.customer.orders', ['user_id' => $user->id]) }}" class="btn btn-icon btn-sm btn-warning-light rounded-pill" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="View Orders">
                                            <i class="ri-shopping-bag-3-line"></i>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">No customers found.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>

                        <div class="pagination mt-3">
                            {{ $users->appends(request()->input())->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
