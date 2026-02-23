<?php
include "koneksi.php";

$notif="";

if(isset($_POST['tambah'])){
    mysqli_query($koneksi,"INSERT INTO service_hp VALUES(
        NULL,
        '$_POST[nama]',
        '$_POST[tipe]',
        '$_POST[kerusakan]',
        '$_POST[biaya]',
        '$_POST[status]'
    )");
    $notif="Data berhasil disimpan!";
}

if(isset($_GET['hapus'])){
    mysqli_query($koneksi,"DELETE FROM service_hp WHERE id='$_GET[hapus]'");
}

$where="WHERE 1=1";

if(isset($_GET['keyword']) && $_GET['keyword']!=""){
    $keyword=$_GET['keyword'];
    $where.=" AND (nama_pelanggan LIKE '%$keyword%' 
              OR tipe_hp LIKE '%$keyword%')";
}

if(isset($_GET['filter']) && $_GET['filter']!=""){
    $filter=$_GET['filter'];
    $where.=" AND status='$filter'";
}

$data=mysqli_query($koneksi,"SELECT * FROM service_hp $where");

$total=mysqli_query($koneksi,"SELECT SUM(biaya) as total FROM service_hp");
$total_data=mysqli_fetch_assoc($total);
?>

<!DOCTYPE html>
<html>
<head>
<title>Service HP</title>
<style>
body{font-family:Arial;background:#2a5298;color:white;padding:20px;}
.container{background:white;color:black;padding:20px;border-radius:10px;}
input,select,textarea{width:100%;padding:8px;margin:5px 0;}
button{padding:8px 12px;background:#2a5298;color:white;border:none;border-radius:5px;}
table{width:100%;border-collapse:collapse;margin-top:20px;}
table,th,td{border:1px solid #ddd;}
th{background:#2a5298;color:white;}
th,td{padding:8px;text-align:center;}
</style>
</head>
<body>

<div class="container">
<h2>Database Service HP</h2>

<?php if($notif!=""){ ?>
<p style="background:green;color:white;padding:8px;">
<?= $notif ?>
</p>
<?php } ?>

<h3>Total Pemasukan: Rp <?= number_format($total_data['total']); ?></h3>

<form method="POST">
<input type="text" name="nama" placeholder="Nama Pelanggan" required>
<input type="text" name="tipe" placeholder="Tipe HP" required>
<textarea name="kerusakan" placeholder="Kerusakan" required></textarea>
<input type="number" name="biaya" placeholder="Biaya" required>
<select name="status">
<option>Proses</option>
<option>Selesai</option>
<option>Diambil</option>
</select>
<button type="submit" name="tambah">Save</button>
</form>

<hr>

<form method="GET">
<input type="text" name="keyword" placeholder="Cari Nama / Tipe HP">
<select name="filter">
<option value="">Semua Status</option>
<option>Proses</option>
<option>Selesai</option>
<option>Diambil</option>
</select>
<button type="submit">Cari</button>
</form>

<a href="export.php"><button>Export CSV</button></a>

<table>
<tr>
<th>No</th>
<th>Nama</th>
<th>Tipe</th>
<th>Kerusakan</th>
<th>Biaya</th>
<th>Status</th>
<th>Aksi</th>
</tr>

<?php $no=1; while($d=mysqli_fetch_array($data)){ ?>
<tr>
<td><?= $no++ ?></td>
<td><?= $d['nama_pelanggan'] ?></td>
<td><?= $d['tipe_hp'] ?></td>
<td><?= $d['kerusakan'] ?></td>
<td>Rp <?= number_format($d['biaya']) ?></td>
<td><?= $d['status'] ?></td>
<td>
<a href="detail.php?id=<?= $d['id'] ?>">Detail</a> |
<a href="edit.php?id=<?= $d['id'] ?>">Edit</a> |
<a href="?hapus=<?= $d['id'] ?>">Hapus</a>
</td>
</tr>
<?php } ?>

</table>
</div>
</body>
</html>
