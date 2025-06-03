<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$database = "hri";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Dummy login check (you can replace this with actual login session)
if (!isset($_SESSION['user_id'])) {
    echo "You must be logged in to submit a review.";
    exit;
}

$tour_id = $_GET['tour_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $rating = $_POST['rating'];
    $review = mysqli_real_escape_string($conn, $_POST['review']);
    $review_date = date("Y-m-d");

    $sql = "INSERT INTO tour_reviews (tour_id, user_id, rating, review, review_date)
            VALUES ('$tour_id', '$user_id', '$rating', '$review', '$review_date')";

    if (mysqli_query($conn, $sql)) {
        header("Location: tours_page.php?id=$tour_id");
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add Review</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      padding: 30px;
      background-color: #f2f2f2;
    }
    .container {
      max-width: 600px;
      margin: auto;
      background-color: white;
      padding: 25px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    h2 {
      color: #001399;
    }
    label {
      display: block;
      margin-top: 15px;
      font-weight: bold;
    }
    input[type="number"],
    textarea {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      border-radius: 5px;
      border: 1px solid #ccc;
    }
    button {
      margin-top: 20px;
      background-color: #001399;
      color: white;
      padding: 10px 15px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
    button:hover {
      background-color: #000d80;
    }
  </style>
</head>
<body>

<div class="container">
  <h2>Write a Review</h2>
  <form method="POST">
    <label for="rating">Rating (1 to 5):</label>
    <input type="number" name="rating" min="1" max="5" required>

    <label for="review">Your Review:</label>
    <textarea name="review" rows="5" required></textarea>

    <button type="submit">Submit Review</button>
  </form>
</div>

</body>
</html>
