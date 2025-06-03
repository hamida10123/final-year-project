<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "hri";

$con = new mysqli($servername, $username, $password, $database);
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

$booking_id = $_GET['booking_id'] ?? null;

$username = "Valued Customer";
$tour_title = "";

if ($booking_id) {
    $sql = "SELECT u.name, t.tour_name 
            FROM bookings b
            JOIN users u ON b.user_id = u.id
            JOIN tours t ON t.tour_id = b.tour_id
            WHERE b.booking_id = ?";
    
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $booking_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $username = $row['name'];
        $tour_title = $row['tour_name'];
    }
}

// Define safety tips as arrays of points for each tour
$safety_tips = [
    "Hunza Tour" => [
        "Dress warmly for cold weather.",
        "Stay hydrated and carry snacks.",
        "Carry a fully charged phone.",
        "Avoid wandering alone at night."
    ],
    "Murree Tour" => [
        "Wear comfortable shoes.",
        "Carry rain gear during monsoon.",
        "Beware of crowded areas.",
        "Follow local guidelines."
    ],
    "Skardu Tour" => [
        "Pack warm clothing.",
        "Carry medicines for altitude sickness.",
        "Avoid drinking tap water.",
        "Inform your guide if feeling unwell."
    ],
    "Malam Jabba Tour" => [
        "Use proper ski equipment.",
        "Follow ski resort safety instructions.",
        "Avoid risky slopes if you are a beginner.",
        "Wear helmets and protective gear."
    ],
    "Naltar Valley Tour" => [
        "Keep warm clothing handy.",
        "Watch your step on icy paths.",
        "Carry a first aid kit.",
        "Travel with a guide in remote areas."
    ],
    "Neelum Valley Tour" => [
        "Carry waterproof jackets.",
        "Respect local culture and environment.",
        "Avoid late night travel.",
        "Always keep emergency contacts."
    ],
    "Chitral Valley Tour" => [
        "Respect local customs.",
        "Carry extra warm clothes.",
        "Use reliable transportation.",
        "Inform someone about your itinerary."
    ],
    "Rawalakot Tour" => [
        "Stay hydrated.",
        "Protect yourself from sun.",
        "Carry insect repellent.",
        "Avoid wandering in isolated areas at night."
    ],
    "Kaghan Valley Tour" => [
        "Pack comfortable hiking shoes.",
        "Carry rain gear.",
        "Avoid drinking untreated water.",
        "Stay on marked trails."
    ],
    "K2 Base Camp Tour" => [
        "Be physically prepared.",
        "Acclimatize properly.",
        "Use proper climbing equipment.",
        "Always follow your guide's instructions."
    ],
    "Deosai National Park Tour" => [
        "Carry warm clothes and supplies.",
        "Respect wildlife.",
        "Avoid littering.",
        "Be cautious of weather changes."
    ],
    "Naran Kaghan Adventure Tour" => [
        "Stay hydrated.",
        "Pack layers for variable weather.",
        "Use sunscreen.",
        "Follow adventure safety protocols."
    ],
    "Tirich Mir Expedition" => [
        "Be physically fit.",
        "Use proper mountaineering gear.",
        "Carry oxygen if required.",
        "Always travel with experienced guides."
    ],
    "Fairy Meadows Hike" => [
        "Wear sturdy hiking boots.",
        "Carry sufficient water.",
        "Avoid hiking at night.",
        "Stay with your group."
    ],
    "Kalash Cultural Festival Tour" => [
        "Respect cultural norms.",
        "Dress modestly.",
        "Avoid photography without permission.",
        "Carry minimal valuables."
    ],
    "Muzaffarabad Heritage Tour" => [
        "Follow local guidelines.",
        "Stay alert in crowded places.",
        "Carry emergency contacts.",
        "Keep hydrated."
    ],
    "Swat Valley Historical Tour" => [
        "Respect local traditions.",
        "Carry sun protection.",
        "Avoid traveling alone at night.",
        "Use reliable transport."
    ],
];

// Get safety tips array or default message
if (isset($safety_tips[$tour_title])) {
    $tips_array = $safety_tips[$tour_title];
} else {
    $tips_array = ["Please follow general safety guidelines while traveling."];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Thank You</title>
  <style>
    /* Reset and base */
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
      background-color: #f9fafb;
      color: #2c3e50;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      padding: 20px;
    }

    .container {
      background: #ffffff;
      border-radius: 12px;
      box-shadow: 0 4px 25px rgba(0,0,0,0.1);
      padding: 40px 60px;
      max-width: 600px;
      width: 100%;
      text-align: center;
      transition: box-shadow 0.3s ease;
    }
    .container:hover {
      box-shadow: 0 6px 30px rgba(0,0,0,0.15);
    }

    h1 {
      color: #001399;
      font-size: 2.8rem;
      font-weight: 700;
      margin-bottom: 15px;
      letter-spacing: 1px;
    }

    p {
      font-size: 1.2rem;
      margin-bottom: 30px;
      color: #34495e;
    }

    .tips {
      background-color: #e8f0fe;
      border-left: 5px solid #001399;
      color: #001f7a;
      padding: 25px 30px;
      border-radius: 8px;
      font-size: 1rem;
      text-align: left;
      line-height: 1.5;
      box-shadow: inset 0 0 10px rgba(0,19,153,0.1);
      margin-bottom: 35px;
    }

    .tips strong {
      display: block;
      margin-bottom: 12px;
      font-weight: 700;
      font-size: 1.1rem;
    }

    .tips ul {
      list-style-type: disc;
      padding-left: 20px;
      margin-top: 0;
      color: #001f7a;
      font-weight: 600;
    }

    .tips li {
      margin-bottom: 8px;
      line-height: 1.4;
    }

    .btn {
      background-color: #001399;
      color: #fff;
      padding: 14px 45px;
      font-size: 1.1rem;
      font-weight: 600;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      text-decoration: none;
      display: inline-block;
      transition: background-color 0.3s ease;
      box-shadow: 0 4px 15px rgba(0,19,153,0.3);
    }
    .btn:hover {
      background-color: #0033cc;
      box-shadow: 0 6px 20px rgba(0,51,204,0.5);
    }

    @media (max-width: 480px) {
      .container {
        padding: 30px 20px;
      }
      h1 {
        font-size: 2rem;
      }
      p {
        font-size: 1rem;
      }
      .btn {
        padding: 12px 30px;
        font-size: 1rem;
      }
      .tips {
        font-size: 0.9rem;
        padding: 20px;
      }
    }
  </style>
</head>
<body>

  <div class="container">
    <h1>Thank You, <?= htmlspecialchars($username) ?>!</h1>
    <p>Your booking for <strong><?= htmlspecialchars($tour_title ?: "your tour") ?></strong> was successful. We’ll contact you soon with more details.</p>

    <div class="tips">
      <strong>Safety Tips for <?= htmlspecialchars($tour_title ?: "your tour") ?>:</strong>
      <ul>
        <?php foreach ($tips_array as $tip): ?>
          <li><?= htmlspecialchars($tip) ?></li>
        <?php endforeach; ?>
      </ul>
    </div>

    <a href="user-dashboard.php" class="btn">Go to Dashboard</a>
  </div>

</body>
</html>
