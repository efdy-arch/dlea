<link href="css/bootstrap.min.css" rel="stylesheet">
<?php
error_reporting(0);
include "koneksi.php";
include "fungsi/fungsi_indotgl.php";
$namaPasien	= $_POST['namaPasien'];
$jenisKelamin = $_POST['jenisKelamin'];
$companyAddress	= $_POST['companyAddress1'];
$umur	= $_POST['umur'];
$saran		= $_POST['suggestion'];
$agreeCity		= $_POST['agreeCity'];
$tgl			= $_POST['tgl_survey'];
// generate random value for primary key
$pasienID = rand(1000000, 9999999);
// var_dump($_POST);
$no_hitung = 1;
$sql_hitung = mysqli_query($koneksi, "SELECT * FROM tgroup");
while ($data_hitung = mysqli_fetch_array($sql_hitung)) {
	$id_hitung = $data_hitung['groupId'];
	$hasil_hitung = mysqli_query($koneksi, "SELECT * FROM tdeskripsi, tgroup WHERE tdeskripsi.groupId = '$id_hitung' AND tdeskripsi.groupId = tgroup.groupId ORDER BY tgroup.groupId");
	$i_hitung = 1;
	while ($r_hitung = mysqli_fetch_array($hasil_hitung)) {
		$id_hitung = $data_hitung['groupId'];
		$asfa_hitung = $_POST['asfa' . $i_hitung . $id_hitung];
		if (empty($asfa_hitung)) {
			echo "<script lang=javascript>
		 		window.alert('Anda belum mengisi kuisioner atau ada kuisioner yang belum terisi..!');
		 		history.back();
		 		</script>";
			exit;
		}

		$i_hitung++;
	}
	echo "<br>";
	$no_hitung++;
}

