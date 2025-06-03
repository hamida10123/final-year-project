<?php
require_once 'config/db.php';

// Fetch total bookings, users, and tours
$totalBookings = mysqli_query($conn, "SELECT COUNT(*) FROM bookings");
$totalUsers = mysqli_query($conn, "SELECT COUNT(*) FROM users");
$totalTours = mysqli_query($conn, "SELECT COUNT(*) FROM tours");

$bookingsCount = mysqli_fetch_array($totalBookings)[0];
$usersCount = mysqli_fetch_array($totalUsers)[0];
$toursCount = mysqli_fetch_array($totalTours)[0];

// Return the data as JSON
echo json_encode([
    'totalBookings' => $bookingsCount,
    'totalUsers' => $usersCount,
    'totalTours' => $toursCount
]);
?>
