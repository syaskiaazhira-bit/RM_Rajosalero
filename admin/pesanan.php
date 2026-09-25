<?php

session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}

require_once 'database.php';


$admin_username = $_SESSION['admin_username'] ?? 'Admin';


// =======================
// SUMMARY PESANAN
// =======================

$total_pesanan = mysqli_fetch_assoc(
    mysqli_query($conn,"SELECT COUNT(*) total FROM pesanan")
)['total'];


$menunggu = mysqli_fetch_assoc(
    mysqli_query($conn,"SELECT COUNT(*) total FROM pesanan WHERE status='Menunggu'")
)['total'];


$diproses = mysqli_fetch_assoc(
    mysqli_query($conn,"SELECT COUNT(*) total FROM pesanan WHERE status='Diproses'")
)['total'];


$selesai = mysqli_fetch_assoc(
    mysqli_query($conn,"SELECT COUNT(*) total FROM pesanan WHERE status='Selesai'")
)['total'];



// =======================
// AMBIL DATA PESANAN
// =======================

$pesanan = mysqli_query(
    $conn,
    "SELECT * FROM pesanan ORDER BY created_at DESC"
);


?>


<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">


<title>
Pesanan | RM Rajo Salero
</title>


<link rel="stylesheet" href="dashboard.css">
<link rel="stylesheet" href="pesanan.css?v=2">

</head>


<body>


<div class="admin-layout">


<!-- SIDEBAR -->

<?php include 'sidebar.php'; ?>





<!-- MAIN -->

<main class="main-content">



<header class="topbar">


<p class="breadcrumb">
Admin / Pesanan
</p>


<h1>
Pesanan Masuk
</h1>


<p class="welcome">
Kelola pesanan pelanggan RM Rajo Salero.
</p>



</header>





<!-- SUMMARY -->


<section class="order-summary">


<div class="order-summary-card">

<span>Total Pesanan</span>

<strong>
<?= $total_pesanan ?>
</strong>

</div>



<div class="order-summary-card">

<span>Menunggu</span>

<strong>
<?= $menunggu ?>
</strong>

</div>



<div class="order-summary-card">

<span>Diproses</span>

<strong>
<?= $diproses ?>
</strong>

</div>



<div class="order-summary-card">

<span>Selesai</span>

<strong>
<?= $selesai ?>
</strong>

</div>



</section>







<!-- LIST PESANAN -->


<section class="order-grid">



<?php while($row=mysqli_fetch_assoc($pesanan)): ?>



<div class="order-card">



<div class="order-header">


<div class="order-number">

#<?= $row['id']; ?>

</div>



<div class="status-badge">

<?= $row['status']; ?>

</div>


</div>






<div class="customer-info">


<p>
👤 <?= htmlspecialchars($row['nama_pelanggan']); ?>
</p>


<p>
📱 <?= htmlspecialchars($row['nomor_hp']); ?>
</p>


<p>
💳 <?= htmlspecialchars($row['metode_pembayaran']); ?>
</p>


</div>







<div class="order-menu">


<h4>
Detail Pesanan
</h4>



<?php

$detail = mysqli_query(
$conn,
"SELECT * FROM detail_pesanan 
WHERE pesanan_id='".$row['id']."'"
);


while($item=mysqli_fetch_assoc($detail)):

?>


<div class="order-menu-item">


<span>

<?= htmlspecialchars($item['nama_menu']); ?>

x<?= $item['jumlah']; ?>

</span>



<strong>

Rp<?= number_format($item['subtotal'],0,",","."); ?>

</strong>


</div>



<?php endwhile; ?>


</div>








<div class="order-total">


<span>
Total
</span>


<strong>

Rp<?= number_format($row['total_harga'],0,",","."); ?>

</strong>


</div>







<!-- BUTTON STATUS -->


<div class="order-action">



<?php if($row['status']=="Menunggu"): ?>


<form action="update_status.php" method="POST">


<input type="hidden" name="id" value="<?= $row['id']; ?>">


<input type="hidden" name="status" value="Diproses">


<button type="submit">

Proses Pesanan

</button>


</form>




<form action="update_status.php" method="POST">


<input type="hidden" name="id" value="<?= $row['id']; ?>">


<input type="hidden" name="status" value="Dibatalkan">


<button type="submit">

Batalkan Pesanan

</button>


</form>






<?php elseif($row['status']=="Diproses"): ?>



<form action="update_status.php" method="POST">


<input type="hidden" name="id" value="<?= $row['id']; ?>">


<input type="hidden" name="status" value="Selesai">


<button type="submit">

Selesaikan Pesanan

</button>


</form>







<?php elseif($row['status']=="Selesai"): ?>


<button disabled>

Pesanan Selesai ✓

</button>






<?php elseif($row['status']=="Dibatalkan"): ?>


<button disabled>

Pesanan Dibatalkan ✕

</button>




<?php endif; ?>



</div>




</div>




<?php endwhile; ?>



</section>







<footer class="admin-footer">

© 2026 RM Rajo Salero · Admin Management System

</footer>




</main>



</div>


</body>


</html>