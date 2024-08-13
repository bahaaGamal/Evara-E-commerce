<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Failed</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow-sm p-4" style="max-width: 600px; width: 100%;">
            <div class="card-body text-center">
                <h1 class="card-title mb-4">Payment Failed</h1>
                <p class="card-text">
                    Dear {{ $order->user->name }},
                </p>
                <p class="card-text">
                    Unfortunately, your payment for order #{{ $order->id }} has failed.
                </p>
                <p class="card-text">
                    Please try again or contact support if you need assistance.
                </p>
                <a href="{{ route('site.index') }}" class="btn btn-primary mt-4">Return to Home</a>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
