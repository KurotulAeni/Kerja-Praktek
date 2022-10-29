<?php
date_default_timezone_set("Asia/Jakarta");
include('config/config.php');
$lib = new config();

//session
session_start();
if (!isset($_SESSION["email"])) {
    echo "<script type='text/javascript'>alert('Anda Harus Login Terlebih Dahulu!');window.location.href = 'login.php';</script>";
    exit;
}

if (isset($_POST['submit'])) {
    $idx = $_POST['Nomor_id'];
    $nama = $_POST['nama_pemesan'];
    $tgl_masuk = $_POST['tanggal_masuk'];
    $tgl_selesai = $_POST['tanggal_selesai'];
    $jml_pemesanan = $_POST['jumlah_pemesanan'];
    $jns_pemesanan = $_POST['jenis_pemesanan'];
    $jns_bahan = $_POST['jenis_bahan'];
    $add_status = $lib->buatPesanan($idx, $nama, $tgl_masuk, $tgl_selesai, $jml_pemesanan, $jns_pemesanan, $jns_bahan);
}
if (isset($_POST['ubah'])) {
    $idx = $_POST['Nomor_id'];
    $nama = $_POST['nama_pemesan'];
    $tgl_masuk = $_POST['tanggal_masuk'];
    $tgl_selesai = $_POST['tanggal_selesai'];
    $jml_pemesanan = $_POST['jumlah_pemesanan'];
    $jns_pemesanan = $_POST['jenis_pemesanan'];
    $jns_bahan = $_POST['jenis_bahan'];
    $add_status = $lib->ubahPesanan($idx, $nama, $tgl_masuk, $tgl_selesai, $jml_pemesanan, $jns_pemesanan, $jns_bahan);
}
if (isset($_GET['hapus'])) {
    $kd_pemesanan = $_GET['hapus'];
    $status_hapus = $lib->deletepemesanan($kd_pemesanan);
    if ($status_hapus) {
        echo "<script>alert('Berhasil menghapus data');window.location.href = 'index.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Dashboard - SB Admin</title>
    <link href="css/styles.css" rel="stylesheet" />
    <link rel="icon" href="assets/img/logo-med.png" sizes="32x32" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    <style>
        #dtHorizontalExample th, td {
white-space: nowrap;
}
    </style>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php">Admin </a>
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
                    <a class="dropdown-item" href="config/logout.php">Logout</a>
                </div>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">

                        <a class="nav-link" href="index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <a class="nav-link" href="config/logout.php">
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
                                <table id="dtHorizontalExample" class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nomor Id</th>
                                            <th>Nama Pemesan</th>
                                            <th>Tanggal Masuk</th>
                                            <th>Tanggal Selesai</th>
                                            <th>Jumlah Pemesanan</th>
                                            <th>Jenis Pemesanan</th>
                                            <th>Jenis Bahan</th>
                                            <th>Data Ukuran Baju</th>
                                            <th>Aksi</th>
                                            <th>Cetak</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query = $lib->showtabelpemesanan();
                                        $no = 1;
                                        foreach ($query as $data) {
                                        ?>
                                            <tr>
                                                <td><?php echo $no++; ?></td>
                                                <td><?= $data['nomor_id']; ?></td>
                                                <td><?= $data['nama_pemesan']; ?></td>
                                                <td><?= $data['tanggal_masuk']; ?>1</td>
                                                <td><?= $data['tanggal_selesai']; ?></td>
                                                <td><?= $data['jumlah_pesanan']; ?></td>
                                                <td><?= $data['jenis_pembuatan']; ?></td>
                                                <td><?= $data['jenis_bahan']; ?></td>
                                                <td align="center">
                                                <a href="ukuran_baju.php?get=<?php echo $data['id']; ?>" class="btn btn-success btn-xs">Data</a>
                                                </td>
                                                <td align="center">
                                                    <!-- Button untuk modal -->
                                                    <a href="#" type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#myModal<?php echo $data['id']; ?>">Edit</a>
                                                    <a href="index.php?hapus=<?php echo $data['nomor_id']; ?>" class="btn btn-danger btn-xs">Hapus</a>
                                                </td>
                                                <td align="center">
                                                <a href="surat.php?get=<?php echo $data['id']; ?>" target="_blank" class="btn btn-success btn-xs"><i class="fa fa-print"></i></a>
                                                </td>
                                            </tr>
                                            <div class="modal fade" id="myModal<?php echo $data['id']; ?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Ubah Data</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <?php
                                                        $id = $data['id'];
                                                        $query_edit = $lib->get_by_id_pemesanan($id);
                                                        foreach ($query_edit as $row) {
                                                        ?>
                                                            <!-- Modal body -->
                                                            <form method="POST">
                                                                <div class="modal-body">
                                                                    <input type="text" name="Nomor_id" value="<?= $row['nomor_id']; ?>" placeholder="Nomor Id" class="form-control" readonly>
                                                                    <br>
                                                                    <input type="text" name="nama_pemesan" placeholder="nama pemesan" value="<?= $row['nama_pemesan']; ?>" class="form-control">
                                                                    <br>
                                                                    <input type="date" name="tanggal_masuk" placeholder="tanggal masuk" value="<?= $row['tanggal_masuk']; ?>" class="form-control">
                                                                    <br>
                                                                    <input type="date" name="tanggal_selesai" placeholder="tanggal selesai" value="<?= $row['tanggal_selesai']; ?>" class="form-control">
                                                                    <br>
                                                                    <input type="number" name="jumlah_pemesanan" placeholder="jumlah pesanan" value="<?= $row['jumlah_pesanan']; ?>" class="form-control">
                                                                    <br>
                                                                    <input type="text" name="jenis_pemesanan" placeholder="jenis pemesanan" value="<?= $row['jenis_pembuatan']; ?>" class="form-control">
                                                                    <br>
                                                                    <input type="text" name="jenis_bahan" placeholder="jenis bahan" value="<?= $row['jenis_bahan']; ?>" class="form-control">
                                                                    <br>
                                                                    <input type="submit" class="btn btn-info" name="ubah" value="Ubah Data">
                                                                </div>
                                                            </form>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
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
                                                    <input type="date" name="tanggal_masuk" placeholder="tanggal masuk" class="form-control">
                                                    <br>
                                                    <input type="date" name="tanggal_selesai" placeholder="tanggal selesai" class="form-control">
                                                    <br>
                                                    <input type="number" name="jumlah_pemesanan" placeholder="jumlah pesanan" class="form-control">
                                                    <br>
                                                    <input type="text" name="jenis_pemesanan" placeholder="jenis pemesanan" class="form-control">
                                                    <br>
                                                    <input type="text" name="jenis_bahan" placeholder="jenis bahan" class="form-control">
                                                    <br>
                                                    <input type="submit" class="btn btn-primary" name="submit" value="Simpan Data">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
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
    <script>$(document).ready(function () {
$('#dtHorizontalExample').DataTable({
"scrollX": true
});
$('.dataTables_length').addClass('bs-select');
});</script>
</body>

</html>