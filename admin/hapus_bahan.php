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

"DELETE FROM bahan_baku WHERE id='$id'"

);



if($query){


header("Location: bahan_baku.php");

exit;


}else{


echo "Gagal menghapus data : " . mysqli_error($conn);


}



?>