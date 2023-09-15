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
          <h1><i class="bi bi-ui-checks"></i> Formulir  Surat Pengantar Pindah Domisili</h1>
         
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="bi bi-house-door fs-6"></i></li>
          <li class="breadcrumb-item"><a href="/domisili"> Formulir Surat Keterangan Pindah Domisili</a></li>
        </ul>
      </div>
      <div class="row" >
      <div class="col">
          <div class="tile">
            <h3 class="tile-title" align="center"> Formulir Surat Keterangan Domisili</h3>
            <div class="tile-body">
            <?php if (isset($validation) && $validation->getErrors()): ?>
              <div class="alert alert-danger">
                <h4>Periksa Kembali Data Anda:</h4>
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
              <form action="<?php echo base_url('Domisili/addData'); ?>" method="POST">
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
                  <label class="form-label">NIK</label>
                  <input class="form-control" type="number" name="nik"  value="<?= isset($filled_data['nik']) ? $filled_data['nik'] : ''; ?>" placeholder="NIK"></input>
                </div>
                <div class="mb-3">
                  <label class="form-label">Alamat Lama</label>
                  <textarea class="form-control" type="text" name="alamat_lama" value="<?= isset($filled_data['alamat_lama']) ? $filled_data['alamat_lama'] : ''; ?>" placeholder="Alamat Lama"></textarea>
                </div>
                <div class="mb-3">
                  <label class="form-label">Alamat Baru</label>
                  <textarea class="form-control" name="alamat_baru"value="<?= isset($filled_data['alamat_baru']) ? $filled_data['alamat_baru'] : ''; ?>" placeholder="Alamat Baru"></textarea>
                </div>
                <div class="mb-3">
                  <label class="form-label">Tanggal Pindah  </label>
                  <input class="form-control" type="date"  name="tanggal_pindah"  value="<?= isset($filled_data['tanggal_pindah']) ? $filled_data['tanggal_pindah'] : ''; ?>"></input>
                </div>
                <div class="mb-3">
                  <label class="form-label">Alasan Pindah</label>
                  <input class="form-control" type="text" name="alasan_pindah"  value="<?= isset($filled_data['alasan_pindah']) ? $filled_data['alasan_pindah'] : ''; ?>" placeholder="Alasan Pindah"></input>
                </div>
                <div class="mb-3">
                  <label class="form-label">Jumlah Anggota Keluarga</label>
                  <input class="form-control" type="text" name="jml_anggota" value="<?= isset($filled_data['jml_anggota']) ? $filled_data['jml_anggota'] : ''; ?>" placeholder="Jumlah Anggota Keluarga"></input>
                </div>
                <div class="mb-3">
                  <label class="form-label">Tanggal Pembuatan</label>
                  <input class="form-control" type="date" name="tgl_pembuatan" value="<?= isset($filled_data['tgl_pembuatan']) ? $filled_data['tgl_pembuatan'] : ''; ?>" ></input>
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
                window.location.href = '<?= base_url('datadomisili'); ?>';
            });
        <?php elseif (session()->getFlashdata('error')) : ?>
            Swal.fire({
                title: 'Gagal',
                text: '<?= session()->getFlashdata('error') ?>',
                icon: 'error'
            }).then(() => {
                window.location.href = '<?= base_url('domisili'); ?>';
            });
        <?php endif; ?>
    </script>
    </main>
    <?php include ('layout/footer.php')?>
  </body>
</html>