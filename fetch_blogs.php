<?php include("head.php"); ?>
<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "hri";

// Connect to database
$conn = mysqli_connect($host, $user, $pass, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Prepare the query
$query = "SELECT * FROM blogs ORDER BY published_date DESC";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Blog</title>
      <link rel="stylesheet" href="../css/header.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
   body {
    font-family: Arial, sans-serif;
    overflow-x: hidden;
  }
  .btn-read {
    background-color: #001399;
    color: white;
    font-weight: bold;
  }
  .btn-read {
      background-color: #001399;
      color: white;
      font-weight: bold;
    }
  .section-title h2 {
    color: #001399;
    font-weight: bold;
    border-bottom: 2px solid #001399;
    display: inline-block;
  }

  /* ✅ Fix for blog image */
  .card-img-top {
    width: 100%;
    height: 250px;
    object-fit: cover;
    display: block;
    margin-left: auto;
    margin-right: auto;
  }
</style>


</head>
<body>

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
      <h1 class="Our"> Blog</h1>
      <p><span style="color: blue; margin-right: 10px;">Home</span><span style="color: black; font-weight: bold;
 ">/</span><span style="color: blue; margin-right: 10px; margin-left:10px ;">Pages</span><span style="color: black; font-weight: bold;">/</span> <span style="margin-left: 10px;">Blog</span></p>
      
    </div>
    </div>
   
<div class="container" style="margin-top:100px;">
  <div class="text-center my-4">
      <div class="line"></div>
        <h2 class="services" style= " font-weight: bold;"
>Blog</h2>
        <div class="line"></div>
        <p class="query-text"style= " font-weight: thin;">Different Blogs</p>
    </div>

  <div class="row g-4">
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
      <div class="col-md-4">
        <div class="card h-100">
          <img src="uploads/<?php echo !empty($row['image']) ? $row['image'] : 'default.jpg'; ?>" class="card-img-top" alt="Blog Image">
          <div class="card-body text-center">
            <h5 class="card-title fw-bold"><?php echo htmlspecialchars($row['title']); ?></h5>
            <p class="mb-1">Published by : <span class="text-primary"><?php echo htmlspecialchars($row['author']); ?></span></p>
            <p>Published on: <?php echo date('F d, Y', strtotime($row['published_date'])); ?></p>
            <p><?php echo substr(htmlspecialchars($row['description']), 0, 100) . '...'; ?></p>
            <a href="view_blog.php?id=<?php echo $row['id']; ?>" class="btn btn-read">READ MORE</a>
          </div>
        </div>
      </div>
    <?php } ?>
  </div>
</div>

</body>
</html>
<?php
mysqli_close($conn); // Close the database connection
?>

<div class="ft" style="width:1400px; margin-top:100px;">
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
</body>
</html>
