<?php
include '../backend/connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Local Tours — Pokhara</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
body { background:#f5f5f5; }
.card-elevated {
  background:#fff;
  border-radius:12px;
  overflow:hidden;
  box-shadow:0 6px 18px rgba(0,0,0,0.08);
  transition:0.3s;
}
.card-elevated:hover { transform:translateY(-6px); }
.card-elevated img { width:100%; height:200px; object-fit:cover; }
.card-body { padding:15px; }
.card-title { color:#023e8a; }
.price { font-weight:bold; color:#007bff; }
.section-title { text-align:center; margin:40px 0 20px; font-size:32px; color:#023e8a; }
</style>
</head>

<body>
<?php include "nav.php"; ?>

<div class="container mt-5">

<?php
// Only fetch these categories
$allowed_categories = ['Trekking','Hill point'];

// Loop over allowed categories
foreach($allowed_categories as $categoryName){
    echo '<h2 class="section-title">'.ucwords($categoryName).'</h2>';
    echo '<div class="row g-4">';

    $stmt = $conn->prepare("SELECT * FROM destination WHERE category = ?");
    $stmt->bind_param("s", $categoryName);
    $stmt->execute();
    $destResult = $stmt->get_result();

    if($destResult->num_rows > 0){
        while($dest = $destResult->fetch_assoc()){
            $price = $dest['discount_price'] ? $dest['discount_price'] : $dest['price'];
            echo '
            <div class="col-md-4">
              <div class="card-elevated">
                <img src="../uploads/'.$dest['image'].'" alt="'.htmlspecialchars($dest['name']).'">
                <div class="card-body">
                  <h3 class="card-title">'.htmlspecialchars($dest['name']).'</h3>
                  <p>'.substr($dest['description'],0,80).'...</p>
                  <span class="price">NPR '.$price.'</span><br><br>
                  <a href="booking.php?tour_id='.$dest['destination_id'].'" class="btn btn-primary">Book Now</a>
                </div>
              </div>
            </div>';
        }
    } else {
        echo '<p class="text-center">No destinations available in this category.</p>';
    }

    echo '</div>'; // row
}

$conn->close();
?>

</div>

<?php include 'footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
