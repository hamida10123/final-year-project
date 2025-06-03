<?php
// connect DB (same as before)

// get POST data
$bookingID = $_POST['bookingID'];
$package = $_POST['package'];
$price = $_POST['price'];
$fullName = $_POST['fullName'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$tourDate = $_POST['tourDate'];
$bankName = $_POST['bankName'];
$accountNumber = $_POST['accountNumber'];
$transactionPin = $_POST['transactionPin'];

// Save payment info with status 'Pending' or 'Processing'
// You can create a table 'payments' with columns like payment_id, booking_id, amount, bank_name, acc_no, txn_pin, status, timestamp

// For demo, let's assume it's saved and confirmed immediately

$paymentStatus = "Paid"; // or Pending if verification needed

// Show Invoice
echo "<h2>Payment Receipt / Invoice</h2>";
echo "Invoice Number: " . $bookingID . "<br>";
echo "Name: " . htmlspecialchars($fullName) . "<br>";
echo "Package: " . htmlspecialchars($package) . "<br>";
echo "Price Paid: PKR " . htmlspecialchars($price) . "<br>";
echo "Tour Date: " . htmlspecialchars($tourDate) . "<br>";
echo "Bank: " . htmlspecialchars($bankName) . "<br>";
echo "Account Number: " . htmlspecialchars($accountNumber) . "<br>";
echo "Transaction ID/PIN: " . htmlspecialchars($transactionPin) . "<br>";
echo "Payment Status: " . $paymentStatus . "<br>";
echo "Date: " . date("Y-m-d H:i:s") . "<br>";

?>
