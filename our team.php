<!DOCTYPE html>
<html>
<head>
    <title>Travel Guides</title>
    <link rel ="stylesheet" href="../css/header.css">
</head>
<body>
   
<div class="service-con"style="margin-top: 50px" >
    <div class="line"></div>
    <h2 class="services">Travel Guides</h2>
    <div class="line"></div>
    <p class="query-text" style="margin-bottom: 100px;">Meet Our Travel Guides</p>
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
