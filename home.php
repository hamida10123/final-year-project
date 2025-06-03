<?php include 'head.php'; ?>
<?php

$host = "localhost";
$user = "root";
$pass = "";
$dbname = "hri";

$conn = mysqli_connect($host, $user, $pass, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}




// First query: fetch from destinations
$query1 = "SELECT * FROM destinations";
$result1 = mysqli_query($conn, $query1);

// Second query: fetch from gallery
$query2 = "SELECT * FROM gallery";
$result2 = mysqli_query($conn, $query2);


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>HRI Tours</title>

  <link rel="stylesheet" href="../css/home.css">

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
  .trip-steps {
    display: flex;
    flex-direction: row;
    justify-content: center;
    padding: 50px;
    background-color: #f9f9f9;
    align-items: center;
    flex-wrap: wrap;
}

.steps-text {
    max-width: 800px;
    width: 100%;
    text-align: center;
}



.step {
    display: flex;
    align-items: center;
    margin: 20px 0;
    justify-content: center;
    flex-wrap: wrap;
    width: 100%;
}

.step .icon {
    font-size: 2.2em;
    color: #f39c12;
    margin-right: 20px;
    min-width: 50px;
    text-align: center;
}

.step-content {
    text-align: left;
    max-width: 600px;
}

.step-content h3 {
    font-size: 1.3em;
    color: #2c3e50;
    margin-bottom: 8px;
}

.step-content p {
    color: #7f8c8d;
    margin: 0;
    font-size: 1em;
}

.packing {
    background-color: #001399;
    color: #fff;
    padding: 12px 30px;
    border: none;
    border-radius: 30px;
    cursor: pointer;
    font-size: 1em;
    transition: 0.3s;
    margin-top: 40px;
}

.packing:hover {
    background-color: #0030cc;
}

/* Responsive Design */
@media (max-width: 768px) {
    .trip-steps {
        flex-direction: column;
        padding: 30px;
    }

    .step {
        flex-direction: column;
        align-items: flex-start;
        text-align: left;
    }

    .step .icon {
        margin-bottom: 10px;
        font-size: 1.8em;
    }

    .step-content h3 {
        font-size: 1.1em;
    }

    .step-content p {
        font-size: 0.95em;
    }

    .packing {
        width: 100%;
    }
}

    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f4f4f4;
      text-align: center;
    }

    .packages {
      text-align: center;
      margin-top: 50px;
    }

    .line {
      display: inline-block;
      width: 10%;
      height: 2px;
      background-color: #001399;
      margin: 10px 10px;
    }

    .pak {
      display: inline-block;
      font-size: 24px;
      color: #001399;
      margin: 0 10px;
    }

    .explore {
      margin-top: 10px;
      font-size: 16px;
      color: black;
      font-weight: bold;
      margin-bottom: 50px;
    }

    .image-grid {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 20px;
      max-width: 900px;
      margin: auto;
      padding: 20px;
    }

    .imager {
      text-align: center;
      background-color: white;
      padding: 15px;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .imager img {
      width: 100%;
      height: 200px;
      object-fit: cover;
      border-radius: 10px;
    }

    /* Category Button Style */
    .category-button, .view-button {
      margin-top: 10px;
      display: inline-block;
      background-color: #001399;
      color: white;
      padding: 10px 25px;
      border-radius: 50px;
      font-size: 16px;
      font-weight: bold;
      text-align: center;
      transition: background-color 0.3s;
    }

    .category-button:hover, .view-button:hover {
      background-color: #000d66;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
      .image-grid {
        grid-template-columns: 1fr;
      }

      .pak {
        font-size: 20px;
      }

      .category-button, .view-button {
        font-size: 14px;
        padding: 8px 20px;
      }
    }

    @media (max-width: 480px) {
      .imager img {
        height: 150px;
      }

      .pak {
        font-size: 18px;
      }

      .category-button, .view-button {
        font-size: 13px;
        padding: 7px 18px;
      }
    }


#profileContainer {
  margin-right:90px;
  margin-left:100px;
}




    </style>


<link
  rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
