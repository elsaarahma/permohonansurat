<!DOCTYPE html>
<html lang="en">
  <head>
   <?php include('layout/meta.php'); ?>
   <?php echo $this->Section('style'); ?>
   <script src="<?php echo base_url();?> assets/themes/admin/docs/js/jquery-3.7.0.min.js"></script>
   <?php echo $this->endSection(); ?>
    <style>
      .form-label {
      margin-bottom: 0; 
    }

    #searchInput {
      flex: 1;
      margin-right: 5px;
    }

   </style>
  </head>
  <body>

   <body class="app sidebar-mini">
    <?php include('layout/header.php'); ?>

    <?php include('layout/sidebar.php'); ?>
    
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1>Data Pengantar Surat Kartu Keluarga</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><i class="bi bi-house-door fs-6"> </i></li>
          <li class="breadcrumb-item active"><a href="/datakk">Data Pengantar Surat Kartu Keluarga</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">  
              <div class="table-responsive">
                <h2 align="center">Data Pengantar Surat Kartu Keluarga</h2>
                <!-- search dan show entries-->
                <div class="d-flex justify-content-between mb-3">
                  <div class="dataTables_length" id="showEntries">
                    <label for="showEntriesSelect" class="form-label">Show Entries
                      <select class="form-select form-select-sm" id="showEntriesSelect">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                      </select>
                    </label>
                    <a href="/kk" class="btn btn-primary"><i class="bi bi-plus-lg"></i>Tambah Data</a>
                  </div>
                  <form action="/datakk/search" method="get"></form>
                  <div class="col-md-3 text-end">
                    <div class="input-group col-md-5">
                    <input type="text" class="form-control form-control-sm"  name="keyword" id="searchInput" placeholder="Search...">
                    <button class="btn btn-outline-secondary" id="searchButton">Search</button>
                  </div>
                </div>
                </div>
               <!--tampilan Data-->
               <div class="table-responsive"></div>
              <table class="table table-hover table-bordered" id="sampleTable">
                <thead>
                  <tr>
                    <th scope="col"> No</th>
                    <th scope="col"> Kategori Surat</th>
                    <th scope="col"> Nama Kepala Keluarga</th>
                    <th scope="col"> NIK Kepala Keluarga</th>
                    <th scope="col"> Alamat</th>
                    <th scope="col"> Desa/Kelurahan </th>
                    <th scope="col"> Kecamatan</th>
                    <th scope="col"> Kabupaten/Kota</th>
                    <th scope="col"> Provinsi</th>
                    <th scope="col"> Kode Pos</th>
                    <th scope="col"> Jumlah Anggota Keluarga</th>
                    <th scope="col"> Tujuan</th>
                    <th scope="col"> Tanggal Pembuatan</th>
                    <th scope="col"> Status</th>
                    <th scope="col"> Aksi</th>
                  </tr>
                </thead>
                <tbody>
             <?php $nomor = 1; ?>
                <?php  foreach ($datakk as $row): ?>
                    <tr>
                      <td><?php echo $nomor++; ?></td>
                      <td><?php echo $row['id_kategori_surat']; ?></td>
                      <td><?php echo $row['nama_kk']; ?></td>
                      <td><?php echo $row['nik_kk']; ?></td>
                      <td><?php echo $row['alamat']; ?></td>
                      <td><?php echo $row['desa_kelurahan']; ?></td>
                      <td><?php echo $row['kecamatan']; ?></td>
                      <td><?php echo $row['kabupaten_kota']; ?></td>
                      <td><?php echo $row['provinsi']; ?></td>
                      <td><?php echo $row['kode_pos']; ?></td>
                      <td><?php echo $row['jml_anggota']; ?></td>
                      <td><?php echo $row['tujuan']; ?></td>
                      <td><?php echo $row['tgl_pembuatan']; ?></td>
                      <td><?php echo $row['status']; ?></td>
                      <td>
                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-edit-<?php echo $row['id_kk']; ?>"><i class="bi bi-pen-fill"></i>Edit</button> <br>
                        <button class="btn btn-danger btn-sm" onclick="deleteData(<?php echo $row['id_kk']; ?>)">
                        <i class="bi bi-trash"></i> Hapus</button>
                      <script>
                        function deleteData(id_kk) {
                            Swal.fire({
                                title: 'Konfirmasi',
                                text: 'Apakah Anda yakin ingin menghapus data ini?',
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonText: 'Hapus',
                                cancelButtonText: 'Batal',
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    fetch(`/kk/delete/${id_kk}`, { // Ganti dengan URL yang sesuai
                                        method: 'DELETE',
                                        headers: {
                                            'X-CSRF-TOKEN': '<?= csrf_hash() ?>'
                                        },
                                    })
                                    .then(response => response.json())
                                    .then(data => {
                                        if (data.success) {
                                            Swal.fire({
                                                title: 'Sukses',
                                                text: data.message,
                                                icon: 'success'
                                            }).then(() => {
                                                location.reload(); // Refresh halaman setelah penghapusan berhasil
                                            });
                                        } else {
                                            Swal.fire({
                                                title: 'Gagal',
                                                text: data.message,
                                                icon: 'error'
                                            });
                                        }
                                    })
                                    .catch(error => {
                                        console.error('Terjadi kesalahan:', error);
                                        Swal.fire({
                                            title: 'Error',
                                            text: 'Terjadi kesalahan saat menghubungi server.',
                                            icon: 'error'
                                        });
                                    });
                                }
                            });
                        }
                      </script>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
              </div>
              </div>
            </div>
            <!-- Modal edit data -->
            <?php foreach ($datakk as $row): ?>
              <div class="modal fade" id="modal-edit-<?php echo $row['id_kk']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="modal-editLabel">Edit Pengantar KK</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form id="editForm-<?php echo $row['id_kk']; ?>"  class="form-horizontal">
                  <div class="modal-body">
                  <div class="col-md-12">
                        <label class="form-label">Kategori Surat</label>
                        <select class="form-control" name="id_kategori_surat" required>
                            <option value="">Pilih Kategori</option>
                            <?php foreach ($kategoriOptions as $kategori) : ?>
                                <option value="<?= $kategori['id_kategori_surat']; ?>" <?php if ($kategori['id_kategori_surat'] == $row['id_kategori_surat']) echo "selected"; ?>>
                                <?= $kategori['kategori_surat']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                      <label class="form-label col-md-12">Nama Kepala Keluarga</label>
                      <div class="col-md-12">
                      <input value="<?php echo $row['nama_kk']; ?>" class="form-control" type="text" name="nama_kk" >
                      </div>
                      <label class="form-label col-md-12">NIK Kepala Keluarga</label>
                      <div class="col-md-12">
                      <input value="<?php echo $row['nik_kk']; ?>" class="form-control" type="text" name="nik_kk"  >
                      </div>
                      <label class="form-label col-md-12">Alamat</label>
                      <div class="col-md-12">
                      <input value="<?php echo $row['alamat']; ?>" class="form-control"  name="alamat"  >
                      </div>
                      <label class="form-label col-md-12">Desa/Kelurahan </label>
                      <div class="col-md-12">
                      <input value="<?php echo $row['desa_kelurahan']; ?>" class="form-control" type="text" name="desa_kelurahan"  >
                      </div> 
                      <label class="form-label col-md-12"> Kecamatan</label>
                      <div class="col-md-12">
                      <input value="<?php echo $row['kecamatan']; ?>" class="form-control" type="text" name="kecamatan"  >
                      </div>
                      <label class="form-label col-md-12">Kabupaten/Kota</label>
                      <div class="col-md-12">
                      <input value="<?php echo $row['kabupaten_kota']; ?>" class="form-control" type="text" name="kabupaten_kota"  >
                      </div>
                      <label class="form-label col-md-12">Provinsi</label>
                      <div class="col-md-12">
                      <input value="<?php echo $row['provinsi']; ?>" class="form-control" type="text" name="provinsi"  >
                      </div>
                      <label class="form-label col-md-12">Kode Pos</label>
                      <div class="col-md-12">
                      <input value="<?php echo $row['kode_pos']; ?>" class="form-control" type="text" name="kode_pos"  >
                      </div>
                      <label class="form-label col-md-12">Jumlah Anggota Keluarga</label>
                      <div class="col-md-12">
                      <input value="<?php echo $row['jml_anggota']; ?>" class="form-control" type="text" name="jml_anggota"  >
                      </div>
                      <label class="form-label col-md-12"> Tujuan</label>
                      <div class="col-md-12">
                      <input value="<?php echo $row['tujuan']; ?>" class="form-control" type="text" name="tujuan"  >
                      </div>
                      <label class="form-label col-md-12"> Tanggal Pembuatan</label>
                      <div class="col-md-12">
                      <input value="<?php echo $row['tgl_pembuatan']; ?>" class="form-control" type="date" name="tgl_pembuatan"  >
                      </div>
                      <form action="<?= site_url('Kk/updateStatus'); ?>" method="post">
                      <label class="form-label col-md-12">Status</label>
                      <div class="col-md-12">
                          <select class="form-control" name="status">
                              <option value="pending" <?php if ($row['status'] == 'pending') echo 'selected'; ?>>Pending</option>
                              <option value="disetujui" <?php if ($row['status'] == 'disetujui') echo 'selected'; ?>>Disetujui</option>
                              <option value="dibatalkan" <?php if ($row['status'] == 'dibatalkan') echo 'selected'; ?>>Dibatalkan</option>
                          </select>
                      </div>
                    </div>
                    <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="submitEditForm(<?php echo $row['id_kk']; ?>)">Save Changes</button>
            </div>
            <script>
              function submitEditForm(id_kk) {
                  var formData = $('#editForm-' + id_kk).serialize();

                  $.ajax({
                      url: '<?php echo base_url('kk/edit/'); ?>' + id_kk, // Perbaikan URL
                      type: 'POST',
                      data: formData,
                      dataType: 'json',
                      success: function(response) {
                          if (response.success) {
                              Swal.fire({
                                  title: 'Sukses',
                                  text: response.message,
                                  icon: 'success'
                              }).then(() => {
                                  window.location.href = '<?php echo base_url('datakk'); ?>';
                              });
                          } else {
                              Swal.fire({
                                  title: 'Gagal',
                                  text: response.message,
                                  icon: 'error'
                              });
                          }
                      },
                      error: function(xhr, status, error) {
                          console.error('Terjadi kesalahan:', error);
                          Swal.fire({
                              title: 'Error',
                              text: 'Terjadi kesalahan saat menghubungi server.',
                              icon: 'error'
                            }).then(() => {
                              window.location.href = '<?php echo base_url('datakk'); ?>';
                              $('#modal-edit-' + id_kk).modal('hide'); 
                          });
                      }
                  });
              }
            </script>
                    </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <?php endforeach; ?>
    </main>
    <!-- search -->
    <script>
      document.addEventListener("DOMContentLoaded", function () {
        const searchInput = document.getElementById("searchInput");
        const searchButton = document.getElementById("searchButton");
        const tableBody = document.getElementById("sampleTable"); 

        searchButton.addEventListener("click", function () {
          const searchText = searchInput.value.toLowerCase();
          const rows = tableBody.getElementsByTagName("tr");

          for (const row of rows) {
            const cells = row.getElementsByTagName("td");
            let rowMatchesSearch = false;

            for (const cell of cells) {
              const cellText = cell.textContent.toLowerCase();
              if (cellText.includes(searchText)) {
                rowMatchesSearch = true;
                break;
              }
            }

            row.style.display = rowMatchesSearch ? "" : "none";
          }
        });
      });
    </script>

    <!-- show entries-->
    <script>
   document.addEventListener("DOMContentLoaded", function() {
    const showEntriesSelect = document.getElementById("showEntriesSelect");
    const sampleTable = document.getElementById("sampleTable");

    showEntriesSelect.addEventListener("change", function() {
      const selectedValue = this.value;
      const rows = sampleTable.getElementsByTagName("tr");

      for (let i = 1; i < rows.length; i++) {
        rows[i].style.display = i <= selectedValue ? "table-row" : "none";
      }
    });

    // Panggil event change saat halaman pertama kali dimuat
    showEntriesSelect.dispatchEvent(new Event("change"));
  });
  </script>
  <?php include ('layout/footer.php'); ?>
  
  </body>
</html>