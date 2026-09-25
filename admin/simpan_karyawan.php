<?php

session_start();

if(!isset($_SESSION['admin_id'])){
    header("Location: login.php");
    exit;
}


require_once 'database.php';



$nama = $_POST['nama'];

$jabatan = $_POST['jabatan'];

$nomor_hp = $_POST['nomor_hp'];

$alamat = $_POST['alamat'];

$gaji = $_POST['gaji'];

$status = $_POST['status'];





$query = mysqli_query($conn,

"
INSERT INTO karyawan

(
nama,
jabatan,
nomor_hp,
alamat,
gaji,
status
)

VALUES

(
'$nama',
'$jabatan',
'$nomor_hp',
'$alamat',
'$gaji',
'$status'
)

"

);





if($query){


header("Location: sdm.php");


}else{


echo "Data gagal disimpan";


}



?>