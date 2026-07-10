@extends('admin.include.master')
@section('title', 'Order List')
@section('content')

<!-- Page Header -->
<div style="background:linear-gradient(45deg, #f33057, rgb( 56, 88, 249 ) );" class="d-sm-flex d-block align-items-center justify-content-between page-header-breadcrumb">
    <div>
        <h4 class="fw-medium mb-2">Order List</h4>
        <div class="ms-sm-1 ms-0">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.customer.index') }}">User List</a></li>
                    <li class="breadcrumb-item active fw-normal" aria-current="page">Orders</li>
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
                        Orders
                        @if(request('user_id'))
                            <small class="text-muted">
                                ({{ \App\Models\User::find(request('user_id'))->first_name ?? '' }})
                            </small>
                        @endif
                    </h5>
                    <div class="d-flex align-items-center ms-auto">
                        {{-- Status Filter --}}
                        <form method="GET" action="{{ route('admin.customer.orders') }}" class="d-inline-flex align-items-center me-2">
                            @if(request('user_id'))
                                <input type="hidden" name="user_id" value="{{ request('user_id') }}">
                            @endif
                            <select name="status" class="form-control form-control-sm" style="width: 160px;" onchange="this.form.submit()">
                                <option value="">All Status</option>
                                <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                                <option value="Processing" {{ request('status') == 'Processing' ? 'selected' : '' }}>Processing</option>
                                <option value="Shipped" {{ request('status') == 'Shipped' ? 'selected' : '' }}>Shipped</option>
                                <option value="Delivered" {{ request('status') == 'Delivered' ? 'selected' : '' }}>Delivered</option>
                                <option value="Cancelled" {{ request('status') == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                        </form>
                        <a href="{{ route('admin.customer.index') }}" class="btn btn-secondary btn-sm">
                            <i class="ri-arrow-left-line"></i> Back to Customers
                        </a>
                    </div>
                </div>
                <div class="card-body booking_card">
                    <div class="table-responsive mt-3">
                        <table class="table truncate m-0 align-middle">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Order Code</th>
                                    <th>Customer</th>
                                    <th>Mobile</th>
                                    <th>Total (₹)</th>
                                    <th>Shipping (₹)</th>
                                    <th>Payment</th>
                                    <th>Status</th>
                                    <th>Placed On</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($orders as $key => $order)
                                <tr>
                                    <td>{{ $orders->firstItem() + $key }}</td>
                                    <td><strong>{{ $order->order_code }}</strong></td>
                                    <td>{{ $order->user->first_name ?? '-' }} {{ $order->user->last_name ?? '' }}</td>
                                    <td>{{ $order->user->mobile ?? '-' }}</td>
                                    <td>₹{{ number_format($order->total_order_value, 2) }}</td>
                                    <td>₹{{ number_format($order->shipping_charge, 2) }}</td>
                                    <td>
                                        <span class="badge bg-info-transparent text-info">{{ $order->payment_method }}</span>
                                    </td>
                                    <td>
                                        <select class="form-control form-control-sm change_order_status"
                                                data-order_id="{{ $order->id }}"
                                                style="width: 130px; font-size: 0.85rem;">
                                            <option value="Pending" {{ $order->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="Processing" {{ $order->status == 'Processing' ? 'selected' : '' }}>Processing</option>
                                            <option value="Shipped" {{ $order->status == 'Shipped' ? 'selected' : '' }}>Shipped</option>
                                            <option value="Delivered" {{ $order->status == 'Delivered' ? 'selected' : '' }}>Delivered</option>
                                            <option value="Cancelled" {{ $order->status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                                        </select>
                                    </td>
                                    <td>{{ $order->created_at ? $order->created_at->format('d M Y, h:i A') : '-' }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.customer.order_details', $order->id) }}" class="btn btn-icon btn-sm btn-primary-light rounded-pill" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="View Details">
                                            <i class="ri-eye-line"></i>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="10" class="text-center text-muted py-4">No orders found.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>

                        <div class="pagination mt-3">
                            {{ $orders->appends(request()->input())->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
    $(".change_order_status").change(function (event) {
        event.preventDefault();
        var order_id = $(this).data("order_id");
        var status = $(this).val();
        var el = $(this);

        $.ajax({
            url: "{{ route('admin.customer.order_status_update') }}",
            type: "POST",
            data: {
                order_id: order_id,
                status: status,
                _token: '{{ csrf_token() }}'
            },
            dataType: 'json',
            success: function (result) {
                if (result.success) {
                    toastr.success(result.message);
                } else {
                    toastr.error("Failed to update status");
                }
            },
            error: function () {
                toastr.error("Something went wrong");
            }
        });
    });
</script>
@endsection
