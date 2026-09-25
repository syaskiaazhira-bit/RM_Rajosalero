<?php

session_start();

if(!isset($_SESSION['admin_id'])){
    header("Location: login.php");
    exit;
}


require_once 'database.php';



// ======================
// RINGKASAN
// ======================


// Penjualan selesai

$penjualan = mysqli_fetch_assoc(
mysqli_query($conn,"
SELECT SUM(total_harga) total
FROM pesanan
WHERE status='Selesai'
")
)['total'] ?? 0;




// pemasukan

$pemasukan = mysqli_fetch_assoc(
mysqli_query($conn,"
SELECT SUM(jumlah) total
FROM keuangan
WHERE jenis='Masuk'
")
)['total'] ?? 0;



// pengeluaran

$pengeluaran = mysqli_fetch_assoc(
mysqli_query($conn,"
SELECT SUM(jumlah) total
FROM keuangan
WHERE jenis='Keluar'
")
)['total'] ?? 0;



$keuntungan = $pemasukan - $pengeluaran;




// ======================
// DATA PENJUALAN
// ======================


$data_penjualan = mysqli_query(
$conn,

"
SELECT *
FROM pesanan
ORDER BY created_at DESC

"
);





// ======================
// DATA KEUANGAN
// ======================


$data_keuangan = mysqli_query(
$conn,

"
SELECT *
FROM keuangan
ORDER BY tanggal DESC

"
);





// ======================
// DATA STOK
// ======================


$data_stok = mysqli_query(
$conn,

"
SELECT *
FROM bahan_baku
ORDER BY nama_bahan ASC

"
);



?>



<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">


<title>
Laporan | RM Rajo Salero
</title>


<link rel="stylesheet" href="dashboard.css">

<link rel="stylesheet" href="laporan.css">


</head>


<body>


<div class="admin-layout">


<?php include 'sidebar.php'; ?>



<main class="main-content">



<header class="topbar">


<p class="breadcrumb">
Admin / Laporan
</p>


<h1>
Laporan Sistem
</h1>


<p class="welcome">
Ringkasan laporan operasional RM Rajo Salero.
</p>



</header>





<section class="summary-grid">


<div class="summary-card">

<span>
Total Penjualan
</span>


<strong>
Rp<?= number_format($penjualan,0,",","."); ?>
</strong>

</div>




<div class="summary-card">

<span>
Pemasukan
</span>


<strong>
Rp<?= number_format($pemasukan,0,",","."); ?>
</strong>

</div>




<div class="summary-card">

<span>
Keuntungan
</span>


<strong>
Rp<?= number_format($keuntungan,0,",","."); ?>
</strong>

</div>



</section>





<div class="print-area">

<a href="cetak_laporan.php"
target="_blank"
class="btn-print">

🖨 Cetak Laporan

</a>

</div>







<!-- PENJUALAN -->


<section class="table-wrapper">


<h2>
Laporan Penjualan
</h2>


<table class="laporan-table">


<thead>

<tr>

<th>No</th>

<th>Pelanggan</th>

<th>Total</th>

<th>Status</th>

<th>Tanggal</th>


</tr>


</thead>



<tbody>


<?php

$no=1;

while($row=mysqli_fetch_assoc($data_penjualan)):

?>


<tr>

<td><?= $no++; ?></td>


<td><?= $row['nama_pelanggan']; ?></td>


<td>
Rp<?= number_format($row['total_harga'],0,",","."); ?>
</td>


<td>
<?= $row['status']; ?>
</td>


<td>
<?= date('d-m-Y',strtotime($row['created_at'])); ?>
</td>


</tr>


<?php endwhile; ?>


</tbody>


</table>


</section>







<!-- KEUANGAN -->


<section class="table-wrapper">


<h2>
Laporan Keuangan
</h2>


<table class="laporan-table">


<thead>

<tr>

<th>No</th>

<th>Keterangan</th>

<th>Jenis</th>

<th>Jumlah</th>

<th>Tanggal</th>


</tr>

</thead>



<tbody>


<?php

$no=1;

while($row=mysqli_fetch_assoc($data_keuangan)):

?>


<tr>


<td><?= $no++; ?></td>


<td>
<?= $row['keterangan']; ?>
</td>


<td>
<?= $row['jenis']; ?>
</td>


<td>
Rp<?= number_format($row['jumlah'],0,",","."); ?>
</td>


<td>
<?= date('d-m-Y',strtotime($row['tanggal'])); ?>
</td>


</tr>



<?php endwhile; ?>


</tbody>


</table>


</section>








<!-- STOK -->


<section class="table-wrapper">


<h2>
Laporan Stok Bahan Baku
</h2>



<table class="laporan-table">


<thead>

<tr>

<th>No</th>

<th>Bahan</th>

<th>Jumlah</th>

<th>Satuan</th>

<th>Status</th>


</tr>


</thead>


<tbody>



<?php

$no=1;


while($row=mysqli_fetch_assoc($data_stok)):

?>


<tr>


<td>
<?= $no++; ?>
</td>


<td>
<?= $row['nama_bahan']; ?>
</td>


<td>
<?= $row['jumlah']; ?>
</td>


<td>
<?= $row['satuan']; ?>
</td>


<td>

<?= 
$row['jumlah'] <= $row['stok_minimal']
? "Menipis"
: "Aman";
?>

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