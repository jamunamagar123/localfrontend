<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Travel Services Info</title>

<!-- Font Awesome -->
<link rel="stylesheet"
 href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
  body {
    font-family: Arial, sans-serif;
    background: #f6f8fb;
    padding: 30px;
  }

  h2 {
    text-align: center;
    margin-bottom: 30px;
  }

  /* ICONS */
  .icon-row {
    display: flex;
    justify-content: space-evenly;
    margin-bottom: 30px;
  }

  .icon-item {
    text-align: center;
    cursor: pointer;
    color: #0d6efd;
  }

  .icon-item i {
    font-size: 34px;
  }

  .icon-item p {
    margin-top: 6px;
    font-weight: 600;
  }

  .icon-item:hover {
    color: #084298;
  }

  /* INFO SECTION */
  .info-section {
    display: none;
    background: white;
    border-radius: 12px;
    padding: 25px;
    max-width: 900px;
    margin: auto;
    box-shadow: 0 4px 14px rgba(0,0,0,0.12);
  }

  .info-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
  }

  .info-box {
    border: 1px solid #e5e7eb;
    border-radius: 10px;
    padding: 15px;
  }

  .info-box h4 {
    margin-top: 0;
    color: #0d6efd;
  }

  .info-box ul {
    padding-left: 18px;
    margin: 10px 0;
  }

  .info-box button {
    background: #0d6efd;
    color: white;
    border: none;
    padding: 8px 14px;
    border-radius: 6px;
    cursor: pointer;
  }

  .info-box button:hover {
    background: #084298;
  }
</style>
</head>

<body>

<h2>Our Travel Services</h2>

<!-- ICONS -->
<div class="icon-row">
  <div class="icon-item" onclick="showInfo()">
    <i class="fa-solid fa-house"></i>
    <p>Villa</p>
  </div>

  <div class="icon-item" onclick="showInfo()">
    <i class="fa-solid fa-hotel"></i>
    <p>Hotel</p>
  </div>

  <div class="icon-item" onclick="showInfo()">
    <i class="fa-solid fa-plane"></i>
    <p>Flight</p>
  </div>

  <div class="icon-item" onclick="showInfo()">
    <i class="fa-solid fa-map-signs"></i>
    <p>Guide</p>
  </div>
</div>

<!-- INFO -->
<div id="infoSection" class="info-section">

  <div class="info-grid">

    <div class="info-box">
      <h4><i class="fa-solid fa-house"></i> Villa</h4>
      <p>Enjoy private luxury villas with scenic views and full comfort.</p>
      <ul>
        <li>Private pool</li>
        <li>Family friendly</li>
        <li>Premium locations</li>
      </ul>
      <button>View Villas</button>
    </div>

    <div class="info-box">
      <h4><i class="fa-solid fa-hotel"></i> Hotel</h4>
      <p>Affordable and luxury hotels to match every travel style.</p>
      <ul>
        <li>Budget to 5-star</li>
        <li>City center locations</li>
        <li>24/7 support</li>
      </ul>
      <button>View Hotels</button>
    </div>

    <div class="info-box">
      <h4><i class="fa-solid fa-plane"></i> Flight</h4>
      <p>Book domestic and international flights easily.</p>
      <ul>
        <li>Multiple airlines</li>
        <li>Best price guarantee</li>
        <li>Easy reschedule</li>
      </ul>
      <button>Search Flights</button>
    </div>

    <div class="info-box">
      <h4><i class="fa-solid fa-map-signs"></i> Guide</h4>
      <p>Explore destinations with professional local guides.</p>
      <ul>
        <li>Language support</li>
        <li>Certified guides</li>
        <li>Custom tours</li>
      </ul>
      <button>Find Guides</button>
    </div>

  </div>

</div>

<script>
  function showInfo() {
    document.getElementById("infoSection").style.display = "block";
  }
</script>

</body>
</html>
