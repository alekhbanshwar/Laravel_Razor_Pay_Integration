<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Gatway using RozerPay</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>

    <div class="container mt-5 col-6 mx-auto">
        <div class="text-center">
            <img src="https://img.freepik.com/premium-vector/coffee-vector_25327-18.jpg" alt="coffee image vector" class="image-fluid" style="height: 200px;">
        </div>
        <form method="post" action="{{route('payment')}}">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" />
            </div>
            <div class="mb-3">
                <label for="amount" class="form-label">Amount</label>
                <input type="number" class="form-control" id="amount" name="amount" />
            </div>
            <button type="submit" class="btn btn-primary form-control">Submit</button>
        </form>
    </div>

    @if(Session::has('amount'))

    <div class="container text-center mx-auto">
        <form action="/pay" method="POST" class="text-center mx-auto mt-5">
            @csrf
            <script src="https://checkout.razorpay.com/v1/checkout.js" data-key="rzp_test_EaDYmDjFryHYMK" data-amount="{{Session::get('amount')}}" data-currency="INR" data-order_id="{{Session::get('orderId')}}" data-buttontext="Pay with Razorpay" data-name="Coffee" data-description="Test transaction" data-theme.color="#F37254"></script>

            <input type="hidden" custom="Hidden Element" name="hidden">
        </form>

    </div>

    @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>