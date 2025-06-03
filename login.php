<?php
// Include database connection
require_once 'config/db.php';  // Adjust the path as necessary
session_start();  // Start session at the top

$loginFail = false;

// Password Update Logic (optional)
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_password'])) {
    // The new password you want to set
    $new_password = 'admin123';  // Example new password, this can be dynamic as well

    // Hash the new password
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    // SQL query to update the password in the users table
    $sql = "UPDATE users SET password = '$hashed_password' WHERE email = 'admin@example.com'";  // Modify email as needed

    // Execute the query and check for success
    if (mysqli_query($conn, $sql)) {
        echo "Password updated successfully!";
    } else {
        echo "Error updating password: " . mysqli_error($conn);
    }
}

// Login Logic
if ($_SERVER['REQUEST_METHOD'] == 'POST' && !isset($_POST['update_password'])) {
    // Getting the email and password from the form
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = trim($_POST['password']);  // Use trim to remove extra spaces

    // Query to check if the admin exists in users table with role = 'admin'
    $sql = "SELECT * FROM users WHERE email='$email' AND role='admin'";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("Query Error: " . mysqli_error($conn));
    }

    // Fetching the admin data
    $user = mysqli_fetch_assoc($result);

    // Verifying password and logging in
    if ($user && password_verify($password, $user['password'])) {
        // Store user details in session
        $_SESSION['admin_id'] = $user['user_id'];
        $_SESSION['admin_name'] = $user['username'];

        // Redirect to the admin dashboard
        header("Location: index.php");
        exit;
    } else {
        $loginFail = true;  // Login failed
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .btn-custom {
            background-color: #001399;
            color: white;
        }
        .btn-custom:hover {
            background-color: #001399;
            opacity: 0.9;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="card p-4 shadow" style="width: 100%; max-width: 400px;">
            <h2 class="text-center mb-4">Admin Login</h2>
            
            <?php if ($loginFail): ?>
                <div class="alert alert-danger" role="alert">
                    Invalid email or password. Please try again.
                </div>
            <?php endif; ?>
            
            <!-- Login Form -->
            <form method="post">
            <div class="mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                </div>
                <div class="mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                </div>
                <button type="submit" class="btn btn-custom w-100">Login</button>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
