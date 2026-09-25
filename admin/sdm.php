<?php

session_start();

if(!isset($_SESSION['admin_id'])){
    header("Location: login.php");
    exit;
}

require_once 'database.php';



// SUMMARY

$total_karyawan = mysqli_fetch_assoc(
    mysqli_query($conn,"
    SELECT COUNT(*) total FROM karyawan
    ")
)['total'];


$aktif = mysqli_fetch_assoc(
    mysqli_query($conn,"
    SELECT COUNT(*) total 
    FROM karyawan
    WHERE status='Aktif'
    ")
)['total'];


$tidak_aktif = mysqli_fetch_assoc(
    mysqli_query($conn,"
    SELECT COUNT(*) total 
    FROM karyawan
    WHERE status='Tidak Aktif'
    ")
)['total'];




// DATA KARYAWAN

$data = mysqli_query(
    $conn,
    "
    SELECT * FROM karyawan
    ORDER BY created_at DESC
    "
);


?>


<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">


<title>
SDM | RM Rajo Salero
</title>


<link rel="stylesheet" href="dashboard.css">

<link rel="stylesheet" href="sdm.css">


</head>



<body>



<div class="admin-layout">


<?php include 'sidebar.php'; ?>



<main class="main-content">



<header class="topbar">


<div>

<p class="breadcrumb">
Admin / SDM
</p>


<h1>
Manajemen Karyawan
</h1>


<p class="welcome">
Kelola data karyawan RM Rajo Salero.
</p>


</div>


</header>





<section class="summary-grid">



<div class="summary-card">

<span>
Total Karyawan
</span>


<strong>
<?= $total_karyawan; ?>
</strong>


</div>




<div class="summary-card">

<span>
Karyawan Aktif
</span>


<strong>
<?= $aktif; ?>
</strong>


</div>




<div class="summary-card">

<span>
Tidak Aktif
</span>


<strong>
<?= $tidak_aktif; ?>
</strong>


</div>



</section>






<section class="table-wrapper">


<div class="table-header">


<h2>
Daftar Karyawan
</h2>



<a href="tambah_karyawan.php" class="btn-tambah">

+ Tambah Karyawan

</a>


</div>






<table class="sdm-table">



<thead>

<tr>

<th>No</th>

<th>Nama</th>

<th>Jabatan</th>

<th>No HP</th>

<th>Gaji</th>

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
<?= htmlspecialchars($row['nama']); ?>
</td>



<td>
<?= htmlspecialchars($row['jabatan']); ?>
</td>



<td>
<?= htmlspecialchars($row['nomor_hp']); ?>
</td>



<td>
Rp<?= number_format($row['gaji'],0,",","."); ?>
</td>




<td>


<?php if($row['status']=="Aktif"): ?>

<span class="status-aktif">
Aktif
</span>


<?php else: ?>

<span class="status-nonaktif">
Tidak Aktif
</span>


<?php endif; ?>


</td>




<td>


<a href="edit_karyawan.php?id=<?= $row['id']; ?>"
class="btn-edit">

Edit

</a>



<a href="hapus_karyawan.php?id=<?= $row['id']; ?>"
class="btn-hapus"
onclick="return confirm('Hapus karyawan ini?')">

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