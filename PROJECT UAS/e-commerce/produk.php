<?php
session_start();
include 'config.php';
$site_title = "RYNÉ";
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title><?= $site_title ?> - Produk</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body {
      font-family: Arial, sans-serif;
      background-color: #f8f9fa;
    }
    .header {
      background: linear-gradient(135deg, #ff6b6b, #ee5a52);
      color: white;
      padding: 15px 0;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
      position: sticky;
      top: 0;
      z-index: 99;
    }
    .container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 0 20px;
    }
    .header-content {
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
    }
    .logo-area {
      display: flex;
      align-items: center;
      gap: 10px;
    }
    .logo-area img {
      width: 50px;
      height: 50px;
      border-radius: 50%;
    }
    .logo-area span {
      font-size: 2.2rem;
      font-weight: bold;
      color: white;
    }
    .user-actions {
      display: flex;
      align-items: center;
      gap: 20px;
    }
    .action-btn {
      background: rgba(255,255,255,0.2);
      border: 2px solid rgba(255,255,255,0.3);
      color: white;
      padding: 8px 15px;
      border-radius: 20px;
      text-decoration: none;
      position: relative;
      cursor: pointer;
    }
    .count-badge {
      position: absolute;
      top: -5px;
      right: -5px;
      background: #fff;
      color: #ff6b6b;
      border-radius: 50%;
      width: 20px;
      height: 20px;
      font-size: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: bold;
    }
    .nav-menu {
      background: rgba(255,255,255,0.1);
      padding: 10px 0;
      margin-top: 10px;
    }
    .nav-links {
      display: flex;
      gap: 30px;
      flex-wrap: wrap;
    }
    .nav-link {
      color: white;
      text-decoration: none;
      font-weight: 500;
      position: relative;
    }
    .nav-link.active::after {
      content: '';
      position: absolute;
      bottom: -4px;
      left: 0;
      width: 100%;
      height: 3px;
      background-color: white;
      border-radius: 2px;
    }
    .dropdown {
      position: relative;
    }
    .dropdown-menu {
      display: none;
      position: absolute;
      background: white;
      top: 100%;
      left: 0;
      padding: 15px;
      box-shadow: 0 8px 16px rgba(0,0,0,0.15);
      border-radius: 10px;
      z-index: 999;
      min-width: 220px;
    }
    .dropdown:hover .dropdown-menu {
      display: block;
    }
    .dropdown-menu a {
      display: block;
      padding: 8px 12px;
      text-decoration: none;
      color: #333;
      font-weight: 500;
    }
    .dropdown-menu a:hover {
      background: #f0f0f0;
    }
    .product-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 30px;
      padding: 40px 20px;
    }
    .product-card {
      background-color: #fff;
      border-radius: 16px;
      overflow: hidden;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      transition: transform 0.3s ease;
      text-align: center;
    }
    .product-card:hover {
      transform: translateY(-8px);
    }
    .product-card img {
      width: 100%;
      height: 300px;
      object-fit: cover;
    }
    .product-info {
      padding: 15px;
    }
    .product-name {
      font-size: 1.1rem;
      font-weight: bold;
      margin-bottom: 8px;
    }
    .product-price {
      color: #ff6b6b;
      font-size: 1rem;
      font-weight: bold;
    }
    .product-section { display: none; }
    .product-section.active { display: block; }
  </style>
  <script>
    function showCategory(id) {
      document.querySelectorAll('.product-section').forEach(section => {
        section.classList.remove('active');
      });
      document.getElementById(id).classList.add('active');
    }
  </script>
