<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reservation PDF</title>
    <style>
        body { font-family: sans-serif; }
        .header { text-align: center; margin-bottom: 20px; }
        .details { border: 1px solid #ddd; padding: 10px; }
    </style>
</head>
<body>
<div class="header">
    <h2>Reservation Confirmation</h2>
    <p>Reservation ID: #{{ $reservation->id }}</p>
</div>

<div class="details">
    <p><strong>Guest:</strong> {{ $reservation->guest_name }}</p>
    <p><strong>Hotel:</strong> {{ $reservation->hotel->hotelName }}</p>
    <p><strong>Check-in:</strong> {{ $reservation->check_in }}</p>
    <p><strong>Check-out:</strong> {{ $reservation->check_out }}</p>
    <p><strong>Status:</strong> {{ $reservation->status->name }}</p>
    <p><strong>Total:</strong> {{ $reservation->total_price }} {{ $reservation->currency->code }}</p>
</div>
</body>
</html>
