<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit;
}

$user_id = $_SESSION['user_id'];
$id = $_GET['id'] ?? null;

if ($id) {
  $stmt = $conn->prepare("DELETE FROM keranjang WHERE user_id = ? AND produk_id = ?");
  $stmt->bind_param("ii", $user_id, $id);
  $stmt->execute();
}

header("Location: keranjang.php");
exit;
