<?php

session_start();

if(!isset($_SESSION['admin_id'])){
    header("Location: login.php");
    exit;
}


require_once 'database.php';


$riwayat = mysqli_query(
    $conn,

    "SELECT 
        stok_masuk.*,
        bahan_baku.nama_bahan,
        bahan_baku.satuan

    FROM stok_masuk

    JOIN bahan_baku 
    ON stok_masuk.bahan_id = bahan_baku.id

    ORDER BY stok_masuk.tanggal DESC"

);


?>


<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">


<title>
Riwayat Stok | RM Rajo Salero
</title>


<link rel="stylesheet" href="dashboard.css">

<link rel="stylesheet" href="bahan_baku.css">


</head>


<body>


<div class="admin-layout">


<?php include 'sidebar.php'; ?>



<main class="main-content">



<header class="topbar">


<div>


<p class="breadcrumb">
Admin / Riwayat Stok
</p>


<h1>
Riwayat Stok Masuk
</h1>


<p class="welcome">
Daftar penambahan stok bahan baku RM Rajo Salero.
</p>


</div>


</header>





<section class="table-wrapper">


<div class="table-header">


<h2>
Riwayat Stok Masuk
</h2>


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
Jumlah Masuk
</th>


<th>
Tanggal
</th>


</tr>


</thead>



<tbody>


<?php

$no=1;

while($row=mysqli_fetch_assoc($riwayat)):

?>


<tr>


<td>
<?= $no++; ?>
</td>


<td>
<?= htmlspecialchars($row['nama_bahan']); ?>
</td>



<td>

+ <?= $row['jumlah']; ?>

<?= $row['satuan']; ?>

</td>



<td>

<?= date('d-m-Y H:i', strtotime($row['tanggal'])); ?>

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