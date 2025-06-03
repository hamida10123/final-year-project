<?php
session_start();

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo "<p>Your cart is empty. <a href='index.php'>Go back to tours</a></p>";
    exit;
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
</head>
<body>
<h1>Checkout Page</h1>
<p>This is where you can implement booking confirmation, payment, or order details.</p>
<a href="index.php">Back to Tours</a>
</body>
</html>
