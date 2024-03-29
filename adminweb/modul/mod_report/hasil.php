<script type="text/javascript" src="fusion/JS/jquery-1.4.js"></script>
<script type="text/javascript" src="fusion/JS/jquery.fusioncharts.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!-- Optional theme -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap-theme.min.css" integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>

<div class="row">
	<div class="col-lg-12">
		<h2 class="page-header mt-0">
			<i class="glyphicon glyphicon-new-window"></i> Hasil Kuisioner
		</h2>
		<ol class="breadcrumb">
			<li class="active">
				<a href="master.php?module=hasil&sub=all">Hasil Kuisioner</a>
			</li>
			<?php if ($_GET['sub'] == 'all') { ?>
				<li class="active">
					<a href="master.php?module=hasil&sub=all">Digram Keseluruhan</a>
				</li>
			<?php } ?>
			<?php if ($_GET['sub'] == 'pergroup') { ?>
				<li class="active">
					<a href="master.php?module=hasil&sub=pergroup">Diagram Per Group</a>
				</li>
			<?php } ?>
			<?php if ($_GET['sub'] == 'laporan') { ?>
				<li class="active">
					<a href="master.php?module=hasil&sub=laporan">Laporan</a>
				</li>
			<?php } ?>
		</ol>
	</div>
</div>
<nav class="navbar navbar-inverse">
	<ul class="nav navbar-nav">
		<li class="<?php if ($_GET['sub'] == 'all') {
						echo 'active';
					} ?>"><a href="?module=hasil&sub=all">Diagram Keseluruhan</a></li>
		<li class="<?php if ($_GET['sub'] == 'pergroup') {
						echo 'active';
					} ?>"><a href="?module=hasil&sub=pergroup">Diagram Per Dimensi</a></li>
		<li class="<?php if ($_GET['sub'] == 'laporan') {
						echo 'active';
					} ?>"><a href="?module=hasil&sub=laporan">Laporan</a></li>
	</ul>
