<?php include("head.php"); ?>
<?php include("header.php"); ?>
<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "hri";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$guides = [];
$sql = "SELECT * FROM travel_guides";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $guides[] = $row;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Travel Guides</title>
    <link rel ="stylesheet" href="../css/header.css">
</head>
<body>
 
           
<div class="hope">
      <h1 class="Our"> Travel Guides</h1>
      <p><span style="color: blue; margin-right: 10px;">Home</span><span style="color: black; font-weight: bold;
 ">/</span><span style="color: blue; margin-right: 10px; margin-left:10px ;">Pages</span><span style="color: black; font-weight: bold;">/</span> <span style="margin-left: 10px;">Travel Guides</span></p>
      
    </div>
    </div>
      

<div class="service-con"style="margin-top: 50px" >
    <div class="line"></div>
    <h2 class="services">Travel Guides</h2>
    <div class="line"></div>
    <p class="query-text" style="margin-bottom: 100px;">Meet Our Travel Guides</p>

    <div class="guide-container">
        <?php foreach ($guides as $guide): ?>
        <div class="guide">
            <div class="guide-picture">
                <img src="<?= htmlspecialchars($guide['image_url']) ?>" alt="<?= htmlspecialchars($guide['name']) ?>">
            </div>
            <div class="guide-info">
                <h4><?= htmlspecialchars($guide['name']) ?></h4>
                <p><?= htmlspecialchars($guide['role']) ?></p>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
<script>
    const guides = document.querySelectorAll('.guide');
      
      guides.forEach(guide => {
      guide.addEventListener('click', () => {
      guides.forEach(g => {
      g.style.backgroundColor = '';
      g.style.color = '';
      });
      guide.style.backgroundColor = '#001399';
      guide.style.color = '#fff';
      });
      });
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
