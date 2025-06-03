
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Careers - HRI Tours</title>
    <link rel="stylesheet" href="../css/contact.css">
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
    
  <div class="contact-us">
    <div class="line"></div>
    <h2>Contact Us</h2>
    <div class="line"></div>
    <p class="query-text">Contact for any query</p>

   

      <div class="contact-container">
        <div class="contact-info">
          <p><img src="https://i.ibb.co/5WHQypxn/icons8-location-50.png" width="100%" height="100%" ></p><p>University of XYZ, Some City</p>
          <p><img src="https://i.ibb.co/vvBJJgtZ/icons8-call-64.png"width="100%" height="100%" ><p>+92 300 1234567</p>
          <p><img src="https://i.ibb.co/8gLmWqdW/icons8-email-24.png"width="100%" height="100%" ><p>info@xyzuniversity.com</p>
        </div> 
      
      <div class="contact-form">
        <h3>Send us a message</h3>
        <form>
          <input type="text" placeholder="Your Name" class="input-field">
          <input type="email" placeholder="Your Email" class="input-field">
          <input type="text" placeholder="Subject" class="input-field">
          <textarea placeholder="Message" class="input-field"></textarea>
          <button type="submit" class="send-message">Send Message</button>
        </form> 
      </div>
    </div>
  </div>
  <div class="map-container">
    <iframe 
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d23286.67487068176!2d74.220315566219!3d35.31195399122689!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x38b1f5f9788c78ad%3A0x749db0d8b8c94f83!2sHunza%20Valley!5e0!3m2!1sen!2s!4v1671007078369!5m2!1sen!2s" 
        width="100%" height="500" style="border:0;" allowfullscreen="" loading="lazy">
    </iframe>

</div>