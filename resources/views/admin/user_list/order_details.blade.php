@extends('admin.include.master')
@section('title', 'Order Details - #' . $order->order_code)
@section('content')

<!-- Page Header -->
<div style="background:linear-gradient(45deg, #f33057, rgb( 56, 88, 249 ) );" class="d-sm-flex d-block align-items-center justify-content-between page-header-breadcrumb">
    <div>
        <h4 class="fw-medium mb-2">Order #{{ $order->order_code }}</h4>
        <div class="ms-sm-1 ms-0">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.customer.index') }}">User List</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.customer.orders') }}">Orders</a></li>
                    <li class="breadcrumb-item active fw-normal" aria-current="page">Order Details</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- Page Header Close -->

<!--APP-CONTENT START-->
<div class="main-content app-content">
    <div class="row gx-3">
        {{-- Order Info --}}
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title"><i class="ri-file-list-3-line me-2"></i>Order Information</h5>
                </div>
                <div class="card-body">
                    <table class="table table-borderless mb-0">
                        <tr>
                            <th width="40%">Order Code</th>
                            <td><strong>{{ $order->order_code }}</strong></td>
                        </tr>
                        <tr>
                            <th>Total Value</th>
                            <td>₹{{ number_format($order->total_order_value, 2) }}</td>
                        </tr>
                        <tr>
                            <th>Shipping Charge</th>
                            <td>₹{{ number_format($order->shipping_charge, 2) }}</td>
                        </tr>
                        <tr>
                            <th>Payment Method</th>
                            <td><span class="badge bg-info-transparent text-info">{{ $order->payment_method }}</span></td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                <select class="form-control form-control-sm change_order_status"
                                        data-order_id="{{ $order->id }}"
                                        style="width: 150px;">
                                    <option value="Pending" {{ $order->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="Processing" {{ $order->status == 'Processing' ? 'selected' : '' }}>Processing</option>
                                    <option value="Shipped" {{ $order->status == 'Shipped' ? 'selected' : '' }}>Shipped</option>
                                    <option value="Delivered" {{ $order->status == 'Delivered' ? 'selected' : '' }}>Delivered</option>
                                    <option value="Cancelled" {{ $order->status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>Order Date</th>
                            <td>{{ $order->created_at ? $order->created_at->format('d M Y, h:i A') : '-' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        {{-- Customer & Shipping --}}
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title"><i class="ri-user-location-line me-2"></i>Customer & Shipping</h5>
                </div>
                <div class="card-body">
                    <table class="table table-borderless mb-0">
                        <tr>
                            <th width="40%">Customer Name</th>
                            <td>{{ $order->user->first_name ?? '-' }} {{ $order->user->last_name ?? '' }}</td>
                        </tr>
                        <tr>
                            <th>Mobile</th>
                            <td>{{ $order->user->mobile ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $order->user->email ?? '-' }}</td>
                        </tr>
                        @if($order->address)
                        <tr>
                            <th>Shipping Address</th>
                            <td>
                                {{ $order->address->address }}<br>
                                {{ $order->address->city }}, {{ $order->address->state }} - {{ $order->address->pincode }}
                            </td>
                        </tr>
                        <tr>
                            <th>Recipient</th>
                            <td>{{ $order->address->name }} ({{ $order->address->mobile }})</td>
                        </tr>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Order Items --}}
    <div class="row gx-3">
        <div class="col-sm-12">
            <div class="card card-table">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title"><i class="ri-box-3-line me-2"></i>Order Items</h5>
                    <a href="{{ route('admin.customer.orders') }}" class="btn btn-secondary ms-auto">
                        <i class="ri-arrow-left-line"></i> Back to Orders
                    </a>
                </div>
                <div class="card-body booking_card">
                    <div class="table-responsive mt-3">
                        <table class="table truncate m-0 align-middle">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Product Name</th>
                                    <th>Price (₹)</th>
                                    <th>Quantity</th>
                                    <th>Total (₹)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($orderItems as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>
                                        @if($item->product)
                                            <div class="d-flex align-items-center">
                                                @if($item->product->thumbnail)
                                                    <img src="{{ static_asset($item->product->thumbnail) }}"
                                                         alt="{{ $item->product->name }}"
                                                         style="width: 45px; height: 45px; object-fit: cover; border-radius: 6px; margin-right: 10px;">
                                                @endif
                                                <span>{{ $item->product->name }}</span>
                                            </div>
                                        @else
                                            <span class="text-muted">Product Deleted</span>
                                        @endif
                                    </td>
                                    <td>₹{{ number_format($item->price, 2) }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td><strong>₹{{ number_format($item->total, 2) }}</strong></td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">No items found for this order.</td>
                                </tr>
                                @endforelse
                            </tbody>
                            <tfoot>
                                <tr style="background: #f8f9fa;">
                                    <td colspan="4" class="text-end"><strong>Subtotal:</strong></td>
                                    <td><strong>₹{{ number_format($orderItems->sum('total'), 2) }}</strong></td>
                                </tr>
                                <tr style="background: #f8f9fa;">
                                    <td colspan="4" class="text-end"><strong>Shipping:</strong></td>
                                    <td><strong>₹{{ number_format($order->shipping_charge, 2) }}</strong></td>
                                </tr>
                                <tr style="background: #e8f5e9;">
                                    <td colspan="4" class="text-end"><strong style="font-size: 1.1rem;">Grand Total:</strong></td>
                                    <td><strong style="font-size: 1.1rem; color: #10b981;">₹{{ number_format($order->total_order_value, 2) }}</strong></td>
                                </tr>
                            </tfoot>
                        </table>
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
                    setTimeout(function() {
                        location.reload();
                    }, 1000);
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
