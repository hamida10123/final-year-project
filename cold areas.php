<?php include("head.php"); ?>
<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "hri";

$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Query to fetch all cold area tours with their ratings
$sql = "SELECT t.tour_id, t.tour_name, t.main_image, t.price, t.discount, 
               IFNULL(AVG(r.rating), 0) AS average_rating, 
               COUNT(r.review_id) AS review_count
        FROM tours t
        LEFT JOIN tour_reviews r ON t.tour_id = r.tour_id
        WHERE t.category = 'cold'  -- Only select cold area tours
        GROUP BY t.tour_id";

$result = mysqli_query($conn, $sql);

// Assume exchange rate is 1 USD = 300 PKR
$exchange_rate = 300;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Cold Area Tours</title>
  <link rel="stylesheet" href="../css/header.css">
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f9f9f9;
      margin: 0;
      padding: 0;
    }
    .tour-packages {
      
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 30px;
      margin: 50px 20px;
    }
    .tour-card {
      width: 300px;
      background-color: #fff;
      border: 1px solid #ddd;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      text-align: center;
      transition: transform 0.3s;
    }
    .tour-card:hover {
      transform: scale(1.05);
    }
    .tour-card img {
      width: 100%;
      height: 200px;
      object-fit: cover;
      border-bottom: 1px solid #ddd;
    }
    .tour-card h2 {
      font-size: 22px;
      margin: 15px 0;
      color: #001399;
    }
    .tour-btn {
      background-color: #001399;
      color: white;
      border: none;
      padding: 10px 15px;
      margin: 5px;
      border-radius: 6px;
      cursor: pointer;
      transition: background-color 0.3s;
      text-decoration: none;
      display: inline-block;
      font-weight: bold;
    }
    .tour-btn:hover {
      background-color: #000d80;
    }
    .rating {
      color: gold;
      font-size: 18px;
    }
    p.price {
      font-weight: bold;
      margin: 10px 0;
      font-size: 18px;
    }
    p.price span.old-price {
      text-decoration: line-through;
      color: red;
      margin-right: 10px;
    }
  </style>
