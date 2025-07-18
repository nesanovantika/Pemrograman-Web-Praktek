<?php
// Ambil ID dari URL
$id = $_GET['id'] ?? null;

// Simulasi data produk (bisa diganti dengan database)
$produk = [
  1 => ['nama' => 'Rajut', 'harga' => 'Rp 385.000', 'gambar' => 'img/atasan1.jpg', 'deskripsi' => 'Sweater berbahan rajut yang lembut dan halus.'],
  2 => ['nama' => 'Kemeja', 'harga' => 'Rp 420.000', 'gambar' => 'img/atasan2.jpg', 'deskripsi' => 'Kemeja pria cocok digunakan untuk acara formal.'],
  3 => ['nama' => 'Jas', 'harga' => 'Rp 710.000', 'gambar' => 'img/jas1.jpg', 'deskripsi' => 'Jas pria untuk acara formal.'],
  4 => ['nama' => 'Jas Kantor', 'harga' => 'Rp 810.000', 'gambar' => 'img/jas2.jpg', 'deskripsi' => 'Jas pria untuk kerja.'],
  5 => ['nama' => 'Oneset Formal', 'harga' => 'Rp 1.160.000', 'gambar' => 'img/oneset1.jpg', 'deskripsi' => 'Setelan wanita yang bagus untuk acara formal.'],
  6 => ['nama' => 'Oneset Casual ', 'harga' => 'Rp 1.115.000', 'gambar' => 'img/oneset2.jpg', 'deskripsi' => 'Setelan wanita bergaya casual dengan warna soft.'],
  7 => ['nama' => 'Lipstick', 'harga' => 'Rp 535.000', 'gambar' => 'img/makeup1.jpg', 'deskripsi' => 'Lipstick tahan lama warna natural.'],
  8 => ['nama' => 'Eyeshadow', 'harga' => 'Rp 590.000', 'gambar' => 'img/makeup2.jpg', 'deskripsi' => 'Eyeshadow dengan warna yang soft.'],
  9 => ['nama' => 'YSL Cushion', 'harga' => 'Rp 735.000', 'gambar' => 'img/makeup3.jpg', 'deskripsi' => 'Cushion dengan coverage sedang.'],
  10 => ['nama' => 'Channel Blush On', 'harga' => 'Rp 990.000', 'gambar' => 'img/makeup4.jpg', 'deskripsi' => 'Blush On dengan warna yang sangat cantik.'],
  11 => ['nama' => 'Lipstick Burberri', 'harga' => 'Rp 435.000', 'gambar' => 'img/makeup5.jpg', 'deskripsi' => 'Lipstick tahan lama warna natural.'],
  12 => ['nama' => 'Celine Parfume', 'harga' => 'Rp 560.000', 'gambar' => 'img/makeup6.jpg', 'deskripsi' => 'Parfum dengan wangi yang tahan hingga 12 jam.'],
  13 => ['nama' => 'Prada Heels ', 'harga' => 'Rp 3.140.000', 'gambar' => 'img/sepatu1.jpg', 'deskripsi' => 'Heels wanita bergaya casual dengan warna menarik.'],
  14 => ['nama' => 'YSL Heels', 'harga' => 'Rp 5.200.000', 'gambar' => 'img/sepatu2.jpg', 'deskripsi' => 'Heels tali yang membuat kaki nampak seksi.'],
  15 => ['nama' => 'Anmara Heels', 'harga' => 'Rp 1.140.000', 'gambar' => 'img/sepatu3.jpg', 'deskripsi' => 'Hells dengan model yang elegan dan warna yang soft.'],
  16 => ['nama' => 'Jimmy Choo Heels', 'harga' => 'Rp 2.200.000', 'gambar' => 'img/sepatu4.jpg', 'deskripsi' => 'heels wanita yang sangat cantik'],
  17 => ['nama' => 'Adidas Samba', 'harga' => 'Rp 2.400.000', 'gambar' => 'img/sepatu5.jpg', 'deskripsi' => 'Sepatu adidas dengan perpaduan warna yang bagus.'],
  18 => ['nama' => 'Sovella Shoes', 'harga' => 'Rp 800.000', 'gambar' => 'img/sepatu6.jpg', 'deskripsi' => 'Sepatu santai untuk wanita.'],
  19 => ['nama' => 'Serum The Ordinary', 'harga' => 'Rp 298.000', 'gambar' => 'img/skin1.jpg', 'deskripsi' => 'Serum untuk mencerahkan kulit wajah.'],
  20 => ['nama' => 'Moisturizer Bemubeep', 'harga' => 'Rp 375.000', 'gambar' => 'img/skin2.jpg', 'deskripsi' => 'Moisturizer dengan formula 9x melembabkan kulit.'],
  21 => ['nama' => 'Toner ANUA', 'harga' => 'Rp 308.000', 'gambar' => 'img/skin3.jpg', 'deskripsi' => 'Toner dengan kandungan niacinamide untuk mencerahkan dan cepat menyerap di kulit.'],
  22 => ['nama' => 'Peeling Serum Skintific', 'harga' => 'Rp 175.000', 'gambar' => 'img/skin4.jpg', 'deskripsi' => 'Serum untuk membuat kulit menjadi sehat dengan rajin exfoliasi.'],
  23 => ['nama' => 'Centella Madagascar', 'harga' => 'Rp 900.000', 'gambar' => 'img/skin5.jpg', 'deskripsi' => 'Rangkaian skincare untukn kulit normal.'],
  24 => ['nama' => 'Facial Essence', 'harga' => 'Rp 999.000', 'gambar' => 'img/skin6.jpg', 'deskripsi' => 'Di formulasikan untuk mengencangkan kulit sehingga terlihat tampak muda.'],
  25 => ['nama' => 'Pandora Earrings', 'harga' => 'Rp 2.130.000', 'gambar' => 'img/acc1.jpg', 'deskripsi' => 'Anting-anting wanita dengan warna mewah menambah kecantikan anda.'],
  26 => ['nama' => 'The Palace Rings', 'harga' => 'Rp 4.175.000', 'gambar' => 'img/acc2.jpg', 'deskripsi' => 'Akseoris untuk mendukung penampilan semakin cantik.'],
  27 => ['nama' => 'Celine Belt', 'harga' => 'Rp 130.000', 'gambar' => 'img/acc3.jpg', 'deskripsi' => 'Belt terbuat dari kulit.'],
  28 => ['nama' => 'Dior Sunglasses', 'harga' => 'Rp 2.175.000', 'gambar' => 'img/acc4.jpg', 'deskripsi' => 'Kacamata yang bagus untuk mendukung penampilan.'],
  29 => ['nama' => 'Ribbon', 'harga' => 'Rp 130.000', 'gambar' => 'img/acc5.jpg', 'deskripsi' => 'Pita dengan warna lembut untuk menghiasi rambut.'],
  30 => ['nama' => 'Hair Claw', 'harga' => 'Rp 175.000', 'gambar' => 'img/acc6.jpg', 'deskripsi' => 'Jepitan rambut wanita dengan warna emas menjadikan kesan mewah dan cantik ketika di gunakan.'],
  31 => ['nama' => 'Zara HandBag', 'harga' => 'Rp 3.130.000', 'gambar' => 'img/tas1.jpg', 'deskripsi' => 'Tas bahu elegan dengan desain minimalis modern, cocok untuk gaya kasual maupun formal.'],
  32 => ['nama' => 'Jims Honey Bag', 'harga' => 'Rp 1.175.000', 'gambar' => 'img/tas2.jpg', 'deskripsi' => 'Tas multifungsi dengan harga terjangkau, model kekinian dan ringan digunakan.'],
  33 => ['nama' => 'Charles & Keith Shoulder Bag', 'harga' => 'Rp 2.200.000', 'gambar' => 'img/tas3.jpg', 'deskripsi' => 'Tas trendi dengan desain chic dan stylish, cocok untuk wanita urban.'],
  34 => ['nama' => 'Girls Heart Bag', 'harga' => 'Rp 999.000', 'gambar' => 'img/tas4.jpg', 'deskripsi' => 'Tas kecil bergaya Korea dengan nuansa feminin dan detail manis, pas untuk remaja.'],
  35 => ['nama' => 'Coach Sling Bag', 'harga' => 'Rp 6.120.000', 'gambar' => 'img/tas5.jpg', 'deskripsi' => 'Tas premium berbahan kulit asli, desain klasik mewah dan tahan lama.'],
  36 => ['nama' => 'Mossdom Shoulder Bag', 'harga' => 'Rp 300.000', 'gambar' => 'img/tas6.jpg', 'deskripsi' => 'Tas bahu kasual dengan banyak kompartemen, ideal untuk aktivitas harian.'],

];

