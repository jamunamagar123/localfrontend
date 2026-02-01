<head>
  <style>
/* footer styles to match your screenshot */
.site-footer{
  width:100%;
  background:#023E8A;    /* deep blue */
  color:#fff;
  font-family: Georgia, 'Times New Roman', Times, serif; /* serif look like screenshot */
  box-sizing:border-box;
  margin-top:40px;
}

.site-footer .footer-inner{
  max-width:1200px;     /* aligns with main content width */
  margin:0 auto;
  padding:48px 4vw 18px;
}

.footer-cols{
  display:flex;
  justify-content:space-between;
  gap:30px;
  align-items:flex-start;
  flex-wrap:wrap;
}

.site-footer .col{
  flex:1;
  min-width:200px;      /* keeps columns responsive */
}

.site-footer h5{
  font-size:22px;
  margin:0 0 18px;
  font-weight:700;
  color:#fff;
}

.site-footer p,
.site-footer .links li{
  color:#f3f7fb;
  line-height:1.9;
  margin:0 0 10px;
  font-size:16px;
}

.site-footer .links{
  list-style:none;
  padding:0;
  margin:0;
}

.site-footer .links a{
  color:#f3f7fb;
  text-decoration:none;
  display:block;
}

.site-footer .footer-bottom{
  text-align:center;
  margin-top:28px;
  padding-top:16px;
  border-top: 1px solid rgba(255,255,255,0.06);
}

.site-footer .footer-bottom small{
  color:#e6eefb;
  font-size:14px;
}

/* Responsive tweaks */
@media (max-width:900px){
  .footer-cols{flex-direction:column; gap:18px;}
  .site-footer .footer-inner{padding:28px 6vw 18px;}
  .site-footer h5{font-size:20px}
}

</style>
</head>
<!-- footer.php -->
<footer class="site-footer pt-4 pb-2 mt-5" style="background-color:#023E8A; color:white;">
  <div class="container text-center text-md-start">
    <div class="row">

      <!-- About -->
      <div class="col-md-4 mb-3">
        <h5 class="fw-bold">Local Tour Guide System</h5>
        <p>Helping travelers explore Nepal with authentic local experiences, guides, and tours.</p>
      </div>

      <!-- Quick Links -->
      <div class="col-md-4 mb-3">
        <h5 class="fw-bold">Quick Links</h5>
        <ul class="list-unstyled">
          <li><a href="home.php" class="text-light text-decoration-none">Home</a></li>
          <li><a href="about us.php" class="text-light text-decoration-none">About Us</a></li>
          <li><a href="tour.php" class="text-light text-decoration-none">Tours</a></li>
          <li><a href="destination.php" class="text-light text-decoration-none">Destination</a></li>
          <li><a href="contact.php" class="text-light text-decoration-none">Contact</a></li>
        </ul>
      </div>

      <!-- Contact -->
      <div class="col-md-4 mb-3">
            <h5 class="fw-bold">Contact Us</h5>
            <p><i class="bi bi-geo-alt-fill"></i> Pokhara, Nepal</p>
            <p><i class="bi bi-envelope-fill"></i> info@localtoursystem.com</p>
            <p><i class="bi bi-telephone-fill"></i> +977 9803020600</p>
          </div>
    </div>
  </div>

  <!-- Bottom -->
  <div class="text-center mt-3">
    <small>© <span id="yr"></span> Local Tour Guide System. All Rights Reserved.</small>
  </div>
</footer>

<script>
  // keep year consistent
  (function(){ var y = new Date().getFullYear(); var el = document.getElementById('yr'); if(el) el.textContent = y; })();
</script>
