<?php include("head.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Gamification Steps</title>
<link rel="stylesheet" href="../css/header.css">
<style>
  body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: #f4f7fc;
   
  }
  .gamification-container {
    max-width: 500px;
    margin: 0 auto;
     padding: 20px;
    margin-top: 100px;
    background: white;
    border: 2px solid #001399;
    border-radius: 10px;
    margin-bottom: 100px; 
    padding: 25px 30px;
    box-shadow: 0 4px 10px rgba(0, 19, 153, 0.15);
  }
  .gamification-container h2 {
    color: #001399;
    text-align: center;
    margin-bottom: 20px;
    font-weight: 700;
  }
  ol.gamification-steps {
    list-style: none;
    counter-reset: step-counter;
    padding-left: 0;
  }
  ol.gamification-steps li {
    counter-increment: step-counter;
    background: #e6ecff;
    border-radius: 8px;
    padding: 15px 20px;
    margin-bottom: 15px;
    display: flex;
    align-items: center;
    gap: 15px;
    box-shadow: 0 1px 5px rgba(0, 0, 0, 0.1);
  }
  ol.gamification-steps li::before {
    content: counter(step-counter);
    flex-shrink: 0;
    background: #001399;
    color: white;
    font-weight: 700;
    border-radius: 50%;
    width: 30px;
    height: 30px;
    line-height: 30px;
    text-align: center;
    font-size: 16px;
  }
  .step-icon {
    font-size: 24px;
    flex-shrink: 0;
    color: #001399;
  }
  .step-text {
    color: #333;
    font-size: 16px;
    line-height: 1.4;
  }
  .highlight {
    font-weight: 700;
    color: #001399;
  }
  .check-points-btn {
    display: block;
    margin: 25px auto 0 auto;
    background-color: #001399;
    color: white;
    font-weight: 600;
    padding: 12px 20px;
    text-align: center;
    border-radius: 8px;
    text-decoration: none;
    max-width: 200px;
    transition: background-color 0.3s ease;
  }
  .check-points-btn:hover {
    background-color: #0033cc;
  }
  @media (max-width: 600px) {
    .gamification-container {
      padding: 20px 15px;
    }
    ol.gamification-steps li {
      flex-direction: column;
      align-items: flex-start;
    }
    .step-icon {
      margin-bottom: 8px;
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
      <h1 class="Our">Gamification</h1>
      <p><span style="color: blue; margin-right: 10px;">Home</span><span style="color: black; font-weight: bold;
 ">/</span><span style="color: blue; margin-right: 10px; margin-left:10px ;">Pages</span><span style="color: black; font-weight: bold;">/</span> <span style="margin-left: 10px;">Gamification</span></p>
      
    </div>
    </div>

<div class="gamification-container">
  <h2>How Gamification Works</h2>
  <ol class="gamification-steps">
    <li>
      <div class="step-icon">🛒</div>
      <div class="step-text"><span class="highlight">Book a Tour:</span> When you book a tour with us, you do not get points immediately.</div>
    </li>
    <li>
      <div class="step-icon">✍️</div>
      <div class="step-text"><span class="highlight">Give a Review:</span> After completing your tour, leave a review to earn <span class="highlight">1000 points</span>.</div>
    </li>
    <li>
      <div class="step-icon">🎟️</div>
      <div class="step-text"><span class="highlight">Redeem Points:</span> Use your points on your next booking to get a <span class="highlight">10% discount</span>.</div>
    </li>
    <li>
      <div class="step-icon">📊</div>
      <div class="step-text"><span class="highlight">Check Points Balance:</span> View your current points anytime on your profile page.</div>
    </li>
  </ol>
  <a href="profile.php" class="check-points-btn" title="Go to your profile to check points">Check Your Points</a>
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
</body>
</html>
