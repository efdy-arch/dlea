<script language="javascript">
	function validasideskripsi(form) {
		if (form.groupId.value == 0) {
			alert("Anda belum mengisikan nama group.");
			form.groupId.focus();
			return (false);
		}
		if (form.deskripsi.value == "") {
			alert("Anda belum mengisikan deskripsi.");
			form.deskripsi.focus();
			return (false);
		}
	}
</script>
<?php
$aksi = "modul/mod_deskripsi/aksi_deskripsi.php";
switch ($_GET['act']) {
		// Tampil deskripsi
	default:
?>
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">
					<i class="glyphicon glyphicon-book"></i> Manajemen Pertanyaan Kuesioner
				</h1>
				<ol class="breadcrumb">
					<li class="active">
						<a href="master.php?module=description">Manajemen Pertanyaan Kuesioner</a>
					</li>
				</ol>
			</div>
		</div>
		<div class="panel panel-primary">
			<div class="panel-heading">

				<div class="panel-title"><span class="glyphicon glyphicon-list"></span> Manajemen Pertanyaan Kuesioner <i style="margin-left:710px;"><?php if ($_SESSION['level'] == "Super") { ?><button class="btn btn-success btn-sm " onclick="window.location.href='?module=description&act=tambahpertanyaan'"><span class="glyphicon glyphicon-plus"></span> Tambah Deskripsi </button></i><?php } ?></div>
			</div>
			<div class="panel-body">
				<table id="tablekonten" class="table table-striped table-bordered table-responsive">
					<thead>
						<th width="1%">
							<div id="konten">No</div>
						</th>
						<th width="10%">
							<div id="konten">Nama Deskripsi</div>
						</th>

						<th width="10%">
							<div id="konten">Aksi</div>
						</th>

					</thead>
					<tbody>
						<?php
						$p = new PagingSoal();
						$batas = 10;
						$posisi = $p->cariPosisi($batas);
						$tampil = mysqli_query($koneksi, "SELECT * FROM tdeskripsi ORDER BY groupId ASC LIMIT $posisi, $batas ");
						$no = $posisi + 1;

						while ($data = mysqli_fetch_array($tampil)) {
							$kode = mysqli_query($koneksi, "SELECT kode FROM tgroup WHERE groupId={$data['groupId']}");
							$kodek = mysqli_fetch_array($kode);

							// Code logic here

						?>
							<tr>
								<td>
									<div id="kontentd"><?php echo $no; ?></div>
								</td>
								<td>
									<div id="kontentd"><?php echo $data['deskripsi']; ?></div>
								</td>
								<td>
									<div id="kontentd">
										<?php
										if ($_SESSION['level'] == "Super") {
										?>
											<a href="?module=description&act=editdeskripsi&id=<?php echo $data['deskripsiID']; ?>">
												<button class="btn btn-success btn-sm">
													<span class="glyphicon glyphicon-wrench"></span> Edit
												</button>
											</a>
											|
											<a href="<?php echo $aksi; ?>?module=description&act=hapus&id=<?php echo $data['deskripsiID']; ?>">
												<button class="btn btn-danger btn-sm" onclick="return confirm('Hapus Deskripsi?')">
													<span class="glyphicon glyphicon-trash"></span> Hapus
												</button>
											</a>
										<?php } ?>
									</div>
								</td>
							</tr>
						<?php
							$no++;
						}

						$jmldata = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM tdeskripsi"));
						$jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
						$linkHalaman = $p->navHalaman($_GET['halaman'], $jmlhalaman);
						?>

					</tbody>
				</table>

				<?php echo "<ul class='pagination'> $linkHalaman </ul>"; ?>
			</div>
		</div>


	<?php
		break;

		// Form Tambah Deskripsi
	case "tambahpertanyaan":
	?>
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">
					<i class="glyphicon glyphicon-user"></i> Manajemen Pertanyaan Kuesioner
				</h1>
				<ol class="breadcrumb">
					<li class="active">
						<a href="master.php?module=description">Manajemen Pertanyaan Kuesioner</a> / <a href="master.php?module=description&act=tambahpertanyaan">Tambah Pertanyaan Kuesioner</a>
					</li>
				</ol>
			</div>
		</div>
		<div class="panel panel-primary">
			<div class="panel-heading">
				<div class="panel-title"><span class="glyphicon glyphicon-list"></span> Tambah Pertanyaan Kuesioner <i style="margin-left:770px;"><button class="btn btn-success btn-sm " onclick="window.location.href='?module=description'"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</button></i></div>
			</div>
			<div class="panel-body">
				<form method="POST" action="<?php echo $aksi; ?>?module=description&act=input" onSubmit="return validasi(this)" class="form-horizontal">
					<div class="form-group">
						<label for="name" class="col-sm-2 control-label">Grup </label>
						<div class="col-sm-5">
							<div class="input-group">
								<div class="input-group-addon">
									<span class="glyphicon glyphicon-tags"></span>
								</div>
								<select name="groupId" id="" class="form-control">
									<?php
									$sql = mysqli_query($koneksi, "SELECT * FROM tgroup ORDER BY groupId");
									while ($data = mysqli_fetch_array($sql)) {
										echo "<option value='$data[groupId]'> $data[namaGroup]</option>";
									}
									?>
								</select>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="name" class="col-sm-2 control-label">Deskripsi/Pertanyaan </label>
						<div class="col-sm-5">
							<textarea class="form-control" rows="4" name="deskripsi" class="form-control"></textarea>
						</div>
					</div>
					<div class="form-group">
						<label for="" class="col-sm-2 control-label"></label>
						<div class="col-sm-6">
							<button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-floppy-save"></span> Simpan</button> &nbsp;<button class="btn btn-danger" type="button" onclick="self.history.back()"><span class="glyphicon glyphicon-remove"></span> Batal</button>
						</div>

					</div>
				</form>
			</div>
		</div>
	<?php
		break;

		// Form Edit deskripsi
	case "editdeskripsi":
		$connection = mysqli_connect("localhost", "root", "", "survei");
		$edit = mysqli_query($koneksi, "SELECT * FROM tdeskripsi WHERE deskripsiID='{$_GET['id']}'");
		$r = mysqli_fetch_array($edit);
	?>

		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">
					<i class="glyphicon glyphicon-user"></i> Manajemen Deskripsi
				</h1>
				<ol class="breadcrumb">
					<li class="active">
						<a href="master.php?module=description">Manajemen Deskripsi</a> / <a href="master.php?module=description&act=editdeskripsi&id=<?php echo $r['deskripsiID']; ?>">Edit Deskripsi</a>
					</li>
				</ol>
			</div>
		</div>
		<div class="panel panel-primary">
			<div class="panel-heading">
				<div class="panel-title">
					<i class="glyphicon glyphicon-wrench"></i> Edit Deskripsi
				</div>
			</div>
			<div class="panel-body">
				<form method="POST" action="<?php echo $aksi ?>?module=description&act=update" class="form-horizontal">
					<input type="hidden" name="id" value="<?php echo $r['deskripsiID']; ?>">
					<?php
					// echo $r['deskripsiID'] 
					?>
					<div class="form-group">
						<label for="group" class="col-sm-2 control-label">Grup </label>
						<div class="col-sm-5">
							<div class="input-group">
								<div class="input-group-addon">
									<span class="glyphicon glyphicon-list"></span>

								</div>
								<select name="groupId" class="form-control">
									<?php
									$sql = mysqli_query($koneksi, "SELECT * FROM tgroup");
									var_dump($sql);
									while ($data = mysqli_fetch_array($sql)) {
										if ($r['groupId'] == $data['groupId']) {
											echo "<option value='$data[groupId]' SELECTED>$data[namaGroup]</option>";
										} else {
											echo "<option value='$data[groupId]'>$data[namaGroup]</option>";
										}
									}

									?>
								</select>

							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="name" class="col-sm-2 control-label">Deskripsi/Pertanyaan </label>
						<div class="col-sm-5">
							<textarea name="description" id="" class="form-control"><?php echo $r['deskrispi']; ?>
						</textarea>
						</div>
					</div>


					<div class="form-group">
						<label for="" class="col-sm-2 control-label"></label>
						<div class="col-sm-6">
							<button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-floppy-save"></span> Simpan</button> &nbsp;<button class="btn btn-danger" type="button" onclick="self.history.back()"><span class="glyphicon glyphicon-remove"></span> Batal</button>
						</div>

					</div>

				</form>
			</div>
		</div>

<?php
		break;
}
?>