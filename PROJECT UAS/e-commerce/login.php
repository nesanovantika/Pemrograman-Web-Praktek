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

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = trim($_POST['email']);
  $password = trim($_POST['password']);

  $stmt = $conn->prepare("SELECT id, name, email, password FROM users WHERE email = ?");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
    
    if (password_verify($password, $user['password'])) {
      $_SESSION['user_id']    = $user['id'];
      $_SESSION['user_nama']  = $user['name'];
      $_SESSION['user_email'] = $user['email'];
      header("Location: beranda.php");
      exit;
    } else {
      $error = "❌ Kata sandi salah!";
    }
  } else {
    $error = "❌ Email tidak ditemukan!";
  }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Masuk - RYNÉ</title>
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
    .success-message {
      background-color: rgba(0, 255, 0, 0.1);
      color: #a1ffaf;
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
    <h2>Masuk ke RYNÉ</h2>

    <?php if (isset($_SESSION['register_success'])): ?>
      <div class="success-message"><?php echo $_SESSION['register_success']; unset($_SESSION['register_success']); ?></div>
    <?php endif; ?>

    <?php if (!empty($error)): ?>
      <div class="error-message"><?php echo $error; ?></div>
    <?php endif; ?>

    <form method="POST" action="">
      <input type="email" name="email" placeholder="Email" required>
      <input type="password" name="password" placeholder="Kata Sandi" required>
      <button type="submit">Masuk</button>
      <div class="link">Belum punya akun? <a href="register.php">Daftar</a></div>
    </form>
  </div>

  <script>
    setTimeout(() => {
      const notif = document.querySelector('.success-message');
      if (notif) notif.style.display = 'none';
    }, 3000);
  </script>
</body>
</html>
