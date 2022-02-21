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
            <h1>Halaman Tambah Pelanggan</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
<?php
    include 'koneksi.php';
    $query = mysqli_query($koneksi, "SELECT max(kode) as kodeTerbesar FROM pelanggan");
    $data = mysqli_fetch_array($query);
    $kode = $data['kodeTerbesar'];
     
    $urutan = (int) substr($kode, 1, 4);
    $urutan++;
     
    $huruf = "P";
    $kode = $huruf . sprintf("%04s", $urutan);
?>
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
              <label>Kode</label>
              <input type="text" name="kode" value="<?= $kode; ?>" required="" class="form-control col-sm-4" readonly>
            </div>
            <div class="form-group">
              <label>Nik</label>
              <input type="text" name="nik" required="" class="form-control col-sm-4" autofocus="">
            </div>
            <div class="form-group">
              <label>Nama</label>
              <input type="text" name="nama" required="" class="form-control col-sm-4" >
            </div>
<!--             <div class="form-group">
              <label>Jabatan</label>
              <select class="form-control  col-sm-4" name="jabatan" required="">
                <option value="">Pilih</option>
                <option value="Pimpinan">Pimpinan</option>
                <option value="Teknisi">Teknisi</option>
                <option value="Admin">Admin</option>
              </select>
            </div> -->
            <div class="form-group">
              <label>No Hp</label>
              <input type="text" name="hp" required="" class="form-control col-sm-4" >
            </div>
            <div class="form-group">
              <label>Alamat</label>
              <input type="text" name="alamat" required="" class="form-control" >
            </div>
            <div class="form-group">
              <label>No Internet</label>
              <input type="text" name="no_internet" required="" class="form-control" >
            </div>

<!--             <div class="form-group">
              <label>Foto</label>
              <input type="file" name="foto" class="form-control col-sm-4" >
            </div> -->

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
          $kode = $_POST['kode'];
          $nik = $_POST['nik'];
          $nama = $_POST['nama'];
          $hp = $_POST['hp'];
          $alamat = $_POST['alamat'];
          $no_internet = $_POST['no_internet'];
          $tgl_daftar = date('Y-m-d');
         /* $nama_gambar1   = $_FILES['foto']['name'];
          $file_tmp1    = $_FILES['foto']['tmp_name'];   
          $acak1      = rand(1,99999);

          if($nama_gambar1 != "") {
            $nama_unik1     = $acak1.$nama_gambar1;
            move_uploaded_file($file_tmp1,'assets/gambar/'.$nama_unik1);
          } else {
            $nama_unik1 = NULL;
          }*/
          
      /*    $foto = $nama_unik1;*/

          $datas = mysqli_query($koneksi, "insert into pelanggan (nik,nama,hp,alamat,kode,tgl_daftar,no_internet)values('$nik','$nama','$hp','$alamat','$kode','$tgl_daftar','$no_internet')") or die(mysqli_error($koneksi));

          echo "<script>alert('data berhasil disimpan.');window.location='pelanggan-index.php';</script>";
        }
        ?>
  <?php
    include('templates/footer.php');
  ?>

<script>
    function showPosition() {
 
        if(navigator.geolocation) {

            navigator.geolocation.getCurrentPosition(function(position) {
                /*var positionInfo = "Your current position is (" + "Latitude: " + position.coords.latitude + ", " + "Longitude: " + position.coords.longitude + ")";
                document.getElementById("result").innerHTML = positionInfo;*/

                $("input[name='latitude']").val(position.coords.latitude);
                $("input[name='longitude']").val(position.coords.longitude);

            });
        } else {
            alert("Sorry, your browser does not support HTML5 geolocation.");
        }
    }
</script>