</head>
<body>
  <header class="header">
    <div class="container">
      <div class="header-content">
        <div class="logo-area">
          <img src="img/logo.png" alt="Logo">
          <span>RYNÉ</span>
        </div>
        <div class="user-actions">
          <a href="love.php" class="action-btn">
            <i class="fas fa-heart"></i></a>
          <a href="keranjang.php" class="action-btn">
            <i class="fas fa-shopping-cart"></i></a>
        </div>
      </div>
      <nav class="nav-menu">
        <div class="nav-links">
          <a href="beranda.php" class="nav-link">BERANDA</a>
          <div class="dropdown">
            <a href="#" class="nav-link active">PRODUK</a>
            <div class="dropdown-menu">
              <a href="#" onclick="showCategory('kategori-pakaian')">Pakaian</a>
              <a href="#" onclick="showCategory('kategori-makeup')">Makeup</a>
              <a href="#" onclick="showCategory('kategori-sepatu')">Sepatu</a>
              <a href="#" onclick="showCategory('kategori-skincare')">Skincare</a>
              <a href="#" onclick="showCategory('kategori-aksesoris')">Aksesoris</a>
              <a href="#" onclick="showCategory('kategori-tas')">Tas</a>
            </div>
          </div>
          <a href="profile.php" class="nav-link">PROFILE</a>
        </div>
      </nav>
    </div>
  </header>

  <div class="container">
    <div id="kategori-pakaian" class="product-section active">
      <h2>Kategori: Pakaian</h2>
      <div class="product-grid">
        <a href="detail_produk.php?id=1" class="product-card">
          <img src="img/atasan1.jpg"><div class="product-info">
            <div class="product-name">Rajut</div>
            <div class="product-price">Rp 385.000</div></div></a>
        <a href="detail_produk.php?id=2" class="product-card"><img src="img/atasan2.jpg"><div class="product-info"><div class="product-name">Kemeja</div><div class="product-price">Rp 420.000</div></div></a>
        <a href="detail_produk.php?id=3" class="product-card"><img src="img/jas1.jpg"><div class="product-info"><div class="product-name">Jas Formal</div><div class="product-price">Rp 710.000</div></div></a>
        <a href="detail_produk.php?id=4" class="product-card"><img src="img/jas2.jpg"><div class="product-info"><div class="product-name">Jas Kantor</div><div class="product-price">Rp 810.000</div></div></a>
        <a href="detail_produk.php?id=5" class="product-card"><img src="img/oneset1.jpg"><div class="product-info"><div class="product-name">Oneset Formal</div><div class="product-price">Rp 1.160.000</div></div></a>
        <a href="detail_produk.php?id=6" class="product-card"><img src="img/oneset2.jpg"><div class="product-info"><div class="product-name">Oneset Casual</div><div class="product-price">Rp 1.115.000</div></div></a>

      </div>
    </div>

    <div id="kategori-makeup" class="product-section">
      <h2>Kategori: Makeup</h2>
      <div class="product-grid">
        <a href="detail_produk.php?id=7" class="product-card"><img src="img/makeup1.jpg"><div class="product-info"><div class="product-name">Lipstick</div><div class="product-price">Rp 535.000</div></div></a>
        <a href="detail_produk.php?id=8" class="product-card"><img src="img/makeup2.jpg"><div class="product-info"><div class="product-name">Eyeshadow</div><div class="product-price">Rp 590.000</div></div></a>
        <a href="detail_produk.php?id=9" class="product-card"><img src="img/makeup3.jpg"><div class="product-info"><div class="product-name">YSL Cushion</div><div class="product-price">Rp 735.000</div></div></a>
        <a href="detail_produk.php?id=10" class="product-card"><img src="img/makeup4.jpg"><div class="product-info"><div class="product-name">Chanel Blush On</div><div class="product-price">Rp 990.000</div></div></a>
        <a href="detail_produk.php?id=11" class="product-card"><img src="img/makeup5.jpg"><div class="product-info"><div class="product-name">Lipstick Burberri</div><div class="product-price">Rp 435.000</div></div></a>
        <a href="detail_produk.php?id=12" class="product-card"><img src="img/makeup6.jpg"><div class="product-info"><div class="product-name">Celine Parfume</div><div class="product-price">Rp 560.000</div></div></a>  

      </div>
    </div>

    <div id="kategori-sepatu" class="product-section">
      <h2>Kategori: Sepatu</h2>
      <div class="product-grid">
        <a href="detail_produk.php?id=13" class="product-card"><img src="img/sepatu1.jpg"><div class="product-info"><div class="product-name">Prada Heals</div><div class="product-price">Rp 3.140.000</div></div></a>
        <a href="detail_produk.php?id=14" class="product-card"><img src="img/sepatu2.jpg"><div class="product-info"><div class="product-name">YSL Heals</div><div class="product-price">Rp 5.200.000</div></div></a>
        <a href="detail_produk.php?id=15" class="product-card"><img src="img/sepatu3.jpg"><div class="product-info"><div class="product-name">Ammara Heals</div><div class="product-price">Rp 1.140.000</div></div></a>
        <a href="detail_produk.php?id=16" class="product-card"><img src="img/sepatu4.jpg"><div class="product-info"><div class="product-name">Jimmy Choo Heals</div><div class="product-price">Rp 2.200.000</div></div></a>
        <a href="detail_produk.php?id=17" class="product-card"><img src="img/sepatu5.jpg"><div class="product-info"><div class="product-name">Adidas Samba</div><div class="product-price">Rp 2.240.000</div></div></a>
        <a href="detail_produk.php?id=18" class="product-card"><img src="img/sepatu6.jpg"><div class="product-info"><div class="product-name">Sovella Shoes</div><div class="product-price">Rp 800.000</div></div></a>
      </div>
    </div>

    <div id="kategori-skincare" class="product-section">
      <h2>Kategori: Skincare</h2>
      <div class="product-grid">
        <a href="detail_produk.php?id=19" class="product-card"><img src="img/skin1.jpg"><div class="product-info"><div class="product-name">Serum The Ordinary</div><div class="product-price">Rp 298.000</div></div></a>
        <a href="detail_produk.php?id=20" class="product-card"><img src="img/skin2.jpg"><div class="product-info"><div class="product-name">Moisturizer Bemubeep</div><div class="product-price">Rp 375.000</div></div></a>
        <a href="detail_produk.php?id=21" class="product-card"><img src="img/skin3.jpg"><div class="product-info"><div class="product-name">Toner Anua</div><div class="product-price">Rp 308.000</div></div></a>
        <a href="detail_produk.php?id=22" class="product-card"><img src="img/skin4.jpg"><div class="product-info"><div class="product-name">Peeling Serum Skintific</div><div class="product-price">Rp 175.000</div></div></a>
        <a href="detail_produk.php?id=23" class="product-card"><img src="img/skin5.jpg"><div class="product-info"><div class="product-name">Centella Madagascar</div><div class="product-price">Rp 900.000</div></div></a>
        <a href="detail_produk.php?id=24" class="product-card"><img src="img/skin6.jpg"><div class="product-info"><div class="product-name">Facial Essence SK-II</div><div class="product-price">Rp 999.000</div></div></a>
      </div>
    </div>

    <div id="kategori-aksesoris" class="product-section">
      <h2>Kategori: Aksesoris</h2>
      <div class="product-grid">
        <a href="detail_produk.php?id=25" class="product-card"><img src="img/acc1.jpg"><div class="product-info"><div class="product-name">Pandora Earrings</div><div class="product-price">Rp 2.130.000</div></div></a>
        <a href="detail_produk.php?id=26" class="product-card"><img src="img/acc2.jpg"><div class="product-info"><div class="product-name">The Palace Ring</div><div class="product-price">Rp 4.175.000</div></div></a>
        <a href="detail_produk.php?id=27" class="product-card"><img src="img/acc3.jpg"><div class="product-info"><div class="product-name">Celine Belt</div><div class="product-price">Rp 130.000</div></div></a>
        <a href="detail_produk.php?id=28" class="product-card"><img src="img/acc4.jpg"><div class="product-info"><div class="product-name">Dior Sunglasses</div><div class="product-price">Rp 2.175.000</div></div></a>
        <a href="detail_produk.php?id=29" class="product-card"><img src="img/acc5.jpg"><div class="product-info"><div class="product-name">Ribbon</div><div class="product-price">Rp 130.000</div></div></a>
        <a href="detail_produk.php?id=30" class="product-card"><img src="img/acc6.jpg"><div class="product-info"><div class="product-name">Hair Claw</div><div class="product-price">Rp 175.000</div></div></a>
      </div>
    </div>

    <div id="kategori-tas" class="product-section">
      <h2>Kategori: Tas</h2>
      <div class="product-grid">
        <a href="detail_produk.php?id=31" class="product-card"><img src="img/tas1.jpg"><div class="product-info"><div class="product-name">Zara HandBag</div><div class="product-price">Rp 3.130.000</div></div></a>
        <a href="detail_produk.php?id=32" class="product-card"><img src="img/tas2.jpg"><div class="product-info"><div class="product-name">Jims Honey Bag</div><div class="product-price">Rp 1.175.000</div></div></a>
        <a href="detail_produk.php?id=33" class="product-card"><img src="img/tas3.jpg"><div class="product-info"><div class="product-name">Charles & Keith Shoulder Bag</div><div class="product-price">Rp 2.200.000</div></div></a>
        <a href="detail_produk.php?id=34" class="product-card"><img src="img/tas4.jpg"><div class="product-info"><div class="product-name">Girls Heart Bags</div><div class="product-price">Rp 999.000</div></div></a>
        <a href="detail_produk.php?id=35" class="product-card"><img src="img/tas5.jpg"><div class="product-info"><div class="product-name">Coach Sling Bag</div><div class="product-price">Rp 6.120.000</div></div></a>
        <a href="detail_produk.php?id=36" class="product-card"><img src="img/tas6.jpg"><div class="product-info"><div class="product-name">Mossdom Shoulder Bag</div><div class="product-price">Rp 300.000</div></div></a>
      </div>
    </div>
  </div>
</body>
</html>
