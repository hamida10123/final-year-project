<?php
// submit_review.php

// DB connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "hri"; 
$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$tour_id = isset($_GET['tour_id']) ? (int)$_GET['tour_id'] : 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = 1; // Change to logged in user's id
    $rating = (int)$_POST['rating'];
    $comment = mysqli_real_escape_string($conn, $_POST['comment']);

    $insert_review_sql = "INSERT INTO tour_reviews (tour_id, user_id, rating, comment, created_at) VALUES ($tour_id, $user_id, $rating, '$comment', NOW())";
    mysqli_query($conn, $insert_review_sql);

    // Redirect back to tour detail page after submission
    header("Location: tours_page.php?id=$tour_id");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Submit Review</title>
<style>
  body { font-family: Arial, sans-serif; padding: 20px; background: #f9f9f9; }
  .form-container { max-width: 500px; margin: auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px #ccc; }
  label, select, textarea, button { display: block; width: 100%; margin-bottom: 15px; font-size: 16px; }
  textarea { height: 100px; padding: 10px; resize: vertical; }
  button {
    background-color: #001399; color: white; border: none; padding: 12px; cursor: pointer;
    border-radius: 6px; font-weight: bold;
  }
  button:hover { background-color: #000d80; }
  a.back-link { text-decoration: none; color: #001399; font-weight: bold; margin-bottom: 10px; display: inline-block; }
</style>
</head>
<body>

<div class="form-container">
  <a href="tours_page.php?id=<?php echo $tour_id; ?>" class="back-link">&larr; Back to Tour Details</a>
  <h2>Submit Your Review</h2>
  <form method="POST" action="">
    <label for="rating">Rating:</label>
    <select name="rating" id="rating" required>
      <option value="">Select Rating</option>
      <option value="5">5 - Excellent</option>
      <option value="4">4 - Very Good</option>
      <option value="3">3 - Good</option>
      <option value="2">2 - Fair</option>
      <option value="1">1 - Poor</option>
    </select>

    <label for="comment">Comment:</label>
    <textarea name="comment" id="comment" placeholder="Write your review here..." required></textarea>

    <button type="submit">Submit Review</button>
  </form>
</div>

</body>
</html>

<?php mysqli_close($conn); ?>
