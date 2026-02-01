<?php
session_start();
include '../backend/connect.php';

$user_id = $_SESSION['user_id'] ?? null;
$role = $_SESSION['role'] ?? '';

if (!$user_id) {
    header("Location: login.php");
    exit;
}

// Fetch all bookings for this user
$sql = "SELECT * FROM booking WHERE user_id = ? ORDER BY booking_id DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$bookings = $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
$stmt->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Booking History</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body { font-family: 'Poppins', sans-serif; background: #f4f6f9; position: relative; padding-top: 60px; }
.container { max-width: 1200px; margin-top: 20px; position: relative; }
h2 { color: #0e5fd5; }
.table th, .table td { text-align: center; vertical-align: middle; }
.table-hover tbody tr:hover { background-color: #e7f0ff; }
.btn-review, .btn-cancel, .btn-delete { border-radius: 6px; padding: 5px 12px; text-decoration: none; transition: 0.3s; color: #fff; }
.btn-review { background: #0e5fd5; }
.btn-review:hover { background: #0949a0; }
.btn-cancel { background: #dc3545; }
.btn-cancel:hover { background: #b71c1c; }
.badge-status { padding: 5px 10px; border-radius: 12px; font-size: 0.9rem; }
.badge-completed { background-color: #28a745; color: #fff; }
.badge-cancelled { background-color: #ffc107; color: #000; }
.badge-confirmed { background-color: #0e5fd5; color: #fff; }
.btn-back {
    position: absolute; top: 5px; right: 20px;
    background: #0e5fd5; color: #fff;
    border-radius: 6px; padding: 6px 12px;
    text-decoration: none; z-index: 1000; transition: 0.3s;
}
.btn-back:hover { background: #0949a0; color: #fff; }
</style>
</head>
<body>

<div class="container">
    <h2>Booking History</h2>
    <a href="home.php" class="btn-back">Back</a>
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-primary">
                <tr>
                    <th>Booking ID</th>
                    <th>User</th>
                    <th>Guider</th>
                    <th>Service</th>
                    <th>Date</th>
                    <th>Time Slot</th>
                    <th>People</th>
                    <th>Total Amount</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php if ($bookings && count($bookings) > 0): ?>
                <?php foreach ($bookings as $row): ?>
                    <?php
                        $booking_id = (int)$row['booking_id'];
                        $status = strtolower($row['booking_status']);
                    ?>
                    <tr>
                        <td><?= $booking_id ?></td>
                        <td><?= htmlspecialchars($row['full_name'] ?? '-') ?></td>
                        <td><?= (int)$row['guider_id'] ?></td>
                        <td><?= htmlspecialchars($row['service_name']) ?></td>
                        <td><?= htmlspecialchars($row['service_date']) ?></td>
                        <td><?= htmlspecialchars($row['time_slot']) ?></td>
                        <td><?= (int)$row['number_of_people'] ?></td>
                        <td><?= number_format($row['total_amount'], 2) ?></td>
                        <td>
                            <span class="badge-status 
                                <?= $status === 'completed' ? 'badge-completed' : '' ?>
                                <?= $status === 'confirmed' ? 'badge-confirmed' : '' ?>
                                <?= $status === 'pending' ? 'badge-cancelled' : '' ?>
                                <?= $status === 'cancelled' || $status === 'rejected' ? 'badge-cancelled' : '' ?>
                            ">
                                <?= htmlspecialchars($row['booking_status']) ?>
                            </span>
                        </td>
                        <td>
                            <?php if ($status === 'completed'): ?>
                                <!-- Show Review button -->
                                <?php
                                    $check_review = $conn->query("SELECT review_id FROM reviews WHERE booking_id = $booking_id AND user_id = $user_id");
                                ?>
                                <?php if ($check_review && $check_review->num_rows > 0): ?>
                                    <a href="#" class="btn-review" onclick="alert('Your review has already been submitted.'); return false;">Review</a>
                                <?php else: ?>
                                    <a href="../frontend/review.php?booking_id=<?= $booking_id ?>" class="btn-review">Review</a>
                                <?php endif; ?>
                            <?php elseif ($status === 'pending'): ?>
                                <a href="../backend/cancel_booking.php?booking_id=<?= $booking_id ?>" class="btn-cancel" onclick="return confirm('Are you sure you want to cancel this booking?');">Cancel</a>
                            <?php else: ?>
                                <span>-</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="10" class="text-center text-muted py-4">No bookings found.</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
