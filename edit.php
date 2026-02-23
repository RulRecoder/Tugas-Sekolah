<?php
include "koneksi.php";
$id=$_GET['id'];
$data=mysqli_query($koneksi,"SELECT * FROM service_hp WHERE id='$id'");
$d=mysqli_fetch_array($data);

if(isset($_POST['update'])){
    mysqli_query($koneksi,"UPDATE service_hp SET
    nama_pelanggan='$_POST[nama]',
    tipe_hp='$_POST[tipe]',
    kerusakan='$_POST[kerusakan]',
    biaya='$_POST[biaya]',
    status='$_POST[status]'
    WHERE id='$id'");
    header("location:index.php");
}
?>
<form method="POST">
<input type="text" name="nama" value="<?= $d['nama_pelanggan'] ?>" required>
<input type="text" name="tipe" value="<?= $d['tipe_hp'] ?>" required>
<textarea name="kerusakan"><?= $d['kerusakan'] ?></textarea>
<input type="number" name="biaya" value="<?= $d['biaya'] ?>" required>
<select name="status">
<option <?= $d['status']=="Proses"?"selected":"" ?>>Proses</option>
<option <?= $d['status']=="Selesai"?"selected":"" ?>>Selesai</option>
<option <?= $d['status']=="Diambil"?"selected":"" ?>>Diambil</option>
</select>
<button type="submit" name="update">Update</button>
</form>
