<?php

session_start();


// CEK LOGIN ADMIN
if (!isset($_SESSION['admin_id'])) {

    header("Location: login.php");
    exit;

}


// username admin
$admin_username = $_SESSION['admin_username'] ?? 'Admin';


// koneksi database
require_once "database.php";



// ==========================
// SIMPAN PRODUK
// ==========================

if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    $nama_menu = $_POST['nama_menu'];
    $kategori = $_POST['kategori'];
    $harga = $_POST['harga'];
    $status = $_POST['status'];
    $deskripsi = $_POST['deskripsi'];



    // default gambar kosong
    $gambar = "";



    // ======================
    // UPLOAD GAMBAR
    // ======================

    if(isset($_FILES['gambar']) && $_FILES['gambar']['name'] != ""){


        $nama_file = time() . "_" . $_FILES['gambar']['name'];


        $folder = "../images/";

        $target = $folder . $nama_file;



        move_uploaded_file(
            $_FILES['gambar']['tmp_name'],
            $target
        );


        // simpan path database
        $gambar = "../images/" . $nama_file;


    }




    // ======================
    // INSERT DATA
    // ======================


    $query = "

    INSERT INTO menu

    (
        nama_menu,
        kategori,
        harga,
        gambar,
        deskripsi,
        status
    )

    VALUES

    (
        '$nama_menu',
        '$kategori',
        '$harga',
        '$gambar',
        '$deskripsi',
        '$status'
    )

    ";



    if(mysqli_query($conn,$query)){


        header("Location: produk.php");
        exit;



    }else{


        echo "Gagal menyimpan data : "
        . mysqli_error($conn);


    }



}



?>



<!DOCTYPE html>

<html lang="id">

<head>


<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">


<title>
Tambah Produk | RM Rajo Salero
</title>



<link rel="stylesheet" href="dashboard.css">

<link rel="stylesheet" href="produk.css">


</head>



<body>



<div class="admin-layout">



<!-- SIDEBAR -->

<aside class="sidebar">


<div class="brand-admin">


<div class="brand-logo">
RS
</div>


<div>

<h2>
RM Rajo Salero
</h2>


<span>
Admin Panel
</span>


</div>


</div>




<nav class="sidebar-menu">


<a href="dashboard.php" class="menu-item">

Dashboard

</a>


<a href="produk.php" class="menu-item active">

Produk

</a>


<a href="#" class="menu-item">

Bahan Baku

</a>


<a href="#" class="menu-item">

Pesanan

</a>


<a href="#" class="menu-item">

Pembayaran

</a>


<a href="#" class="menu-item">

Keuangan

</a>


<a href="#" class="menu-item">

SDM

</a>


<a href="#" class="menu-item">

Laporan

</a>


</nav>




<div class="sidebar-bottom">


<div class="admin-profile">


<div class="profile-avatar">
A
</div>


<div class="profile-info">

<strong>
Admin
</strong>


<span>
<?= htmlspecialchars($admin_username); ?>
</span>


</div>


</div>



<a href="logout.php" class="logout">

↪ Logout

</a>



</div>



</aside>






<!-- MAIN -->


<main class="main-content">



<header class="topbar">


<div>


<p class="breadcrumb">
Admin / Produk / Tambah Produk
</p>


<h1>
Tambah Produk
</h1>


<p class="welcome">
Tambahkan menu baru ke RM Rajo Salero.
</p>


</div>



</header>






<section class="add-product-section">



<div class="add-product-card">


<div class="add-product-header">


<span>
PRODUCT MANAGEMENT
</span>


<h2>
Tambah Produk Baru
</h2>


<p>
Isi informasi menu yang ingin ditambahkan.
</p>


</div>





<form 
method="POST"
enctype="multipart/form-data"
class="add-product-form"
>



<div class="form-group">


<label>
Nama Menu
</label>


<input 
type="text"
name="nama_menu"
placeholder="Contoh: Rendang Daging"
required
>


</div>






<div class="form-group">


<label>
Kategori
</label>


<select name="kategori" required>


<option value="">
Pilih Kategori
</option>


<option>
Paket Nasi Padang
</option>


<option>
Lauk Utama
</option>


<option>
Gulai & Masakan Berkuah
</option>


<option>
Lauk Tambahan
</option>


<option>
Minuman
</option>


</select>


</div>






<div class="form-group">


<label>
Harga
</label>


<input 
type="number"
name="harga"
placeholder="10000"
required
>


</div>






<div class="form-group">


<label>
Status Menu
</label>


<select name="status">


<option value="aktif">
Aktif
</option>


<option value="nonaktif">
Nonaktif
</option>


</select>


</div>






<div class="form-group full">


<label>
Foto Menu
</label>


<input 
type="file"
name="gambar"
accept=".jpg,.jpeg,.png,.webp"
>


</div>







<div class="form-group full">


<label>
Deskripsi
</label>


<textarea 
name="deskripsi"
placeholder="Tuliskan deskripsi menu..."
></textarea>


</div>






<div class="form-actions">


<a href="produk.php" class="cancel-product-btn">

Batal

</a>



<button 
type="submit"
class="save-product-btn"
>

Simpan Produk

</button>



</div>



</form>



</div>



</section>






<footer class="admin-footer">

© 2026 RM Rajo Salero · Admin Management System

</footer>




</main>


</div>



</body>

</html>