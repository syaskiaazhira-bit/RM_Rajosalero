<?php

header("Content-Type: application/json");

require_once "admin/database.php";


$data = json_decode(file_get_contents("php://input"), true);


if(!$data){

    echo json_encode([
        "status"=>"error",
        "message"=>"Data kosong"
    ]);

    exit;
}


$nama = $data['nama'];
$hp = $data['hp'];
$alamat = $data['alamat'];
$metode = $data['metode'];
$total = $data['total'];
$pesanan = $data['pesanan'];



// INSERT PESANAN UTAMA

$query = mysqli_query($conn,

"
INSERT INTO pesanan

(
nama_pelanggan,
nomor_hp,
alamat,
total_harga,
status,
metode_pembayaran
)

VALUES

(
'$nama',
'$hp',
'$alamat',
'$total',
'Menunggu',
'$metode'
)

");


if(!$query){

echo json_encode([
"status"=>"error",
"message"=>mysqli_error($conn)
]);

exit;

}




// AMBIL ID PESANAN

$pesanan_id = mysqli_insert_id($conn);




// INSERT DETAIL

foreach($pesanan as $item){


$nama_menu = $item['nama'];
$harga = $item['harga'];
$jumlah = $item['jumlah'];

$subtotal = $harga * $jumlah;



mysqli_query($conn,

"

INSERT INTO detail_pesanan

(
pesanan_id,
nama_menu,
harga,
jumlah,
subtotal
)

VALUES

(
'$pesanan_id',
'$nama_menu',
'$harga',
'$jumlah',
'$subtotal'
)

"

);



}



echo json_encode([

"status"=>"success",

"message"=>"Pesanan berhasil"

]);


?>