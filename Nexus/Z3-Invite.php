<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nexus</title>
    <link rel="icon" type="image/png" href="/Nexus/Assets/Logo/L1-PlaySafe.png">
    <link rel="stylesheet" href="Script/CSS/FrontEnd/C9-Invite.css">
    <script src="Script/JAVASCRIPT/C1-Front.js"></script>
</head>
<header>
        <div class="header-left">
            <img src="/Nexus/Assets/Logo/L1-PlaySafe.png" alt="Logo" class="logo">
            <img src="/Nexus/Assets/Text/T2-Nexus.png" alt="Nexus Logo" class="nexus">
        </div>
        <nav class="header-right">
            <a href="F1-Home.php" class="nav-link">Home</a>
            <a href="F2-Discover.php" class="nav-link">Discover</a>
            <a href="F3-Browse.php" class="nav-link">Browse</a>
            <a href="F4-Hub.php" class="nav-link">Hub</a>
            <a href="X1-Database.php" class="nav-link login">Log In</a>
        </nav>
    </header>
<body class="bg-dark">
    <div class="warning-container">
        <div class="ln-box">
            <div class="login-header">
                <h2>Warning</h2>
                <a href="Z2-SignUp.php" class="close-button">×</a>
            </div>
            <div class="message">
                <?php
                if (isset($_GET['error'])) {
                    $error = $_GET['error'];
                    if ($error == 'email') {
                        echo "<p>Email is wrong. Please try again.</p>";
                    } elseif ($error == 'password') {
                        echo "<p>Password is wrong. Please try again.</p>";
                    } elseif ($error == 'both') {
                        echo "<p>Email and Password are wrong. Please try again.</p>";
                    } elseif ($error == 'invite_code') {
                        echo "<p>Invite code is required for admin registration.</p>";
                    } elseif ($error == 'invalid_code') {
                        echo "<p>Invalid or used invite code.</p>";
                    }
                }
                ?>
            </div>
            <button type="button" class="submit-button" onclick="location.href='Z2-SignUp.php';">Back</button>
            <div class="navigation-buttons">
                <a href="Z2-SignUp.php" class="button-left"><button>&lt;</button></a>
                <a href="Z1-Login.php" class="button-right"><button>&gt;</button></a>
            </div>
        </div>
    </div>
</body>
    <div class="footer">
    <div class="footer-container">
        <div class="footer-left">
            <div class="logo-text-container">
                <img src="/Nexus/Assets/Logo/L1-PlaySafe.png" alt="Playsafe Logo" class="logo" />
                <div class="text-container">
                    <img src="/Nexus/Assets/Text/T2-Nexus.png" alt="Playsafe Text" class="text" />
                    <p class="text-sm">&copy; Nexus.com LTD</p>
                </div>
            </div>
        </div>
        <div class="footer-right">
            <p class="text-sm">Powered By</p>
            <img src="/Nexus/Assets/Text/T1-PlaySafe.png" alt="Nexus Text" class="logo" />
            <div class="social-icons">
                <a href="https://web.facebook.com/" class="text-white">
                    <img src="/Nexus/Assets/Icon/Facebook.png" alt="Facebook Icon" />
                </a>
                <a href="https://x.com/" class="text-white">
                    <img src="/Nexus/Assets/Icon/X.png" alt="Twitter Icon" />
                </a>
                <a href="https://www.instagram.com/" class="text-white">
                    <img src="/Nexus/Assets/Icon/Instagram.png" alt="Instagram Icon" />
                </a>
                <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" class="text-white">
                    <img src="/Nexus/Assets/Icon/Youtube.png" alt="YouTube Icon" />
                </a>
            </div>
        </div>
    </div>
</div>

    <div class="footer2">
        <div class="footer2-container">
            <p class="text-xs">&copy; 2024 Nexus. All rights reserved.</p>
            <div class="footer2-links">
                <a href="A1-AboutUs.php" class="text-white text-xs">About Us</a>
                <a href="A2-Contact.php" class="text-white text-xs">Contact Us</a>
                <button class="scroll-to-top">
                    <img src="/Nexus/Assets/Icon/Up.png" alt="Scroll to top" class="scroll-to-top-img" />
                </button>
            </div>
        </div>
    </div>
    <script src="Script/JAVASCRIPT/C3-Fotter.js"></script>
</body>
</html>
