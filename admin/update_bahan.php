<?php

session_start();


require_once 'database.php';



$id = $_POST['id'];

$nama = $_POST['nama_bahan'];

$kategori = $_POST['kategori'];

$jumlah = $_POST['jumlah'];

$satuan = $_POST['satuan'];

$stok_minimal = $_POST['stok_minimal'];





$query = mysqli_query(

$conn,

"UPDATE bahan_baku SET

nama_bahan='$nama',

kategori='$kategori',

jumlah='$jumlah',

satuan='$satuan',

stok_minimal='$stok_minimal'


WHERE id='$id'"

);





if($query){

header("Location: bahan_baku.php");

exit;


}else{


echo mysqli_error($conn);


}


?>