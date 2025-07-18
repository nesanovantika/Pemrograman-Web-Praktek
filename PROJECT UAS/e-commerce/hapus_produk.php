<?php
session_start();
include 'config.php';

if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
  echo "<script>alert('Silakan login sebagai admin terlebih dahulu.'); window.location='admin_login.php';</script>";
  exit;
}

$id = intval($_GET['id']);
$conn->query("DELETE FROM produk WHERE id = $id");

echo "<script>alert('Produk berhasil dihapus.'); window.location='kelola_produk.php';</script>";
?>
