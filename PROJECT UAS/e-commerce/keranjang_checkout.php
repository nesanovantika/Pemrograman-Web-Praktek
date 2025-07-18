<?php
session_start();

$user = $_SESSION['user_nama'] ?? 'nama';
$pilih = $_POST['pilih'] ?? [];
$produk_data = $_POST['produk_data'] ?? [];

if (empty($pilih)) {
  echo "<script>alert('Tidak ada produk yang dipilih!'); window.location='keranjang.php';</script>";
  exit;
}

// siapkan data checkout
$_SESSION['checkout'] = [
  'produk' => [],
  'total' => 0,
];

foreach ($pilih as $id) {
  if (isset($produk_data[$id])) {
    $nama = $produk_data[$id]['nama'];
    $harga = $produk_data[$id]['harga'];
    $jumlah = $produk_data[$id]['jumlah'];

    $_SESSION['checkout']['produk'][$id] = [
      'nama' => $nama,
      'harga' => $harga,
      'jumlah' => $jumlah,
    ];

    $_SESSION['checkout']['total'] += $harga * $jumlah;
  }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Checkout</title>
  <style>
    body { font-family: Arial, sans-serif; background: #f4f4f4; padding: 30px; }
    .container { max-width: 800px; margin: auto; background: white; padding: 20px; border-radius: 12px; box-shadow: 0 0 10px rgba(0,0,0,0.1);}
    h2 { margin-top: 0; }
    table { width: 100%; border-collapse: collapse; margin-top: 20px;}
    th, td { border-bottom: 1px solid #ddd; padding: 10px; text-align: left; }
    th { background: #fafafa; }
    textarea {
      width: 100%; margin-top: 20px; padding: 12px; border: 1px solid #ccc; border-radius: 6px;
      font-size: 14px;
    }
    .total {
      font-size: 18px;
      font-weight: bold;
      margin-top: 20px;
    }
    .btn {
      display: inline-block;
      margin-top: 20px;
      padding: 12px 20px;
      background: #27ae60;
      color: white;
      text-decoration: none;
      border-radius: 8px;
      font-size: 16px;
      border: none;
      cursor: pointer;
    }
    .back-button {
      display: inline-block;
      background: #e74c3c;
      color: white;
      padding: 10px 15px;
      text-decoration: none;
      border-radius: 6px;
      margin-bottom: 15px;
    }
  </style>
</head>
<body>

<div class="container">
  <a href="keranjang.php" class="back-button">← Kembali ke Keranjang</a>
  <h2>Checkout untuk: <?= htmlspecialchars($user) ?></h2>

  <table>
    <tr>
      <th>Nama Produk</th>
      <th>Harga</th>
      <th>Jumlah</th>
      <th>Subtotal</th>
    </tr>
    <?php foreach ($_SESSION['checkout']['produk'] as $id => $item): ?>
      <tr>
        <td><?= htmlspecialchars($item['nama']) ?></td>
        <td>Rp <?= number_format($item['harga'], 0, ',', '.') ?></td>
        <td><?= $item['jumlah'] ?></td>
        <td>Rp <?= number_format($item['harga'] * $item['jumlah'], 0, ',', '.') ?></td>
      </tr>
    <?php endforeach; ?>
  </table>

  <div class="total">Total: Rp <?= number_format($_SESSION['checkout']['total'], 0, ',', '.') ?></div>

  <form action="pembayaran_selesai.php" method="post">
    <textarea name="alamat" rows="3" required placeholder="Alamat lengkap pengiriman..."></textarea>
    <button type="submit" class="btn">💳 Lanjut ke Pembayaran</button>
  </form>
</div>

</body>
</html>
