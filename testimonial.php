<?php
$conn = mysqli_connect("localhost", "root", "", "hri");
$sql = "SELECT r.review_text, r.rating, u.name, u.city 
        FROM reviews r 
        JOIN users u ON r.user_id = u.user_id 
        ORDER BY r.rating DESC 
        LIMIT 4";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Testimonials</title>
    <style>
        .testimonial-carousel {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin-bottom: 100px;
        }

        .testimonial-item {
            background: #fff;
            border-radius: 10px;
            padding: 20px;
            margin: 10px;
            text-align: center;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            width: 250px;
        }

        .testimonial-item img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            margin-bottom: 10px;
        }

        .testimonial-info h4 {
            margin: 5px 0 0;
            color: #001399;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="testimonial">
    <div class="line"></div>
    <h2 class="services">Testimonial</h2>
    <div class="line"></div>
    <p class="query-text" style="margin-bottom: 20px; margin-top:0%;">What Clients Say About Us??</p>
</div>

<div class="testimonial-carousel">
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <div class="testimonial-item">
            <img src="images/default-user.png" alt="Client">
            <p>"<?= htmlspecialchars($row['review_text']) ?>"</p>
            <div class="testimonial-info">
                <h4><?= htmlspecialchars($row['name']) ?></h4>
                <p><?= htmlspecialchars($row['city']) ?>, Pakistan</p>
            </div>
        </div>
    <?php } ?>
</div>

</body>
</html>
