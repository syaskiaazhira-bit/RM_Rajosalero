<?php

session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}

require_once 'database.php';


$admin_username = $_SESSION['admin_username'] ?? 'Admin';


// ==========================
// AMBIL ID PRODUK
// ==========================

if (!isset($_GET['id'])) {

    header("Location: produk.php");
    exit;

}


$id = $_GET['id'];



// ==========================
// AMBIL DATA PRODUK
// ==========================

$query = mysqli_query(
    $conn,
    "SELECT * FROM menu WHERE id='$id'"
);


$data = mysqli_fetch_assoc($query);



if (!$data) {

    echo "Produk tidak ditemukan";
    exit;

}



// ==========================
// UPDATE PRODUK
// ==========================

if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    $nama_menu = $_POST['nama_menu'];
    $kategori = $_POST['kategori'];
    $harga = $_POST['harga'];
    $status = $_POST['status'];
    $deskripsi = $_POST['deskripsi'];



    // FOTO LAMA

    $gambar = $data['gambar'];



    // JIKA ADA FOTO BARU

    if (
        isset($_FILES['gambar']) &&
        $_FILES['gambar']['name'] != ""
    ) {


        $nama_file =
        time() . "_" . $_FILES['gambar']['name'];


        $folder = "../images/";

        $target = $folder . $nama_file;



        move_uploaded_file(
            $_FILES['gambar']['tmp_name'],
            $target
        );


        $gambar = "../images/" . $nama_file;


    }



    // UPDATE DATABASE

    $update = mysqli_query(
        $conn,

        "UPDATE menu SET

            nama_menu='$nama_menu',
            kategori='$kategori',
            harga='$harga',
            gambar='$gambar',
            deskripsi='$deskripsi',
            status='$status'

        WHERE id='$id'"
    );



    if ($update) {

        header("Location: produk.php");
        exit;


    } else {


        echo "Gagal update : ";
        echo mysqli_error($conn);


    }


}



?>



<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">


<title>
Edit Produk | RM Rajo Salero
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
Admin / Produk / Edit Produk
</p>


<h1>
Edit Produk
</h1>


<p class="welcome">
Perbarui informasi menu RM Rajo Salero.
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
Edit Produk
</h2>


<p>
Ubah data menu yang sudah tersedia.
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

value="<?= htmlspecialchars($data['nama_menu']); ?>"

required

>


</div>







<div class="form-group">


<label>
Kategori
</label>


<select name="kategori" required>


<option value="Paket Nasi Padang"
<?= $data['kategori']=="Paket Nasi Padang" ? "selected":""; ?>>
Paket Nasi Padang
</option>



<option value="Lauk Utama"
<?= $data['kategori']=="Lauk Utama" ? "selected":""; ?>>
Lauk Utama
</option>



<option value="Gulai & Masakan Berkuah"
<?= $data['kategori']=="Gulai & Masakan Berkuah" ? "selected":""; ?>>
Gulai & Masakan Berkuah
</option>



<option value="Lauk Tambahan"
<?= $data['kategori']=="Lauk Tambahan" ? "selected":""; ?>>
Lauk Tambahan
</option>



<option value="Minuman"
<?= $data['kategori']=="Minuman" ? "selected":""; ?>>
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

value="<?= $data['harga']; ?>"

required

>


</div>







<div class="form-group">


<label>
Status Menu
</label>


<select name="status">



<option value="aktif"
<?= $data['status']=="aktif" ? "selected":""; ?>>
Aktif
</option>



<option value="nonaktif"
<?= $data['status']=="nonaktif" ? "selected":""; ?>>
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



<?php if($data['gambar'] != ""): ?>


<img

src="<?= $data['gambar']; ?>"

width="150"

style="margin-top:15px;border-radius:10px;"

>


<?php endif; ?>



</div>







<div class="form-group full">


<label>
Deskripsi
</label>


<textarea

name="deskripsi"

><?= htmlspecialchars($data['deskripsi']); ?></textarea>


</div>







<div class="form-actions">


<a

href="produk.php"

class="cancel-product-btn"

>

Batal

</a>




<button

type="submit"

class="save-product-btn"

>

Update Produk

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