<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nexus</title>
    <link rel="icon" type="image/png" href="/Nexus/Assets/Logo/L1-PlaySafe.png">
    <link rel="stylesheet" href="Script/CSS/FrontEnd/C5-Login.css">
    
</head>
<body>
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
            <a href="#" class="nav-link login">Log In</a>
        </nav>
    </header>
    <body class="bg-dark">
    <div class="login-container">
        <div class="login-box">
            <div class="login-header">
                <h2>Login</h2>
            <a href="F1-Home.php" class="close-button">×</a>
            </div>
            <form action="Data/D2-LogIn.php" method="POST">
                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required />
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required />
                    <button type="button" id="toggle-password" class="toggle-password">Show</button>
                </div>
                <button type="submit" class="submit-button">Login</button>
            </form>
            <div class="signup-link">
                <p><span class="bold-text">Don't have an account?</span> <a href="Z2-SignUp.php">Sign Up Now</a></p>
            </div>
            <div class="navigation-buttons">
                <a href="F1-Home.php" class="button-left"><button>&lt;</button></a>
                <a href="Z2-SignUp.php" class="button-right"><button>&gt;</button></a>
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
</body>
<script src="Script/JAVASCRIPT/C2-Back.js"></script>
<script src="Script/JAVASCRIPT/C3-Fotter.js"></script>
</html>