</nav>
<?php
$del = mysqli_query($koneksi, "SELECT * FROM tjawaban");
$count = mysqli_query($koneksi, "SELECT * FROM tresponden");
$jlh = mysqli_num_rows($count);
$sql = mysqli_query($koneksi, "SELECT SUM(jawabanA) As TotalA,
                                    SUM(jawabanB) As TotalB,
                                    SUM(jawabanC) As TotalC,
                                    SUM(jawabanD) As TotalD,
                                    SUM(jawabanE) As TotalE,
									SUM(ekspekA) As TotalEA,
									SUM(ekspekB) As TotalEB,
									SUM(ekspekC) As TotalEC,
									SUM(ekspekD) As TotalED,
									SUM(ekspekE) As TotalEE
                                    FROM tjawaban ");

$oke = mysqli_fetch_array($sql);
$a = $oke['TotalA'];
$b = $oke['TotalB'];
$c = $oke['TotalC'];
$d = $oke['TotalD'];
$e = $oke['TotalE'];
$tot = $a + $b + $c + $d + $e;

$pa = ROUND(($a / $tot) * 100);
$pb = ROUND(($b / $tot) * 100);
$pc = ROUND(($c / $tot) * 100);
$pd = ROUND(($d / $tot) * 100);
$pe = ROUND(($e / $tot) * 100);

$ea = $oke['TotalEA'];
$eb = $oke['TotalEB'];
$ec = $oke['TotalEC'];
$ed = $oke['TotalED'];
$ee = $oke['TotalEE'];
$tot2 = $ea + $eb + $ec + $ed + $ee;

$eksA = ROUND(($ea / $tot2) * 100);
$eksB = ROUND(($eb / $tot2) * 100);
$eksC = ROUND(($ec / $tot2) * 100);
$eksD = ROUND(($ed / $tot2) * 100);
$eksE = ROUND(($ee / $tot2) * 100);


?>
<?php if ($_GET['sub'] == 'all') { ?>
	<div class="panel panel-primary">
		<div class="panel-heading">
			<div class="panel-title">Diagram Kuisioner Secara Keseluruhan</div>
		</div>
		<div class="row">
			<div class="col">
				<!-- <div class="panel-body">
					<p style="padding-left:20px; font-size:20px; display:flex;">Diagram Persepsi</p>
					<hr>
				</div> -->
				<div class="panel-body">
					<canvas id="barChart" width="600" height="300"></canvas>
				</div>
				<div class="panel-body">

					<table class="table table-striped">
						<thead>
							<tr align="center">
								<th>Data</th>
								<th>1</th>
								<th>2</th>
								<th>3</th>
								<th>4</th>
								<th>5</th>
								<th>Total</th>
							</tr>
						</thead>
						<tbody>
							<tr align="center">
								<td>Jumlah Jawaban</td>
								<td><?php echo $e; ?></td>
								<td><?php echo $d; ?></td>
								<td><?php echo $c; ?></td>
								<td><?php echo $b; ?></td>
								<td><?php echo $a; ?></td>
								<td><?php echo $tot; ?></td>
							</tr>
							<tr align="center">
								<td>Persentase</td>
								<td><?php echo $pe; ?>%</td>
								<td><?php echo $pd; ?>%</td>
								<td><?php echo $pc; ?>%</td>
								<td><?php echo $pb; ?>%</td>
								<td><?php echo $pa; ?>%</td>
								<td><?php echo ROUND($pe + $pd + $pc + $pb + $pa); ?>%</td>
							</tr>
							<tr align="center">
								<td>Jumlah Responden</td>
								<td colspan="5" align="center"><?php echo $jlh ?></td>
							</tr>
						</tbody>
					</table>
				</div>
				<hr>
			</div>
			<div class="col">
				<!-- <div class="panel-body">
					<hr>
					<p style="padding-left:20px; font-size:20px; display:flex;">Diagram Harapan</p>
				</div> -->
				<div class="panel-body">
					<canvas id="barChart2" width="600" height="300"></canvas>
				</div>
				<div class="panel-body">

					<table class="table table-striped">
						<thead>
							<tr align="center">
								<th>Data</th>
								<th>1</th>
								<th>2</th>
								<th>3</th>
								<th>4</th>
								<th>5</th>
								<th>Total</th>
							</tr>
						</thead>
						<tbody>
							<tr align="center">
								<td>Jumlah Jawaban</td>
								<td><?php echo $ee; ?></td>
								<td><?php echo $ed; ?></td>
								<td><?php echo $ec; ?></td>
								<td><?php echo $eb; ?></td>
								<td><?php echo $ea; ?></td>
								<td><?php echo $tot2; ?></td>
							</tr>
							<tr align="center">
								<td>Persentase</td>
								<td><?php echo $eksA; ?>%</td>
								<td><?php echo $eksB; ?>%</td>
								<td><?php echo $eksC; ?>%</td>
								<td><?php echo $eksD; ?>%</td>
								<td><?php echo $eksE; ?>%</td>
								<td><?php echo ROUND($eksA + $eksB + $eksC + $eksD + $eksE); ?>%</td>
							</tr>
							<tr align="center">
								<td>Jumlah Responden</td>
								<td colspan="5" align="center"><?php echo $jlh ?></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>

		</div>

	</div>
	<!-- <style>
			body {
				background: linear-gradient(to bottom, #4b0082, #ff1493);
			}
		</style> -->
	<?php
	$del = mysqli_query($koneksi, "SELECT * FROM tjawaban");
	$count = mysqli_query($koneksi, "SELECT * FROM tresponden");
	$jlh = mysqli_num_rows($count);
	$sql = mysqli_query($koneksi, "SELECT SUM(jawabanA) As TotalA,
                                    SUM(jawabanB) As TotalB,
                                    SUM(jawabanC) As TotalC,
                                    SUM(jawabanD) As TotalD,
                                    SUM(jawabanE) As TotalE,
									SUM(ekspekA) As TotalEA,
									SUM(ekspekB) As TotalEB,
									SUM(ekspekC) As TotalEC,
									SUM(ekspekD) As TotalED,
									SUM(ekspekE) As TotalEE
                                    FROM tjawaban ");

	$oke = mysqli_fetch_array($sql);
	$a = $oke['TotalA'];
	$b = $oke['TotalB'];
	$c = $oke['TotalC'];
	$d = $oke['TotalD'];
	$e = $oke['TotalE'];
	$tot = $a + $b + $c + $d + $e;

	$pa = ROUND(($a / $tot) * 100);
	$pb = ROUND(($b / $tot) * 100);
	$pc = ROUND(($c / $tot) * 100);
	$pd = ROUND(($d / $tot) * 100);
	$pe = ROUND(($e / $tot) * 100);

	$ea = $oke['TotalEA'];
	$eb = $oke['TotalEB'];
	$ec = $oke['TotalEC'];
	$ed = $oke['TotalED'];
	$ee = $oke['TotalEE'];
	$tot2 = $ea + $eb + $ec + $ed + $ee;

	$eksA = ROUND(($ea / $tot2) * 100);
	$eksB = ROUND(($eb / $tot2) * 100);
	$eksC = ROUND(($ec / $tot2) * 100);
	$eksD = ROUND(($ed / $tot2) * 100);
	$eksE = ROUND(($ee / $tot2) * 100);

	?>
	<script>
		var barChartConfig = {
			type: 'bar',
			data: {
				labels: ['1', '2', '3', '4', '5'],
				datasets: [{
					label: 'Diagram Persepsi',
					data: [<?php echo $e; ?>, <?php echo $d; ?>, <?php echo $c; ?>, <?php echo $b; ?>, <?php echo $a; ?>],
					backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4CAF50', '#9C27B0'],
					borderColor: '#fff',
					borderWidth: 1
				}]
			},
			options: {
				responsive: true,
				maintainAspectRatio: false,
				scales: {
					x: {
						beginAtZero: false
					},
					y: {
						beginAtZero: true
					}
				}
			}
		};
		var barChartCanvas = document.getElementById('barChart').getContext('2d');
		var barChart = new Chart(barChartCanvas, barChartConfig);
	</script>
	<script>
		var barChartConfig = {
			type: 'bar',
			data: {
				labels: ['1', '2', '3', '4', '5'],
				datasets: [{
					label: 'Diagram Harapan',
					data: [<?php echo $ee; ?>, <?php echo $ed; ?>, <?php echo $ec; ?>, <?php echo $eb; ?>, <?php echo $ea; ?>],
					backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4CAF50', '#9C27B0'],
					borderColor: '#fff',
					borderWidth: 1
				}]
			},
			options: {
				responsive: true,
				maintainAspectRatio: false,
				scales: {
					x: {
						beginAtZero: true
					},
					y: {
						beginAtZero: true
					}
				}
			}
		};
		var barChartCanvas = document.getElementById('barChart2').getContext('2d');
		var barChart = new Chart(barChartCanvas, barChartConfig);
	</script>
	<div class="panel-body">
		<h3>Persepsi</h3>
		<?php
		// Fetch the descriptions outside the loop
		$descriptionsQuery = mysqli_query($koneksi, "SELECT * FROM tdeskripsi ORDER BY groupId");
		$descriptions = mysqli_fetch_all($descriptionsQuery, MYSQLI_ASSOC);
		// Initialize arrays to store total scores and means
		$totals = array();
		$totalsRespondents = array();
		// Begin your table
		?>
		<table class="table table-responsive table-striped table-hover" border="1">
			<thead>
				<tr class="bg-primary">
					<th></th>
					<?php
					$i = 1;
					// Loop through the fetched descriptions to generate table header
					foreach ($descriptions as $description) {
					?>
						<th><?php echo "A" . $i++; ?></th>
					<?php
					}
					?>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>Total</td>
					<?php
					// Loop through the fetched descriptions to generate total scores
					foreach ($descriptions as $description) {
						$deskripsiID = $description['deskripsiID'];
						// Query to get the total score for the current description ID
						$totalQuery = mysqli_query($koneksi, "SELECT SUM(jawabanA) AS totalA,
                    SUM(jawabanB) as totalB,
                    SUM(jawabanC) as totalC,
                    SUM(jawabanD) as totalD,
                    SUM(jawabanE) as totalE
                    FROM tjawaban WHERE deskripsiID = '$deskripsiID' ORDER BY groupId");
						// Fetch the total scores
						$totalsRow = mysqli_fetch_assoc($totalQuery);
						// Sum the total scores
						$totalPoints = array_sum($totalsRow);
						// Store the total score in the array
						$totals[] = $totalPoints;
						// Query to get the count of rows for the current description ID
						$rowCountQuery = mysqli_query($koneksi, "SELECT COUNT(*) AS rowCount FROM tjawaban WHERE deskripsiID = '$deskripsiID'");
						$rowCount = mysqli_fetch_assoc($rowCountQuery)['rowCount'];
						// Store the number of respondents in the array
						$totalsRespondents[] = $rowCount;
					?>
						<td><?php echo $totalPoints; ?></td>
					<?php
					}
					?>
				</tr>
				<tr>
					<td>Mean</td>
					<?php
					// Loop through the fetched descriptions again to generate means
					foreach ($totals as $key => $totalPoints) {
						// Calculate the mean for the current description ID
						$mean = $totalsRespondents[$key] > 0 ? $totalPoints / $totalsRespondents[$key] : 0;
						// Display the mean in the table cells
					?>
						<td><?php echo number_format($mean, 2); ?></td>
					<?php
					}
					?>
				</tr>
				<tr>
					<!-- Display the overall total of each column -->
				</tr>
			</tbody>
		</table>
		<?php
		// Fetch the descriptions outside the loop
		$descriptionsQuery = mysqli_query($koneksi, "SELECT * FROM tdeskripsi ORDER BY groupId");
		$descriptions = mysqli_fetch_all($descriptionsQuery, MYSQLI_ASSOC);
		// Initialize arrays to store total scores and means
		$totals = array();
		$totalsRespondents = array();
		// Begin your table
		?>
		<h3>Harapan</h3>
		<table class="table table-responsive table-striped table-hover" border="1">
			<thead>
				<tr class="bg-primary">
					<th></th>
					<?php
					$i = 1;
					// Loop through the fetched descriptions to generate table header
					foreach ($descriptions as $description) {
					?>
						<th><?php echo "H" . $i++; ?></th>
					<?php
					}
					?>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>Total</td>
					<?php
					// Loop through the fetched descriptions to generate total scores
					foreach ($descriptions as $description) {
						$deskripsiID = $description['deskripsiID'];
						// Query to get the total score for the current description ID
						$totalQuery = mysqli_query($koneksi, "SELECT SUM(ekspekA) AS totalA,
                    SUM(ekspekB) as totalB,
                    SUM(ekspekC) as totalC,
                    SUM(ekspekD) as totalD,
                    SUM(ekspekE) as totalE
                    FROM tjawaban WHERE deskripsiID = '$deskripsiID' ORDER BY groupId");
						// Fetch the total scores
						$totalsRow = mysqli_fetch_assoc($totalQuery);
						// Sum the total scores
						$totalPoints = array_sum($totalsRow);
						// Store the total score in the array
						$totals[] = $totalPoints;
						// Query to get the count of rows for the current description ID
						$rowCountQuery = mysqli_query($koneksi, "SELECT COUNT(*) AS rowCount FROM tjawaban WHERE deskripsiID = '$deskripsiID'");
						$rowCount = mysqli_fetch_assoc($rowCountQuery)['rowCount'];
						// Store the number of respondents in the array
						$totalsRespondents[] = $rowCount;
					?>
						<td><?php echo $totalPoints; ?></td>
					<?php
					}
					?>
				</tr>
				<tr>
					<td>Mean</td>
					<?php
					// Loop through the fetched descriptions again to generate means
					foreach ($totals as $key => $totalPoints) {
						// Calculate the mean for the current description ID
						$mean = $totalsRespondents[$key] > 0 ? $totalPoints / $totalsRespondents[$key] : 0;

						// Display the mean in the table cells
					?>
						<td><?php echo number_format($mean, 2); ?></td>
					<?php
					}
					?>
				</tr>
				<tr>
					<!-- Display the overall total of each column -->
				</tr>
			</tbody>
		</table>
		<h3>Gap</h3>
		<table class="table  table-responsive table-striped" border="1">
			<thead>
				<tr class="bg-primary tabel">
					<th>No</th>
					<th>Persepsi</th>
					<th>Harapan</th>
					<th>Gap</th>
					<th>Keterangan</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$r = mysqli_query($koneksi, "SELECT * FROM tdeskripsi ORDER BY groupId");
				$p = mysqli_num_rows($r);

				// Initialize arrays to store total scores and means
				$totalsExpectation = array();
				$totalsReality = array();
				$totalsRespondents = array();

				$i = 1; // Initialize column number

				// Loop through the fetched descriptions to generate total scores
				foreach ($descriptions as $description) {
					$deskripsiID = $description['deskripsiID'];

					// Query to get the total score for the current description ID (Expectation)
					$totalExpectationQuery = mysqli_query($koneksi, "SELECT SUM(ekspekA) AS totalA,
                        SUM(ekspekB) as totalB,
                        SUM(ekspekC) as totalC,
                        SUM(ekspekD) as totalD,
                        SUM(ekspekE) as totalE
                        FROM tjawaban WHERE deskripsiID = '$deskripsiID' ORDER BY groupId");
					$totalsRowExpectation = mysqli_fetch_assoc($totalExpectationQuery);
					$totalPointsExpectation = array_sum($totalsRowExpectation);

					// Store the total score in the array
					$totalsExpectation[] = $totalPointsExpectation;

					// Query to get the count of rows for the current description ID
					$rowCountQueryExpectation = mysqli_query($koneksi, "SELECT COUNT(*) AS rowCount FROM tjawaban WHERE deskripsiID = '$deskripsiID'");
					$rowCountExpectation = mysqli_fetch_assoc($rowCountQueryExpectation)['rowCount'];

					// Store the number of respondents in the array
					$totalsRespondents[] = $rowCountExpectation;

					// Query to get the total score for the current description ID (Reality)
					$totalRealityQuery = mysqli_query($koneksi, "SELECT SUM(jawabanA) AS totalA,
                        SUM(jawabanB) as totalB,
                        SUM(jawabanC) as totalC,
                        SUM(jawabanD) as totalD,
                        SUM(jawabanE) as totalE
                        FROM tjawaban WHERE deskripsiID = '$deskripsiID' ORDER BY groupId");
					$totalsRowReality = mysqli_fetch_assoc($totalRealityQuery);
					$totalPointsReality = array_sum($totalsRowReality);

					// Store the total score in the array
					$totalsReality[] = $totalPointsReality;

					// Query to get the count of rows for the current description ID
					$rowCountQueryReality = mysqli_query($koneksi, "SELECT COUNT(*) AS rowCount FROM tjawaban WHERE deskripsiID = '$deskripsiID'");
					$rowCountReality = mysqli_fetch_assoc($rowCountQueryReality)['rowCount'];

					// Store the number of respondents in the array
					$totalsRespondents[] = $rowCountReality;
					$gaps = array();

					$gap = (($totalPointsReality / $rowCountReality) - ($totalPointsExpectation / $rowCountExpectation));
					$gaps[] = $gap;
					// var_dump($gaps);

					// Display the column number and other data
					echo "<tr>";
					echo "<td>$i</td>";
					echo "<td>" . number_format(($totalPointsReality / $rowCountReality), 2) . "</td>";
					echo "<td>" . number_format(($totalPointsExpectation / $rowCountExpectation), 2) . "</td>";
					echo "<td>" . number_format($gap, 3) . "</td>";

					// Check if $gap is greater than or equal to 0
					echo "<td>";
					if ($gap >= 0) {
						echo "Optimalkan";
					} else {
						echo "Lebih Diperbaiki";
					}
					// echo "</td>";
					// $gap = $gaps[$i - 1];

					// echo "<td>";
					// if ($gap == max($gaps)) {
					// 	echo "Variabel tertinggi";
					// } elseif ($gap == min($gaps)) {
					// 	echo "Variabel terendah";
					// }
					// echo "</td>";
					// var_dump(max($gaps));
					$i++; // Increment column number
				}
				?>
				</tr>
			</tbody>
		</table>
	<?php } ?>
	</div>
	</div>
	<style>
		.tabel th,
		tr {
			text-align: center;
			align-items: center;
		}
	</style>
	<?php if ($_GET['sub'] == 'pergroup') { ?>
		<?php
		error_reporting(1);
		$result = mysqli_query($koneksi, "SELECT groupId, namaGroup from tgroup group by groupId ");
		$kolom = 2;
		$array = array();
		while ($sql = mysqli_fetch_array($result)) {
			array_push($array, $sql);
		}
		$chunks = array_chunk($array, $kolom);
		foreach ($chunks as $chunk) {
			foreach ($chunk as $data) {
		?>
				<div class="panel panel-primary col-md-6">
					<div class="panel-heading">
						<div class="panel-title"><?php echo $data['namaGroup']; ?></div>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-md-12">
								<canvas id="barChart<?php echo $data['groupId']; ?>" width="500" height="300"></canvas>
							</div>
						</div>
						<div class="row mt-2">
							<div class="col-md-12">
								<?php
								$sql = mysqli_query($koneksi, "SELECT SUM(jawabanA) AS TotalA,
                                                            SUM(jawabanB) As TotalB,
                                                            SUM(jawabanC) As TotalC,
                                                            SUM(jawabanD) As TotalD,
                                                            SUM(jawabanE) As TotalE
                                                            FROM tjawaban WHERE groupId='$data[groupId]' ");

								$oke = mysqli_fetch_array($sql);
								$a = $oke['TotalA'];
								$b = $oke['TotalB'];
								$c = $oke['TotalC'];
								$d = $oke['TotalD'];
								$e = $oke['TotalE'];
								$tot = $a + $b + $c + $d + $e;

								$pa = ROUND(($a / $tot) * 100);
								$pb = ROUND(($b / $tot) * 100);
								$pc = ROUND(($c / $tot) * 100);
								$pd = ROUND(($d / $tot) * 100);
								$pe = ROUND(($e / $tot) * 100);
								?>
								<table class="table table-striped">
									<thead>
										<tr>
											<th align="right">Data</th>
											<th align="right">1</th>
											<th align="right">2</th>
											<th align="right">3</th>
											<th align="right">4</th>
											<th align="right">5</th>
										</tr>
									</thead>
									<tbody>
										<tr align="left">
											<td align="left">Jumlah Jawaban</td>
											<td align="left"><?php echo $e; ?></td>
											<td align="left"><?php echo $d; ?></td>
											<td align="left"><?php echo $c; ?></td>
											<td align="left"><?php echo $b; ?></td>
											<td align="left"><?php echo $a; ?></td>
										</tr>
										<tr align="left">
											<td align="left">Persentase</td>
											<td align="left"><?php echo $pa; ?>%</td>
											<td align="left"><?php echo $pb; ?>%</td>
											<td align="left"><?php echo $pc; ?>%</td>
											<td align="left"><?php echo $pd; ?>%</td>
											<td align="left"><?php echo $pe; ?>%</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
						<script>
							var barChartConfig<?php echo $data['groupId']; ?> = {
								type: 'bar',
								data: {
									labels: ['1', '2', '3', '4', '5'],
									datasets: [{
										data: [<?php echo $e; ?>, <?php echo $d; ?>, <?php echo $c; ?>, <?php echo $b; ?>, <?php echo $a; ?>],
										backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4CAF50', '#9C27B0'],
										borderColor: '#fff',
										borderWidth: 1,
										label: '<?php echo $data['namaGroup']; ?>'
									}]
								},
								options: {
									responsive: true,
									maintainAspectRatio: false,
									scales: {
										x: {
											beginAtZero: true
										},
										y: {
											beginAtZero: true
										}
									}
								}
							};
							var barChartCanvas<?php echo $data['groupId']; ?> = document.getElementById('barChart<?php echo $data['groupId']; ?>').getContext('2d');
							var barChart<?php echo $data['groupId']; ?> = new Chart(barChartCanvas<?php echo $data['groupId']; ?>, barChartConfig<?php echo $data['groupId']; ?>);
						</script>
					</div>
				</div>
		<?php
			}
		}
		?>
	<?php } ?>
	<?php if ($_GET['sub'] == 'laporan') { ?>
		<div class="panel panel-primary">
			<div class="panel-heading">
				<div class="panel-title">
					<b>Daftar Responden</b><button style="margin-left:710px;" class='btn btn-sm btn-success' value='Print All to Excel' onclick=location.href='modul/mod_report/all_responden.php'><span class="glyphicon glyphicon-zoom-in"></span> Rekap Semua Kuisioner</button>
				</div>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-5">
						<div class="panel panel-default">
							<div class="panel-heading">
								<div class="panel-title"> Tampilkan Berdasarkan Tanggal</div>
							</div>
							<div class="panel-body">
								<form action="?module=hasil&sub=laporan&tampilkan=pertanggal" method="post" class="form-horizontal">
									<?php include "../fungsi/fungsi_combobox.php";
									include "../fungsi/library.php"; ?>
									<div class="form-group">
										<label for="tanggal1" class="control-label col-sm-4">Dari tanggal</label>
										<div class="col-sm-7">
											<?php combotgl(01, 31, 'tgl_mulai', $tgl_skrg);
											combobln(01, 12, 'bln_mulai', $bln_sekarang);
											combothn(2000, $thn_sekarang, 'thn_mulai', $thn_sekarang);
											?>
										</div>
									</div>
									<div class="form-group">
										<label for="tanggal2" class="control-label col-sm-4">s/d Tanggal</label>
										<div class="col-sm-7">
											<?php combotgl(01, 31, 'tgl_selesai', $tgl_skrg);
											combobln(01, 12, 'bln_selesai', $bln_sekarang);
											combothn(2000, $thn_sekarang, 'thn_selesai', $thn_sekarang);
											?>
										</div>
									</div>
									<div class="col-sm-4">
										<input type="hidden" name="pertanggal" value="pertanggal">
									</div>
									<div class="col-sm-4">
										<button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-search"></span> Oke</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<?php if ($_GET['tampilkan'] == 'pertanggal') {
					$tgl_awal = $_POST['thn_mulai'] . "-" . $_POST['bln_mulai'] . "-" . $_POST['tgl_mulai'];
					$tgl_akhir = $_POST['thn_selesai'] . "-" . $_POST['bln_selesai'] . "-" . $_POST['tgl_selesai'];
					// $awalindo = tgl_indo($tgl_awal);
					// $akhirindo = tgl_indo($tgl_akhir);
				?>
					<div class="alert alert-info" role="alert">
						Menampilkan data dari tanggal <b><?php echo $tgl_awal . " Sampai dengan " . $tgl_akhir ?><b>
					</div>
					<table id="tablekonten" class="table table-striped table-bordered">
						<th>
							<div id='kontentd'>No</div>
						</th>
						<th>
							<div id='kontentd'>Nama Pasien</div>
						</th>
						<th>Tanggal Isi Survey</th>
						<th>
							<div id='kontentd'>Aksi</div>
						</th>
						</tr>
						<?php
						include "../../koneksi.php";
						include "../../fungsi/fungsi_indotgl.php";
						error_reporting(1);
						$jumlahdata = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM tresponden WHERE tgl_survei BETWEEN '$tgl_awal' AND '$tgl_akhir'"));
						$sql = mysqli_query($koneksi, "SELECT * FROM tresponden WHERE tgl_survei BETWEEN '$tgl_awal' AND '$tgl_akhir' ORDER by namaPasien ");
						$no = 1;
						while ($data = mysqli_fetch_array($sql)) {
							$dateIndo = $data['tgl_survei'];
						?>
							<tr>
								<td>
									<div id='kontentd'><?php echo $no; ?></div>
								</td>
								<td>
									<div id='kontentd'><?php echo $data['namaPasien'] ?></div>
								</td>
								<td><?php echo $dateIndo ?></td>
								<td>
									<div id='kontentd'><a target='_blank' href='modul/mod_report/responden.php?act=detail&id=<?php echo $data['pasienID']; ?>'>
											<button class='btn btn-sm btn-success'><span class="\glyphicon glyphicon-zoom-in\"></span> Detail</button></a>
										<?php if ($_SESSION['level'] == "Super") { ?><a href='modul/mod_report/responden.php?act=hapus&id=<?php echo $data['pasienID'] ?>'>
												<button class='btn btn-sm btn-danger' onclick="\return confirm('Hapus Deskripsi?')\"><span class="\glyphicon glyphicon-trash\"></span> Hapus</button></a><?php } ?>
									</div>
								</td>
							</tr>
						<?php
							$no++;
						}
						?>
					</table>
					<div class="col-md-12">
						<div class="well">
							<?php echo "Jumlah Responden : <font face='tahoma' size='3'><b>$jumlahdata </b> Responden</font>"; ?>
						</div>
					</div>
				<?php
				} else { ?>
					<div class="alert alert-info" role="alert">
						<strong>Menampilkan semua hasil survey</strong>
					</div>
					<table id="tablekonten" class="table table-striped table-bordered">
						<th align="center">
							<div id='kontentd'>No</div>
						</th>
						<th align="center">
							<div id='kontentd'>Nama Pasien</div>
						</th>
						<th align="center">Tanggal Isi Survey</th>
						<th align="center">
							<div id='kontentd'>Aksi</div>
						</th>
						</tr>
						<?php
						include "../../koneksi.php";
						include "../../fungsi/fungsi_indotgl.php";
						error_reporting(1);
						$jumlahdata = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM tresponden "));
						$p      = new PagingHasil;
						$batas  = 10;
						$posisi = $p->cariPosisi($batas);
						$sql = mysqli_query($koneksi, "SELECT * FROM tresponden  ORDER by namaPasien ASC LIMIT $posisi,$batas");
						$no = $posisi + 1;
						while ($data = mysqli_fetch_array($sql)) {
							$dateIndo = $data['tgl_survei'];
						?>
							<tr>
								<td>
									<div id='kontentd'><?php echo $no; ?></div>
								</td>
								<td align="left">
									<div><?php echo $data['namaPasien'] ?></div>
								</td>
								<td><?php echo $dateIndo ?></td>
								<td>
									<div id='kontentd'><a target='_blank' href='modul/mod_report/responden.php?act=detail&id=<?php echo $data['pasienID']; ?>'>
											<button class='btn btn-sm btn-success'><span class="\glyphicon glyphicon-zoom-in\"></span> Detail</button></a>
										<?php if ($_SESSION['level'] == "Super") { ?><a href='modul/mod_report/responden.php?act=hapus&id=<?php echo $data['pasienID'] ?>'>
												<button class='btn btn-sm btn-danger' onclick="\return confirm('Hapus Deskripsi?')\"><span class="\glyphicon glyphicon-trash\"></span> Hapus</button></a><?php } ?>
									</div>
								</td>
							</tr>
						<?php
							$no++;
						}
						?>
					</table>
					<div class="col-md-12">
						<div class="well">
							<?php echo "Jumlah Responden : <font face='tahoma' size='3'><b>$jumlahdata </b> Responden</font>"; ?>
						</div>
					</div>
				<?php
					$jmldata = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM tresponden "));
					$jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
					$linkHalaman = $p->navHalaman($_GET['halaman'], $jmlhalaman);
					echo "<ul class='pagination'>$linkHalaman</ul> ";
				}
				?>
			</div>
		</div>
	<?php
	} ?>