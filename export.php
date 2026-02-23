<?php
include "koneksi.php";
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=data_service_hp.csv");

$data=mysqli_query($koneksi,"SELECT * FROM service_hp");

echo "Nama,Tipe,Kerusakan,Biaya,Status\n";

while($d=mysqli_fetch_array($data)){
echo $d['nama_pelanggan'].",".
     $d['tipe_hp'].",".
     $d['kerusakan'].",".
     $d['biaya'].",".
     $d['status']."\n";
}
?>
