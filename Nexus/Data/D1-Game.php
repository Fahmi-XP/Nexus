<?php
$servername = "localhost"; 
$username = "root";
$password = ""; 
$dbname = "nexus"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>