if (empty($namaPasien)) {
	echo "<script lang=javascript>
		 		window.alert('Isi Nama Anda');
		 		history.back();
		 		</script>";
	exit;
} elseif (empty($umur)) {
	echo "<script lang=javascript>
		 		window.alert('Isi Umur Anda');
		 		history.back();
		 		</script>";
	exit;
} elseif (empty($jenisKelamin)) {
	echo "<script lang=javascript>
		 		window.alert('Pilih Jenis Kelamin');
		 		history.back();
		 		</script>";
	exit;
} else {
	$no = 1;
	$sql = mysqli_query($koneksi, "SELECT * FROM tgroup");
	mysqli_query($koneksi, "INSERT INTO tresponden(pasienID, namaPasien, jenisKelamin, umur, tgl_survei, saran) VALUES('$pasienID', '$namaPasien', '$jenisKelamin', '$umur', '$tgl', '$saran')");
	while ($data = mysqli_fetch_array($sql)) {
		$groupId = $data['groupId'];
		$hasil = mysqli_query($koneksi, "SELECT * FROM tdeskripsi, tgroup WHERE tdeskripsi.groupId = '$groupId' AND tdeskripsi.groupId = tgroup.groupId ORDER BY tgroup.groupId");
		$i = 1;
		while ($r = mysqli_fetch_array($hasil)) {
			$asfa = $_POST['asfa' . $i . $groupId];
			$ekspek = $_POST['ekspek' . $i . $groupId];
			// var_dump($_POST, $r['deskripsiID']);
			switch ($asfa . $ekspek) {
				case 'AA':
					mysqli_query($koneksi, "INSERT INTO tjawaban (deskripsiID, groupId, pasienID, jawaban, jawabanA, jawabanB, jawabanC, jawabanD, jawabanE, ekspekJawaban, ekspekA, ekspekB, ekspekC, ekspekD, ekspekE) 
					VALUES ('$r[deskripsiID]', '$r[groupId]', '$pasienID', '$asfa', '5', '0', '0', '0', '0', '$ekspek', '5', '0', '0', '0', '0')");
					break;

				case 'AB':
					mysqli_query($koneksi, "INSERT INTO tjawaban (deskripsiID, groupId, pasienID, jawaban, jawabanA, jawabanB, jawabanC, jawabanD, jawabanE, ekspekJawaban, ekspekA, ekspekB, ekspekC, ekspekD, ekspekE) 
					VALUES ('$r[deskripsiID]', '$r[groupId]', '$pasienID', '$asfa', '5', '0', '0', '0', '0', '$ekspek', '0', '4', '0', '0', '0')");
					break;

				case 'AC':
					mysqli_query($koneksi, "INSERT INTO tjawaban (deskripsiID, groupId, pasienID, jawaban, jawabanA, jawabanB, jawabanC, jawabanD, jawabanE, ekspekJawaban, ekspekA, ekspekB, ekspekC, ekspekD, ekspekE) 
					VALUES ('$r[deskripsiID]', '$r[groupId]', '$pasienID', '$asfa', '5', '0', '0', '0', '0', '$ekspek', '0', '0', '3', '0', '0')");
					break;

				case 'AD':
					mysqli_query($koneksi, "INSERT INTO tjawaban (deskripsiID, groupId, pasienID, jawaban, jawabanA, jawabanB, jawabanC, jawabanD, jawabanE, ekspekJawaban, ekspekA, ekspekB, ekspekC, ekspekD, ekspekE) 
					VALUES ('$r[deskripsiID]', '$r[groupId]', '$pasienID', '$asfa', '5', '0', '0', '0', '0', '$ekspek', '0', '0', '0', '2', '0')");
					break;

				case 'AE':
					mysqli_query($koneksi, "INSERT INTO tjawaban (deskripsiID, groupId, pasienID, jawaban, jawabanA, jawabanB, jawabanC, jawabanD, jawabanE, ekspekJawaban, ekspekA, ekspekB, ekspekC, ekspekD, ekspekE) 
					VALUES ('$r[deskripsiID]', '$r[groupId]', '$pasienID', '$asfa', '5', '0', '0', '0', '0', '$ekspek', '0', '0', '0', '0', '1')");
					break;
				case 'BA':
					mysqli_query($koneksi, "INSERT INTO tjawaban (deskripsiID, groupId, pasienID, jawaban, jawabanA, jawabanB, jawabanC, jawabanD, jawabanE, ekspekJawaban, ekspekA, ekspekB, ekspekC, ekspekD, ekspekE) 
					VALUES ('$r[deskripsiID]', '$r[groupId]', '$pasienID', '$asfa', '0', '4', '0', '0', '0', '$ekspek', '5', '0', '0', '0', '0')");
					break;

				case 'BB':
					mysqli_query($koneksi, "INSERT INTO tjawaban (deskripsiID, groupId, pasienID, jawaban, jawabanA, jawabanB, jawabanC, jawabanD, jawabanE, ekspekJawaban, ekspekA, ekspekB, ekspekC, ekspekD, ekspekE) 
					VALUES ('$r[deskripsiID]', '$r[groupId]', '$pasienID', '$asfa', '0', '4', '0', '0', '0', '$ekspek', '0', '4', '0', '0', '0')");
					break;

				case 'BC':
					mysqli_query($koneksi, "INSERT INTO tjawaban (deskripsiID, groupId, pasienID, jawaban, jawabanA, jawabanB, jawabanC, jawabanD, jawabanE, ekspekJawaban, ekspekA, ekspekB, ekspekC, ekspekD, ekspekE) 
					VALUES ('$r[deskripsiID]', '$r[groupId]', '$pasienID', '$asfa', '0', '4', '0', '0', '0', '$ekspek', '0', '0', '3', '0', '0')");
					break;

				case 'BD':
					mysqli_query($koneksi, "INSERT INTO tjawaban (deskripsiID, groupId, pasienID, jawaban, jawabanA, jawabanB, jawabanC, jawabanD, jawabanE, ekspekJawaban, ekspekA, ekspekB, ekspekC, ekspekD, ekspekE) 
					VALUES ('$r[deskripsiID]', '$r[groupId]', '$pasienID', '$asfa', '0', '4', '0', '0', '0', '$ekspek', '0', '0', '0', '2', '0')");
					break;

				case 'BE':
					mysqli_query($koneksi, "INSERT INTO tjawaban (deskripsiID, groupId, pasienID, jawaban, jawabanA, jawabanB, jawabanC, jawabanD, jawabanE, ekspekJawaban, ekspekA, ekspekB, ekspekC, ekspekD, ekspekE) 
					VALUES ('$r[deskripsiID]', '$r[groupId]', '$pasienID', '$asfa', '0', '4', '0', '0', '0', '$ekspek', '0', '0', '0', '0', '1')");
					break;
				case 'CA':
					mysqli_query($koneksi, "INSERT INTO tjawaban (deskripsiID, groupId, pasienID, jawaban, jawabanA, jawabanB, jawabanC, jawabanD, jawabanE, ekspekJawaban, ekspekA, ekspekB, ekspekC, ekspekD, ekspekE) 
					VALUES ('$r[deskripsiID]', '$r[groupId]', '$pasienID', '$asfa', '0', '0', '3', '0', '0', '$ekspek', '5', '0', '0', '0', '0')");
					break;

				case 'CB':
					mysqli_query($koneksi, "INSERT INTO tjawaban (deskripsiID, groupId, pasienID, jawaban, jawabanA, jawabanB, jawabanC, jawabanD, jawabanE, ekspekJawaban, ekspekA, ekspekB, ekspekC, ekspekD, ekspekE) 
					VALUES ('$r[deskripsiID]', '$r[groupId]', '$pasienID', '$asfa', '0', '0', '3', '0', '0', '$ekspek', '0', '4', '0', '0', '0')");
					break;

				case 'CC':
					mysqli_query($koneksi, "INSERT INTO tjawaban (deskripsiID, groupId, pasienID, jawaban, jawabanA, jawabanB, jawabanC, jawabanD, jawabanE, ekspekJawaban, ekspekA, ekspekB, ekspekC, ekspekD, ekspekE) 
					VALUES ('$r[deskripsiID]', '$r[groupId]', '$pasienID', '$asfa', '0', '0', '3', '0', '0', '$ekspek', '0', '0', '3', '0', '0')");
					break;

				case 'CD':
					mysqli_query($koneksi, "INSERT INTO tjawaban (deskripsiID, groupId, pasienID, jawaban, jawabanA, jawabanB, jawabanC, jawabanD, jawabanE, ekspekJawaban, ekspekA, ekspekB, ekspekC, ekspekD, ekspekE) 
					VALUES ('$r[deskripsiID]', '$r[groupId]', '$pasienID', '$asfa', '0', '0', '3', '0', '0', '$ekspek', '0', '0', '0', '2', '0')");
					break;

				case 'CE':
					mysqli_query($koneksi, "INSERT INTO tjawaban (deskripsiID, groupId, pasienID, jawaban, jawabanA, jawabanB, jawabanC, jawabanD, jawabanE, ekspekJawaban, ekspekA, ekspekB, ekspekC, ekspekD, ekspekE) 
					VALUES ('$r[deskripsiID]', '$r[groupId]', '$pasienID', '$asfa', '0', '0', '3', '0', '0', '$ekspek', '0', '0', '0', '0', '1')");
					break;
				case 'DA':
					mysqli_query($koneksi, "INSERT INTO tjawaban (deskripsiID, groupId, pasienID, jawaban, jawabanA, jawabanB, jawabanC, jawabanD, jawabanE, ekspekJawaban, ekspekA, ekspekB, ekspekC, ekspekD, ekspekE) 
					VALUES ('$r[deskripsiID]', '$r[groupId]', '$pasienID', '$asfa', '0', '0', '0', '2', '0', '$ekspek', '5', '0', '0', '0', '0')");
					break;

				case 'DB':
					mysqli_query($koneksi, "INSERT INTO tjawaban (deskripsiID, groupId, pasienID, jawaban, jawabanA, jawabanB, jawabanC, jawabanD, jawabanE, ekspekJawaban, ekspekA, ekspekB, ekspekC, ekspekD, ekspekE) 
					VALUES ('$r[deskripsiID]', '$r[groupId]', '$pasienID', '$asfa', '0', '0', '0', '2', '0', '$ekspek', '0', '4', '0', '0', '0')");
					break;

				case 'DC':
					mysqli_query($koneksi, "INSERT INTO tjawaban (deskripsiID, groupId, pasienID, jawaban, jawabanA, jawabanB, jawabanC, jawabanD, jawabanE, ekspekJawaban, ekspekA, ekspekB, ekspekC, ekspekD, ekspekE) 
					VALUES ('$r[deskripsiID]', '$r[groupId]', '$pasienID', '$asfa', '0', '0', '0', '2', '0', '$ekspek', '0', '0', '3', '0', '0')");
					break;

				case 'DD':
					mysqli_query($koneksi, "INSERT INTO tjawaban (deskripsiID, groupId, pasienID, jawaban, jawabanA, jawabanB, jawabanC, jawabanD, jawabanE, ekspekJawaban, ekspekA, ekspekB, ekspekC, ekspekD, ekspekE) 
					VALUES ('$r[deskripsiID]', '$r[groupId]', '$pasienID', '$asfa', '0', '0', '0', '2', '0', '$ekspek', '0', '0', '0', '2', '0')");
					break;

				case 'DE':
					mysqli_query($koneksi, "INSERT INTO tjawaban (deskripsiID, groupId, pasienID, jawaban, jawabanA, jawabanB, jawabanC, jawabanD, jawabanE, ekspekJawaban, ekspekA, ekspekB, ekspekC, ekspekD, ekspekE) 
					VALUES ('$r[deskripsiID]', '$r[groupId]', '$pasienID', '$asfa', '0', '0', '0', '2', '0', '$ekspek', '0', '0', '0', '0', '1')");
					break;
				case 'EA':
					mysqli_query($koneksi, "INSERT INTO tjawaban (deskripsiID, groupId, pasienID, jawaban, jawabanA, jawabanB, jawabanC, jawabanD, jawabanE, ekspekJawaban, ekspekA, ekspekB, ekspekC, ekspekD, ekspekE) 
					VALUES ('$r[deskripsiID]', '$r[groupId]', '$pasienID', '$asfa', '0', '0', '0', '0', '1', '$ekspek', '5', '0', '0', '0', '0')");
					break;

				case 'EB':
					mysqli_query($koneksi, "INSERT INTO tjawaban (deskripsiID, groupId, pasienID, jawaban, jawabanA, jawabanB, jawabanC, jawabanD, jawabanE, ekspekJawaban, ekspekA, ekspekB, ekspekC, ekspekD, ekspekE) 
					VALUES ('$r[deskripsiID]', '$r[groupId]', '$pasienID', '$asfa', '0', '0', '0', '0', '1', '$ekspek', '0', '4', '0', '0', '0')");
					break;

				case 'EC':
					mysqli_query($koneksi, "INSERT INTO tjawaban (deskripsiID, groupId, pasienID, jawaban, jawabanA, jawabanB, jawabanC, jawabanD, jawabanE, ekspekJawaban, ekspekA, ekspekB, ekspekC, ekspekD, ekspekE) 
					VALUES ('$r[deskripsiID]', '$r[groupId]', '$pasienID', '$asfa', '0', '0', '0', '0', '1', '$ekspek', '0', '0', '3', '0', '0')");
					break;

				case 'ED':
					mysqli_query($koneksi, "INSERT INTO tjawaban (deskripsiID, groupId, pasienID, jawaban, jawabanA, jawabanB, jawabanC, jawabanD, jawabanE, ekspekJawaban, ekspekA, ekspekB, ekspekC, ekspekD, ekspekE) 
					VALUES ('$r[deskripsiID]', '$r[groupId]', '$pasienID', '$asfa', '0', '0', '0', '0', '1', '$ekspek', '0', '0', '0', '2', '0')");
					break;

				default:
					mysqli_query($koneksi, "INSERT INTO tjawaban (deskripsiID, groupId, pasienID, jawaban, jawabanA, jawabanB, jawabanC, jawabanD, jawabanE, ekspekJawaban, ekspekA, ekspekB, ekspekC, ekspekD, ekspekE) 
					VALUES ('$r[deskripsiID]', '$r[groupId]', '$pasienID', '$asfa', '0', '0', '0', '0', '1', '$ekspek', '0', '0', '0', '0', '1')");
					break;
			}

			$i++;
		}

		echo "<br>";
		$no++;
	}

	echo "<center><font face='Tahoma' size='2'>
			Pasien yang kami hormati,<br><br>
			Terima kasih atas waktu yang telah diluangkan untuk melengkapi survey yang kami sediakan. <br>
			Pendapat Anda sangat berarti bagi kami untuk meningkatkan kualitas pelayanan pada Puskesmas Padang Bulan😇. <br><br>
			Hormat kami, <br><br>
			Puskesmas Padang Bulan<br></font><br>
			<a href='./index.php'>
			<button  class='btn btn-lg btn-info'><span class='glyphicon glyphicon-arrow-left'></span> Kembali</button>
			</a>
			</center>";
}

?>