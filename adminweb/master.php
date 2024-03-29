<?php
session_start();
error_reporting(1);

if (empty($_SESSION['username']) and empty($_SESSION['password'])) {
    echo "
    <center>Untuk mengakses modul, Anda harus login <br>";
    echo "<a href=../index.php><b>LOGIN</b></a></center>";
} else {

?>
    <html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Puskesmas</title>
        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <link href="../css/sb-admin.css" rel="stylesheet">
        <link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    </head>
    <script>
        function kosongkan() {
            $("#validasi").empty();
            $("#validasi2").empty();
            $("#validasi3").empty();
        }

        function cekpasslama() {

            var pass_lama = $("#pass_lama").val();
            if (pass_lama == '') {
                $("#validasi").html("Password Tidak boleh kosong");
            } else {
                $.post('gantipass.php', {
                    pass_lama: pass_lama,
                    aksi: 'cekpass'
                }, function(data) {
                    if (data == "oke") {
                        $("#validasi").html("Password Sesuai");
                    } else {
                        $("#validasi").html("Password Tidak Sesuai");

                    }
                });

            }
        }

        function konfirmasi() {
            var stat2;
            var pass_baru = $("#pass_baru").val();
            var kon_pass_baru = $("#konpassbaru").val();
            if (kon_pass_baru == '' || pass_baru == '') {
                $("#validasi3").html("password tidak boleh kosong");

                $("#validasi2").html("konfirmasi password tidak boleh kosong");
            } else {
                if (pass_baru != kon_pass_baru) {
                    $("#validasi2").html("Konfirmasi Password Baru tidak sesuai");
                    var stat2 = 'no';
                } else {
                    $("#validasi2").html("Password Cocok");
                    var stat2 = 'oke';

                }
            }
            return stat2;
        }

        function gantipass() {

            var stat = konfirmasi();
            if (stat == 'oke') {
                var pass_lama = $("#pass_lama").val();
                var pass_baru = $("#pass_baru").val();
                $.post('gantipass.php', {
                    pass_lama: pass_lama,
                    aksi: 'cekpass'
                }, function(data) {
                    if (data == "oke") {
                        $.post('gantipass.php', {
                            newpass: pass_baru,
                            aksi: 'gantipass'
                        }, function(data) {
                            alert(data);
                            window.location.reload();
                        });
                    } else {
                        $("#validasi").html("Password Tidak Sesuai");
                        alert("Password lama tidak sesuai dengan yang di database");
                    }
                });
            } else {
                alert("Konfirmasi password tidak sesuai")
            }
        }
    </script>

    <body>
        <div class="modal fade" id="gantipass">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="form-horizontal">
                        <div class="modal-header">
                            <button class="close" data-dismiss="modal">&times;</button>
                            <div class="modal-title">
                                <h4>Ganti Password</h4>

                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="lama" class="col-sm-4 control-label">Password Lama</label>
                                <div class="col-sm-4">
                                    <input type="password" name="pass_lama" id="pass_lama" class="form-control" onmouseout="cekpasslama()">
                                </div>
                                <div class="col-sm-4" id="validasi">

                                </div>
                            </div>
                            <div class="form-group">
                                <label for="lama" class="col-sm-4 control-label">Password Baru</label>
                                <div class="col-sm-4">
                                    <input type="password" name="pass_baru" class="form-control" id="pass_baru" onmouseout="konfirmasi()">
                                </div>
                                <div class="col-sm-4" id="validasi3">

                                </div>

                            </div>
                            <div class="form-group">
                                <label for="lama" class="col-sm-4 control-label">Konfirmasi Pass Baru</label>
                                <div class="col-sm-4">
                                    <input type="password" class="form-control" id="konpassbaru" onmouseout="konfirmasi()">
                                </div>
                                <div class="col-sm-4" id="validasi2">

                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-danger" data-dismiss="modal" onclick="kosongkan()"><i class="glyphicon glyphicon-remove"></i> Batal</button>
                            <button class="btn btn-primary" onclick="gantipass()"><i class="glyphicon glyphicon-ok"></i> Ganti</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="wrapper">
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="master.php">Menu Admin</a>
                </div>
                <ul class="nav navbar-right top-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $_SESSION['fullname'] ?><b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="#gantipass" data-toggle="modal"><i class="fa fa-fw fa-gear"></i> Ganti Password</a>

                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav side-nav">
                        <li class="<?php if ($_GET['module'] == 'home') {
                                        echo 'active';
                                    } ?>">
                            <a href="?module=home"><i class="glyphicon glyphicon-home"></i> Home</a>
                        </li>
                        <li class="<?php if ($_GET['module'] == 'user') {
                                        echo 'active';
                                    } ?>">
                            <a href="?module=user"><i class="glyphicon glyphicon-user"></i> Manajemen User</a>
                        </li>
                        <li class="<?php if ($_GET['module'] == 'group') {
                                        echo 'active';
                                    } ?>">
                            <a href="?module=group"><i class="glyphicon glyphicon-list"></i> Manajemen Dimensi</a>
                        </li>
                        <li class="<?php if ($_GET['module'] == 'description') {
                                        echo 'active';
                                    } ?>">
                            <a href="?module=description"><i class="glyphicon glyphicon-book"></i> Manajemen Poin Kuisioner </a>
                        </li>
                        <li class="<?php if ($_GET['module'] == 'hasil') {
                                        echo 'active';
                                    } ?>">
                            <a href="?module=hasil&sub=all"><i class="glyphicon glyphicon-new-window"></i> Hasil Kuesioner</a>
                        </li>

                    </ul>
                </div>
            </nav>

            <div id="page-wrapper">

                <div class="container-fluid">

                    <?php include "konten.php"; ?>

                </div>
            </div>
        </div>
        <script src="../js/jquery.js"></script>
        <script src="../js/bootstrap.min.js"></script>
    </body>

    </html>
<?php
}
