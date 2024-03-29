<?php
session_start();
include '../koneksi.php';
if ($_POST['aksi'] == 'gantipass') {
  $user = $_SESSION['userId'];
  $passbaru = md5($_POST['newpass']);
  $aksi = mysqli_query($koneksi, "UPDATE pengguna SET password= '$passbaru' WHERE userId='$user'");
  if ($aksi == true) {
    echo "password dengan usename " . $_SESSION['username'] . " berhasil diganti";
  } else {
    echo "password dengan usename " . $_SESSION['username'] . " gagal diganti";
  }
} else {
  $passlama = md5($_POST['pass_lama']);
  $passdb = mysqli_fetch_array(mysqli_query($koneksi, "SELECT password from tuser where userId='$_SESSION[userId]'"));
  if ($passlama == $passdb['password']) {
    echo "oke";
  } else {
    echo "no";
  }
}