/>

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
            <a href="view_cart.php" onclick="localStorage.clear()">Add to Cart</a>
          </div>
        </div>
      </div>
      <a href="booking.php" class="bookingon">Book Now</a>
    </div>
   
    <div class="hope">
      <h1>Explore the World</h1>
      <p>Let's travel with us</p>
      <a href="#" class="btn">Discover Now</a>
    </div>
    <div class="outer-btn">
     
    
<form action="search-handler.php" method="GET" class="tour-search-form">
  <!-- Search Field -->
  <input type="text" name="query" class="search-input" placeholder="🔍 Search destination e.g. Skardu, K2, Hunza..." />

  <!-- Filter Dropdown -->
  <select name="category" class="filter-select">
    <option value="">🎯 Filter By Category</option>
    <option value="cold">❄ Cold Areas</option>
    <option value="warm">☀ Warm Areas</option>
    <option value="cultural">🏛 Cultural Areas</option>
    <option value="adventure">🏕 Adventural Areas</option>
  </select>

  <!-- Submit Button -->
  <button type="submit" class="search-button">Search Tours</button>
</form>


       
      </div>
    </div>
  </div>
  
<div class="about-us"style=" margin-top: 100px;text-align: left;
 ">
  <div class="about-image">
   <img src="https://i.ibb.co/1GPRWKNG/girl.png"  alt="About Us">
  </div>

  <div class="about-text">
    <h2 class="about"style="color: #001399;">About us</h2><br>
    <h2 class="h22">Welcome to HRI<span style="color: #001399; margin-left: 10px;">TOURS</span></h2>

    <p>
      HRI Tours offers an exceptional experience for every traveler, providing expertly curated tours across Pakistan’s most stunning destinations. Whether you're exploring scenic landscapes, vibrant cities, or cultural heritage sites, we ensure your journey is memorable and enriching.
    </p>
    <p>
      Our commitment is to deliver seamless travel services with a focus on comfort, adventure, and local exploration. Let us guide you through the beauty of Pakistan with our wide range of personalized packages, catering to all preferences and budgets.
    </p>

    <ul>
      <li><span style="color: #001399;">➡</span> First Class Flights <span style="margin-left: 100px;"><span style="color: #001399;">➡</span> 5 Star Accommodations</span></li>
      <li><span style="color: #001399;">➡</span> 150 Premium City Tours <span style="margin-left: 60px;"><span style="color: #001399;">➡</span> Handpicked Hotels</span></li>
      <li><span style="color: #001399;">➡</span> Latest Model Vehicles <span style="margin-left: 80px;"><span style="color: #001399;">➡</span> 24/7 Service</span></li>
    </ul>

   
  </div>
</div>

    <div class="service-con">
        <div class="line"></div>
        <h2 class="services">Services</h2>
        <div class="line"></div>
        <p class="query-text">Our Services</p>
    
    
      
      <div class="services-container">
        <div class="service">
        
          <h3><img src="https://i.ibb.co/LzmgbQSy/worldwideweb.png">Packages</h3>
          <p>Explore customized tour packages tailored for your needs.</p>
        </div>
        <div class="service">
      
          <h3><img src="https://i.ibb.co/wH3cfHQ/hotel-reservation.png">Hotel Reservation</h3>
          <p>Book the best hotels and accommodations in the northern areas.</p>
        </div>
        <div class="service">
     
          <h3><img src="https://i.ibb.co/ycJcS0Qq/travelguides.png" >Travel Guides</h3>
          <p>Get assistance from experienced travel guides for a seamless trip.</p>
        </div>
        <div class="service">
          
          <h3><img src="https://i.ibb.co/7JJB4VJb/event-management.png">Event Management</h3>
          <p>Plan and manage events like festivals, weddings, and more.</p>
        </div>
      </div>
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
    <?php while($row = mysqli_fetch_assoc($result1)): ?>
        <div class="image-container"
             id="<?= strtolower(str_replace(' ', '-', $row['name'])) ?>-images"
             data-category="<?= strtolower(str_replace(' ', '-', $row['name'])) ?>">
            <img src="<?= htmlspecialchars($row['image_url']) ?>"
                 alt="<?= htmlspecialchars($row['name']) ?>">
        </div>
    <?php endwhile; ?>
