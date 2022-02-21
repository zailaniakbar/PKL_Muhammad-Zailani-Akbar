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
            <h1>Halaman Stok STB</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Data</h3>
             <?php
              include('koneksi.php'); //memanggil file koneksi
              $datas_stb = mysqli_query($koneksi, "select count(*) as total_stb from stok_stb  where status ='1'") or die(mysqli_error($koneksi));
              $row_total  = mysqli_fetch_assoc($datas_stb);
              ?>
          <a href="stok-tambah.php" class="btn btn-sm btn-dark float-right">Tambah</a>
          <span class="btn btn-info btn-sm float-right mr-2">Stok STB Ready : <?= $row_total['total_stb']; ?></span>
        </div>
        <div class="card-body">
        <table class="table table-bordered" id="example2">
          <thead>
            <tr>
              <th>No</th>
              <th>Tipe</th>
              <th>Serial Number</th>
              <th>Status</th>
              <th>Aksi</th>
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
            <td style="text-align: center;">
                <a href="stok-edit.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-dark">Edit</a>
                <a href="stok-index.php?id=<?= $row['id']; ?>&status=hapus" class="btn btn-sm btn-dark" onclick="return confirm('anda yakin ingin hapus data ini?');">Hapus</a>
            </td>
          </tr>

            <?php $no++; } ?>
          </tbody>
        </table>
      </div>
    </div>
        <!-- /.card-body -->
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php
    include('templates/footer.php');
  ?>

  <?php
   if ((isset($_GET['status'])) && ($_GET['status'] == 'hapus')) {
      $id = $_GET['id']; //menampung id
      //query hapus
      $datas = mysqli_query($koneksi, "delete from stok_stb where id ='$id'") or die(mysqli_error($koneksi));
      //alert dan redirect ke index.php
      echo "<script>alert('data berhasil dihapus.');window.location='stok-index.php';</script>";
   }
  ?>

