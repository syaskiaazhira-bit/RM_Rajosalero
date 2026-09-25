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
"SELECT * FROM karyawan WHERE id='$id'"
)

);



?>



<!DOCTYPE html>
<html lang="id">


<head>

<meta charset="UTF-8">


<title>
Edit Karyawan | RM Rajo Salero
</title>


<link rel="stylesheet" href="dashboard.css">


<style>


.form-card{

background:white;

padding:35px;

border-radius:25px;

margin-top:35px;

box-shadow:0 8px 25px rgba(0,0,0,.05);

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
select{

width:100%;

padding:14px;

border:1px solid #ddd;

border-radius:12px;

}



button{

background:#991b1e;

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
Admin / Edit Karyawan
</p>


<h1>
Edit Karyawan
</h1>


<p class="welcome">
Perbarui data karyawan RM Rajo Salero.
</p>


</div>


</header>





<section class="form-card">



<form action="update_karyawan.php" method="POST">


<input 
type="hidden"
name="id"
value="<?= $data['id']; ?>">





<div class="form-group">

<label>
Nama Karyawan
</label>


<input 
type="text"
name="nama"
value="<?= $data['nama']; ?>"
required>

</div>






<div class="form-group">

<label>
Jabatan
</label>


<select name="jabatan">


<option 
value="Koki"
<?= $data['jabatan']=="Koki"?'selected':''; ?>>
Koki
</option>


<option 
value="Kasir"
<?= $data['jabatan']=="Kasir"?'selected':''; ?>>
Kasir
</option>


<option 
value="Pelayan"
<?= $data['jabatan']=="Pelayan"?'selected':''; ?>>
Pelayan
</option>


<option 
value="Helper"
<?= $data['jabatan']=="Helper"?'selected':''; ?>>
Helper
</option>



</select>


</div>







<div class="form-group">

<label>
Nomor HP
</label>


<input 
type="text"
name="nomor_hp"
value="<?= $data['nomor_hp']; ?>">


</div>






<div class="form-group">

<label>
Alamat
</label>


<input 
type="text"
name="alamat"
value="<?= $data['alamat']; ?>">


</div>







<div class="form-group">

<label>
Gaji
</label>


<input 
type="number"
name="gaji"
value="<?= $data['gaji']; ?>">


</div>







<div class="form-group">

<label>
Status
</label>


<select name="status">


<option value="Aktif"
<?= $data['status']=="Aktif"?'selected':''; ?>>
Aktif
</option>



<option value="Tidak Aktif"
<?= $data['status']=="Tidak Aktif"?'selected':''; ?>>
Tidak Aktif
</option>


</select>


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