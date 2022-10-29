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
if(isset($_GET['get'])){
  $kode = $_GET['get'];
  $data_pemesanan = $lib->get_by_id_pemesanan($kode);
  $data_pemesanan2 = $lib->get_by_id_pemesanan2($kode);
}else{
  echo "<script type='text/javascript'>alert('gagal mengambil data!');window.location.href = 'index.php';</script>";
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
<title>Surat</title>
<link rel="icon" href="assets/img/logo-med.png" sizes="32x32" />
</head>
<body>
<center>
<table width="909" height="910" border="0">
  <tbody>
    <tr>
      <td width="899" height="68" colspan="2"><table width="957" height="208" border="0">
        <tbody>
          <tr>
			<td width="109">&nbsp;</td>
            <td align="center" width="194" height="204"><img src="assets/img/logo-kecil.png" width="178" height="170" alt=""/></td>
            <td width="640" align="left" valign="bottom">
				<table width="472" height="94" border="0">
              <tbody>
                <tr>
                  <td width="466" height="21"><center>
                    <strong style="font-size:23px;">KANTOR PUSAT</strong>
                  </center></td>
                </tr>
                <tr>
                  <td height="21"><center>
                    <strong style="font-size:23px;">CV. NAKHODA NUSANTARA GRUP</strong>
                  </center></td>
                </tr>
                <tr>
                  <td height="21" style="font-size:14px;"><center>JL.Cikutra Barat Gang Cikondang 3 Nomor 16 RT 04 RW 06,</center></td>
                </tr>
                <tr>
                  <td height="21" style="font-size:14px;"><center>
                    Kota Bandung Jawa Barat 40123
                  </center></td>
                </tr>
				  <tr>
                  <td height="21" style="font-size:14px;"><center>
                    0811-224-1014 Nahkoda.nusantara@gmail.com
                  </center></td>
                </tr>
				  <tr>
                  <td height="21" style="font-size:14px;"><center>
                    Nakhodanusantara.com
                  </center></td>
                </tr>
              </tbody>
            </table>
			  </td>
            </tr>
        </tbody>
      </table>
      </tr>
      <tr>
        <td colspan="3" height="5px"><hr style="border: 1px solid;;"></td>  
      </tr>
	<tr>
		<td height="300" valign="top">
      <center><b>Awali Dengan Bismilah</b>
    <br><p>
      Surat Tugas (ST) :
    </p>
    <br>
    <table border="1" width="560" height="150" style="border-collapse: collapse; border: 1px solid black;">
    <?php 
    foreach($data_pemesanan as $row){
    ?>
<tr>
 <td><span style="margin:4px;">Nomor Id</span></td>
 <td width="30" align="center">:</td> 
 <td style="padding:4px;"><strong style="margin:4px;"><?php 
  $kd = substr($row['nomor_id'], 12, 2);
  $bulan = $lib->ubahBulan($kd);
 echo substr($row['nomor_id'], 0, 12) . $bulan. substr($row['nomor_id'], 14, 5);?></strong></td>
</tr>
<tr>
  <td><span style="margin:4px;">Nama Pemesan</span></td>
  <td width="30" align="center">:</td> 
  <td style="padding:4px;"><span style="margin:4px;"><?php echo $row['nama_pemesan'];?></span></td>
 </tr>
<tr>
  <td><span style="margin:4px;">Tanggal Masuk</span></td>
  <td width="40" align="center">:</td> 
  <td style="padding:4px;"><span style="margin:4px;"><?php $data = $row['tanggal_masuk']; $bulan = date("m", strtotime($data)); $bulan2 = $lib->ubahBulan($bulan); echo date("d", strtotime($data)) . " " . $bulan2 . " " . date("Y", strtotime($data)); ?></span></td>
 </tr>
 <tr>
  <td><span style="margin:4px;">Tanggal Selesai</span></td>
  <td width="30" align="center">:</td> 
  <td style="padding:4px;"><span style="margin:4px;"><?php $data = $row['tanggal_selesai']; $bulan = date("m", strtotime($data)); $bulan2 = $lib->ubahBulan($bulan); echo date("d", strtotime($data)) . " " . $bulan2 . " " . date("Y", strtotime($data)); ?></span></td>
 </tr>
 <tr>
  <td><span style="margin:4px;">Jumlah Pesanan</span></td>
  <td width="30" align="center">:</td> 
  <td style="padding:4px;"><span style="margin:4px;"><?php echo $row['jumlah_pesanan'];?></span></td>
 </tr>
 <tr>
  <td><span style="margin:4px;">Jenis Pembuatan</span></td>
  <td width="30" align="center">:</td> 
  <td style="padding:4px;"><span style="margin:4px;"><?php echo $row['jenis_pembuatan'];?></span></td>
 </tr>
 <tr>
  <td><span style="margin:4px;">Jenis Bahan</span></td>
  <td width="30" align="center">:</td> 
  <td style="padding:4px;"><span style="margin:4px;"><?php echo $row['jenis_bahan'];?></span></td>
 </tr>
 <tr style="background-color:yellow; -webkit-print-color-adjust: exact; ">
  <td align="center"><b>PAKAI LABEL</b></td>
  <td width="30" align="center">:</td> 
  <td style="padding:4px;"><span style="margin:4px;"></td>
 </tr>
 <?php } ?>
    </table>
  </center>
    </td>  
	</tr>
    <tr>
      <td height="370"><center>
    <img src="assets/img/gambar.png">
      </center></td>
    </tr>
  </tbody>
</table>
<div style="page-break-before:always;"></div>
<table width="909" height="490" border="0">
  <tbody>
    <tr>
      <td width="899" height="68" colspan="2"><table width="957" height="208" border="0">
        <tbody>
          <tr>
			<td width="109">&nbsp;</td>
            <td align="center" width="194" height="204"><img src="assets/img/logo-kecil.png" width="178" height="170" alt=""/></td>
            <td width="640" align="left" valign="bottom">
				<table width="472" height="94" border="0">
              <tbody>
                <tr>
                  <td width="466" height="21"><center>
                    <strong style="font-size:23px;">KANTOR PUSAT</strong>
                  </center></td>
                </tr>
                <tr>
                  <td height="21"><center>
                    <strong style="font-size:23px;">CV. NAKHODA NUSANTARA GRUP</strong>
                  </center></td>
                </tr>
                <tr>
                  <td height="21" style="font-size:14px;"><center>JL.Cikutra Barat Gang Cikondang 3 Nomor 16 RT 04 RW 06,</center></td>
                </tr>
                <tr>
                  <td height="21" style="font-size:14px;"><center>
                    Kota Bandung Jawa Barat 40123
                  </center></td>
                </tr>
				  <tr>
                  <td height="21" style="font-size:14px;"><center>
                    0811-224-1014 Nahkoda.nusantara@gmail.com
                  </center></td>
                </tr>
				  <tr>
                  <td height="21" style="font-size:14px;"><center>
                    Nakhodanusantara.com
                  </center></td>
                </tr>
              </tbody>
            </table>
			  </td>
            </tr>
        </tbody>
      </table>
      </tr>
      <tr>
        <td colspan="3" height="5px"><hr style="border: 1px solid;"></td>  
      </tr>
	<tr>
		<td vertical="top" height="20">
      <center><b style="padding:4px 300px; font-size:22px; border:1px; background-color:yellow; -webkit-print-color-adjust: exact;">Data Ukuran Baju</b></center>
    </td>  
	</tr>
  <tr>
		<td><center>
      <table style="margin-top:20px;" border="1" width="600">
        <tr>
          <th width="40">
            No
          </th>
          <th>
            Nama
          </th>
          <th width="100">
            Ukuruan
          </th>
        </tr>
        <?php
$ukuran = 1;
$batas = 40;
   $id_ukuran = $data_pemesanan2['id'];
   $query = $lib->showtabelukuranbaju2($id_ukuran, $batas, $ukuran);
   $no = 1;
   foreach ($query as $data) {
     if($no >= $batas){
$get = 1;
     }
     else{
       $get = "";
     }
        ?>
        <tr>
          <td><?= $no++; ?></td>
          <td><?= $data['nama'];?></td>
          <td><?= $data['ukuran'];?></td>
        </tr>
        <?php 
        } ?>
      </table>
    </center>
    </td>  
	</tr>
  </tbody>
</table>
<?php 
$x = 1;
$halaman = $get;
while($x <= $halaman) {
  $x++;
?>
<div style="page-break-before:always;"></div>
<table width="909" height="490" border="0">
  <tbody>
    <tr>
      <td width="899" height="68" colspan="2"><table width="957" height="208" border="0">
        <tbody>
          <tr>
			<td width="109">&nbsp;</td>
            <td align="center" width="194" height="204"><img src="assets/img/logo-kecil.png" width="178" height="170" alt=""/></td>
            <td width="640" align="left" valign="bottom">
				<table width="472" height="94" border="0">
              <tbody>
                <tr>
                  <td width="466" height="21"><center>
                    <strong style="font-size:23px;">KANTOR PUSAT</strong>
                  </center></td>
                </tr>
                <tr>
                  <td height="21"><center>
                    <strong style="font-size:23px;">CV. NAKHODA NUSANTARA GRUP</strong>
                  </center></td>
                </tr>
                <tr>
                  <td height="21" style="font-size:14px;"><center>JL.Cikutra Barat Gang Cikondang 3 Nomor 16 RT 04 RW 06,</center></td>
                </tr>
                <tr>
                  <td height="21" style="font-size:14px;"><center>
                    Kota Bandung Jawa Barat 40123
                  </center></td>
                </tr>
				  <tr>
                  <td height="21" style="font-size:14px;"><center>
                    0811-224-1014 Nahkoda.nusantara@gmail.com
                  </center></td>
                </tr>
				  <tr>
                  <td height="21" style="font-size:14px;"><center>
                    Nakhodanusantara.com
                  </center></td>
                </tr>
              </tbody>
            </table>
			  </td>
            </tr>
        </tbody>
      </table>
      </tr>
      <tr>
        <td colspan="3" height="5px"><hr style="border: 1px solid;"></td>  
      </tr>
	<tr>
		<td vertical="top" height="20">
      <center><b style="padding:4px 300px; font-size:22px; border:1px; background-color:yellow; -webkit-print-color-adjust: exact;">Data Ukuran Baju</b></center>
    </td>  
	</tr>
  <tr>
		<td><center>
      <table style="margin-top:20px;" border="1" width="600">
        <tr>
          <th width="40">
            No
          </th>
          <th>
            Nama
          </th>
          <th width="100">
            Ukuruan
          </th>
        </tr>
        <?php
   $id_ukuran = $data_pemesanan2['id'];
   $query = $lib->showtabelukuranbaju($id_ukuran);
   $no = 1;
   foreach ($query as $data) {
        ?>
        <tr>
          <td><?= $no++; ?></td>
          <td><?= $data['nama'];?></td>
          <td><?= $data['ukuran'];?></td>
        </tr>
        <?php 
        } ?>
      </table>
    </center>
    </td>  
	</tr>
  </tbody>
</table>
<?php } ?>
<!-- <script>
  window.print();
</script> -->
</body>
</html>