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
    <link rel="stylesheet" href="Script/CSS/BackEnd/C2-Read.css">
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

    <main class="container1">
        <div class="title-bar">
            <h1 class="title">DATABASE</h1>
            <div class="button-group">
                <a href="X1-Database.php" class="btn2 primary">FORM</a>
                <a href="#" class="btn2 secondary">CRUD</a>
            </div>
        </div>
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
        <div class="container2">
        <a href="X2-Create.php">
        <button class="add-button">ADD DATA</button>
        </a>
            <div class="table-container">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Photo</th>
                            <th>Name</th>
                            <th>Device</th>
                            <th>Date</th>
                            <th>Developer</th>
                            <th>Gendre</th>
                            <th>Link</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    include 'Data/D1-Game.php';

                    $sql = "SELECT id, photo, name, device, date, developer, gendre, link FROM game";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td><img src='" . $row["photo"] . "' alt='Photo' class='rounded' width='50' height='50'></td>";
                        echo "<td>" . $row["name"] . "</td>";
                        echo "<td>" . $row["device"] . "</td>";
                        echo "<td>" . $row["date"] . "</td>";
                        echo "<td>" . $row["developer"] . "</td>";
                        echo "<td>" . $row["gendre"] . "</td>";
                        echo "<td><a href='" . $row["link"] . "' class='link'>Link</a></td>";
                        echo "<td class='action-buttons'>
                        <a href='X5-Update.php?id=" . $row["id"] . "' class='btn update-button'>UPDATE</a>
                        <a href='X4-Deleted.php?id=" . $row["id"] . "' class='btn delete-button'>DELETE</a>
                        </td>";
                    echo "</tr>";
                    }
                    } else {
                    echo "<tr><td colspan='9'>No data available</td></tr>";
                }
                $conn->close();
                ?>
                </tbody>
                </table>
            </div>
        </div>
    </main>

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
