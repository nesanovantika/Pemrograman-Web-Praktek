<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$id = $_GET['id'] ?? null;

if ($id !== null) {
    // Hapus dari database
    $stmt = $conn->prepare("DELETE FROM favorit WHERE user_id = ? AND produk_id = ?");
    $stmt->bind_param("ii", $user_id, $id);
    $stmt->execute();
    $stmt->close();

    // Opsional: juga update session favorit agar langsung tercermin
    if (isset($_SESSION['favorit'])) {
        $_SESSION['favorit'] = array_filter($_SESSION['favorit'], function($item) use ($id) {
            return $item != $id;
        });
    }
}

// Kembali ke halaman favorit
header("Location: love.php");
exit;
?>
