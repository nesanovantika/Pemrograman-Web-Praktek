<?php
session_start();

$nama_user = $_SESSION['user_nama'] ?? 'Nama Tidak Diketahui';
$keranjang = $_SESSION['keranjang'] ?? [];

$alamat = $_POST['alamat'] ?? '';
$total = $_POST['total_harga'] ?? 0;
$produk_terpilih = $_POST['produk_terpilih'] ?? [];

$_SESSION['checkout'] = [
  'alamat' => $alamat,
  'total' => $total,
  'produk' => []
];

foreach ($produk_terpilih as $id => $jumlah) {
  if (isset($keranjang[$id])) {
    $produk = $keranjang[$id];
    $harga_bersih = preg_replace('/[^\d]/', '', $produk['harga']);
    $_SESSION['checkout']['produk'][$id] = [
      'jumlah' => $jumlah,
      'nama' => $produk['nama'],
      'harga' => $harga_bersih
    ];
  }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Pembayaran</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f4f4f4;
      padding: 30px;
    }
    .container {
      max-width: 500px;
      margin: auto;
      background: white;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    h2 {
      margin-top: 0;
      color: #333;
    }
    label {
      display: block;
      margin: 15px 0 5px;
    }
    select, input[type="text"] {
      width: 100%;
      padding: 12px;
      border-radius: 8px;
      border: 1px solid #ccc;
      margin-bottom: 15px;
    }
    .btn {
      display: inline-block;
      width: 100%;
      padding: 12px;
      background: #27ae60;
      color: white;
      border: none;
      border-radius: 8px;
      font-size: 16px;
      cursor: pointer;
      text-align: center;
    }
    .btn:hover {
      background: #219150;
    }
    .back-button {
      display: inline-block;
      margin-top: 20px;
      background: rgb(231, 46, 33);
      color: white;
      padding: 10px 15px;
      border-radius: 6px;
      text-decoration: none;
    }
  </style>
</head>
<body>

<div class="container">
  <h2>💳 Pembayaran</h2>
  <p>Checkout untuk: <strong><?= htmlspecialchars($nama_user) ?></strong></p>
  
<?php if (isset($_SESSION['error'])): ?>
  <script>
    alert("<?= $_SESSION['error'] ?>");
  </script>
  <?php unset($_SESSION['error']); ?>
<?php endif; ?>

  <form action="pembayaran_konfirmasi.php" method="post">
    <label for="metode">Metode Pembayaran:</label>
    <select name="metode" id="metode" required>
      <option value="">-- Pilih Metode --</option>
      <option value="bank_transfer">Transfer Bank</option>
      <option value="ewallet">E-Wallet</option>
      <option value="cod">Bayar di Tempat (COD)</option>
    </select>

    <label for="kode">Kode Pembayaran:</label>
    <input type="text" name="kode" id="kode" required placeholder="Contoh: BAYAR123">

    <button type="submit" class="btn">Konfirmasi Pembayaran</button>
  </form>

  <a href="keranjang.php" class="back-button">← Kembali ke Keranjang</a>
</div>

</body>
</html>

