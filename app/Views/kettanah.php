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
    <!-- Navbar-->
    <?php include('layout/header.php'); ?>
    <!-- Sidebar menu-->
   <?php include('layout/sidebar.php'); ?>

    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="bi bi-ui-checks"></i> Formulir Surat Keterangan Tanah</h1>
         
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="bi bi-house-door fs-6"></i></li>
          <li class="breadcrumb-item"><a href="/kettanah"> Formulir Surat Keterangan Tanah</a></li>
        </ul>
      </div>
      <div class="row" >
          <div class="tile">
            <h3 class="tile-title" align="center"> Formulir Surat Keterangan Tanah </h3>
            <div class="tile-body">
            <?php if (isset($validation) && $validation->getErrors()): ?>
              <div class="alert alert-danger">
                <p>Data yang belum diisi:</p>
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
            <form action="<?php echo base_url('Kettanah/addData'); ?>" method="POST">
                <div class="mb-3">
                  <label class="form-label" for="kategori">Kategori Surat</label>
                    <select class="form-control" name="id_kategori_surat">
                    <option value="">Pilih Kategori</option>
                    <?php foreach ($kategoriOptions as $kategori) : ?>
                          <option value="<?= $kategori['id_kategori_surat']; ?>" <?= isset($filled_data['id_kategori_surat']) && $filled_data['id_kategori_surat'] == $kategori['id_kategori_surat'] ? 'selected' : '' ?>><?= $kategori['kategori_surat']; ?></option>
                      <?php endforeach; ?>
                      <?php if (isset($validation) && $validation->hasError('id_kategori_surat')): ?>
                    <p class="text-danger">Kategori Surat wajib diisi</p>
                  <?php endif; ?>
                    </select>
                </div>
                <div class="mb-3">
                  <label class="form-label">Identitas Pemilik</label>
                  <input class="form-control" type="text"  name="identitas_pemilik" placeholder="Masukan Identitas Pemilik Tanah " value="<?= isset($filled_data['identitas_pemilik']) ? $filled_data['identitas_pemilik'] : ''; ?>">
                  <?php if (isset($validation) && $validation->hasError('identitas_pemilik')): ?>
                    <p class="text-danger">Identitas Pemilik wajib diisi</p>
                  <?php endif; ?>
                </div>
                <div class="mb-3">
                  <label class="form-label">Luas Tanah</label>
                  <input class="form-control" type="text"  name="luas_tanah" placeholder="Masukan Luas Tanah " value="<?= isset($filled_data['luas_tanah']) ? $filled_data['luas_tanah'] : ''; ?>">
                  <?php if (isset($validation) && $validation->hasError('luas_tanah')): ?>
                    <p class="text-danger">Luas Tanah wajib diisi</p>
                  <?php endif; ?>
                </div>
                <div class="mb-3">
                  <label class="form-label">Bentuk Hak</label>
                  <input class="form-control" type="text"   name="bentuk_hak" placeholder="Masukan Bentuk Hak " value="<?= isset($filled_data['bentuk_hak']) ? $filled_data['bentuk_hak'] : ''; ?>">
                  <?php if (isset($validation) && $validation->hasError('bentuk_hak')): ?>
                    <p class="text-danger">Bentuk Hak wajib diisi</p>
                  <?php endif; ?>
                </div>
                <div class="mb-3">
                  <label class="form-label">Status Tanah</label>
                  <input class="form-control" type="text"  name="status_tanah"  placeholder="Masukan Status Hak " value="<?= isset($filled_data['status_tanah']) ? $filled_data['status_tanah'] : ''; ?>"></input>
                  <?php if (isset($validation) && $validation->hasError('status_tanah')): ?>
                    <p class="text-danger">Status Tanah wajib diisi</p>
                  <?php endif; ?>
                </div>
                <div class="mb-3">
                  <label class="form-label">Batas Tanah </label>
                  <textarea class="form-control" name="batas_tanah" placeholder="Masukan Batas Tanah"  value="<?= isset($filled_data['batas_tanah']) ? $filled_data['batas_tanah'] : ''; ?>"></textarea>
                  <?php if (isset($validation) && $validation->hasError('batas_tanah')): ?>
                    <p class="text-danger">Batas Tanah wajib diisi</p>
                  <?php endif; ?>
                </div>
                <div class="mb-3">
                  <label class="form-label">Penggunaan Tanah</label>
                  <input class="form-control" type="text" name="penggunaan_tanah" placeholder="Masukan Penggunaan Tanah" value="<?= isset($filled_data['penggunaan_tanah']) ? $filled_data['penggunaan_tanah'] : ''; ?>"></input>
                  <?php if (isset($validation) && $validation->hasError('penggunaan_tanah')): ?>
                    <p class="text-danger">Penggunaan Tanah wajib diisi</p>
                  <?php endif; ?>
                </div>
                <div class="mb-3">
                  <label class="form-label">Riwayat Transaksi</label>
                  <input class="form-control" type="text" name="riwayat_transaksi" placeholder="Masukan Riwayat Transaksi" value="<?= isset($filled_data['riwayat_transaksi']) ? $filled_data['riwayat_transaksi'] : ''; ?>"></input>
                  <?php if (isset($validation) && $validation->hasError('riwayat_transaksi')): ?>
                    <p class="text-danger">Riwayat Transaksi wajib diisi</p>
                  <?php endif; ?>
                </div>
                <div class="mb-3">
                  <label class="form-label">Tanggal Pembuatan</label>
                  <input class="form-control" type="date"  name="tgl_pembuatan" value="<?= isset($filled_data['tgl_pembuatan']) ? $filled_data['tgl_pembuatan'] : ''; ?>"></input>
                  <?php if (isset($validation) && $validation->hasError('tgl_pembuatan')): ?>
                    <p class="text-danger">Tanggal Pembuatan wajib diisi</p>
                  <?php endif; ?>
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
                          window.location.href = '<?= base_url('datatanah'); ?>';
                      });
                  <?php elseif (session()->getFlashdata('error')) : ?>
                      Swal.fire({
                          title: 'Gagal',
                          text: '<?= session()->getFlashdata('error') ?>',
                          icon: 'error'
                      }).then(() => {
                          window.location.href = '<?= base_url('kettanah'); ?>';
                      });
                  <?php endif; ?>
              </script>

    </main>
    <?php include ('layout/footer.php')?>
  </body>
</html>