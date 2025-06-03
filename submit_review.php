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

// Only run on POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();

    // Replace this with actual logged-in user id from session
    $user_id = 1; // Example. Use: $_SESSION['user_id'];
    $tour_id = (int)$_GET['tour_id']; // Pass tour_id in URL like ?tour_id=5

    $rating = (int)$_POST['rating'];
    $comment = mysqli_real_escape_string($conn, $_POST['comment']);

    // 1. Check if tour is completed for the user
    $today = date('Y-m-d');
    $checkTour = "SELECT * FROM bookings WHERE user_id = $user_id AND tour_id = $tour_id AND end_date <= '$today'";
    $tourResult = mysqli_query($conn, $checkTour);

    $isTourCompleted = mysqli_num_rows($tourResult) > 0;

    // 2. Check if user already gave review for this tour
    $checkReview = "SELECT * FROM tour_reviews WHERE user_id = $user_id AND tour_id = $tour_id";
    $reviewResult = mysqli_query($conn, $checkReview);
    if (mysqli_num_rows($reviewResult) > 0) {
        echo "<script>alert('You already submitted a review for this tour.'); window.history.back();</script>";
        exit;
    }

    // 3. Insert review
    $insert_review_sql = "INSERT INTO tour_reviews (tour_id, user_id, rating, comment, created_at) VALUES ($tour_id, $user_id, $rating, '$comment', NOW())";
    $result = mysqli_query($conn, $insert_review_sql);

    // 4. If tour completed, give points and send notification
    if ($result && $isTourCompleted) {
        // Add 1000 points
        $update_points_sql = "UPDATE userss SET points = points + 1000 WHERE id = $user_id";
        mysqli_query($conn, $update_points_sql);

        // Insert notification
        $message = "You earned 1000 points for your review. Enjoy 10% discount on your next booking!";
        $insert_notification_sql = "INSERT INTO notifications (recipient_type, recipient_id, message, created_at, is_read) VALUES ('user', $user_id, '$message', NOW(), 0)";
        mysqli_query($conn, $insert_notification_sql);

        echo "<script>alert('Review submitted. You earned 1000 points!'); window.location.href='tours_page.php?id=$tour_id';</script>";
    } elseif ($result) {
        echo "<script>alert('Review submitted successfully, but tour is not completed yet. No points added.'); window.location.href='tours_page.php?id=$tour_id';</script>";
    } else {
        echo "<script>alert('Error submitting review.'); window.history.back();</script>";
    }

    exit;
}
?>

        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Submit Review</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
            <style>
                .rating {
                    display: flex;
                    flex-direction: row-reverse;
                    justify-content: flex-end;
                    margin: 20px 0;
                }
                .rating > input { display: none; }
                .rating > label {
                    color: #ddd;
                    font-size: 30px;
                    padding: 0 5px;
                    cursor: pointer;
                }
                .rating > input:checked ~ label,
                .rating > label:hover,
                .rating > label:hover ~ label { color: #001399; }
                .container {
                    max-width: 600px;
                    margin: 50px auto;
                    padding: 20px;
                    background: white;
                    border-radius: 10px;
                    box-shadow: 0 0 10px rgba(0,0,0,0.1);
                }
                .btn-submit {
                    background: #001399;
                    color: white;
                    border: none;
                    padding: 10px 25px;
                    border-radius: 5px;
                }
                .btn-submit:hover {
                    background: #000d66;
                    color: white;
                }
            </style>
        </head>
        <body class="bg-light">
            <div class="container">
                <h2 class="text-center mb-4">Write a Review</h2>
                <form method="POST" action="submit_review.php?tour_id=<?= $_GET['id'] ?>">

                    <div class="rating">
                        <input type="radio" name="rating" value="5" id="star5" required>
                        <label for="star5">★</label>
                        <input type="radio" name="rating" value="4" id="star4">
                        <label for="star4">★</label>
                        <input type="radio" name="rating" value="3" id="star3">
                        <label for="star3">★</label>
                        <input type="radio" name="rating" value="2" id="star2">
                        <label for="star2">★</label>
                        <input type="radio" name="rating" value="1" id="star1">
                        <label for="star1">★</label>
                    </div>
        
                    <div class="mb-3">
                        <label for="comment" class="form-label">Your Review</label>
                        <textarea class="form-control" id="comment" name="comment" rows="5" required 
                                  placeholder="Share your experience about this tour..."></textarea>
                    </div>
        
                    <div class="text-center">
                        <button type="submit" class="btn btn-submit">Submit Review</button>
                    </div>
                </form>
            </div>
        
            <script>
                // Highlight stars on hover
                const stars = document.querySelectorAll('.rating label');
                stars.forEach(star => {
                    star.addEventListener('mouseover', () => {
                        const rating = star.getAttribute('for').replace('star', '');
                        highlightStars(rating);
                    });
                });
        
                const ratingContainer = document.querySelector('.rating');
                ratingContainer.addEventListener('mouseout', () => {
                    const checkedStar = document.querySelector('.rating input:checked');
                    if (checkedStar) {
                        const rating = checkedStar.value;
                        highlightStars(rating);
                    } else {
                        stars.forEach(star => star.style.color = '#ddd');
                    }
                });
        
                function highlightStars(rating) {
                    stars.forEach(star => {
                        const starRating = star.getAttribute('for').replace('star', '');
                        star.style.color = starRating <= rating ? '#001399' : '#ddd';
                    });
                }
            </script>
        </body>
        </html>  