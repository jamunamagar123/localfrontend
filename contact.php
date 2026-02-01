<?php
session_start();
$config = include '../backend/config.php'; // load dynamic content
$contact = $config['contact'];
$page    = $config['page'];
$footer  = $config['footer'];
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title><?php echo $page['title']; ?></title>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
:root{--accent:#0078b5;--card:#dcdcdc;--max-w:1100px;}
*{box-sizing:border-box}
body{font-family:'Inter',system-ui,-apple-system,"Segoe UI",Roboto,"Helvetica Neue",Arial;margin:0;color:#111;background:#fff;display:flex;flex-direction:column;min-height:100vh;}
.wrap{max-width:var(--max-w);margin:40px auto;padding:0 20px;flex:1;}
.contact-grid{display:grid;grid-template-columns:1fr 1fr;gap:30px;align-items:center;}
.contact-image img{width:100%;height:100%;object-fit:cover;border-radius:4px;box-shadow:0 8px 20px rgba(0,0,0,0.08);min-height:360px;}
.contact-side{padding:10px 20px;}
.contact-title{font-family:'Playfair Display',serif;font-size:46px;letter-spacing:1px;margin:0 0 18px 0;text-align:left;}
.contact-card{background:var(--card);padding:40px;box-shadow:0 6px 20px rgba(0,0,0,0.06);max-width:700px;margin-left:-36px;border-radius:8px;transform: translateX(-15%);}
.contact-list{list-style:none;padding:0;margin:0;}
.contact-list li{display:flex;gap:16px;align-items:center;padding:12px 0;border-bottom:1px solid rgba(0,0,0,0.04);}
.contact-list li:last-child{border-bottom:none;}
.icon{font-size:45px;border-radius:8px;display:flex;align-items:center;justify-content:center;color:#023E8A;}
.icon.small{background:transparent;color:#023E8A;font-size:45px;min-width:40px;border-radius:50%;}
.contact-text{font-size:15px;line-height:1.15;color:#111;}
.social-row{margin:25px 0;display:flex;gap:40px;align-items:center;justify-content:flex-start;}
.social-row a{text-decoration:none;font-weight:600;display:inline-flex;align-items:center;gap:8px;font-size:18px;}
.social-google{color:#ea4335;}
.social-facebook{color:#1877f2;}
footer{background-color:#023E8A;padding:40px 20px 20px;margin-top:60px;}
.footer-content{max-width:var(--max-w);margin:0 auto;display:grid;grid-template-columns:2fr 1fr 1fr;gap:40px;}
.footer-section h3{font-family:'Playfair Display',serif;font-size:24px;margin:0 0 10px 0;color:white;}
.footer-section p{font-size:20px;line-height:1.5;color:white;margin:0 0 20px 0;}
.footer-links{list-style:none;padding:0;margin:0;}
.footer-links li{margin-bottom:8px;}
.footer-links a{text-decoration:none;color:white;font-size:14px;transition:color .3s;}
.footer-links a:hover{color:var(--accent);}
.footer-contact p{margin-bottom:8px;font-size:14px;color:white;}
.footer-bottom{max-width:var(--max-w);margin:30px auto 0;text-align:center;font-size:14px;color:white;}
@media (max-width:900px){.contact-grid{grid-template-columns:1fr;gap:18px;}.contact-card{margin-left:0;max-width:100%;}.contact-title{font-size:34px;text-align:center;}.contact-side{text-align:center;}.contact-list li{justify-content:center;}.contact-list li .contact-text{text-align:left;}.social-row{justify-content:center;}.footer-content{grid-template-columns:1fr;gap:30px;}}
@media (max-width:480px){.contact-title{font-size:28px;}.icon{min-width:40px;min-height:40px;font-size:16px;}.contact-card{padding:20px;}}
</style>
</head>
<body>

<?php include 'nav.php'; ?>

<div class="wrap">
  <div class="contact-grid">
    <div class="contact-image">
      <img src="<?php echo $page['hero_image']; ?>" alt="Tour Image">
    </div>
    <div class="contact-side">
      <h2 class="contact-title"><?php echo $page['title']; ?></h2>
      <p><?php echo $page['subtitle']; ?></p>

      <div class="contact-card">
        <ul class="contact-list">
          <li>
            <span class="icon"><i class="fas fa-map-marker-alt"></i></span>
            <span class="contact-text"><?php echo $contact['address']; ?></span>
          </li>
          <li>
            <span class="icon"><i class="fas fa-envelope"></i></span>
            <span class="contact-text"><?php echo $contact['email']; ?></span>
          </li>
          <li>
            <span class="icon"><i class="fas fa-phone"></i></span>
            <span class="contact-text"><?php echo $contact['phone']; ?></span>
          </li>
          <li>
            <span class="icon small"><i class="fas fa-ellipsis-h"></i></span>
            <span class="contact-text"><?php echo $contact['website']; ?></span>
          </li>
        </ul>
      </div>

      <div class="social-row">
        <?php foreach ($contact['socials'] as $platform => $url): ?>
            <a class="social-<?php echo $platform; ?>" href="<?php echo $url; ?>" aria-label="<?php echo ucfirst($platform); ?>">
                <i class="fab fa-<?php echo $platform; ?>"></i> <?php echo ucfirst($platform); ?>
            </a>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</div>

<!-- Footer -->
<footer>
  <div class="footer-content">
    <div class="footer-section">
      <h3><?php echo $footer['about']['title']; ?></h3>
      <p><?php echo $footer['about']['text']; ?></p>
    </div>
    <div class="footer-section">
      <h3>Quick Links</h3>
      <ul class="footer-links">
        <?php foreach($footer['links'] as $name => $link): ?>
          <li><a href="<?php echo $link; ?>"><?php echo $name; ?></a></li>
        <?php endforeach; ?>
      </ul>
    </div>
    <div class="footer-section">
      <h3>Contact Us</h3>
      <div class="footer-contact">
        <p><?php echo $footer['contact']['address']; ?></p>
        <p><?php echo $footer['contact']['email']; ?></p>
        <p><?php echo $footer['contact']['phone']; ?></p>
      </div>
    </div>
  </div>
  <div class="footer-bottom">
    <p><?php echo $footer['copyright']; ?></p>
  </div>
</footer>

</body>
</html>
