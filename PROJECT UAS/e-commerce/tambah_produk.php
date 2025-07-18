<?php
session_start();
include 'config.php';

if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
  echo "<script>alert('Silakan login sebagai admin terlebih dahulu.'); window.location='admin_login.php';</script>";
  exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nama = $_POST['nama'];
  $harga = $_POST['harga'];
  $gambar = $_POST['gambar'];

  $stmt = $conn->prepare("INSERT INTO produk (nama, harga, gambar) VALUES (?, ?, ?)");
  $stmt->bind_param("sis", $nama, $harga, $gambar);
  $stmt->execute();
  $stmt->close();

  echo "<script>alert('Produk berhasil ditambahkan!'); window.location='kelola_produk.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Produk</title>
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
      color: #27ae60;
      margin-bottom: 25px;
    }
    form label {
      display: block;
      margin-bottom: 6px;
      color: #333;
    }
    form input[type="text"],
    form input[type="number"] {
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
    .preview-img {
      width: 100%;
      max-height: 200px;
      object-fit: cover;
      border-radius: 8px;
      margin-bottom: 20px;
      display: none;
    }
  </style>
  <script>
    function previewImage() {
      var img = document.getElementById("img-preview");
      var url = document.getElementById("gambar").value;
      if (url.trim() !== "") {
        img.src = url;
        img.style.display = "block";
      } else {
        img.style.display = "none";
      }
    }
  </script>
</head>
<body>

<div class="container">
  <h1>Tambah Produk</h1>
  <form method="POST">
    <label>Nama Produk</label>
    <input type="text" name="nama" required>

    <label>Harga</label>
    <input type="number" name="harga" required>

    <label>Gambar (URL)</label>
    <input type="text" name="gambar" id="gambar" oninput="previewImage()" required>

    <img id="img-preview" class="preview-img" alt="Preview Gambar">

    <button type="submit">Simpan Produk</button>
  </form>
  <a href="kelola_produk.php" class="back-link">← Kembali ke Kelola Produk</a>
</div>

</body>
</html>
