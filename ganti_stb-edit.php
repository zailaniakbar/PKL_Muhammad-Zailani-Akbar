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
            <h1>Halaman Edit Transaksi Ganti STB</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Edit Data</h3>
        </div>
        <div class="card-body">
          <?php
          include('koneksi.php');

          $id = $_GET['id']; 
          $data   = mysqli_query($koneksi, "select * from ganti_stb where id = '$id'");
          $row  = mysqli_fetch_assoc($data);
          ?>
          <form action="" method="post" role="form">
            <input type="hidden" name="id" required="" value="<?= $row['id']; ?>">

            <div class="form-group">
              <label>Tanggal Ganti</label>
              <input type="date" name="tgl_ganti" required="" class="form-control col-sm-2" value="<?= $row['tgl_ganti']; ?>">
            </div>

            <div class="form-group">
              <label>SN Lama</label>
              <input type="text" name="sn_lama" required="" class="form-control col-sm-4"  value="<?= $row['sn_lama']; ?>">
            </div>
            <div class="form-group">
              <label>STB Baru</label>
              <select class="form-control  col-sm-4" name="stb_baru_id" disabled="">
                <option value="">Pilih STB</option>
                <?php
                  $datas = mysqli_query($koneksi, "select * from stok_stb") or die(mysqli_error($koneksi));
                  while($rowv = mysqli_fetch_assoc($datas)) {
                ?> 
                <option value="<?= $rowv['id'] ?>" <?= ($rowv['id'] == $row['stb_baru_id']) ? 'selected' : ''; ?>><?= $rowv['tipe'] ?> | SN : <?= $rowv['sn'] ?></option>
              <?php } ?>
              </select>
            </div>

            <div class="form-group">
              <label>Tiket</label>
              <select class="form-control  col-sm-4" name="pengaduan" disabled="">
                <?php
                  $datasa = mysqli_query($koneksi, "select * from pengaduan") or die(mysqli_error($koneksi));
                  while($rowa = mysqli_fetch_assoc($datasa)) {
                ?> 
                <option value="<?= $rowa['id'] ?>"  <?= ($rowa['id'] == $row['pengaduan_id']) ? 'selected' : ''; ?>> No Tiket : <?= $rowa['no_tiket'] ?></option>
              <?php } ?>
              </select>
            </div>
           <div class="form-group">
              <label>Keterangan</label>
              <input type="text" name="ket" required="" class="form-control" value="<?= $row['ket']; ?>" >
            </div>
            <button type="submit" class="btn btn-primary" name="submit" value="simpan">Ubah data</button>
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
        include('koneksi.php');
        
        //melakukan pengecekan jika button submit diklik maka akan menjalankan perintah simpan dibawah ini
        if (isset($_POST['submit'])) {
          //menampung data dari inputan
          $id = $_POST['id'];
          $tgl_ganti = $_POST['tgl_ganti'];
          $sn_lama = $_POST['sn_lama'];
          $ket = $_POST['ket'];

          $datas = mysqli_query($koneksi, "update ganti_stb set tgl_ganti = '$tgl_ganti',sn_lama = '$sn_lama',ket = '$ket' where id = '$id'") or die(mysqli_error($koneksi));
            echo "<script>alert('data berhasil diubah.');window.location='ganti_stb-index.php';</script>";
        }
        ?>
  <?php
    include('templates/footer.php');
  ?>

