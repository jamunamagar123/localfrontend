<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>World Peace Stupa — Pokhara</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

  <style>
    body{font-family:Arial,sans-serif;margin:0;padding:0;background:#f4f6f8;color:#222;}
    .container{max-width:1100px;margin:28px auto;padding:20px;}
    .hero{height:250px;background-size:cover;background-position:center;border-radius:6px;box-shadow:0 6px 18px rgba(10,10,10,0.08);}
    .card{display:grid;grid-template-columns:1fr 320px;gap:20px;margin-top:12px;align-items:start;}
    .left, .right{background:#fff;padding:18px;border-radius:8px;box-shadow:0 6px 18px rgba(10,10,10,0.08);}
    .thumbs{display:flex;gap:14px;flex-wrap:wrap;margin:8px 0;}
    .thumbs img{width:120px;height:70px;object-fit:cover;border-radius:6px;}
    #map{height:300px;border-radius:8px;border:1px solid #e6e9ed;}
    .btn{background:#0b79d0;color:#fff;padding:12px 18px;border-radius:8px;border:none;cursor:pointer;width:100%;margin-top:15px;transition:0.3s;}
    .btn:hover{background:#095a9d;}

    /* Weather */
    .weather-title{font-size:18px;font-weight:600;margin-top:18px;margin-bottom:10px;}
    .weather-box{background:#f8fafc;border:1px solid #d9e1e8;padding:12px;border-radius:8px;margin-bottom:12px;}
    .windy-box{width:100%;height:200px;border-radius:8px;border:1px solid #ddd;overflow:hidden;margin-bottom:15px;}

    /* Booking Modal */
    #booking-modal{display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.5);justify-content:center;align-items:center;z-index:999;overflow-y:auto;padding:20px;}
    #booking-modal .modal-content{background:#fff;padding:30px;border-radius:12px;max-width:600px;width:100%;position:relative;box-shadow:0 8px 20px rgba(0,0,0,0.2);}
    #close-modal{position:absolute;top:12px;right:16px;font-size:24px;cursor:pointer;color:#555;transition:0.3s;}
    #close-modal:hover{color:#000;}
    form label{margin-top:12px;font-weight:600;display:block;font-size:14px;color:#333;}
    form input, form select{width:100%;padding:10px;margin-top:6px;border:1px solid #ccc;border-radius:6px;font-size:14px;box-sizing:border-box;transition:0.3s;}
    form input:focus, form select:focus{outline:none;border-color:#0b79d0;box-shadow:0 0 5px rgba(11,121,208,0.3);}
    .form-row{display:flex;gap:10px;flex-wrap:wrap;}
    .form-row .form-group{flex:1;min-width:120px;display:flex;flex-direction:column;}
    .confirm-btn{background:#0b79d0;color:#fff;padding:12px;border-radius:8px;border:none;width:100%;font-size:16px;margin-top:20px;cursor:pointer;transition:0.3s;}
    .confirm-btn:hover{background:#095a9d;}
    @media(max-width:600px){.card{grid-template-columns:1fr;}.form-row{flex-direction:column;}}
  </style>
</head>
<body>

<div class="container">
  <div class="hero" style="background-image:url('stupa.jpg')"></div>

  <div class="card">
    <!-- LEFT -->
    <div class="left">
      <h2>World Peace Stupa</h2>
      <div class="thumbs">
        <img src="stupa.jpg">
        <img src="god.webp">
        <img src="saragkot.jpg">
      </div>

      <div style="margin-top:12px;border-top:1px solid #e6e9ed;padding-top:12px">
        <div class="location-title">Location</div>
        <div style="color:#888;margin-bottom:8px">
          Pokhara, Nepal
          <span style="float:right;font-size:14px"><a href="#" id="open-map-link">see on Map &gt;</a></span>
        </div>
        <div id="map"></div>
      </div>
    </div>

    <!-- RIGHT -->
    <div class="right">
      <h3>Welcome to World Peace Stupa</h3>
      <p>Perched atop a hill, the World Peace Stupa offers panoramic views of Pokhara and the Himalayas.</p>

      <div class="weather-title">Weather in Pokhara</div>
      <div class="weather-box">
        <strong>Temperature:</strong> <span id="temp">Loading...</span><br>
        <strong>Condition:</strong> <span id="condition">Loading...</span>
      </div>

      <div class="windy-box">
        <iframe width="100%" height="100%" 
          src="https://embed.windy.com/embed2.html?lat=28.209&lon=83.985&detailLat=28.209&detailLon=83.985&zoom=11&level=surface&overlay=wind&product=ecmwf&marker=true"
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
    <h3 style="text-align:center;margin-bottom:20px;">Book Your Visit</h3>
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
            <input type="text" name="destination" value="World Peace Stupa" required>
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
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
  // MAP
  const loc = [28.2090, 83.9630];
  const map = L.map('map').setView(loc, 14);
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { maxZoom: 19 }).addTo(map);
  L.marker(loc).addTo(map).bindPopup("World Peace Stupa<br>Pokhara, Nepal").openPopup();
  document.getElementById('open-map-link').onclick = e => { e.preventDefault(); document.getElementById('map').scrollIntoView({behavior:'smooth'}); };

  // WEATHER
  fetch("https://api.open-meteo.com/v1/forecast?latitude=28.209&longitude=83.985&current_weather=true")
    .then(r=>r.json())
    .then(d=>{
      document.getElementById("temp").innerText = d.current_weather.temperature + "°C";
      document.getElementById("condition").innerText = "Wind " + d.current_weather.windspeed + " km/h";
    });

  // BOOKING MODAL
  const modal = document.getElementById('booking-modal');
  const openBtn = document.getElementById('book-now');
  const closeBtn = document.getElementById('close-modal');
  const step1 = document.getElementById('step1');
  const step2 = document.getElementById('step2');
  const nextStepBtn = document.getElementById('next-step');
  const form = document.getElementById('booking-form');

  openBtn.onclick = () => { modal.style.display='flex'; step1.style.display='block'; step2.style.display='none'; };
  closeBtn.onclick = () => modal.style.display='none';
  window.onclick = e => { if(e.target===modal) modal.style.display='none'; };
  nextStepBtn.onclick = () => { step1.style.display='none'; step2.style.display='block'; };
  form.onsubmit = e => {
    e.preventDefault();
    alert(`Booking Confirmed!\nName: ${form.name.value}\nPeople: ${form.people.value}\nDestination: ${form.destination.value}`);
    modal.style.display='none';
    form.reset();
    step1.style.display='block';
    step2.style.display='none';
  };
</script>

</body>
</html>
