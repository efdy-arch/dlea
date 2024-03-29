<?php
error_reporting(0);
session_start();
include "../../../koneksi.php";

$module = $_GET['module'];
$act = $_GET['act'];

// Hapus user
if ($module == 'user' and $act == 'hapus') {
	mysqli_query($koneksi, "DELETE FROM pengguna WHERE userId = '$_GET[id]'");
	header('location:../../master.php?module=user');
}

// Input user
elseif ($module == 'user' and $act == 'input') {
	$pass = md5($_POST['password']);
	$aksi = mysqli_query($koneksi, "INSERT INTO pengguna(nama_pengguna,
								   password,
								   nama_lengkap,
								   email,level) 
							VALUES('$_POST[username]',
								   '$pass',
								   '$_POST[nama]',
								   '$_POST[email]','$_POST[level]')");

	if ($aksi) {

		header('location:../../master.php?module=user');
	} else {
		echo "gagal";
	}
}

// Update user
elseif ($module == 'user' and $act == 'update') {
	if (empty($_POST['password'])) {
		mysqli_query($koneksi, "UPDATE pengguna SET nama_pengguna	= '$_POST[username]',
									nama_lengkap	= '$_POST[nama]',
									email		= '$_POST[email]',
									level       = '$_POST[level]'
									WHERE userId = '$_POST[id]'");
	} else {
		$pass = md5($_POST['password']);
		mysqli_query($koneksi, "UPDATE pengguna SET nama_pengguna   = '$_POST[username]',
                                 password        = '$pass',
                                 nama_lengkap	     = '$_POST[nama]',
                                 email		     = '$_POST[email]',
                                 level       = '$_POST[level]'
                                 WHERE userId	 = '$_POST[id]'");
	}
	header('location:../../master.php?module=user');
}
