<?php
session_start();
include 'config.php';
$site_title = "RYNÉ";


// Tangani konfirmasi logout
if (isset($_POST['logout_confirm'])) {
  session_destroy();
  header("Location: index.php");
  exit;
}

if (isset($_POST['logout_request'])) {
  echo '
  <!DOCTYPE html>
  <html lang="id">
  <head>
    <meta charset="UTF-8">
    <title>Konfirmasi Logout</title>
    <style>
      body {
        font-family: Arial, sans-serif;
        background: #f8f9fa;
        display: flex;
        height: 100vh;
        align-items: center;
        justify-content: center;
      }
      .box {
        background: white;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(0,0,0,0.1);
        text-align: center;
      }
      button {
        padding: 10px 20px;
        margin: 10px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-size: 16px;
      }
      .yes { background-color: #ff6b6b; color: white; }
      .no { background-color: #ddd; }
    </style>
  </head>
  <body>
    <div class="box">
      <h2>Yakin ingin logout?</h2>
      <form method="post">
        <button type="submit" name="logout_confirm" class="yes">Ya, Logout</button>
        <a href="beranda.php"><button type="button" class="no">Tidak</button></a>
      </form>
    </div>
  </body>
  </html>';
  exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title><?= $site_title ?> - Beranda</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body {
      font-family: Arial, sans-serif;
      background-color: #f8f9fa;
      position: relative;
      min-height: 100vh;
    }
    .animated-background {
      position: fixed;
      top: 0; left: 0;
      width: 100%; height: 100%;
      z-index: -1;
      background-size: cover;
      background-repeat: no-repeat;
      background-position: center;
      animation: slideshow 8s infinite;
      opacity: 0.35;
    }
    @keyframes slideshow {
      0% { background-image: url("img/gambar1.jpg"); }
      33% { background-image: url("img/gambar2.jpg"); }
      66% { background-image: url("img/gambar3.jpeg"); }
      100% { background-image: url("img/gambar1.jpg"); }
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
    .product-grid {
  display: grid;
  grid-template-columns: repeat(2, 1fr); /* 2 kolom */
  justify-items: stretch;
  gap: 30px;
  padding: 40px 20px;
}

@media (max-width: 768px) {
  .product-grid {
    grid-template-columns: 1fr; /* 1 kolom di layar kecil */
  }
}

.product-card {
  width: 100%;
  background-color: #fff;
  border-radius: 16px;
  overflow: hidden;
  box-shadow: 0 4px 12px rgba(0,0,0,0.1);
  transition: transform 0.3s ease;
  cursor: pointer;
  text-align: center;
}

    }
    .product-card:hover { transform: translateY(-8px); }
    .product-card img {
      width: 100%;
      height: 400px;
      object-fit: cover;
      transition: transform 0.4s ease;
    }
    .product-card:hover img { transform: scale(1.05); }
    .product-info {
      padding: 15px;
    }
    .product-name {
      font-size: 1.1rem;
      font-weight: bold;
      margin-bottom: 8px;
      color: #333;
    }
    .product-price {
      color: #ff6b6b;
      font-size: 1rem;
      font-weight: bold;
    }
  </style>
</head>
<body>
  <div class="animated-background"></div>
  <header class="header">
    <div class="container">
      <div class="header-content">
        <div class="logo-area">
          <img src="img/logo.png" alt="Logo">
          <span>RYNÉ</span>
        </div>
        <div class="user-actions">
          <a href="love.php" class="action-btn">
            <i class="fas fa-heart"></i>
          </a>
          <a href="keranjang.php" class="action-btn">
            <i class="fas fa-shopping-cart"></i>
          </a>
          <form method="post" style="display:inline;">
            <button type="submit" name="logout_request" class="action-btn" style="background:#fff; color:#ff6b6b;">
              <i class="fas fa-sign-out-alt"></i> Logout
            </button>
          </form>
        </div>
      </div>
      <nav class="nav-menu">
        <div class="nav-links">
          <a href="beranda.php" class="nav-link active">BERANDA</a>
          <a href="produk.php" class="nav-link">PRODUK</a>
          <a href="profile.php" class="nav-link">PROFILE</a>
        </div>
      </nav>
    </div>
  </header>

  <div class="container">
    <div class="product-grid">
      <?php
      $produk = [
        ["id"=>1,"img"=>"atasan1.jpg","nama"=>"Rajut Unisex","harga"=>"385.000"],
        ["id"=>2,"img"=>"atasan2.jpg","nama"=>"Kemeja Polos","harga"=>"420.000"],
        ["id"=>3,"img"=>"makeup1.jpg","nama"=>"Lipstick Naming","harga"=>"535.000"],
        ["id"=>4,"img"=>"makeup2.jpg","nama"=>"Dasique","harga"=>"590.000"],
        ["id"=>5,"img"=>"oneset1.jpg","nama"=>"Korean Oneset","harga"=>"1.160.000"],
        ["id"=>6,"img"=>"oneset2.jpg","nama"=>"Embo Blouse & Skirt","harga"=>"1.115.000"],
      ];
      foreach ($produk as $p) {
        echo '<a href="detail_produk.php?id='.$p["id"].'" class="product-card">
                <img src="img/'.$p["img"].'" alt="'.$p["nama"].'">
                <div class="product-info">
                  <div class="product-name">'.$p["nama"].'</div>
                  <div class="product-price">Rp '.$p["harga"].'</div>
                </div>
              </a>';
      }
      ?>
    </div>
  </div>
</body>
</html>
