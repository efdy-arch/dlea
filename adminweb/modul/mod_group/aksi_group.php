<?php
session_start();
include "../../../koneksi.php";
$module = $_GET['module'];
$act = $_GET['act'];
// Hapus Group
if ($module == 'group' and $act == 'hapus') {
	mysqli_query($koneksi, "DELETE FROM tgroup WHERE groupId='$_GET[id]'");
	header('location:../../master.php?module=group');
}
// Input Group
elseif ($module == 'group' and $act == 'input') {
	$groupName 	= $_POST['grup'];
	$createdDate = date('Y-m-d H:i:s');
	// $kode = $_POST['kode'];
	$masuk = mysqli_query($koneksi, "INSERT INTO tgroup(namaGroup,tgl_dibuat,admin_modifikasi,kode) VALUES('$groupName','$createdDate','$_SESSION[userId]','A')");
	header('location:../../master.php?module=group');
}
// Update Group
elseif ($module == 'group' and $act == 'update') {
	$modifiedDate = date('Y-m-d H:i:s');
	$aksi = mysqli_query($koneksi, "UPDATE tgroup SET namaGroup = '$_POST[grup]', tgl_modifikasi = '$modifiedDate', admin_modifikasi = '$_SESSION[userId]' WHERE groupId = '$_POST[id]'");
	if ($aksi) {
		header('location:../../master.php?module=group');
	} else {
		echo "gagal";
	}
}
