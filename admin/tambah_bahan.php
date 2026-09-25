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
Tambah Bahan Baku
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
Admin / Tambah Bahan
</p>


<h1>
Tambah Bahan Baku
</h1>


</div>

</header>




<section class="form-card">


<h2>
Form Tambah Bahan Baku
</h2>



<form action="simpan_bahan.php" method="POST">



<div class="form-grid">



<div class="form-group">

<label>
Nama Bahan
</label>

<input 
type="text" 
name="nama_bahan"
placeholder="Contoh: Beras"
required>

</div>





<div class="form-group">

<label>
Kategori
</label>

<input 
type="text" 
name="kategori"
placeholder="Contoh: Karbohidrat"
required>

</div>





<div class="form-group">

<label>
Jumlah
</label>

<input 
type="number" 
name="jumlah"
placeholder="Jumlah stok"
required>

</div>





<div class="form-group">

<label>
Satuan
</label>


<select name="satuan">

<option>
Kg
</option>

<option>
Liter
</option>

<option>
Buah
</option>


</select>


</div>






<div class="form-group">

<label>
Stok Minimal
</label>


<input 
type="number" 
name="stok_minimal"
value="5">


</div>



</div>





<button class="btn-submit" type="submit">

Simpan Bahan

</button>




</form>



</section>


</main>


</div>


</body>

</html>