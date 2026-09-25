<?php

session_start();

if(!isset($_SESSION['admin_id'])){
    header("Location: login.php");
    exit;
}


require_once 'database.php';



if($_SERVER['REQUEST_METHOD']=="POST"){


    $bahan_id = $_POST['bahan_id'];
    $jumlah   = $_POST['jumlah'];



    // simpan riwayat stok masuk

    $insert = mysqli_query(
        $conn,
        "INSERT INTO stok_masuk
        (bahan_id, jumlah)
        VALUES
        ('$bahan_id','$jumlah')"
    );



    if($insert){


        // tambah jumlah stok bahan baku

        mysqli_query(
            $conn,
            "UPDATE bahan_baku
            SET jumlah = jumlah + $jumlah
            WHERE id='$bahan_id'"
        );


        echo "
        <script>
        alert('Stok berhasil ditambahkan!');
        window.location='bahan_baku.php';
        </script>
        ";



    }else{


        echo "
        <script>
        alert('Gagal menambahkan stok!');
        window.history.back();
        </script>
        ";


    }



}else{


    header("Location:bahan_baku.php");


}

?>