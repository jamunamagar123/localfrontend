<?php
session_start();
include '../backend/connect.php';

// Only users can access
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    $_SESSION['error'] = "Unauthorized access.";
    header("Location: ../frontend/login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Fetch pending reviews (rating = 0)
// Fetch bookings of this user that have not been reviewed yet
$stmt = $conn->prepare("
    SELECT b.booking_id, b.guider_id, b.service_name, b.service_date
    FROM booking b
    LEFT JOIN reviews r 
        ON r.booking_id = b.booking_id AND r.user_id = ?
    WHERE b.user_id = ? AND (r.rating IS NULL OR r.rating = 0)
    ORDER BY b.service_date DESC
");
$stmt->bind_param("ii", $user_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Pending Reviews</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

<style>
body { font-family: 'Poppins', sans-serif; background: #f4f6f9; min-height: 100vh; }
.container { max-width: 750px; margin-top: 50px; }
.review-card { background: #fff; border-radius: 16px; padding: 25px; box-shadow: 0 10px 30px rgba(0,0,0,0.08); margin-bottom: 20px; }
.review-title { font-weight: 600; }
.review-date { font-size: 0.85rem; color: #6c757d; }
.star-rating { display: flex; flex-direction: row-reverse; gap: 6px; }
.star-rating input { display: none; }
.star-rating label { font-size: 32px; color: #dcdcdc; cursor: pointer; transition: color 0.2s; }
.star-rating input:checked ~ label,
.star-rating label:hover,
.star-rating label:hover ~ label { color: #ffca08; }
textarea { border-radius: 12px; resize: none; }
.btn-submit { background: linear-gradient(135deg,#4f8cff,#6f42c1); border:none; padding:10px 28px; border-radius:30px; color:#fff; font-weight:500; }
.btn-submit:hover { transform: translateY(-2px); }
.empty-box { background:#fff; padding:40px; border-radius:16px; text-align:center; box-shadow:0 10px 30px rgba(0,0,0,0.08); }
.alert-success { margin-bottom: 20px; }
</style>
</head>
<body>

<div class="container">
    <h2 class="mb-4 fw-semibold">⭐ Pending Reviews</h2>

    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success"><?= $_SESSION['success']; unset($_SESSION['success']); ?></div>
    <?php endif; ?>

    <?php if ($result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="review-card">
                <div class="review-title"><?= htmlspecialchars($row['service_name']) ?></div>
                <div class="review-date"><?= htmlspecialchars($row['service_date']) ?></div>

                <form action="../backend/submit-review.php" method="POST">
                    <input type="hidden" name="booking_id" value="<?= $row['booking_id'] ?>">
                    <input type="hidden" name="guider_id" value="<?= $row['guider_id'] ?>">
                    <input type="hidden" name="user_id" value="<?= $user_id ?>">

                    <label>Your Rating</label>
                    <div class="star-rating mb-3">
                        <?php for ($i=5;$i>=1;$i--): ?>
                            <input type="radio" id="star<?= $i ?>_<?= $row['booking_id'] ?>" name="rating" value="<?= $i ?>" required>
                            <label for="star<?= $i ?>_<?= $row['booking_id'] ?>">★</label>
                        <?php endfor; ?>
                    </div>

                    <label>Your Review</label>
                    <textarea name="comment" rows="3" class="form-control mb-3" placeholder="Write your review..." required></textarea>

                    <button type="submit" class="btn-submit">Submit Review</button>
                </form>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <div class="empty-box">
            <h5>No Pending Reviews</h5>
            <p class="text-muted">You have already reviewed all your bookings.</p>
        </div>
    <?php endif; ?>
</div>

</body>
</html>
