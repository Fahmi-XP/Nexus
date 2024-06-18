<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nexus";

// Membuat koneksi ke database
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Memeriksa apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: Z1-Login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Mengambil informasi pengguna dari database
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

// Memeriksa apakah formulir profil telah dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['save_profile'])) {
        // Menyimpan perubahan profil
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $region = $_POST['region'];
        $role = $_POST['role'];

        // Hash the password before storing it
        // $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        $update_sql = "UPDATE users SET name = ?, email = ?, password = ?, region = ?, role = ? WHERE id = ?";
        $stmt = $conn->prepare($update_sql);
        $stmt->bind_param("sssssi", $name, $email, $password, $region, $role, $user_id);

        if ($stmt->execute()) {
            $_SESSION['user_name'] = $name; 
            echo "Profile updated successfully.";
        } else {
            echo "Error updating profile: " . $stmt->error;
        }
        $stmt->close();
    } elseif (isset($_POST['delete_account'])) {
        // Menghapus akun
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