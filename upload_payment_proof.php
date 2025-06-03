<?php
session_start();
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$database = "hri";
$con = new mysqli($servername, $username, $password, $database);
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// if needed

if (!isset($_POST['booking_id'])) {
    die("Booking ID not found.");
}

$booking_id = $_POST['booking_id'];
// make sure you stored this earlier

$target_dir = "payment_proofs/";
if (!is_dir($target_dir)) {
    mkdir($target_dir);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['payment_proof'])) {
    $filename = time() . "_" . basename($_FILES["payment_proof"]["name"]);
    $target_file = $target_dir . $filename;

    if (move_uploaded_file($_FILES["payment_proof"]["tmp_name"], $target_file)) {
        // Save path in DB
        $conn = new mysqli("localhost", "root", "", "hri");
        if ($conn->connect_error) die("DB Connection failed");

        $stmt = $conn->prepare("UPDATE bookings SET payment_status='proof_submitted', payment_proof=? WHERE booking_id=?");
        $stmt->bind_param("si", $filename, $booking_id);
        $stmt->execute();
echo '<div style="max-width:600px; margin: 50px auto; padding: 20px; background-color: #E6E6FA; border: 1px solid #001399; border-radius: 8px; text-align: center; font-family: Arial, sans-serif;">
    <h2 style="color: #001399; margin-bottom: 10px;">🎉 Payment Proof Submitted</h2>
    <p style="font-size: 16px; color: #333;">
        Thank you! Your payment proof has been received.<br>
        <strong>We will verify and confirm it shortly.</strong>
    </p>
</div>';



    } else {
        echo "Error uploading file.";
    }
}
