<style>
	.btn {
		display: inline-block;
		padding: 6px 12px;
		font-size: 14px;
		font-weight: normal;
		line-height: 1.42857143;
		text-align: center;
		white-space: nowrap;
		vertical-align: middle;
		-ms-touch-action: manipulation;
		touch-action: manipulation;
		cursor: pointer;
		-webkit-user-select: none;
		-moz-user-select: none;
		-ms-user-select: none;
		user-select: none;
		background-image: none;
		border: 1px solid transparent;
		border-radius: 4px;
		background-color: #5cb85c;
		padding: 5px 10px;
		font-size: 12px;
		line-height: 1.5;
		border-radius: 3px;
		margin-top: 10px;
		margin-bottom: 10px;
		color: white;
	}

	@font-face {
		font-family: 'Glyphicons Halflings';

		src: url('../../../fonts/glyphicons-halflings-regular.eot');
		src: url('../../../fonts/glyphicons-halflings-regular.eot?#iefix') format('embedded-opentype'), url('../../../fonts/glyphicons-halflings-regular.woff2') format('woff2'), url('../../../fonts/glyphicons-halflings-regular.woff') format('woff'), url('../../../fonts/glyphicons-halflings-regular.ttf') format('truetype'), url('../../../fonts/glyphicons-halflings-regular.svg#glyphicons_halflingsregular') format('svg');
	}

	.glyphicon {
		position: relative;
		top: 1px;
		display: inline-block;
		font-family: 'Glyphicons Halflings';
		font-style: normal;
		font-weight: normal;
		line-height: 1;

		-webkit-font-smoothing: antialiased;
		-moz-osx-font-smoothing: grayscale;
	}

	.glyphicon-print:before {
		content: "\e045";
	}

	.glyphicon-arrow-left:before {
		content: "\e091";
	}
</style>
<script>
	$(document).ready(function() {
		$('.val').each(function() {
			var nilai = parseFloat($(this).text());
			if (!isNaN(nilai) && nilai > 0) {
				$(this).css('background-color', 'green');
			} else {
				$(this).css('background-color', 'red');
			}
		});
	});
