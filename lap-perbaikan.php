<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">  
  <title>lap</title>

  <!-- Normalize or reset CSS with your favorite library -->
  <link rel="stylesheet" href="assets/dist/css/normalize.min.css">
  <!-- Load paper.css for happy printing -->
  <link rel="stylesheet" href="assets/dist/css/paper.css">
  <link rel="stylesheet" href="assets/dist/css/bs.css">

  <!-- Set page size here: A5, A4 or A3 -->
  <!-- Set also "" if you need -->
  <style>
  body {
    background: #666;
  }

  @page { size: A4 landscape}
* {
  font-family: "Arial";
}
.text-center {
  text-align: center;
}
h1 {
  font-size: 20px;
}
h3 {
  font-size: 14px;
  font-weight: normal;
  margin-top: -8px;
}
h4 {
  margin-top: 20px;
  text-transform: uppercase;
  margin-bottom: -10px;
}
td {
  padding: 5px !important;
  text-align: center;
  vertical-align: middle !important;
 /* border-color: #fff !important;
  padding: 5px !important;*/
  /*text-transform: capitalize;*/
}
</style>
</head>

<!-- Set "A5", "A4" or "A3" for class name -->
<!-- Set also "landscape" if you need -->
<body class="A4 landscape">
    <?php
    if(isset($_GET['bulan'])) {
                    $bul = date("m", strtotime($_GET['bulan']));
                    $tah = date("Y", strtotime($_GET['bulan']));
                }
     ?>
  <!-- Each sheet element should have the class "sheet" -->
  <!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25- Email : pantiasuhan@gmail.com -->
  <section class="sheet padding-10mm " style="height: auto;font-size: 10px;">
    <img src="assets/gambar/logo.png" style="width: 80px;float: left;margin-right: 10px;"  class="text-center">
    <h1 class="text-left">TELKOM AKSES</h1>
    <h3 class="text-left">Karang Mekar, Kec. Banjarmasin Tim., Kota Banjarmasin, Kalimantan Selatan 70236</h3>
    <h3 class="text-left">(0511) 3255551</h3><div style="width: 100%;height: 2px;background-color: #3d3d3d;-webkit-print-color-adjust: exact;"></div>
    <h4 class="text-center">Laporan Perbaikan <?= date("M", strtotime($_GET['bulan']));  ?> <?= date("y", strtotime($_GET['bulan']));  ?></h4>
    <hr>
           
      <table class="table table-bordered nowrap"  id="example2">
          <thead>
            <tr>
              <th>No</th>
              <th>No Tiket</th>
              <th>Tgl Rencana Perbaikan</th>
              <th>Pelanggan</th>
              <th>Teknisi</th>
              <th>Status</th>
              <th>Detail</th>
              <th>Tgl Selesai</th>
              </tr>
          </thead>
          <tbody>
            <?php
              include('koneksi.php'); //memanggil file koneksi
         

                  $datas = mysqli_query($koneksi, "select perbaikan.*, pengaduan.no_tiket, pengaduan.tgl_pengaduan, pelanggan.nama,pelanggan.alamat, pelanggan.no_internet, pelanggan.hp, pelanggan.kode, karyawan.nama as nama_teknisi from perbaikan JOIN pengaduan ON pengaduan.id = perbaikan.pengaduan_id JOIN pelanggan ON pelanggan.id = pengaduan.pelanggan_id LEFT JOIN karyawan ON karyawan.id = perbaikan.teknisi_id  WHERE YEAR(perbaikan.tgl_rencana_perbaikan) = '$tah' AND MONTH(perbaikan.tgl_rencana_perbaikan) = '$bul' group by perbaikan.id") or die(mysqli_error($koneksi)); 
              

              $no = 1;//untuk pengurutan nomor

              //melakukan perulangan
              while($row = mysqli_fetch_assoc($datas)) {
            ?>  

          <tr>
            <td><?= $no; ?></td>
            <td><?= $row['no_tiket']; ?></td>
            <td><?= $row['tgl_rencana_perbaikan']; ?></td>
            <td><span class="badge badge-dark"><?= $row['no_internet']; ?> // <?= $row['kode']; ?> // <?= $row['nama']; ?> // <?= $row['alamat']; ?> // <?= $row['hp']; ?></span></td>
            <td><?= $row['nama_teknisi']; ?></td>
            <td> 
               <?php if($row['status'] == 'CLOSE') { ?>
             <span class="badge badge-success"> <?= $row['status']; ?></span>
             <?php } else { ?>
                <span class="badge badge-danger"><?= $row['status']; ?> &nbsp; <i class="fa fa-edit"></i> </span>
             <?php } ?>

           </td>
            <td><?= $row['keterangan']; ?></td>
            <td><?= $row['tgl_selesai']; ?></td>
         

          </tr>

            <?php $no++; } ?>
          </tbody>
        </table>
        
        <table class="table table-bordered" style="width: 200px;font-size: 11px;float:right;margin-top: 20px;">
                    <tr style="white-space: nowrap;">
                      <th colspan="2">Banjarmasin, <?= date('Y-m-d'); ?><br> Mengetahui,</th>
                    </tr> <tr>
                      <th colspan="2">Manajer</th>
                    </tr>
                    <tr style="height: 100px;">
                      <td style="width: 50%">
                        
                      </td>
                    </tr>
                    <tr>
                      <td>
                        Dedy Rahman
                      </td>
                    </tr>
                </table>
  </section>

</body>
</html>
