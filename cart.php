<?php
session_start();
$conn = new mysqli("localhost", "root", "", "hri");

echo "<h2 style='text-align:center; font-family:sans-serif; margin-top:30px;'>🛒 Your Cart</h2>";

if (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0) {
    echo "<p style='text-align:center; font-size:18px; color:#888;'>Your cart is empty.</p>";
} else {
    echo "<div style='width:1200px; margin:30px auto; display:flex; flex-direction:column; gap:20px;'>";

    $total = 0;

    foreach ($_SESSION['cart'] as $index => $item) {
        $tour_id = $item['tour_id'];
        $quantity = $item['quantity'];

        $query = mysqli_query($conn, "SELECT * FROM tours WHERE tour_id = $tour_id");
        $tour = mysqli_fetch_assoc($query);

        if ($tour) {
            $subtotal = $tour['price'] * $quantity;
            $total += $subtotal;

            echo "<div style='display:flex; background:#fff; border:1px solid #eee; border-radius:10px; padding:15px; box-shadow:0 4px 12px rgba(0,0,0,0.08); align-items:center;'>";

            // Tour Image
            echo "<div style='flex-shrink:0;'>";
            echo "<img src='../php/uploads/{$tour['main_image']}' alt='Tour Image' style='width:120px; height:120px; object-fit:cover; border-radius:8px;'>";
            echo "</div>";

            // Tour Info
            echo "<div style='margin-left:20px; flex:1;'>";
            echo "<h3 style='margin:0 0 8px 0; font-size:20px; color:#222; font-family:sans-serif;'>{$tour['tour_name']}</h3>";
            echo "<p style='margin:4px 0; font-size:16px; color:#555;'>Price: <strong>Rs. {$tour['price']}</strong></p>";
            echo "<p style='margin:4px 0; font-size:16px; color:#555;'>Quantity: $quantity</p>";
            echo "<p style='margin:4px 0; font-size:16px; color:#555;'>Subtotal: <strong>Rs. $subtotal</strong></p>";
            echo "<a href='remove_from_cart.php?index=$index' style='display:inline-block; margin-top:8px; color:#d00; font-weight:bold; text-decoration:none;'>❌ Remove</a>";
            echo "</div>";

            echo "</div>";
        }
    }

    // Total + Proceed to Checkout container (right aligned)
    echo "<div style='max-width:800px; margin-left:auto; display:flex; justify-content:flex-end; gap:20px; align-items:center;'>";

    echo "<div style='background:#f7f7f7; padding:15px 30px; border-radius:10px; font-size:20px; font-weight:bold; color:#111; box-shadow:0 2px 8px rgba(0,0,0,0.1);'>";
    echo "Total Amount: Rs. $total";
    echo "</div>";

    echo "<a href='book now.php' style='background:#001399; color:#fff; padding:12px 30px; border-radius:8px; font-size:18px; font-weight:bold; text-decoration:none; box-shadow:0 4px 12px rgba(0,19,153,0.4); transition:background-color 0.3s ease;'>";
    echo "Proceed to Checkout";
    echo "</a>";

    echo "</div>"; // total + checkout container end


    // Clear Cart and Explore More buttons container (right aligned below total/checkout)
    echo "<div style='max-width:800px; margin-left:auto; margin-top:15px; display:flex; justify-content:flex-end; gap:20px; align-items:center;'>";

    echo "<a href='clear_cart.php' style='background:#001399; color:#fff; padding:12px 30px; border-radius:8px; font-size:18px; font-weight:bold; text-decoration:none; box-shadow:0 4px 12px rgba(0,19,153,0.4); transition:background-color 0.3s ease;'>";
    echo "Clear Cart";
    echo "</a>";

    echo "<a href='tours.php' style='background:#001399; color:#fff; padding:12px 30px; border-radius:8px; font-size:18px; font-weight:bold; text-decoration:none; box-shadow:0 4px 12px rgba(0,19,153,0.4); transition:background-color 0.3s ease;'>";
    echo "Explore More";
    echo "</a>";

    echo "</div>"; // clear + explore container end

    echo "</div>"; // main container end
}
?>
