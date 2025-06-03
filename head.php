<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$isLoggedIn = isset($_SESSION['user_id']);
$userName = $isLoggedIn ? $_SESSION['user_name'] : '';
$userEmail = $isLoggedIn ? $_SESSION['user_email'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>HRI Tours</title>

 

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
  
  <div class="blue">
    <div class="social-icons">
      <a href="#"><img src="https://i.ibb.co/ZRmGf1Bb/icons8-facebook-48.png" width="30" height="30"></a>
      <a href="#"><img src="https://i.ibb.co/wZFyWTdQ/icons8-instagram-50.png" width="30" height="30"></a>
      <a href="#"><img src="https://i.ibb.co/xq4htXFD/icons8-twitter-circled-50.png" width="30" height="30"></a>
    </div>
    

<!-- Navbar -->
<div class="menu" style="display: flex; gap: 15px; align-items: center; padding: 1px;">
  <a href="../toursss/register.php">Register</a>
  <a href="../toursss/login.php" id="loginLink">Login</a>

  <div id="profileContainer" class="dropdown" style="margin-left:auto; position:relative; display:none;">
    <a href="#" id="profileIcon">
      <img src="https://i.ibb.co/B265LxMd/icons8-user-48.png" class="avatar" alt="Avatar" style="width: 32px; height: 32px; border-radius: 50%; border: 1.5px solid #001399;">
    </a>
    <div id="profileDropdown" class="dropdown-content" style="display:none; position:absolute; right:0; background:#fff; border: 1px solid #ddd; border-radius:8px; width:240px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); padding: 20px; z-index: 1000;">
      <div style="margin-bottom: 15px; border-bottom: 1px solid #eee; padding-bottom: 10px;">
        <strong id="userNameDropdown" style="font-size: 16px; color: #001399;"></strong><br>
        <small id="userEmail" style="color: #555; font-size: 13px;"></small>
      </div>
      <button onclick="goDashboard()" style="width: 100%; margin-bottom: 10px; padding: 10px; background: #001399; color: white; border: none; border-radius: 5px; font-weight: 600;">Go to Dashboard</button>
      <button onclick="logout()" style="width: 100%; padding: 10px; background: #aaa; color: white; border: none; border-radius: 5px; font-weight: 600;">Logout</button>
    </div>
  </div>
</div>

<script>
  const isLoggedIn = <?php echo $isLoggedIn ? 'true' : 'false'; ?>;
  if (isLoggedIn) {
    localStorage.setItem("isLoggedIn", "true");
    localStorage.setItem("userName", "<?php echo addslashes($userName); ?>");
    localStorage.setItem("userEmail", "<?php echo addslashes($userEmail); ?>");
  } else {
    localStorage.clear();
  }

  const profileContainer = document.getElementById("profileContainer");
  const profileDropdown = document.getElementById("profileDropdown");
  const profileIcon = document.getElementById("profileIcon");
  const loginLink = document.getElementById("loginLink");

  if (localStorage.getItem("isLoggedIn") === "true") {
    profileContainer.style.display = "inline-block";
    loginLink.style.display = "none";
    document.getElementById("userNameDropdown").textContent = localStorage.getItem("userName");
    document.getElementById("userEmail").textContent = localStorage.getItem("userEmail");
  } else {
    profileContainer.style.display = "none";
    loginLink.style.display = "inline-block";
  }

  profileIcon?.addEventListener("click", function(e){
    e.preventDefault();
    profileDropdown.style.display = (profileDropdown.style.display === "block") ? "none" : "block";
  });

  document.addEventListener("click", function(e){
    if (!profileContainer.contains(e.target)) {
      profileDropdown.style.display = "none";
    }
  });

  function goDashboard(){
    window.location.href = "../user dashboard/dashboard.php";
  }

  function logout(){
    localStorage.clear();
    window.location.href = "../toursss/logout.php";
  }
</script>
