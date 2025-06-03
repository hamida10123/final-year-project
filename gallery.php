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

$query = "SELECT * FROM gallery";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html>
<head>         

    <title>Travel Guides</title>
    <link rel="stylesheet" href="../css/header.css">
    <style>
         
.gally {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    }

.imagerrr {
    margin: 10px;
    width: calc(33.33% - 20px);
    transition: transform 0.5s;
}

.imagerrr img {
    width: 100%; /* Use full width for images to make them responsive */
    height: 150px;
    object-fit: cover;
    border-radius: 10px;
}

/* Filter buttons container */
.filter-buttons {
    margin: 20px;
    text-align: center; /* Center the filter buttons */
}

.filter-buttons .filter-btn {
    background-color: white;
    color: #001399;
    border: 2px solid black;
    padding: 10px 25px;
    margin: 5px;
    font-size: 16px;
    cursor: pointer;
    border-radius: 50px;
    transition: 0.3s;
    margin-left: 60px; /* Adjust margin */
}

.filter-buttons .filter-btn:active, 
.filter-buttons .filter-btn.selected {
    background-color: #001399;
    color: white;
    border: 2px solid black;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    /* For smaller screens, adjust gallery images */
    .imagerrr {
        width: calc(50% - 20px); /* Images take up half of the container */
    }
    
    /* Adjust the filter button margin and width */
    .filter-buttons .filter-btn {
        margin-left: 10px; /* Reduce left margin */
        padding: 8px 20px; /* Reduce padding */
    }
}

@media (max-width: 480px) {
    /* For very small screens, adjust gallery images to full width */
    .imagerrr {
        width: calc(100% - 20px); /* Images take up full width */
    }

    /* Adjust filter button text and layout */
    .filter-buttons .filter-btn {
        font-size: 14px; /* Smaller font size */
        padding: 8px 15px; /* Reduce padding */
        margin-left: 5px; /* Adjust margin */
    }
}/* Main guide container */
.guide-container {
    display: flex;
    justify-content: space-between;
    flex-wrap: nowrap; /* Keeps items in a single row unless specified otherwise in the media queries */
}

/* Guide item styles */
.guide {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin: 20px;
    width: 30%; /* Each guide takes up 30% of the container */
}

/* Guide image container */
.guide-picture {
    width: 300px;
    height: 250px;
    border-radius: 20px;
    overflow: hidden;
    display: flex;
    justify-content: center;
    align-items: center;
}

/* Image styling */
.guide-picture img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* Line styling for separation */
.line {
    display: inline-block;
    width: 10%;
    height: 2px;
    background-color: #001399;
    margin: 10px 10px 10px 10px;
}

/* Service container */
.service-con {
    text-align: center;
    margin-top: 50px;
}

/* Service text styling */
.services {
    display: inline-block;
    font-size: 24px;
    color: #001399;
    margin: 0 10px;
}

/* Service item click styling */
.service.clicked {
    background-color: #001399;
    color: black;
}

/* Query text styling */
.query-text {
    margin-top: 10px;
    font-size: 16px;
    color: black;
    font-weight: bold;
}
.navbar {
  max-width: 1200px; /* or whatever width you want */
  margin: 0 auto;
  padding: 10px 20px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  flex-wrap: nowrap; /* no wrapping */
}

.search-bar-container {
  position: relative;
  width: 320px; /* Google style width */
  flex-shrink: 0; /* prevent shrinking */
  margin: 0; /* remove auto margin to avoid navbar stretching */
}

.search-bar {
  width: 100%;
  padding: 10px 40px 10px 15px; /* Right padding for icon */
  font-size: 16px;
  border: 1px solid #dfe1e5;
  border-radius: 24px;
  box-shadow: 0 2px 5px rgb(0 0 0 / 0.2);
  outline: none;
  transition: box-shadow 0.2s ease;
  box-sizing: border-box;
}

.search-bar:focus {
  box-shadow: 0 4px 8px rgb(66 133 244 / 0.6);
  border-color: #4285f4;
}

.search-icon {
  position: absolute;
  right: 15px;
  top: 50%;
  transform: translateY(-50%);
  color: #9aa0a6;
  font-size: 18px;
  pointer-events: none;
  user-select: none;
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
      <a href="booking.php" class="bookingon">Book Now</a>
    </div>
    <div class="hope">
      <h1 class="Our"> Gallery</h1>
      <p><span style="color: blue; margin-right: 10px;">Home</span><span style="color: black; font-weight: bold;
 ">/</span><span style="color: blue; margin-right: 10px; margin-left:10px ;">Pages</span><span style="color: black; font-weight: bold;">/</span> <span style="margin-left: 10px;">Gallery</span></p>
      
    </div>
    </div>
<!-- Gallery Heading -->
<div class="hnnn" style="text-align:center;margin-bottom:100px;margin-top:50px;">
    <div class="line"></div>
    <h2 class="services">Gallery</h2>
    <div class="line"></div>
    <p class="query-text">Pakistan beauty</p>
</div>

<!-- Filter Buttons -->
<div class="filter-buttons">
    <button class="filter-btn" onclick="filterImages('all', this)">All</button>
    <button class="filter-btn" onclick="filterImages('Cold Areas', this)">Cold Areas</button>
    <button class="filter-btn" onclick="filterImages('Hot Areas', this)">Hot Areas</button>
    <button class="filter-btn" onclick="filterImages('Cultural Areas', this)">Cultural Areas</button>
    <button class="filter-btn" onclick="filterImages('Adventure Areas', this)">Adventure Areas</button>
</div>

<!-- Gallery Images from PHP -->
<div class="gally">
    <?php while($row = mysqli_fetch_assoc($result)): ?>
        <div class="imagerrr" data-category="<?= htmlspecialchars($row['category']) ?>">
            <img src="<?= htmlspecialchars($row['image_url']) ?>" alt="<?= htmlspecialchars($row['category']) ?>">
        </div>
    <?php endwhile; ?>
</div>
<div class="ft" style="width:1400px; , 
">
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




<!-- JavaScript for Filtering -->
<script>
function filterImages(category, btn) {
    const buttons = document.querySelectorAll('.filter-btn');
    buttons.forEach(b => b.classList.remove('selected'));
    btn.classList.add('selected');

    const images = document.querySelectorAll('.imagerrr');
    images.forEach(image => {
        const imgCat = image.getAttribute('data-category');
        if (category === 'all' || imgCat === category) {
            image.style.display = 'block';
        } else {
            image.style.display = 'none';
        }
    });
}
</script>
