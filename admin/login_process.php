<?php

session_start();

/*
|--------------------------------------------------------------------------
| DATA LOGIN ADMIN SEMENTARA
|--------------------------------------------------------------------------
| Untuk tahap awal kita gunakan akun statis dulu.
| Nanti setelah database dibuat, bagian ini kita ganti
| dengan pengecekan dari database.
*/

$admin_username = "admin";
$admin_password = "admin123";


$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';


// Cek username dan password
if ($username === $admin_username && $password === $admin_password) {

    // Simpan session admin
    $_SESSION['admin_id'] = 1;
    $_SESSION['admin_username'] = $username;
    $_SESSION['admin_role'] = 'admin';

    // Masuk ke dashboard
    header("Location: dashboard.php");
    exit;

} else {

    // Kalau login salah
    header("Location: login.php?error=1");
    exit;
}