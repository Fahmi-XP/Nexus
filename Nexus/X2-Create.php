<?php
// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'Data/D1-Game.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $date = $_POST['date'];
    $developer = $_POST['developer'];
    $gendre = $_POST['gendre'];
    $link = $_POST['link'];
    
    // Handle devices
    $device = isset($_POST['device']) ? implode(', ', $_POST['device']) : '';

    // File upload handling
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == UPLOAD_ERR_OK) {
        $file_tmp = $_FILES['photo']['tmp_name'];
        $file_name = basename($_FILES['photo']['name']);
        $upload_dir = 'uploads/';

        // Ensure the upload directory exists
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }

        $target_file = $upload_dir . $file_name;

        if (move_uploaded_file($file_tmp, $target_file)) {
            $photo = $target_file;
        } else {
            echo "Error uploading file.";
            exit();
        }
    } else {
        echo "File upload error: " . $_FILES['photo']['error'];
        exit();
    }

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO game (name, photo, device, date, developer, gendre, link) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $name, $photo, $device, $date, $developer, $gendre, $link);

    // Execute the statement
    if ($stmt->execute()) {
        header("Location: X3-Read.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
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
    <link rel="stylesheet" href="Script/CSS/BackEnd/C3-Create.css">
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
    
    <main class="container">
    <h1 class="title">Add New Data</h1>
    <form action="X2-Create.php" method="POST" class="create-form" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="photo">Photo</label>
            <input type="file" id="photo" name="photo" required>
        </div>
        <div class="form-group">
            <label for="device">Device</label>
            <div class="device-options">
                <input type="checkbox" id="windows" name="device[]" value="Windows">
                <label for="windows">
                    <img src="/Nexus/Assets/Logo/L4-Windows.png" alt="Windows" class="device-icon">
                </label>
                <input type="checkbox" id="mac" name="device[]" value="Mac">
                <label for="mac">
                    <img src="/Nexus/Assets/Logo/L5-Apple.png" alt="Apple" class="device-icon">
                </label>
                <input type="checkbox" id="linux" name="device[]" value="Linux">
                <label for="linux">
                    <img src="/Nexus/Assets/Logo/L6-Linux.png" alt="Linux" class="device-icon">
                </label>
            </div>
        </div>
        <div class="form-group">
            <label for="date">Date</label>
            <input type="date" id="date" name="date" required>
        </div>
        <div class="form-group">
            <label for="developer">Developer</label>
            <input type="text" id="developer" name="developer" required>
        </div>
        <div class="form-group">
            <label for="gendre">Gendre</label>
            <select id="gendre" name="gendre" required>
                <option value="">Select a gendre</option>
                <option value="Action">Action</option>
                <option value="Adventure">Adventure</option>
                <option value="Anime">Anime</option>
                <option value="Fighting">Fighting</option>
                <option value="FPS">FPS (First-Person Shooter)</option>
                <option value="Horror">Horror</option>
                <option value="MMO">MMO</option>
                <option value="MOBA">MOBA</option>
                <option value="Music">Music</option>
                <option value="Puzzle">Puzzle</option>
                <option value="Racing">Racing</option>
                <option value="RPG">RPG</option>
                <option value="Simulation">Simulation</option>
                <option value="Sport">Sport</option>
                <option value="Strategy">Strategy</option>
            </select>
        </div>
        <div class="form-group">
            <label for="link">Link</label>
            <input type="url" id="link" name="link" required>
        </div>
        <button type="submit" class="submit-button">Submit</button>
    </form>
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
