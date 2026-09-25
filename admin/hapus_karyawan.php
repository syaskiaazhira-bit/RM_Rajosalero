<?php


session_start();


if(!isset($_SESSION['admin_id'])){
    header("Location: login.php");
    exit;
}



require_once 'database.php';



$id = $_GET['id'];



$query = mysqli_query(
$conn,
"
DELETE FROM karyawan
WHERE id='$id'
"
);



if($query){

header("Location: sdm.php");

}else{

echo "Data gagal dihapus";

}



exit;


?>