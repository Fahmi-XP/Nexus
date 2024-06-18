<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include your database connection or configuration file
include 'Data/D1-Game.php';

// Initialize variables
$id = $name = $photo = $device = $date = $developer = $genre = $link = '';
$isUpdate = false;

// Handle GET request to retrieve data for a specific ID
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query to fetch data based on ID
    $stmt = $conn->prepare("SELECT * FROM game WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch the data
        $row = $result->fetch_assoc();
        $name = $row['name'];
        $photo = $row['photo'];
        $device = $row['device'];
        $date = $row['date'];
        $developer = $row['developer'];
        $gendre = $row['gendre'];
        $link = $row['link'];

        // Mark this as an update operation
        $isUpdate = true;
    } else {
        echo "No data found for ID: " . htmlspecialchars($id);
    }

    $stmt->close();
}

// Handle POST request to update existing data
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $device = $_POST['device'];
    $date = $_POST['date'];
    $developer = $_POST['developer'];
    $gendre = $_POST['gendre'];
    $link = $_POST['link'];

    // Handle photo upload if a new file is provided
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
        // If no new file is uploaded, retain the old photo URL
        $photo = $_POST['photo_old'];
    }

    // Update existing record
    $stmt = $conn->prepare("UPDATE game SET name = ?, photo = ?, device = ?, date = ?, developer = ?, gendre = ?, link = ? WHERE id = ?");
    $stmt->bind_param("sssssssi", $name, $photo, $device, $date, $developer, $gendre, $link, $id);

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
    <title>Update Game Data</title>
    <link rel="stylesheet" href="Script/CSS/BackEnd/C4-Update.css">
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
        <h1 class="title">Update Game Data</h1>
        <form action="" method="POST" enctype="multipart/form-data" class="update-form">
            <?php if ($isUpdate): ?>
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
                <input type="hidden" name="photo_old" value="<?php echo htmlspecialchars($photo); ?>">
            <?php endif; ?>
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" required>
            </div>
            <div class="form-group">
                <label for="photo">Photo</label>
                <input type="file" id="photo" name="photo">
                <?php if ($isUpdate && $photo): ?>
                    <p>Current Photo: <a href="<?php echo htmlspecialchars($photo); ?>" target="_blank">View</a></p>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="device">Device:</label>
                <input type="text" id="device" name="device" value="<?php echo htmlspecialchars($device); ?>" required>
            </div>
            <div class="form-group">
                <label for="date">Date:</label>
                <input type="date" id="date" name="date" value="<?php echo htmlspecialchars($date); ?>" required>
            </div>
            <div class="form-group">
                <label for="developer">Developer:</label>
                <input type="text" id="developer" name="developer" value="<?php echo htmlspecialchars($developer); ?>" required>
            </div>
            <div class="form-group">
                <label for="gendre">Gendre:</label>
                <input type="text" id="gendre" name="gendre" value="<?php echo htmlspecialchars($gendre); ?>" required>
            </div>
            <div class="form-group">
                <label for="link">Link:</label>
                <input type="url" id="link" name="link" value="<?php echo htmlspecialchars($link); ?>" required>
            </div>
            <button type="submit" class="submit-button">Update</button>
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
