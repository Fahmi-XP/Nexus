<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nexus</title>
    <link rel="icon" type="image/png" href="/Nexus/Assets/Logo/L1-PlaySafe.png">
    <link rel="stylesheet" href="Script/CSS/FrontEnd/C6-SignUp.css">
    <script src="https://cdn.tailwindcss.com"></script>
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
            <a href="Z1-Login.php" class="nav-link login">Log In</a>
        </nav>
    </header>
    <body>
    <div class="container1">
        <div class="card">
        <div class="header">
        <h2>Sign Up</h2>
            <a href="Z1-Login.php" class="close-btn">×</a>
                </div>
            <form action="Data/D3-SignUp.php" method="POST">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" class="input-field" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" class="input-field" required>
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required />
                    <button type="button" id="toggle-password" class="toggle-password">Show</button>
                </div>
                <div class="form-group">
                    <label for="region">Region</label>
                        <select id="region" name="region" class="input-field" required>
                            <option value="">Select a region</option>
                            <option value="australia" data-flag="australia">Australia</option>
                            <option value="brazil" data-flag="brazil">Brazil</option>
                            <option value="canada" data-flag="canada">Canada</option>
                            <option value="china" data-flag="china">China</option>
                            <option value="france" data-flag="france">France</option>
                            <option value="germany" data-flag="germany">Germany</option>
                            <option value="india" data-flag="india">India</option>
                            <option value="indonesia" data-flag="indonesia">Indonesia</option>
                            <option value="italy" data-flag="italy">Italy</option>
                            <option value="japan" data-flag="japan">Japan</option>
                            <option value="mexico" data-flag="mexico">Mexico</option>
                            <option value="russia" data-flag="russia">Russia</option>
                            <option value="south-africa" data-flag="south-africa">South Africa</option>
                            <option value="united-kingdom" data-flag="united-kingdom">United Kingdom</option>
                            <option value="united-states" data-flag="united-states">United States</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="role">Role</label>
                    <select id="role" name="role" class="input-field">
                        <option value="" selected>Select role</option>
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="invite_code">Invite Code (only for admin)</label>
                    <input type="text" id="invite_code" name="invite_code" class="input-field">
                </div>
                <button type="submit" class="submit-btn">Sign Up</button>
            </form>
            <div class="signup-link">
                <p><span class="bold-text">Do You have an account?</span> <a href="Z1-Login.php">Login Now</a></p>
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
