<!DOCTYPE html>
<html lang="en">
  <head>
   <?php include('layout/meta.php'); ?>
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/themes/admin/docs/css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
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
          <h1>Data Surat Keterangan Domisili</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><i class="bi bi-house-door fs-6"> </i></li>
          <li class="breadcrumb-item active"><a href="/datadomisili"> Data Surat Keterangan Domisili</a></li>
        </ul>
      </div>
      
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">  
              <div class="table-responsive">
                <h2 align="center">Data Surat Keterangan Domisili</h2>
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
                    <a href="/domisili" class="btn btn-primary"><i class="bi bi-plus-lg"></i>Tambah Data</a>
                  </div>
                  <form action="/datadomisili/search" method="get"></form>
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
                    <th scope="col"> Nama Pemohon</th>
                    <th scope="col"> Nik</th>
                    <th scope="col"> Alamat Lama</th>
                    <th scope="col"> Alamat Baru </th>
                    <th scope="col"> Tanggal Pindah</th>
                    <th scope="col"> Alasan Pindah</th>
                    <th scope="col"> Anggota Keluarga</th>
                    <th scope="col"> Tanggal Pembuatan</th>
                    <th scope="col"> Aksi</th>
                  </tr>
                </thead>
                <tbody>
             <?php $nomor = 1; 
                  foreach ($datadomisili as $row): ?>
                    <tr>
                      <td><?php echo $nomor++; ?></td>
                      <td><?php echo $row['id_kategori_surat']; ?></td>
                      <td><?php echo $row['nama_pemohon']; ?></td>
                      <td><?php echo $row['nik']; ?></td>
                      <td><?php echo $row['alamat_lama']; ?></td>
                      <td><?php echo $row['alamat_baru']; ?></td>
                      <td><?php echo $row['tanggal_pindah']; ?></td>
                      <td><?php echo $row['alasan_pindah']; ?></td>
                      <td><?php echo $row['jml_anggota']; ?></td>
                      <td><?php echo $row['tgl_pembuatan']; ?></td>
                      <td>
                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-edit-<?php echo $row['id_domisili']; ?>"><i class="bi bi-pen-fill"></i>Edit</button><br>
                        <button class="btn btn-danger btn-sm" onclick="deleteData(<?php echo $row['id_domisili']; ?>)">
                        <i class="bi bi-trash"></i> Hapus</button>
                      <script>
                        function deleteData(id_domisili) {
                            Swal.fire({
                                title: 'Konfirmasi',
                                text: 'Apakah Anda yakin ingin menghapus data ini?',
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonText: 'Hapus',
                                cancelButtonText: 'Batal',
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    fetch(`/domisili/delete/${id_domisili}`, { // Ganti dengan URL yang sesuai
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
            <?php foreach ($datadomisili as $row): ?>
            <div class="modal fade" id="modal-edit-<?php echo $row['id_domisili']; ?>" tabindex="-1" role="dialog" aria-labelledby="modal-editLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="modal-editLabel">Edit Pengantar KTP</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form id="editForm-<?php echo $row['id_domisili']; ?>"  class="form-horizontal">
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
                      <label class="form-label col-md-12">Nama Pemohon</label>
                      <div class="col-md-12">
                      <input value="<?php echo $row['nama_pemohon']; ?>" class="form-control" type="text" name="nama_pemohon" >
                      </div>
                      <label class="form-label col-md-12">NIK</label>
                      <div class="col-md-12">
                      <input value="<?php echo $row['nik']; ?>" class="form-control" type="text" name="nik"  >
                      </div>
                      <label class="form-label col-md-12">Alamat Lama</label>
                      <div class="col-md-12">
                      <input value="<?php echo $row['alamat_lama']; ?>" class="form-control"  name="alamat_lama"  >
                      </div>
                      <label class="form-label col-md-12">Alamat Baru </label>
                      <div class="col-md-12">
                      <input value="<?php echo $row['alamat_baru']; ?>" class="form-control" type="text" name="alamat_baru"  >
                      </div> 
                      <label class="form-label col-md-12"> Tanggal Pindah</label>
                      <div class="col-md-12">
                      <input value="<?php echo $row['tanggal_pindah']; ?>" class="form-control" type="date" name="tanggal_pindah"  >
                      </div>
                      <label class="form-label col-md-12">Alasan Pindah</label>
                      <div class="col-md-12">
                      <input value="<?php echo $row['alasan_pindah']; ?>" class="form-control" type="text" name="alasan_pindah"  >
                      </div>
                      <label class="form-label col-md-12">Anggota Keluarga</label>
                      <div class="col-md-12">
                      <input value="<?php echo $row['jml_anggota']; ?>" class="form-control" type="text" name="jml_anggota"  >
                      </div>
                      <label class="form-label col-md-12"> Tanggal Pembuatan</label>
                      <div class="col-md-12">
                      <input value="<?php echo $row['tgl_pembuatan']; ?>" class="form-control" type="date" name="tgl_pembuatan"  >
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary" onclick="submitEditForm(<?php echo $row['id_domisili']; ?>)">Save Changes</button>
            </div>
            <script>
              function submitEditForm(id_domisili) {
                  var formData = $('#editForm-' + id_domisili).serialize();

                  $.ajax({
                      url: '<?php echo base_url('domisili/edit/'); ?>' + id_domisili, // Perbaikan URL
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
                                  window.location.href = '<?php echo base_url('datadomisili'); ?>';
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
                              window.location.href = '<?php echo base_url('datadomisili'); ?>';
                              $('#modal-edit-' + id_domisili).modal('hide'); 
                          });
                      }
                  });
              }
            </script>
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

  <?php include('layout/footer.php')?>
  </body>
</html>