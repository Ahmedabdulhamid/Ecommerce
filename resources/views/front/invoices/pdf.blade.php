
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice {{ $invoice->invoice_id }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        td, th { border: 1px solid #ddd; padding: 8px; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2 style="text-align: center;">Invoice #{{ $invoice->invoice_id }}</h2>
    <p><strong>Date:</strong> {{ $invoice->created_at->format('Y-m-d') }}</p>
    <p style=""><strong>Customer:</strong> {{ $invoice->customer_name }} ({{ auth()->user()->email }})</p>

    <table>
        <thead>
            <tr>
                <th>Description</th>
                <th>Amount</th>
                <th>Currency</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Payment via MyFatoorah</td>
                <td>{{ number_format($invoice->amount, 2) }}</td>
                <td>{{ $invoice->currency }}</td>
                <td>{{ ucfirst($invoice->status) }}</td>
            </tr>
        </tbody>
    </table>

    <h3 style="text-align: right; margin-top: 20px;">
        Total: {{ number_format($invoice->amount, 2) }} {{ $invoice->currency }}
    </h3>
</body>
</html>