</div>
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
  
  <div class="packages">
    <div class="line"></div>
    <h2 class="pak">Tours</h2>
    <div class="line"></div>
    <p class="explore">Explore Pakistan</p>
</div>
  <div class="image-grid">
    <div class="imager">
      <img src="https://i.ibb.co/Cj4g79G/Cold-Areas.jpg" alt="Cold Areas">
      <div class="category-button">❄ Cold Areas</div>
      <div class="view-button"><a href="cold areas.php"style="color: white; text-decoration: none;">View More →</a></div>
    </div>

    <div class="imager">
      <img src="https://i.ibb.co/xKSsh5sD/k2.jpg" alt="Warm Areas">
      <div class="category-button">☀ Warm Areas</div>
      <div class="view-button"><a href="warm areas.php"style="color: white; text-decoration: none;">View More →</a></div>
    </div>

    <div class="imager">
      <img src="https://i.ibb.co/LhXz1ZY7/hunza-festival-abbasi-publication-1.jpg" alt="Cultural Areas">
      <div class="category-button">🏛 Cultural Areas</div>
     <div class="view-button"><a href="cultural areas.php"style="color: white; text-decoration: none;">View More →</a></div>
    </div>
<div class="imager">
  <img src="https://i.ibb.co/b9Hryhp/k1.jpg" alt="Adventure Areas">
  <div class="button-container">
    <div class="category-button"style="  float: left;
">🏕 Adventure Areas</div>
   <span> <a href="adventural areas.php"style="color: white; text-decoration: none;"><div class="view-button">View More →</a></div></span>
  </div>
</div>

</div>

<section class="trip-steps">
  
      
    <div class="service-con">
        <div class="line"></div>
        <h2 class="services">Book your tours</h2>
        <div class="line"></div>
        <p class="query-text">In Easy 3 steps</p>
        <div class="step">
            <div class="icon">&#127956;</div>
            <div class="step-content">
                <h3>Select Your Destination</h3>
                <p>Choose your favorite place in Pakistan — like Swat, Hunza, Murree or Skardu.</p>
            </div>
        </div>

        <div class="step">
            <div class="icon">&#128179;</div>
            <div class="step-content">
                <h3>Confirm Your Booking</h3>
                <p>Fill our form or contact us on WhatsApp, then make payment via Easypaisa or bank.</p>
            </div>
        </div>

        <div class="step">
            <div class="icon">&#128652;</div>
            <div class="step-content">
                <h3>Join the Tour</h3>
                <p>Arrive at the pickup point on your selected date. Enjoy your group trip!</p>
            </div>
        </div>
        
        <br>
        <a href="book now.php">
            <button class="packing">Book Now</button>
        </a>  
    </div>
</section>
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
    <?php while($row = mysqli_fetch_assoc($result2)): ?>
        <div class="imagerrr" data-category="<?= htmlspecialchars($row['category']) ?>">
            <img src="<?= htmlspecialchars($row['image_url']) ?>" alt="<?= htmlspecialchars($row['category']) ?>">
        </div>
    <?php endwhile; ?>
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
<div style="display: flex; align-items: center; gap: 15px; flex-wrap: wrap;">
<h2 style="color: white; font-weight: bold; white-space: nowrap; margin: 0;">Support Hours</h2>

  <p style="color: #ccc; font-size: 14px; margin: 0;">
    Mon – Fri: 9:00 AM – 6:00 PM <br><br>Saturday: 10:00 AM – 4:00 PM <br><br> Sunday: Closed
  </p>
</div>




 
         
       <div class="payment-icons">
         <a href="#"><img src="https://i.ibb.co/tT3Pbn99/credit-card.png" width="30" height="30"></a>
         <a href="#"><img src="https://i.ibb.co/KjvZNpLw/debit-card.png" width="30" height="30"></a>
         <a href="#"><img src="https://i.ibb.co/Fqx04MW1/visa.png" width="30" height="30"></a>
       </div>

</body>
</html>