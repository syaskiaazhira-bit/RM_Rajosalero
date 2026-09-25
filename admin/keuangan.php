<?php

session_start();

if(!isset($_SESSION['admin_id'])){
    header("Location: login.php");
    exit;
}


require_once 'database.php';


// TOTAL PEMASUKAN

$pemasukan = mysqli_fetch_assoc(
    mysqli_query($conn,"
    SELECT SUM(jumlah) total 
    FROM keuangan
    WHERE jenis='Masuk'
    ")
)['total'] ?? 0;



// TOTAL PENGELUARAN

$pengeluaran = mysqli_fetch_assoc(
    mysqli_query($conn,"
    SELECT SUM(jumlah) total 
    FROM keuangan
    WHERE jenis='Keluar'
    ")
)['total'] ?? 0;



// KEUNTUNGAN

$keuntungan = $pemasukan - $pengeluaran;



// DATA KEUANGAN

$data = mysqli_query(
    $conn,
    "
    SELECT * FROM keuangan
    ORDER BY tanggal DESC
    "
);


?>


<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<title>
Keuangan | RM Rajo Salero
</title>


<link rel="stylesheet" href="dashboard.css">

<link rel="stylesheet" href="keuangan.css">


</head>


<body>


<div class="admin-layout">


<?php include 'sidebar.php'; ?>



<main class="main-content">



<header class="topbar">


<div>

<p class="breadcrumb">
Admin / Keuangan
</p>


<h1>
Manajemen Keuangan
</h1>


<p class="welcome">
Kelola pemasukan dan pengeluaran RM Rajo Salero.
</p>


</div>


</header>





<section class="summary-grid">



<div class="summary-card">

<span>
Total Pemasukan
</span>

<strong>
Rp<?= number_format($pemasukan,0,',','.'); ?>
</strong>

</div>




<div class="summary-card">

<span>
Total Pengeluaran
</span>

<strong>
Rp<?= number_format($pengeluaran,0,',','.'); ?>
</strong>

</div>




<div class="summary-card">

<span>
Keuntungan
</span>

<strong>
Rp<?= number_format($keuntungan,0,',','.'); ?>
</strong>

</div>



</section>





<section class="table-wrapper">


<div class="table-header">


<h2>
Riwayat Transaksi
</h2>


<a href="tambah_keuangan.php" class="btn-tambah">

+ Tambah Transaksi

</a>


</div>




<table class="keuangan-table">


<thead>

<tr>

<th>No</th>

<th>Tanggal</th>

<th>Kategori</th>

<th>Keterangan</th>

<th>Jenis</th>

<th>Jumlah</th>

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
<?= date('d-m-Y',strtotime($row['tanggal'])); ?>
</td>



<td>
<?= htmlspecialchars($row['kategori']); ?>
</td>



<td>
<?= htmlspecialchars($row['keterangan']); ?>
</td>




<td>


<?php if($row['jenis']=="Masuk"): ?>


<span class="masuk">

Masuk

</span>



<?php else: ?>


<span class="keluar">

Keluar

</span>



<?php endif; ?>


</td>




<td>

Rp<?= number_format($row['jumlah'],0,',','.'); ?>

</td>




<td>


<a href="edit_keuangan.php?id=<?= $row['id']; ?>" 
class="btn-edit">

Edit

</a>




<a href="hapus_keuangan.php?id=<?= $row['id']; ?>"
class="btn-hapus"
onclick="return confirm('Hapus transaksi ini?')">

Hapus

</a>


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