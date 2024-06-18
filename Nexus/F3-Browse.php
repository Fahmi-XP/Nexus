<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nexus</title>
    <link rel="icon" type="image/png" href="/Nexus/Assets/Logo/L1-PlaySafe.png">
    <link rel="stylesheet" href="Script/CSS/FrontEnd/C3-Browse.css">
    <script src="Script/JAVASCRIPT/C1-Front.js"></script>
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
            <a href="#" class="nav-link">Browse</a>
            <a href="F4-Hub.php" class="nav-link">Hub</a>
            <?php if(isset($_SESSION['user_id'])): ?>
                <div class="profile-container">
                    <a href="javascript:void(0);" onclick="toggleProfilePopup()" class="nav-link profile"><?php echo htmlspecialchars($_SESSION['user_name']); ?></a>
                    <div id="profile-popup" class="profile-popup">
                        <a href="Z4-Profile.php">Edit Profile</a>
                        <a href="Z5-Settings.php">Settings</a>
                        <?php if($_SESSION['user_role'] == 'admin'): ?>
                            <a href="X1-Database.php">Admin Menu</a>
                        <?php endif; ?>
                        <form action="../Nexus/Data/D4-LogOut.php" method="post">
                            <button type="submit">Logout</button>
                        </form>
                    </div>
                </div>
            <?php else: ?>
                <a href="Z1-Login.php" class="nav-link login">Log In</a>
            <?php endif; ?>
        </nav>
    </header>
    <script>
        function toggleProfilePopup() {
            var popup = document.getElementById("profile-popup");
            popup.style.display = (popup.style.display === "block") ? "none" : "block";
        }

        window.onclick = function(event) {
            if (!event.target.matches('.profile')) {
                var popups = document.getElementsByClassName("profile-popup");
                for (var i = 0; i < popups.length; i++) {
                    var openPopup = popups[i];
                    if (openPopup.style.display === "block") {
                        openPopup.style.display = "none";
                    }
                }
            }
        }
    </script>
    <div class="container-browse">
        <div class="header">
            <h2 class="title">Browse Game</h2>
            <button class="btn2">Read More</button>
        </div>
        <div class="search-bar">
            <input type="text" placeholder="Search..." class="search-input" id="searchInput"/>
            <button class="search-button" onclick="performSearch()">
                <svg class="search-icon" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M12.9 14.32a8 8 0 111.414-1.414l4.387 4.387a1 1 0 01-1.414 1.414l-4.387-4.387zM14 8a6 6 0 11-12 0 6 6 0 0112 0z" clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>
    </div>
    <section class="site-list" id="siteList">
        <?php
            include 'Data/D1-Game.php';

            $search = isset($_GET['search']) ? $_GET['search'] : '';

            $sql = "SELECT id, photo, name, device, date, developer, gendre, link FROM game";
            if (!empty($search)) {
                $sql .= " WHERE name LIKE '%" . $conn->real_escape_string($search) . "%'";
            }
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="site-item">';
                    echo '<img src="' . $row["photo"] . '" alt="' . $row["name"] . ' Logo" class="site-logo">';
                    echo '<div class="site-info">';
                    echo '<h2>' . $row["name"] . '</h2>';
                    echo '<p>' . $row["developer"] . '</p>';
                    echo '<div class="platform-icons">';
                    
                    $devices = explode(', ', $row["device"]);
                    if (in_array('Windows', $devices)) {
                        echo '<img src="/Nexus/Assets/Logo/L4-Windows.png" alt="Windows">';
                    }
                    if (in_array('Mac', $devices)) {
                        echo '<img src="/Nexus/Assets/Logo/L5-Apple.png" alt="Apple">';
                    }
                    if (in_array('Linux', $devices)) {
                        echo '<img src="/Nexus/Assets/Logo/L6-Linux.png" alt="Linux">';
                    }
                    echo '</div>';
                    echo '</div>';
                    echo '<div class="site-actions">';
                    echo '<span class="gendre">' . $row["gendre"] . '</span>';
                    echo '<a href="' . $row["link"] . '" class="visit-website">Download</a>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo '<p>No data available</p>';
            }
            $conn->close();
        ?>
    </section>
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

    <script>
        function performSearch() {
            const query = document.getElementById('searchInput').value;
            window.location.href = `?search=${query}`;
        }
    </script>
    <script src="Script/JAVASCRIPT/C3-Fotter.js"></script>
</body>
</html>
