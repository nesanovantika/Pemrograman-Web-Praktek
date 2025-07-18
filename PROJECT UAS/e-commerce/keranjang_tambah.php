<?php
session_start();
include 'config.php';
include 'produk_data.php';

if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit;
}

$user_id = $_SESSION['user_id'];
$id = $_GET['id'] ?? null;

if ($id && isset($produk[$id])) {
  // Cek apakah produk sudah ada di keranjang user
  $cek = $conn->prepare("SELECT * FROM keranjang WHERE user_id = ? AND produk_id = ?");
  $cek->bind_param("ii", $user_id, $id);
  $cek->execute();
  $result = $cek->get_result();

  if ($result->num_rows > 0) {
    // Jika sudah ada, update jumlah +1
    $conn->query("UPDATE keranjang SET jumlah = jumlah + 1 WHERE user_id = $user_id AND produk_id = $id");
  } else {
    // Tambahkan baru
    $stmt = $conn->prepare("INSERT INTO keranjang (user_id, produk_id, jumlah) VALUES (?, ?, 1)");
    $stmt->bind_param("ii", $user_id, $id);
    $stmt->execute();
    $stmt->close();
  }
}

header("Location: keranjang.php");
exit;
