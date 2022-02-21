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
            <h1>Halaman Tambah Stok ONT</h1>
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
              <label>Tipe</label>
              <input type="text" name="tipe" required="" class="form-control  col-sm-4" autofocus="">
            </div>
            <div class="form-group">
              <label>Serial Number</label>
              <input type="text" name="sn" required="" class="form-control col-sm-4" >
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
        include('koneksi.php');
        
        //melakukan pengecekan jika button submit diklik maka akan menjalankan perintah simpan dibawah ini
        if (isset($_POST['submit'])) {
          //menampung data dari inputan
          $tipe = $_POST['tipe'];
          $sn = $_POST['sn'];
          $status = '1';

          $datas = mysqli_query($koneksi, "insert into stok_ont (tipe,sn,status)values('$tipe','$sn','$status')") or die(mysqli_error($koneksi));

          echo "<script>alert('data berhasil disimpan.');window.location='ont-index.php';</script>";
        }
        ?>
  <?php
    include('templates/footer.php');
  ?>

