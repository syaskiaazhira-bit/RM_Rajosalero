<?php

session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}


require_once 'database.php';


if(isset($_GET['id'])){

    $id = $_GET['id'];


    $query = "DELETE FROM menu WHERE id='$id'";


    if(mysqli_query($conn,$query)){

        header("Location: produk.php");
        exit;

    }else{

        echo "Gagal menghapus data : ";
        echo mysqli_error($conn);

    }


}else{

    header("Location: produk.php");
    exit;

}

?>