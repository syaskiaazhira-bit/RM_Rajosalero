<?php

session_start();

if(!isset($_SESSION['admin_id'])){
    header("Location: login.php");
    exit;
}

require_once 'database.php';


// TOTAL PESANAN
$total = mysqli_fetch_assoc(
    mysqli_query($conn,"
    SELECT COUNT(*) total 
    FROM pesanan
    ")
)['total'];


// MENUNGGU
$menunggu = mysqli_fetch_assoc(
    mysqli_query($conn,"
    SELECT COUNT(*) total 
    FROM pesanan 
    WHERE status='Menunggu'
    ")
)['total'];


// SELESAI
$selesai = mysqli_fetch_assoc(
    mysqli_query($conn,"
    SELECT COUNT(*) total 
    FROM pesanan 
    WHERE status='Selesai'
    ")
)['total'];


// DATA PEMBAYARAN
$data = mysqli_query(
    $conn,
    "
    SELECT * FROM pesanan
    ORDER BY created_at DESC
    "
);


?>


<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">
<title>Pembayaran | RM Rajo Salero</title>

<link rel="stylesheet" href="dashboard.css">
<link rel="stylesheet" href="pembayaran.css">

</head>


<body>


<div class="admin-layout">


<?php include 'sidebar.php'; ?>



<main class="main-content">


<header class="topbar">

<p class="breadcrumb">
Admin / Pembayaran
</p>


<h1>
Manajemen Pembayaran
</h1>


<p class="welcome">
Kelola pembayaran pelanggan RM Rajo Salero.
</p>


</header>




<section class="summary-grid">


<div class="summary-card">

<span>
Total Transaksi
</span>

<strong>
<?= $total ?>
</strong>

</div>



<div class="summary-card">

<span>
Menunggu
</span>

<strong>
<?= $menunggu ?>
</strong>

</div>



<div class="summary-card">

<span>
Selesai
</span>

<strong>
<?= $selesai ?>
</strong>

</div>



</section>






<section class="table-wrapper">


<div class="table-header">

<h2>
Daftar Pembayaran
</h2>


</div>




<table class="payment-table">


<thead>

<tr>

<th>No</th>

<th>Pelanggan</th>

<th>Metode</th>

<th>Total</th>

<th>Status</th>

<th>Aksi</th>

</tr>

</thead>



<tbody>


<?php

$no=1;

while($row=mysqli_fetch_assoc($data)):

?>


<tr>


<td>
<?= $no++; ?>
</td>



<td>

<b>
<?= htmlspecialchars($row['nama_pelanggan']); ?>
</b>

<br>

<?= $row['nomor_hp']; ?>

</td>



<td>

<?= $row['metode_pembayaran']; ?>

</td>



<td>

Rp<?= number_format($row['total_harga'],0,',','.'); ?>

</td>



<td>


<?php if($row['status']=="Selesai"): ?>


<span class="status-lunas">
Lunas
</span>


<?php elseif($row['status']=="Menunggu"): ?>


<span class="status-menunggu">
Menunggu
</span>


<?php else: ?>


<span class="status-batal">
Dibatalkan
</span>


<?php endif; ?>


</td>



<td>


<?php if($row['status']=="Menunggu"): ?>


<a 
href="konfirmasi_bayar.php?id=<?= $row['id']; ?>"
class="btn-konfirmasi">

Konfirmasi

</a>


<?php else: ?>


<button class="btn-disabled">

Selesai

</button>


<?php endif; ?>


</td>



</tr>


<?php endwhile; ?>


</tbody>


</table>


</section>



<footer class="admin-footer">

© 2026 RM Rajo Salero · Admin Management System

</footer>



</main>


</div>


</body>

</html>