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
            <h1>Halaman Utama</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Default box background: url('assets/gambar/bg.png');background-size: 50% 50%; background-position: center; background-repeat: no-repeat; -->
      <div class="card" style="">
        <div class="card-body text-center" >

   <!--        <?php if(($_SESSION['hak_akses'] == 'admin') || ($_SESSION['hak_akses'] == 'teknisi')) { ?>
          <h1>Selamat datang di halaman admin & teknisi Indihome.</h1>
          <?php }else { ?>

          <h1>Selamat datang pelanggan baru Indihome.</h1>
            <?php } ?>
          -->
          <img src="assets/gambar/telkom.jpg" style="width: 100%;" > 
        </div>
        <!-- /.card-body -->
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php
    include('templates/footer.php');
  ?>

<script type="text/javascript">
  $('.carousel').carousel({
  interval: 2000
})
</script>