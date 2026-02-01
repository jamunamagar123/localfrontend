<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Local Tours & Booking — Pokhara</title>

    <!-- Icons & Bootstrap -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="nav.css">
    <script src="nav.js" defer></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
      :root { --brand:#023e8a; --muted:#f5f5f5; --accent:#007bff; }
      body { font-family: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial; background:#fff; color:#222; }
      .container { max-width:1200px; margin:0 auto; padding:0 20px; }
      .section-head { text-align:center; margin:40px 0; }
      .section-head h2 { color:var(--brand); font-size:28px; margin-bottom:6px; }
      .section-head p { color:#556; margin:0; }
      .grid { display:grid; grid-template-columns:repeat(auto-fit,minmax(280px,1fr)); gap:20px; }
      .card-elevated { background:#fff; border-radius:12px; overflow:hidden; box-shadow:0 6px 18px rgba(3,46,106,0.08); transition:transform .18s ease, box-shadow .18s; border:1px solid rgba(3,46,106,0.04); }
      .card-elevated:hover { transform:translateY(-6px); box-shadow:0 12px 28px rgba(3,46,106,0.12); }
      .card-elevated img { width:100%; height:200px; object-fit:cover; display:block; }
      .card-body { padding:16px; }
      .card-title { color:var(--brand); margin:0 0 8px 0; font-size:20px; }
      .card-text { color:#555; margin-bottom:8px; font-size:14px; }
      .price { font-weight:700; color:var(--accent); margin-bottom:8px; display:block; }
      .rating { color:#ffb400; margin-right:8px; font-weight:600; }
      .actions { display:flex; gap:10px; align-items:center; flex-wrap:wrap; }
      .btn-primary-ghost { background:transparent; border:1px solid var(--brand); color:var(--brand); padding:.5rem .9rem; border-radius:8px; }
      .btn-primary { background:var(--brand); color:#fff; padding:.5rem .9rem; border-radius:8px; border:none; }
      .meta { display:flex; gap:12px; color:#666; font-size:13px; align-items:center; }
      .filter-bar { display:flex; gap:12px; align-items:center; justify-content:space-between; margin-bottom:16px; flex-wrap:wrap; }
      .filter-left { display:flex; gap:8px; align-items:center; }
      .search-input { min-width:220px; padding:8px 12px; border-radius:8px; border:1px solid #ddd; }
      #local-tours { padding:50px 20px; background:var(--muted); }
      #accommodations { padding:50px 20px; background:#fff; }
      #homestays { padding:50px 20px; background:var(--muted); }
      @media (max-width:540px){ .card-elevated img { height:160px; } }

      /* Room modal styles */
      .room-card { display:flex; gap:12px; padding:12px; border-bottom:1px solid #eee; align-items:flex-start; }
      .room-card img { width:160px; height:100px; object-fit:cover; border-radius:8px; }
      .amenities { display:flex; gap:8px; flex-wrap:wrap; margin-top:8px; }
      .amenities span { background:#f1f5fb; color:var(--brand); padding:6px 8px; border-radius:6px; font-size:13px; }
    </style>
  </head>

  <body>
    <!-- NAV -->
    <!-- Navigation placeholder -->
  <?php include 'nav.php'; ?>
  
  <div class="wrap">
    <div class="contact-grid"></div>

    <!-- Search Overlay (minimal) -->
    <div id="searchOverlay" role="dialog" aria-modal="true" aria-hidden="true" style="display:none;">
      <div class="search-box" style="background:white;padding:12px;border-radius:8px;max-width:700px;margin:40px auto;">
        <input type="text" id="searchBox" placeholder="Type keywords to search..." style="width:100%;padding:8px;border-radius:6px;border:1px solid #ddd;">
        <button id="closeBtn" class="btn" style="margin-left:8px;">Close</button>
      </div>
    </div>

    <main>
      <!-- Tours retained -->
      <section id="local-tours">
        <div class="container">
          <div class="section-head">
            <h2>Explore Local Tours in Pokhara</h2>
            <p>Day trips, cultural visits and scenic experiences — book easily and securely.</p>
          </div>
          </div>

          <div class="grid" id="toursGrid">
            <!-- sample tours (unchanged) -->
            <div class="card-elevated">
              <img src="boting.jpg" alt="Fewa Lake Boating">
              <div class="card-body">
                <h3 class="card-title">Fewa Lake Boating</h3>
                <p class="card-text">Enjoy a serene boat ride on the iconic Fewa Lake with breathtaking mountain views.</p>
                <span class="price">$10 / person</span>
                <div class="meta"><span class="rating">★★★4.6</span><span>Ratings 150</span></div>
                <div class="actions" style="margin-top:12px;">
                  <button class="btn-primary" data-type="tour" data-title="Fewa Lake Boating" data-price="$10" onclick="openBookingModal(this)">Book Now</button>
                  
                </div>
              </div>
            </div>

            <div class="card-elevated">
              <img src="saragkot.jpg" alt="Sarangkot Sunrise">
              <div class="card-body">
                <h3 class="card-title">Sarangkot Sunrise View</h3>
                <p class="card-text">Hike or drive up to Sarangkot to witness the stunning sunrise over the Annapurna range.</p>
                <span class="price">$12 / person</span>
                <div class="meta"><span class="rating">★★★4.7</span><span>Ratings 100 </span></div>
                <div class="actions" style="margin-top:12px;">
                  <button class="btn-primary" data-type="tour" data-title="Sarangkot Sunrise View" data-price="$12" onclick="openBookingModal(this)">Book Now</button>
                </div>
              </div>
            </div>

            <div class="card-elevated">
              <img src="gptesor.jpg" alt="Devgahat & Gupteshwor">
              <div class="card-body">
                <h3 class="card-title">Devgahat & Gupteshwor Cave</h3>
                <p class="card-text">Visit the sacred Devghat confluence and explore the Gupteshwor Cave.</p>
                <span class="price">$10 / person</span>
                <div class="meta"><span class="rating">★★★ 4.5</span><span> Ratings 133</span></div>
                <div class="actions" style="margin-top:12px;">
                  <button class="btn-primary" data-type="tour" data-title="Devgahat & Gupteshwor Cave" data-price="$10" onclick="openBookingModal(this)">Book Now</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Accommodations with new View Rooms behavior -->
      <section id="accommodations">
        <div class="container">
          <div class="section-head">
            <h2>Hotel Booking</h2>
            <p>Select from comfortable hotels in Pokhara — click "View Rooms" to see available rooms.</p>
          </div>

          </div>

          <!-- Hotels grid -->
          <div class="grid" id="hotelsGrid">
            <!-- Hotel 1 -->
            <div class="card-elevated" data-hotel-id="hotel1">
              <img src="grand.jpg" alt="Hotel Lakeside">
              <div class="card-body">
                <h3 class="card-title">Lakeside Grand Hotel</h3>
                <p class="card-text">Comfortable rooms with lake-facing balconies and free breakfast.</p>
                <div class="meta"><span class="rating">★ 4.8</span><span>Free Wi-Fi • Breakfast</span></div>
                <div class="actions" style="margin-top:12px;">
                  <button class="btn-primary" data-type="hotel" data-title="Lakeside Grand Hotel" data-price="$45" onclick="openBookingModal(this)">Book Now</button>
                  <button class="btn-primary-ghost" onclick="openRoomsModal('hotel1')">View Rooms</button>
                </div>
              </div>
            </div>

            <!-- Hotel 2 -->
            <div class="card-elevated" data-hotel-id="hotel2">
              <img src="bout.avif" alt="Hotel Cityview">
              <div class="card-body">
                <h3 class="card-title">Cityview Boutique</h3>
                <p class="card-text">Charming boutique hotel near the main market and cultural spots.</p>
                <div class="meta"><span class="rating">★ 4.5</span><span>Near market • Airport transfer</span></div>
                <div class="actions" style="margin-top:12px;">
                  <button class="btn-primary" data-type="hotel" data-title="Cityview Boutique" data-price="$50" onclick="openBookingModal(this)">Book Now</button>
                  <button class="btn-primary-ghost" onclick="openRoomsModal('hotel2')">View Rooms</button>
                </div>
              </div>
            </div>

            <!-- Hotel 3 -->
            <div class="card-elevated" data-hotel-id="hotel3">
              <img src="anu.avif" alt="Luxury Stay">
              <div class="card-body">
                <h3 class="card-title">Annapurna Luxury Stay</h3>
                <p class="card-text">Premium rooms, spa, rooftop dining with mountain views.</p>
                <div class="meta"><span class="rating">★ 4.9</span><span>Spa • Rooftop</span></div>
                <div class="actions" style="margin-top:12px;">
                  <button class="btn-primary" data-type="hotel" data-title="Annapurna Luxury Stay" data-price="$6s0" onclick="openBookingModal(this)">Book Now</button>
                  <button class="btn-primary-ghost" onclick="openRoomsModal('hotel3')">View Rooms</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Homestays retained -->
      <section id="homestays">
        <div class="container">
          <div class="section-head">
            <h2>Homestays & Local Stays</h2>
            <p>Experience Nepali hospitality in authentic homestays and village lodges.</p>
          </div>

          <div class="grid" id="homestaysGrid">
            <div class="card-elevated">
              <img src="ghar.webp" alt="Ghandruk Homestay">
              <div class="card-body">
                <h3 class="card-title">Ghandruk Village Homestay</h3>
                <p class="card-text">Traditional Gurung home with home-cooked meals and mountain views.</p>
                <span class="price">$20 / night</span>
                <div class="meta"><span class="rating">★ 4.7</span><span>Local meals included</span></div>
                <div class="actions" style="margin-top:12px;">
                  <button class="btn-primary" data-type="homestay" data-title="Ghandruk Village Homestay" data-price="1200" onclick="openBookingModal(this)">Book Now</button>
                </div>
              </div>
            </div>

            <div class="card-elevated">
              <img src="home.jpg" alt="Lakeside Homestay">
              <div class="card-body">
                <h3 class="card-title">Lakeside Family Stay</h3>
                <p class="card-text">Cozy home near Fewa Lake, friendly hosts and easy access to the lakeside.</p>
                <span class="price">$28 / night</span>
                <div class="meta"><span class="rating">★ 4.6</span><span>Walking distance to attractions</span></div>
                <div class="actions" style="margin-top:12px;">
                  <button class="btn-primary" data-type="homestay" data-title="Lakeside Family Stay" data-price="1800" onclick="openBookingModal(this)">Book Now</button>
                </div>
              </div>
            </div>

            <div class="card-elevated">
              <img src="lodge.jpeg" alt="Village Lodge">
              <div class="card-body">
                <h3 class="card-title">Village Lodge Retreat</h3>
                <p class="card-text">Quiet lodge with cultural programs, ideal for travelers wanting an immersive stay.</p>
                <span class="price">$15 / night</span>
                <div class="meta"><span class="rating">★ 4.5</span><span>Cultural program available</span></div>
                <div class="actions" style="margin-top:12px;">
                  <button class="btn-primary" data-type="homestay" data-title="Village Lodge Retreat" data-price="1500" onclick="openBookingModal(this)">Book Now</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>

    <!-- Room Details Modal (dynamic content) -->
    <div class="modal fade" id="roomsModal" tabindex="-1" aria-labelledby="roomsModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="roomsModalLabel">Rooms — <span id="roomsHotelName"></span></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div id="roomsList">
              <!-- Room cards injected here by JS -->
            </div>
            <div class="mt-3 text-muted small">Tip: Click <strong>Book Room</strong> on any room to proceed to booking.</div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Booking Modal (reusable) -->
    <div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <form id="bookingForm">
            <div class="modal-header">
              <h5 class="modal-title" id="bookingModalLabel">Book: <span id="modalItemTitle"></span></h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <input type="hidden" id="modalItemType" name="type">
              <input type="hidden" id="modalItemPrice" name="price">
              <input type="hidden" id="modalItemId" name="itemId">

              <div class="mb-3">
                <label class="form-label">Full name</label>
                <input required class="form-control" id="guestName" name="name" placeholder="Your full name">
              </div>

              <div class="row gx-2">
                <div class="col-6 mb-3">
                  <label class="form-label">Phone</label>
                  <input required class="form-control" id="guestPhone" name="phone" placeholder="+977 98XXXXXXXX">
                </div>
                <div class="col-6 mb-3">
                  <label class="form-label">Email</label>
                  <input required type="email" class="form-control" id="guestEmail" name="email" placeholder="name@mail.com">
                </div>
              </div>

              <div class="row gx-2">
                <div class="col-6 mb-3">
                  <label class="form-label">Check-in</label>
                  <input required type="date" class="form-control" id="checkin" name="checkin">
                </div>
                <div class="col-6 mb-3">
              <label class="form-label">Payment Method</label>
              <select required class="form-control" name="payment">
                <option value="Cash">Cash Payment</option>
              </select>
            </div>
              </div>

              <div class="alert alert-light small" id="priceInfo" style="display:none;"></div>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-primary">Confirm Booking</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Footer -->
    <?php include 'footer.php' ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
      // ---------- Sample hotel/room data ----------
      // Edit this object with real images, descriptions, amenities and prices
      const hotelsData = {
        hotel1: {
          id: 'hotel1',
          name: 'Lakeside Grand Hotel',
          rooms: [
            { id: 'h1-r1', name: 'Standard Room', price: 4500, img:'stroom.jpg', persons:2, desc:'Cozy room with queen bed and city view.', amenities:['Free Wi-Fi','Breakfast','Ensuite Bath'] },
            { id: 'h1-r2', name: 'Deluxe Lake View', price: 6500, img:'1 bed.jpg', persons:2, desc:'Spacious room with balcony facing Fewa Lake.', amenities:['Lake view','Free Breakfast','Balcony','AC'] },
            { id: 'h1-r3', name: 'Family Suite', price: 11000, img:'2 bed.jpg', persons:4, desc:'Two-bed suite with living area, ideal for families.', amenities:['2 Beds','Living Area','Breakfast Included'] }
          ]
        },
        hotel2: {
          id: 'hotel2',
          name: 'Cityview Boutique',
          rooms: [
            { id: 'h2-r1', name: 'Boutique Double', price: 3200, img:'2 bed.jpg', persons:2, desc:'Stylish double room near market.', amenities:['Breakfast','Airport Transfer'] },
            { id: 'h2-r2', name: 'Superior King', price: 4200, img:'room.jpg', persons:2, desc:'Larger room with king bed and city views.', amenities:['King Bed','Free Wi-Fi'] }
          ]
        },
        hotel3: {
          id: 'hotel3',
          name: 'Annapurna Luxury Stay',
          rooms: [
            { id: 'h3-r1', name: 'Luxury Room', price: 7800, img:'room.jpg', persons:2, desc:'Premium room with spa access and rooftop views.', amenities:['Spa Access','Rooftop Dining','Breakfast'] },
            { id: 'h3-r2', name: 'Presidential Suite', price: 16000, img:'stroom.jpg', persons:4, desc:'Top-floor suite with private lounge and panoramic views.', amenities:['Private Lounge','Butler Service','Rooftop'] }
          ]
        }
      };

      // ---------- Modal helpers ----------
      const roomsModalEl = document.getElementById('roomsModal');
      const roomsModal = new bootstrap.Modal(roomsModalEl);
      const roomsHotelNameEl = document.getElementById('roomsHotelName');
      const roomsListEl = document.getElementById('roomsList');

      const bookingModalEl = document.getElementById('bookingModal');
      const bookingModal = new bootstrap.Modal(bookingModalEl);
      const modalItemTitle = document.getElementById('modalItemTitle');
      const modalItemType = document.getElementById('modalItemType');
      const modalItemPrice = document.getElementById('modalItemPrice');
      const modalItemId = document.getElementById('modalItemId');
      const priceInfo = document.getElementById('priceInfo');
      const bookingForm = document.getElementById('bookingForm');

      // Populate and open Rooms Modal for a hotel id
      function openRoomsModal(hotelId) {
        const hotel = hotelsData[hotelId];
        if (!hotel) return;
        roomsHotelNameEl.textContent = hotel.name;
        roomsListEl.innerHTML = ''; // clear

        hotel.rooms.forEach(room => {
          const roomEl = document.createElement('div');
          roomEl.className = 'room-card';
          roomEl.innerHTML = `
            <img src="${room.img}" alt="${room.name}" onerror="this.src='placeholder-room.jpg'">
            <div style="flex:1;">
              <h5 style="margin:0 0 6px 0">${room.name} <small style="color:#666;font-weight:600">— NPR ${room.price} / night</small></h5>
              <p style="margin:0;color:#444">${room.desc}</p>
              <div class="amenities" aria-hidden="false" style="margin-top:8px">
                ${room.amenities.map(a => `<span>${a}</span>`).join('')}
              </div>
              <div style="margin-top:10px;">
                <button class="btn btn-primary" onclick="bookRoom('${hotelId}','${room.id}')">Book Room</button>
                <button class="btn btn-primary-ghost" onclick="viewRoomGallery('${hotelId}','${room.id}')">View Photos</button>
              </div>
            </div>
          `;
          roomsListEl.appendChild(roomEl);
        });

        roomsModal.show();
      }

      // When user clicks Book Room from the room modal: open booking modal prefilled
      function bookRoom(hotelId, roomId) {
        const hotel = hotelsData[hotelId];
        if (!hotel) return;
        const room = hotel.rooms.find(r => r.id === roomId);
        if (!room) return;

        // populate booking modal fields
        modalItemTitle.textContent = hotel.name + ' — ' + room.name;
        modalItemType.value = 'hotel';
        modalItemPrice.value = room.price;
        modalItemId.value = room.id;
        priceInfo.style.display = 'block';
        priceInfo.textContent = 'Room rate: NPR ' + room.price + ' / night';

        // hide rooms modal and show booking modal
        roomsModal.hide();
        bookingModal.show();
      }

      // Optional: show a gallery (simple new window or modal). For brevity open images in new tab.
      function viewRoomGallery(hotelId, roomId) {
        const hotel = hotelsData[hotelId];
        const room = hotel.rooms.find(r => r.id === roomId);
        if (!room) return;
        // If you have multiple images, you could implement a carousel here.
        window.open(room.img, '_blank');
      }

      // Reusable booking modal opener for non-room items (tours/hotels)
      function openBookingModal(btn) {
        const type = btn.getAttribute('data-type') || 'service';
        const title = btn.getAttribute('data-title') || '';
        const price = btn.getAttribute('data-price') || '0';
        modalItemTitle.textContent = title;
        modalItemType.value = type;
        modalItemPrice.value = price;
        modalItemId.value = '';
        priceInfo.style.display = 'block';
        priceInfo.textContent = (type === 'hotel' || type === 'homestay') ? ('Base price: NPR ' + price + ' / night') : ('Price per person: NPR ' + price);
        bookingModal.show();
      }

      // Booking form submit (demo)
      bookingForm.addEventListener('submit', function(e){
        e.preventDefault();
        const data = new FormData(bookingForm);
        const name = data.get('name') || 'Guest';
        const item = modalItemTitle.textContent;
        bookingModal.hide();
        setTimeout(()=> {
          alert('Thank you, ' + name + '! Your booking request for "' + item + '" has been received. We will contact you soon.');
        }, 200);
        bookingForm.reset();
        priceInfo.style.display = 'none';
      });

      // Simple hotel search
      document.getElementById('hotelSearch').addEventListener('input', function(){
        const q = this.value.toLowerCase();
        document.querySelectorAll('#hotelsGrid .card-elevated').forEach(card => {
          const title = card.querySelector('.card-title').textContent.toLowerCase();
          card.style.display = title.includes(q) || q === '' ? '' : 'none';
        });
      });

      // Wire search icon (if you have the overlay)
      const searchIcon = document.getElementById('searchIcon');
      const overlay = document.getElementById('searchOverlay');
      const closeBtn = document.getElementById('closeBtn');
      if (searchIcon && overlay && closeBtn) {
        searchIcon.addEventListener('click', ()=> overlay.style.display = 'block');
        closeBtn.addEventListener('click', ()=> overlay.style.display = 'none');
      }
    </script>
  </body>
</html>
