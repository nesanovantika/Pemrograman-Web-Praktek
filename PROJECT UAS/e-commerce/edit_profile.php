<?php
session_start();
include 'config.php';

// Pastikan user sudah login
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit;
}

$user_id = $_SESSION['user_id'];
$success = '';
$error = '';

// Ambil data user
$stmt = $conn->prepare("SELECT name, email FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

// Jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $new_name = trim($_POST['name']);
  $new_email = trim($_POST['email']);

  // Validasi sederhana
  if ($new_name === '' || $new_email === '') {
    $error = "Nama dan email tidak boleh kosong.";
  } else {
    $update = $conn->prepare("UPDATE users SET name = ?, email = ? WHERE id = ?");
    $update->bind_param("ssi", $new_name, $new_email, $user_id);
    if ($update->execute()) {
      $success = "✅ Profil berhasil diperbarui.";
      $user['name'] = $new_name;
      $user['email'] = $new_email;
    } else {
      $error = "❌ Gagal memperbarui profil.";
    }
  }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Profil - RYNÉ</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      padding: 40px;
    }
    .container {
      background: white;
      max-width: 500px;
      margin: auto;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    h2 { text-align: center; margin-bottom: 20px; }
    label { display: block; margin-top: 15px; font-weight: bold; }
    input[type="text"], input[type="email"] {
      width: 100%; padding: 10px;
      margin-top: 5px;
      border-radius: 6px;
      border: 1px solid #ccc;
    }
    button {
      margin-top: 20px;
      padding: 12px;
      background-color: #ff6b6b;
      color: white;
      border: none;
      border-radius: 6px;
      width: 100%;
      font-size: 16px;
      cursor: pointer;
    }
    .back-link {
      display: block;
      text-align: center;
      margin-top: 20px;
      color: #555;
      text-decoration: underline;
    }
    .message {
      text-align: center;
      padding: 10px;
      margin-top: 15px;
      border-radius: 6px;
    }
    .success { background: #e0ffeb; color: #2e7d32; }
    .error { background: #ffe0e0; color: #b71c1c; }
  </style>
</head>
<body>

<div class="container">
  <h2>Edit Profil</h2>

  <?php if ($success): ?>
    <div class="message success"><?= $success ?></div>
  <?php endif; ?>
  <?php if ($error): ?>
    <div class="message error"><?= $error ?></div>
  <?php endif; ?>

  <form method="POST">
    <label for="name">Nama Lengkap:</label>
    <input type="text" name="name" id="name" value="<?= htmlspecialchars($user['name']) ?>" required>

    <label for="email">Alamat Email:</label>
    <input type="email" name="email" id="email" value="<?= htmlspecialchars($user['email']) ?>" required>

    <button type="submit">Simpan Perubahan</button>
  </form>

  <a href="profile.php" class="back-link">← Kembali ke Profil</a>
</div>

</body>
</html>
