<?php
session_start();

// Koneksi ke database
$host = "localhost";
$user = "u965477476_root";
$pass = "Ryneedb1";
$db   = "u965477476_rynee_db";
$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
  die("Koneksi gagal: " . $conn->connect_error);
}

// Tangani form register
$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name     = trim($_POST['name']);
  $email    = trim($_POST['email']);
  $password = trim($_POST['password']);
  $confirm  = trim($_POST['confirm_password']);

  if (!empty($name) && !empty($email) && !empty($password) && $password === $confirm) {
    $hashed = password_hash($password, PASSWORD_DEFAULT);

    // Cek apakah email sudah terdaftar
    $check = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
      $error = "❌ Email sudah terdaftar!";
    } else {
      // Simpan user baru
      $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
      $stmt->bind_param("sss", $name, $email, $hashed);
      if ($stmt->execute()) {
        $_SESSION['register_success'] = "✅ Pendaftaran berhasil! Silakan masuk.";
        header("Location: login.php");
        exit;
      } else {
        $error = "❌ Gagal menyimpan data.";
      }
    }
  } else {
    $error = "⚠️ Pastikan semua kolom diisi dan password cocok.";
  }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar - RYNÉ</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-image: url('img/gambar1.jpg');
      background-size: cover;
      background-position: center;
      height: 100vh;
      margin: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      backdrop-filter: brightness(0.6);
      color: white;
    }
    .form-container {
      background: rgba(0, 0, 0, 0.6);
      padding: 30px 40px;
      border-radius: 10px;
      width: 100%;
      max-width: 400px;
    }
    input, button {
      width: 100%;
      padding: 12px;
      margin-bottom: 15px;
      border-radius: 5px;
      border: none;
      font-size: 16px;
    }
    button {
      background-color: #ff6b6b;
      color: white;
      cursor: pointer;
      transition: 0.3s;
    }
    button:hover { background-color: #ff4c4c; }
    .link { text-align: center; font-size: 14px; }
    .link a { color: #ffdcdc; text-decoration: underline; }
    .error-message {
      background-color: rgba(255, 0, 0, 0.1);
      color: #ffb3b3;
      padding: 10px;
      text-align: center;
      margin-bottom: 15px;
      border-radius: 5px;
      font-size: 14px;
    }
  </style>
</head>
<body>
  <div class="form-container">
    <h2>Daftar Akun RYNÉ</h2>

    <!-- ❌ Tampilkan Error Jika Ada -->
    <?php if (!empty($error)): ?>
      <div class="error-message"><?php echo $error; ?></div>
    <?php endif; ?>

    <!-- 📝 Form Daftar -->
    <form method="POST" action="">
      <input type="text" name="name" placeholder="Nama Lengkap" required>
      <input type="email" name="email" placeholder="Email" required>
      <input type="password" name="password" placeholder="Kata Sandi" required>
      <input type="password" name="confirm_password" placeholder="Ulangi Kata Sandi" required>
      <button type="submit">Daftar</button>
      <div class="link">Sudah punya akun? <a href="login.php">Masuk</a></div>
    </form>
  </div>
</body>
</html>
