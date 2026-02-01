<?php
session_start();
include '../backend/connect.php';

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = (int)$_SESSION['user_id'];
$message = "";

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $current_password = $_POST['current_password'] ?? '';
    $new_password     = $_POST['new_password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    // Fetch current password from database
    $stmt = $conn->prepare("SELECT password FROM users WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result($current_db_password);
    $stmt->fetch();
    $stmt->close();

    // Check current password
    if ($current_password !== $current_db_password) {
        $message = "Current password is incorrect.";
    } elseif ($new_password !== $confirm_password) {
        $message = "New password and confirm password do not match.";
    } elseif (strlen($new_password) < 4) {
        $message = "New password must be at least 4 characters long.";
    } else {
        // Update password in database
        $stmt = $conn->prepare("UPDATE users SET password = ? WHERE user_id = ?");
        $stmt->bind_param("si", $new_password, $user_id);
        if ($stmt->execute()) {
            $message = "Password updated successfully!";
        } else {
            $message = "Something went wrong. Please try again.";
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Change Password</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body { font-family: 'Poppins', sans-serif; background: #f4f6f9; }
.container { max-width: 500px; margin-top: 60px; }
.card { border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.08); }
.card-header { background: #0e5fd5; color: #fff; border-radius: 12px 12px 0 0; font-weight: 600; text-align:center; }
.btn-submit { background: #0e5fd5; color: #fff; border-radius: 6px; width: 100%; padding: 8px; border: none; transition: 0.3s; }
.btn-submit:hover { background: #0949a0; color: #fff; }
.message { margin-top: 15px; font-weight: 500; }
.btn-back { display: inline-block; margin-bottom: 15px; text-decoration: none; color: #0e5fd5; }
.btn-back:hover { text-decoration: underline; }
</style>
</head>
<body>

<div class="container">
    <a href="home.php" class="btn-back">&larr; Back</a>
    <div class="card">
        <div class="card-header">Change Password</div>
        <div class="card-body">
            <?php if ($message): ?>
                <div class="alert alert-info text-center"><?= htmlspecialchars($message) ?></div>
            <?php endif; ?>
            <form method="POST" action="">
                <div class="mb-3">
                    <label for="current_password" class="form-label">Current Password</label>
                    <input type="password" class="form-control" name="current_password" id="current_password" required>
                </div>
                <div class="mb-3">
                    <label for="new_password" class="form-label">New Password</label>
                    <input type="password" class="form-control" name="new_password" id="new_password" required>
                </div>
                <div class="mb-3">
                    <label for="confirm_password" class="form-label">Confirm New Password</label>
                    <input type="password" class="form-control" name="confirm_password" id="confirm_password" required>
                </div>
                <button type="submit" class="btn-submit">Update Password</button>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
