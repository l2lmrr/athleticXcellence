<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Order Receipt #{{ $order->id }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        .header { text-align: center; margin-bottom: 20px; }
        .details { margin-bottom: 30px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .total { font-weight: bold; text-align: right; }
    </style>
</head>
<body>
    <div class="header">
        <h1>ATHLETICXCELLENCE</h1>
        <h2>Order Receipt #{{ $order->id }}</h2>
        <p>Date: {{ $order->created_at->format('F j, Y') }}</p>
    </div>
    
    <div class="details">
        <p><strong>Customer:</strong> {{ $order->user->name }}</p>
        <p><strong>Email:</strong> {{ $order->user->email }}</p>
        <p><strong>Shipping Address:</strong> {{ $order->shipping_address }}</p>
    </div>
    
    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
            <tr>
                <td>{{ $item->product->name }}</td>
                <td>{{ $item->quantity }}</td>
                <td>${{ number_format($item->price, 2) }}</td>
                <td>${{ number_format($item->price * $item->quantity, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" class="total">Subtotal:</td>
                <td>${{ number_format($order->total_amount, 2) }}</td>
            </tr>
            <tr>
                <td colspan="3" class="total">Shipping:</td>
                <td>Free</td>
            </tr>
            <tr>
                <td colspan="3" class="total">Total:</td>
                <td>${{ number_format($order->total_amount, 2) }}</td>
            </tr>
        </tfoot>
    </table>
</body>
</html>