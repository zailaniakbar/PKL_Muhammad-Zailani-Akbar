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
            <h1>Halaman Edit Pengaduan</h1>
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
          $data   = mysqli_query($koneksi, "select * from pengaduan where id = '$id'");
          $row  = mysqli_fetch_assoc($data);
          ?>
          <form action="" method="post" role="form" enctype="multipart/form-data">
            <input type="hidden" name="id" required="" value="<?= $row['id']; ?>">

              
            <div class="form-group">
              <label>No Tiket</label>
              <input type="text" name="no_tiket" value="<?= $row['no_tiket']; ?>" readonly="" class="form-control col-sm-4">
            </div>

            <div class="form-group">
              <label>Pelanggan</label>
              <select class="form-control  col-sm-4" name="pelanggan_id" >
                <option value="">Pilih Pelanggan</option>
                <?php
                  
                  $datas = mysqli_query($koneksi, "select * from pelanggan") or die(mysqli_error($koneksi));
                  while($data = mysqli_fetch_assoc($datas)) {
                ?> 
                <option value="<?= $data['id'] ?>" <?php echo ($row['pelanggan_id'] == $data['id']) ? 'selected' : ''; ?>>Kode : <?= $data['kode'] ?> // Nama : <?= $data['nama'] ?> // No. Indihome : <?= $data['no_internet'] ?> // Alamat : <?= $data['alamat'] ?></option>
              <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <label>Kategori Layanan</label> 
              <select class="form-control  col-sm-4" name="kat_layanan" required="">
                <option value="">Pilih</option>
                <option value="INTERNET" <?= ($row['kat_layanan'] == 'INTERNET') ? 'selected' : ''; ?>>INTERNET</option>
                <option value="TELP"  <?= ($row['kat_layanan'] == 'TELP') ? 'selected' : ''; ?>>TELP</option>
                <option value="USEETV"  <?= ($row['kat_layanan'] == 'USEETV') ? 'selected' : ''; ?>>USEETV</option>
              </select>
            </div>
            <div class="form-group">
              <label>Kategori Gangguan</label> 
              <select class="form-control  col-sm-4" name="kat_gangguan" required="">
                <option value="">Pilih</option>
                <option value="INET LAMBAT" <?= ($row['kat_gangguan'] == 'INET LAMBAT') ? 'selected' : ''; ?>>INET LAMBAT</option>
                <option value="INET PUTUS-PUTUS" <?= ($row['kat_gangguan'] == 'INET PUTUS-PUTUS') ? 'selected' : ''; ?>>INET PUTUS-PUTUS</option>
                <option value="STB BELUM TERPASANG" <?= ($row['kat_gangguan'] == 'STB BELUM TERPASANG') ? 'selected' : ''; ?>>STB BELUM TERPASANG</option>
                <option value="TELPON MATI TOTAL" <?= ($row['kat_gangguan'] == 'TELPON MATI TOTAL') ? 'selected' : ''; ?>>TELPON MATI TOTAL</option>
                <option value="MODEM RUSAK" <?= ($row['kat_gangguan'] == 'MODEM RUSAK') ? 'selected' : ''; ?>>MODEM RUSAK</option>
                <option value="ONT LOSS" <?= ($row['kat_gangguan'] == 'ONT LOSS') ? 'selected' : ''; ?>>ONT LOSS</option>
                <option value="USEE TV TIDAK BISA DIGUNAKAN" <?= ($row['kat_gangguan'] == 'USEE TV TIDAK BISA DIGUNAKAN') ? 'selected' : ''; ?>>USEE TV TIDAK BISA DIGUNAKAN</option>
                <option value="REMOTE RUSAK" <?= ($row['kat_gangguan'] == 'REMOTE RUSAK') ? 'selected' : ''; ?>>REMOTE RUSAK</option>
                <option value="TIDAK BISA KONEKSI" <?= ($row['kat_gangguan'] == 'TIDAK BISA KONEKSI') ? 'selected' : ''; ?>>TIDAK BISA KONEKSI</option>
                <option value="WIFI EXTENDER RUSAK" <?= ($row['kat_gangguan'] == 'WIFI EXTENDER RUSAK') ? 'selected' : ''; ?>>WIFI EXTENDER RUSAK</option>
                <option value="PINDAH PERANGKAT" <?= ($row['kat_gangguan'] == 'PINDAH PERANGKAT') ? 'selected' : ''; ?>>PINDAH PERANGKAT</option>
                <option value="YOUTUBE TIDAK BISA" <?= ($row['kat_gangguan'] == 'YOUTUBE TIDAK BISA') ? 'selected' : ''; ?>>YOUTUBE TIDAK BISA</option>
                <option value="NAMA WIFI TIDAK TAMPIL" <?= ($row['kat_gangguan'] == 'NAMA WIFI TIDAK TAMPIL') ? 'selected' : ''; ?>>NAMA WIFI TIDAK TAMPIL</option>
                <option value="GANTI PASSWORD WIFI" <?= ($row['kat_gangguan'] == 'GANTI PASSWORD WIFI') ? 'selected' : ''; ?>>GANTI PASSWORD WIFI</option>
                <option value="PLC RUSAK" <?= ($row['kat_gangguan'] == 'PLC RUSAK') ? 'selected' : ''; ?>>PLC RUSAK</option>
                <option value="TIDAK BISA MEMANGGIL" <?= ($row['kat_gangguan'] == 'TIDAK BISA MEMANGGIL') ? 'selected' : ''; ?>>TIDAK BISA MEMANGGIL</option>
                <option value="TIDAK BISA DIPANGGIL" <?= ($row['kat_gangguan'] == 'TIDAK BISA DIPANGGIL') ? 'selected' : ''; ?>>TIDAK BISA DIPANGGIL</option>
                <option value="UNDERSPEK" <?= ($row['kat_gangguan'] == 'UNDERSPEK') ? 'selected' : ''; ?>>UNDERSPEK</option>
                <option value="PERMINTAAN CABUT STB" <?= ($row['kat_gangguan'] == 'PERMINTAAN CABUT STB') ? 'selected' : ''; ?>>PERMINTAAN CABUT STB</option>
                <option value="PERMINTAAN CABUT NTE" <?= ($row['kat_gangguan'] == 'PERMINTAAN CABUT NTE') ? 'selected' : ''; ?>>PERMINTAAN CABUT NTE</option>
                <option value="REDAMAN TINGGI" <?= ($row['kat_gangguan'] == 'REDAMAN TINGGI') ? 'selected' : ''; ?>>REDAMAN TINGGI</option>
                <option value="MOLA TV TIDAK BISA" <?= ($row['kat_gangguan'] == 'MOLA TV TIDAK BISA') ? 'selected' : ''; ?>>MOLA TV TIDAK BISA</option>
                <option value="CATCHPLAY TIDAK BISA" <?= ($row['kat_gangguan'] == 'CATCHPLAY TIDAK BISA') ? 'selected' : ''; ?>>CATCHPLAY TIDAK BISA</option>
              </select>
            </div>

            <div class="form-group">
              <label>Keluhan</label>
              <input type="text" name="keluhan" required="" class="form-control" value="<?= $row['keluhan']; ?>" >
            </div>
            


            <button type="submit" class="btn btn-primary" name="submit" value="simpan" id="buttonSimpan">Ubah data</button>
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
          $kat_layanan = $_POST['kat_layanan'];
          $kat_gangguan = $_POST['kat_gangguan'];
          $keluhan = $_POST['keluhan'];
          $pelanggan_id = $_POST['pelanggan_id'];

          $datas = mysqli_query($koneksi, "update pengaduan set kat_layanan = '$kat_layanan',kat_gangguan = '$kat_gangguan',keluhan = '$keluhan',pelanggan_id = '$pelanggan_id' where id = '$id'") or die(mysqli_error($koneksi));
            echo "<script>alert('data berhasil diubah.');window.location='pengaduan-index.php';</script>";
        }
        ?>

  <?php
    include('templates/footer.php');
  ?>


<script>
 function validateSize(input) {
  const fileSize = input.files[0].size / 1024 / 1024; // in MiB
  if (fileSize > 1) {
    alert('File Foto dilarang lebih dari 1 MB');
    $('#buttonSimpan').prop('disabled', true);
     $('#foto').val(''); 
  } else {

    $('#buttonSimpan').prop('disabled', false);
    // Proceed further
  }
}
</script>