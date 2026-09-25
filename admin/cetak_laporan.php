<?php

session_start();

if(!isset($_SESSION['admin_id'])){
    header("Location: login.php");
    exit;
}


require_once 'database.php';



// PENJUALAN

$penjualan = mysqli_query(
$conn,

"
SELECT *
FROM pesanan
ORDER BY created_at DESC

"

);




// KEUANGAN

$keuangan = mysqli_query(
$conn,

"
SELECT *
FROM keuangan
ORDER BY tanggal DESC

"

);




// STOK

$stok = mysqli_query(
$conn,

"
SELECT *
FROM bahan_baku
ORDER BY nama_bahan ASC

"

);


?>


<!DOCTYPE html>
<html lang="id">

<head>


<meta charset="UTF-8">


<title>
Cetak Laporan RM Rajo Salero
</title>



<style>


body{

font-family:Arial, sans-serif;

padding:40px;

color:#222;

}



h1{

text-align:center;

color:#991b1e;

}



h2{

margin-top:40px;

border-bottom:2px solid #991b1e;

padding-bottom:10px;

}



.header{

text-align:center;

margin-bottom:40px;

}



table{

width:100%;

border-collapse:collapse;

margin-top:15px;

}



table th{

background:#991b1e;

color:white;

padding:12px;

text-align:left;

}



table td{

padding:12px;

border:1px solid #ddd;

}



.footer{

margin-top:50px;

text-align:right;

}



.btn-print{

background:#991b1e;

color:white;

padding:12px 25px;

border:none;

border-radius:10px;

cursor:pointer;

margin-bottom:20px;

}



@media print{


.btn-print{

display:none;

}


}



</style>


</head>


<body>



<button class="btn-print" onclick="window.print()">

🖨 Print Laporan

</button>




<div class="header">


<h1>
RM Rajo Salero
</h1>


<p>
Laporan Sistem Manajemen
</p>


<p>
Tanggal Cetak:
<?= date('d-m-Y'); ?>
</p>


</div>






<h2>
Laporan Penjualan
</h2>



<table>


<tr>

<th>No</th>

<th>Pelanggan</th>

<th>Total</th>

<th>Status</th>

</tr>



<?php

$no=1;

while($row=mysqli_fetch_assoc($penjualan)):

?>


<tr>


<td>
<?= $no++; ?>
</td>


<td>
<?= $row['nama_pelanggan']; ?>
</td>


<td>
Rp<?= number_format($row['total_harga'],0,",","."); ?>
</td>


<td>
<?= $row['status']; ?>
</td>


</tr>


<?php endwhile; ?>


</table>







<h2>
Laporan Keuangan
</h2>



<table>


<tr>

<th>No</th>

<th>Keterangan</th>

<th>Jenis</th>

<th>Jumlah</th>

</tr>




<?php

$no=1;

while($row=mysqli_fetch_assoc($keuangan)):

?>


<tr>


<td>
<?= $no++; ?>
</td>


<td>
<?= $row['keterangan']; ?>
</td>


<td>
<?= $row['jenis']; ?>
</td>


<td>
Rp<?= number_format($row['jumlah'],0,",","."); ?>
</td>


</tr>


<?php endwhile; ?>



</table>







<h2>
Laporan Stok Bahan Baku
</h2>



<table>


<tr>

<th>No</th>

<th>Bahan</th>

<th>Jumlah</th>

<th>Satuan</th>

</tr>




<?php

$no=1;

while($row=mysqli_fetch_assoc($stok)):

?>


<tr>


<td>
<?= $no++; ?>
</td>


<td>
<?= $row['nama_bahan']; ?>
</td>


<td>
<?= $row['jumlah']; ?>
</td>


<td>
<?= $row['satuan']; ?>
</td>


</tr>


<?php endwhile; ?>


</table>






<div class="footer">

Admin RM Rajo Salero

</div>



</body>

</html>