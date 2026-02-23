<?php
$koneksi = mysqli_connect("localhost","root","","db_service_hp");

if(!$koneksi){
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
