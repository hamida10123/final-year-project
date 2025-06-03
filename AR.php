<?php include("head.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Us Section</title>
 
  <link rel="stylesheet" href="../css/header.css">
  <style>
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
        <h1 class="Our"> Explore Tours</h1>
        <p><span style="color: blue; margin-right: 10px;">Home</span><span style="color: black; font-weight: bold;
    ">/</span><span style="color: blue; margin-right: 10px; margin-left:10px ;">Pages</span><span style="color: black; font-weight: bold;">/</span> <span style="margin-left: 10px;">Explore Tours</span></p>
        
      </div>
      </div>
      
 
              
<div class="packages" style="margin-top: 20px;">
    <div class="line"></div>
    <h2 class="pak">Tours</h2>
    <div class="line"></div>
    <p class="explore">Explore AR</p>
    
  <div class="image-grid">
    <div class="imager">
      <img src="https://i.ibb.co/Cj4g79G/Cold-Areas.jpg" alt="Cold Areas">
      <div class="category-button">❄ Cold Areas</div>
      <div class="view-button"><a href="cold areas AR.php"style="color: white; text-decoration: none;">View AR →</a></div>
    </div>

    <div class="imager">
      <img src="https://i.ibb.co/xKSsh5sD/k2.jpg" alt="Warm Areas">
      <div class="category-button">☀ Warm Areas</div>
      <div class="view-button"><a href="warm areas AR.php"style="color: white; text-decoration: none;">View AR →</a></div>
    </div>

    <div class="imager">
      <img src="https://i.ibb.co/LhXz1ZY7/hunza-festival-abbasi-publication-1.jpg" alt="Cultural Areas">
      <div class="category-button">🏛 Cultural Areas</div>
     <div class="view-button"><a href="cultural.php"style="color: white; text-decoration: none;">View AR →</a></div>
    </div>
<div class="imager">
  <img src="https://i.ibb.co/b9Hryhp/k1.jpg" alt="Adventure Areas">
  <div class="button-container">
    <div class="category-button"style="  float: left;
">🏕 Adventure Areas</div>
   <span> <a href="Adventure areas AR.php"style="color: white; text-decoration: none;"><div class="view-button">View AR →</a></div></span>
  </div>
</div>
    
          </div>
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
</div>
</div>
</div>