<?php
session_start();
include '../backend/connect.php';
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pokhara Tourism Portal | Experience Nepal's Paradise</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="homee.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    />
    <style>
      /* Your existing CSS remains unchanged */
      #carouselExampleAutoplaying {
        margin-bottom: 20px;
        width: 95%;
        margin-left: auto;
        margin-right: auto;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        overflow: visible; /* Ensure shadows are visible */
        background-color: #f8f9fa;
        border-radius: 1px;
      }
      .carousel-item img {
        width: 50%;
        height: 350px;
        object-fit: cover;
        display: block;
        margin: 0 auto;
      }
      .carousel-item img {
        max-height: 400px;
      }
      .carousel-item {
        position: relative;
      }
      .custom-caption {
        position: absolute;
        top: 15%;
        left: 40%;
        transform: translateX(-35%);
        text-align: center;
        color: white;
        text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.7);
      }
      h1 {
        font-family: "Times New Roman", Gadget, sans-serif;
        font-size: 40px;
        margin-bottom: 15px;
      }
      pre {
        font-family: "Times New Roman", Times, serif;
        font-size: 14px;
        line-height: 1.5;
        margin-top: 15px;
      }
      .guide-box {
        position: absolute; /* space between items */
        background: white;
        padding: 8px 10px;
        bottom: -50px;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        width: 100%; /* adjust width as needed */
        height: 100px; /* adjust height as needed */
        max-width: 60%; /* limit max width */
        left: 37%;
        transform: translateX(-30%);
        display: flex;
        justify-content: space-around; /* space out icons evenly */
        flex-wrap: wrap; /* allow wrapping on smaller screens */
      }
      .icon {
        display: flex;
        flex-direction: column;
        align-items: center; /* center icon + text */
        text-align: center;
        cursor: pointer;
        width: 60px; /* adjust width as needed */
        margin: 0 5px; /* space between icons */
        padding: 5px;
        transition:
          background-color 0.3s,
          transform 0.3s;
        text-decoration: none !important;
        border: none;
        background: transparent;
      }
      .icon svg {
        display: flex;
        margin-bottom: 8px;
      }
      .icon p {
        margin: 0;
        font-size: 14px;
        color: #023e8a;
        font-weight: 500;
        text-decoration: none;
      }
      .icon:hover {
        background-color: #f0f0f0;
        transform: translateY(-5px);
        text-decoration: none;
      }
      section h2 {
        text-align: center;
        margin: 30px 0 10px 0;
        font-family: Times, serif;
        color: #023e8a;
        font-weight: bolder;
      }
      section p {
        text-align: center;
        font-family: Arial, Helvetica, sans-serif;
        color: #555;
        font-size: 16px;
      }
      /* Container for cards */
      /* Card Container */
      .card-container {
      display: flex;
      flex-wrap: wrap;
      gap: 20px; /* space between cards */
      justify-content: center;
      margin: 20px;
   }

/* Individual Card */
.card {
    display: flex;
    flex-direction: column;
    justify-content: flex-start; /* keeps content at top */
    align-items: center;
    width: 220px;
    height: 380px; /* fixed height */
    background: #fff;
    border: 2px solid #023e8a;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.card-body {
    display: flex;
    flex-direction: column;
    justify-content: space-between; /* distributes content evenly */
    flex-grow: 1;
    width: 100%;
    padding: 10px;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.2);
}

/* Card Image */
.card img {
    width: 90%;      /* slightly bigger width */
    height: 250px;   /* taller image */
    padding: 10px 5px;
    object-fit: cover;
    border-radius: 12px 12px 0 0;
}

/* Card Title / Name */
.card-text {
    font-size: 1rem;
    font-weight: 600;
    margin-bottom: 5px;
    color: #023e8a;
}

/* Discount */
.discount {
    font-size: 0.85rem;
    color: red;
    margin: 3px 0;
}

/* Price and Button Row */
.price-btn-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: auto; /* pushes row to bottom */
    width: 100%;
}

