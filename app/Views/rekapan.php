
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include('layout/meta.php'); ?>
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/themes/admin/docs/css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  </head>
  <body class="app sidebar-mini">
    <!-- Navbar-->
    <?php include('layout/header.php'); ?>

    <?php include('layout/sidebar.php'); ?>
    <main class="app-content">
      <div class="app-title">
        <div>
          <h4>Rekap Permohonan</h4> 
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><i class="bi bi-house-door fs-6"></i></li>
          <li class="breadcrumb-item"> Manajemen Surat</a></li>
          <li class="breadcrumb-item active"><a href="/rekapan">Rekapan Permohonan </a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <div class="table-responsive">
                <table class="table table-hover table-bordered" id="sampleTable">
                  <h2>Rekap Permohonan</h2>
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Kategori Permohonan</th>
                    <th>Pending</th>
                    <th>Disetujui</th>
                    <th>Dibatalkan</th>
                    <th>Total</th>
                  </tr>
              </thead>
            <tbody>
            <?php  $nomor = 1;  foreach ($data as $item) : ?>
            <tr>
                <td><?= $nomor++; ?></td>
                <td><?= $item['kategori'] ?></td>
                <td><?= $item['pending'] ?></td>
                <td><?= $item['disetujui'] ?></td>
                <td><?= $item['dibatalkan'] ?></td>
                <td><?= $item['total'] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
    <?php include ('layout/footer.php')?>
  </body>
</html>