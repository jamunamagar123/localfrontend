<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sarangkot — Pokhara</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

  <!-- Leaflet CSS (Map library) -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>

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
      grid-template-columns: 1fr 320px;
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
      gap: 14px;
      flex-wrap: wrap;
      margin: 8px 0;
    }

    .thumbs img {
      width: 120px;
      height: 70px;
      object-fit: cover;
      border-radius: 6px;
    }

    #map-box {
      height: 300px;
      border-radius: 8px;
      border: 1px solid #e6e9ed;
      overflow: hidden;
      margin-top: 8px;
    }

    .btn {
      background: #0b79d0;
      color: #fff;
      padding: 12px 18px;
      border-radius: 8px;
      border: none;
      cursor: pointer;
      width: 100%;
      margin-top: 15px;
      transition: 0.3s;
    }

    .btn:hover {
      background: #095a9d;
    }

    /* ----------------- Booking Modal ----------------- */
    #booking-modal {
      display: none;
      position: fixed;
      top: 0; left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0,0,0,0.6);
      justify-content: center;
      align-items: center;
      z-index: 999;
      overflow-y: auto;
      padding: 20px;
    }

    #booking-modal .modal-content {
      background: #fff;
      padding: 30px;
      border-radius: 12px;
      max-width: 600px;
      width: 100%;
      max-height: 90vh;
      overflow-y: auto;
      position: relative;
      box-shadow: 0 8px 20px rgba(0,0,0,0.2);
      animation: slideDown 0.3s ease-in-out;
    }

    @keyframes slideDown {
      from { transform: translateY(-50px); opacity:0; }
      to { transform: translateY(0); opacity:1; }
    }

    #close-modal {
      position: absolute;
      top: 12px;
      right: 16px;
      font-size: 24px;
      cursor: pointer;
      color: #555;
      transition: 0.3s;
    }

    #close-modal:hover { color: #000; }

    /* Booking Form Styling */
    form label {
      margin-top: 12px;
      font-weight: 600;
      display: block;
      font-size: 14px;
      color: #333;
    }

    form input, form select {
      width: 100%;
      padding: 10px;
      margin-top: 6px;
      border: 1px solid #ccc;
      border-radius: 6px;
      display: block;
      font-size: 14px;
      box-sizing: border-box;
      transition: 0.3s;
    }

    form input:focus, form select:focus {
      outline: none;
      border-color: #0b79d0;
      box-shadow: 0 0 5px rgba(11,121,208,0.3);
    }

    .form-row {
      display: flex;
      gap: 10px;
      flex-wrap: wrap;
    }

    .form-row .form-group {
      flex: 1;
      min-width: 120px;
      display: flex;
      flex-direction: column;
    }

    .confirm-btn {
      background: #0b79d0;
      color: #fff;
      padding: 12px;
      border-radius: 8px;
      border: none;
      width: 100%;
      font-size: 16px;
      margin-top: 20px;
      cursor: pointer;
      transition: 0.3s;
    }

    .confirm-btn:hover {
      background: #095a9d;
    }

    @media(max-width:600px) {
      .card { grid-template-columns:1fr; }
      #booking-modal .modal-content { padding: 20px; }
      .form-row { flex-direction: column; }
    }
  </style>
</head>
<body>

<div class="container">
  <div class="hero" style="background-image:url('saragkot.jpg')"></div>

  <div class="card">
    <!-- Left Column -->
    <div class="left">
      <h2>Sarangkot</h2>
      <div class="thumbs">
        <img src="saragkot.jpg" alt="Sunrise view">
        <img src="mount.jpg" alt="Hillside view">
        <img src="para.jpg" alt="Paragliding">
      </div>

      <div style="margin-top:12px;border-top:1px solid #e6e9ed;padding-top:12px">
        <div class="location-title">Location</div>
        <div style="color:#888;margin-bottom:8px;">
          Sarangkot, Pokhara, Nepal
          <span style="float:right;font-size:14px">
            <a href="#" id="open-map-link">see on Map &gt;</a>
          </span>
        </div>

        <!-- Map -->
        <div id="map-box"></div>
      </div>
    </div>

    <!-- Right Column -->
    <div class="right">
      <h3>Experience Sarangkot</h3>
      <p>Sarangkot is famous for breathtaking sunrise and sunset views over the Annapurna and Dhaulagiri ranges. A hotspot for paragliding and mountain photography.</p>

      <div class="weather-box" style="margin-top:20px;">
        <div class="weather-title" style="font-weight:bold;">Weather in Pokhara</div>
        <iframe src="https://embed.windy.com/embed2.html?lat=28.2096&lon=83.9856&zoom=10" width="100%" height="200" frameborder="0" style="border-radius:8px;"></iframe>
      </div>

      <button class="btn" id="book-now">Book Now</button>
    </div>
  </div>
</div>

<!-- Booking Modal -->
<div id="booking-modal">
  <div class="modal-content">
    <span id="close-modal">&times;</span>
    <h3 style="text-align:center; margin-bottom:20px;">Book Your Visit</h3>

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
            <label>Destination :</label>
            <input type="text" name="destination" required>
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

        <button type="submit" class="confirm-btn" id="confirm-btn">Confirm Booking</button>
      </div>
    </form>
  </div>
</div>

<!-- Leaflet JS (Map Library) -->
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>
  // Modal
  const modal = document.getElementById('booking-modal');
  const openBtn = document.getElementById('book-now');
  const closeBtn = document.getElementById('close-modal');

  const step1 = document.getElementById('step1');
  const step2 = document.getElementById('step2');
  const nextStepBtn = document.getElementById('next-step');
  const form = document.getElementById('booking-form');

  openBtn.addEventListener('click', () => {
    modal.style.display = 'flex';
    step1.style.display = 'block';
    step2.style.display = 'none';
  });

  closeBtn.addEventListener('click', () => modal.style.display = 'none');
  window.addEventListener('click', e => { if(e.target === modal) modal.style.display = 'none'; });

  nextStepBtn.addEventListener('click', () => {
    step1.style.display = 'none';
    step2.style.display = 'block';
  });

  form.addEventListener('submit', e => {
    e.preventDefault();
    const name = form.name.value;
    const people = form.people.value;
    const destination = form.destination.value;
    alert(`Booking Confirmed!\nName: ${name}\nPeople: ${people}\nDestination: ${destination}`);
    modal.style.display = 'none';
    form.reset();
    step1.style.display = 'block';
    step2.style.display = 'none';
  });

  // Leaflet Map
  function initMap() {
    const map = L.map('map-box').setView([28.2100, 83.9626], 14);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      maxZoom: 19,
      attribution: '&copy; OpenStreetMap'
    }).addTo(map);

    L.marker([28.2100, 83.9626])
      .addTo(map)
      .bindPopup("<b>Sarangkot</b><br>Pokhara, Nepal")
      .openPopup();
  }
  initMap();

  document.getElementById('open-map-link').addEventListener('click', function(e){
    e.preventDefault();
    document.getElementById('map-box').scrollIntoView({behavior:'smooth', block:'center'});
  });
</script>

</body>
</html>
