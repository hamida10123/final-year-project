/*
<?php
require 'config/db.php';

$name = "Admin";
$email = "admin@example.com";
$password = password_hash("admin123", PASSWORD_DEFAULT); // Secure password

$sql = "INSERT INTO admins (name, email, password) VALUES ('$name', '$email', '$password')";

if (mysqli_query($conn, $sql)) {
    echo "Admin added successfully!";
} else {
    echo "Error: " . mysqli_error($conn);
}
?>
*/