<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$database = "hri"; 

// Create connection using object-oriented style (needed for prepare)
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if booking_id is set in session
if (!isset($_SESSION['booking_id'])) {
    header("Location: book now.php");  // redirect if no booking_id found
    exit;
}

$booking_id = (int)$_SESSION['booking_id'];

// Prepare and execute statement to fetch booking details
$stmt = $conn->prepare("SELECT booking_id, name, tour_name, adults, children, total_price, status, payment_method, booking_date FROM bookings WHERE booking_id = ?");
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("i", $booking_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Booking not found.";
    exit;
}

$booking = $result->fetch_assoc();
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Payment Successful - Invoice</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background: #f4f4f4;
        margin: 0; padding: 0;
    }
    .invoice-container {
        max-width: 700px;
        margin: 40px auto;
        background: white;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.1);
    }
    h1, h2 {
        text-align: center;
        color: #001399;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }
    th, td {
        padding: 15px;
        border-bottom: 1px solid #ddd;
        text-align: left;
    }
    th {
        background: #001399;
        color: white;
    }
    .total {
        font-weight: bold;
        font-size: 18px;
        color: #001399;
    }
    .status-paid {
        color: green;
        font-weight: bold;
    }
    .status-pending {
        color: orange;
        font-weight: bold;
    }
    .footer {
        text-align: center;
        margin-top: 30px;
        font-size: 14px;
        color: #555;
    }
</style>
</head>
<body>

<div class="invoice-container">
    <h1>Payment Successful</h1>
    <h2>Invoice</h2>

    <p><strong>Booking ID:</strong> <?php echo htmlspecialchars($booking['booking_id']); ?></p>
    <p><strong>Name:</strong> <?php echo htmlspecialchars($booking['name']); ?></p>
    <p><strong>Tour:</strong> <?php echo htmlspecialchars($booking['tour_name']); ?></p>
    <p><strong>Booking Date:</strong> <?php echo date("d M Y, H:i", strtotime($booking['booking_date'])); ?></p>

    <table>
        <thead>
            <tr>
                <th>Description</th>
                <th>Quantity</th>
                <th>Price (PKR)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Adults</td>
                <td><?php echo (int)$booking['adults']; ?></td>
                <td><?php echo number_format(1000 * $booking['adults'], 2); ?></td> <!-- Example adult price -->
            </tr>
            <tr>
                <td>Children</td>
                <td><?php echo (int)$booking['children']; ?></td>
                <td><?php echo number_format(500 * $booking['children'], 2); ?></td> <!-- Example child price -->
            </tr>
            <tr>
                <td colspan="2" class="total">Total Price</td>
                <td class="total"><?php echo number_format($booking['total_price'], 2); ?></td>
            </tr>
        </tbody>
    </table>

    <p><strong>Payment Method:</strong> <?php echo htmlspecialchars(ucwords(str_replace('_', ' ', $booking['payment_method']))); ?></p>

    <p><strong>Status:</strong> 
        <?php 
        if (strtolower($booking['status']) === 'paid') {
            echo '<span class="status-paid">Paid</span>';
        } else {
            echo '<span class="status-pending">Pending</span>';
        }
        ?>
    </p>

    <div class="footer">
        Thank you for booking with us!<br>
        For any queries, contact support@yourdomain.com
    </div>
</div>

</body>
</html>
