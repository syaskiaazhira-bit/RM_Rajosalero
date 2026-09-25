<?php

$host = "localhost";
$user = "root";
$password = "";
$database = "rm_rajosalero";


$conn = new mysqli(
    $host,
    $user,
    $password,
    $database
);


if ($conn->connect_error) {

    header("Content-Type: application/json");

    echo json_encode([
        "status"=>"error",
        "message"=>"Database gagal terkoneksi"
    ]);

    exit;

}


$conn->set_charset("utf8mb4");

?>