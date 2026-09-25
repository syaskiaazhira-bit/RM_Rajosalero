<?php

session_start();

if(!isset($_SESSION['admin_id'])){
    header("Location: login.php");
    exit;
}


require_once 'database.php';


$admin_username = $_SESSION['admin_username'] ?? 'Admin';



// =======================
// SUMMARY BAHAN
// =======================


$total_bahan = mysqli_fetch_assoc(
    mysqli_query($conn,"SELECT COUNT(*) total FROM bahan_baku")
)['total'];



$stok_aman = mysqli_fetch_assoc(
    mysqli_query($conn,
    "SELECT COUNT(*) total FROM bahan_baku 
     WHERE jumlah > stok_minimal")
)['total'];



$stok_menipis = mysqli_fetch_assoc(
    mysqli_query($conn,
    "SELECT COUNT(*) total FROM bahan_baku 
     WHERE jumlah <= stok_minimal")
)['total'];




// =======================
// DATA BAHAN
// =======================


$bahan = mysqli_query(
    $conn,
    "SELECT * FROM bahan_baku ORDER BY created_at DESC"
);



?>


<!DOCTYPE html>
<html lang="id">

<head>


<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">


<title>
Bahan Baku | RM Rajo Salero
</title>



<link rel="stylesheet" href="dashboard.css">

<link rel="stylesheet" href="bahan_baku.css">



</head>


<body>


<div class="admin-layout">



<!-- SIDEBAR -->

<?php include 'sidebar.php'; ?>







<!-- MAIN -->


<main class="main-content">



<header class="topbar">


<div>


<p class="breadcrumb">

Admin / Bahan Baku

</p>


<h1>

Manajemen Bahan Baku

</h1>



<p class="welcome">

Kelola stok bahan baku RM Rajo Salero.

</p>



</div>


</header>





<section class="summary-grid">


<div class="summary-card">

<span>
Total Bahan
</span>

<strong>
<?= $total_bahan; ?>
</strong>

</div>




<div class="summary-card">

<span>
Stok Aman
</span>

<strong>
<?= $stok_aman; ?>
</strong>

</div>




<div class="summary-card">

<span>
Stok Menipis
</span>

<strong>
<?= $stok_menipis; ?>
</strong>

</div>



</section>





<!-- TABLE -->


<section class="table-wrapper">



<div class="table-header">


<h2>
Daftar Bahan Baku
</h2>



<div class="action-buttons">

<a href="tambah_bahan.php" class="btn-tambah">
+ Tambah Bahan
</a>


<a href="stok_masuk.php" class="btn-stok">
 Stok Masuk
</a>

<a href="riwayat_stok.php" class="btn-riwayat">
Riwayat Stok
</a>

</div>


</div>







<table class="bahan-table">



<thead>


<tr>

<th>
No
</th>


<th>
Nama Bahan
</th>


<th>
Kategori
</th>


<th>
Jumlah
</th>


<th>
Satuan
</th>


<th>
Status
</th>


<th>
Aksi
</th>


</tr>


</thead>







<tbody>



<?php 

$no=1;

while($row=mysqli_fetch_assoc($bahan)):

?>



<tr>



<td>
<?= $no++; ?>
</td>




<td>

<?= htmlspecialchars($row['nama_bahan']); ?>

</td>





<td>

<?= htmlspecialchars($row['kategori']); ?>

</td>






<td>

<?= $row['jumlah']; ?>

</td>





<td>

<?= htmlspecialchars($row['satuan']); ?>

</td>






<td>



<?php if($row['jumlah'] <= $row['stok_minimal']): ?>


<span class="stok-warning">

Stok Menipis

</span>



<?php else: ?>


<span class="stok-aman">

Aman

</span>



<?php endif; ?>



</td>







<td>



<a 
href="edit_bahan.php?id=<?= $row['id']; ?>"
class="btn-edit">

Edit

</a>




<a 
href="hapus_bahan.php?id=<?= $row['id']; ?>"
class="btn-hapus"
onclick="return confirm('Hapus bahan ini?')">

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