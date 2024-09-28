<!DOCTYPE html>
<html>
<head>
    <title>Car Rental Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            background-color: #ffffff;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #4a90e2;
            font-size: 24px;
            text-align: center;
            margin-bottom: 20px;
        }
        p {
            font-size: 16px;
            color: #555;
            line-height: 1.6;
        }
        ul {
            list-style: none;
            padding: 0;
        }
        ul li {
            font-size: 16px;
            color: #333;
            padding: 8px 0;
        }
        ul li span {
            font-weight: bold;
            color: #4a90e2;
        }
        .button {
            display: block;
            width: 100%;
            padding: 12px 0;
            background-color: #4a90e2;
            color: #ffffff;
            text-align: center;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
            margin-top: 20px;
        }
        .footer {
            text-align: center;
            font-size: 14px;
            color: #999;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Car Rental Confirmation</h1>
        <p>Dear {{ $rental->user->name }},</p>
        <p>Your car rental has been successfully confirmed. Here are the details of your booking:</p>
        <ul>
            <li><span>Car:</span> {{ $rental->car->name }}</li>
            <li><span>Start Date:</span> {{ $rental->start_date }}</li>
            <li><span>End Date:</span> {{ $rental->end_date }}</li>
            <li><span>Total Price:</span> ${{ $rental->total_cost }}</li>
        </ul>
        <a href="#" class="button">View Your Booking</a>
        <p>If you have any questions or need further assistance, please don't hesitate to contact us.</p>
        <p class="footer">Thank you for choosing our service! We look forward to serving you.</p>
    </div>
</body>
</html>
