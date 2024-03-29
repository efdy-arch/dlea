<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            <i class="glyphicon glyphicon-home"></i> Home
        </h1>
        <ol class="breadcrumb">
            <li class="active">
                <a href="master.php?module=home">Home</a>
            </li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <?php
                $tanggal = date('Y-m-d');
                $tanggalFinal = tgl_indo($tanggal);
                $time = date('h:i:s');
                ?>
                <h3 class="panel-title" align="right"><i class="glyphicon glyphicon-calendar"></i> <?php echo "<font face='tahoma' size='2'>$tanggalFinal | $time</font>"; ?></h3>
            </div>
            <div class="panel-body">
                <div class="well">
                    <div class="alert alert-info">
                        <?php if ($_SESSION['level'] == 'Super') {
                            echo "Selamat Datang Administrator <strong>" . $_SESSION['fullname'] . "</strong> Selamat bertugas";
                        } else {
                            echo "Selamat Datang Pemantau <strong>" . $_SESSION['fullname'] . "</strong> Silahkan untuk melihat data";
                        }
                        ?>
                    </div>
                </div>

            </div>
            <div class="panel-footer">
                <!-- <center>Created Wahyu Budiman<br> All rights reserved.</center> -->
            </div>
        </div>
    </div>
</div>