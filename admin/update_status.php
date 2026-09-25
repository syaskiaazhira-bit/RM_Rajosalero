<?php

session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "database.php";


if(!isset($_POST['id']) || !isset($_POST['status'])){

    die("Data tidak lengkap");

}


$id = $_POST['id'];
$status = $_POST['status'];



$query = mysqli_query(
    $conn,
    "UPDATE pesanan 
     SET status='$status'
     WHERE id='$id'"
);



if($query){

    echo "Berhasil update";

    header("refresh:1;url=pesanan.php");

}else{

    echo "Gagal : ".mysqli_error($conn);

}


?>