<?php


session_start();


if(!isset($_SESSION['admin_id'])){
    header("Location: login.php");
    exit;
}



require_once 'database.php';



$id = $_POST['id'];

$nama = $_POST['nama'];

$jabatan = $_POST['jabatan'];

$nomor_hp = $_POST['nomor_hp'];

$alamat = $_POST['alamat'];

$gaji = $_POST['gaji'];

$status = $_POST['status'];





mysqli_query(
$conn,

"

UPDATE karyawan SET

nama='$nama',

jabatan='$jabatan',

nomor_hp='$nomor_hp',

alamat='$alamat',

gaji='$gaji',

status='$status'


WHERE id='$id'


"

);




header("Location: sdm.php");

exit;


?>