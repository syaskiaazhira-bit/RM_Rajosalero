<?php

session_start();

if(!isset($_SESSION['admin_id'])){
    header("Location: login.php");
    exit;
}

?>


<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<title>
Tambah Transaksi | RM Rajo Salero
</title>

<link rel="stylesheet" href="dashboard.css">

<link rel="stylesheet" href="keuangan.css">

</head>


<body>


<div class="admin-layout">


<?php include 'sidebar.php'; ?>


<main class="main-content">


<header class="topbar">

<p class="breadcrumb">
Admin / Keuangan / Tambah
</p>


<h1>
Tambah Transaksi
</h1>


<p class="welcome">
Catat pemasukan atau pengeluaran RM Rajo Salero.
</p>


</header>





<section class="form-card">


<h2>
Form Transaksi
</h2>



<form action="simpan_keuangan.php" method="POST">



<label>
Jenis Transaksi
</label>


<select name="jenis" required>

<option value="">
-- Pilih Jenis --
</option>

<option value="Masuk">
Pemasukan
</option>

<option value="Keluar">
Pengeluaran
</option>

</select>




<label>
Kategori
</label>


<input 
type="text"
name="kategori"
placeholder="Contoh: Penjualan / Belanja Bahan"
required>



<label>
Keterangan
</label>


<textarea 
name="keterangan"
placeholder="Keterangan transaksi"
required></textarea>




<label>
Jumlah
</label>


<input 
type="number"
name="jumlah"
placeholder="Contoh: 50000"
required>



<button type="submit">

Simpan Transaksi

</button>



</form>



</section>



</main>


</div>


</body>

</html>