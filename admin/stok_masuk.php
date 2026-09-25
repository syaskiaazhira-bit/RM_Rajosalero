<?php

session_start();

if(!isset($_SESSION['admin_id'])){
    header("Location: login.php");
    exit;
}

require_once 'database.php';

$admin_username = $_SESSION['admin_username'] ?? 'Admin';


// Ambil data bahan
$bahan = mysqli_query(
    $conn,
    "SELECT * FROM bahan_baku ORDER BY nama_bahan ASC"
);

?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>
Stok Masuk | RM Rajo Salero
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
Admin / Stok Masuk
</p>


<h1>
Tambah Stok Masuk
</h1>


<p class="welcome">
Catat penambahan bahan baku RM Rajo Salero.
</p>


</div>

</header>





<section class="table-wrapper">


<div class="table-header">

<h2>
Form Stok Masuk
</h2>


</div>





<form action="proses_stok_masuk.php" method="POST" class="form-bahan">



<div class="form-group">


<label>
Pilih Bahan
</label>


<select name="bahan_id" required>


<option value="">
-- Pilih Bahan --
</option>


<?php while($row=mysqli_fetch_assoc($bahan)): ?>


<option value="<?= $row['id']; ?>">

<?= htmlspecialchars($row['nama_bahan']); ?>

(<?= $row['jumlah']; ?> <?= $row['satuan']; ?>)

</option>


<?php endwhile; ?>


</select>


</div>





<div class="form-group">


<label>
Jumlah Masuk
</label>


<input 
type="number"
name="jumlah"
placeholder="Contoh: 10"
required
>


</div>





<div class="form-action">

<button type="submit" class="btn-tambah">

Simpan Stok Masuk

</button>

</div>


</form>


</section>





<footer class="admin-footer">

© 2026 RM Rajo Salero · Admin Management System

</footer>


</main>


</div>


</body>

</html>