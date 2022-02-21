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
            <h1>Halaman Edit Pelanggan</h1>
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

          $id = $_GET['id']; //mengambil id pelanggan yang ingin diubah

          //menampilkan pelanggan berdasarkan id
          $data   = mysqli_query($koneksi, "select * from pelanggan where id = '$id'");
          $row  = mysqli_fetch_assoc($data);
          ?>
          <form action="" method="post" role="form" enctype="multipart/form-data">
            <input type="hidden" name="id" required="" value="<?= $row['id']; ?>">
            <div class="form-group">
              <label>Kode</label>
              <input type="text" name="kode"   class="form-control col-sm-4"  value="<?= $row['kode']; ?>" readonly="">
            </div>
            <div class="form-group">
              <label>Nik</label>
              <input type="text" name="nik" required="" class="form-control col-sm-4"  value="<?= $row['nik']; ?>" autofocus="">
            </div>
            <div class="form-group">
              <label>Nama</label>
              <input type="text" name="nama" required="" class="form-control col-sm-4"  value="<?= $row['nama']; ?>" >
            </div>
            <!-- <div class="form-group">
              <label>Jabatan</label>
              <select class="form-control  col-sm-4" name="jabatan" required="">
                <option value="">Pilih</option>
                <option value="Pimpinan" <?= ($row['jabatan'] == 'Pimpinan') ? 'selected' : ''; ?>>Pimpinan</option>
                <option value="Teknisi" <?= ($row['jabatan'] == 'Teknisi') ? 'selected' : ''; ?>>Teknisi</option>
                <option value="Admin" <?= ($row['jabatan'] == 'Admin') ? 'selected' : ''; ?>>Admin</option>
              </select>
            </div> -->
            <div class="form-group">
              <label>No Hp</label>
              <input type="text" name="hp" required="" class="form-control col-sm-4" value="<?= $row['hp']; ?>"  >
            </div>
            <div class="form-group">
              <label>Alamat</label>
              <input type="text" name="alamat" required="" class="form-control" value="<?= $row['alamat']; ?>" >
            </div>
            <div class="form-group">
              <label>No Internet</label>
              <input type="text" name="no_internet" required="" class="form-control" value="<?= $row['no_internet']; ?>" >
            </div>
            <!-- <div class="form-group">
              <label>Foto</label><br>
              <img src="assets/gambar/<?= $row['foto'];?>" width="100" class="mb-3">
              <input type="file" name="foto" class="form-control col-sm-4" >
              <i>(Abaikan jika tidak ingin ganti foto)</i>
            </div> -->
        
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
          $nik = $_POST['nik'];
          $nama = $_POST['nama'];
          $hp = $_POST['hp'];
          $alamat = $_POST['alamat'];
          $no_internet = $_POST['no_internet'];
       

          mysqli_query($koneksi, "update pelanggan set nik='$nik',nama='$nama',hp='$hp',alamat='$alamat',no_internet='$no_internet' where id ='$id'") or die(mysqli_error($koneksi));

          //redirect ke halaman index.php
         echo "<script>alert('data berhasil diupdate.');window.location='pelanggan-index.php';</script>";
        }
        ?>
  <?php
    include('templates/footer.php');
  ?>

