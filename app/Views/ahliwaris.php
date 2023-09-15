<!DOCTYPE html>
<html lang="en">
  <head>
  <?php include('layout/meta.php'); ?>
   
  <body class="app sidebar-mini">
    <!-- Navbar-->
    <?php include('layout/header.php'); ?>
    <!-- Sidebar menu-->
   <?php include('layout/sidebar.php'); ?>

    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="bi bi-ui-checks"></i>Formulir Surat Keterangan Ahli Waris</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="bi bi-house-door fs-6"></i></li>
          <li class="breadcrumb-item"><a href="/ahliwaris">Formulir Surat Keterangan Ahli Waris</a></li>
        </ul>
      </div>
      <div class="row" >
          <div class="tile">
            <h3 class="tile-title" align="center">Formulir Surat Keterangan Ahli Waris</h3>
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
              <form action="<?php echo base_url('Ahliwaris/addData'); ?>" method="POST">
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
                  <label class="form-label">Nama Lengkap</label>
                  <input class="form-control" type="text" name="nama_lengkap" value="<?= isset($filled_data['nama_lengkap']) ? $filled_data['nama_lengkap'] : ''; ?>" placeholder="Nama Lengkap"></input>
                  <?php if (isset($validation) && $validation->hasError('nama_lengkap')): ?>
                    <p class="text-danger">Nama Lengkap wajib diisi</p>
                  <?php endif; ?>
                </div>
                <div class="mb-3">
                  <label class="form-label">Hubungan Keluarga</label>
                  <input class="form-control" type="text" name="hubungan_keluarga" value="<?= isset($filled_data['hubungan_keluarga']) ? $filled_data['hubungan_keluarga'] : ''; ?>" placeholder="Hubungan Keluarga dengan Pemilik" ></input>
                  <?php if (isset($validation) && $validation->hasError('hubungan_keluarga')): ?>
                    <p class="text-danger">Hubungan Keluarga wajib diisi</p>
                  <?php endif; ?>
                </div>
                <div class="mb-3">
                  <label class="form-label">Tempat Lahir</label>
                  <input class="form-control" type="text" name="tempat_lahir" value="<?= isset($filled_data['tempat_lahir']) ? $filled_data['tempat_lahir'] : ''; ?>" placeholder=" Tempat Lahir"></input>  <?php if (isset($validation) && $validation->hasError('tempat_lahir')): ?>
                    <p class="text-danger">Tempat Lahir wajib diisi</p>
                  <?php endif; ?>

                </div>
                <div class="mb-3">
                  <label class="form-label">Tanggal Lahir</label>
                  <input class="form-control" type="date" name="tanggal_lahir" value="<?= isset($filled_data['tanggal_lahir']) ? $filled_data['tanggal_lahir'] : ''; ?>"></input>
                  <?php if (isset($validation) && $validation->hasError('tanggal_lahir')): ?>
                    <p class="text-danger">Tanggal Lahir wajib diisi</p>
                  <?php endif; ?>
                </div>
                <div class="mb-3">
                  <label class="form-label">Alamat Lengkap </label>
                  <textarea class="form-control"name="alamat" value="<?= isset($filled_data['alamat']) ? $filled_data['alamat'] : ''; ?>" placeholder="Alamat Lengkap"></textarea>
                  <?php if (isset($validation) && $validation->hasError('alamat')): ?>
                    <p class="text-danger">Alamat Lengkap wajib diisi</p>
                  <?php endif; ?>
                </div>
                <div class="mb-3">
                  <label class="form-label">Kewarganegaraan</label>
                  <input class="form-control" type="text" name="kewarganegaraan" value="<?= isset($filled_data['kewarganegaraan']) ? $filled_data['kewarganegaraan'] : ''; ?>" placeholder=" Kewarganegaraan "></input>
                  <?php if (isset($validation) && $validation->hasError('kewarganegaraan')): ?>
                    <p class="text-danger">Kewarganegaraan wajib diisi</p>
                  <?php endif; ?>
                </div>
                <div class="mb-3">
                  <label class="form-label">No KTP</label>
                  <input class="form-control" type="number" name="no_ktp" value="<?= isset($filled_data['no_ktp']) ? $filled_data['no_ktp'] : ''; ?>" placeholder="No KTP "></input>
                  <?php if (isset($validation) && $validation->hasError('no_ktp')): ?>
                    <p class="text-danger">No KTP wajib diisi</p>
                  <?php endif; ?>
                </div>
                <div class="mb-3">
                  <label class="form-label">Nama Almarhum</label>
                  <input class="form-control" type="text" name="nama_almarhum" value="<?= isset($filled_data['nama_almarhum']) ? $filled_data['nama_almarhum'] : ''; ?>" placeholder="Nama Almarhum" ></input>
                  <?php if (isset($validation) && $validation->hasError('nama_almarhum')): ?>
                    <p class="text-danger">Nama Almarhum wajib diisi</p>
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
                              window.location.href = '<?= base_url('datawarisan'); ?>';
                        });
                  <?php elseif (session()->getFlashdata('error')) : ?>
                     Swal.fire({
                     title: 'Gagal',
                     text: '<?= session()->getFlashdata('error') ?>',
                         icon: 'error'
                        }).then(() => {
                          window.location.href = '<?= base_url('ahliwaris'); ?>';
                        });
                  <?php endif; ?>
              </script>
    </main>
    <?php include ('layout/footer.php')?>
  </body>
</html>