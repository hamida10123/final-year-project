
  
    
<?php
// Database connection
$mysqli = new mysqli("localhost", "root", "", "hri");
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Fetch reviews from the database (latest first)
$query = "SELECT * FROM reviews ORDER BY created_at DESC";
$result = $mysqli->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reviews Page</title>
    <link rel="stylesheet" href="../css/header.css">
    <style>
        /*.riv{
            margin-top: 400px;
        }*/
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            padding: 20px;
        }
        .review {
            background-color: white;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .review-header {
            font-size: 1.1em;
            font-weight: bold;
            margin-bottom: 5px;
            color: #001399;
        }
        .review-rating {
            color: gold;
            font-size: 1.2em;
        }
        .review-text {
            margin-top: 10px;
        }
        .review-footer {
            margin-top: 10px;
            font-size: 0.9em;
            color: #555;
        }
        .profile-pic {
            max-width: 60px;
            max-height: 60px;
            border-radius: 50%;
            margin-right: 10px;
        }
    </style>
</head>
<body>


<div style="text-align: center;margin-bottom:100px;" >

<div class="line"></div>
        <h2 class="services">User Reviews</h2>
        <div class="line"></div>
        <p class="query-text">What People Says About Us??</p>
    </div>

<?php
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $name = $row['name'];
        $tour_name = $row['tour_name'];
        $rating = $row['rating'];
        $review_text = $row['review_text'];
        $created_at = $row['created_at'];
        $profile_picture = $row['profile_picture'];
        ?>
 



 
        <div class="review">
            <div class="review-header">
                <?php if ($profile_picture): ?>
                    <img src="<?php echo $profile_picture; ?>" alt="Profile Picture" class="profile-pic">
                <?php endif; ?>
                <?php echo htmlspecialchars($name); ?> - <?php echo htmlspecialchars($tour_name); ?>
            </div>

            <div class="review-rating">
                <?php
                for ($i = 1; $i <= $rating; $i++) {
                    echo "★";
                }
                for ($i = $rating + 1; $i <= 5; $i++) {
                    echo "☆";
                }
                ?>
            </div>

            <div class="review-text">
                <?php echo nl2br(htmlspecialchars($review_text)); ?>
            </div>

            <div class="review-footer">
                Submitted on: <?php echo date("F j, Y, g:i a", strtotime($created_at)); ?>
            </div>
        </div>

        <?php
    }
} else {
    echo "<p>No reviews found.</p>";
}

$mysqli->close();

?>

</body>
</html>


