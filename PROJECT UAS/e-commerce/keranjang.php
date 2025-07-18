<?php
session_start();
include 'config.php';
include 'produk_data.php';

if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit;
}

$user_id = $_SESSION['user_id'];

// Ambil isi keranjang dari database
$keranjang = [];
$result = $conn->query("SELECT * FROM keranjang WHERE user_id = $user_id");
while ($row = $result->fetch_assoc()) {
  $produk_id = $row['produk_id'];
  if (isset($produk[$produk_id])) {
    $keranjang[] = [
      'id' => $produk_id,
      'nama' => $produk[$produk_id]['nama'],
      'harga' => $produk[$produk_id]['harga'],
      'gambar' => $produk[$produk_id]['gambar'],
      'jumlah' => $row['jumlah']
    ];
  }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Keranjang Belanja</title>
  <style>
    body { font-family: Arial; background: #f9f9f9; padding: 20px; }
    h1 { margin-bottom: 20px; }
    form { background: white; border-radius: 10px; padding: 20px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
    table { width: 100%; border-collapse: collapse; }
    th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
    img { width: 80px; height: 80px; object-fit: cover; border-radius: 6px; }
    .hapus {
      color: white;
      background: #e74c3c;
      padding: 6px 12px;
      text-decoration: none;
      border-radius: 5px;
    }
    .checkout-btn {
      margin-top: 20px;
      background: #27ae60;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      font-size: 16px;
    }
    .back-button {
      display: inline-block;
      margin-bottom: 20px;
      background: rgb(232, 56, 25);
      color: white;
      padding: 10px 15px;
      border-radius: 6px;
      text-decoration: none;
    }
  </style>
</head>
<body>

<a href="produk.php" class="back-button">← Kembali</a>
<h1>🛒 Keranjang Belanja</h1>

<?php if (empty($keranjang)): ?>
  <p>Keranjang kamu kosong.</p>
<?php else: ?>
  <form action="keranjang_checkout.php" method="post">
    <table>
      <tr>
        <th>Pilih</th>
        <th>Produk</th>
        <th>Nama</th>
        <th>Harga</th>
        <th>Jumlah</th>
        <th>Aksi</th>
      </tr>
      <?php foreach ($keranjang as $item): ?>
        <tr>
          <td><input type="checkbox" name="pilih[]" value="<?= $item['id'] ?>"></td>
          <td><img src="<?= $item['gambar'] ?>"></td>
          <td><?= htmlspecialchars($item['nama']) ?></td>
          <td><?= $item['harga'] ?></td>
          <td><?= $item['jumlah'] ?></td>
          <td><a href="keranjang_hapus.php?id=<?= $item['id'] ?>" class="hapus">Hapus</a></td>

          <!-- hidden data supaya ikut dikirim saat diceklis -->
          <input type="hidden" name="produk_data[<?= $item['id'] ?>][nama]" value="<?= htmlspecialchars($item['nama']) ?>">
          <input type="hidden" name="produk_data[<?= $item['id'] ?>][harga]" value="<?= preg_replace('/[^\d]/', '', $item['harga']) ?>">
          <input type="hidden" name="produk_data[<?= $item['id'] ?>][jumlah]" value="<?= $item['jumlah'] ?>">
        </tr>
      <?php endforeach; ?>
    </table>

    <button type="submit" class="checkout-btn">🧾 Checkout Produk Terpilih</button>
  </form>
<?php endif; ?>

</body>
</html>
