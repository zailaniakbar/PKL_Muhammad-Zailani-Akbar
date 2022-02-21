<?php
  include('templates/header.php');
  include('templates/sidebar.php');
?>

<?php
    include 'koneksi.php';
    $query = mysqli_query($koneksi, "SELECT max(no_tiket) as kodeTerbesar FROM pengaduan");
    $data = mysqli_fetch_array($query);
    $kode = $data['kodeTerbesar'];
     
    $urutan = (int) substr($kode, 2, 6);
    $urutan++;
     
    $huruf = "IN";
    $kode = $huruf . sprintf("%05s", $urutan);
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Halaman Tambah Pengaduan</h1>
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
          <form action="" method="post" role="form" enctype="multipart/form-data">

            <div class="form-group">
              <label>No Tiket</label>
              <input type="text" name="no_tiket" value="<?= $kode; ?>" required="" class="form-control col-sm-4" readonly>
            </div>
                <?php if($_SESSION['hak_akses'] == 'pelanggan') {  ?>
              <div class="form-group">
              <label class="text-danger">Alamat pemasangan sesuai dengan pendaftaran.</label>
            </div>
               <input type="hidden" name="pelanggan_id" value="<?= $_SESSION['user_id']; ?>" required="" class="form-control"  >
            <?php } else { ?>
              <div class="form-group">
              <label>Pelanggan</label>
              <select class="form-control" name="pelanggan_id" required="">
                <option value="">Pilih Pelanggan</option>
                <?php
                  //memanggil file koneksi
                  $datas = mysqli_query($koneksi, "select * from pelanggan") or die(mysqli_error($koneksi));
                  while($row = mysqli_fetch_assoc($datas)) {
                ?> 
                <option value="<?= $row['id'] ?>">Kode : <?= $row['kode'] ?> // Nama : <?= $row['nama'] ?> // No. Indihome : <?= $row['no_internet'] ?> // Alamat : <?= $row['alamat'] ?></option>
              <?php } ?>
              </select>
            </div>
            <?php } ?>
            <div class="form-group">
              <label>Kategori Layanan</label> 
              <select class="form-control  col-sm-4" name="kat_layanan" required="">
                <option value="">Pilih</option>
                <option value="INTERNET">INTERNET</option>
                <option value="TELP">TELP</option>
                <option value="USEETV">USEETV</option>
              </select>
            </div>
            <div class="form-group">
              <label>Kategori Gangguan</label> 
              <select class="form-control  col-sm-4" name="kat_gangguan" required="">
                <option value="">Pilih</option>
                <option value="INET LAMBAT">INET LAMBAT</option>
                <option value="INET PUTUS-PUTUS">INET PUTUS-PUTUS</option>
                <option value="STB BELUM TERPASANG">STB BELUM TERPASANG</option>
                <option value="TELPON MATI TOTAL">TELPON MATI TOTAL</option>
                <option value="MODEM RUSAK">MODEM RUSAK</option>
                <option value="ONT LOSS">ONT LOSS</option>
                <option value="USEE TV TIDAK BISA DIGUNAKAN">USEE TV TIDAK BISA DIGUNAKAN</option>
                <option value="REMOTE RUSAK">REMOTE RUSAK</option>
                <option value="TIDAK BISA KONEKSI">TIDAK BISA KONEKSI</option>
                <option value="WIFI EXTENDER RUSAK">WIFI EXTENDER RUSAK</option>
                <option value="PINDAH PERANGKAT">PINDAH PERANGKAT</option>
                <option value="YOUTUBE TIDAK BISA">YOUTUBE TIDAK BISA</option>
                <option value="NAMA WIFI TIDAK TAMPIL">NAMA WIFI TIDAK TAMPIL</option>
                <option value="GANTI PASSWORD WIFI">GANTI PASSWORD WIFI</option>
                <option value="PLC RUSAK">PLC RUSAK</option>
                <option value="TIDAK BISA MEMANGGIL">TIDAK BISA MEMANGGIL</option>
                <option value="TIDAK BISA DIPANGGIL">TIDAK BISA DIPANGGIL</option>
                <option value="UNDERSPEK">UNDERSPEK</option>
                <option value="PERMINTAAN CABUT STB">PERMINTAAN CABUT STB</option>
                <option value="PERMINTAAN CABUT NTE">PERMINTAAN CABUT NTE</option>
                <option value="REDAMAN TINGGI">REDAMAN TINGGI</option>
                <option value="MOLA TV TIDAK BISA">MOLA TV TIDAK BISA</option>
                <option value="CATCHPLAY TIDAK BISA">CATCHPLAY TIDAK BISA</option>
              </select>
            </div>
           <!--  <div class="form-group">
              <label>Area</label>
              <select class="form-control " name="area" required="">
                <option value="">Pilih</option>
                <option value="Banjarmasin">Banjarmasin</option>
                <option value="Banjarbaru">Banjarbaru</option>
                <option value="Batulicin">Batulicin</option>
                <option value="Pelaihari">Pelaihari</option>
                <option value="Tanjung">Tanjung</option>
              </select>
            </div> -->
            <div class="form-group">
              <label>Keluhan</label>
              <input type="text" name="keluhan" required="" class="form-control"  >
            </div>
         

<!-- 
            <div class="form-group">
              <label>Keterangan Alamat / Patokan</label>
              <input type="text" name="ket_alamat" required="" class="form-control"  >
            </div>
            <div class="form-group">
              <label>Foto</label>
              <input type="file" name="foto"  class="form-control col-sm-4" onchange="validateSize(this)" >
              <i>(Abaikan jika tidak ada foto)</i>
            </div> -->

            
            <button type="submit" class="btn btn-primary" name="submit" value="simpan" id="buttonSimpan">Simpan data</button>
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
          $tgl_pengaduan = date('Y-m-d');
          $pelanggan_id = $_POST['pelanggan_id'];
         /* $area = $_POST['area'];
          $jenis_gangguan = $_POST['jenis_gangguan'];*/
          $kat_gangguan = $_POST['kat_gangguan'];
          $no_tiket = $_POST['no_tiket'];
          $kat_layanan = $_POST['kat_layanan'];
          $keluhan = $_POST['keluhan'];
          /*
          $ket_alamat = $_POST['ket_alamat'];
          $nama_gambar1   = $_FILES['foto']['name'];
          $file_tmp1    = $_FILES['foto']['tmp_name'];   
          $acak1      = rand(1,99999);

          if($nama_gambar1 != "") {
            $nama_unik1     = $acak1.$nama_gambar1;
            move_uploaded_file($file_tmp1,'assets/gambar/'.$nama_unik1);
          } else {
            $nama_unik1 = NULL;
          }
          
          $foto = $nama_unik1;*/

          $datas = mysqli_query($koneksi, "insert into pengaduan (pelanggan_id,keluhan,kat_layanan,kat_gangguan,tgl_pengaduan,no_tiket)values('$pelanggan_id','$keluhan', '$kat_layanan', '$kat_gangguan', '$tgl_pengaduan', '$no_tiket')") or die(mysqli_error($koneksi));


          echo "<script>alert('data berhasil disimpan.');window.location='pengaduan-index.php';</script>";
        }
        ?>
  <?php
    include('templates/footer.php');
  ?>
