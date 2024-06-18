<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nexus";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!isset($_SESSION['user_id'])) {
    header("Location: Z1-Login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$user_sql = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($user_sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo "User not found.";
    exit();
}

$user = $result->fetch_assoc();
$stmt->close();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['save_profile'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $region = $_POST['region'];
        $role = $_POST['role'];

        if (!empty($password)) {
            $update_sql = "UPDATE users SET name = ?, email = ?, password = ?, region = ?, role = ? WHERE id = ?";
            $stmt = $conn->prepare($update_sql);
            $stmt->bind_param("sssssi", $name, $email, $password, $region, $role, $user_id);
        } else {
            $update_sql = "UPDATE users SET name = ?, email = ?, region = ?, role = ? WHERE id = ?";
            $stmt = $conn->prepare($update_sql);
            $stmt->bind_param("ssssi", $name, $email, $region, $role, $user_id);
        }

        if ($stmt->execute()) {
            $_SESSION['user_name'] = $name; 
            header("Location: ../F1-Home.php");
            exit();
        } else {
            echo "Error updating profile: " . $stmt->error;
        }
        $stmt->close();
    } elseif (isset($_POST['delete_account'])) {
        $delete_sql = "DELETE FROM users WHERE id = ?";
        $stmt = $conn->prepare($delete_sql);
        $stmt->bind_param("i", $user_id);

        if ($stmt->execute()) {
            session_destroy();
            header("Location: Z1-Login.php");
            exit();
        } else {
            echo "Error deleting account: " . $stmt->error;
        }
        $stmt->close();
    }
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nexus</title>
    <link rel="icon" type="image/png" href="/Nexus/Assets/Logo/L1-PlaySafe.png">
    <link rel="stylesheet" href="Script/CSS/FrontEnd/C8-Profile.css">
</head>
<body class="bg-dark">
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
    
    <div class="container10">
        <div class="card">
            <div class="header">
                <h2>Profile</h2>
                <a href="F1-Home.php" class="close-btn">×</a>
            </div>
            <form action="Z5-Update.php" method="POST">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" class="input-field" value="<?php echo htmlspecialchars($user['name']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" class="input-field" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" class="input-field" value="" />
                    <button type="button" id="toggle-password" class="toggle-password">Show</button>
                </div>
                <div class="form-group">
                    <label for="region">Region</label>
                        <select id="region" name="region" class="input-field" required>
                            <option value="">Select a region</option>
                            <option value="australia" data-flag="australia" <?php echo ($user['region'] == 'australia') ? 'selected' : ''; ?>>Australia</option>
                            <option value="brazil" data-flag="brazil" <?php echo ($user['region'] == 'brazil') ? 'selected' : ''; ?>>Brazil</option>
                            <option value="canada" data-flag="canada" <?php echo ($user['region'] == 'canada') ? 'selected' : ''; ?>>Canada</option>
                            <option value="china" data-flag="china" <?php echo ($user['region'] == 'china') ? 'selected' : ''; ?>>China</option>
                            <option value="france" data-flag="france" <?php echo ($user['region'] == 'france') ? 'selected' : ''; ?>>France</option>
                            <option value="germany" data-flag="germany" <?php echo ($user['region'] == 'germany') ? 'selected' : ''; ?>>Germany</option>
                            <option value="india" data-flag="india" <?php echo ($user['region'] == 'india') ? 'selected' : ''; ?>>India</option>
                            <option value="indonesia" data-flag="indonesia" <?php echo ($user['region'] == 'indonesia') ? 'selected' : ''; ?>>Indonesia</option>
                            <option value="italy" data-flag="italy" <?php echo ($user['region'] == 'italy') ? 'selected' : ''; ?>>Italy</option>
                            <option value="japan" data-flag="japan" <?php echo ($user['region'] == 'japan') ? 'selected' : ''; ?>>Japan</option>
                            <option value="mexico" data-flag="mexico" <?php echo ($user['region'] == 'mexico') ? 'selected' : ''; ?>>Mexico</option>
                            <option value="russia" data-flag="russia" <?php echo ($user['region'] == 'russia') ? 'selected' : ''; ?>>Russia</option>
                            <option value="south-africa" data-flag="south-africa" <?php echo ($user['region'] == 'south-africa') ? 'selected' : ''; ?>>South Africa</option>
                            <option value="united-kingdom" data-flag="united-kingdom" <?php echo ($user['region'] == 'united-kingdom') ? 'selected' : ''; ?>>United Kingdom</option>
                            <option value="united-states" data-flag="united-states" <?php echo ($user['region'] == 'united-states') ? 'selected' : ''; ?>>United States</option>
                        </select>
                </div>
                <div class="form-group">
                    <label for="role">Role</label>
                    <select id="role" name="role" class="input-field" readonly>
                        <option value="<?php echo htmlspecialchars($user['role']); ?>" selected><?php echo htmlspecialchars(ucfirst($user['role'])); ?></option>
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" name="save_profile" class="submit-button">Save Profile</button>
                </div>
            </form>
            <form action="Z5-Update.php" method="POST" onsubmit="return confirm('Are you sure you want to delete your account?');">
                <div class="form-group">
                    <button type="submit" name="delete_account" class="delete-button">Delete Account</button>
                </div>
            </form>
        </div>
    </div>

    <div class="footer">
        <div class="footer-containerz">
            <div class="footer-left">
                <div class="logo-text-containerz">
                    <img src="/Nexus/Assets/Logo/L1-PlaySafe.png" alt="Playsafe Logo" class="logo" />
                    <div class="text-containerz">
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
        <div class="footer2-containerz">
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
    <script>
       document.getElementById('toggle-password').addEventListener('click', function() {
            var passwordInput = document.getElementById('password');
            var type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                        passwordInput.setAttribute('type', type);
            this.textContent = type === 'password' ? 'Show' : 'Hide';
            this.classList.toggle('show');
            this.classList.toggle('hide');
        });
    </script>
    <script src="Script/JAVASCRIPT/C3-Fotter.js"></script>
</body>
</html>
