<?php
include "koneksi.php";
$id=$_GET['id'];
$data=mysqli_query($koneksi,"SELECT * FROM service_hp WHERE id='$id'");
$d=mysqli_fetch_array($data);
?>
<h2>Detail Service</h2>
<p>Nama: <?= $d['nama_pelanggan'] ?></p>
<p>Tipe HP: <?= $d['tipe_hp'] ?></p>
<p>Kerusakan: <?= $d['kerusakan'] ?></p>
<p>Biaya: Rp <?= number_format($d['biaya']) ?></p>
<p>Status: <?= $d['status'] ?></p>
<a href="index.php">Kembali</a>
