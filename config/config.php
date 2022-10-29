<?php
$error = '';
date_default_timezone_set("Asia/Jakarta");
class config
{
    public function __construct()
    {
        $host = "localhost";
        $dbname = "pemesanan";
        $user = "root";
        $password = "";
        $this->db = new PDO("mysql:host={$host};dbname={$dbname}", $user, $password);
    }
    public function showtabelpemesanan()
    {
        $query = $this->db->prepare("SELECT * FROM tbl_pemesanan");
        $query->execute();
        $data = $query->fetchAll();
        return $data;
    }
    public function showtabelukuranbaju($id_ukuran)
    {
        $query = $this->db->prepare("SELECT * FROM tbl_dataukuranbaju WHERE no_id=?");
        $query->bindParam(1, $id_ukuran);
        $query->execute();
        $data = $query->fetchAll();
        return $data;
    }
    public function showtabelukuranbaju2($id_ukuran, $batas, $ukuran)
    {
        $query = $this->db->prepare("SELECT * FROM tbl_dataukuranbaju WHERE no_id=? LIMIT  $ukuran, $batas");
        $query->bindParam(1, $id_ukuran);
        $query->execute();
        $data = $query->fetchAll();
        return $data;
    }
    public function ubahBulan($kd)
    {
        if($kd == 1){
            $data = "Januari";
        }
        else if($kd == 2) {
            $data = "Februari";
        }else if($kd == 3) {
            $data = "Maret";
        }
        else if($kd == 4) {
            $data = "April";
        }
        else if($kd == 5) {
            $data = "Mei";
        }
        else if($kd == 6) {
            $data = "Juni";
        }
        else if($kd == 7) {
            $data = "Juli";
        }
        else if($kd == 8) {
            $data = "Agustus";
        }
        else if($kd == 9) {
            $data = "September";
        }
        else if($kd == 10) {
            $data = "Oktober";
        }
        else if($kd == 11) {
            $data = "November";
        }
        else {
            $data = "Desember";
        }
        return $data;
    }
    public function showtabelmahasiswa()
    {
        $query = $this->db->prepare("SELECT * FROM mahasiswa");
        $query->execute();
        $data = $query->fetchAll();
        return $data;
    }
    public function hitungPage()
    {
        $query = $this->db->prepare("SELECT COUNT(id_akun)
        FROM akun");
        $query->execute();
        $data = $query->fetchColumn();
        return $data;
    }
    public function hitungPage2()
    {
        $query = $this->db->prepare("SELECT COUNT(id_report)
        FROM report");
        $query->execute();
        $data = $query->fetchColumn();
        return $data;
    }
    public function hitungPage5()
    {
        $query = $this->db->prepare("SELECT COUNT(id_tipe)
        FROM tipe");
        $query->execute();
        $data = $query->fetchColumn();
        return $data;
    }
    public function hitungPage3($cari)
    {
        $query = $this->db->prepare("SELECT COUNT(id_report)
        FROM report where tipe like '%" . $cari . "%' or judge like '%" . $cari . "%' ");
        $query->execute();
        $data = $query->fetchColumn();
        return $data;
    }

    public function hitungPage4($cari)
    {
        $query = $this->db->prepare("SELECT COUNT(id_akun)
        FROM akun where nama like '%" . $cari . "%' or negara like '%" . $cari . "%' ");
        $query->execute();
        $data = $query->fetchColumn();
        return $data;
    }

    public function hitungPage6($cari)
    {
        $query = $this->db->prepare("SELECT COUNT(id_tipe)
        FROM tipe where tipe_name like '%" . $cari . "%'");
        $query->execute();
        $data = $query->fetchColumn();
        return $data;
    }

    public function get_by_id_pemesanan($kd_pemesanan)
    {
        $query = $this->db->prepare("SELECT * FROM tbl_pemesanan where id=?");
        $query->bindParam(1, $kd_pemesanan);
        $query->execute();
        return $query->fetchAll();
    }
    public function get_by_id_pemesanan2($kd_pemesanan)
    {
        $query = $this->db->prepare("SELECT * FROM tbl_pemesanan where id=?");
        $query->bindParam(1, $kd_pemesanan);
        $query->execute();
        return $query->fetch();
    }
    public function get_by_id_ukuranbaju($kd_ukuran)
    {
        $query = $this->db->prepare("SELECT * FROM tbl_dataukuranbaju where id=?");
        $query->bindParam(1, $kd_ukuran);
        $query->execute();
        return $query->fetchAll();
    }
    public function showMaxNomorPemesanan()
    {
        $query = $this->db->prepare("SELECT max(nomor_id) as kodeTerbesar FROM tbl_pemesanan");
        $query->execute();
        $data = $query->fetch();
        $kode = $data['kodeTerbesar'];
        $urutan = (int) substr($kode, 0, 3);
        $urutan++;
        $kd = sprintf("%03s", $urutan);
        return $kd;
    }
    //buat pesanan
    public function buatPesanan($idx, $nama, $tgl_masuk, $tgl_selesai, $jml_pemesanan, $jns_pemesanan, $jns_bahan)
    {
        if (!isset($error)) {
            $data = $this->db->prepare('INSERT INTO tbl_pemesanan (nomor_id, nama_pemesan, tanggal_masuk, tanggal_selesai, jumlah_pesanan, jenis_pembuatan, jenis_bahan) VALUES (?, ?, ?, ?, ?, ?, ?)');
            $data->bindParam(1, $idx);
            $data->bindParam(2, $nama);
            $data->bindParam(3, $tgl_masuk);
            $data->bindParam(4, $tgl_selesai);
            $data->bindParam(5, $jml_pemesanan);
            $data->bindParam(6, $jns_pemesanan);
            $data->bindParam(7, $jns_bahan);
            $data->execute();
            if ($data) {
                echo '<script>alert("Berhasil Menyimpan Data");window.location.href = "index.php";</script>';
            } else {
                echo '<script>alert("Gagal Menyimpan Data");window.location.href = "index.php";</script>';
            }
        } else {
            echo "<script>alert('Gagal Mengirim Pesan!')</script>";
            exit();
        }
    }
    public function tambahdataukuran($nama, $ukuran,$id)
    {
        if (!isset($error)) {
            $data = $this->db->prepare('INSERT INTO tbl_dataukuranbaju (nama, ukuran, no_id) VALUES (?, ?, ?)');
            $data->bindParam(1, $nama);
            $data->bindParam(2, $ukuran);
            $data->bindParam(3, $id);
          
            $data->execute();
            if ($data) {
                echo '<script>alert("Berhasil Menyimpan Data");window.location.href = "ukuran_baju.php?get='. $id .'";</script>';
            } else {
                echo '<script>alert("Gagal Menyimpan Data");window.location.href = "ukuran_baju.php?get='. $id .'";</script>';
            }
        } else {
            echo "<script>alert('Gagal Mengirim Pesan!')</script>";
            exit();
        }
    }
    //REGISTRASI Tipe
    public function registrasiTipe($tn)
    {
        $name = "TP";
        $id = $name . date("Ymds");
        $create_at = date("Ymds");

        if (!isset($error)) {
            $data = $this->db->prepare('INSERT INTO tipe (id_tipe, tipe_name, create_at) VALUES (?, ?, ?)');
            $data->bindParam(1, $id);
            $data->bindParam(2, $tn);
            $data->bindParam(3, $create_at);

            $data->execute();
            return $data->rowCount();
        } else {
            echo "<script>alert('Gagal Mengirim Data!')</script>";
            exit();
        }
    }
    //Buat Report penggunaan : form_pm.php
    public function buatReport(
        $idx,
        $id,
        $type,
        $jg,
        $afterR,
        $defectx,
        $foto,
        $ukuran_file,
        $tipe_file,
        $tmp,
        $sizex,
        $arx,
        $subx,
        $smdx,
        $isq,
        $rmdx,
        $irmx,
        $ismx
    ) {
        $limit = 90 * 1024 * 1024;
        $foto_ket = date('dmYHis') . $foto;
        $path = "../../img/picture_report/" . $foto_ket;
        if ($tipe_file == "image/jpeg" || $tipe_file == "image/png") {
            if ($ukuran_file <= $limit) {
                if (move_uploaded_file($tmp, $path)) {
                    $sql = $this->db->prepare("INSERT INTO report(id_report, input_date, tipe, judge, after_repair, defect, picture, size, area, sub_area, smd, ism, rmd , irm, isk) VALUES(:id_reportx, :input_datex, :tipex, :judgex, :after_repairx, :defectx, :picturex, :sizex, :areax, :sub_areax, :smdx, :ismx, :rmdx , :irmx, :isk)");
                    $sql->bindParam(':id_reportx', $idx);
                    $sql->bindParam(':input_datex', $id);
                    $sql->bindParam(':tipex', $type);
                    $sql->bindParam(':judgex', $jg);
                    $sql->bindParam(':after_repairx', $afterR);
                    $sql->bindParam(':defectx', $defectx);
                    $sql->bindParam(':picturex', $foto_ket);
                    $sql->bindParam(':sizex', $sizex);
                    $sql->bindParam(':areax', $arx);
                    $sql->bindParam(':sub_areax', $subx);
                    $sql->bindParam(':smdx', $smdx);
                    $sql->bindParam(':ismx', $isq);
                    $sql->bindParam(':rmdx', $rmdx);
                    $sql->bindParam(':irmx', $irmx);
                    $sql->bindParam(':isk', $ismx);
                    $sql->execute();

                    if ($sql) {
                        echo "<script type='text/javascript'>alert('Berhasil Membuat Report!');window.location.href = '../admin/data_report.php';</script>"; //redirect halaman
                    } else {
                        echo "<script type='text/javascript'>alert('Gagal Membuat Report!');window.location.href = '../admin/form_pm.php';</script>";
                    }
                } else {
                    echo "<script type='text/javascript'>alert('Gagal mengupload file!');window.location.href = '../admin/form_pm.php';</script>";
                }
            } else {
                echo "<script type='text/javascript'>alert('Size tidak boleh lebih dari 2 Mb!');window.location.href = '../admin/data_report.php';</script>";
            }
        } else {
            echo "<script type='text/javascript'>alert('Gambar yang diupload harus ber ekstensi JPG/JPEG/PNG');window.location.href = '../admin/data_report.php';</script>";
        }
    }
    public function ubahDataReportv3(
        $id,
        $tipex,
        $jg,
        $afterR,
        $defectx,
        $foto,
        $ukuran_file,
        $tipe_file,
        $tmp,
        $sizex,
        $arx,
        $subx,
        $smdx,
        $isq,
        $rmdx,
        $irmx,
        $ismx,
        $idx
    ) {
        if (empty($foto)) {
            $queryUpdate = $this->db->prepare('UPDATE report set input_date=?, tipe=?, judge=?, after_repair=?, defect=?, size=?, area=?, sub_area=?, smd=?, ism=?, rmd=?, irm=?, isk=?  where id_report=?');
            $queryUpdate->bindParam(1, $id);
            $queryUpdate->bindParam(2, $tipex);
            $queryUpdate->bindParam(3, $jg);
            $queryUpdate->bindParam(4, $afterR);
            $queryUpdate->bindParam(5, $defectx);
            $queryUpdate->bindParam(6, $sizex);
            $queryUpdate->bindParam(7, $arx);
            $queryUpdate->bindParam(8, $subx);
            $queryUpdate->bindParam(9, $smdx);
            $queryUpdate->bindParam(10, $isq);
            $queryUpdate->bindParam(11, $rmdx);
            $queryUpdate->bindParam(12, $irmx);
            $queryUpdate->bindParam(13, $ismx);
            $queryUpdate->bindParam(14, $idx);
            $queryUpdate->execute();
            if ($queryUpdate) {
                echo "<script type='text/javascript'>alert('Berhasil Mengubah Data Report!');window.location.href = '../admin/data_report.php';</script>"; //redirect halaman
            } else {
                echo "<script type='text/javascript'>alert('Gagal Mengubah Data Report!');window.location.href = '../admin/data_report.php';</script>";
            }
        } else {
            $limit = 90 * 1024 * 1024;
            $foto_ket = date('dmYHis') . $foto;
            $path = "../../img/picture_report/" . $foto_ket;
            if ($tipe_file == "image/jpeg" || $tipe_file == "image/png") {
                if ($ukuran_file <= $limit) {
                    if (move_uploaded_file($tmp, $path)) {
                        $query = $this->db->prepare("SELECT * FROM report where id_report=?");
                        $query->bindParam(1, $idx);
                        $query->execute();
                        $data = $query->fetch();
                        if (is_file("../../img/picture_report/" . $data['picture'])) {
                            unlink("../../img/picture_report/" . $data['picture']);
                        }
                        $queryUpdate = $this->db->prepare('UPDATE report set input_date=?, tipe=?, judge=?, after_repair=?, defect=? , picture=?, size=?, area=?, sub_area=?, smd=?, ism=?, rmd=?, irm=?, isk=? where id_report=?');
                        $queryUpdate->bindParam(1, $id);
                        $queryUpdate->bindParam(2, $tipex);
                        $queryUpdate->bindParam(3, $jg);
                        $queryUpdate->bindParam(4, $afterR);
                        $queryUpdate->bindParam(5, $defectx);
                        $queryUpdate->bindParam(6, $foto_ket);
                        $queryUpdate->bindParam(7, $sizex);
                        $queryUpdate->bindParam(8, $arx);
                        $queryUpdate->bindParam(9, $subx);
                        $queryUpdate->bindParam(10, $smdx);
                        $queryUpdate->bindParam(11, $isq);
                        $queryUpdate->bindParam(12, $rmdx);
                        $queryUpdate->bindParam(13, $irmx);
                        $queryUpdate->bindParam(14, $ismx);
                        $queryUpdate->bindParam(15, $idx);

                        $queryUpdate->execute();

                        if ($queryUpdate) {
                            echo "<script type='text/javascript'>alert('Berhasil Mengubah Data Report!');window.location.href = '../admin/data_report.php';</script>"; //redirect halaman
                        } else {
                            echo "<script type='text/javascript'>alert('Gagal Mengubah Data Report!');window.location.href = '../admin/data_report.php';</script>";
                        }
                    } else {
                        echo "<script type='text/javascript'>alert('Gagal mengupload file!');window.location.href = '../admin/data_report.php';</script>";
                    }
                } else {
                    echo "<script type='text/javascript'>alert('Size tidak boleh lebih dari 2 Mb!');window.location.href = '../admin/data_report.php';</script>";
                }
            } else {
                echo "<script type='text/javascript'>alert('Gambar yang diupload harus ber ekstensi JPG/JPEG/PNG');window.location.href = '../admin/data_report.php';</script>";
            }
        }
    }
    public function ubahPesanan($idx, $nama, $tgl_masuk, $tgl_selesai, $jml_pemesanan, $jns_pemesanan, $jns_bahan)
    {
        $queryUpdate = $this->db->prepare('UPDATE tbl_pemesanan set nama_pemesan=?, tanggal_masuk=?, tanggal_selesai=?, jumlah_pesanan=? ,jenis_pembuatan=?, jenis_bahan=?  where nomor_id=?');
        $queryUpdate->bindParam(1, $nama);
        $queryUpdate->bindParam(2, $tgl_masuk);
        $queryUpdate->bindParam(3, $tgl_selesai);
        $queryUpdate->bindParam(4, $jml_pemesanan);
        $queryUpdate->bindParam(5, $jns_pemesanan);
        $queryUpdate->bindParam(6, $jns_bahan);
        $queryUpdate->bindParam(7, $idx);
        $queryUpdate->execute();
        if ($queryUpdate) {
            echo '<script>alert("Berhasil Mengubah Data");window.location.href = "index.php";</script>';
        } else {
            echo '<script>alert("Gagal Mengubah Data");window.location.href = "index.php";</script>';
        }
    }
    public function ubahdataukuran($idx, $nama, $ukuran, $id)
    {
        $queryUpdate = $this->db->prepare('UPDATE tbl_dataukuranbaju set nama=?, ukuran=? where id=?');
        $queryUpdate->bindParam(1, $nama);
        $queryUpdate->bindParam(2, $ukuran);
        $queryUpdate->bindParam(3, $idx);
        $queryUpdate->execute();
        if ($queryUpdate) {
            echo '<script>alert("Berhasil Mengubah Data");window.location.href = "ukuran_baju.php?get='.$id.'";</script>';
        } else {
            echo '<script>alert("Gagal Mengubah Data");window.location.href = "ukuran_baju.php?get='.$id.'";</script>';
        }
    }
    public function ubahDataAkun($id, $nama, $npk, $map, $aks, $negara)
    {
        $queryUpdate = $this->db->prepare('UPDATE akun set nama=?, npk=?, alamat=?, akses=?,  negara=?  where id_akun=?');
        $queryUpdate->bindParam(1, $nama);
        $queryUpdate->bindParam(2, $npk);
        $queryUpdate->bindParam(3, $map);
        $queryUpdate->bindParam(4, $aks);
        $queryUpdate->bindParam(5, $negara);
        $queryUpdate->bindParam(6, $id);
        $queryUpdate->execute();
        if ($queryUpdate) {
            echo "<script type='text/javascript'>alert('Berhasil Mengubah Data Pengguna!');window.location.href = '../admin/data_akun.php';</script>"; //redirect halaman
        } else {
            echo "<script type='text/javascript'>alert('Gagal Mengubah Data Pengguna!');window.location.href = '../admin/form_akun.php';</script>";
        }
    }

    public function deletepemesanan($kd_pemesanan)
    {
        $query = $this->db->prepare("DELETE FROM tbl_pemesanan where nomor_id=?");

        $query->bindParam(1, $kd_pemesanan);

        $query->execute();
        return $query->rowCount();
    }
    public function deletedataukuran($kd_ukuran)
    {
        $query = $this->db->prepare("DELETE FROM tbl_dataukuranbaju where id=?");

        $query->bindParam(1, $kd_ukuran);

        $query->execute();
        return $query->rowCount();
    }
    public function deleteReport($kd_report)
    {
        $sql = $this->db->prepare("SELECT picture FROM report WHERE id_report=:id");
        $sql->bindParam(':id', $kd_report);
        $sql->execute();
        $data = $sql->fetch();
        if (is_file("../../img/picture_report/" . $data['picture']))
            unlink("../../img/picture_report/" . $data['picture']);
        $query = $this->db->prepare("DELETE FROM report where id_report=?");

        $query->bindParam(1, $kd_report);

        $query->execute();
        return $query->rowCount();
    }

    public function showLastHistoryTipe()
    {
        $query = $this->db->prepare("SELECT * FROM tipe ORDER BY create_at DESC LIMIT 1");
        $query->execute();
        $data = $query->fetch();
        return $data;
    }
}
