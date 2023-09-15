<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include('layout/meta.php'); ?>
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/themes/admin/docs/css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  </head>
  <body class="app sidebar-mini">
    <?php include('layout/header.php'); ?>

    <?php include('layout/sidebar.php'); ?>
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="bi bi-speedometer"></i> Dashboard</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="bi bi-house-door fs-6"></i></li>
          <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
        </ul>
      </div>
      <div class="row">
        
        <div class="col-md-6 col-lg-4" data-halaman="<?= base_url('permohonan_pending') ?>">
          <div class="widget-small primary coloured-icon"><i class="icon bi bi-file-earmark-minus-fill fs-1"></i>
            <div class="info">
              <h5>Permohonan Pending</h5>
              <p><b><?= $totalPending ?></b></p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-4" data-halaman="<?= base_url('pemohonan_disetujui') ?>">
          <div class="widget-small info coloured-icon"><i class="icon bi bi-file-earmark-check-fill fs-1"></i>
            <div class="info">
              <h5>Permohonan Disetujui</h5>
              <p><b><?= $totalDisetujui ?></b></p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-4" data-halaman="<?= base_url('permohonan_dibatalkan') ?>">
          <div class="widget-small warning coloured-icon"><i class="icon bi bi-file-earmark-excel-fill fs-1"></i>
            <div class="info">
              <h5>Permohonan Ditolak</h5>
              <p><b><?= $totalDibatalkan ?></b></p>
            </div>
          </div>
        </div>
      </div>
     
      </div>
    </main>
    <script>
    // Ambil semua elemen dengan atribut data-halaman
    const clickableElements = document.querySelectorAll('[data-halaman]');

    // Tambahkan event listener untuk setiap elemen
    clickableElements.forEach(element => {
        element.addEventListener('click', function() {
            const halamanTujuan = this.getAttribute('data-halaman');
            window.location.href = halamanTujuan; // Arahkan ke halaman yang sesuai
        });
    });
</script>

  </body>
</html>