</script>
<?php
if ($_GET['act'] == 'detail') {
	error_reporting(1);
	session_start();


	include "../../../koneksi.php";
	include "../../../fungsi/fungsi_indotgl.php";
	include "../../../fungsi/fungsi_rubah_tanda.php";

	$hasil = mysqli_query($koneksi, "SELECT * FROM tdeskripsi ORDER BY groupId ASC");
	$date = date('Y-m-d');
	$time = date('H:i:s');

	$responden = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM tjawaban, tresponden WHERE tjawaban.pasienID = '$_GET[id]' AND tresponden.pasienID = tjawaban.pasienID ORDER BY tresponden.pasienID ASC"));
	$dateIndo = tgl_indo($responden['tgl_survei']);
	// var_dump($_GET);
	echo "<center><table border=0 cellpadding=10 cellspacing=3 bgcolor= #e6e6e6>
		<tr >
			<td colspan='8'  bgcolor=#337ab7 style='border: none ;color:white;'>
			<a href='../../master.php?module=hasil&sub=laporan'>
			<button style='margin-right:220px;' class='btn'><span class='glyphicon glyphicon-arrow-left'></span> Kembali</button>
			</a>
			<b><font size=5>LAPORAN KUISIONER RESPONDEN</font></b>
			<a href='exportExcelResponden.php?id=$_GET[id]'>
			<button style='margin-left:200px;' class='btn'><span class='glyphicon glyphicon-print'></span> Cetak</button></a>
			</td>
		</tr>
		<tr>
			<td >Nama Responden</td> <td>:</td><td colspan='6'><b>{$responden['namaPasien']}</b></td>
		</tr>
		<tr>
			<td >Jenis Kelamin</td><td width='1'>:</td><td><b>{$responden['jenisKelamin']}</b></td>
		</tr>
		<tr>
			<td >Umur</td> <td>:</td><td> <b>{$responden['umur']}</b></td>
		</tr>
		<tr>
			<td width=150>Tanggal Isi Survey</td> <td width=1>:</td><td > <b>{$responden['tgl_survei']} </b></td>
		</tr>
		<tr>
			<td >Kritik dan Saran</td> <td>:</td><td> <b>{$responden['saran']}</b></td>
		</tr>
		
		<tr>
			<td  colspan=8 >
				<table border=1 cellpadding=2 bgcolor='#fff'>
					<tr>
					<td bgcolor=#c6e1f2 align=center><b>NO</b></td>
					<td bgcolor=#c6e1f2 align=center><b>Group ID</b></td>
					<td bgcolor=#c6e1f2 align=center><b>DESCRIPTION</b></td>
					<td bgcolor=#c6e1f2 align=center><b>PERSEPSI A</b></td>
					<td bgcolor=#c6e1f2 align=center><b>PERSEPSI B</b></td>
					<td bgcolor=#c6e1f2 align=center><b>PERSEPSI C</b></td>
					<td bgcolor=#c6e1f2 align=center><b>PERSEPSI D</b></td>
					<td bgcolor=#c6e1f2 align=center><b>PERSEPSI E</b></td>
					<td bgcolor=#5cb85c align=center><b>HARAPAN A</b></td>
					<td bgcolor=#5cb85c align=center><b>HARAPAN B</b></td>
					<td bgcolor=#5cb85c align=center><b>HARAPAN C</b></td>
					<td bgcolor=#5cb85c align=center><b>HARAPAN D</b></td>
					<td bgcolor=#5cb85c align=center><b>HARAPAN E</b></td>
					</tr>";

	$no = 1;
	while ($data = mysqli_fetch_array($hasil)) {
		$deskripsiID = $data['deskripsiID'];
		$sql = mysqli_query($koneksi, "SELECT SUM(jawabanA) As TotalA,
							SUM(jawabanB) As TotalB,
							SUM(jawabanC) As TotalC,
							SUM(jawabanD) As TotalD,
							SUM(jawabanE) As TotalE,
							SUM(ekspekA) As ekspekA,
							SUM(ekspekB) As ekspekB,
							SUM(ekspekC) As ekspekC,
							SUM(ekspekD) As ekspekD,
							SUM(ekspekE) As ekspekE
							FROM tjawaban WHERE deskripsiID = '$deskripsiID' AND pasienID = '$_GET[id]'");

		while ($oke = mysqli_fetch_array($sql)) {
			$a = rubah($oke['TotalA']);
			$b = rubah($oke['TotalB']);
			$c = rubah($oke['TotalC']);
			$d = rubah($oke['TotalD']);
			$e = rubah($oke['TotalE']);
			$f = rubah($oke['ekspekA']);
			$g = rubah($oke['ekspekB']);
			$h = rubah($oke['ekspekC']);
			$i = rubah($oke['ekspekD']);
			$j = rubah($oke['ekspekE']);
			echo "<tr valign=top >
					<td align='center'>$no</td>
					<td align='center'>{$data['groupId']}</td>
					<td>{$data['deskripsi']}</td>
					<td align='center' class='val'>$e</td>
					<td align='center' class='val'>$d</td>
					<td align='center' class='val'>$c</td>
					<td align='center' class='val'>$b</td>
					<td align='center' class='val'>$a</td>
					<td align='center' class='val'>$j</td>
					<td align='center' class='val'>$i</td>
					<td align='center' class='val'>$h</td>
					<td align='center' class='val'>$g</td>
					<td align='center' class='val'>$f</td>
				</tr>";

			$no++;
		}
	}
}


if ($_GET['act'] == 'hapus') {
	include "../../../koneksi.php";
	mysqli_query($koneksi, "DELETE FROM tresponden WHERE pasienID='$_GET[id]'");

	header('location:../../master.php?module=hasil&sub=laporan');
}
?>