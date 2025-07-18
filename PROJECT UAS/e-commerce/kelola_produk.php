<?php
session_start();
include 'config.php';

if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
  echo "<script>alert('Silakan login sebagai admin terlebih dahulu.'); window.location='admin_login.php';</script>";
  exit;
}

$result = $conn->query("SELECT * FROM produk ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Admin - Kelola Produk</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f0f0f0;
      margin: 0;
      padding: 20px;
    }
    .back-btn {
      display: inline-block;
      background: #3498db;
      color: white;
      padding: 8px 15px;
      border-radius: 8px;
      text-decoration: none;
      margin-bottom: 20px;
    }
    .back-btn:hover {
      background: #2980b9;
    }
    h1 {
      text-align: center;
      color: #ee5a52;
    }
    .produk-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
      gap: 20px;
      margin-top: 30px;
    }
    .card {
      background: white;
      padding: 15px;
      border-radius: 10px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
      text-align: center;
    }
    .card img {
      max-width: 100%;
      height: 160px;
      object-fit: cover;
      border-radius: 8px;
      margin-bottom: 10px;
    }
    .card h3 { margin: 10px 0 5px; }
    .card p { color: #444; }
    .btn {
      display: inline-block;
      padding: 6px 12px;
      margin: 4px 2px;
      font-size: 14px;
      border: none;
      border-radius: 5px;
      text-decoration: none;
      cursor: pointer;
    }
    .edit { background: #3498db; color: white; }
    .hapus { background: #e74c3c; color: white; }
    .tambah-produk {
      position: fixed;
      bottom: 20px;
      right: 20px;
      background-color: #27ae60;
      color: white;
      padding: 12px 20px;
      border: none;
      border-radius: 30px;
      font-size: 1rem;
      text-decoration: none;
      box-shadow: 0 2px 8px rgba(0,0,0,0.2);
    }
  </style>
</head>
<body>

<a href="dashboard_admin.php" class="back-btn">← Kembali ke Dashboard</a>

<h1>Kelola Produk</h1>

<div class="produk-grid">
  <?php while ($data = $result->fetch_assoc()): ?>
    <div class="card">
      <img src="<?= htmlspecialchars($data['gambar']) ?>" alt="<?= htmlspecialchars($data['nama']) ?>">
      <h3><?= htmlspecialchars($data['nama']) ?></h3>
      <p>Rp <?= number_format($data['harga'], 0, ',', '.') ?></p>
      <a href="edit_produk.php?id=<?= $data['id'] ?>" class="btn edit">Edit</a>
      <a href="hapus_produk.php?id=<?= $data['id'] ?>" class="btn hapus" onclick="return confirm('Yakin ingin menghapus produk ini?')">Hapus</a>
    </div>
  <?php endwhile; ?>
</div>

<a href="tambah_produk.php" class="tambah-produk">+ Tambah Produk</a>

</body>
</html>
