<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "hri";

// Connect to database
$conn = mysqli_connect($host, $user, $pass, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get blog ID from URL and sanitize it
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Prepare the query to fetch a single blog by ID
$query = "SELECT * FROM blogs WHERE id = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$blog = mysqli_fetch_assoc($result);

// Check if blog exists
if (!$blog) {
    die("Blog not found.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?php echo htmlspecialchars($blog['title']); ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .btn-back {
      background-color: #001399;
      color: white;
      font-weight: bold;
    }
    .blog-title {
      color: #001399;
      font-weight: bold;
    }
    .card-img-top {
  object-fit: cover; /* Prevents stretching */
  width: 500px;
  height: 400px;
  object-fit: cover;     /* Image ko container mein fit karna without stretching */
  display: block;        /* Block element bana de ga image ko */
  margin: 0 auto; 
  border-top-left-radius: 0.5rem;
  border-top-right-radius: 0.5rem;       /* Image ko center align karne ke liye */ /* Or the height that works for your layout */
}

  </style>
</head>
<body>

<div class="container mt-5">
  <a href="fetch_blogs.php" class="btn btn-back mb-4">← Back to Blog</a>
  <div class="card">
   
    <div class="card-body">
      <h2 class="blog-title"><?php echo htmlspecialchars($blog['title']); ?></h2>
      <img src="uploads/<?php echo !empty($blog['image']) ? $blog['image'] : 'default.jpg'; ?>" class="card-img-top" alt="Blog Image">
      <p class="text-muted">Published by: <strong><?php echo htmlspecialchars($blog['author']); ?></strong> | 
         On: <?php echo date('F d, Y', strtotime($blog['published_date'])); ?></p>
      <p><?php echo nl2br(htmlspecialchars($blog['description'])); ?></p>
    </div>
  </div>
</div>

</body>
</html>
<?php
mysqli_stmt_close($stmt); // Close prepared statement
mysqli_close($conn); // Close database connection
?>
