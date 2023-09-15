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
          <h4>List Permohonan Pending</h4>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><i class="bi bi-house-door fs-6"></i></li>
          <li class="breadcrumb-item"> Dashboard</a></li>
          <li class="breadcrumb-item active"><a href="/permohonan_pending">List Permohonan Pending</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <div class="table-responsive">
                <table class="table table-hover table-bordered" id="sampleTable">
                  <h2>List Permohonan Pending</h2>
                  <thead>
                  <tr>
                    <th>NO</th>
                    <th>Proses</th>
                    <th>NO Registrasi</th>
                    <th>Nama Pemohon</th>
                    <th>Kategori Permohonan</th>
                    <th>Tanggal Permohonan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr>
              </thead>
            <tbody>
            <?php
            $no = 1;
            foreach ($ktp as $item):
            ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><button id="printButton" class="btn btn-primary btn-sm"><i class="bi bi-printer"></i>Cetak</button></td>
                <td><?= $item['no_registrasi'] ?></td>
                <td><?= $item['nama_lengkap'] ?></td>
                <td>Pengantar KTP</td>
                <td><?= $item['tgl_pembuatan'] ?></td>
                <td><?= $item['status'] ?></td>
                <td>
                <a href="<?= site_url('permohonan/hapus/pengantar_ktp/' . $item['id_ktp']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i class="bi bi-trash"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>

            <?php
            foreach ($kk as $item):
            ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><button id="printButton" class="btn btn-primary btn-sm"><i class="bi bi-printer"></i>Cetak</button></td>
                <td><?= $item['no_registrasi'] ?></td>
                <td><?= $item['nama_kk'] ?></td>
                <td> Pengantar KK</td>
                <td><?= $item['tgl_pembuatan'] ?></td>
                <td><?= $item['status'] ?></td>
                <td>
                <a href="<?= site_url('permohonan/hapus/pengantar_kk/' . $item['id_kk']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i class="bi bi-trash"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>

            <?php
            foreach ($ahliwaris as $item):
            ?>
            <tr>
                <td><?= $no++ ?></td>
                 <td><button id="printButton" class="btn btn-primary btn-sm"><i class="bi bi-printer"></i></button></td>
                <td></td>
                <td><?= $item['nama_lengkap'] ?></td>
                <td>Keterangan Ahli Waris</td>
                <td><?= $item['tgl_pembuatan'] ?></td>
                <td><?= $item['status'] ?></td>
                <td>
                <a href="<?= site_url('permohonan/hapus/ahli_waris/' . $item['id_waris']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i class="bi bi-trash"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>

            <?php
            foreach ($kettanah as $item):
            ?>
            <tr>
                <td><?= $no++ ?></td>
                 <td><button id="printButton" class="btn btn-primary btn-sm"><i class="bi bi-printer"></i></button></td>
                <td></td>
                <td><?= $item['identitas_pemilik'] ?></td>
                <td> Keterangan Tanah</td>
                <td><?= $item['tgl_pembuatan'] ?></td>
                <td><?= $item['status'] ?></td>
                <td>
                <a href="<?= site_url('permohonan/hapus/keterangan_tanah/' . $item['id_tanah']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i class="bi bi-trash"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>

            <?php
            foreach ($pindah as $item):
            ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><button id="printButton" class="btn btn-primary btn-sm"><i class="bi bi-printer"></i></button></td>
                <td></td>
                <td><?= $item['nama_pemohon'] ?></td>
                <td>Pengantar Pindah Keluar</td>
                <td><?= $item['tanggal_dibuat'] ?></td>
                <td><?= $item['status'] ?></td>
                <td>
                <a href="<?= site_url('permohonan/hapus/pindah_keluar/' . $item['id_pindah_keluar']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i class="bi bi-trash"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>

            <?php
            foreach ($domisili as $item):
            ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><button id="printButton" class="btn btn-primary btn-sm"><i class="bi bi-printer"></i></button></td>
                <td></td>
                <td><?= $item['nama_pemohon'] ?></td>
                <td>Keterangan Pindah Domisili</td>
                <td><?= $item['tgl_pembuatan'] ?></td>
                <td><?= $item['status'] ?></td>
                <td>
                <a href="<?= site_url('permohonan/hapus/pindah_domisili/' . $item['id_domisili']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i class="bi bi-trash"></i></a>
                </td>
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