<script language="javascript">
	function validasigrup(form) {
		if (form.grup.value == "") {
			alert("Anda belum mengisikan nama grup.");
			form.grup.focus();
			return (false);
		}
	}
</script>
<?php
$aksi = "modul/mod_group/aksi_group.php";
switch ($_GET['act']) {
		// Tampil Group
	default:
?>
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">
					<i class="glyphicon glyphicon-user"></i> Manajemen Dimensi
				</h1>
				<ol class="breadcrumb">
					<li class="active">
						<a href="master.php?module=group">Manajemen Poin Kusioner</a>
					</li>
				</ol>
			</div>
		</div>
		<div class="panel panel-primary">
			<div class="panel-heading">

				<div class="panel-title"><span class="glyphicon glyphicon-list"></span> List Group Kuisioner <i style="margin-left:750px;"><?php if ($_SESSION['level'] == "Super") { ?><button class="btn btn-success btn-sm " onclick="window.location.href='?module=group&act=tambahgroup'"><span class="glyphicon glyphicon-plus"></span> Tambah Group</button></i><?php } ?></div>
			</div>
			<div class="panel-body">
				<table id="tablekonten" class="table table-striped table-bordered table-responsive">
					<thead>
						<th width="1%">
							<div id="konten">No</div>
						</th>
						<th width="10%">
							<div id="konten">Nama Grup</div>
						</th>

						<th width="10%">
							<div id="konten">Aksi</div>
						</th>

					</thead>
					<tbody>
						<?php

						$p      = new PagingGroup();
						$batas  = 10;
						$posisi = $p->cariPosisi($batas);
						$tampil = mysqli_query($koneksi, "SELECT * FROM tgroup order by namaGroup asc limit $posisi,$batas");
						$no = $posisi + 1;
						while ($data = mysqli_fetch_array($tampil)) {
						?>
							<tr>
								<td>
									<div id="kontentd"><?php echo $no; ?></div>
								</td>
								<td>
									<div id="kontentd"><?php echo $data['namaGroup']; ?></div>
								</td>
								<td><?php if ($_SESSION['level'] == "Super") { ?><div id="kontentd"><a href="?module=group&act=editgroup&id=<?php echo $data['groupId']; ?>"><button class="btn btn-success btn-sm"><span class="glyphicon glyphicon-wrench"></span> Edit</button></a> | <a href="<?php echo $aksi; ?>?module=group&act=hapus&id=<?php echo $data['groupId']; ?>"><button class="btn btn-danger btn-sm" onclick="return confirm('Hapus Grup?')"><span class="glyphicon glyphicon-trash"></span> Hapus</button></a></div><?php } ?>
								</td>
							</tr>

						<?php
							$no++;
						}


						$jmldata = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM tgroup"));
						$jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
						$linkHalaman = $p->navHalaman($_GET['halaman'], $jmlhalaman);

						?>
					</tbody>
				</table>

				<ul class="pagination">
					<?php echo "$linkHalaman"; ?>
				</ul>


			</div>
		</div>

	<?php
		break;

		// Form Tambah group
	case "tambahgroup":
	?>
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">
					<i class="glyphicon glyphicon-user"></i> Manajemen Dimensi
				</h1>
				<ol class="breadcrumb">
					<li class="active">
						<a href="master.php?module=group">Manajemen Dimensi</a> / <a href="master.php?module=group&act=tambahgroup">Tambah Dimensi</a>
					</li>
				</ol>
			</div>
		</div>
		<div class="panel panel-primary">
			<div class="panel-heading">
				<div class="panel-title"><span class="glyphicon glyphicon-list"></span> Tambah Dimensi Kuisioner <i style="margin-left:770px;"><button class="btn btn-success btn-sm " onclick="window.location.href='?module=group'"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</button></i></div>
			</div>
			<div class="panel-body">
				<form method="POST" action="<?php echo $aksi; ?>?module=group&act=input" onSubmit="return validasi(this)" class="form-horizontal">
					<div class="form-group">
						<label for="name" class="col-sm-2 control-label">Nama Dimensi</label>
						<div class="col-sm-5">
							<div class="input-group">
								<div class="input-group-addon">
									<span class="glyphicon glyphicon-tags"></span>
								</div>
								<input type="text" name="grup" class="form-control" placeholder="Nama Dimensi">
							</div>
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

		// Form Edit group
	case "editgroup":
		$edit = mysqli_query($koneksi, "SELECT * FROM tgroup WHERE groupId='{$_GET['id']}'");
		$r = mysqli_fetch_array($edit);
	?>
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">
					<i class="glyphicon glyphicon-user"></i> Manajemen Group
				</h1>
				<ol class="breadcrumb">
					<li class="active">
						<a href="master.php?module=group">Manajemen Group</a> / <a href="?module=group&act=editgroup&id=<?php echo $r['groupId']; ?>">Edit Group</a>
					</li>
				</ol>
			</div>
		</div>
		<div class="panel panel-primary">
			<div class="panel-heading">
				<div class="panel-title">
					<i class="glyphicon glyphicon-wrench"></i> Edit Group
				</div>
			</div>
			<div class="panel-body">
				<form method="POST" action="<?php echo $aksi ?>?module=group&act=update" class="form-horizontal">
					<input type="hidden" name="id" value="<?php echo $r['groupId']; ?>">
					<div class="form-group">
						<label for="group" class="col-sm-2 control-label">Nama Grup</label>
						<div class="col-sm-5">
							<div class="input-group">
								<div class="input-group-addon">
									<span class="glyphicon glyphicon-user"></span>
								</div>
								<input type="text" name="grup" class="form-control" placeholder="Nama Group" value="<?php echo $r['namaGroup']; ?>">
							</div>
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