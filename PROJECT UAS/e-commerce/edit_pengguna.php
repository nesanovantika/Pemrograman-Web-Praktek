<?php
session_start();
include 'config.php';

if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
  echo "<script>alert('Silakan login sebagai admin terlebih dahulu.'); window.location='admin_login.php';</script>";
  exit;
}

$id = intval($_GET['id']);
$result = $conn->query("SELECT * FROM users WHERE id = $id");
$user = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST['name'];
  $email = $_POST['email'];

  $stmt = $conn->prepare("UPDATE users SET name=?, email=? WHERE id=?");
  $stmt->bind_param("ssi", $name, $email, $id);
  $stmt->execute();
  $stmt->close();

  echo "<script>alert('Data pengguna berhasil diperbarui.'); window.location='kelola_pengguna.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Pengguna</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f0f0f0;
      margin: 0;
      padding: 20px;
    }
    .container {
      max-width: 500px;
      margin: 40px auto;
      background: white;
      padding: 25px;
      border-radius: 12px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    h1 {
      text-align: center;
      color: #3498db;
      margin-bottom: 25px;
    }
    form label {
      display: block;
      margin-bottom: 6px;
      color: #333;
    }
    form input[type="text"],
    form input[type="email"] {
      width: 100%;
      padding: 10px;
      margin-bottom: 20px;
      border: 1px solid #ccc;
      border-radius: 8px;
    }
    form button {
      display: block;
      width: 100%;
      background: #27ae60;
      color: white;
      padding: 12px;
      font-size: 16px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      transition: background 0.3s;
    }
    form button:hover {
      background: #219150;
    }
    .back-link {
      display: inline-block;
      margin-top: 15px;
      text-decoration: none;
      color: #3498db;
    }
    .back-link:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

<div class="container">
  <h1>Edit Pengguna</h1>
  <form method="POST">
    <label>Nama</label>
    <input type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>" required>

    <label>Email</label>
    <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>

    <button type="submit">Simpan Perubahan</button>
  </form>
  <a href="kelola_pengguna.php" class="back-link">← Kembali ke Kelola Pengguna</a>
</div>

</body>
</html>