</head>
<body>


  </div>

  
  <div class="loop">
  
    
    <div class="navbar-2">
      <div class="logo">HRI Tours</div>
      <div class="menu">
        <a href="home.php" onclick="localStorage.clear()">Home</a>
        <a href="services.php" onclick="localStorage.clear()">Services</a>
        <a href="tours.php" onclick="localStorage.clear()">Tours</a>
        <a href="gamification.php" onclick="localStorage.clear()">Reward</a>
        <a href="AR.php" onclick="localStorage.clear()">Explore</a>
        <a href="about us.php" onclick="localStorage.clear()">About Us</a>
        <a href="contact.php" onclick="localStorage.clear()">Contact Us</a>
        <div class="more-pages-dropdown">
          <a href="#">More Pages</a>
          <div class="more-pages-menu">
            <a href="destination.php" onclick="localStorage.clear()">Destination</a>
            <a href="booking.php" onclick="localStorage.clear()">Travel Booking</a>
            <a href="gallery.php" onclick="localStorage.clear()">Gallery</a>
            <a href="travel_guides.php" onclick="localStorage.clear()">Travel Guides</a>
            <a href="fetch_blogs.php" onclick="localStorage.clear()">Blogs</a>
          </div>
        </div>
      </div>
      <a href="booking.php" class="bookingon">Book Now</a>
    </div>
      <div class="hope">
      <h1 class="Our">Cold Areas Tours</h1>
      <p><span style="color: blue; margin-right: 10px;">Home</span><span style="color: black; font-weight: bold;
 ">/</span><span style="color: blue; margin-right: 10px; margin-left:10px ;">Pages</span><span style="color: black; font-weight: bold;">/</span> <span style="margin-left: 10px;">Cold Areas Tours</span></p>
      
    </div>
    </div>
    
  <div class="tour-packages">
    <?php
    if (mysqli_num_rows($result) > 0) {
        while ($tour = mysqli_fetch_assoc($result)) {
            // Calculate price after discount in USD
            $discount_price = $tour['price'] - ($tour['price'] * $tour['discount'] / 100);
            
            // Convert price to PKR
            $price_in_pkr = $tour['price'] * $exchange_rate;
            $discount_price_in_pkr = $discount_price * $exchange_rate;
    ?>
            <div class="tour-card">
                <img src="../php/uploads/<?php echo htmlspecialchars($tour['main_image']); ?>" alt="Tour Image" />
                <h2><?php echo htmlspecialchars($tour['tour_name']); ?></h2>
                
                <p class="price">
                    <?php if ($tour['discount'] > 0) { ?>
                        <span class="old-price">PKR <?php echo number_format($price_in_pkr, 0); ?></span> 
                        PKR <?php echo number_format($discount_price_in_pkr, 0); ?>
                    <?php } else { ?>
                        PKR <?php echo number_format($price_in_pkr, 0); ?>
                    <?php } ?>
                </p>

                <p class="rating">
                    <?php
                    for ($i = 0; $i < 5; $i++) {
                        echo ($i < round($tour['average_rating'])) ? '★' : '☆';
                    }
                    ?>
                    (<?php echo $tour['review_count']; ?> reviews)
                </p>

                <a href="tours_page.php?tour_id=<?php echo $tour['tour_id']; ?>" class="tour-btn">View Details</a>
                <a href="book now.php?tour_id=<?php echo $tour['tour_id']; ?>" class="tour-btn">Book Now</a>
            </div>
    <?php
        }
    } else {
        echo "<p style='text-align:center; width:100%;'>No cold area tours available at the moment.</p>";
    }
    mysqli_close($conn);
    ?>
  </div>
 <div class="ft" style="width:1400px;">
   <div class="ftbg"></div>
   <img src="https://i.ibb.co/sd5WqCR2/travela.jpg" alt="Background Image" class="bgig">
   <div class="text-content">
     <p class="hnng">Subscribe</p>
     <p class="hnng">Our Newsletter</p>
     <div class="subscribe-button">
       <input type="email" placeholder="Enter your email">
       <button>Subscribe</button>
     </div>
   </div>
 </div>
 <footer>
   <div class="ftt">
     <div class="ft1">
       <h2 style="color: white; font-weight: bold; margin-bottom: 10px;">Get In Touch</h2>
       <p style="margin-bottom: 10px;">Address: 123 Main GT Road Sara i Alamgir</p>
       <p  style="margin-bottom: 10px;">Email: [info@example.com](mailto:info@example.com)</p>
       <p style="margin-bottom: 10px;">Phone: 555-555-5555</p>
       <p style="margin-bottom: 10px;">Fax: 555-555-5556</p>
       <div class="socials">
         <a href="#"><img src="https://i.ibb.co/Xfzp1Tsx/arrows.png" width="30" height="30"></a>
         
         <a href="#"><img src="https://i.ibb.co/3Yr6QGRh/fbb-g.png" width="30" height="30"></a>
         <a href="#"><img src="https://i.ibb.co/PG3Ztnf0/insta-g.png" width="30" height="30"></a>
         <a href="#"><img src="https://i.ibb.co/QFs72QZ3/x-g.png" width="30" height="30"></a>
         </div>
         
         
       
     </div>
    <div class="ft2">
       <h2 style="color: white; font-weight: bold;">Company</h2>
       <ul>
         <li><a href="about.php" onclick="localStorage.clear()">About</a></li>
         <li><a href="career.php" onclick="localStorage.clear()">Career</a></li>
         <li><a href="blogs.php" onclick="localStorage.clear()">Blog</a></li>
         <li><a href="press.php" onclick="localStorage.clear()">Press</a></li>
         <li><a href="../doc/Sitemap.pdf" onclick="localStorage.clear()">SiteMap</a> </li>
          <li><a href="our team.php" onclick="localStorage.clear()">Our Team</a> </li>
      
        
       </ul>
     </div>
     <div class="ft3">
       <h2 style="color: white; font-weight: bold;">Support</h2>
       <ul>
         <li><a href="../php/contact us .php" onclick="localStorage.clear()">Contact</a></li>
         <li><a href="../doc/legal notice.php" onclick="localStorage.clear()">Legal Notice</a></li>
         <li><a href="../doc/Privacy policy.php" onclick="localStorage.clear()">Privacy Policy</a></li>
         <li><a href="../doc/Terms of use.php" onclick="localStorage.clear()">Terms of Use</a></li>
         <li><a href="../doc/Policy.php" onclick="localStorage.clear()">Cookies Policy</a></li>
         <li><a href="Faq Page.php" onclick="localStorage.clear()">FAQ</a></li>
        </ul>
     </div>
     <div class="ft4">
   
           <select class="language-button">
             <option value="English">English</option>
             <option value="Urdu">Urdu</option>
           </select>
           <select class="converter-button">
             <option value="USD">USD</option>
             <option value="PKR">PKR</option>
           </select>
         
         
         
         
       <div class="payment-icons">
         <a href="#"><img src="https://i.ibb.co/tT3Pbn99/credit-card.png" width="30" height="30"></a>
         <a href="#"><img src="https://i.ibb.co/KjvZNpLw/debit-card.png" width="30" height="30"></a>
         <a href="#"><img src="https://i.ibb.co/Fqx04MW1/visa.png" width="30" height="30"></a>
       </div>
</div>
</div>
</div>
</body>
</html>
