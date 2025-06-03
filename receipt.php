<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "hri";

$con = mysqli_connect($servername, $username, $password, $database);
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$booking_id = $_GET['booking_id'] ?? null;

if ($booking_id) {
    $sql = "SELECT b.*, t.tour_name, u.name 
            FROM bookings b
            JOIN tours t ON b.tour_id = t.tour_id
            JOIN users u ON b.user_id = u.id
            WHERE b.booking_id = ?";
    
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $booking_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "No booking found for this ID.";
        exit();
    }
} else {
    echo "Booking ID is missing.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Payment Receipt</title>

<style>
  body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: #f0f4ff;
    color: #222;
    padding: 30px 15px;
    display: flex;
    justify-content: center;
  }

  .receipt-container {
    background: #fff;
    max-width: 480px;
    width: 100%;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgb(0 0 0 / 0.1);
    padding: 30px 40px;
  }

  h2 {
    color: #001399;
    margin-bottom: 25px;
    text-align: center;
    font-weight: 700;
  }

  .receipt-item {
    margin-bottom: 18px;
    font-size: 16px;
  }

  .receipt-item strong {
    display: inline-block;
    width: 140px;
    color: #001399;
  }

  .status-paid {
    color: green;
    font-weight: 700;
  }

  .status-pending {
    color: orange;
    font-weight: 700;
  }

  .status-failed {
    color: red;
    font-weight: 700;
  }

  #downloadBtn {
    margin-bottom: 20px;
    padding: 10px 15px;
    background: #001399;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    width: 570px;
    font-size: 16px;
    font-weight: 600;
  }
 .complete-btn {
  display: flex; /* Use flex to center content */
  justify-content: center; /* Horizontally center */
  align-items: center;     /* Vertically center */
  background-color: #001399;
  color: white;
  padding: 12px 28px;
  font-size: 16px;
  font-weight: 600;
  text-decoration: none;
  border-radius: 8px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
  transition: background 0.3s, transform 0.2s;
  width: 500px;             /* Optional: full-width on container *        /* Optional: limit width */
  margin: 20px auto;        /* Center horizontally */
  text-align: center;
}
.complete-btn:hover {
  background-color: #0025d1;
  transform: translateY(-2px);
}

</style>

<!-- jsPDF and html2canvas libraries -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

</head>
<body>

<div style="max-width: 480px; width: 100%;">
  
  <div class="receipt-container" id="receiptContent">
    <h2>Payment Receipt</h2>
    <p class="receipt-item"><strong>Name:</strong> <?= htmlspecialchars($row['name']) ?></p>
    <p class="receipt-item"><strong>Tour Package:</strong> <?= htmlspecialchars($row['tour_name']) ?></p>
    <p class="receipt-item"><strong>Booking Date:</strong> <?= htmlspecialchars($row['booking_date']) ?></p>
    <p class="receipt-item"><strong>Bank Name:</strong> <?= htmlspecialchars($row['bank_name']) ?></p>
    <p class="receipt-item"><strong>Account Number:</strong> <?= htmlspecialchars($row['account_number']) ?></p>
    <p class="receipt-item"><strong>Amount Paid:</strong> Rs <?= number_format($row['amount_paid'], 2) ?></p>

    <p class="receipt-item">
      <strong>Status:</strong> 
      <?php 
        $status = strtolower($row['payment_status']);
        $class = '';
        if ($status === 'paid' || $status === 'success') {
          $class = 'status-paid';
        } elseif ($status === 'pending') {
          $class = 'status-pending';
        } elseif ($status === 'failed') {
          $class = 'status-failed';
        }
      ?>
      <span class="<?= $class ?>"><?= htmlspecialchars($row['payment_status']) ?></span>
    </p>
  </div>
  
<a href="thankyou.php?booking_id=<?= $row['booking_id'] ?>" class="complete-btn">
  ✅ Complete Booking & Continue
</a>

</div>

<script>
  const { jsPDF } = window.jspdf;

  document.getElementById('downloadBtn').addEventListener('click', () => {
    const receipt = document.getElementById('receiptContent');
    html2canvas(receipt).then(canvas => {
      const imgData = canvas.toDataURL('image/png');
      const pdf = new jsPDF({
        orientation: 'portrait',
        unit: 'pt',
        format: 'a4'
      });

      const pdfWidth = pdf.internal.pageSize.getWidth();
      const pdfHeight = (canvas.height * pdfWidth) / canvas.width;

      pdf.addImage(imgData, 'PNG', 0, 0, pdfWidth, pdfHeight);
      pdf.save('payment-receipt.pdf');
    });
  });
</script>


</body>
</html>
