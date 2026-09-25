<?php

session_start();

if(!isset($_SESSION['admin_id'])){
    header("Location: login.php");
    exit;
}


require_once 'database.php';



$id = $_GET['id'];



$data = mysqli_query(
$conn,

"SELECT * FROM bahan_baku WHERE id='$id'"

);



$bahan = mysqli_fetch_assoc($data);



?>


<!DOCTYPE html>
<html lang="id">

<head>


<meta charset="UTF-8">


<title>
Edit Bahan Baku
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

Admin / Edit Bahan

</p>


<h1>

Edit Bahan Baku

</h1>



<p class="welcome">

Perbarui data stok bahan baku.

</p>



</div>


</header>







<section class="form-card">



<h2>

Form Edit Bahan

</h2>





<form action="update_bahan.php" method="POST">



<input 
type="hidden"
name="id"
value="<?= $bahan['id']; ?>"
>





<div class="form-grid">





<div class="form-group">

<label>
Nama Bahan
</label>


<input
type="text"
name="nama_bahan"
value="<?= $bahan['nama_bahan']; ?>"
required
>


</div>






<div class="form-group">

<label>
Kategori
</label>


<input
type="text"
name="kategori"
value="<?= $bahan['kategori']; ?>"
required
>


</div>







<div class="form-group">

<label>
Jumlah
</label>


<input
type="number"
name="jumlah"
value="<?= $bahan['jumlah']; ?>"
required
>


</div>







<div class="form-group">

<label>
Satuan
</label>



<select name="satuan">


<option 
<?= $bahan['satuan']=="Kg"?'selected':''; ?>>
Kg
</option>


<option
<?= $bahan['satuan']=="Liter"?'selected':''; ?>>
Liter
</option>


<option
<?= $bahan['satuan']=="Buah"?'selected':''; ?>>
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
value="<?= $bahan['stok_minimal']; ?>"
>


</div>






</div>





<button class="btn-submit" type="submit">

Update Bahan

</button>





</form>



</section>






</main>


</div>


</body>


</html>