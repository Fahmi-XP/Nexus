<?php
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
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $region = $_POST['region'];
    $invite_code = $_POST['invite_code']; // Ambil nilai dari input kode undangan
    $role = $_POST['role']; // Ambil peran dari input form

    // Periksa peran yang dipilih
    if ($role == 'admin') {
        // Jika peran adalah admin, periksa apakah kode undangan tidak kosong
        if (empty($invite_code)) {
            $error_message = "Invite code is required for admin registration";
            header("Location: ../Z3-Invite.php?error=" . urlencode($error_message));
            exit();
        }

        // Query SQL untuk memeriksa validitas kode undangan
        $check_code_sql = "SELECT * FROM codes WHERE code = ? AND used = FALSE";
        $check_stmt = $conn->prepare($check_code_sql);
        if ($check_stmt === false) {
            $error_message = "Prepare failed: " . $conn->error;
            header("Location: ../Z3-Invite.php?error=" . urlencode($error_message));
            exit();
        }
        $check_stmt->bind_param("s", $invite_code);
        $check_stmt->execute();
        $result = $check_stmt->get_result();

        if ($result->num_rows === 0) {
            $error_message = "Invalid or used invite code";
            header("Location: ../Z3-Invite.php?error=" . urlencode($error_message));
            exit();
        }

        $check_stmt->close();
    }

    // Setelah memverifikasi kode undangan (jika diperlukan), masukkan data ke dalam tabel users
    $insert_user_sql = "INSERT INTO users (name, email, password, region) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($insert_user_sql);
    if ($stmt === false) {
        $error_message = "Prepare failed: " . $conn->error;
        header("Location: ../Z3-Invite.php?error=" . urlencode($error_message));
        exit();
    }
    $stmt->bind_param("ssss", $name, $email, $password, $region);
    if ($stmt->execute()) {
        if ($role == 'admin') {
            $update_code_sql = "UPDATE codes SET used = TRUE WHERE code = ?";
            $update_stmt = $conn->prepare($update_code_sql);
            if ($update_stmt === false) {
                $error_message = "Prepare failed: " . $conn->error;
                header("Location: ../Z3-Invite.php?error=" . urlencode($error_message));
                exit();
            }
            $update_stmt->bind_param("s", $invite_code);
            $update_stmt->execute();
            $update_stmt->close();
        }

        // Redirect ke halaman login setelah pendaftaran berhasil
        header("Location: ../Z1-Login.php");
        exit();
    } else {
        $error_message = "Error: " . $stmt->error;
        header("Location: ../Z3-Invite.php?error=" . urlencode($error_message));
        exit();
    }

    $stmt->close();
}

$conn->close();
?>
