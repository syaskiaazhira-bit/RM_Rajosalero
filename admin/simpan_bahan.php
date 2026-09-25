<?php

session_start();

if(!isset($_SESSION['admin_id'])){
    header("Location: login.php");
    exit;
}


require_once 'database.php';



$nama_bahan = $_POST['nama_bahan'];
$kategori = $_POST['kategori'];
$jumlah = $_POST['jumlah'];
$satuan = $_POST['satuan'];
$stok_minimal = $_POST['stok_minimal'];




$query = mysqli_query(
$conn,

"INSERT INTO bahan_baku
(
nama_bahan,
kategori,
jumlah,
satuan,
stok_minimal
)

VALUES

(
'$nama_bahan',
'$kategori',
'$jumlah',
'$satuan',
'$stok_minimal'
)"

);




if($query){


header("Location: bahan_baku.php");

exit;


}else{


echo "Gagal menambahkan bahan : " . mysqli_error($conn);


}


?>