$data = $produk[$id] ?? null;
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Detail Produk</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <style>
    body { font-family: Arial; padding: 30px; background: #f0f0f0; }
    .detail-container { background: white; padding: 20px; border-radius: 10px; max-width: 600px; margin: auto; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
    img { width: 100%; border-radius: 10px; }
    h1 { font-size: 24px; margin-bottom: 10px; }
    .back-button {
      display: inline-flex;
      align-items: center;
      background-color: #ff6b6b;
      color: white;
      padding: 10px 15px;
      border-radius: 8px;
      text-decoration: none;
      font-weight: bold;
      margin-bottom: 20px;
    }
    .back-button i {
      margin-right: 8px;
    }
    .price { color: #ee5a52; font-weight: bold; margin: 10px 0; }
    .desc { margin-top: 15px; }
  </style>
</head>
<body>
    <a href="javascript:history.back()" class="back-button">
    <i class="fas fa-arrow-left"></i> Kembali
  </a>

  <div class="detail-container">
    <?php if ($data): ?>
      <img src="<?= $data['gambar'] ?>" alt="<?= $data['nama'] ?>">
      <h1><?= $data['nama'] ?></h1>
      <div class="price"><?= $data['harga'] ?></div>
      <div class="desc"><?= $data['deskripsi'] ?></div>
      <div style="margin-top: 20px;">
  <!-- Tombol Love -->
  <!-- Tombol Love -->
<!-- Tombol Love -->
<a href="love_tambah.php?id=<?= $id ?>" 
   style="text-decoration: none; background: #ff5b5b; color: white; padding: 10px 15px; border-radius: 5px; margin-right: 10px;">
  ❤️ Simpan ke Favorit
</a>

<!-- Tombol Keranjang -->
<a href="keranjang_tambah.php?id=<?= $id ?>" 
   style="text-decoration: none; background: #5cb85c; color: white; padding: 10px 15px; border-radius: 5px;">
  🛒 Tambahkan ke Keranjang
</a>



    <?php else: ?>
      <p>Produk tidak ditemukan.</p>
    <?php endif; ?>
  </div>
</body>
</html>
