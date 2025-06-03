<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "hri";

$con = mysqli_connect($servername, $username, $password, $database);
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
session_start();

$loggedIn = isset($_SESSION['user_id']); // or whatever session variable you use


if (isset($_GET['tour_id'])) {
    $tour_id = intval($_GET['tour_id']);
    
    $query = "SELECT * FROM tours WHERE tour_id = $tour_id";
    $result = mysqli_query($con, $query);
    
    if (!$result || mysqli_num_rows($result) == 0) {
        echo "<p>Tour not found.</p>";
        exit;
    }
    
    $tour = mysqli_fetch_assoc($result);
    
    $img_query = "SELECT image_path FROM tour_images WHERE tour_id = $tour_id";
    $img_result = mysqli_query($con, $img_query);
    
    $images = [];
    if ($img_result && mysqli_num_rows($img_result) > 0) {
        while ($row = mysqli_fetch_assoc($img_result)) {
            $images[] = $row['image_path'];
        }
    } else {
        $images[] = $tour['main_image'];
    }

    // FIX: Changed u.username to u.name (or correct field name)
    $rev_query = "SELECT tr.rating, tr.comment, u.name AS username, tr.created_at 
                  FROM tour_reviews tr 
                  JOIN users u ON tr.user_id = u.id
                  WHERE tr.tour_id = $tour_id
                  ORDER BY tr.created_at DESC";
    $rev_result = mysqli_query($con, $rev_query);
    
    $reviews = [];
    if ($rev_result && mysqli_num_rows($rev_result) > 0) {
        while ($row = mysqli_fetch_assoc($rev_result)) {
            $reviews[] = $row;
        }
    }
    
} else {
    echo "<p>No tour ID provided.</p>";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo htmlspecialchars($tour['tour_name']); ?> - Tour Details</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <style>
        body { font-family: Arial, sans-serif; background: #f9f9f9; margin: 0; padding: 0; }
        .container { max-width: 900px; margin: 20px auto; background: #fff; padding: 20px; border-radius: 8px; }
        .slider-wrapper { position: relative; overflow: hidden; }
        .slider { display: flex; transition: transform 0.4s ease-in-out; }
        .slider img { min-width: 100%; max-height: 400px; object-fit: cover; border-radius: 8px; }
        .nav-arrow {
            position: absolute; top: 45%; transform: translateY(-50%);
            font-size: 30px; background: rgba(0,0,0,0.3);
            color: white; border: none; cursor: pointer;
            padding: 10px; border-radius: 50%;
            user-select: none;
        }
        .nav-arrow:hover { background: rgba(0,0,0,0.6); }
        .left-arrow { left: 10px; }
        .right-arrow { right: 10px; }
        
        h1 { color: #001399; margin-top: 20px; }
        .price { font-size: 22px; margin: 15px 0; }
        .price .old-price { text-decoration: line-through; color: red; margin-right: 10px; }
        .stars { color: gold; font-size: 20px; }
        .duration, .description { margin: 15px 0; }
        .btn-group { margin-top: 25px; }
        .btn {
            background-color: #001399; color: white; padding: 12px 25px;
            text-decoration: none; margin-right: 10px; border-radius: 6px;
            font-weight: bold;
        }
        .btn:hover { background-color: #000d80; }
        
        .reviews { margin-top: 40px; }
        .review { border-top: 1px solid #ccc; padding: 15px 0; }
        .review:first-child { border-top: none; }
        .review .username { font-weight: bold; }
        .review .date { font-size: 0.9em; color: #666; }
        .review .rating { color: gold; }
        .review .comment { margin-top: 5px; }
    </style>
</head>
<body>

<div class="container">
    <div class="slider-wrapper">
        <button class="nav-arrow left-arrow" onclick="prevSlide()">&#10094;</button>
        <div class="slider" id="imageSlider">
            <?php foreach ($images as $img): ?>
                <img src="uploads/<?php echo htmlspecialchars($img); ?>" alt="Tour Image" />
            <?php endforeach; ?>
        </div>
        <button class="nav-arrow right-arrow" onclick="nextSlide()">&#10095;</button>
    </div>

    <h1><?php echo htmlspecialchars($tour['tour_name']); ?></h1>

    <div class="price">
        <?php if ($tour['discount'] > 0): ?>
            <span class="old-price">PKR <?php echo number_format($tour['price'], 0); ?></span>
            <span>PKR <?php echo number_format($tour['price'] - ($tour['price'] * $tour['discount'] / 100), 0); ?></span>
        <?php else: ?>
            PKR <?php echo number_format($tour['price'], 0); ?>
        <?php endif; ?>
    </div>

    <div class="stars">
        <?php
        $rating_query = "SELECT AVG(rating) AS avg_rating FROM tour_reviews WHERE tour_id = $tour_id";
        $rating_result = mysqli_query($con, $rating_query);
        $rating_data = mysqli_fetch_assoc($rating_result);
        $avg_rating = round($rating_data['avg_rating']);
        for ($i = 1; $i <= 5; $i++) {
            echo ($i <= $avg_rating) ? "★" : "☆";
        }
        ?>
    </div>

    <div class="duration"><strong>Duration:</strong> <?php echo htmlspecialchars($tour['duration']); ?></div>

    <div class="description"><strong>Description:</strong><br><?php echo nl2br(htmlspecialchars($tour['description'])); ?></div>
<a href="#" onclick="handleBookNow(<?php echo $tour_id; ?>)" class="btn">Book Now</a>

<script>
  function handleBookNow(tourId) {
    const isLoggedIn = localStorage.getItem("isLoggedIn");

    if (isLoggedIn === "true") {
      // If logged in, redirect to book now
      window.location.href = "book now.php?tour_id=" + tourId;
    } else {
      // If not logged in, go to register
      window.location.href = "../toursss/register.php";
    }
  }
</script>



      <a href="#" onclick="handleAddToCart(<?php echo $tour_id; ?>)" class="btn">Add to cart</a>
      <script>
  function handleAddToCart(tourId) {
    const isLoggedIn = localStorage.getItem("isLoggedIn");

    if (isLoggedIn === "true") {
      // If user is logged in, go to add_to_cart.php
      window.location.href = "add_to_cart.php?tour_id=" + tourId;
    } else {
      // If not logged in, redirect to register
      window.location.href = "../toursss/register.php";
    }
  }
</script>

     <a href="wishlist_add.php?tour_id=<?php echo $tour['tour_id']; ?>" title="Add to Wishlist">
    <i class="fas fa-heart"></i>
</a>

      
<a class="btn"href="/fyp/user dashboard/wishlist_add.php?tour_id=<?php echo $tour['tour_id']; ?>">Add to Wishlist</a>


        <a href="submit_review.php?tour_id=<?php echo $tour_id; ?>" class="btn">Write a Review</a>
    

    <div class="reviews">
        <h2>User Reviews</h2>
        <?php if (count($reviews) > 0): ?>
            <?php foreach ($reviews as $review): ?>
                <div class="review">
                    <div class="username"><?php echo htmlspecialchars($review['username']); ?></div>
                    <div class="date"><?php echo date('F j, Y', strtotime($review['created_at'])); ?></div>
                    <div class="rating">
                        <?php
                        for ($i = 1; $i <= 5; $i++) {
                            echo ($i <= $review['rating']) ? "★" : "☆";
                        }
                        ?>
                    </div>
                    <div class="comment"><?php echo nl2br(htmlspecialchars($review['comment'])); ?></div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No reviews yet.</p>
        <?php endif; ?>
    </div>
</div>

<script>
    let slider = document.getElementById('imageSlider');
    let index = 0;
    const slides = document.querySelectorAll('#imageSlider img');

    function showSlide(i) {
        const width = slides[0].clientWidth;
        slider.style.transform = 'translateX(' + (-width * i) + 'px)';
    }

    function nextSlide() {
        index = (index + 1) % slides.length;
        showSlide(index);
    }

    function prevSlide() {
        index = (index - 1 + slides.length) % slides.length;
        showSlide(index);
    }
</script>

</body>
</html>
