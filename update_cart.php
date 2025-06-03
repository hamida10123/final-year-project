<?php
session_start();
$user_id = 1; // Change to $_SESSION['user_id'] if logged in
$conn = new mysqli("localhost", "root", "", "hri");

$tour_id = $_POST['tour_id'];
$action = $_POST['action'];

$check = $conn->query("SELECT * FROM cart WHERE user_id=$user_id AND tour_id=$tour_id");

if ($action == "increase") {
  if ($check->num_rows > 0) {
    $conn->query("UPDATE cart SET quantity = quantity + 1 WHERE user_id=$user_id AND tour_id=$tour_id");
  } else {
    $conn->query("INSERT INTO cart (user_id, tour_id, quantity) VALUES ($user_id, $tour_id, 1)");
  }
}
elseif ($action == "decrease") {
  $row = $check->fetch_assoc();
  if ($row['quantity'] > 1) {
    $conn->query("UPDATE cart SET quantity = quantity - 1 WHERE user_id=$user_id AND tour_id=$tour_id");
  } else {
    $conn->query("DELETE FROM cart WHERE user_id=$user_id AND tour_id=$tour_id");
  }
}
elseif ($action == "remove") {
  $conn->query("DELETE FROM cart WHERE user_id=$user_id AND tour_id=$tour_id");
}
?>