/* Price */
.price {
    font-weight: bold;
    font-size: 0.85rem;
    color: #023e8a;
}

/* Book Now Button */
.price-btn-row .btn {
    padding: 5px 10px;
    font-size: 0.75rem;
    border-radius: 6px;
    background: #023e8a;
    color: white;
    border: none;
    transition: background 0.3s;
}

.price-btn-row .btn:hover {
    background: #1565c0;
}


      /* Modal Styles */
      .modal-xl {
        max-width: 90%;
      }
      .modal-content {
        border-radius: 15px;
        overflow: hidden;
      }
      .modal-header {
        background: linear-gradient(135deg, #023e8a, #0077b6);
        color: white;
        border-bottom: none;
      }
      .modal-header .btn-close {
        filter: invert(1);
      }
      .modal-body {
        padding: 20px;
        max-height: 80vh;
        overflow-y: auto;
      }

      /* Info Container Styles */
      .info-container {
        font-family: "Poppins", sans-serif;
      }
      .info-header {
        background: linear-gradient(135deg, #023e8a, #0077b6);
        color: white;
        padding: 30px;
        border-radius: 10px;
        margin-bottom: 30px;
        text-align: center;
      }
      .info-tabs {
        display: flex;
        gap: 10px;
        margin-bottom: 20px;
        flex-wrap: wrap;
        justify-content: center;
      }
      .info-tab {
        padding: 10px 20px;
        background: #f8f9fa;
        border: 1px solid #ddd;
        border-radius: 30px;
        cursor: pointer;
        transition: all 0.3s;
        font-weight: 500;
      }
      .info-tab:hover,
      .info-tab.active {
        background: #023e8a;
        color: white;
        border-color: #023e8a;
      }
      .info-card {
        border: 1px solid #ddd;
        border-radius: 10px;
        overflow: hidden;
        margin-bottom: 20px;
        transition: transform 0.3s;
        height: 100%;
      }
      .info-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
      }
      .info-img {
        height: 200px;
        object-fit: cover;
        width: 100%;
      }
      .info-details {
        padding: 20px;
      }
      .info-price {
        color: #e74c3c;
        font-weight: bold;
        font-size: 1.2rem;
        margin: 10px 0;
      }
      .info-features {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin: 15px 0;
      }
      .feature {
        display: flex;
        align-items: center;
        gap: 5px;
        color: #555;
        background: #f8f9fa;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 0.9rem;
      }
      .feature i {
        color: #023e8a;
      }
      .btn-action {
        background: #023e8a;
        color: white;
        border: none;
        padding: 12px 20px;
        border-radius: 5px;
        width: 100%;
        margin-top: 15px;
        transition: background 0.3s;
        font-weight: 600;
      }
      .btn-action:hover {
        background: #022e6d;
      }
      .loading-spinner {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 300px;
        flex-direction: column;
      }

      /* Booking Form Styles */
      .booking-form-container {
        padding: 20px;
        background: #f8f9fa;
        border-radius: 10px;
        margin-top: 20px;
      }
      .booking-form h4 {
        color: #023e8a;
        margin-bottom: 20px;
        border-bottom: 2px solid #023e8a;
        padding-bottom: 10px;
      }
      .form-group {
        margin-bottom: 15px;
      }
      .form-group label {
        font-weight: 600;
        color: #023e8a;
        margin-bottom: 5px;
      }
      .form-group label .required {
        color: #e74c3c;
      }
      .form-control,
      .form-select {
        border: 1px solid #023e8a;
        border-radius: 5px;
        padding: 10px;
      }
      .form-control:focus,
      .form-select:focus {
        border-color: #0077b6;
        box-shadow: 0 0 0 0.2rem rgba(2, 62, 138, 0.25);
      }
      .booking-summary {
        background: white;
        border: 1px solid #ddd;
        border-radius: 10px;
        padding: 15px;
        margin-top: 20px;
      }
      .booking-summary h5 {
        color: #023e8a;
        border-bottom: 1px solid #ddd;
        padding-bottom: 10px;
      }
      .summary-item {
        display: flex;
        justify-content: space-between;
        margin: 10px 0;
      }
      .summary-total {
        font-weight: bold;
        font-size: 1.2rem;
        color: #e74c3c;
        border-top: 2px solid #ddd;
        padding-top: 10px;
      }
      .booking-success {
        text-align: center;
        padding: 40px 20px;
      }
      .booking-success i {
        font-size: 4rem;
        color: #2ecc71;
        margin-bottom: 20px;
      }
      .booking-success h4 {
        color: #023e8a;
      }
      .booking-success p {
        color: #555;
      }
      /* Fix for anchor tags in guide-box */
.guide-box a {
    text-decoration: none !important;
    color: inherit;
    display: flex;
    flex-direction: column;
    align-items: center;
}

/* Ensure links are clickable */
.guide-box a.icon {
    cursor: pointer;
}

/* Remove default button styles from anchor tags */
.guide-box a:focus,
.guide-box a:active {
    outline: none;
    box-shadow: none;
}

/* Make sure hover works */
.guide-box a.icon:hover {
    background-color: #f0f0f0;
    transform: translateY(-5px);
    text-decoration: none;
    border-radius: 5px;
}

/* Ensure text stays blue */
.guide-box a.icon p {
    color: #023e8a;
    margin: 0;
    font-size: 14px;
    font-weight: 500;
    text-decoration: none;
}
    </style>
  </head>
  <body>
  <?php include "nav.php"?>
  <?php
  // Database connection - THIS GOES IN FRONTEND/home.php
  require_once __DIR__ . '/../backend/connect.php';
  
  // Fetch destinations from database - Use 'offers' (with 's') not 'offer'
  $sql = "SELECT * FROM destination WHERE type = 'offers' ORDER BY destination_id";
  $result = $conn->query($sql);
  
  // Create an array to store destination data
  $destinations = [];
  if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
          $destinations[] = $row;
      }
  }
   // Convert to JSON for JavaScript usage
  $destinations_json = json_encode($destinations);
  ?>
  
    <div
      id="carouselExampleAutoplaying"
      class="carousel slide"
      data-bs-ride="carousel"
    >
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="pokara.jpg" class="d-block w-100" alt="pokara" />
          <div class="custom-caption">
            <h1>See It Like a Local, Love It Like a Local</h1>
            <pre>
