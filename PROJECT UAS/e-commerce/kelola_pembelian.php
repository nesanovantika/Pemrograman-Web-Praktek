<?php
session_start();
include 'config.php';

if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
  echo "<script>alert('Silakan login sebagai admin terlebih dahulu.'); window.location='admin_login.php';</script>";
  exit;
}

// Proses aksi konfirmasi atau tolak dan simpan di session
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'], $_POST['aksi'])) {
  $id = intval($_POST['id']);
  $_SESSION['status_pembelian'][$id] = ($_POST['aksi'] === 'konfirmasi') ? 'Diproses' : 'Dikembalikan';
}

$result = $conn->query("SELECT id, user_nama, resi FROM transaksi ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Admin - Kelola Pembelian</title>
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
      cursor: pointer;
      color: white;
      text-decoration: none;
    }
    .konfirmasi { background: #27ae60; }
    .tolak { background: #e67e22; }
  </style>
</head>
<body>

<a href="dashboard_admin.php" class="back-btn">← Kembali ke Dashboard</a>

<h1>Kelola Pembelian</h1>

<table>
  <tr>
    <th>ID</th>
    <th>Nama Pengguna</th>
    <th>Resi</th>
    <th>Keterangan</th>
  </tr>
  <?php while ($data = $result->fetch_assoc()): ?>
    <tr>
      <td><?= htmlspecialchars($data['id']) ?></td>
      <td><?= htmlspecialchars($data['user_nama']) ?></td>
      <td><?= htmlspecialchars($data['resi']) ?></td>
      <td>
        <?php
          $status = $_SESSION['status_pembelian'][$data['id']] ?? null;
          if ($status === 'Diproses' || $status === 'Dikembalikan'):
            echo htmlspecialchars($status);
          else:
        ?>
          <form method="post" style="display:inline-block; margin:0;">
            <input type="hidden" name="id" value="<?= $data['id'] ?>">
            <button type="submit" name="aksi" value="konfirmasi" class="btn konfirmasi">Konfirmasi</button>
            <button type="submit" name="aksi" value="tolak" class="btn tolak">Tolak</button>
          </form>
        <?php endif; ?>
      </td>
    </tr>
  <?php endwhile; ?>
</table>

</body>
</html>
