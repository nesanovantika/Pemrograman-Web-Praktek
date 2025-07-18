<?php
session_start();

if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
  echo "<script>alert('Silakan login sebagai admin terlebih dahulu.'); window.location='admin_login.php';</script>";
  exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Admin</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f0f0f0;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      flex-direction: column;
    }
    .dashboard {
      background: white;
      padding: 40px;
      border-radius: 15px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.2);
      text-align: center;
    }
    .dashboard h1 {
      color: #ee5a52;
      margin-bottom: 30px;
    }
    .dashboard a {
      display: block;
      margin: 15px 0;
      padding: 12px 20px;
      color: white;
      text-decoration: none;
      border-radius: 8px;
      font-size: 16px;
      transition: background 0.3s;
    }
    .dashboard a.kelola {
      background: #3498db;
    }
    .dashboard a.kelola:hover {
      background: #2980b9;
    }
    .dashboard a.logout {
      background: #e74c3c;
      font-size: 18px;
      font-weight: bold;
    }
    .dashboard a.logout:hover {
      background: #c0392b;
    }
  </style>
</head>
<body>

<div class="dashboard">
  <h1>Dashboard Admin</h1>
  <a href="kelola_produk.php" class="kelola">Kelola Produk</a>
  <a href="kelola_pengguna.php" class="kelola">Kelola Pengguna</a>
  <a href="kelola_pembelian.php" class="kelola">Kelola Pembelian</a>
  <a href="index.php" class="logout">Logout</a>
</div>

</body>
</html>
