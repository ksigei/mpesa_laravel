<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MPESA STK Push</title>
    <style>
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <h1>Make a Payment via MPESA</h1>

    <!-- Display Validation Errors -->
    @if ($errors->any())
        <div class="error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Display General Error Message -->
    @if (session('error'))
        <div class="error">
            <p>{{ session('error') }}</p>
        </div>
    @endif

    <!-- STK Push Form -->
    <form action="/mpesa/stkpush" method="POST">
        @csrf

        <label for="amount">Amount:</label><br>
        <input type="number" id="amount" name="amount" value="{{ old('amount') }}" required><br><br>

        <label for="phone_number">Phone Number:</label><br>
        <input type="text" id="phone_number" name="phone_number" value="{{ old('phone_number') }}" required placeholder="2547XXXXXXXX"><br><br>

        <button type="submit">Pay Now</button>
    </form>
</body>
</html>
