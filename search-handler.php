<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "hri";

$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$query = isset($_GET['query']) ? trim($_GET['query']) : '';
$category = isset($_GET['category']) ? $_GET['category'] : '';

// 1️⃣ User searched text
if (!empty($query)) {
    $stmt = $conn->prepare("SELECT tour_id FROM tours WHERE tour_name LIKE ?");
    $searchTerm = "%$query%";
    $stmt->bind_param("s", $searchTerm);
    $stmt->execute();
    $stmt->bind_result($tourId);

    if ($stmt->fetch()) {
        header("Location: tours_page.php?tour_id=$tourId");
        exit();
    } else {
        echo "<script>alert('No destination found for \"$query\"'); window.history.back();</script>";
    }
}

// 2️⃣ User selected filter category
else if (!empty($category)) {
    switch ($category) {
        case "cold":
            header("Location: cold areas.php");
            break;
        case "warm":
            header("Location: warm areas.php");
            break;
        case "cultural":
            header("Location: cultural areas.php");
            break;
        case "adventure":
            header("Location: adventural areas.php");
            break;
        default:
            echo "<script>alert('Invalid category'); window.history.back();</script>";
    }
    exit();
}

// 3️⃣ Nothing selected
else {
    echo "<script>alert('Please enter a destination or select a category'); window.history.back();</script>";
}
?>
