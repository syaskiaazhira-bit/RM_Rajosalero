<?php

session_start();

if(!isset($_SESSION['admin_id'])){
    header("Location: login.php");
    exit;
}


require_once 'database.php';



$jenis = $_POST['jenis'];

$kategori = $_POST['kategori'];

$keterangan = $_POST['keterangan'];

$jumlah = $_POST['jumlah'];




$query = mysqli_query(
$conn,

"
INSERT INTO keuangan
(
jenis,
kategori,
keterangan,
jumlah
)

VALUES
(
'$jenis',
'$kategori',
'$keterangan',
'$jumlah'
)

"

);



if($query){


header("Location: keuangan.php");

exit;


}else{


echo "Gagal menyimpan data";


}



?>