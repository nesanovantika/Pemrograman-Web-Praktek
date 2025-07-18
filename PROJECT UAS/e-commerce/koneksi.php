<?php
$host = "localhost";
$user = "root";
$pass = "12345"; // kosongkan jika tidak ada password
$db = "rynee_db";

$conn = new mysqli($host, $user, $pass, $db, 3307);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
