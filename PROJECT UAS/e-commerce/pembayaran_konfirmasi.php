<?php
session_start();
require 'config.php'; // file koneksi ke database

// Ambil data dari form
$metode = $_POST['metode'] ?? '';
$kode = $_POST['kode'] ?? '';
$checkout = $_SESSION['checkout'] ?? [];

// Ambil data user dari session
$user_id = $_SESSION['user_id'] ?? 0;
$nama_user = $_SESSION['user_nama'] ?? 'Nama Tidak Diketahui';

// Validasi kode
if ($kode !== 'BAYAR123') {
  // Simpan pesan kesalahan ke session
  $_SESSION['error'] = 'Kode pembayaran salah. Gunakan kode: BAYAR123';
  header('Location: pembayaran_selesai.php');
  exit;
}


// Data checkout
$alamat = $checkout['alamat'] ?? '';
$total = $checkout['total'] ?? 0;

// Buat resi unik
$resi = 'TRX' . strtoupper(uniqid());

// Escape input
$alamat = $conn->real_escape_string($alamat);
$metode = $conn->real_escape_string($metode);
$nama_user = $conn->real_escape_string($nama_user);
$kode = $conn->real_escape_string($kode);

// Simpan ke database
$sql = "INSERT INTO transaksi (user_id, user_nama, alamat, metode, total, resi)
        VALUES ($user_id, '$nama_user', '$alamat', '$metode', $total, '$resi')";

if (!$conn->query($sql)) {
  die("Gagal menyimpan transaksi: " . $conn->error);
}

// (Opsional) kosongkan keranjang
unset($_SESSION['keranjang']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Pembayaran Berhasil</title>
  <style>
    body {
      font-family: Arial;
      background: #f0f9f8;
      padding: 30px;
    }
    .container {
      max-width: 600px;
      margin: auto;
      background: white;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 8px rgba(0,0,0,0.1);
    }
    h2 {
      color: #2ecc71;
    }
    .resi {
      background: #f2f2f2;
      padding: 10px;
      border-radius: 8px;
      font-family: monospace;
      margin: 20px 0;
      font-size: 18px;
      text-align: center;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>✅ Pembayaran Sukses</h2>
    <p>Terima kasih, <strong><?= htmlspecialchars($nama_user) ?></strong>.</p>
    <p>Metode Pembayaran: <strong><?= htmlspecialchars($metode) ?></strong></p>
    <p>Alamat Pengiriman: <strong><?= htmlspecialchars($alamat) ?></strong></p>

    <h3>Resi Transaksi:</h3>
    <div class="resi"><?= $resi ?></div>

    <a href="profile.php">← Lihat Riwayat Pembelian</a>
  </div>
</body>
</html>
