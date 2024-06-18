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
    <link rel="stylesheet" href="Script/CSS/FrontEnd/C2-Discover.css">
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
</div>
    <div class="container2">
        <div class="header">
            <h2 class="title">Discover</h2> 
            <button class="btn2">Read More</button> 
        </div>
        <div class="grid">
            <div class="card">
                <img src="/Nexus/Assets/Photo/Gendre/Action.png" alt="Action" class="image" />
                <div class="overlay">
                    <span class="label">Action</span>
                </div>
            </div>
            <div class="card">
                <img src="/Nexus/Assets/Photo/Gendre/RPG.png" alt="RPG" class="image" />
                <div class="overlay">
                    <span class="label">RPG</span>
                </div>
            </div>
            <div class="card">
                <img src="/Nexus/Assets/Photo/Gendre/Anime.png" alt="Anime" class="image" />
                <div class="overlay">
                    <span class="label">Anime</span>
                </div>
            </div>
            <div class="card">
                <img src="/Nexus/Assets/Photo/Gendre/Racing.png" alt="Racing" class="image" />
                <div class="overlay">
                    <span class="label">Racing</span>
                </div>
            </div>
            <div class="card">
                <img src="/Nexus/Assets/Photo/Gendre/FPS.png" alt="FPS" class="image" />
                <div class="overlay">
                    <span class="label">FPS</span>
                </div>
            </div>
        </div>
    </div>
    <div class="container-hotgame">
    <div class="toolbar">
            <div class="view-options">
                <span>View</span>
                <button class="icon-button">
                    <img aria-hidden="true" alt="grid view" src="/Nexus/Assets/Icon/Grid.png" />
                </button>
                <button class="icon-button">
                    <img aria-hidden="true" alt="list view" src="/Nexus/Assets/Icon/List.png" />
                </button>
            </div>
            <div class="sort-options">
                <span>Sort By</span>
                <button class="btn small">Name</button>
                <button class="btn small">Gendre</button>
                <button class="icon-button">
                    <img aria-hidden="true" alt="dropdown" src="/Nexus/Assets/Icon/Sort.png" />
                </button>
            </div>
        </div>
        <section class="site-list">
        <?php
            include 'Data/D1-Game.php';

            $sql = "SELECT id, photo, name, device, date, developer, gendre, link FROM game ";
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
    </div>
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
