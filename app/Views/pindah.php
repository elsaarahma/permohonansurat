<!DOCTYPE html>
<html lang="en">
  <head>
  <?php include('layout/meta.php'); ?>
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/themes/admin/docs/css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
    .row {
      align-content: center;
      margin-bottom: 20px;
    }
  </style>
  </head>

  <body class="app sidebar-mini">
    <!-- Navbar-->
    <?php include('layout/header.php'); ?>
    <!-- Sidebar menu-->
   <?php include('layout/sidebar.php'); ?>

    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="bi bi-ui-checks"></i> Formulir Pengantar Surat Pindah </h1>
         
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="bi bi-house-door fs-6"></i></li>
          <li class="breadcrumb-item"><a href="/pindah"> Formulir Pengantar Surat Pindah</a></li>
        </ul>
      </div>
      <div class="row" >
          <div class="tile">
            <h3 class="tile-title" align="center">Formulir Pengantar Surat Pindah Keluar</h3>
            <div class="tile-body">
            <div class="tile-body">
            <?php if (isset($validation) && $validation->getErrors()): ?>
              <div class="alert alert-danger">
                <h4>Periksa Data Anda Kembali:</h4>
                  <ul>
                    <?php foreach ($validation->getErrors() as $error) : ?>
                    <?php
                        $errorParts = explode(' ', $error);
                        $fieldName = $errorParts[1];
                        $fieldName = rtrim($fieldName, ':');
                        echo "<li>$fieldName wajib diisi</li>";
                      ?>
                    <?php endforeach ?>
                    </ul>
                </div>
            <?php endif; ?>
            <form action="<?php echo base_url('Pindah/addData'); ?>" method="POST">
              <div class="mb-3">
                <label class="form-label" for="kategori">Kategori Surat</label>
                <select class="form-control" name="id_kategori_surat">
                  <option value="">Pilih Kategori</option>
                  <?php foreach ($kategoriOptions as $kategori) : ?>
                          <option value="<?= $kategori['id_kategori_surat']; ?>" <?= isset($filled_data['id_kategori_surat']) && $filled_data['id_kategori_surat'] == $kategori['id_kategori_surat'] ? 'selected' : '' ?>><?= $kategori['kategori_surat']; ?></option>
                      <?php endforeach; ?>
              </select>
              </div>
                <div class="mb-3">
                  <label class="form-label">Nama Pemohon</label>
                  <input class="form-control" type="text" name="nama_pemohon"  value="<?= isset($filled_data['nama_pemohon']) ? $filled_data['nama_pemohon'] : ''; ?>" placeholder="Nama Pemohon"></input>
                </div>
                <div class="mb-3">
                  <label class="form-label">No KK</label>
                  <input class="form-control" type="number"  name="no_kk"  value="<?= isset($filled_data['no_kk']) ? $filled_data['no_kk'] : ''; ?>" placeholder="No KK"></input>
                </div>
                <div class="mb-3">
                  <label class="form-label">No NIK</label>
                  <input class="form-control" type="number"  name="no_nik" value="<?= isset($filled_data['no_nik']) ? $filled_data['no_nik'] : ''; ?>" placeholder=" No NIK"></input>
                </div>
                <div class="mb-3">
                  <label class="form-label">Tempat Lahir</label>
                  <input class="form-control" type="text"  name="tempat_lahir" value="<?= isset($filled_data['tempat_lahir']) ? $filled_data['tempat_lahir'] : ''; ?>" placeholder="Tempat Lahir"></input>
                </div>
                <div class="mb-3">
                  <label class="form-label">Tanggal Lahir</label>
                  <input class="form-control" type="date"  name="tanggal_lahir" value="<?= isset($filled_data['tanggal_lahir']) ? $filled_data['tanggal_lahir'] : ''; ?>"></input>
                </div>
                </div>
                <div class="mb-3">
                  <label class="form-label">Alamat Asal </label>
                  <textarea class="form-control" name="alamat_asal"  value="<?= isset($filled_data['alamat_asal']) ? $filled_data['alamat_asal'] : ''; ?>" placeholder="Alamat Asal"></textarea>
                </div>
                <div class="mb-3">
                  <label class="form-label">Alamat Tujuan </label>
                  <textarea class="form-control"  name="alamat_tujuan" value="<?= isset($filled_data['alamat_tujuan']) ? $filled_data['alamat_tujuan'] : ''; ?>" placeholder="Alamat Tujuan"></textarea>
                </div>
                <div class="mb-3">
                  <label class="form-label">Jumlah Anggota Keluarga</label>
                  <input class="form-control" type="text" name="jml_anggota"  value="<?= isset($filled_data['jml_anggota']) ? $filled_data['jml_anggota'] : ''; ?>" placeholder="Jumlah Anggota Keluarga"></input>
                </div>
                <div class="mb-3">
                  <label class="form-label">Tujuan</label>
                  <input class="form-control" type="text"  name="tujuan"  value="<?= isset($filled_data['tujuan']) ? $filled_data['tujuan'] : ''; ?>" placeholder="Tujuan"></input>
                </div>
                <div class="mb-3">
                  <label class="form-label">Tanggal Pembuatan</label>
                  <input class="form-control" type="date"  name="tanggal_dibuat"  value="<?= isset($filled_data['tanggal_dibuat']) ? $filled_data['tanggal_dibuat'] : ''; ?>" placeholder="Tanggal Pembuatan"></input>
                </div>
                <div class="mb-3">
                  <label class="form-label">Tempat Pembuatan</label>
                  <input class="form-control" type="text" name="tempat_dibuat"  value="<?= isset($filled_data['tempat_dibuat']) ? $filled_data['tempat_dibuat'] : ''; ?>" placeholder="Tempat Pembuatan"></input>
                </div>
                <button class="btn btn-primary" onclick="addData()"><i class="bi bi-check-circle-fill me-2"></i>Submit</button>
              </form>
              <script>
        <?php if (session()->getFlashdata('success')) : ?>
            Swal.fire({
                title: 'Sukses',
                text: '<?= session()->getFlashdata('success') ?>',
                icon: 'success'
            }).then(() => {
                window.location.href = '<?= base_url('datapindah'); ?>';
            });
        <?php elseif (session()->getFlashdata('error')) : ?>
            Swal.fire({
                title: 'Gagal',
                text: '<?= session()->getFlashdata('error') ?>',
                icon: 'error'
            }).then(() => {
                window.location.href = '<?= base_url('pindah'); ?>';
            });
        <?php endif; ?>
    </script>
       
    </main>
    <?php include ('layout/footer.php')?>
  </body>
</html>