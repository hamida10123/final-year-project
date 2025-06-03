<?php include("head.php"); ?>
<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "hri";

// Connect to the database
$conn = mysqli_connect($host, $user, $pass, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch data from the destinations table
$query = "SELECT * FROM destinations";
$result = mysqli_query($conn, $query);
?>
  <!DOCTYPE html>
<html>
<head>
    <title>Travel Guides</title>
    <link rel="stylesheet" href="../css/header.css">
    <style>
  .service-con {
    text-align: center;
    margin-top: 50px;
}

.line {
    display: inline-block;
    width: 10%;
    height: 2px;
    background-color: #001399;
    margin: 10px 10px 10px 10px;
}

.services {
    display: inline-block;
    font-size: 24px;
    color: #001399;
    margin: 0 10px;
}

.service.clicked {
    background-color: #001399;
    color: black;
}

.query-text {
    margin-top: 10px;
    font-size: 16px;
    color: black;
    font-weight: bold;
}
  .destination-container {
    max-width: 1000px; 
    margin: 40px auto;
    text-align: center;
    margin-top: 50px;
}

.destination-buttons {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 10px;
}

.oval-button {
    background-color: #fff;
    color: #001399;
    padding: 10px 15px;
    border: 2px solid #001399;
    border-radius: 25px;
    cursor: pointer;
    width: 150px;
    height: 40px;
    text-align: center;
    font-weight: bold;
    transition: all 0.3s ease-in-out;
    margin-left: 0px;
    margin-top: 90px;
}

.oval-button:hover,
.oval-button.active {
    background-color: #001399;
    color: #fff;
}

.destination-images {
    margin-top: 30px;
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 10px;
}

.image-container {
    width: 22%; 
    display: block;
}

.image-container img {
    width: 100%;
    height: 180px;
    object-fit: cover;
    border-radius: 10px;
}

/* Responsive adjustments */
@media (max-width: 1200px) {
    .image-container {
        width: 30%; /* Adjust images on medium screens */
    }
}

@media (max-width: 768px) {
    .oval-button {
        width: 120px; /* Adjust button size on smaller screens */
        height: 35px;
        margin-top: 50px;
    }

    .image-container {
        width: 45%; /* Adjust images on smaller screens */
    }
}

@media (max-width: 480px) {
    .destination-container {
        margin: 20px; /* Reduced margin for small screens */
    }

    .oval-button {
        width: 100px; /* Further reduce button size */
        height: 30px;
    }

    .image-container {
        width: 90%; /* Make images take full width on very small screens */
    }
}
</style>
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
      <h1 class="Our"> Destination</h1>
      <p><span style="color: blue; margin-right: 10px;">Home</span><span style="color: black; font-weight: bold;
 ">/</span><span style="color: blue; margin-right: 10px; margin-left:10px ;">Pages</span><span style="color: black; font-weight: bold;">/</span> <span style="margin-left: 10px;">Destination</span></p>
      
    </div>
    </div>
   
<!-- Destination Container -->
<div class="destination-container">
    <!-- Destination Header -->
    <div class="destination-header">
        <div class="line"></div>
        <h2 class="services">Destination</h2>
        <div class="line"></div>
        <p class="query-text">Popular Destinations</p>
    </div>

<!-- Filter Buttons -->
<div class="destination-buttons">
    <button class="oval-button" onclick="showImages('all', event)">ALL</button>
    <button class="oval-button" onclick="showImages('hunza-valley', event)">Hunza Valley</button>
    <button class="oval-button" onclick="showImages('naran', event)">Naran</button>
    <button class="oval-button" onclick="showImages('skardu', event)">Skardu</button>
    <button class="oval-button" onclick="showImages('muzaffarabad', event)">Muzzafarabad</button>
</div>
 <!-- ✅ Buttons div closed correctly -->

<!-- Destination Images -->
<div class="destination-images">
    <?php while($row = mysqli_fetch_assoc($result)): ?>
        <div class="image-container"
             id="<?= strtolower(str_replace(' ', '-', $row['name'])) ?>-images"
             data-category="<?= strtolower(str_replace(' ', '-', $row['name'])) ?>">
            <img src="<?= htmlspecialchars($row['image_url']) ?>"
                 alt="<?= htmlspecialchars($row['name']) ?>">
        </div>
    <?php endwhile; ?>
</div>
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
<script>
function showImages(category, event) {
    // Highlight the active button
    const buttons = document.querySelectorAll('.oval-button');
    buttons.forEach(button => button.classList.remove('active'));
    event.target.classList.add('active');

    // Get all the image containers
    const allImages = document.querySelectorAll('.image-container');
    
    // Loop through all image containers and show/hide based on category
    allImages.forEach(image => {
        const imgCategory = image.getAttribute('data-category'); // Get the category from the data attribute
        if (category === 'all' || imgCategory === category) {
            image.style.display = 'block';  // Show the image
        } else {
            image.style.display = 'none';  // Hide the image
        }
    });
}
</script>