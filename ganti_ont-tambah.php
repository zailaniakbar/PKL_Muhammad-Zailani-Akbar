<?php
  include('templates/header.php');
  include('templates/sidebar.php');
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Halaman Tambah Ganti ONT</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Tambah Data</h3>
        </div>
        <div class="card-body">
          <form action="" method="post" role="form">

            <div class="form-group">
              <label>Tanggal Ganti ONT</label>
              <input type="date" name="tgl_ganti" required="" class="form-control col-sm-2" >
            </div>
            <div class="form-group">
              <label>SN Lama</label>
              <input type="text" name="sn_lama" required="" class="form-control col-sm-4" >
            </div>
            <div class="form-group">
              <label>ONT Baru</label>
              <select class="form-control  col-sm-4" name="ont_baru_id" required="">
                <option value="">Pilih ONT</option>
                <?php
                  include('koneksi.php'); //memanggil file koneksi
                  $datas = mysqli_query($koneksi, "select * from stok_ont where status ='1'") or die(mysqli_error($koneksi));
                  while($row = mysqli_fetch_assoc($datas)) {
                ?> 
                <option value="<?= $row['id'] ?>"><?= $row['tipe'] ?> | SN : <?= $row['sn'] ?></option>
              <?php } ?>
              </select>
            </div>

            <div class="form-group">
              <label>Tiket</label>
              <select class="form-control  col-sm-4" name="pengaduan_id" required="">
                <option value="">Pilih Tiket</option>
                <?php
                  $datas = mysqli_query($koneksi, "select * from pengaduan where id not in (select pengaduan_id from ganti_ont)") or die(mysqli_error($koneksi));
                  while($row = mysqli_fetch_assoc($datas)) {
                ?> 
                <option value="<?= $row['id'] ?>"> No Tiket : <?= $row['no_tiket'] ?></option>
              <?php } ?>
              </select>
            </div>
            
            <div class="form-group">
              <label>Keterangan</label>
              <input type="text" name="ket" required="" class="form-control" >
            </div>
            <button type="submit" class="btn btn-primary" name="submit" value="simpan">Simpan data</button>
          </form>
      </div>
    </div>
        <!-- /.card-body -->
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php
        
        //melakukan pengecekan jika button submit diklik maka akan menjalankan perintah simpan dibawah ini
        if (isset($_POST['submit'])) {
          //menampung data dari inputan
          $ont_baru_id = $_POST['ont_baru_id'];
          $tgl_ganti = $_POST['tgl_ganti'];
          $sn_lama = $_POST['sn_lama'];
          $pengaduan_id = $_POST['pengaduan_id'];
          $ket = $_POST['ket'];

          $datas = mysqli_query($koneksi, "insert into ganti_ont (ont_baru_id,pengaduan_id,tgl_ganti,sn_lama,ket)values('$ont_baru_id','$pengaduan_id','$tgl_ganti','$sn_lama','$ket')") or die(mysqli_error($koneksi));

          mysqli_query($koneksi, "update stok_ont set status='0' where id ='$ont_baru_id'") or die(mysqli_error($koneksi));

          echo "<script>alert('data berhasil disimpan.');window.location='ganti_ont-index.php';</script>";
        }
        ?>
  <?php
    include('templates/footer.php');
  ?>

