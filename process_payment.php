<?php
// DB connection same as before
$servername = "localhost";
$username = "root";
$password = "";
$database = "hri";

$con = mysqli_connect($servername, $username, $password, $database);
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['pay'])) {
    $booking_id = $_POST['booking_id'];
    $bank_name = $_POST['bank_name'];
    $account_number = $_POST['account_number'];
    $amount_paid = $_POST['amount_paid'];
    $pin = $_POST['pin']; // Agar aap PIN field add karenge to yahan lena hoga

    // --- PIN validation logic yahan add karen ---
    // For example:
    $valid_pin = '1234'; // Example, normally ye database mein ya secure storage mein hoga
    if ($pin !== $valid_pin) {
        die("Invalid PIN. Payment failed.");
    }

    // Payment successful, ab booking status update karo
    $payment_status = 'paid';

    // Update query
    $sql = "UPDATE bookings 
            SET bank_name = ?, account_number = ?, amount_paid = ?, payment_status = ? 
            WHERE booking_id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ssdsi", $bank_name, $account_number, $amount_paid, $payment_status, $booking_id);

    if ($stmt->execute()) {
       header("Location: receipt.php?booking_id=".$booking_id);
exit();

    } else {
        echo "Payment failed: " . $stmt->error;
    }
}
?>
