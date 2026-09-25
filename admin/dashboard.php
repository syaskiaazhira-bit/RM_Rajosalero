<?php

session_start();

if(!isset($_SESSION['admin_id'])){
    header("Location: login.php");
    exit;
}

require_once 'database.php';

$admin_username = $_SESSION['admin_username'] ?? 'Admin';


// ==========================
// DATA DASHBOARD
// ==========================


// TOTAL PESANAN HARI INI
$total_pesanan = mysqli_fetch_assoc(
    mysqli_query($conn,"
        SELECT COUNT(*) total
        FROM pesanan
        WHERE DATE(created_at)=CURDATE()
    ")
)['total'] ?? 0;



// PENDAPATAN HARI INI
$pendapatan = mysqli_fetch_assoc(
    mysqli_query($conn,"
        SELECT SUM(total_harga) total
        FROM pesanan
        WHERE DATE(created_at)=CURDATE()
        AND status='Selesai'
    ")
)['total'] ?? 0;



// TOTAL MENU
$total_menu = mysqli_fetch_assoc(
    mysqli_query($conn,"
        SELECT COUNT(*) total
        FROM menu
    ")
)['total'] ?? 0;



// TOTAL BAHAN
$total_bahan = mysqli_fetch_assoc(
    mysqli_query($conn,"
        SELECT COUNT(*) total
        FROM bahan_baku
    ")
)['total'] ?? 0;



// STATUS PESANAN

$menunggu = mysqli_fetch_assoc(
    mysqli_query($conn,"
        SELECT COUNT(*) total
        FROM pesanan
        WHERE status='Menunggu'
    ")
)['total'] ?? 0;


$diproses = mysqli_fetch_assoc(
    mysqli_query($conn,"
        SELECT COUNT(*) total
        FROM pesanan
        WHERE status='Diproses'
    ")
)['total'] ?? 0;


$selesai = mysqli_fetch_assoc(
    mysqli_query($conn,"
        SELECT COUNT(*) total
        FROM pesanan
        WHERE status='Selesai'
    ")
)['total'] ?? 0;



// PESANAN TERBARU

$pesanan_baru = mysqli_query(
    $conn,
    "
    SELECT *
    FROM pesanan
    ORDER BY created_at DESC
    LIMIT 5
    "
);


?>


<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>
Dashboard Admin | RM Rajo Salero
</title>


<link rel="stylesheet" href="dashboard.css">


</head>


<body>


<div class="admin-layout">


<?php include 'sidebar.php'; ?>



<main class="main-content">



<!-- HEADER -->

<header class="topbar">

<div>

<p class="breadcrumb">
Admin / Dashboard
</p>


<h1>
Dashboard
</h1>


<p class="welcome">
Selamat datang kembali, <?= htmlspecialchars($admin_username); ?>
</p>


</div>


<div class="topbar-date">

<span>
Hari Ini
</span>

<strong>
<?= date('d M Y'); ?>
</strong>


</div>


</header>





<!-- SUMMARY -->


<section class="summary-grid">


<div class="summary-card red">


<div class="summary-icon">
🧾
</div>


<div>

<span>
Total Pesanan
</span>


<strong>
<?= $total_pesanan ?>
</strong>


<small>
Pesanan hari ini
</small>


</div>


</div>





<div class="summary-card gold">


<div class="summary-icon">
💰
</div>


<div>

<span>
Pendapatan
</span>


<strong>
Rp<?= number_format($pendapatan,0,",","."); ?>
</strong>


<small>
Hari ini
</small>


</div>


</div>






<div class="summary-card green">


<div class="summary-icon">
🍽
</div>


<div>

<span>
Total Menu
</span>


<strong>
<?= $total_menu ?>
</strong>


<small>
Menu tersedia
</small>


</div>


</div>





<div class="summary-card orange">


<div class="summary-icon">
📦
</div>


<div>

<span>
Bahan Baku
</span>


<strong>
<?= $total_bahan ?>
</strong>


<small>
Data stok
</small>


</div>


</div>


</section>





<!-- CONTENT -->

<section class="content-grid">



<!-- PESANAN TERBARU -->


<div class="dashboard-card large">


<div class="card-header">


<div>

<h2>
Pesanan Terbaru
</h2>


<p>
Daftar pesanan terbaru pelanggan
</p>


</div>


<a href="pesanan.php" class="view-all">
Lihat Semua
</a>


</div>




<div class="order-container">


<?php if(mysqli_num_rows($pesanan_baru)>0): ?>


<?php while($row=mysqli_fetch_assoc($pesanan_baru)): ?>


<div class="order-card">


<div class="order-user">


<h3>
<?= htmlspecialchars($row['nama_pelanggan']); ?>
</h3>


<p>
📞 <?= htmlspecialchars($row['nomor_hp']); ?>
</p>


</div>



<div class="order-info">


<span class="order-status">

<?= htmlspecialchars($row['status']); ?>

</span>



<h4>
Rp<?= number_format($row['total_harga'],0,",","."); ?>
</h4>



</div>


</div>


<?php endwhile; ?>


<?php else: ?>


<div class="empty-state">

<div class="empty-icon">
🧾
</div>


<h3>
Belum ada pesanan
</h3>


<p>
Pesanan pelanggan akan muncul disini
</p>


</div>


<?php endif; ?>


</div>


</div>





<!-- STATUS PESANAN -->


<div class="dashboard-card">


<div class="card-header">


<div>

<h2>
Status Pesanan
</h2>


<p>
Ringkasan pesanan hari ini
</p>


</div>


</div>





<div class="status-list">


<div class="status-row">

<span>
<i class="status-dot pending"></i>
Menunggu
</span>

<strong>
<?= $menunggu ?>
</strong>

</div>



<div class="status-row">

<span>
<i class="status-dot process"></i>
Diproses
</span>

<strong>
<?= $diproses ?>
</strong>

</div>




<div class="status-row">

<span>
<i class="status-dot done"></i>
Selesai
</span>

<strong>
<?= $selesai ?>
</strong>

</div>



</div>


</div>



</section>

<!-- AKSES CEPAT -->

<section class="dashboard-card quick-card">


<div class="card-header">

<div>

<h2>
Akses Cepat
</h2>


<p>
Kelola sistem RM Rajo Salero dengan cepat
</p>


</div>


</div>




<div class="quick-grid">


<a href="produk.php" class="quick-item">

<span>
🍽
</span>

<strong>
Kelola Menu
</strong>

<small>
Tambah dan edit menu
</small>


</a>





<a href="pesanan.php" class="quick-item">

<span>
🧾
</span>

<strong>
Pesanan
</strong>

<small>
Lihat pesanan masuk
</small>


</a>





<a href="bahan_baku.php" class="quick-item">

<span>
📦
</span>

<strong>
Bahan Baku
</strong>

<small>
Kelola stok bahan
</small>


</a>





<a href="keuangan.php" class="quick-item">

<span>
💰
</span>

<strong>
Keuangan
</strong>

<small>
Lihat transaksi
</small>


</a>


</div>


</section>





<footer class="admin-footer">

© 2026 RM Rajo Salero · Admin Management System

</footer>




</main>


</div>



</body>


</html>