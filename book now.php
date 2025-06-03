x<?php
// Start output buffering and session at very top
ob_start();
session_start();

// DB connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hri";

if (!isset($_SESSION['user_id'])) {
    header("Location: register.php");
    exit();
}


$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get tours info from DB (name, price, slots)
$toursData = [];
$result = $conn->query("SELECT tour_id, tour_name, price, slots_adults, slots_children FROM tours");
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $toursData[$row['tour_id']] = [
            'name' => $row['tour_name'],
            'price' => $row['price'],
            'slots_adults' => $row['slots_adults'],
            'slots_children' => $row['slots_children']
        ];
    }
}

$message = "";
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {    // Sanitize input
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $tour_id = (int)($_POST['tour'] ?? 0);
    $adults = (int)($_POST['adults'] ?? 0);
    $children = (int)($_POST['children'] ?? 0);
    $special_request = trim($_POST['request'] ?? '');

    // Validate required fields
    if ($name === '') $errors[] = "Name is required.";
    if ($email === '') $errors[] = "Email is required.";
    if ($phone === '') $errors[] = "Phone number is required.";
    if (!preg_match('/^03\d{2}-?\d{7}$/', $phone)) $errors[] = "Valid phone number is required (Format: 03XX-XXXXXXX).";
    if ($tour_id === 0 || !isset($toursData[$tour_id])) $errors[] = "Valid tour selection is required.";
    if ($adults < 1) $errors[] = "At least one adult must be booked.";
    if (!isset($_FILES['cnic_front']) || $_FILES['cnic_front']['error'] !== 0) $errors[] = "CNIC front image is required.";
    if (!isset($_FILES['cnic_back']) || $_FILES['cnic_back']['error'] !== 0) $errors[] = "CNIC back image is required.";

    if (empty($errors)) {
        // Handle file uploads
        $target_dir = "uploads/";
        $cnic_front = time() . "front" . basename($_FILES['cnic_front']['name']);
        $cnic_back = time() . "back" . basename($_FILES['cnic_back']['name']);
        move_uploaded_file($_FILES['cnic_front']['tmp_name'], $target_dir . $cnic_front);
        move_uploaded_file($_FILES['cnic_back']['tmp_name'], $target_dir . $cnic_back);

        $price_per_adult = $toursData[$tour_id]['price'];
        $price_per_child = $price_per_adult * 0.8; // 20% discount
        $total_people = $adults + $children;
        $total_amount = ($adults * $price_per_adult) + ($children * $price_per_child);

        // Assuming user_id = null (guest)
        $user_id = null;

        $stmt = $conn->prepare("INSERT INTO bookings 
            (user_id, tour_id, adults, children, number_of_people, total_amount, adult_price, child_price, cnic_front, cnic_back, status, special_requests) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'pending', ?)");
        $stmt->bind_param("iiiiddddsss",
            $user_id, $tour_id, $adults, $children, $total_people, $total_amount, $price_per_adult, $price_per_child,
            $cnic_front, $cnic_back, $special_request);

      if ($stmt->execute()) {
    $booking_id = $stmt->insert_id; // ✅ Get the inserted booking ID

    // Save booking info to session for payment page
    $_SESSION['booking'] = [
        'name' => $name,
        'tour_name' => $toursData[$tour_id]['name'],
        'adults' => $adults,
        'children' => $children,
        'total_price' => $total_amount
    ];

    // --- POINTS LOGIC STARTS HERE ---
    if (isset($_SESSION['user_id']) && $_SESSION['user_id'] > 0) {
        $user_id = $_SESSION['user_id'];
        $pointsEarned = 1000;

        $updatePointsStmt = $conn->prepare("UPDATE users SET points = points + ? WHERE id = ?");
        $updatePointsStmt->bind_param("ii", $pointsEarned, $user_id);
        $updatePointsStmt->execute();
        $updatePointsStmt->close();
    }

    header("Location: payment.php?booking_id=$booking_id"); // ✅ Now it's valid
    exit;


        } else {
            $errors[] = "Database error: " . $stmt->error;
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Book Your Tour | HRI TOURS</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
body {
    background: #f5f5f5;
    padding: 20px;
}

.container {
    max-width: 600px;
    margin: 20px auto;
    padding: 30px;
    background: white;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
}

h2 {
    color: #001399;
    text-align: center;
    margin-bottom: 30px;
}

.form-group {
    margin-bottom: 20px;
}

label {
    font-weight: 500;
    margin-bottom: 8px;
}

.form-control {
    border: 1px solid #ddd;
    padding: 10px;
    border-radius: 5px;
}

.form-control:focus {
    border-color: #001399;
    box-shadow: 0 0 0 3px rgba(0,19,153,0.1);
}

.counter-controls {
    display: flex;
    align-items: center;
    gap: 10px;
}

.counter-controls button {
    background: #001399;
    color: white;
    border: none;
    width: 30px;
    height: 30px;
    border-radius: 5px;
    cursor: pointer;
}

.counter-controls input {
    width: 60px;
    text-align: center;
}

.file-upload {
    border: 2px dashed #ddd;
    padding: 20px;
    text-align: center;
    margin-bottom: 15px;
    border-radius: 5px;
    cursor: pointer;
}

.file-upload:hover {
    border-color: #001399;
}

.btn-book {
    background: #001399;
    color: white;
    width: 100%;
    padding: 12px;
    border: none;
    border-radius: 5px;
    font-weight: 500;
    margin-top: 20px;
}

.btn-book:hover {
    background: #000d66;
}

.price-display {
    background: #f8f9fa;
    padding: 15px;
    text-align: center;
    border-radius: 5px;
    margin: 20px 0;
}

.price-display span {
    font-size: 24px;
    color: #001399;
    font-weight: bold;
}

.error {
    color: #dc3545;
    font-size: 14px;
    margin-top: 5px;
    display: none;
}
</style>
</head>
<body>

<div class="container">
    <h2>Book Your Tour</h2>
    
    <?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        <ul class="mb-0">
            <?php foreach ($errors as $error): ?>
                <li><?php echo $error; ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data" id="bookingForm">
        <div class="form-group">            <label for="name">Full Name</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($_POST['name'] ?? '') ?>" placeholder="Enter your full name" required>
            <div class="error" id="name-error"></div>
        </div>        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($_POST['email'] ?? '') ?>" placeholder="Enter your email address" required>
            <div class="error" id="email-error"></div>
        </div>

        <div class="form-group">
            <label for="phone">Phone Number</label>
            <input type="tel" class="form-control" id="phone" name="phone" value="<?php echo htmlspecialchars($_POST['phone'] ?? '') ?>" placeholder="03XX-XXXXXXX" required>
            <div class="error" id="phone-error"></div>
        </div>

        <div class="form-group">
            <label for="tour">Select Tour</label>            <select class="form-control" id="tour" name="tour" required>
                <option value="">Select your destination</option>
                <?php foreach ($toursData as $id => $data): ?>
                    <option value="<?php echo $id; ?>" <?php if (($id == ($_POST['tour'] ?? 0))) echo "selected"; ?>>
                        <?php echo htmlspecialchars($data['name']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <div class="error" id="tour-error"></div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Adults</label>
                    <div class="counter-controls">
                        <button type="button" onclick="changeCount('adults', -1)">-</button>
                        <input type="number" class="form-control" id="adults" name="adults" value="<?php echo intval($_POST['adults'] ?? 1); ?>" min="1" readonly>
                        <button type="button" onclick="changeCount('adults', 1)">+</button>
                    </div>
                    <small class="text-muted">Available: <span id="adultSlots">0</span></small>
                    <div class="error" id="adults-error"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Children</label>
                    <div class="counter-controls">
                        <button type="button" onclick="changeCount('children', -1)">-</button>
                        <input type="number" class="form-control" id="children" name="children" value="<?php echo intval($_POST['children'] ?? 0); ?>" min="0" readonly>
                        <button type="button" onclick="changeCount('children', 1)">+</button>
                    </div>
                    <small class="text-muted">Available: <span id="childSlots">0</span></small>
                    <div class="error" id="children-error"></div>
                </div>
            </div>
        </div>

        <div class="price-display">
            Total Price: <span id="totalPrice">0</span> PKR
        </div>        <div class="form-group">
            <label for="request">Special Request</label>
            <textarea class="form-control" id="request" name="request" rows="3" placeholder="Any special requirements or preferences for your tour?"><?php echo htmlspecialchars($_POST['request'] ?? '') ?></textarea>
        </div>

        <div class="form-group">
            <label>Upload CNIC Front</label>
            <div class="file-upload" onclick="document.getElementById('cnic_front').click()">
                <p class="mb-0" id="cnic_front_text">Click to upload CNIC front image</p>
                <input type="file" id="cnic_front" name="cnic_front" accept="image/*" required style="display: none">
            </div>
            <div class="error" id="cnic_front-error"></div>
        </div>

        <div class="form-group">
            <label>Upload CNIC Back</label>
            <div class="file-upload" onclick="document.getElementById('cnic_back').click()">
                <p class="mb-0" id="cnic_back_text">Click to upload CNIC back image</p>
                <input type="file" id="cnic_back" name="cnic_back" accept="image/*" required style="display: none">
            </div>
            <div class="error" id="cnic_back-error"></div>
        </div>

        <button type="submit" class="btn-book">Book Now</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
const form = document.getElementById('bookingForm');
const toursData = <?php echo json_encode($toursData); ?>;

function updateAvailableSlots() {
    const tourSelect = document.getElementById('tour');
    const selectedTour = toursData[tourSelect.value];
    
    if (selectedTour) {
        document.getElementById('adultSlots').textContent = selectedTour.slots_adults;
        document.getElementById('childSlots').textContent = selectedTour.slots_children;
    }
}

function calculateTotalPrice() {
    const tourSelect = document.getElementById('tour');
    const selectedTour = toursData[tourSelect.value];
    const adults = parseInt(document.getElementById('adults').value) || 0;
    const children = parseInt(document.getElementById('children').value) || 0;
    
    if (selectedTour) {
        const total = (adults * selectedTour.price) + (children * selectedTour.price * 0.8);
        document.getElementById('totalPrice').textContent = total.toLocaleString();
    }
}

function changeCount(field, delta) {
    const input = document.getElementById(field);
    const currentValue = parseInt(input.value) || 0;
    const min = parseInt(input.min) || 0;
    let newValue = currentValue + delta;
    
    if (newValue < min) newValue = min;
    
    const tourSelect = document.getElementById('tour');
    const selectedTour = toursData[tourSelect.value];
    
    if (selectedTour) {
        const maxSlots = field === 'adults' ? selectedTour.slots_adults : selectedTour.slots_children;
        if (newValue > maxSlots) newValue = maxSlots;
    }
    
    input.value = newValue;
    calculateTotalPrice();
}

// File upload handling
document.querySelectorAll('input[type="file"]').forEach(input => {
    input.addEventListener('change', function() {
        const textElement = document.getElementById(this.id + '_text');
        if (this.files && this.files[0]) {
            textElement.textContent = this.files[0].name;
            this.parentElement.style.borderColor = '#001399';
        } else {
            textElement.textContent = this.id === 'cnic_front' 
                ? 'Click to upload CNIC front image' 
                : 'Click to upload CNIC back image';
            this.parentElement.style.borderColor = '#ddd';
        }
    });
});

document.getElementById('tour').addEventListener('change', () => {
    updateAvailableSlots();
    calculateTotalPrice();
});

// Form validation
form.addEventListener('submit', function(e) {
    e.preventDefault();
    let isValid = true;

    // Clear previous errors
    document.querySelectorAll('.error').forEach(error => {
        error.style.display = 'none';
        error.textContent = '';
    });

    // Validate name
    if (!form.name.value.trim()) {
        document.getElementById('name-error').textContent = 'Name is required';
        document.getElementById('name-error').style.display = 'block';
        isValid = false;
    }    // Validate email
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!form.email.value.trim() || !emailRegex.test(form.email.value.trim())) {
        document.getElementById('email-error').textContent = 'Valid email is required';
        document.getElementById('email-error').style.display = 'block';
        isValid = false;
    }

    // Validate phone
    const phoneRegex = /^03\d{2}-?\d{7}$/;
    if (!form.phone.value.trim() || !phoneRegex.test(form.phone.value.trim())) {
        document.getElementById('phone-error').textContent = 'Valid phone number is required (Format: 03XX-XXXXXXX)';
        document.getElementById('phone-error').style.display = 'block';
        isValid = false;
    }

    // Validate tour
    if (!form.tour.value) {
        document.getElementById('tour-error').textContent = 'Please select a tour';
        document.getElementById('tour-error').style.display = 'block';
        isValid = false;
    }

    // Validate adults
    if (parseInt(form.adults.value) < 1) {
        document.getElementById('adults-error').textContent = 'At least 1 adult is required';
        document.getElementById('adults-error').style.display = 'block';
        isValid = false;
    }

    // Validate files
    if (!form.cnic_front.files.length) {
        document.getElementById('cnic_front-error').textContent = 'CNIC front image is required';
        document.getElementById('cnic_front-error').style.display = 'block';
        isValid = false;
    }
    if (!form.cnic_back.files.length) {
        document.getElementById('cnic_back-error').textContent = 'CNIC back image is required';
        document.getElementById('cnic_back-error').style.display = 'block';
        isValid = false;
    }

    if (isValid) {
        form.submit();
    }
});

// Initialize
updateAvailableSlots();
calculateTotalPrice();
</script>
</body>
</html>