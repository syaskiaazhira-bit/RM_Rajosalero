<?php

session_start();

if(!isset($_SESSION['admin_id'])){
    header("Location: login.php");
    exit;
}


require_once 'database.php';



$id = $_POST['id'];

$jenis = $_POST['jenis'];

$kategori = $_POST['kategori'];

$keterangan = $_POST['keterangan'];

$jumlah = $_POST['jumlah'];



mysqli_query(
$conn,

"UPDATE keuangan SET

jenis='$jenis',

kategori='$kategori',

keterangan='$keterangan',

jumlah='$jumlah'

WHERE id='$id'

"

);



header("Location: keuangan.php");

exit;


?>