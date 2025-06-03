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

// Prepare the query
$query = "SELECT * FROM blogs ORDER BY published_date DESC";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Blog</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
  
  .btn-read {
    background-color: #001399;
    color: white;
    font-weight: bold;
  }
  .btn-read {
      background-color: #001399;
      color: white;
      font-weight: bold;
    }
  .section-title h2 {
    color: #001399;
    font-weight: bold;
    border-bottom: 2px solid #001399;
    display: inline-block;
  }

  /* ✅ Fix for blog image */
  .card-img-top {
    width: 100%;
    height: 250px;
    object-fit: cover;
    display: block;
    margin-left: auto;
    margin-right: auto;
  }
</style>

  </style>
</head>
<body>

<div class="container">
  <div class="text-center my-4">
    <h2 class="section-title">Blog</h2>
    <p><strong>Contact for any query</strong></p>
  </div>

  <div class="row g-4">
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
      <div class="col-md-4">
        <div class="card h-100">
          <img src="uploads/<?php echo !empty($row['image']) ? $row['image'] : 'default.jpg'; ?>" class="card-img-top" alt="Blog Image">
          <div class="card-body text-center">
            <h5 class="card-title fw-bold"><?php echo htmlspecialchars($row['title']); ?></h5>
            <p class="mb-1">Published by : <span class="text-primary"><?php echo htmlspecialchars($row['author']); ?></span></p>
            <p>Published on: <?php echo date('F d, Y', strtotime($row['published_date'])); ?></p>
            <p><?php echo substr(htmlspecialchars($row['description']), 0, 100) . '...'; ?></p>
            <a href="view_blog.php?id=<?php echo $row['id']; ?>" class="btn btn-read">READ MORE</a>
          </div>
        </div>
      </div>
    <?php } ?>
  </div>
</div>

</body>
</html>
<?php
mysqli_close($conn); // Close the database connection
?>
