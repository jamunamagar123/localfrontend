<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ghandruk — Pokhara</title>
  
  <!-- Bootstrap & Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

  <!-- Leaflet CSS -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
  
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background: #f4f6f8;
      color: #222;
    }
    .container {
      max-width: 1100px;
      margin: 28px auto;
      padding: 20px;
    }
    .hero {
      height: 250px;
      background-size: cover;
      background-position: center;
      border-radius: 6px;
      box-shadow: 0 6px 18px rgba(10,10,10,0.08);
    }
    .card {
      display: grid;
      grid-template-columns: 1fr 350px;
      gap: 20px;
      margin-top: 12px;
      align-items: start;
    }
    .left, .right {
      background: #fff;
      padding: 18px;
      border-radius: 8px;
      box-shadow: 0 6px 18px rgba(10,10,10,0.08);
    }
    .thumbs {
      display: flex;
      gap: 12px;
      flex-wrap: wrap;
      margin: 8px 0;
    }
    .thumbs img {
      width: 110px;
      height: 70px;
      object-fit: cover;
      border-radius: 6px;
      cursor: pointer;
      transition: transform 0.3s;
    }
    .thumbs img:hover { transform: scale(1.05); }
    #map {
      height: 300px;
      border-radius: 8px;
      border: 1px solid #e6e9ed;
      margin-top: 8px;
    }
    .btn { background: #0b79d0; color: #fff; padding: 12px 18px; border-radius: 6px; border: none; cursor: pointer; width: 100%; margin-top:12px; }
    .btn:hover { background: #095f9a; }

    .weather-title { font-size: 18px; font-weight: bold; margin-top: 15px; margin-bottom: 10px; }
    .windy-box { width: 100%; height: 220px; border-radius: 8px; overflow: hidden; border: 1px solid #ddd; margin-bottom: 15px; }

    /* Booking Modal */
    #booking-modal {
      display:none;
      position: fixed;
      top:0; left:0;
      width:100%; height:100%;
      background: rgba(0,0,0,0.6);
      justify-content:center;
      align-items:center;
      z-index:9999;
      overflow-y:auto;
      padding:20px;
    }
    .modal-content {
      background:#fff;
      border-radius:10px;
      max-width:600px;
      width:100%;
      padding:24px;
      position:relative;
      box-shadow:0 8px 20px rgba(0,0,0,0.2);
    }
    #close-modal {
      position:absolute;
      top:12px; right:16px;
      font-size:24px;
      cursor:pointer;
      color:#555;
      transition:0.3s;
    }
    #close-modal:hover { color:#000; }

    form label { margin-top:12px; font-weight:600; display:block; font-size:14px; color:#333; }
    form input, form select { width:100%; padding:10px; margin-top:6px; border:1px solid #ccc; border-radius:6px; font-size:14px; }
    form input:focus, form select:focus { outline:none; border-color:#0b79d0; box-shadow:0 0 5px rgba(11,121,208,0.3); }

    .form-row { display:flex; gap:10px; flex-wrap:wrap; }
    .form-group { flex:1; min-width:120px; display:flex; flex-direction:column; }

    .confirm-btn { background:#0b79d0; color:#fff; padding:12px; border-radius:8px; border:none; width:100%; font-size:16px; margin-top:20px; cursor:pointer; transition:0.3s; }
    .confirm-btn:hover { background:#095f9a; }

    @media(max-width:768px){ .card { grid-template-columns: 1fr; } .thumbs img { width: 90px; height: 60px; } .form-row{flex-direction:column;} }
  </style>
</head>
<body>

<div class="container">
  <!-- Hero -->
  <div class="hero" style="background-image:url('ghau.jpg');"></div>

  <!-- Main Card -->
  <div class="card">
    <!-- Left Column -->
    <div class="left">
      <h2>Ghandruk</h2>
      <div class="thumbs">
        <img src="ghau.jpg">
        <img src="nice.jpg">
        <img src="magar.jpg">
      </div>

      <div style="margin-top:12px;border-top:1px solid #e6e9ed;padding-top:12px">
        <strong>Location</strong>
        <div style="margin-bottom:6px;color:#888;">
          Ghandruk, Kaski, Nepal
          <span style="float:right;font-size:13px">
            <a href="#" id="open-map-link">see on Map &gt;</a>
          </span>
        </div>
        <div id="map"></div>
      </div>
    </div>

    <!-- Right Column -->
    <div class="right">
      <h3>Experience Ghandruk</h3>
      <p>Ghandruk is a picturesque Gurung village surrounded by majestic mountains. Visitors can enjoy traditional culture, trekking trails, and stunning panoramic views of Annapurna and Machapuchare ranges.</p>

      <!-- Weather -->
      <div class="weather-title">Weather in Ghandruk</div>
      <div class="windy-box">
        <iframe width="100%" height="100%"
          src="https://embed.windy.com/embed2.html?lat=28.3869&lon=83.8290&detailLat=28.3869&detailLon=83.8290&zoom=12&level=surface&overlay=wind&product=ecmwf&menu=&message=true&marker=true&calendar=now&pressure=true&type=map&location=coordinates&detail=true&metricWind=default&metricTemp=default"
          frameborder="0">
        </iframe>
      </div>

      <button class="btn" id="book-now">Book Now</button>
    </div>
  </div>
</div>

<!-- Booking Modal -->
<div id="booking-modal">
  <div class="modal-content">
    <span id="close-modal">&times;</span>
    <h3 style="text-align:center;margin-bottom:20px;">Ghandruk Booking Form</h3>
    <form id="booking-form">
      <!-- Step 1 -->
      <div id="step1">
        <div class="form-row">
          <div class="form-group">
            <label>Name:</label>
            <input type="text" name="name" required>
          </div>
          <div class="form-group">
            <label>Email:</label>
            <input type="email" name="email" required>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group">
            <label>No. of People:</label>
            <input type="number" name="people" required>
          </div>
          <div class="form-group">
            <label>Date:</label>
            <input type="date" name="date" required>
          </div>
        </div>


        <button type="button" class="confirm-btn" id="next-step">Next</button>
      </div>

      <!-- Step 2 -->
      <div id="step2" style="display:none;">
        <div class="form-row">
          <div class="form-group">
            <label>Destination:</label>
            <input type="text" name="destination" value="Ghandruk" required>
          </div>
          <div class="form-group">
            <label>Total Cost:</label>
            <input type="number" name="total_cost" required>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group">
            <label>Booking Status:</label>
            <select name="booking_status">
              <option value="pending">Pending</option>
              <option value="confirmed">Confirmed</option>
            </select>
          </div>
          <div class="form-group">
            <label>Payment Status:</label>
            <select name="payment_status">
              <option value="unpaid">Unpaid</option>
              <option value="paid">Paid</option>
            </select>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group">
            <label>Booking Time:</label>
            <input type="datetime-local" name="booking_time" required>
          </div>
          <div class="form-group">
            <label>Payment Method:</label>
            <select name="pay">
              <option value="cash">Cash</option>
            </select>
          </div>
          
        </div>
        <div class="form-row">
          <div class="form-group">
            <label>Selection:</label>
            <select name="packages">
              <option value="normal">User Name</option>
            </select>
          </div>
        </div>
        <button type="submit" class="confirm-btn">Confirm Booking</button>
      </div>
    </form>
  </div>
</div>

<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
  // Map
  const map = L.map('map').setView([28.3869, 83.8290], 14);
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
  L.marker([28.3869, 83.8290]).addTo(map)
    .bindPopup('Ghandruk, Nepal')
    .openPopup();
  document.getElementById('open-map-link').addEventListener('click', e=>{
    e.preventDefault();
    document.getElementById('map').scrollIntoView({behavior:'smooth', block:'center'});
  });

  // Booking Modal Logic
  const modal = document.getElementById('booking-modal');
  const openBtn = document.getElementById('book-now');
  const closeBtn = document.getElementById('close-modal');
  const step1 = document.getElementById('step1');
  const step2 = document.getElementById('step2');
  const nextStepBtn = document.getElementById('next-step');
  const form = document.getElementById('booking-form');

  openBtn.onclick = ()=> { modal.style.display='flex'; step1.style.display='block'; step2.style.display='none'; };
  closeBtn.onclick = ()=> modal.style.display='none';
  window.onclick = e=>{ if(e.target===modal) modal.style.display='none'; };
  nextStepBtn.onclick = ()=> { step1.style.display='none'; step2.style.display='block'; };
  form.onsubmit = e=>{
    e.preventDefault();
    alert(`Booking Confirmed!\nName: ${form.name.value}\nPeople: ${form.people.value}\nSelection: ${form.packages.value}\nDestination: ${form.destination.value}`);
    modal.style.display='none';
    form.reset();
    step1.style.display='block';
    step2.style.display='none';
  };
</script>

</body>
</html>
