<?php
ob_start(); // Hidupkan buffer output
session_start();

$nama = $_POST['admin_nama'] ?? '';
$password = $_POST['admin_password'] ?? '';

// Ganti dengan data admin yang kamu inginkan
$admin_nama_benar = 'admin';
$admin_password_benar = 'admin123';

if ($nama === $admin_nama_benar && $password === $admin_password_benar) {
    $_SESSION['is_admin'] = true;
    $_SESSION['admin_nama'] = $nama;
    
    header("Location: kelola_produk.php");
    exit;
} else {
    echo "<script>alert('Nama atau Password salah!'); window.location='admin_login.php';</script>";
    exit;
}

ob_end_flush(); // Kirim semua output ke browser