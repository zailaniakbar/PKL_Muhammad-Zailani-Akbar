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

  @page { size: A4 }
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
<body class="A4 ">
   
  <!-- Each sheet element should have the class "sheet" -->
  <!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25- Email : pantiasuhan@gmail.com -->
  <section class="sheet padding-10mm " style="height: auto;font-size: 10px;">
    <img src="assets/gambar/logo.png" style="width: 80px;float: left;margin-right: 10px;"  class="text-center">
    <h1 class="text-left">TELKOM AKSES</h1>
    <h3 class="text-left">Karang Mekar, Kec. Banjarmasin Tim., Kota Banjarmasin, Kalimantan Selatan 70236</h3>
    <h3 class="text-left">(0511) 3255551</h3><div style="width: 100%;height: 2px;background-color: #3d3d3d;-webkit-print-color-adjust: exact;"></div>
    <h4 class="text-center">Laporan Stok STB</h4>
    <hr>
           <?php
              include('koneksi.php'); //memanggil file koneksi
              $datas_stb = mysqli_query($koneksi, "select (select count(*) from stok_stb where status ='1')  as total_stb, (select count(*) from stok_stb where status <> '1' or status is null)  as total_stb_ready") or die(mysqli_error($koneksi));
              $row_total  = mysqli_fetch_assoc($datas_stb);
              ?>
              <span class="btn btn-primary btn-sm float-right mr-2">Stok STB Ready : <?= $row_total['total_stb']; ?></span>
              <span class="btn btn-info btn-sm float-right mr-2">Stok STB Digunakan : <?= $row_total['total_stb_ready']; ?></span>
       <table class="table table-bordered" style="margin-top: 20px;" id="example2">
          <thead>
            <tr>
              <th>No</th>
              <th>Tipe</th>
              <th>Serial Number</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $datas = mysqli_query($koneksi, "select * from stok_stb") or die(mysqli_error($koneksi));

              $no = 1;//untuk pengurutan nomor

              //melakukan perulangan
              while($row = mysqli_fetch_assoc($datas)) {
            ?>  

          <tr>
            <td ><?= $no; ?></td>
            <td><?= $row['tipe']; ?></td>
            <td><?= $row['sn']; ?></td>
            <td><?= ($row['status'] == '1' ? 'Ready' : 'Sudah Digunakan'); ?></td>
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