Looking for more than just landmarks? Join our local guides for authentic, 
        small-group tours that take you beyond the brochure. 
              From hidden gems to unforgettable stories, 
                  we'll show you the real [Pokhara] 
                      —just like a local would.</pre
            >
          </div>
        </div>
        <div class="carousel-item">
          <img src="nice.jpg" class="d-block w-100" alt="nice" />
          <div class="custom-caption">
            <h1>See It Like a Local, Love It Like a Local</h1>
            <pre>
Looking for more than just landmarks? Join our local guides for authentic, 
      small-group tours that take you beyond the brochure. 
      From hidden gems to unforgettable stories, 
      we'll show you the real [Pokhara]
      —just like a local would.</pre
            >
          </div>
        </div>
        <div class="carousel-item">
          <img src="waterfall.jpg" class="d-block w-100" alt="waterfall" />
          <div class="custom-caption">
            <h1>See It Like a Local, Love It Like a Local</h1>
            <pre>
Looking for more than just landmarks? Join our local guides for authentic, 
        small-group tours that take you beyond the brochure. 
              From hidden gems to unforgettable stories, 
                  we'll show you the real [Pokhara] 
                      —just like a local would.</pre
            >
          </div>
        </div>
      </div>
      <button
        class="carousel-control-prev"
        type="button"
        data-bs-target="#carouselExampleAutoplaying"
        data-bs-slide="prev"
      >
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button
        class="carousel-control-next"
        type="button"
        data-bs-target="#carouselExampleAutoplaying"
        data-bs-slide="next"
      >
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
       <div class="guide-box">
    <!-- Villa Icon -->
    <a href="category.php?type=villa" class="icon">
        <svg width="30" height="30" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g clip-path="url(#clip0_79_86)">
                <mask id="mask0_79_86" style="mask-type: luminance" maskUnits="userSpaceOnUse" x="0" y="0" width="50" height="50">
                    <path d="M0 0H50V50H0V0Z" fill="white" />
                </mask>
                <g mask="url(#mask0_79_86)">
                    <path d="M36.1562 32.8157H29.4688C28.7188 32.8157 28.125 32.2219 28.125 31.4719V24.7844C28.125 24.05 28.7188 23.4407 29.4688 23.4407H36.1562C36.8906 23.4407 37.5 24.0344 37.5 24.7844V31.4719C37.5 32.2219 36.9062 32.8157 36.1562 32.8157Z" fill="#023E8A"/>
                    <path d="M28.5626 1.4423L28.5689 1.45011L48.4985 21.0829L48.5032 21.0876C48.9778 21.5495 49.3549 22.1019 49.6122 22.7121C49.8696 23.3223 50.0019 23.9779 50.0015 24.6402C50.0011 25.3024 49.8678 25.9578 49.6097 26.5677C49.3515 27.1775 48.9737 27.7294 48.4985 28.1907C47.6431 29.0353 46.5121 29.5434 45.3126 29.622V39.2329C46.648 39.5525 47.8369 40.3126 48.6873 41.3907C49.5378 42.4688 50.0002 43.802 50.0001 45.1751V48.4407H0.000107263V45.1751C-0.00204102 43.8013 0.459641 42.4669 1.31038 41.3882C2.16112 40.3095 3.3511 39.5495 4.68761 39.2314V29.6845C3.48838 29.6017 2.35807 29.0936 1.50011 28.2517C1.02541 27.7886 0.648117 27.2353 0.390414 26.6243C0.13271 26.0133 -0.000196631 25.3569 -0.000487802 24.6937C-0.000778972 24.0306 0.131551 23.3741 0.388718 22.7628C0.645885 22.1516 1.0227 21.598 1.49698 21.1345L1.50167 21.1314L6.25011 16.4564V5.50324C6.25011 3.2173 8.13761 1.56261 10.2235 1.56261H14.7923C16.5142 1.56261 18.061 2.68761 18.5735 4.32667L21.4876 1.45324C23.4564 -0.503012 26.6126 -0.465512 28.5595 1.44074M15.6251 11.6126V5.50324C15.6218 5.28496 15.5325 5.07682 15.3765 4.92408C15.2206 4.77134 15.0106 4.68635 14.7923 4.68761H10.2235C10.114 4.68492 10.005 4.70398 9.90292 4.74371C9.80081 4.78343 9.70759 4.84302 9.62868 4.91903C9.54976 4.99504 9.48672 5.08595 9.44319 5.1865C9.39966 5.28705 9.37652 5.39524 9.37511 5.5048V17.7642L15.6251 11.6126ZM7.81261 24.6032V42.1907H10.9376C10.9376 41.3314 11.6407 40.6282 12.5001 40.6282V25.6126C12.5001 24.4407 13.4532 23.4876 14.6251 23.4876H22.8907C24.0626 23.4876 25.0157 24.4407 25.0157 25.6126V40.6314C25.8392 40.672 26.5001 41.3579 26.5001 42.1907H42.1876V24.5407L25.0314 7.64543L7.81261 24.6032ZM23.4376 32.0345C23.4376 31.8273 23.3553 31.6286 23.2088 31.4821C23.0623 31.3355 22.8636 31.2532 22.6564 31.2532C22.4492 31.2532 22.2504 31.3355 22.1039 31.4821C21.9574 31.6286 21.8751 31.8273 21.8751 32.0345C21.8751 32.2417 21.9574 32.4404 22.1039 32.5869C22.2504 32.7334 22.4492 32.8157 22.6564 32.8157C22.8636 32.8157 23.0623 32.7334 23.2088 32.5869C23.3553 32.4404 23.4376 32.2417 23.4376 32.0345Z" fill="#023E8A"/>
                </g>
            </g>
            <defs>
                <clipPath id="clip0_79_86">
                    <rect width="50" height="50" fill="white"/>
                </clipPath>
            </defs>
        </svg>
        <p>Villa</p>
    </a>

    <!-- Hotel Icon -->
    <a href="category.php?type=hotel" class="icon">
        <svg width="30" height="30" viewBox="0 0 50 46" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M37.5 40.5H42.5V20.5H27.5V40.5H32.5V25.5H37.5V40.5ZM2.5 40.5V3C2.5 2.33696 2.76339 1.70107 3.23223 1.73223C3.70107 0.763392 4.33696 0.5 5 0.5H40C40.663 0.5 41.2989 0.763392 41.7678 1.23223C42.2366 1.70107 42.5 2.33696 42.5 3V15.5H47.5V40.5H50V45.5H0V40.5H2.5ZM12.5 20.5V25.5H17.5V20.5H12.5ZM12.5 30.5V35.5H17.5V30.5H12.5ZM12.5 10.5V15.5H17.5V10.5H12.5Z" fill="#023E8A"/>
        </svg>
        <p>Hotel</p>
    </a>

    <!-- Apartment Icon -->
    <a href="category.php?type=apartment" class="icon">
        <svg width="30" height="30" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 50V11.1111H11.1111V0H38.8889V22.2222H50V50H27.7778V38.8889H22.2222V50H0ZM5.55556 44.4444H11.1111V38.8889H5.55556V44.4444ZM5.55556 33.3333H11.1111V27.7778H5.55556V33.3333ZM5.55556 22.2222H11.1111V16.6667H5.55556V22.2222ZM16.6667 33.3333H22.2222V27.7778H16.6667V33.3333ZM16.6667 22.2222H22.2222V16.6667H16.6667V22.2222ZM16.6667 11.1111H22.2222V5.55556H16.6667V11.1111ZM27.7778 33.3333H33.3333V27.7778H27.7778V33.3333ZM27.7778 22.2222H33.3333V16.6667H27.7778V22.2222ZM27.7778 11.1111H33.3333V5.55556H27.7778V11.1111ZM38.8889 44.4444H44.4444V38.8889H38.8889V44.4444ZM38.8889 33.3333H44.4444V27.7778H38.8889V33.3333Z" fill="#023E8A"/>
        </svg>
        <p>Apartment</p>
    </a>

    <!-- Guide Icon -->
    <a href="category.php?type=tour" class="icon">
        <svg width="30" height="30" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="25" cy="25" r="20" stroke="#023E8A" stroke-width="2" fill="none"/>
            <path d="M25 15L30 25L25 35L20 25L25 15Z" fill="#023E8A"/>
            <circle cx="25" cy="25" r="5" fill="white"/>
        </svg>
        <p>Guide</p>
    </a>

    <!-- Flight Icon -->
    <a href="category.php?type=flight" class="icon">
        <svg width="30" height="30" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M48.7033 1.27529C50.4322 3.00498 50.4322 5.79009 48.7033 7.49047L37.304 18.8948L43.5165 45.837L39.3846 50L28.0147 28.2175L16.5861 39.6511L17.641 46.8924L14.5055 50L9.34799 40.6772L0 35.4881L3.10623 32.3219L10.4322 33.4066L21.7729 22.061L0 10.5981L4.16117 6.46438L31.0916 12.6796L42.4908 1.27529C44.1319 -0.425095 47.0623 -0.425095 48.7033 1.27529Z" fill="#023E8A"/>
        </svg>
        <p>Flight</p>
    </a>

    <!-- To Do Icon -->
    <a href="category.php?type=activity" class="icon">
        <svg width="30" height="30" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M6.67499 42.4643C6.23241 42.4643 5.80796 42.2874 5.49501 41.9726C5.18206 41.6579 5.00624 41.2309 5.00624 40.7857V7.21429C5.00624 6.7691 5.18206 6.34215 5.49501 6.02736C5.80796 5.71256 6.23241 5.53571 6.67499 5.53571H37.5468C38.2107 5.53571 38.8474 5.27044 39.3168 4.79825C39.7862 4.32606 40.0499 3.68563 40.0499 3.01786C40.0499 2.35008 39.7862 1.70965 39.3168 1.23746C38.8474 0.765274 38.2107 0.5 37.5468 0.5H6.67499C4.90467 0.5 3.20686 1.2074 1.95506 2.46657C0.703256 3.72574 0 5.43355 0 7.21429V40.7857C0 42.5665 0.703256 44.2743 1.95506 45.5334C3.20686 46.7926 4.90467 47.5 6.67499 47.5H40.0499C41.8203 47.5 43.5181 46.7926 44.7699 45.5334C46.0217 44.2743 46.7249 42.5665 46.7249 40.7857V29.875C46.7249 29.2072 46.4612 28.5668 45.9918 28.0946C45.5224 27.6224 44.8857 27.3571 44.2218 27.3571C43.5579 27.3571 42.9213 27.6224 42.4518 28.0946C41.9824 28.5668 41.7187 29.2072 41.7187 29.875V40.7857C41.7187 41.2309 41.5429 41.6579 41.2299 41.9726C40.917 42.2874 40.4925 42.4643 40.0499 42.4643H6.67499ZM49.3282 12.8543C49.7703 12.377 50.0111 11.7457 49.9996 11.0934C49.9882 10.4411 49.7255 9.81873 49.2668 9.35741C48.8082 8.8961 48.1895 8.63185 47.541 8.62034C46.8926 8.60883 46.2649 8.85096 45.7904 9.29571L27.2406 27.9514L20.9895 21.4519C20.7614 21.2122 20.4885 21.0202 20.1864 20.8869C19.8843 20.7537 19.559 20.6818 19.2292 20.6754C18.8994 20.669 18.5716 20.7283 18.2647 20.8498C17.9577 20.9712 17.6776 21.1526 17.4406 21.3833C17.2035 21.614 17.0141 21.8896 16.8833 22.1942C16.7525 22.4988 16.6828 22.8264 16.6782 23.1581C16.6737 23.4899 16.7344 23.8193 16.8568 24.1274C16.9793 24.4355 17.161 24.7162 17.3917 24.9534L25.4117 33.2926C25.6425 33.5333 25.9186 33.7254 26.2239 33.8576C26.5293 33.9898 26.8578 34.0596 27.1903 34.0627C27.5227 34.0658 27.8524 34.0023 28.1602 33.8758C28.468 33.7494 28.7476 33.5625 28.9828 33.3261L49.3282 12.8543Z" fill="#023E8A"/>
        </svg>
        <p>To Do</p>
    </a>

    <!-- Offers Icon -->
    <a href="category.php?type=offers" class="icon">
        <svg width="30" height="30" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M48.7033 1.27529C50.4322 3.00498 50.4322 5.79009 48.7033 7.49047L37.304 18.8948L43.5165 45.837L39.3846 50L28.0147 28.2175L16.5861 39.6511L17.641 46.8924L14.5055 50L9.34799 40.6772L0 35.4881L3.10623 32.3219L10.4322 33.4066L21.7729 22.061L0 10.5981L4.16117 6.46438L31.0916 12.6796L42.4908 1.27529C44.1319 -0.425095 47.0623 -0.425095 48.7033 1.27529Z" fill="#023E8A"/>
        </svg>
        <p>Offers</p>
    </a>

    <!-- More Icon -->
    <a href="category.php?type=activity" class="icon">
        <svg width="30" height="30" viewBox="0 0 52 52" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M18.5 1H3.5C2.83696 1 2.20107 1.26339 1.73223 1.73223C1.26339 2.20107 1 2.83696 1 3.5V18.5C1 19.163 1.26339 19.7989 1.73223 20.2678C2.20107 20.7366 2.83696 21 3.5 21H18.5C19.163 21 19.7989 20.7366 20.2678 20.2678C20.7366 19.7989 21 19.163 21 18.5V3.5C21 2.83696 20.7366 2.20107 20.2678 1.73223C19.7989 1.26339 19.163 1 18.5 1ZM18.5 31H3.5C2.83696 31 2.20107 31.2634 1.73223 31.7322C1.26339 32.2011 1 32.837 1 33.5V48.5C1 49.163 1.26339 49.7989 1.73223 50.2678C2.20107 50.7366 2.83696 51 3.5 51H18.5C19.163 51 19.7989 50.7366 20.2678 50.2678C20.7366 49.7989 21 49.163 21 48.5V33.5C21 32.837 20.7366 32.2011 20.2678 31.7322C19.7989 31.2634 19.163 31 18.5 31ZM48.5 1H33.5C32.837 1 32.2011 1.26339 31.7322 1.73223C31.2634 2.20107 31 2.83696 31 3.5V18.5C31 19.163 31.2634 19.7989 31.7322 20.2678C32.2011 20.7366 32.837 21 33.5 21H48.5C49.163 21 49.7989 20.7366 50.2678 20.2678C50.7366 19.7989 51 19.163 51 18.5V3.5C51 2.83696 50.7366 2.20107 50.2678 1.73223C49.7989 1.26339 49.163 1 48.5 1Z" fill="#023E8A" stroke="#023E8A" stroke-width="2" stroke-linejoin="round"/>
            <path d="M31 31H51M41 41H51M31 51H51" stroke="#023E8A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        <p>More</p>
    </a>
