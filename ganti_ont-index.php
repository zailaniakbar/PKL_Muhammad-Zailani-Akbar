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
            <h1>Halaman History Ganti ONT</h1>
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
          <a href="ganti_ont-tambah.php" class="btn btn-sm btn-dark float-right">Tambah</a>
        </div>
        <div class="card-body">
        <table class="table table-bordered"  id="example2">
          <thead>
            <tr style="white-space: nowrap;">
              <th>No</th>
              <th>Tgl Ganti</th>
              <th>No Tiket</th>
              <th>Pelanggan</th>
              <th>Teknisi</th>
              <th>SN Baru</th>
              <th>SN Lama</th>
              <th>Ket</th>
               <?php  if($_SESSION['hak_akses'] == 'admin') { ?>
              <th>Aksi</th>
               <?php  } ?>
            </tr>
          </thead>
          <tbody>
            <?php
              include('koneksi.php'); //memanggil file koneksi
              $datas = mysqli_query($koneksi, "select ganti_ont.*, stok_ont.tipe, stok_ont.sn as sn_baru, pengaduan.no_tiket, pelanggan.nama as nama_pel, karyawan.nama as nama_teknisi from ganti_ont JOIN stok_ont ON stok_ont.id = ganti_ont.ont_baru_id JOIN pengaduan ON pengaduan.id = ganti_ont.pengaduan_id JOIN perbaikan ON perbaikan.pengaduan_id = pengaduan.id JOIN karyawan ON karyawan.id = perbaikan.teknisi_id JOIN pelanggan ON pelanggan.id = pengaduan.pelanggan_id group by ganti_ont.id") or die(mysqli_error($koneksi));

              $no = 1;//untuk pengurutan nomor

              //melakukan perulangan
              while($row = mysqli_fetch_assoc($datas)) {
            ?>  

          <tr style="white-space: nowrap;">
            <td><?= $no; ?></td>
            <td><?= $row['tgl_ganti']; ?></td>
            <td><?= $row['no_tiket']; ?></td>
            <td><?= $row['nama_pel']; ?></td>
            <td><?= $row['nama_teknisi']; ?></td>
            <td><?= $row['sn_baru']; ?></td>
            <td><?= $row['sn_lama']; ?></td>
            <td><?= $row['ket']; ?></td>
             <?php  if($_SESSION['hak_akses'] == 'admin') { ?>
            <td>
                <a href="ganti_ont-edit.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-dark">Edit</a>
                <a href="ganti_ont-index.php?id=<?= $row['id']; ?>&status=hapus"  class="btn btn-sm btn-dark" onclick="return confirm('anda yakin ingin hapus data ini?');">Hapus</a>
            </td>
             <?php } ?>
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

        $data_transaksi_material   = mysqli_query($koneksi, "select * from ganti_ont where id = '$id'");
        $row_keluar  = mysqli_fetch_assoc($data_transaksi_material);
        $ont_baru_id = $row_keluar['ont_baru_id'];

        mysqli_query($koneksi, "update stok_ont set status='1' where id ='$ont_baru_id'") or die(mysqli_error($koneksi));

      //query hapus
      $datas = mysqli_query($koneksi, "delete from ganti_ont where id ='$id'") or die(mysqli_error($koneksi));
      //alert dan redirect ke index.php


      echo "<script>alert('data berhasil dihapus.');window.location='ganti_ont-index.php';</script>";
   }
  ?>