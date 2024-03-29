<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Survey Kepuasan Pasien</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/blog-post.css" rel="stylesheet">
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <style>
    .radio-group {
      margin-bottom: 10px;
    }

    .radio-group label {
      margin-right: 20px;
    }

    .table {
      border-collapse: collapse;
      width: 100%;
      row-gap: 0;
      line-height: 1;
    }

    th,
    td {
      text-align: left;
      padding: 0px;
      line-height: 0;
    }

    tr:nth-child(even) {
      background-color: #f2f2f2
    }

    .del {
      height: 10px;
      color: white;
      background-color: #0E70B9;
      width: 6%;
      line-height: 0%;

    }

    .dul {
      height: 10px;
      color: white;
      background-color: #2F58CD;
      width: 6%;
      line-height: 0%;
    }

    .dol {
      line-height: 20px;
      row-gap: 0px;
      font-family: sans-serif;
      font-size: 10px;
      padding: 0cap;
      vertical-align: middle;
      justify-content: center;
    }

    .doll {
      padding-top: 200px;
    }

    body {
      background: linear-gradient(to bottom, #172852, white);
    }
  </style>
</head>

<body background="">

  <!-- Navigation -->
  <nav class="navbar navbar-fixed-top" role="navigation" style="background-color: #172852;">
    <div class="container">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#" style="color: #e6e6e6;">Survey Kepuasan Pasien</a>
      </div>
      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav navbar-right">
          <li><a href="#login" data-toggle="modal"><button class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-log-in"></span> Login</button></a></li>
        </ul>
        <ul class="nav navbar-nav">
          <li class="active"><a href="#survey" data-toggle="tab" style="color: #e6e6e6;">Survey</a></li>

        </ul>
      </div>
      <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
  </nav>

  <div class="container">

    <div class="panel panel-default">
      <div class="panel-body" style="background-color:#e6e6e6;">
        <div class="col-lg-12">
          <img class="img-responsive" src="./images/pukkes.png" alt="" style="height:350px;width:1290px">
          <hr>
        </div>
        <div class="col-lg-12">
          <p align="center" style="background-color:#172852; color:white;">
            <font size="5">SURVEY KEPUASAN PASIEN</font>
          </p>
        </div>
        <div class="row">
          <div class="panel-body">
            <form method='POST' action='aksi_kuosioner.php' onSubmit="return validasisurvey(this)">
              <script language="javascript">
                function validasisurvey(form) {
                  if (form.companyName.value == "") {
                    alert("Anda belum mengisikan nama Anda.");
                    form.companyName.focus();
                    return (false);
                  }
                  if (form.companyAddress1.value == "") {
                    alert("Anda belum mengisikan alamat Anda.");
                    form.companyAddress1.focus();
                    return (false);
                  }
                }
              </script>
              <table class="table table-sm table-responsive">
                <tr>
                  <td>
                    <div class="form-horizontal" style="margin-top:20px;background-color:#fff;padding-top:20px;padding-bottom:20px;">
                      <div class="page-header" style="margin-left:30px;">
                        <h3>Informasi Pasien</h3>
                      </div>
                      <div class="form-group">
                        <label for="nama_pelanggan" class="control-label col-sm-2">Nama Pasien</label>
                        <div class="col-sm-8">
                          <div class="input-group">
                            <div class="input-group-addon">
                              <span class="glyphicon glyphicon-user"></span>
                            </div>
                            <input type="text" id="nama_pelanggan" class="form-control" name="namaPasien" placeholder="Nama Pasien" required>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="produk" class="control-label col-sm-2">Jenis Kelamin</label>
                        <div class="col-sm-8">
                          <div class="input-group">
                            <div class="input-group-addon">
                              <span class="glyphicon glyphicon-gender">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gender-ambiguous" viewBox="0 0 16 16">
                                  <path fill-rule="evenodd" d="M11.5 1a.5.5 0 0 1 0-1h4a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 0V1.707l-3.45 3.45A4 4 0 0 1 8.5 10.97V13H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V14H6a.5.5 0 0 1 0-1h1.5v-2.03a4 4 0 1 1 3.471-6.648L14.293 1zm-.997 4.346a3 3 0 1 0-5.006 3.309 3 3 0 0 0 5.006-3.31z" />
                                </svg>
                              </span>
                            </div>
                            <select name="jenisKelamin" id="produk" class="form-control">
                              <option value="Laki-laki">Laki-laki</option>
                              <option value="Perempuan">Perempuan</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="hp" class="control-label col-sm-2">Umur</label>
                        <div class="col-sm-8">
                          <div class="input-group">
                            <div class="input-group-addon">
                              <span class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cake2-fill" viewBox="0 0 16 16">
                                  <path d="m2.899.804.595-.792.598.79A.747.747 0 0 1 4 1.806v4.886c-.354-.06-.689-.127-1-.201V1.813a.747.747 0 0 1-.1-1.01ZM13 1.806v4.685a15.19 15.19 0 0 1-1 .201v-4.88a.747.747 0 0 1-.1-1.007l.595-.792.598.79A.746.746 0 0 1 13 1.806m-3 0a.746.746 0 0 0 .092-1.004l-.598-.79-.595.792A.747.747 0 0 0 9 1.813v5.17c.341-.013.675-.031 1-.055zm-3 0v5.176c-.341-.012-.675-.03-1-.054V1.813a.747.747 0 0 1-.1-1.01l.595-.79.598.789A.747.747 0 0 1 7 1.806" />
                                  <path d="M4.5 6.988V4.226a22.6 22.6 0 0 1 1-.114V7.16c0 .131.101.24.232.25l.231.017c.332.024.672.043 1.02.055l.258.01a.25.25 0 0 0 .26-.25V4.003a29.015 29.015 0 0 1 1 0V7.24a.25.25 0 0 0 .258.25l.259-.009c.347-.012.687-.03 1.019-.055l.231-.017a.25.25 0 0 0 .232-.25V4.112c.345.031.679.07 1 .114v2.762a.25.25 0 0 0 .292.246l.291-.049c.364-.061.71-.13 1.033-.208l.192-.046a.25.25 0 0 0 .192-.243V4.621c.672.184 1.251.409 1.677.678.415.261.823.655.823 1.2V13.5c0 .546-.408.94-.823 1.201-.44.278-1.043.51-1.745.696-1.41.376-3.33.603-5.432.603-2.102 0-4.022-.227-5.432-.603-.702-.187-1.305-.418-1.745-.696C.408 14.44 0 14.046 0 13.5v-7c0-.546.408-.94.823-1.201.426-.269 1.005-.494 1.677-.678v2.067c0 .116.08.216.192.243l.192.046c.323.077.669.147 1.033.208l.292.05a.25.25 0 0 0 .291-.247ZM1 8.82v1.659a1.935 1.935 0 0 0 2.298.43.935.935 0 0 1 1.08.175l.348.349a2 2 0 0 0 2.615.185l.059-.044a1 1 0 0 1 1.2 0l.06.044a2 2 0 0 0 2.613-.185l.348-.348a.938.938 0 0 1 1.082-.175c.781.39 1.718.208 2.297-.426V8.833l-.68.907a.938.938 0 0 1-1.17.276 1.938 1.938 0 0 0-2.236.363l-.348.348a1 1 0 0 1-1.307.092l-.06-.044a2 2 0 0 0-2.399 0l-.06.044a1 1 0 0 1-1.306-.092l-.35-.35a1.935 1.935 0 0 0-2.233-.362.935.935 0 0 1-1.168-.277z" />
                                </svg>
                              </span>
                            </div>
                            <div class="radio-group">
                              <label for="umur_11-20">
                                <input type="radio" id="umur_11-20" class="form-control" name="umur" value="11-20"> 11-20
                              </label>
                              <label for="umur_21-40">
                                <input type="radio" id="umur_21-40" class="form-control" name="umur" value="21-40"> 21-40
                              </label>
                              <label for="umur_41-60">
                                <input type="radio" id="umur_31-40" class="form-control" name="umur" value="41-60"> 41-60
                              </label>
                              <label for="umur_61+">
                                <input type="radio" id="umur_61+" class="form-control" name="umur" value="61+"> 61+
                              </label>
                            </div>

                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="tgl" class="control-label col-sm-2">Tanggal</label>
                        <div class="col-sm-8">
                          <div class="input-group">
                            <div class="input-group-addon">
                              <span class="glyphicon glyphicon-calendar"></span>
                            </div>
                            <?php
                            include "fungsi/fungsi_indotgl.php";
                            $tanggal = date('Y-m-d');
                            $tglFinal = tgl_indo($tanggal);
                            ?>
                            <input type="date" name="tgl_survey" class="form-control" value="<?php echo date('Y-m-d'); ?>">
                          </div>
                        </div>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td width="97%" valign="top" align="center" colspan="5" style="border-style: none; border-width: medium">
                    <font face="Arial" size="1"><b>Mohon kesediaan Anda untuk memberikan
                        penilaian dan masukan kepada pelayanan Puskesmas Padang Bulan, dimana hal ini sangat bermanfaat
                        untuk meningkatkan kualitas layanan Puskesmas Padang Bulan.<br>
                      </b><i>Silahkan diisi dengan mengklik option radio
                        serta keterangan sesuai dengan penilaian Anda
                        pada kolom yang telah disediakan</i></font>
                  </td>
                </tr>
                <tr>
                  <td colspan="9">
                    <table class="table table-striped table-bordered table-sm">
                      <thead valign="top">
                        <th width='1%' bgcolor='#172852' valign="top"><b>
                            <font face='Arial' size='2' color='white'>No</font>
                          </b></th>
                        <th colspan='2' bgcolor='#172852'>
                          <p align='center'><b>
                              <font face='Arial' size='2' color='white'>DESKRIPSI</font>
                            </b>
                        </th>
                        <th colspan="5" bgcolor='#172852'>
                          <p align='center'>
                            <font face='Arial' size='2' color='white'>PERSEPSI</font>
                          </p>
                        </th>
                        <th colspan="5" bgcolor='#172852'>
                          <p align='center'>
                            <font size='2' face='Arial' color='white'>HARAPAN</font>
                          </p>
                        </th>
                      </thead>
                      <tbody>
                        <?php
                        include "koneksi.php";
                        error_reporting(0);
                        $no = 1;
                        $sql = mysqli_query($koneksi, "SELECT * FROM tgroup");
                        while ($data = mysqli_fetch_array($sql)) {
                          $id = $data['groupId'];
                          echo "<tr class='dol'>
                          <td><font face='sans-serif' valign='top' size='2' colspan='1'><b> $no</b></font></td>
                          <td colspan='2' class='doll'><font face='sans-serif' size='2'><b>$data[namaGroup]</b></font></td>
                          
                          <td class='del'><p align='center'>1<br>(Sangat Tidak Puas)</font></td>
                          <td class='del'><p align='center'>2<br>(Tidak Puas)</font></td>
                          <td class='del'><p align='center'>3<br>(Netral)</font></td>
                          <td class='del'><p align='center'>4<br>( Puas)</font></td>
                          <td class='del'><p align='center'>5<br>(Sangat  Puas)</font></td>
                          
                          
                          <td class='dul'><p align='center'>1<br>(Sangat Tidak Setuju)</font></td>
                          <td class='dul'><p align='center'>2<br>(Tidak Setuju)</font></td>
                          <td class='dul'><p align='center'>3<br>(Netral)</font></td>
                          <td class='dul'><p align='center'>4<br>( Setuju)</font></td>
                          <td class='dul'><p align='center'>5<br>(Sangat Setuju)</font></td>
                          </tr>";


                          $hasil = mysqli_query($koneksi, "SELECT * FROM tdeskripsi, tgroup WHERE tdeskripsi.groupId = '$id' AND tdeskripsi.groupId = tgroup.groupId ORDER BY tgroup.groupId");
                          $i = 1;
                          while ($r = mysqli_fetch_array($hasil)) {

                            echo "<tr>
                                                              <td colspan='1'></td>
                                                             
                                                              <td colspan='2'><font face='Arial' size='2'> $r[deskripsi]</font></td>
                                                              <td align='center'> <input type='radio' name='asfa$i$data[groupId]' value='E'> </td>
                                                              <td align='center'> <input type='radio' name='asfa$i$data[groupId]' value='D'> </td>
                                                              <td align='center'> <input type='radio' name='asfa$i$data[groupId]' value='C'> </td>
                                                              <td align='center'> <input type='radio' name='asfa$i$data[groupId]' value='B'> </td>
                                                              <td align='center'> <input type='radio' name='asfa$i$data[groupId]' value='A'> </td>
                                                              
                                                              <td align='center'> <input type='radio' name='ekspek$i$data[groupId]' value='E'> </td>
                                                              <td align='center'> <input type='radio' name='ekspek$i$data[groupId]' value='D'> </td>
                                                              <td align='center'> <input type='radio' name='ekspek$i$data[groupId]' value='C'> </td>
                                                              <td align='center'> <input type='radio' name='ekspek$i$data[groupId]' value='B'> </td>
                                                              <td align='center'> <input type='radio' name='ekspek$i$data[groupId]' value='A'> </td>
                                                              </tr>";
                            $i++;
                          }
                          echo "<br>";
                          $no++;
                        }
                        ?>
                      </tbody>
                    </table>
                    <style>

                    </style>
                  </td>
                </tr>
                <tr>
                  <td colspan="8">
                    <div class="well">
                      <h4>Komentar / Saran...</h4>

                      <div class="form-group">
                        <textarea name='suggestion' class="form-control" rows="3" placeholder="Tulis Komentar dan Saran..."></textarea>
                      </div>

                    </div>
                    <hr>
                  </td>
                </tr>
                <tr>
                  <td colspan="8">
                    <center><button type="submit" class="btn btn-primary btn-lg">Submit</button></center>
                  </td>
                </tr>
                <tr>
                  <td width="97%" valign="top" align="center" colspan="5" style="border-style: none; border-width: medium">
                    <center class="well">
                      <font face="Arial" size="1"><b>Terima Kasih Atas Waktu dan Masukan yang anda berikan,Semua masukan yang anda berikan </b> </i></font>
                      <font face="Arial" size="1"><b>akan kami terima sebagai sarana bagi kami untuk meningkatkan kualitas pelayanan Puskesmas Padang Bulan</b> </i></font>
                    </center>
                  </td>
                </tr>
              </table>
            </form>
          </div>
        </div>
      </div>
    </div>

  </div>
  <nav class="navbar navbar-inverse navbar-absolut-bottom" role="navigation">
    <div class="container">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
      </div>
      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <center>
          <font color="white" size="1"></font>
        </center>
      </div>
      <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
  </nav>
  <div class="modal fade" id="login">
    <form name="login" action="./adminweb/cek_login.php" method="POST" onSubmit="return validasi(this)">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header" bgcolor="black">
            <button class="close" data-dismiss="modal">&times;</button>
            <div class="modal-title">
              <center>
                <h4>Login Admin</h4>
              </center>
            </div>
          </div>
          <div class="modal-body">
            <div class="form-horizontal">
              <div class="form-group">
                <label for="username" class="col-sm-3 control-label">Username</label>
                <div class="col-sm-5">
                  <div class="input-group">
                    <div class="input-group-addon">
                      <span class="glyphicon glyphicon-user"></span>
                    </div>
                    <input type="text" class="form-control" name="nama_pengguna" placeholder="Username">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="username" class="col-sm-3 control-label">Password</label>
                <div class="col-sm-5">
                  <div class="input-group">
                    <div class="input-group-addon">
                      <span class="glyphicon glyphicon-lock"></span>

                    </div>
                    <input type="password" class="form-control" name="password" placeholder="Password">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="" class=" control-label col-sm-3"></label>
                <div class="col-sm-1">
                  <button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-log-in"></span> Masuk</button>

                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <!-- <center>Copyright &copy; 2016 Telkomsel Grapari<br> All rights reserved.</center>
            <center>Created by Wahyu Budiman.</center> -->
          </div>
        </div>
      </div>
    </form>
  </div>
  <script src="js/jquery.js"></script>
  <script src="js/bootstrap.min.js"></script>
</body>

</html>