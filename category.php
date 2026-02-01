<?php
// category.php
require_once __DIR__ . '/../backend/connect.php';

// Get type from URL parameter
$type = isset($_GET['type']) ? $_GET['type'] : '';

// Display the type for debugging
echo "<!-- Debug: Type received from URL: $type -->";

// Fetch destinations by TYPE
$sql = "SELECT * FROM destination WHERE type = ?";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("s", $type);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    echo "<!-- Debug: SQL Error: " . $conn->error . " -->";
    $result = false;
}

// Also try direct query as fallback
if (!$result || $result->num_rows == 0) {
    $sql2 = "SELECT * FROM destination WHERE LOWER(type) = LOWER('$type')";
    $result2 = $conn->query($sql2);
    if ($result2 && $result2->num_rows > 0) {
        $result = $result2;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo ucfirst($type); ?> - Pokhara Tourism</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card {
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .card-img-top {
            height: 200px;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <?php include "nav.php"; ?>
    
    <div class="container mt-4">
        <h1 class="text-center mb-4">
            <i class="fas fa-tag"></i> <?php echo ucfirst($type); ?> in Pokhara
        </h1>
        
        <div class="row">
            <?php
            if ($result && $result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $image_path = '../uploads/' . $row['image'];
                    $discount_percent = 0;
                    
                    if ($row['price'] > 0 && $row['discount_price'] > 0 && $row['price'] > $row['discount_price']) {
                        $discount_percent = round((($row['price'] - $row['discount_price']) / $row['price']) * 100);
                    }
                    ?>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <img src="<?php echo $image_path; ?>" 
                                 class="card-img-top" 
                                 alt="<?php echo htmlspecialchars($row['name']); ?>"
                                 onerror="this.src='https://via.placeholder.com/300x200?text=<?php echo urlencode($row['name']); ?>'">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($row['name']); ?></h5>
                                <p class="card-text"><?php echo substr(htmlspecialchars($row['description']), 0, 100) . '...'; ?></p>
                                
                                <?php if ($discount_percent > 0): ?>
                                    <span class="badge bg-danger mb-2">-<?php echo $discount_percent; ?>% OFF</span>
                                <?php endif; ?>
                                
                                <div class="price-section">
                                    <span class="h5 text-primary">$<?php echo number_format($row['discount_price'], 2); ?></span>
                                    <?php if ($row['price'] > $row['discount_price']): ?>
                                        <span class="text-muted ms-2"><del>$<?php echo number_format($row['price'], 2); ?></del></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="card-footer bg-white border-top-0">
                                <a href="booking.php?destination_id=<?php echo $row['destination_id']; ?>" 
                                   class="btn btn-primary w-100">
                                    <i class="fas fa-calendar-alt"></i> Book Now
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                // Show message if no items found
                echo "<div class='col-12'>
                        <div class='alert alert-info text-center'>
                            <h4><i class='fas fa-info-circle'></i> No $type found</h4>
                            <p>There are currently no $type available.</p>
                            <p>Debug info: Type '$type' not found in database.</p>
                            <a href='home.php' class='btn btn-primary'>Return to Home</a>
                        </div>
                      </div>";
                
                // Debug: Show all available types
                $debug_sql = "SELECT DISTINCT type, COUNT(*) as count FROM destination GROUP BY type";
                $debug_result = $conn->query($debug_sql);
                
                if ($debug_result && $debug_result->num_rows > 0) {
                    echo "<div class='col-12 mt-3'>
                            <div class='alert alert-warning'>
                                <h5>Available types in database:</h5>
                                <ul>";
                    while($debug_row = $debug_result->fetch_assoc()) {
                        echo "<li>" . $debug_row['type'] . " (" . $debug_row['count'] . " items)</li>";
                    }
                    echo "</ul></div></div>";
                }
            }
            ?>
        </div>
    </div>
    
    <?php include "footer.php"; ?>
</body>
</html>