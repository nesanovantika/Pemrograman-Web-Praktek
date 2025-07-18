<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit;
}

$id = $_GET['id'] ?? null;
$user_id = $_SESSION['user_id'];

if ($id !== null) {
    // Cek di database
    $stmt = $conn->prepare("SELECT * FROM favorit WHERE user_id = ? AND produk_id = ?");
    $stmt->bind_param("ii", $user_id, $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows == 0) {
        // Jika belum ada, insert
        $stmt2 = $conn->prepare("INSERT INTO favorit (user_id, produk_id) VALUES (?, ?)");
        $stmt2->bind_param("ii", $user_id, $id);
        $stmt2->execute();
    }
}

// Redirect
header("Location: love.php");
exit;
?>
