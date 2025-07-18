<?php
session_start();

$login_error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['admin_nama'] ?? '';
    $password = $_POST['admin_password'] ?? '';

    // Data admin hardcoded
    $admin_nama_benar = 'admin';
    $admin_password_benar = 'admin123';

    if ($nama === $admin_nama_benar && $password === $admin_password_benar) {
        $_SESSION['is_admin'] = true;
        $_SESSION['admin_nama'] = $nama;
        header("Location: dashboard_admin.php");
        exit;
    } else {
        $login_error = 'Nama atau Password salah!';
    }
}

// Jika admin sudah login, langsung ke dashboard
if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === true) {
    header("Location: dashboard_admin.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Login Admin</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f0f0f0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    .login-box {
      background: white;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      width: 100%;
      max-width: 400px;
    }
    h2 {
      color: #ee5a52;
      text-align: center;
      margin-bottom: 20px;
    }
    input[type="text"], input[type="password"] {
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      border-radius: 5px;
      border: 1px solid #ccc;
    }
    button {
      width: 100%;
      padding: 10px;
      background: #ee5a52;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
    button:hover {
      background: #e04848;
    }
    .error {
      color: red;
      text-align: center;
      margin-bottom: 15px;
    }
  </style>
</head>
<body>
  <div class="login-box">
    <h2>Login Admin</h2>
    <?php if ($login_error): ?>
      <div class="error"><?= htmlspecialchars($login_error) ?></div>
    <?php endif; ?>
    <form method="POST">
      <input type="text" name="admin_nama" placeholder="Nama Admin" required>
      <input type="password" name="admin_password" placeholder="Password Admin" required>
      <button type="submit">Masuk</button>
    </form>
  </div>
</body>
</html>
