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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Cek apakah email ada di database
    $email_sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($email_sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        // Email tidak ditemukan
        header("Location: ../Z3-Wrong.php?error=email");
        exit();
    } else {
        $user = $result->fetch_assoc();
        if ($user['password'] != $password) {
            // Email ditemukan tetapi password salah
            header("Location: ../Z3-Wrong.php?error=password");
            exit();
        } else {
            // Login berhasil
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_role'] = $user['role']; // Menyimpan peran pengguna di sesi
            header("Location: ../F1-Home.php");
            exit();
        }
    }

    $stmt->close();
} else {
    // Mengarahkan kembali jika request method bukan POST
    header("Location: ../F1-Home.php");
    exit();
}

$conn->close();
?>
