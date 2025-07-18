<?php
session_start();
include 'config.php';

if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
  echo "<script>alert('Silakan login sebagai admin terlebih dahulu.'); window.location='admin_login.php';</script>";
  exit;
}

$id = intval($_GET['id']);
$conn->query("DELETE FROM users WHERE id = $id");

echo "<script>alert('Pengguna berhasil dihapus.'); window.location='kelola_pengguna.php';</script>";
?>
