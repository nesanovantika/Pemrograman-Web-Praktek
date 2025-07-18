<?php
$site_title = "RYNÉ";
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title><?php echo $site_title; ?> - Ecommerce</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Arial', sans-serif;
      background-color: #f8f9fa;
      position: relative;
      z-index: 0;
      overflow-x: hidden;
    }

    .animated-background {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: -1;
      background-size: cover;
      background-repeat: no-repeat;
      background-position: center;
      animation: slideshow 12s infinite;
      opacity: 0.35;
    }

    @keyframes slideshow {
      0% { background-image: url('img/gambar1.jpg'); }
      33% { background-image: url('img/gambar2.jpg'); }
      66% { background-image: url('img/gambar3.jpeg'); }
      100% { background-image: url('img/gambar1.jpg'); }
    }

    .header {
      background: linear-gradient(135deg, #ff6b6b, #ee5a52);
      color: white;
      padding: 15px 0;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
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
      gap: 20px;
    }

    .logo-brand {
      display: flex;
      align-items: center;
      gap: 10px;
      text-decoration: none;
    }

    .logo-brand img {
      height: 60px;
    }

    .logo-text {
      font-size: 2.2rem;
      font-weight: bold;
      color: white;
    }

    .user-actions {
      position: relative;
    }

    .action-btn {
      background: rgba(255,255,255,0.2);
      border: 2px solid rgba(255,255,255,0.3);
      color: white;
      padding: 8px 15px;
      border-radius: 20px;
      text-decoration: none;
      transition: all 0.3s ease;
      cursor: pointer;
    }

    .action-btn:hover {
      background: rgba(255,255,255,0.3);
      transform: translateY(-2px);
    }

    .dropdown-menu {
      position: absolute;
      right: 0;
      top: 110%;
      background-color: white;
      border-radius: 10px;
      box-shadow: 0 5px 12px rgba(0,0,0,0.1);
      overflow: hidden;
      display: none;
      flex-direction: column;
      z-index: 999;
      min-width: 150px;
    }

    .dropdown-menu a {
      padding: 10px 15px;
      color: #333;
      text-decoration: none;
      transition: background 0.3s;
      font-weight: 500;
    }

    .dropdown-menu a:hover {
      background-color: #f3f3f3;
    }

    .user-actions:hover .dropdown-menu {
      display: flex;
    }

    .main-content {
      margin-top: 80px;
      min-height: 350px;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-direction: column;
      text-align: center;
      padding: 0 20px;
      color: #333;
      animation: fadeIn 1.5s ease-in-out;
    }

    .main-content h1 {
      font-size: 3rem;
      margin-bottom: 10px;
      color: #ee5a52;
    }

    .main-content p {
      font-size: 1.2rem;
      max-width: 600px;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    @media (max-width: 768px) {
      .header-content {
        flex-direction: column;
        text-align: center;
      }

      .main-content h1 {
        font-size: 2.2rem;
      }

      .main-content p {
        font-size: 1rem;
      }
    }
  </style>
</head>
<body>

<!-- 🔁 Background Slideshow -->
<div class="animated-background"></div>

<!-- 🔰 Header -->
<header class="header">
  <div class="container">
    <div class="header-content">
      <a href="#" class="logo-brand">
        <img src="img/logo.png" alt="Logo">
        <span class="logo-text">RYNÉ</span>
      </a>
      <div class="user-actions">
        <div class="action-btn">
          <i class="fas fa-user"></i> Akun
        </div>
        <div class="dropdown-menu">
          <a href="login.php">Masuk</a>
          <a href="register.php">Daftar</a>
          <a href="admin_login.php">Admin</a>
        </div>
      </div>
    </div>
  </div>
</header>

<!-- 🔰 Main Content -->
<div class="container">
  <div class="main-content">
    <h1>Selamat Datang di RYNÉ</h1>
    <p>Temukan gaya dan produk favoritmu. Silakan login atau daftar untuk memulai pengalaman berbelanja yang menyenangkan!</p>
  </div>
</div>

</body>
</html>
