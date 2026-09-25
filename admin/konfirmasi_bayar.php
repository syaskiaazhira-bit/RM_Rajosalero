<?php

session_start();

if(!isset($_SESSION['admin_id'])){
    header("Location: login.php");
    exit;
}


require_once 'database.php';


$id = $_GET['id'];



mysqli_query(
$conn,
"
UPDATE pesanan 
SET status='Selesai'
WHERE id='$id'
"
);



header("Location: pembayaran.php");

exit;

?>