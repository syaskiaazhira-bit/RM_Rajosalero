<?php

session_start();

if(!isset($_SESSION['admin_id'])){
    header("Location: login.php");
    exit;
}


require_once 'database.php';


$id = $_GET['id'];


$data = mysqli_fetch_assoc(
    mysqli_query(
        $conn,
        "SELECT * FROM keuangan WHERE id='$id'"
    )
);


?>


<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<title>
Edit Transaksi | RM Rajo Salero
</title>


<link rel="stylesheet" href="dashboard.css">


<style>


.form-card{

background:white;
padding:35px;
border-radius:25px;
margin-top:30px;

}



.form-group{

margin-bottom:20px;

}



label{

display:block;
font-weight:600;
margin-bottom:8px;

}



input,
select,
textarea{

width:100%;
padding:14px;

border:1px solid #ddd;

border-radius:12px;

}


textarea{

height:100px;

}



button{

background:#8f1717;

color:white;

border:none;

padding:14px 35px;

border-radius:12px;

font-weight:bold;

cursor:pointer;

float:right;

}



</style>


</head>


<body>


<div class="admin-layout">


<?php include 'sidebar.php'; ?>


<main class="main-content">


<header class="topbar">


<div>

<p class="breadcrumb">
Admin / Edit Keuangan
</p>


<h1>
Edit Transaksi
</h1>


<p class="welcome">
Perbarui data transaksi keuangan.
</p>


</div>


</header>




<section class="form-card">


<form action="update_keuangan.php" method="POST">


<input type="hidden" name="id" value="<?= $data['id']; ?>">



<div class="form-group">

<label>
Jenis
</label>


<select name="jenis">


<option value="Masuk"
<?= $data['jenis']=="Masuk"?'selected':''; ?>>

Masuk

</option>



<option value="Keluar"
<?= $data['jenis']=="Keluar"?'selected':''; ?>>

Keluar

</option>


</select>


</div>




<div class="form-group">

<label>
Kategori
</label>


<input 
type="text"
name="kategori"
value="<?= $data['kategori']; ?>"
required>


</div>




<div class="form-group">

<label>
Keterangan
</label>


<textarea name="keterangan"><?= $data['keterangan']; ?></textarea>


</div>




<div class="form-group">

<label>
Jumlah
</label>


<input 
type="number"
name="jumlah"
value="<?= $data['jumlah']; ?>"
required>


</div>




<button>

Simpan Perubahan

</button>



</form>


</section>



</main>


</div>


</body>

</html>