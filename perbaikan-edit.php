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
            <h1>Halaman Edit Perbaikan</h1>
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
          $data   = mysqli_query($koneksi, "select * from perbaikan where id = '$id'");
          $row  = mysqli_fetch_assoc($data);
          ?>
          <form action="" method="post" role="form" enctype="multipart/form-data">
            <input type="hidden" name="id" required="" value="<?= $row['id']; ?>">
            <input type="hidden" name="pengaduan_id" required="" value="<?= $row['pengaduan_id']; ?>">

              
            
            <div class="form-group">
              <label>No. Tiket</label>
              <select class="form-control  col-sm-4" name="pengaduan_id" disabled="" >
                <?php
                  
                  $datas = mysqli_query($koneksi, "select * from pengaduan") or die(mysqli_error($koneksi));
                  while($data = mysqli_fetch_assoc($datas)) {
                ?> 
                <option value="<?= $data['id'] ?>" <?php echo ($row['pengaduan_id'] == $data['id']) ? 'selected' : ''; ?>><?= $data['no_tiket'] ?></option>
              <?php } ?>
              </select>
            </div>
                <?php if($_SESSION['hak_akses'] == 'admin') { ?>
            <div class="form-group">
              <label>Teknisi</label>
              <select class="form-control  col-sm-4" name="teknisi_id" required="">
                <option value="">Pilih Teknisi</option>
                <?php
                  $datas = mysqli_query($koneksi, "select * from karyawan where jabatan ='teknisi'") or die(mysqli_error($koneksi));
                  while($data = mysqli_fetch_assoc($datas)) {
                ?> 
                <option value="<?= $data['id'] ?>" <?php echo ($row['teknisi_id'] == $data['id']) ? 'selected' : ''; ?>><?= $data['nama'] ?></option>
              <?php } ?>
              </select>
            </div>

             <?php } else { ?>
               <input type="hidden" name="teknisi_id" required="" class="form-control" value="<?= $row['teknisi_id']; ?>" >
              <?php } ?>



            <div class="form-group">
              <label>Status</label>
              <select class="form-control  col-sm-4" name="status" required="">
                <option value="">Pilih</option>
                <option value="ON PROGRESS" <?= ($row['status'] == 'ON PROGRESS') ? 'selected' : ''; ?>>ON PROGRESS</option>
                <option value="BERANGKAT" <?= ($row['status'] == 'BERANGKAT') ? 'selected' : ''; ?>>BERANGKAT</option>
                <option value="KENDALA" <?= ($row['status'] == 'KENDALA') ? 'selected' : ''; ?>>KENDALA</option>
                <option value="CLOSE" <?= ($row['status'] == 'CLOSE') ? 'selected' : ''; ?>>CLOSE</option>
              </select>
            </div>

            <div class="form-group">
              <label>Keterangan</label>
              <input type="text" name="keterangan" required="" class="form-control" value="<?= $row['keterangan']; ?>" >
            </div>
            <div class="form-group">
              <label>Tanggal Selesai</label>
              <input type="date" name="tgl_selesai"  class="form-control col-sm-2" value="<?= $row['tgl_selesai']; ?>">
            </div>

            <div class="form-group">
              <label>Gambar Perbaikan</label><br>
              <img src="assets/gambar/<?= $row['foto'];?>" width="100" class="mb-3">
              <input type="file" name="foto" class="form-control col-sm-4" >
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
       
        
        //melakukan pengecekan jika button submit diklik maka akan menjalankan perintah simpan dibawah ini
        if (isset($_POST['submit'])) {
          //menampung data dari inputan
          $id = $_POST['id'];
          $pengaduan_id = $_POST['pengaduan_id'];
          $keterangan = $_POST['keterangan'];
          $status = $_POST['status'];
          $teknisi_id = $_POST['teknisi_id'];
          $tgl_selesai = $_POST['tgl_selesai'];
          $nama_gambar1   = $_FILES['foto']['name'];
          $file_tmp1    = $_FILES['foto']['tmp_name'];   
          $acak1      = rand(1,99999);
          if($nama_gambar1 != "") {
            $nama_unik1     = $acak1.$nama_gambar1;
            move_uploaded_file($file_tmp1,'assets/gambar/'.$nama_unik1);
          } else {
            $nama_unik1 = $row['foto'];
          }
          $foto = $nama_unik1;

          $datas = mysqli_query($koneksi, "update perbaikan set keterangan = '$keterangan',status = '$status',foto = '$foto',teknisi_id = '$teknisi_id',tgl_selesai = '$tgl_selesai' where id = '$id'") or die(mysqli_error($koneksi));

          if($status == 'selesai') {
           //kirim notif
          
            include 'send-message.php';

            $data_p   = mysqli_query($koneksi, "select pelanggan.*, pengaduan.no_tiket from pelanggan join pengaduan on pengaduan.pelanggan_id = pelanggan.id where pengaduan.id = '$pengaduan_id'");
            $row_p  = mysqli_fetch_assoc($data_p);

            $phone = $row_p['hp'];
            $no_tiket = $row_p['no_tiket'];
            $message = 'No. Tiket '.$no_tiket.' telah selesai diperbaiki oleh Teknisi kami, Terima kasih sudah setia menggunakan Indihome.';
            $waktu = date('Y-m-d H:i:s');
            
            $status = kirim_pesan($phone, $message);
            mysqli_query($koneksi, "insert into kirim_pesan (hp,waktu,pesan,status)values('$phone','$waktu','$message','$status')") or die(mysqli_error($koneksi));
          }

            echo "<script>alert('data berhasil diubah.');window.location='perbaikan-index.php';</script>";
        }
        ?>
  <?php
    include('templates/footer.php');
  ?>

