<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\UserAddress;
use App\Models\Order;
use App\Models\OrderDetails;
use Illuminate\Http\Request;

class CustomerOrderController extends Controller
{
    /**
     * Show all customer users (user_type_id = 2)
     */
    public function userList()
    {
        $users = User::where('user_type_id', 2)
                    ->orderBy('id', 'desc')
                    ->paginate(25);

        return view('admin.user_list.index', compact('users'));
    }

    /**
     * Show addresses for a specific user
     */
    public function userAddresses($userId)
    {
        $user = User::findOrFail($userId);
        $addresses = UserAddress::where('user_id', $userId)
                        ->orderBy('id', 'desc')
                        ->paginate(20);

        return view('admin.user_list.addresses', compact('user', 'addresses'));
    }

    /**
     * Show all orders (optionally filtered by user)
     */
    public function orderList(Request $request)
    {
        $query = Order::with(['user', 'address'])->orderBy('id', 'desc');

        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $orders = $query->paginate(25);

        return view('admin.user_list.orders', compact('orders'));
    }

    /**
     * Show order details for a specific order
     */
    public function orderDetails($orderId)
    {
        $order = Order::with(['user', 'address'])->findOrFail($orderId);
        $orderItems = OrderDetails::with('product')
                        ->where('order_id', $orderId)
                        ->get();

        return view('admin.user_list.order_details', compact('order', 'orderItems'));
    }

    /**
     * Update order status via AJAX
     */
    public function updateOrderStatus(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'status' => 'required|string|in:Pending,Processing,Shipped,Delivered,Cancelled',
        ]);

        $order = Order::findOrFail($request->order_id);
        $order->status = $request->status;
        $order->save();

        // Also update all items in this order
        OrderDetails::where('order_id', $order->id)->update(['status' => $request->status]);

        return response()->json([
            'success' => true,
            'message' => 'Order status updated successfully',
        ]);
    }
}
