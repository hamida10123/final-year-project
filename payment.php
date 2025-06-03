<?php
// DB connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "hri";

$con = mysqli_connect($servername, $username, $password, $database);
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Sample values (you can take these from a form or previous page)
$user_id = 1;
$tour_id = 2;
$adults = 2;
$children = 1;
$adult_price = 3000;
$child_price = 1500;

$number_of_people = $adults + $children;
$total_amount = ($adults * $adult_price) + ($children * $child_price);

// Insert into bookings
$sql = "INSERT INTO bookings (user_id, tour_id, adults, children, number_of_people, total_amount, adult_price, child_price)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $con->prepare($sql);
$stmt->bind_param("iiiiiddd", $user_id, $tour_id, $adults, $children, $number_of_people, $total_amount, $adult_price, $child_price);

if ($stmt->execute()) {
    $booking_id = $stmt->insert_id;

    // Now fetch booking to show form
    $sql2 = "SELECT b.*, t.tour_name FROM bookings b JOIN tours t ON b.tour_id = t.tour_id WHERE b.booking_id = ?";
    $stmt2 = $con->prepare($sql2);
    $stmt2->bind_param("i", $booking_id);
    $stmt2->execute();
    $result = $stmt2->get_result();
    $booking = $result->fetch_assoc();
} else {
    die("Failed to insert booking: " . $stmt->error);
}
?>

<style>
  body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: #f9faff;
    color: #333;
    padding: 20px;
  }
  h2, h3 {
    color: #001399;
  }
  .container {
    max-width: 480px;
    margin: 30px auto;
    background: #fff;
    padding: 25px 30px;
    border-radius: 8px;
    box-shadow: 0 3px 12px rgb(0 0 0 / 0.1);
  }
  .summary p {
    font-size: 16px;
    margin: 10px 0;
  }
  .summary strong {
    color: #001399;
  }
  form {
    margin-top: 20px;
  }
  label {
    display: block;
    font-weight: 600;
    margin-bottom: 6px;
    margin-top: 12px;
  }
  input[type="password"] {
  width: 100%;
  padding: 8px 12px;
  border: 1.8px solid #ddd;
  border-radius: 5px;
  font-size: 15px;
  transition: border-color 0.3s ease;
  box-sizing: border-box;
}

input[type="password"]:focus {
  border-color: #001399;
  outline: none;
}

  input[type="text"],
  input[type="number"] {
    width: 100%;
    padding: 8px 12px;
    border: 1.8px solid #ddd;
    border-radius: 5px;
    font-size: 15px;
    transition: border-color 0.3s ease;
  }
  input[type="text"]:focus,
  input[type="number"]:focus {
    border-color: #001399;
    outline: none;
  }
  button {
    margin-top: 20px;
    background-color: #001399;
    color: white;
    border: none;
    padding: 12px 18px;
    font-size: 16px;
    font-weight: 600;
    border-radius: 6px;
    cursor: pointer;
    width: 100%;
    transition: background-color 0.3s ease;
  }
  button:hover {
    background-color: #0033cc;
  }
</style>

<div class="container">
  <h2>Booking Summary</h2>
  <div class="summary">
    <p><strong>Tour Package:</strong> <?= htmlspecialchars($booking['tour_name']) ?></p>
    <p><strong>Total Amount:</strong> Rs <?= number_format($booking['total_amount'], 2) ?></p>
    <p><strong>Number of People:</strong> <?= (int)$booking['number_of_people'] ?></p>
  </div>

  <h3>Enter Bank Details</h3>
  <form action="process_payment.php" method="POST">
    <input type="hidden" name="booking_id" value="<?= (int)$booking['booking_id'] ?>">

    <label for="bank_name">Bank Name:</label>
    <input type="text" id="bank_name" name="bank_name" required placeholder="Your Bank Name">

    <label for="account_number">Account Number:</label>
    <input type="text" id="account_number" name="account_number" required placeholder="Your Account Number">
   <label for="pin">Enter PIN:</label>
    <input type="password" id="pin" name="pin" required placeholder="Enter your PIN" maxlength="6" pattern="\d{4,6}" title="Please enter 4 to 6 digit PIN">

    <label for="amount_paid">Amount Paid:</label>
    <input type="number" id="amount_paid" name="amount_paid" required value="<?= number_format($booking['total_amount'], 2) ?>" min="0" step="0.01">

    <button type="submit" name="pay">Proceed to Pay</button>
  </form>
</div>
