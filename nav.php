<?php
// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Initialize variables
$isLoggedIn = false;
$userName   = '';
$userPhoto  = '';
$userRole   = '';
$userId     = null;

if (isset($_SESSION['email'])) {
    $isLoggedIn = true;
    $userRole   = $_SESSION['role'] ?? '';

    if ($userRole === 'user' && isset($_SESSION['user_id'])) {
        $userId = $_SESSION['user_id'];
    } elseif ($userRole === 'guider' && isset($_SESSION['guider_id'])) {
        $userId = $_SESSION['guider_id'];
    } elseif ($userRole === 'admin') {
        $userId = 0;
    }

    if ($userRole === 'admin' && isset($_SESSION['name'])) {
        $userName = htmlspecialchars($_SESSION['name']);
    } elseif (isset($_SESSION['first_name'])) {
        $userName = htmlspecialchars($_SESSION['first_name']);
        if (isset($_SESSION['last_name'])) {
            $userName .= ' ' . htmlspecialchars($_SESSION['last_name']);
        }
    } else {
        $userName = htmlspecialchars($_SESSION['email']);
    }

    $avatarName = urlencode($userName);
    $userPhoto  = "https://ui-avatars.com/api/?name=$avatarName&background=3498db&color=fff&size=32";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pokhara Tours — Navbar</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="homee.css">
    <style>
        
        .profile-dropdown { position: relative; display: inline-block; }
        .profile-btn { background: none; border: none; padding: 0; cursor: pointer; }

        .dropdown-menu {
           position: absolute;
          right: 0;
          top: 45px;
          min-width: 180px;
         background: #fff;
         border: 1px solid #ddd;
         border-radius: 8px;
         box-shadow: 0 6px 18px rgba(0,0,0,0.12);
         padding: 8px 0;
         display: none;
         z-index: 9999;
        }

        .dropdown-menu a {
         display: block;
         padding: 10px 14px;
         color: #222;
         text-decoration: none;
         font-size: 14px;
        }

        .dropdown-menu a:hover { background: #f3f3f3; }

        .dropdown-menu hr { margin: 6px 0; border: none; border-top: 1px solid #eee; }
    </style>
</head>
<body>

<header>
<nav class="main-nav">
    <div class="nav-inner">
        <!-- Logo -->
        <a href="home.php" class="logo"><img src="logo.jpeg" alt="logo"></a>

        <!-- Navigation Links -->
        <ul class="nav-links">
            <li><a href="home.php">HOME</a></li>
            <li><a href="aboutus.php">ABOUT</a></li>
            <li><a href="tour.php">TOUR</a></li>
            <li><a href="destination.php">DESTINATIONS</a></li>
            <li><a href="contact.php">CONTACT US</a></li>
        </ul>

        <!-- Right Side: Profile or Login/Sign up -->
        <div class="nav-actions">
            <?php if ($isLoggedIn): ?>
    <div class="profile-dropdown">
        <button type="button" class="profile-btn" id="profileBtn">
            <img src="<?php echo $userPhoto; ?>"
                 style="width:32px;height:32px;border-radius:50%;"
                 onerror="this.src='https://ui-avatars.com/api/?name=U&background=3498db&color=fff&size=32'">
        </button>

        <div class="dropdown-menu" id="profileMenu">
            <?php if ($userRole === 'user'): ?>
                <a href="history.php">Booking History</a>
                <a href="../frontend/password.php">Change Password</a>
            <?php endif; ?>

            <hr>
            <a href="../backend/logout.php" style="color:red;">Logout</a>
        </div>
    </div>
   <?php else: ?>
    <a class="signup" href="signup.php">Sign Up</a>
    <a class="signup" href="login.php">Log in</a>
   <?php endif; ?>

        </div>
    </div>
</nav>
</header>

<script>

const profileBtn = document.getElementById('profileBtn');
const profileMenu = document.getElementById('profileMenu');

profileBtn.addEventListener('click', function (e) {
    e.stopPropagation();
    profileMenu.style.display = (profileMenu.style.display === 'block') ? 'none' : 'block';
});

document.addEventListener('click', function () {
    profileMenu.style.display = 'none';
});

</script>

</body>
</html>
