<?php
// Step 1: Connect to DB
include('db.php');

// Step 2: Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Step 3: Safely get tour_id from form
    $tourId = isset($_POST['tour_id']) ? (int)$_POST['tour_id'] : 0;

    if ($tourId <= 0) {
        echo "Invalid Tour ID.";
        exit;
    }

    // Step 4: Fetch tour details from database
    $stmt = $conn->prepare("SELECT id, tour_title, price FROM tours WHERE id = ?");
    $stmt->bind_param("i", $tourId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $tour = $result->fetch_assoc();

        // Step 5: Load existing cart from cookie
        $cart = isset($_COOKIE['cart']) ? json_decode($_COOKIE['cart'], true) : [];

        // Step 6: Check for duplicate item
        $found = false;
        foreach ($cart as $item) {
            if ($item['id'] == $tour['id']) {
                $found = true;
                break;
            }
        }

        // Step 7: If not duplicate, add to cart
        if (!$found) {
            $cart[] = [
                'id' => $tour['id'],
                'title' => $tour['tour_title'],
                'price' => $tour['price']
            ];
        }

        // Step 8: Store updated cart in cookie
        setcookie('cart', json_encode($cart), time() + (86400 * 7), "/");

        // Step 9: Redirect to cart page
        header("Location: cart.php");
        exit;
    } else {
        echo "Tour not found.";
    }
}
?>
