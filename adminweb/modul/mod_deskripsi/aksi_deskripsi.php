<?php
session_start();
error_reporting(1);
include "../../../koneksi.php";
$module = $_GET['module'];
$act = $_GET['act'];

// Hapus Deskripsi
if ($module == 'description' and $act == 'hapus') {
	mysqli_query($koneksi, "DELETE FROM tdeskripsi WHERE deskripsiId='$_GET[id]'");
	header('location:../../master.php?module=description');
}

// Input Deskripsi
elseif ($module == 'description' and $act == 'input') {
	$groupId 	= $_POST['groupId'];
	$description	= $_POST['deskripsi'];
	$createdDate = date('Y-m-d H:i:s');
	if ($groupId == '0') {
		echo "<script lang=javascript>
		 		window.alert('Pilih grup pertanyaan');
		 		history.back();
		 		</script>";
		exit;
	} elseif (empty($description)) {
		echo "<script lang=javascript>
		 		window.alert('Pertanyaan belum diisi');
		 		history.back();
		 		</script>";
		exit;
	} else {
		$masuk = mysqli_query($koneksi, "INSERT INTO tdeskripsi(groupId,deskripsi,tgl_dibuat,adminID) VALUES('$groupId','$description','$createdDate','$_SESSION[userId]')");
		if ($masuk) {
			header('location:../../master.php?module=description');
		} else {
			echo "gagal...!";
		}
	}
}

// Update Group
elseif ($module == 'description' and $act == 'update') {
	include "../../../koneksi.php";
	$modifiedDate = date('Y-m-d H:i:s');
	$description = $_POST['description'];
	$groupId = $_POST['groupId'];
	$ModifiedUser = $_SESSION['userId'];
	$deskripsiId = $_POST['id'];

	$aksi = mysqli_query($koneksi, "UPDATE tdeskripsi SET deskripsi='$description', groupId='$groupId', tgl_modifikasi = '$modifiedDate',
	admin_modifikasi = '$ModifiedUser' WHERE deskripsiID = '$deskripsiId'") or die("gagal melaksanakan kueri");
	if ($aksi) {

		header('location:../../master.php?module=description');
	} else {
		echo "gagal";
	}
}
