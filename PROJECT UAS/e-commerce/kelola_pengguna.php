<?php
session_start();
include 'config.php';

if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
  echo "<script>alert('Silakan login sebagai admin terlebih dahulu.'); window.location='admin_login.php';</script>";
  exit;
}

$result = $conn->query("SELECT * FROM users ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Admin - Kelola Pengguna</title>
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
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 30px;
      background: white;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    th, td {
      padding: 12px 15px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }
    th {
      background: #ee5a52;
      color: white;
    }
    tr:hover {
      background: #f1f1f1;
    }
    .btn {
      padding: 6px 12px;
      font-size: 14px;
      border: none;
      border-radius: 5px;
      text-decoration: none;
      cursor: pointer;
    }
    .edit { background: #3498db; color: white; }
    .hapus { background: #e74c3c; color: white; }
    .tambah-user {
      display: inline-block;
      margin-top: 20px;
      background: #27ae60;
      color: white;
      padding: 10px 18px;
      border-radius: 25px;
      text-decoration: none;
    }
  </style>
</head>
<body>

<a href="dashboard_admin.php" class="back-btn">← Kembali ke Dashboard</a>

<h1>Kelola Pengguna</h1>

<table>
  <tr>
    <th>ID</th>
    <th>Nama</th>
    <th>Email</th>
    <th>Aksi</th>
  </tr>
  <?php while ($user = $result->fetch_assoc()): ?>
    <tr>
      <td><?= htmlspecialchars($user['id']) ?></td>
      <td><?= htmlspecialchars($user['name']) ?></td>
      <td><?= htmlspecialchars($user['email']) ?></td>
      <td>
        <a href="edit_pengguna.php?id=<?= $user['id'] ?>" class="btn edit">Edit</a>
        <a href="hapus_pengguna.php?id=<?= $user['id'] ?>" class="btn hapus" onclick="return confirm('Yakin ingin menghapus pengguna ini?')">Hapus</a>
      </td>
    </tr>
  <?php endwhile; ?>
</table>
</body>
</html>
