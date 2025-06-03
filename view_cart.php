<?php
session_start();

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo "
    <div class='empty-cart-container'>
        <i class='fas fa-shopping-cart'></i>
        <h2>Your Cart is Empty</h2>
        <p>Looks like you haven’t added anything to your cart yet.</p>
        <a href='tours.php'>Start Exploring Tours</a>
    </div>
    <style>
        .empty-cart-container {
            text-align: center;
            padding: 80px 20px;
            font-family: Arial, sans-serif;
            color: #444;
        }

        .empty-cart-container i {
            font-size: 60px;
            color: #001399;
            margin-bottom: 20px;
        }

        .empty-cart-container h2 {
            font-size: 32px;
            margin-bottom: 10px;
            color: #001399;
        }

        .empty-cart-container p {
            font-size: 18px;
            margin-bottom: 20px;
        }

        .empty-cart-container a {
            display: inline-block;
            background-color: #001399;
            color: white;
            padding: 12px 24px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: background-color 0.3s;
        }

        .empty-cart-container a:hover {
            background-color: #0033cc;
        }
    </style>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css'>
    ";
    exit();
}


$total_price = 0;

echo "<h2>Your Cart</h2>";
echo "<table border='1' cellpadding='10' cellspacing='0' style='width:100%; border-collapse: collapse;'>";

// Heading row with background color #001399 and white text
echo "<tr style='background-color:#001399; color:white;'>";
echo "<th>Image</th>";
echo "<th>Tour Name</th>";
echo "<th>Duration</th>";
echo "<th>Price</th>";
echo "<th>Discount (%)</th>";
echo "<th>Quantity</th>";
echo "<th>Subtotal</th>";
echo "<th>Action</th>"; // New column for delete
echo "</tr>";

// Table data rows
foreach ($_SESSION['cart'] as $key => $item) {
    $price_after_discount = $item['price'] - ($item['price'] * $item['discount'] / 100);
    $subtotal = $price_after_discount * $item['quantity'];
    $total_price += $subtotal;

    echo "<tr>";
    echo "<td><img src='../php/uploads/" . htmlspecialchars($item['image']) . "' width='100' alt='" . htmlspecialchars($item['name']) . "'></td>";
    echo "<td>" . htmlspecialchars($item['name']) . "</td>";
    echo "<td>" . htmlspecialchars($item['duration']) . "</td>";
    echo "<td>Rs. " . number_format($item['price'], 2) . "</td>";
    echo "<td>" . htmlspecialchars($item['discount']) . "%</td>";
    echo "<td>" . htmlspecialchars($item['quantity']) . "</td>";
    echo "<td>Rs. " . number_format($subtotal, 2) . "</td>";
    
    // Action column with delete link
    echo "<td style='text-align:center;'>";
    echo "<a href='remove_from_cart.php?index=$key' title='Remove Item' style='color:#ff0000; font-size:20px; text-decoration:none;' onclick=\"return confirm('Are you sure you want to remove this item?');\">&#128465;</a>";
    echo "</td>";
    echo "</tr>";
}

// Total row (you can style it a bit)
echo "<tr style='font-weight:bold;'>";
echo "<td colspan='7' align='right'>Total Price:</td>";
echo "<td>Rs. " . number_format($total_price, 2) . "</td>";
echo "</tr>";

echo "</table>";
?>


<style>
  .cart-actions {
    margin: 20px 0;
    display: flex;
    gap: 20px;
    align-items: center;
    font-family: Arial, sans-serif;
  }

  .cart-actions a {
    text-decoration: none;
    color: #001399; /* Your preferred blue */
    font-weight: 600;
    padding: 8px 16px;
    border: 2px solid #001399;
    border-radius: 6px;
    transition: background-color 0.3s, color 0.3s;
  }

  .cart-actions a:hover {
    background-color: #001399;
    color: #fff;
  }

  .cart-actions form {
    margin: 0;
  }

  .cart-actions button {
    background-color: #001399;
    color: white;
    font-weight: 700;
    padding: 10px 22px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    transition: background-color 0.3s;
  }

  .cart-actions button:hover {
    background-color: #0033cc;
  }
  
</style>

<div class="cart-actions">
  <a href="clear_cart.php">Clear Cart</a>
  <a href="tours.php">Continue Shopping</a>
  <form action="book now.php" method="POST" style="display:inline;">
    <button type="submit" name="checkout">Proceed to Checkout</button>
  </form>
</div>

    