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
<?php
error_reporting(1);


include "../../../koneksi.php";
include "../../../fungsi/fungsi_indotgl.php";

$hasil = mysqli_query($koneksi, "SELECT * FROM tdeskripsi ORDER BY groupId");
$date = date('Y-m-d');
$time = date('H:i:s');
$dateIndo = tgl_indo($date);

echo "<center><table border=0 cellpadding=10 cellspacing=5 bgcolor= #e6e6e6>
		<tr >
			<td colspan='8'  bgcolor=#337ab7 style='border: none ;color:white;'>
			<a href='../../master.php?module=hasil&sub=laporan'>
			<button style='margin-right:230px;' class='btn'><span class='glyphicon glyphicon-arrow-left'></span> Kembali</button>
			</a>
			<b><font size=5>REKAP KUISIONER RESPONDEN</font></b>
			<a href='exportExcel.php'>
			<button style='margin-left:230px;' class='btn'><span class='glyphicon glyphicon-print'></span> Cetak</button></a>
			</td>
		</tr>
		<tr>
			<td colspan=2>Dicetak : <b>$dateIndo $time</b></td>
		</tr>
		
		<tr>
			<td>
				<table cellpadding=2 border=2 bgcolor='#fff'>
					<tr>
						<td bgcolor=#c6e1f2 align=center><b>NO</b></td>
						<td bgcolor=#c6e1f2 align=center><b>GROUP ID</b></td>
						<td bgcolor=#c6e1f2 align=center><b>DESCRIPTION</b></td>
						<td bgcolor=#c6e1f2 align=center><b>TOTAL KENYATAAN</b></td>
						<td bgcolor=#c6e1f2 align=center><b>RATA-RATA KENYATAAN</b></td>
						<td bgcolor=#c6e1f2 align=center><b>TOTAL HARAPAN</b></td>
						<td bgcolor=#c6e1f2 align=center><b>RATA-RATA HARAPAN</b></td>
						<td bgcolor=#c6e1f2 align=center><b>SERVQUAL</b></td>
						<td bgcolor=#c6e1f2 align=center><b>KETERANGAN</b></td>
					</tr>";

$no = 1;
while ($data = mysqli_fetch_array($hasil)) {
	$descriptionId = $data['deskripsiID'];
	$sql = mysqli_query($koneksi, "SELECT SUM(jawabanA) As TotalA,
                                        SUM(jawabanB) As TotalB,
                                        SUM(jawabanC) As TotalC,
                                        SUM(jawabanD) As TotalD,
                                        SUM(jawabanE) As TotalE
                                    FROM tjawaban WHERE deskripsiID = '$descriptionId'");

	$oke = mysqli_fetch_array($sql);
	$tot = $oke['TotalA'] + $oke['TotalB'] + $oke['TotalC'] + $oke['TotalD'] + $oke['TotalE'];
	$jumlah = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM tresponden "));
	$r_persepsi = $tot / $jumlah;
	$r_persepsi2 = number_format($r_persepsi, 2);
	$sql = mysqli_query($koneksi, "SELECT SUM(ekspekA) As TotalAe,
                                        SUM(ekspekB) As TotalBe,
                                        SUM(ekspekC) As TotalCe,
                                        SUM(ekspekD) As TotalDe,
                                        SUM(ekspekE) As TotalEe
                                    FROM tjawaban WHERE deskripsiID = '$descriptionId'");

	$oke = mysqli_fetch_array($sql);
	$tot = $oke['TotalAe'] + $oke['TotalBe'] + $oke['TotalCe'] + $oke['TotalDe'] + $oke['TotalEe'];
	$jumlah = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM tresponden "));
	$r_harapan = $tot / $jumlah;
	$r_harapan2 = number_format($r_harapan, 2);
	$serv = $r_persepsi - $r_harapan;
	$serv2 = number_format($serv, 3);

	echo "<tr valign=top>
            <td align='center'>$no</td>
            <td align='center'>$data[groupId]</td>
            <td>$data[deskripsi]</td>
            <td align='center'>$tot</td>
            <td align='center'>$r_persepsi2</td>
            <td align='center'>$tot</td>
            <td align='center'>$r_harapan2</td>
            <td align='center'>$serv2</td>
            <td align='center'>";
	if ($serv >= 0) {
		echo "Optimalkan";
	} else {
		echo "Lebih Diperbaiki";
	}
	"</td>
        </tr>";
	$no++;
}

$data_count = mysqli_fetch_array(mysqli_query($koneksi, "SELECT SUM(jawabanA) As TotalA,
                                                            SUM(jawabanB) As TotalB,
                                                            SUM(jawabanC) As TotalC,
                                                            SUM(jawabanD) As TotalD,
                                                            SUM(jawabanE) As TotalE
                                                        FROM tjawaban"));
// echo "<tr align='center'>
//         <td bgcolor=#c6e1f2 colspan='3'><b>Total</b></td>
//         <td bgcolor=#c6e1f2><b>$data_count[TotalA]</b></td>
//         <td bgcolor=#c6e1f2><b>$data_count[TotalB]</b></td>
//         <td bgcolor=#c6e1f2><b>$data_count[TotalC]</b></td>
//         <td bgcolor=#c6e1f2><b>$data_count[TotalD]</b></td>
//         <td bgcolor=#c6e1f2><b>$data_count[TotalE]</b></td>
//     </tr>
echo "
</table>
</td>
</tr>
</table>
<center>";
?>