<?php
session_start();
include '../backend/connect.php';

// Get destination ID
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id <= 0) die("Invalid destination ID.");

// Fetch destination
$stmt = $conn->prepare("SELECT * FROM destination WHERE destination_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
if ($result && $result->num_rows > 0) {
    $destination = $result->fetch_assoc();
} else {
    die("Destination not found.");
}
$stmt->close();

// Default coordinates if not set

$lat = $destination['latitude'] ?? 28.2096;   // fallback if empty
$lng = $destination['longitude'] ?? 83.9856;

// Calculate logged‑in user age
$userId = $_SESSION['user_id'] ?? 0;
$userAge = 0;
if ($userId > 0) {
    $userStmt = $conn->prepare("SELECT dob FROM users WHERE user_id = ?");
    $userStmt->bind_param("i", $userId);
    $userStmt->execute();
    $userRes = $userStmt->get_result()->fetch_assoc();
    if (!empty($userRes['dob'])) {
        $dobObj = new DateTime($userRes['dob']);
        $today  = new DateTime(date('Y-m-d'));
        $userAge = $dobObj->diff($today)->y;
    }
    $userStmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= htmlspecialchars($destination['name']) ?> — Hello Pokhara</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

<style>
body { background: #f4f6f8; font-family: 'Poppins', sans-serif; color: #333; }
.container { margin-top: 40px; margin-bottom: 40px; }
a { text-decoration: none; color: #1565c0; }
a:hover { text-decoration: underline; }
h2 { font-weight: 700; margin-bottom: 15px; text-align:center; }
.main-img {
    width: 100%;
    height: auto;
    max-height: 500px;
    object-fit: contain;
    border-radius: 12px;
    box-shadow: 0 6px 18px rgba(0,0,0,0.1);
    margin-bottom: 20px;
}
.card-info {
    background: #fff;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    margin-top: 20px;
}
.card-info h5 { font-weight: 600; margin-bottom: 15px; }
.card-info p { margin-bottom: 10px; line-height:1.6; }
.btn-book {
    display:inline-block;
    background-color: #1565c0;
    color: #fff;
    font-weight: 600;
    border-radius: 8px;
    padding: 12px 25px;
    transition: 0.3s;
    margin-top: 10px;
}
.btn-book:hover { background-color: #0d47a1; text-decoration:none; color:#fff; }
#map { height: 300px; border-radius: 12px; margin-top: 20px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); }
.booking-summary {
    background: #eaf3ff;
    border-left: 4px solid #1565c0;
    padding: 15px;
    border-radius: 8px;
    margin-top: 20px;
}
.booking-summary h6 { font-weight: 600; margin-bottom: 10px; }
</style>
</head>
<body>

<div class="container">

  <a href="destination.php">← Back to Destinations</a>

  <h2><?= htmlspecialchars($destination['name']) ?></h2>

  <img src="../uploads/<?= htmlspecialchars($destination['image']) ?>" class="main-img">

  <div class="card-info">
    <p><?= nl2br(htmlspecialchars($destination['description'])) ?></p>

    <div id="map"></div>

    <div class="mt-4 text-center">
      <h5>Tour Info</h5>
      <p><strong>Price:</strong> NPR <?= number_format($destination['price'],2) ?></p>
      <p><strong>Discount:</strong> NPR <?= number_format($destination['discount_price'],2) ?></p>

      <!-- Book Now button linked to frontend booking.php -->
      <a href="../frontend/booking.php?destination_id=<?= $destination['destination_id'] ?>" class="btn btn-book">Book Now</a>

      <!-- Booking summary -->
      <div class="booking-summary mt-3">
        <h6>Booking Summary</h6>
        <div><strong>Original:</strong> NPR <?= number_format($destination['price'],2) ?></div>
        <div><strong>Discount:</strong> NPR <?= number_format($destination['discount_price'],2) ?></div>
        <div><strong>You Save:</strong> NPR <?= number_format($destination['price'] - $destination['discount_price'],2) ?></div>
        <div><strong>Total Payable:</strong> NPR <?= number_format($destination['discount_price'],2) ?></div>
      </div>
    </div>
  </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
// Initialize map with dynamic coordinates
var map = L.map('map').setView([<?= $lat ?>, <?= $lng ?>], 16); // zoom closer for hotel
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

// Add marker
L.marker([<?= $lat ?>, <?= $lng ?>]).addTo(map)
    .bindPopup("<?= htmlspecialchars($destination['name']) ?>")
    .openPopup();
</script>


</body>
</html>
