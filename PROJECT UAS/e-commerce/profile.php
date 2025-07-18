<?php
session_start();
include 'config.php';

$site_title = "RYNÉ";

if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit;
}

$user_id = $_SESSION['user_id'];

// Handle logout
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
      body { font-family: Arial; background: #f8f9fa; display: flex; align-items: center; justify-content: center; height: 100vh; }
      .box { background: white; padding: 30px; border-radius: 10px; text-align: center; box-shadow: 0 0 15px rgba(0,0,0,0.1); }
      button { padding: 10px 20px; margin: 10px; border: none; border-radius: 6px; font-size: 16px; cursor: pointer; }
      .yes { background: #ff6b6b; color: white; }
      .no { background: #ddd; }
    </style>
  </head>
  <body>
    <div class="box">
      <h2>Yakin ingin logout?</h2>
      <form method="post">
        <button type="submit" name="logout_confirm" class="yes">Ya, Logout</button>
        <a href="profile.php"><button type="button" class="no">Tidak</button></a>
      </form>
    </div>
  </body>
  </html>';
  exit;
}

// Ambil data user
$stmt = $conn->prepare("SELECT name, email FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();
$stmt->close();

// Ambil hanya tanggal transaksi
$query = "SELECT tanggal FROM transaksi WHERE user_id = ? ORDER BY tanggal DESC";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$tanggal_transaksi = [];
while ($row = $result->fetch_assoc()) {
    $tanggal_transaksi[] = $row['tanggal'];
}
$stmt->close();

// Hitung total transaksi
$total_transaksi = count($tanggal_transaksi);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title><?= $site_title ?> - Profile</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body { font-family: Arial; background: #f8f9fa; min-height: 100vh; position: relative; }
    .animated-background {
      position: fixed; top: 0; left: 0; width: 100%; height: 100%;
      z-index: -1; background-size: cover; background-repeat: no-repeat;
      animation: slideshow 8s infinite; opacity: 0.35;
    }
    @keyframes slideshow {
      0% { background-image: url("img/gambar1.jpg"); }
      33% { background-image: url("img/gambar2.jpg"); }
      66% { background-image: url("img/gambar3.jpeg"); }
      100% { background-image: url("img/gambar1.jpg"); }
    }
    .header { background: linear-gradient(135deg, #ff6b6b, #ee5a52); color: white; padding: 15px 0; box-shadow: 0 2px 10px rgba(0,0,0,0.1); position: sticky; top: 0; z-index: 99; }
    .container { max-width: 1200px; margin: 0 auto; padding: 0 20px; }
    .header-content { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; }
    .logo-area { display: flex; align-items: center; gap: 10px; }
    .logo-area img { width: 50px; height: 50px; border-radius: 50%; }
    .logo-area span { font-size: 2.2rem; font-weight: bold; }
    .nav-links { display: flex; gap: 30px; margin-top: 10px; }
    .nav-link { color: white; text-decoration: none; font-weight: 500; position: relative; }
    .nav-link.active::after { content: ''; position: absolute; bottom: -4px; left: 0; width: 100%; height: 3px; background: white; border-radius: 2px; }
    .action-btn { background: rgba(255,255,255,0.2); border: 2px solid rgba(255,255,255,0.3); color: white; padding: 8px 15px; border-radius: 20px; text-decoration: none; cursor: pointer; }
    .profile-box, .riwayat-box { background: white; border-radius: 12px; padding: 25px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); margin-bottom: 30px; }
    .profile-box h2, .riwayat-box h2 { margin-bottom: 15px; font-size: 1.5rem; }
    .profile-info { margin-bottom: 10px; }
    .profile-actions button { padding: 8px 16px; margin-right: 10px; border: none; border-radius: 6px; background: #ff6b6b; color: white; font-size: 14px; cursor: pointer; }
    table { width: 100%; border-collapse: collapse; }
    th, td { padding: 12px; border-bottom: 1px solid #ddd; text-align: left; }
    th { background: #f2f2f2; }
  </style>
</head>
<body>
  <div class="animated-background"></div>
  <header class="header">
    <div class="container">
      <div class="header-content">
        <div class="logo-area">
          <img src="img/logo.png" alt="Logo"><span>RYNÉ</span>
        </div>
        <form method="post" style="display:inline;">
          <button type="submit" name="logout_request" class="action-btn" style="background:#fff;color:#ff6b6b;">
            <i class="fas fa-sign-out-alt"></i> Logout
          </button>
        </form>
      </div>
      <div class="nav-links">
        <a href="beranda.php" class="nav-link">BERANDA</a>
        <a href="produk.php" class="nav-link">PRODUK</a>
        <a href="profile.php" class="nav-link active">PROFILE</a>
      </div>
    </div>
  </header>

  <div class="container">
    <div class="profile-box">
      <h2>Profil Saya</h2>
      <div class="profile-info"><strong>Nama:</strong> <?= htmlspecialchars($user['name']) ?></div>
      <div class="profile-info"><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></div>
      <div class="profile-actions">
        <a href="edit_profile.php"><button>Edit Profil</button></a>
      </div>
    </div>

    <div class="riwayat-box">
      <h2>Riwayat Pembelian</h2>
      <p><strong>Total Transaksi:</strong> <?= $total_transaksi ?></p>

      <?php if ($total_transaksi > 0): ?>
      <table>
        <thead>
          <tr>
            <th>Tanggal Transaksi</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($tanggal_transaksi as $tanggal): ?>
          <tr>
            <td><?= htmlspecialchars($tanggal) ?></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
      <?php else: ?>
        <p>Belum ada riwayat transaksi.</p>
      <?php endif; ?>
    </div>
  </div>
</body>
</html>
