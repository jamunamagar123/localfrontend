<?php
include '../backend/connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Hello Pokhara — Destinations</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
  /* Destination Grid */
.destination-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr); /* 3 cards per row on large screens */
  gap: 20px;
  margin-top: 30px;
}

/* Responsive for medium screens (tablets) */
@media (max-width: 992px) {
  .destination-grid {
    grid-template-columns: repeat(2, 1fr); /* 2 cards per row */
  }
}

/* Responsive for small screens (mobile) */
@media (max-width: 576px) {
  .destination-grid {
    grid-template-columns: 1fr; /* 1 card per row */
  }
}

.destination-card {
  background: #f5f5f5;
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 4px 12px rgba(0,0,0,0.1);
  transition: transform 0.3s, box-shadow 0.3s;
}

.destination-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 8px 20px rgba(0,0,0,0.15);
}

.destination-card img {
  width: 100%;
  height: 200px;
  object-fit: cover;
}

.card-content {
  padding: 15px;
}

.card-content h3 {
  color: #023e8a;
  margin-bottom: 5px;
}

.card-content p {
  color: #555;
  font-size: 14px;
  height: 40px; /* fixed height to show less text */
  overflow: hidden;
  text-overflow: ellipsis;
}

.card-content a {
  color: #007bff;
  font-weight: bold;
  text-decoration: none;
}

.card-content a:hover {
  text-decoration: underline;
}
</style>
</head>
<body>
<?php include 'nav.php'; ?>

<div class="container">
  <h2 class="text-center mt-4">Must-Visit Destinations in Pokhara</h2>
  <div class="destination-grid">
<?php
$sql = "SELECT * FROM destination ORDER BY created_at DESC";
$result = $conn->query($sql);

if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        $imagePath = '../uploads/'.$row['image'];
        $shortDesc = substr($row['description'], 0, 80) . '...'; // show only first 80 chars
        echo '<div class="destination-card">';
        echo '<img src="'.$imagePath.'" alt="'.$row['name'].'">';
        echo '<div class="card-content">';
        echo '<h3>'.$row['name'].'</h3>';
        echo '<p>'.$shortDesc.'</p>';
        echo '<a href="destination_detail.php?id='.$row['destination_id'].'">Learn More</a>';
        echo '</div></div>';
    }
} else {
    echo "<p class='text-center'>No destinations added yet.</p>";
}
?>
  </div>
</div>

<!-- Include footer at the end, outside of grid -->
<?php include 'footer.php'; ?>

</body>
</html>
