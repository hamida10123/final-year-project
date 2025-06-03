<?php include("head.php"); ?>
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../phpmailer/PHPMailer.php';
require '../phpmailer/SMTP.php';
require '../phpmailer/Exception.php';

// --- DB CONNECTION ---
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "hri";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// --- HANDLE FORM SUBMISSION ---
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name    = $conn->real_escape_string($_POST["name"]);
    $email   = $conn->real_escape_string($_POST["email"]);
    $subject = $conn->real_escape_string($_POST["subject"]);
    $message = $conn->real_escape_string($_POST["message"]);

    $sql = "INSERT INTO contact_messages (name, email, subject, message)
            VALUES ('$name', '$email', '$subject', '$message')";
    $conn->query($sql);

    // --- SEND EMAIL ---
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'hamidamirza12@gmail.com'; // YOUR GMAIL
        $mail->Password   = 'lkjl jjmt bcsi ezsj';       // APP PASSWORD (not Gmail login)
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        $mail->setFrom('hamidamirza12@gmail.com', 'HRI Tours');
        $mail->addAddress($email);  // Send to user
        $mail->isHTML(true);
        $mail->Subject = "Thanks for contacting HRI Tours!";
        $mail->Body    = "<h3>Thank you, $name!</h3><p>We received your message:</p><p><b>$subject</b></p><p>$message</p>";

        $mail->send();
        echo "<script>alert('Your message has been sent successfully!');</script>";
    } catch (Exception $e) {
        echo "<script>alert('Message could not be sent. Mailer Error: {$mail->ErrorInfo}');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Contact Us - HRI TOURS</title>
    <link rel="stylesheet" href="../css/header.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            margin: 0;
            padding: 0;
        }

        .contact-us {
            margin-top: 50px;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .line {
            display: inline-block;
            width: 10%;
            height: 2px;
            background-color: #001399;
            margin: 10px;
        }

        h2 {
            display: inline-block;
            font-size: 24px;
            color: #001399;
        }

        .query-text {
            margin-top: 10px;
            font-size: 16px;
            color: black;
            font-weight: bold;
        }

        .contact-container {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            margin-top: 30px;
        }

        .contact-info, .contact-form {
            background-color: #fff;
            border-radius: 8px;
            padding: 10px;
            margin: 10px;
        }

        .contact-info {
            width: 25%;
            border: 1px solid #ccc;
        }

        .contact-info p {
            display: flex;
            align-items: center;
            margin: 10px 0;
            justify-content: center;
        }

        .contact-info img {
            margin-right: 10px;
            width: 30px;
            height: 30px;
        }

        .contact-form {
            width: 65%;
            text-align: left;
        }

        .contact-form h3 {
            color: #001399;
        }

        .input-field {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        textarea {
            height: 120px;
        }

        .send-message {
            width: 100%;
            padding: 10px;
            background-color: #001399;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }

        .send-message:hover {
            background-color: #003366;
        }

        .map-container {
            margin-top: 40px;
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
      <h1 class="Our"> Contact Us</h1>
      <p><span style="color: blue; margin-right: 10px;">Home</span><span style="color: black; font-weight: bold;
 ">/</span><span style="color: blue; margin-right: 10px; margin-left:10px ;">Pages</span><span style="color: black; font-weight: bold;">/</span> <span style="margin-left: 10px;">Contact Us</span></p>
      
    </div>
    </div>

<div class="contact-us">
    <div class="line"></div>
    <h2>Contact Us</h2>
    <div class="line"></div>
    <p class="query-text">Contact for any query</p>

    <div class="contact-container">
        <div class="contact-info">
            <p><img src="https://i.ibb.co/5WHQypxn/icons8-location-50.png">Sara-i-Alamgir</p>
            <p><img src="https://i.ibb.co/vvBJJgtZ/icons8-call-64.png"> ‪+92 3466276492‬</p>
            <p><img src="https://i.ibb.co/8gLmWqdW/icons8-email-24.png"> hamidamirza12@gmail.com</p>
        </div>

        <div class="contact-form">
            <h3>Send us a message</h3>
            <form method="POST" action="">
                <input type="text" name="name" placeholder="Your Name" class="input-field" required>
                <input type="email" name="email" placeholder="Your Email" class="input-field" required>
                <input type="text" name="subject" placeholder="Subject" class="input-field" required>
                <textarea name="message" placeholder="Message" class="input-field" required></textarea>
                <button type="submit" class="send-message">Send Message</button>
            </form>
        </div>
    </div>
</div>

<div class="map-container"style="margin-bottom: 100px;"
>
    <iframe 
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d23286.67487068176!2d74.220315566219!3d35.31195399122689!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x38b1f5f9788c78ad%3A0x749db0d8b8c94f83!2sHunza%20Valley!5e0!3m2!1sen!2s!4v1671007078369!5m2!1sen!2s" 
        width="100%" height="500" style="border:0;" allowfullscreen="" loading="lazy">
    </iframe>
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
</body>
</html>

