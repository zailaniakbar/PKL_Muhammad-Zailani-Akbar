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
            <h1>Halaman Pengaduan</h1>
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
          <?php if($_SESSION['hak_akses'] != 'teknisi') { ?>
            <a href="pengaduan-tambah.php" class="btn btn-sm btn-dark float-right">Tambah</a>
          <?php } ?>
        </div>
        <div class="card-body">
          <div class="table-responsive">
        <table class="table table-bordered nowrap"  id="example2">
          <thead>
            <tr style="white-space: nowrap ;">
              <th>No</th>
              <th>No Tiket</th>
              <th>Tanggal</th>
              <th>Kategori Layanan</th>
              <th>Kategori Gangguan</th>
              <th>Pelanggan</th>
              <th>No Hp</th>
              <th>Alamat</th>
              <th>Keluhan</th>
                <?php if($_SESSION['hak_akses'] != 'pelanggan') { ?>
              <th>Keterangan</th>
                <?php } ?>
              </tr>
          </thead>
          <tbody>
            <?php
              include('koneksi.php'); //memanggil file koneksi
             /* if($_SESSION['hak_akses'] == 'pelanggan') { 
                 $id = $_SESSION['user_id'];
                  $datas = mysqli_query($koneksi, "select pengaduan.*, pelanggan.nama,pelanggan.alamat from pengaduan JOIN pelanggan ON pelanggan.id = pengaduan.pelanggan_id WHERE pelanggan.id = '$id' group by pengaduan.id") or die(mysqli_error($koneksi));

              } else {*/

                  $datas = mysqli_query($koneksi, "select pengaduan.*, pelanggan.nama,pelanggan.alamat, pelanggan.hp, pelanggan.kode, pelanggan.no_internet from pengaduan JOIN pelanggan ON pelanggan.id = pengaduan.pelanggan_id group by pengaduan.id") or die(mysqli_error($koneksi)); 
     /*         }*/

              $no = 1;//untuk pengurutan nomor

              //melakukan perulangan
              while($row = mysqli_fetch_assoc($datas)) {
            ?>  

          <tr style="white-space: nowrap !important;">
            <td><?= $no; ?></td>
            <td><?= $row['no_tiket']; ?></td>
            <td><?= $row['tgl_pengaduan']; ?></td>
            <td><?= $row['kat_layanan']; ?></td>
            <td><span class="badge badge-danger"><?= $row['kat_gangguan']; ?></span></td>
            <td>No. Indihome : <?= $row['no_internet']; ?> - <?= $row['kode']; ?> - <?= $row['nama']; ?></td>
            <td><?= $row['hp']; ?></td>
            <td><?= $row['alamat']; ?></td>
            <td><?= $row['keluhan']; ?></td>
             
            <td>
                <a href="pengaduan-edit.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-dark">Edit</a>
                <?php if($_SESSION['hak_akses'] == 'admin') { ?>
                <a href="pengaduan-index.php?id=<?= $row['id']; ?>&status=hapus"  class="btn btn-sm btn-dark" onclick="return confirm('anda yakin ingin hapus data ini?');">Hapus</a>
              <?php } ?>
            </td>
         
          </tr>

            <?php $no++; } ?>
          </tbody>
        </table>
      </div>
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
      $datas = mysqli_query($koneksi, "delete from pengaduan where id ='$id'") or die(mysqli_error($koneksi));
      //alert dan redirect ke index.php


      echo "<script>alert('data berhasil dihapus.');window.location='pengaduan-index.php';</script>";
   }
  ?>