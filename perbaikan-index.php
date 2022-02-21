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
            <h1>Halaman Perbaikan</h1>
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
            <a href="perbaikan-tambah.php" class="btn btn-sm btn-dark float-right">Tambah</a>
          <?php } ?>
        </div>
        <div class="card-body">
          <div class="table-responsive">
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
              <th>Foto</th>
              <th>Keterangan</th>
              </tr>
          </thead>
          <tbody>
            <?php
              include('koneksi.php'); //memanggil file koneksi
         

                  $datas = mysqli_query($koneksi, "select perbaikan.*, pengaduan.no_tiket, pengaduan.tgl_pengaduan, pelanggan.nama,pelanggan.alamat, pelanggan.no_internet, pelanggan.hp, pelanggan.kode, karyawan.nama as nama_teknisi from perbaikan JOIN pengaduan ON pengaduan.id = perbaikan.pengaduan_id JOIN pelanggan ON pelanggan.id = pengaduan.pelanggan_id LEFT JOIN karyawan ON karyawan.id = perbaikan.teknisi_id group by perbaikan.id") or die(mysqli_error($koneksi)); 
              

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
                <a href="perbaikan-edit.php?id=<?= $row['id']; ?>" class="badge badge-danger"><?= $row['status']; ?> &nbsp; <i class="fa fa-edit"></i> </a>
             <?php } ?>

           </td>
            <td><?= $row['keterangan']; ?></td>
            <td><?= $row['tgl_selesai']; ?></td>
            <td><img src="assets/gambar/<?= $row['foto'];?>" width="100"></td>
    
            <td>
               <?php if($row['status'] == 'CLOSE') { ?>
               <span class="badge badge-success">Selesai</span>
               <?php } else { ?>


               
                <?php if($_SESSION['hak_akses'] == 'admin') { ?>
                <a href="perbaikan-index.php?id=<?= $row['id']; ?>&status=hapus"  class="btn btn-sm btn-dark" onclick="return confirm('anda yakin ingin hapus data ini?');">Hapus</a>
              <?php } ?>
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
      $datas = mysqli_query($koneksi, "delete from perbaikan where id ='$id'") or die(mysqli_error($koneksi));
      //alert dan redirect ke index.php


      echo "<script>alert('data berhasil dihapus.');window.location='perbaikan-index.php';</script>";
   }
  ?>