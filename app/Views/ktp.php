<!DOCTYPE html>
<html lang="en">
  <head>
  <html lang="en">
  <head>
    <?php include('layout/meta.php'); ?>
    <!-- Navbar-->
    <?php include('layout/header.php'); ?>
    <!-- Sidebar menu-->
   <?php include('layout/sidebar.php'); ?>
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="bi bi-ui-checks"></i>Formulir Surat Pengantar KTP</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="bi bi-house-door fs-6"></i></li>
          <li class="breadcrumb-item"><a href="/ktp">Formulir Surat Pengantar KTP</a></li>
        </ul>
      </div>
      <div class="row" >
      <div class="col">
          <div class="tile">
            <h3 class="tile-title" align="center">Formulir Surat Pengantar KTP</h3>
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

                                    if ($fieldName === 'nik') {
                                        if (in_array('required', $errorParts)) {
                                            echo "<li>NIK wajib diisi</li>";
                                        } elseif (in_array('exact_length', $errorParts) && isset($filled_data['nik']) && strlen($filled_data['nik']) < 16) {
                                            echo "<li>NIK harus terdiri dari 16 angka</li>";
                                        }
                                    } else {
                                        echo "<li>$fieldName wajib diisi</li>";
                                    }
                                ?>
                            <?php endforeach ?>
                        </ul>
                    </div>
                <?php endif; ?>
            <form action="<?php echo base_url('Ktp/addData'); ?>" method="POST">
            <div class="mb-3">
              <label class="form-label" for="kategori">Kategori Surat</label>
              <select class="form-control" name="id_kategori_surat">
                  <option value="">Pilih Kategori</option>
                  <?php foreach ($kategoriOptions as $kategori) : ?>
                      <option value="<?= $kategori['id_kategori_surat']; ?>" <?= isset($filled_data['id_kategori_surat']) && $filled_data['id_kategori_surat'] == $kategori['id_kategori_surat'] ? 'selected' : ($kategori['kategori_surat'] == $defaultCategory ? 'selected' : ''); ?>>
                          <?= $kategori['kategori_surat']; ?>
                      </option>
                  <?php endforeach; ?>
              </select>
            </div>
                <div class="mb-3">
                  <label class="form-label">No Registrasi</label>
                  <input class="form-control" type="text" id="no-registrasi" name="no_registrasi">
                </div>
                <div class="mb-3">
                  <label class="form-label">No NIK</label>
                  <input class="form-control"  type="number" name="nik"  value="<?= isset($filled_data['nik']) ? $filled_data['nik'] : ''; ?>" placeholder="No NIK"></input>
                </div>
                <div class="mb-3">
                  <label class="form-label">Nama Lengkap</label>
                  <input class="form-control"  type="text" name="nama_lengkap"  value="<?= isset($filled_data['nama_lengkap']) ? $filled_data['nama_lengkap'] : ''; ?>" placeholder="Nama Lengkap"></input>
                </div>
                <div class="mb-3">
                  <label class="form-label">Tempat Lahir</label>
                  <input class="form-control" type="text" name="tempat_lahir"  value="<?= isset($filled_data['tempat_lahir']) ? $filled_data['tempat_lahir'] : ''; ?>" placeholder="Tempat Lahir"></input>
                </div>
                <div class="mb-3">
                  <label class="form-label">Tanggal Lahir</label>
                  <input class="form-control" type="date"  name="tanggal_lahir"  value="<?= isset($filled_data['tanggal_lahir']) ? $filled_data['tanggal_lahir'] : ''; ?>"></input>
                </div>
                <div class="mb-3">
                  <label class="form-label">Jenis Kelamin</label>
                  <select class="form-select" name="jenis_kelamin">
                    <option value="">--- Pilih Jenis Kelamin ---</option>
                      <option value="Laki-Laki" <?= isset($filled_data['jenis_kelamin']) && $filled_data['jenis_kelamin'] == 'Laki-Laki' ? 'selected' : ''; ?>>Laki-Laki</option>
                      <option value="Perempuan" <?= isset($filled_data['jenis_kelamin']) && $filled_data['jenis_kelamin'] == 'Perempuan' ? 'selected' : ''; ?>>Perempuan</option>
                  </select>
               </div>
                <div class="mb-3">
                  <label class="form-label">Alamat Lengkap </label>
                  <textarea class="form-control"name="alamat"  placeholder="Alamat Lengkap"><?= isset($filled_data['alamat']) ? $filled_data['alamat'] : ''; ?></textarea>
                </div>
                <div class="mb-3">
                  <label class="form-label">Agama</label>
                  <select class="form-select" name="agama">
                  <option value="">--- Pilih Agama ---</option>
                    <option value="Islam" <?= isset($filled_data['agama']) && $filled_data['agama'] == 'Islam' ? 'selected' : ''; ?>>Islam</option>
                    <option value="Kristen Protestan" <?= isset($filled_data['agama']) && $filled_data['agama'] == 'Kristen Protestan' ? 'selected' : ''; ?>>Kristen Protestan</option>
                    <option value="Kristen Katolik" <?= isset($filled_data['agama']) && $filled_data['agama'] == 'Kristen Katolik' ? 'selected' : ''; ?>>Kristen Katolik</option>
                    <option value="Hindu" <?= isset($filled_data['agama']) && $filled_data['agama'] == 'Hindu' ? 'selected' : ''; ?>>Hindu</option>
                    <option value="Budha" <?= isset($filled_data['agama']) && $filled_data['agama'] == 'Budha' ? 'selected' : ''; ?>>Budha</option>
                    <option value="Konghucu" <?= isset($filled_data['agama']) && $filled_data['agama'] == 'Konghucu' ? 'selected' : ''; ?>>Konghucu</option>
                  </select> 
                </div>
                <div class="mb-3">
                  <label class="form-label">Status Perkawinan</label>
                  <input class="form-control" type="text" name="status_perkawinan"  value="<?= isset($filled_data['status_perkawinan']) ? $filled_data['status_perkawinan'] : ''; ?>" placeholder="Status Perkawinan"></input>
                </div>
                <div class="mb-3">
                  <label class="form-label">Pekerjaan</label>
                  <input class="form-control" type="text"  name="pekerjaan"  value="<?= isset($filled_data['pekerjaan']) ? $filled_data['pekerjaan'] : ''; ?>" placeholder="Pekerjaan"></input>
                </div>
                <div class="mb-3">
                  <label class="form-label">Kewarganegaraan</label>
                  <select class="form-select" name="kewarganegaraan">
                    <option value="">--- Pilih Kewarganegaraan ---</option>
                      <option value="WNI" <?= isset($filled_data['kewarganegaraan']) && $filled_data['kewarganegaraan'] == 'WNI' ? 'selected' : ''; ?>>WNI</option>
                      <option value="WNA" <?= isset($filled_data['kewarganegaraan']) && $filled_data['kewarganegaraan'] == 'WNA' ? 'selected' : ''; ?>>WNA</option>
                  </select>
                </div>
                <div class="mb-3">
                  <label class="form-label"> Masa Berlaku</label>
                  <input class="form-control" type="text" name="berlaku" value="<?= isset($filled_data['berlaku']) ? $filled_data['berlaku'] : ''; ?>" placeholder="Masa Berlaku"></input>
                </div>
                <div class="mb-3">
                  <label class="form-label">Golongan Darah</label>
                  <input class="form-control" type="text" name="gol_darah"  value="<?= isset($filled_data['gol_darah']) ? $filled_data['gol_darah'] : ''; ?>" placeholder="Golongan Darah"></input>
                </div> 
                <div class="mb-3">
                  <label class="form-label">Tanggal Pembuatan</label>
                  <input class="form-control" type="date" name="tgl_pembuatan" value="<?= isset($filled_data['tgl_pembuatan']) ? $filled_data['tgl_pembuatan'] : date('Y-m-d'); ?>">
                </div> 
                <button class="btn btn-primary" onclick="addData()"><i class="bi bi-check-circle-fill me-2"></i>Submit</button>
                <button class="btn btn-secondary" type="reset"><i class="bi bi-arrow-counterclockwise me-2"></i>Reset</button>
               
              </form>
                <script>
                  <?php if (session()->getFlashdata('success')) : ?>
                      Swal.fire({
                          title: 'Sukses',
                          text: '<?= session()->getFlashdata('success') ?>',
                          icon: 'success'
                      }).then(() => {
                          window.location.href = '<?= base_url('dataktp'); ?>';
                      });
                  <?php elseif (session()->getFlashdata('error')) : ?>
                      Swal.fire({
                          title: 'Gagal',
                          text: '<?= session()->getFlashdata('error') ?>',
                          icon: 'error'
                      }).then(() => {
                          window.location.href = '<?= base_url('ktp'); ?>';
                      });
                  <?php endif; ?>
                </script>
        <script>
    // Ambil nomor registrasi terakhir dari PHP
    let nomorRegistrasiTerakhir = <?= isset($nextRegistrationNumber) ? intval(substr($nextRegistrationNumber, 5)) : 10 ?>;

    // Fungsi untuk mengisi nomor registrasi
    function isiNomorRegistrasi() {
        nomorRegistrasiTerakhir++;
        let formatRegistrasi = 'RGKTP' + nomorRegistrasiTerakhir;
        document.getElementById('no-registrasi').value = formatRegistrasi;
    }

    // Panggil fungsi ini saat halaman dimuat
    window.onload = isiNomorRegistrasi;
</script>
    </main>
    <?php include ('layout/footer.php')?>
  </body>
</html>