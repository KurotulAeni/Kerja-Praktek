<?php
date_default_timezone_set("Asia/Jakarta");
include('config/config.php');
$lib = new config();

// //session
// session_start();
// if (!isset($_SESSION["npk"]) && !isset($_SESSION["akses"])) {
//   echo "<script type='text/javascript'>alert('Anda Harus Login Terlebih Dahulu!');window.location.href = '../../index.php';</script>";
//   exit;
// }

// $aks = $_SESSION["akses"];

// if ($aks != "admin") {
//   echo "<script type='text/javascript'>alert('Anda Tidak Memiliki Akses Admin!');window.location.href = '../../index.php';</script>";
//   exit;
// }

if (isset($_POST['submit'])) {
  $idx = $_POST['Nomor_id'];
  $nama = $_POST['nama_pemesan'];
  $tgl_masuk = $_POST['tanggal_masuk'];
  $tgl_selesai = $_POST['tanggal_selesai'];
  $jml_pemesanan = $_POST['jumlah_pemesanan'];
  $jns_pemesanan = $_POST['jenis_pemesanan'];
  $jns_bahan= $_POST['jenis_bahan'];
  $add_status = $lib->buatPesanan($idx, $nama, $tgl_masuk, $tgl_selesai, $jml_pemesanan,$jns_pemesanan, $jns_bahan);
}
if (isset($_GET['ubah'])){
    $kd=$_GET['ubah'];
   $data_pemesanan = $lib->get_by_id_pemesanan($kd);
}else{
    echo "<script>alert('gagal mengambil data');</script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard - SB Admin</title>
    <link href="css/styles.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand" href="index.html">Admin </a>
        <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" />
                <div class="input-group-append">
                    <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ml-auto ml-md-0">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="#">Settings</a>
                    <a class="dropdown-item" href="#">Activity Log</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="login.html">Logout</a>
                </div>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">

                        <a class="nav-link" href="index.html">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <a class="nav-link" href="charts.html">
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                            Logout
                        </a>
                    </div>
                </div>
                
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                    <h1 class="mt-4">Data Pemesanan</h1>
                    <div class="row">
                        <div class="col-xl-3 col-md-6">
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            <!-- Button to Open the Modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                Tambah Data
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nomor Id</th>
                                            <th>Nama Pemesan</th>
                                            <th>Tanggal Masuk</th>
                                            <th>Tanggal Selesai</th>
                                            <th>Jumlah Pemesanan</th>
                                            <th>Jenis Pemesanan</th>
                                            <th>Jenis Bahan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $data_pemesanan=$lib->showtabelpemesanan();
                                    foreach($data_pemesanan as $row){
                                    ?>
                                        <tr>
                                            <td><?= $row['nomor_id'];?></td>
                                            <td><?= $row['nama_pemesan'];?></td>
                                            <td><?= $row['tanggal_masuk'];?>1</td>
                                            <td><?= $row['tanggal_selesai'];?></td>
                                            <td><?= $row['jumlah_pesanan'];?></td>
                                            <td><?= $row['jenis_pembuatan'];?></td>
                                            <td><?= $row['jenis_bahan'];?></td>
                                            <td>
                                            <a href="" class="btn btn-primary">Edit</a>
                                            <a href="" class="btn btn-danger">Hapus</a>
                                            </td>

                                        </tr>
                                        <?php }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2020</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/datatables-demo.js"></script>
    <!-- The Modal -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Tambah Data</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <?php 
        $kd = $lib->showMaxNomorPemesanan();
        ?>
        <!-- Modal body -->
        <form method="POST">
        <div class="modal-body">
        <input type="text" name="Nomor_id" value="<?= $kd; ?>/SH-06/K/<?= date('m'); ?>/<?= date('Y'); ?>" placeholder="Nomor Id" class="form-control" readonly>
        <br>
        <input type="text" name="nama_pemesan" placeholder="nama pemesan" class="form-control">
        <br>
        <input type="date" name="tanggal_masuk" placeholder="tanggal masuk"class="form-control">
        <br>
        <input type="date" name="tanggal_selesai" placeholder="tanggal selesai"class="form-control">
        <br>
        <input type="number" name="jumlah_pemesanan" placeholder="jumlah pesanan"class="form-control">
        <br>
        <input type="text" name="jenis_pemesanan" placeholder="jenis pemesanan"class="form-control">
        <br>
        <input type="text" name="jenis_bahan" placeholder="jenis bahan"class="form-control">
        <br>
        <input type="submit" name="submit" value="Simpan Data">
        </div>
        </form>
      </div>
    </div>
  </div>
</body>
</html>