<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit;
}

$user_id = $_SESSION['user_id'];

// ambil data produk favorit
$favorit = [];
$result = $conn->query("SELECT produk_id FROM favorit WHERE user_id = $user_id");
while ($row = $result->fetch_assoc()) {
  $favorit[] = $row['produk_id'];
}

// produk_data.php tetap buat untuk ambil detail produk
include 'produk_data.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Favorit Saya</title>
  <style>
    body { font-family: Arial; background: #f7f7f7; padding: 20px; }
    .produk-container { display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 20px; }
    .produk { background: #fff; padding: 15px; border-radius: 10px; box-shadow: 0 0 8px rgba(0,0,0,0.1); }
    img { width: 100%; border-radius: 10px; }
    h3 { margin: 10px 0 5px; font-size: 18px; }
    .harga { color: #e74c3c; font-weight: bold; }
    .hapus {
      display: inline-block;
      margin-top: 10px;
      background: #ff4444;
      color: white;
      padding: 5px 10px;
      border-radius: 6px;
      text-decoration: none;
    }
    img {
  width: 100%;
  height: 200px;            /* Tinggi seragam */
  object-fit: cover;        /* Gambar dipotong sesuai frame tanpa distorsi */
  border-radius: 10px;
}

  </style>
</head>
<body>

<a href="beranda.php" 
   style="display: inline-block; margin-bottom: 20px; background:rgb(229, 72, 121); color: white; padding: 10px 15px; border-radius: 6px; text-decoration: none;">
  ← Kembali
</a>

<h1>❤️ Favorit Saya</h1>

<?php if (empty($favorit)): ?>
  <p>Tidak ada produk favorit.</p>
<?php else: ?>
  <div class="produk-container">
    <?php foreach ($favorit as $id): ?>
      <?php if (isset($produk[$id])): ?>
        <div class="produk">
          <img src="<?= $produk[$id]['gambar'] ?>" alt="<?= $produk[$id]['nama'] ?>">
          <h3><?= $produk[$id]['nama'] ?></h3>
          <div class="harga"><?= $produk[$id]['harga'] ?></div>
          <a href="love_hapus.php?id=<?= $id ?>" class="hapus">Hapus</a>
        </div>
      <?php endif; ?>
    <?php endforeach; ?>
  </div>
<?php endif; ?>

</body>
</html>
