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
            <h1>Halaman Edit Stok STB</h1>
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

          $id = $_GET['id']; //mengambil id material yang ingin diubah

          //menampilkan material berdasarkan id
          $data   = mysqli_query($koneksi, "select * from stok_stb where id = '$id'");
          $row  = mysqli_fetch_assoc($data);
          ?>
          <form action="" method="post" role="form">
            <input type="hidden" name="id" required="" value="<?= $row['id']; ?>">
            <div class="form-group">
              <label>Tipe</label>
              <input type="text" name="tipe" required="" value="<?= $row['tipe']; ?>" class="form-control col-sm-4" autofocus="">
            </div>
            <div class="form-group">
              <label>Serial Number</label>
              <input type="text" name="sn" required="" value="<?= $row['sn']; ?>" class="form-control col-sm-4" >
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

        //jika klik tombol submit maka akan melakukan perubahan
        if (isset($_POST['submit'])) {
          $id = $_POST['id'];
          $tipe = $_POST['tipe'];
          $sn = $_POST['sn'];

          mysqli_query($koneksi, "update stok_stb set tipe='$tipe',sn='$sn' where id ='$id'") or die(mysqli_error($koneksi));

          //redirect ke halaman index.php
          echo "<script>alert('data berhasil diupdate.');window.location='stok-index.php';</script>";
        }
        ?>
  <?php
    include('templates/footer.php');
  ?>

