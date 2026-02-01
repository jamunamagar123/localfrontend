<?php
include '../backend/connect.php';

$limit = isset($_GET['limit']) ? intval($_GET['limit']) : 6;
$offset = isset($_GET['offset']) ? intval($_GET['offset']) : 0;

// Fetch destinations
$res = $conn->query("SELECT * FROM destination ORDER BY created_at DESC LIMIT $limit OFFSET $offset");

$destinations = [];
while($row = $res->fetch_assoc()){
    $destinations[] = $row;
}

// Check if more destinations exist
$totalRes = $conn->query("SELECT COUNT(*) AS total FROM destination");
$total = $totalRes->fetch_assoc()['total'];
$hasMore = ($offset + $limit) < $total;

// Return JSON
echo json_encode([
    'destinations' => $destinations,
    'hasMore' => $hasMore
]);
?>
