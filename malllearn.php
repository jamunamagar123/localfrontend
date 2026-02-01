<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tread Mall — Pokhara</title>

  <!-- Font Awesome & Bootstrap -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

  <!-- Leaflet CSS -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

  <link rel="stylesheet" href="nav.css">
  <script src="nav.js" defer></script>

  <style>
    body{font-family:Arial,sans-serif;margin:0;padding:0;background:#f4f6f8;color:#222;}
    .container{max-width:1100px;margin:28px auto;padding:20px;}
    .hero{height:250px;background-size:cover;background-position:center;border-radius:6px;box-shadow:0 6px 18px rgba(10,10,10,0.08);}
    .card{display:grid;grid-template-columns:1fr 320px;gap:20px;margin-top:12px;align-items:start;}
    .left, .right{background:#fff;padding:18px;border-radius:8px;box-shadow:0 6px 18px rgba(10,10,10,0.08);}
    .thumbs{display:flex;gap:14px;flex-wrap:wrap;margin:8px 0;}
    .thumbs img{width:120px;height:70px;object-fit:cover;border-radius:6px;}
    
    /* Map Styles */
    #map{height:220px;border-radius:8px;border:1px solid #e6e9ed;overflow:hidden;}
    .btn{background:#0b79d0;color:#fff;padding:12px 18px;border-radius:8px;border:none;cursor:pointer;}
    
    /* Contact Modal */
    .contact-modal{
      display:none;
      position:fixed;
      top:0; left:0; right:0; bottom:0;
      background:rgba(0,0,0,0.6);
      justify-content:center;
      align-items:center;
      z-index:1000;
    }
    .contact-box{
      background:#fff;
      padding:24px 28px;
      border-radius:10px;
      box-shadow:0 6px 20px rgba(0,0,0,0.2);
      text-align:center;
      max-width:320px;
      animation:fadeIn 0.3s ease-in-out;
    }
    @keyframes fadeIn{from{opacity:0;transform:scale(0.9);}to{opacity:1;transform:scale(1);} }
    .close-btn{
      background:#e74c3c;
      color:#fff;
      border:none;
      padding:6px 12px;
      border-radius:6px;
      cursor:pointer;
      margin-top:14px;
    }
    .leaflet-container{border-radius:8px;}
  </style>
</head>
<body>
  <nav class="main-nav">
    <!-- Add your nav HTML from main page -->
  </nav>

  <div class="container">

    <!-- Hero Image -->
    <div class="hero" style="background-image:url('mall.jpg')"></div>

    <div class="card">
      <!-- Left Column -->
      <div class="left">
        <h2>Tread Mall</h2>
        <div class="thumbs">
          <img src="mall.jpg" alt="Mall front view">
          <img src="view.jpg" alt="Interior view of Tread Mall">
          <img src="trade.jpg" alt="Shops inside Tread Mall">
        </div>

        <div style="margin-top:12px;border-top:1px solid #e6e9ed;padding-top:12px">
          <div class="location-title">Location</div>
          <div style="color:#888;margin-bottom:8px">
            Tread Mall, Lakeside, Pokhara
            <span style="float:right;font-size:14px">
              <a href="#" id="open-map-link">see on Map &gt;</a>
            </span>
          </div>

          <!-- Leaflet Map -->
          <div id="map"></div>
        </div>
      </div>

      <!-- Right Column -->
      <div class="right">
        <h3>Welcome to Tread Mall</h3>
        <p>Tread Mall is one of Pokhara’s modern shopping destinations, offering a mix of local and international brands, restaurants, cafes, and entertainment options. It’s the perfect spot for shopping, dining, and spending quality time with family and friends in a comfortable environment.</p>
        <div class="price-row" style="margin-top:18px;">
          <button class="btn" id="book-now">Contact Now</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Contact Modal -->
  <div class="contact-modal" id="contactModal">
    <div class="contact-box">
      <h4>📞 Contact Information</h4>
      <p style="margin:10px 0;font-size:16px;">Tread Mall — Pokhara</p>
      <p><strong>Phone:</strong> +977-9801234567</p>
      <div class="map-popup" id="modalMap" style="height:200px;"></div>
      <button class="close-btn" id="closeModal">Close</button>
    </div>
  </div>

  <!-- Leaflet JS -->
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

  <script>
    // Coordinates for Tread Mall
    const lat = 28.2110;
    const lon = 83.9580;

    // Main map
    const map = L.map('map').setView([lat, lon], 16);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);
    L.marker([lat, lon]).addTo(map)
      .bindPopup('Tread Mall, Lakeside, Pokhara')
      .openPopup();

    // Modal map
    const modalMap = L.map('modalMap', {scrollWheelZoom:false}).setView([lat, lon], 16);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '&copy; OpenStreetMap contributors'
    }).addTo(modalMap);
    L.marker([lat, lon]).addTo(modalMap)
      .bindPopup('Tread Mall, Lakeside, Pokhara')
      .openPopup();

    // Resize modal map when modal opens
    const contactBtn = document.getElementById('book-now');
    const contactModal = document.getElementById('contactModal');
    const closeModal = document.getElementById('closeModal');

    contactBtn.addEventListener('click', ()=>{
      contactModal.style.display = 'flex';
      setTimeout(()=>{modalMap.invalidateSize();}, 100); // Fix map rendering in modal
    });

    closeModal.addEventListener('click', ()=>{ contactModal.style.display = 'none'; });
    window.addEventListener('click', (e)=>{ if(e.target === contactModal) contactModal.style.display = 'none'; });

    // Scroll to map
    document.getElementById('open-map-link').addEventListener('click', function(e){
      e.preventDefault();
      document.getElementById('map').scrollIntoView({behavior:'smooth', block:'center'});
    });
  </script>
</body>
</html>
