<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Order Placed</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { width: 100%; max-width: 600px; margin: 0 auto; border: 1px solid #e0e0e0; padding: 20px; border-radius: 8px; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h2 { color: #10b981; margin: 0; }
        .order-details, .customer-details { margin-bottom: 20px; }
        .order-details th, .order-details td { padding: 8px; text-align: left; border-bottom: 1px solid #eee; }
        .total-row { font-weight: bold; background-color: #f8f9fa; }
        .footer { text-align: center; margin-top: 20px; font-size: 0.9em; color: #777; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Order Confirmation</h2>
            <p>Thank you for your order!</p>
        </div>

        <div class="customer-details">
            <p>Hi <strong>{{ $order->user->first_name ?? 'Customer' }}</strong>,</p>
            <p>We've successfully received your order <strong>#{{ $order->order_code }}</strong>. Here are the details:</p>
            
            <p>
                <strong>Shipping Address:</strong><br>
                {{ $order->address->name ?? '' }}<br>
                {{ $order->address->address ?? '' }}<br>
                {{ $order->address->city ?? '' }}, {{ $order->address->state ?? '' }} - {{ $order->address->pincode ?? '' }}<br>
                Phone: {{ $order->address->mobile ?? '' }}
            </p>
        </div>

        <table class="order-details" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Qty</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->orderDetails as $item)
                <tr>
                    <td>{{ $item->product->name ?? 'Product' }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>₹{{ number_format($item->total, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2" style="text-align: right;">Shipping:</td>
                    <td>₹{{ number_format($order->shipping_charge, 2) }}</td>
                </tr>
                <tr class="total-row">
                    <td colspan="2" style="text-align: right;">Total ({{ $order->payment_method }}):</td>
                    <td>₹{{ number_format($order->total_order_value, 2) }}</td>
                </tr>
            </tfoot>
        </table>

        <div class="footer">
            <p>If you have any questions, feel free to reply to this email.</p>
            <p>&copy; {{ date('Y') }} CloudwareIndia. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
