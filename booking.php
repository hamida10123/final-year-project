
<?php include("head.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Cold Area Tours</title>
  <link rel="stylesheet" href="../css/header.css">
  <style>
    
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
      <h1 class="Our">Booking Steps</h1>
      <p><span style="color: blue; margin-right: 10px;">Home</span><span style="color: black; font-weight: bold;
 ">/</span><span style="color: blue; margin-right: 10px; margin-left:10px ;">Pages</span><span style="color: black; font-weight: bold;">/</span> <span style="margin-left: 10px;">Booking Steps</span></p>
      
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
 