</div>
    </div>

    <!-- Main Content Sections -->
    <section class="my-5">
      <div class="py-3">
        <h2 class="text-center">Popular Offers</h2>
        <p>
          Tried, tested, and loved by travelers — these tours offer the best of
          Pokhara in fun, flexible packages. Start from here if you're not sure
          what to pick!
        </p>
      </div> 
      
      <!-- REMOVED DUPLICATE CONTAINER -->
      <div class="card-container" id="dynamic-cards">
        <?php
        // Display ONLY offer type cards dynamically from database
        if (!empty($destinations)) {
            foreach ($destinations as $destination) {
                // Calculate discount percentage
                $discount_percent = 0;
                if ($destination['price'] > 0 && $destination['discount_price'] > 0) {
                    $discount_percent = round((($destination['price'] - $destination['discount_price']) / $destination['price']) * 100);
                }
                
                // FIX: Add correct path to images
                // Database stores only filename, need to add uploads folder path
                $image_path = '../uploads/' . htmlspecialchars($destination['image']);
                ?>
                <div class="card" style="width: 13rem">
                  <!-- FIXED: Added correct image path -->
                  <img src="<?php echo $image_path; ?>" 
                       class="card-img-top" 
                       alt="<?php echo htmlspecialchars($destination['name']); ?>"
                       onerror="this.onerror=null; this.src='default.jpg';">
                  
                  <div class="card-body">
                    <p class="card-text"><?php echo htmlspecialchars($destination['name']); ?></p>
                    <?php if ($discount_percent > 0): ?>
                      <p class="discount">-<?php echo $discount_percent; ?>% OFF!</p>
                    <?php endif; ?>
                    <p class="price">
                      $<?php echo number_format($destination['discount_price'], 2); ?>
                      <?php if ($destination['price'] > $destination['discount_price']): ?>
                        (<del>$<?php echo number_format($destination['price'], 2); ?></del>)
                      <?php endif; ?>
                    </p>
                    <a
                      href="booking.php?destination_id=<?php echo $destination['destination_id']; ?>"
                      class="btn btn-primary"
                      >
                      BOOK NOW
                    </a>
                  </div>
                </div>
                <?php
            }
        } else {
            // Message if no offers available
            ?>
            <div class="alert alert-info w-100 text-center">
              <h4>No special offers available at the moment.</h4>
              <p>Check back soon for exciting discounts and deals!</p>
              <p><small>Debug: No destinations found with type = 'offers'</small></p>
            </div>
            <?php
            // Add debug to check what's in database
            $debug_sql = "SELECT destination_id, name, type FROM destination LIMIT 5";
            $debug_result = $conn->query($debug_sql);
            if ($debug_result && $debug_result->num_rows > 0) {
                echo "<div class='alert alert-warning w-100 text-center'>";
                echo "<h5>Available destinations (first 5):</h5>";
                while($debug_row = $debug_result->fetch_assoc()) {
                    echo "ID: " . $debug_row['destination_id'] . " - " . 
                         htmlspecialchars($debug_row['name']) . " - Type: " . 
                         ($debug_row['type'] ?: 'none') . "<br>";
                }
                echo "</div>";
            }
        }
        ?>
      </div>
    </section>

    <!-- Information Modal (for all icons) -->
    <div
      class="modal fade"
      id="infoModal"
      tabindex="-1"
      aria-labelledby="infoModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-xl">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="infoModalLabel">
              Loading Information...
            </h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">
            <div id="modal-info-content">
              <div class="loading-spinner">
                <h4>Loading information...</h4>
                <div class="spinner-border text-primary" role="status">
                  <span class="visually-hidden">Loading...</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>



    <!-- footer -->
    <?php include 'footer.php'; ?>
    
    <!-- JavaScript for dynamic functionality -->
    <script>
      // Pass PHP data to JavaScript
      const destinationsData = <?php echo $destinations_json; ?>;
      
      // Function to generate cards dynamically (if needed for AJAX)
      function generateCards() {
        const container = document.getElementById('dynamic-cards');
        if (!container || destinationsData.length === 0) return;
        
        let cardsHTML = '';
        destinationsData.forEach(destination => {
          const discountPercent = destination.price > 0 && destination.discount_price > 0 
            ? Math.round(((destination.price - destination.discount_price) / destination.price) * 100)
            : 0;
          
          // FIX: Add correct image path in JavaScript too
          const imagePath = '../uploads/' + destination.image;
          
          cardsHTML += `
            <div class="card" style="width: 13rem">
              <img src="${imagePath}" class="card-img-top" alt="${destination.name}" 
                   onerror="this.onerror=null; this.src='default.jpg';" />
              <div class="card-body">
                <p class="card-text">${destination.name}</p>
                ${discountPercent > 0 ? `<p class="discount">-${discountPercent}% OFF!</p>` : ''}
                <p class="price">
                  $${destination.discount_price.toFixed(2)}
                  ${destination.price > destination.discount_price ? `(<del>$${destination.price.toFixed(2)}</del>)` : ''}
                </p>
                <a href="booking.php?destination_id=${destination.destination_id}" class="btn btn-primary">
                  BOOK NOW
                </a>
              </div>
            </div>
          `;
        });
        
        container.innerHTML = cardsHTML;
      }
      
      // Initialize cards when page loads
      document.addEventListener('DOMContentLoaded', function() {
        generateCards();
      });
      <!-- In your home.php, add this script for debugging icons -->
document.addEventListener('DOMContentLoaded', function() {
    // Debug: Check all icon links
    const icons = document.querySelectorAll('.guide-box a.icon');
    console.log('Total icons found:', icons.length);
    
    icons.forEach(icon => {
        icon.addEventListener('click', function(e) {
            console.log('Icon clicked:', this.href);
            console.log('Icon text:', this.querySelector('p').textContent);
        });
        
        // Add visual feedback
        icon.addEventListener('mouseenter', function() {
            this.style.backgroundColor = '#e9f7fe';
        });
        icon.addEventListener('mouseleave', function() {
            this.style.backgroundColor = 'transparent';
        });
    });
});

    </script>
  </body>
</html>