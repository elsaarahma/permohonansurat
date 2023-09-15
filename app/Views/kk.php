<!DOCTYPE html>
<html lang="en">
  <head>
  <?php include('layout/meta.php'); ?>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
          <h1><i class="bi bi-ui-checks"></i> Formulir Surat Pengantar Kartu Keluarga</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="bi bi-house-door fs-6"></i></li>
          <li class="breadcrumb-item"><a href="/kk"> Formulir Surat Pengantar Kartu Keluarga</a></li>
        </ul>
      </div>
      <div class="row" >
      <div class="col">
          <div class="tile">
            <h3 class="tile-title" align="center"> Formulir Surat Pengantar Kartu Keluarga</h3>
            <div class="tile-body">
            <?php if (isset($validation) && $validation->getErrors()): ?>
              <div class="alert alert-danger">
                <p>Periksa kembali data anda:</p>
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
              <form action="<?php echo base_url('Kk/addData'); ?>" method="POST">
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
                  <label class="form-label">Nama Kepala Keluarga</label>
                  <input class="form-control" type="text" name="nama_kk"  value="<?= isset($filled_data['nama_kk']) ? $filled_data['nama_kk'] : ''; ?>" placeholder="Nama Lengkap Kepala Keluarga "></input>
                  <?php if (isset($validation) && $validation->hasError('nama_kk')): ?>
                    <p class="text-danger">Nama Kepala Keluarga wajib diisi</p>
                  <?php endif; ?>
                </div>
                <div class="mb-3">
                  <label class="form-label">NIK</label>
                  <input class="form-control" type="number" name="nik_kk" value="<?= isset($filled_data['nik_kk']) ? $filled_data['nik_kk'] : ''; ?>" placeholder="NIK Kepala Keluarga"></input>
                  <?php if (isset($validation) && $validation->hasError('nik_kk')): ?>
                    <?php if ($validation->getError('nik_kk') === 'required'): ?>
                        <p class="text-danger">NIK wajib diisi</p>
                    <?php elseif ($validation->getError('nik_kk') === 'exact_length'): ?>
                        <p class="text-danger">NIK harus terdiri dari 16 angka</p>
                    <?php endif; ?>
                  <?php endif; ?>
                </div>
                <div class="mb-3">
                  <label class="form-label">Alamat Lengkap </label>
                  <textarea class="form-control"  name="alamat"   value="<?= isset($filled_data['alamat']) ? $filled_data['alamat'] : ''; ?>" placeholder="Alamat"></textarea>
                  <?php if (isset($validation) && $validation->hasError('alamat')): ?>
                    <p class="text-danger">Alamat Lengkap wajib diisi</p>
                  <?php endif; ?>
                </div>
                <div class="mb-3">
                  <label class="form-label">Desa/Kelurahan</label>
                  <input class="form-control" type="text" name="desa_kelurahan"   value="<?= isset($filled_data['desa_kelurahan']) ? $filled_data['desa_kelurahan'] : ''; ?>" placeholder="Desa/Kelurahan"></input>
                  <?php if (isset($validation) && $validation->hasError('desa_kelurahan')): ?>
                    <p class="text-danger">Desa/Kelurahan wajib diisi</p>
                  <?php endif; ?>
                </div>
                <div class="mb-3">
                  <label class="form-label">Kecamatan</label>
                  <input class="form-control" type="text" name="kecamatan"  value="<?= isset($filled_data['kecamatan']) ? $filled_data['kecamatan'] : ''; ?>" placeholder="Kecamatan"></input>
                  <?php if (isset($validation) && $validation->hasError('nama_lengkap')): ?>
                    <p class="text-danger">Kecamatan wajib diisi</p>
                  <?php endif; ?>
                </div>
                <div class="mb-3">
                  <label class="form-label">Kabupaten/Kota</label>
                  <input class="form-control" type="text"  name="kabupaten_kota" value="<?= isset($filled_data['kabupaten_kota']) ? $filled_data['kabupaten_kota'] : ''; ?>" placeholder="Kabupaten/Kota"></input>
                  <?php if (isset($validation) && $validation->hasError('kabupaten_kota')): ?>
                    <p class="text-danger">Kabupaten/Kota wajib diisi</p>
                  <?php endif; ?>
                </div>
                <div class="mb-3">
                  <label class="form-label">Provinsi</label>
                  <input class="form-control" type="text" name="provinsi"  value="<?= isset($filled_data['provinsi']) ? $filled_data['provinsi'] : ''; ?>" placeholder="Provinsi"></input>
                  <?php if (isset($validation) && $validation->hasError('provinsi')): ?>
                    <p class="text-danger">Provinsi wajib diisi</p>
                  <?php endif; ?>
                </div>
                <div class="mb-3">
                  <label class="form-label">Kode Pos</label>
                  <input class="form-control" type="text"  name="kode_pos"  value="<?= isset($filled_data['kode_pos']) ? $filled_data['kode_pos'] : ''; ?>"placeholder="Kode Pos"></input>
                  <?php if (isset($validation) && $validation->hasError('kode_pos')): ?>
                    <p class="text-danger">Kode Pos wajib diisi</p>
                  <?php endif; ?>
                </div>
                <div class="mb-3">
                  <label class="form-label">Jumlah Anggota Keluarga</label>
                  <input class="form-control" type="number" name="jml_anggota"  value="<?= isset($filled_data['jml_anggota']) ? $filled_data['jml_anggota'] : ''; ?>" placeholder="Jumlah Anggota Keluarga"></input>
                  <?php if (isset($validation) && $validation->hasError('jml_anggota')): ?>
                    <p class="text-danger">Jumlah Anggota Keluarga wajib diisi</p>
                  <?php endif; ?>
                </div>
                <div class="mb-3">
                  <label class="form-label">Tujuan</label>
                  <input class="form-control" type="text"  name="tujuan"  value="<?= isset($filled_data['tujuan']) ? $filled_data['tujuan'] : ''; ?>" placeholder="Tujuan"></input> 
                  <?php if (isset($validation) && $validation->hasError('tujuan')): ?>
                    <p class="text-danger">Tujuan wajib diisi</p>
                  <?php endif; ?>
                </div>
                <div class="mb-3">
                  <label class="form-label">Tanggal Pembuatan</label>
                  <input class="form-control" type="date"  name="tgl_pembuatan" value="<?= isset($filled_data['tgl_pembuatan']) ? $filled_data['tgl_pembuatan'] : ''; ?>" ></input>
                  <?php if (isset($validation) && $validation->hasError('nama_lengkap')): ?>
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
                          window.location.href = '<?= base_url('datakk'); ?>';
                      });
                  <?php elseif (session()->getFlashdata('error')) : ?>
                      Swal.fire({
                          title: 'Gagal',
                          text: '<?= session()->getFlashdata('error') ?>',
                          icon: 'error'
                      }).then(() => {
                          window.location.href = '<?= base_url('kk'); ?>';
                      });
                  <?php endif; ?>
              </script>
    </main>
   <?php include ('layout/footer.php')?>
  </body>
</html>