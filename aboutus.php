<?php
session_start();
require_once 'backend/connect.php';

/* =============================
   FETCH ONE VILLA OFFER
   ============================= */
$villa = null;

$villa_stmt = $conn->prepare(
    "SELECT name, description 
     FROM destination 
     WHERE type = 'villa'
     ORDER BY destination_id DESC
     LIMIT 1"
);
$villa_stmt->execute();
$result = $villa_stmt->get_result();
if ($result->num_rows > 0) {
    $villa = $result->fetch_assoc();
}
$villa_stmt->close();

/* =============================
   FETCH GUIDERS
   ============================= */
$guiders = [];

$guide_stmt = $conn->prepare(
    "SELECT first_name, last_name, guide_photo, role 
     FROM guiders 
     ORDER BY first_name ASC"
);
$guide_stmt->execute();
$guiders = $guide_stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$guide_stmt->close();
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Hello Pokhara — About Us</title>

<!-- Bootstrap + Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<style>
body{background:#f8f9fa;font-family:Arial,Helvetica,sans-serif;}
.hero{display:grid;grid-template-columns:1fr 420px;gap:28px;align-items:center;}
.hero img{width:100%;height:320px;object-fit:cover;border-radius:14px;}
.card{border-radius:14px;box-shadow:0 8px 24px rgba(0,0,0,.08);margin-top:24px;}
.services{display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:16px;}
.feature{text-align:center;padding:18px;background:#fff;border-radius:14px;}
.team{display:flex;gap:16px;flex-wrap:wrap;}
.member{width:140px;text-align:center;}
.member img{width:140px;height:120px;object-fit:cover;border-radius:12px;}
</style>
</head>

<body>

<?php include 'nav.php'; ?>

<div class="container mt-5">

<!-- HERO -->
<div class="hero mb-4">
  <div>
    <h1>Local tour guides of Pokhara</h1>
    <p class="text-muted">Small groups, big memories with trusted local experts.</p>
    <a href="tour.php" class="btn btn-primary">See Tours</a>
  </div>
  <img src="mount.jpg" alt="Pokhara">
</div>

<!-- STORY -->
<section class="card p-4">
  <h3>Our Story</h3>
  <p>
    We are Pokhara locals offering authentic, safe and memorable travel experiences
    with licensed guides and personalized services.
  </p>
</section>

<!-- WHAT WE OFFER -->
<section class="card p-4">
  <h3>What we offer</h3>

  <div class="services">

    <!-- DYNAMIC VILLA OFFER -->
    <?php if ($villa): ?>
      <div class="feature">
        <i class="bi bi-house-door-fill fs-2 text-primary"></i><br>
        <strong><?= htmlspecialchars($villa['name']) ?></strong><br>
        <?= htmlspecialchars($villa['description']) ?>
      </div>
    <?php endif; ?>

    <!-- STATIC OFFERS -->
    <div class="feature">
      <i class="bi bi-map-fill fs-2 text-success"></i><br>
      <strong>Guided City Tours</strong><br>
      Explore Pokhara with experienced local guides
    </div>

    <div class="feature">
      <i class="bi bi-signpost-2-fill fs-2 text-warning"></i><br>
      <strong>Trekking Adventures</strong><br>
      Short and long treks around Annapurna region
    </div>

    <div class="feature">
      <i class="bi bi-water fs-2 text-info"></i><br>
      <strong>Adventure Activities</strong><br>
      Boating, paragliding, zipline and more
    </div>

  </div>
</section>

<!-- TEAM -->
<!-- TEAM -->
<section class="card p-4">
  <h3>Meet the Team</h3>

  <div class="team">
    <?php if (!empty($guiders)): ?>
      <?php foreach ($guiders as $g): ?>
        <?php
        $photo = !empty($g['guide_photo'])
       ? 'http://localhost/tour/gprofile/' . $g['guide_photo']
       : 'http://localhost/tour/gprofile/default.jpg';
        ?>
        <div class="member">
          <img src="<?= $photo ?>" alt="">
          <div class="fw-semibold">
            <?= htmlspecialchars($g['first_name'].' '.$g['last_name']) ?>
          </div>
          <div class="text-muted small">
            <?= htmlspecialchars($g['role']) ?>
          </div>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <p>No guides available.</p>
    <?php endif; ?>
  </div>
</section>


<!-- CTA -->
<section class="card p-4 text-center">
  <h3>Ready to explore?</h3>
  <p class="text-muted">Tell us what you like and we’ll plan it for you.</p>
  <a href="contact.php" class="btn btn-primary">Contact Us</a>
</section>

</div>

<!-- FOOTER -->
<?php include 'footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
