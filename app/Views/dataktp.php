<!DOCTYPE html>
<html lang="en">
  <head>
  <?php echo $this->include('layout/meta.php'); ?>
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
   <body class="app sidebar-mini">
    <?php echo $this->include('layout/header.php'); ?>
    <?php echo $this->include('layout/sidebar.php'); ?>
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1>Data Surat Pengantar KTP</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><i class="bi bi-house-door fs-6"> </i></li>
          <li class="breadcrumb-item active"><a href="/dataktp"> Data Surat Pengantar KTP</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">  
              <div class="table-responsive">
                <h2 align="center"> Data Pengantar KTP</h2><br>
                <!-- search dan show entries-->
                <div id="sampleTable_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                  <div class="row">
                    <div class="col-sm-12 col-md-6">
                      <div class="dataTables_length" id="showEntries">
                        <label for="showEntriesSelect">Show <select name="sampleTable_length" aria-controls="sampleTable" class="form-select form-select-sm" id="showEntriesSelect">
                          <option value="5">5</option>
                          <option value="10">10</option>
                          <option value="50">50</option>
                          <option value="100">100</option>
                        </select> entries</label>
                        <a href="/ktp" class="btn btn-primary btn-sm"><i class="bi bi-plus-lg"></i>Tambah Data</a>
                      </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                      <div id="sampleTable_filter" class="dataTables_filter">
                      <label>Search:<input type="text" class="form-control form-control-sm" id="searchInput" placeholder="" aria-controls="sampleTable"></label>
                      </div>
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
                    <th scope="col"> NIK</th>
                    <th scope="col"> Nama Lengkap</th>
                    <th scope="col"> Tempat Lahir</th>
                    <th scope="col"> Tanggal Lahir</th>
                    <th scope="col"> Jenis Kelamin</th>
                    <th scope="col"> Alamat</th>
                    <th scope="col"> Agama</th>
                    <th scope="col"> Status Perkawinan</th>
                    <th scope="col"> Pekerjaan</th>
                    <th scope="col"> Kewarganegaraan</th>
                    <th scope="col"> Masa Berlaku</th>
                    <th scope="col"> Golongan Darah</th>
                    <th scope="col"> Tanggal Pembuatan</th>
                    <th scope="col"> Status</th>
                    <th scope="col"> Aksi</th>
                  </tr>
                </thead>
                <tbody>
                <?php $nomor = 1; 
                  foreach ($dataktp as $row): ?>
                    <tr>
                      <td><?php echo $nomor++; ?></td>
                      <td><?php echo $row['id_kategori_surat']; ?></td>
                      <td><?php echo $row['nik']; ?></td>
                      <td><?php echo $row['nama_lengkap']; ?></td>
                      <td><?php echo $row['tempat_lahir']; ?></td>
                      <td><?php echo $row['tanggal_lahir']; ?></td>
                      <td><?php echo $row['jenis_kelamin']; ?></td>
                      <td><?php echo $row['alamat']; ?></td>
                      <td><?php echo $row['agama']; ?></td>
                      <td><?php echo $row['status_perkawinan']; ?></td>
                      <td><?php echo $row['pekerjaan']; ?></td>
                      <td><?php echo $row['kewarganegaraan']; ?></td>
                      <td><?php echo $row['berlaku']; ?></td>
                      <td><?php echo $row['gol_darah']; ?></td>
                      <td><?php echo $row['tgl_pembuatan']; ?></td>
                      <td><?php echo $row['status']; ?></td>
                      <td>
                      <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-edit-<?php echo $row['id_ktp']; ?>"><i class="bi bi-pen-fill"></i>Edit</button> <br>
                      <button class="btn btn-danger btn-sm" onclick="deleteData(<?php echo $row['id_ktp']; ?>)">
                        <i class="bi bi-trash"></i> Hapus</button>
                          <script>
                            function deleteData(id_ktp) {
                                Swal.fire({
                                    title: 'Konfirmasi',
                                    text: 'Apakah Anda yakin ingin menghapus data ini?',
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonText: 'Hapus',
                                    cancelButtonText: 'Batal',
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        fetch(`/ktp/delete/${id_ktp}`, { // Ganti dengan URL yang sesuai
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
              <div class="row">
                <div class="col-sm-12 col-md-5">
                  <div class="dataTables_info" id="sampleTable_info" role="status" aria-live="polite">Showing 1 to 5 of 57 entries</div>
                </div>
                <div class="col-sm-12 col-md-7">
                  <div class="dataTables_paginate paging_simple_numbers" id="sampleTable_paginate">
                    <ul class="pagination">
                      <li class="paginate_button page-item previous disabled" id="sampleTable_previous">
                        <a aria-controls="sampleTable" aria-disabled="true" aria-role="link" data-dt-idx="previous" tabindex="0" class="page-link">Previous</a>
                      </li>
                      <li class="paginate_button page-item active">
                        <a href="#" aria-controls="sampleTable" aria-role="link" aria-current="page" data-dt-idx="0" tabindex="0" class="page-link">1</a>
                      </li>
                      <li class="paginate_button page-item ">
                        <a href="#" aria-controls="sampleTable" aria-role="link" data-dt-idx="1" tabindex="0" class="page-link">2</a>
                      </li>
                      <li class="paginate_button page-item ">
                        <a href="#" aria-controls="sampleTable" aria-role="link" data-dt-idx="2" tabindex="0" class="page-link">3</a>
                      </li>
                      <li class="paginate_button page-item ">
                        <a href="#" aria-controls="sampleTable" aria-role="link" data-dt-idx="3" tabindex="0" class="page-link">4</a>
                      </li>
                      <li class="paginate_button page-item ">
                        <a href="#" aria-controls="sampleTable" aria-role="link" data-dt-idx="4" tabindex="0" class="page-link">5</a>
                      </li>
                      <li class="paginate_button page-item ">
                        <a href="#" aria-controls="sampleTable" aria-role="link" data-dt-idx="5" tabindex="0" class="page-link">6</a>
                      </li>
                      <li class="paginate_button page-item next" id="sampleTable_next"><a href="#" aria-controls="sampleTable" aria-role="link" data-dt-idx="next" tabindex="0" class="page-link">Next</a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            </div>
          </div>
        </div>
            <!-- Modal Edit Data Surat -->
            <?php foreach ($dataktp as $row): ?>
              <div class="modal fade" id="modal-edit-<?php echo $row['id_ktp']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="modal-editLabel">Edit Pengantar KTP</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form id="editForm-<?php echo $row['id_ktp']; ?>"  class="form-horizontal">
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
                      <label class="form-label col-md-12">NIK</label>
                      <div class="col-md-12">
                      <input value="<?php echo $row['nik']; ?>" class="form-control" type="text" name="nik" >
                      </div>
                      <label class="form-label col-md-12">Nama Lengkap</label>
                      <div class="col-md-12">
                      <input value="<?php echo $row['nama_lengkap']; ?>" class="form-control" type="text" name="nama_lengkap"  >
                      </div>
                      <label class="form-label col-md-12">Tempat Lahir</label>
                      <div class="col-md-12">
                      <input value="<?php echo $row['tempat_lahir']; ?>" class="form-control" type="text" name="tempat_lahir"  >
                      </div> 
                      <label class="form-label col-md-12">Tanggal Lahir</label>
                      <div class="col-md-12">
                      <input value="<?php echo $row['tanggal_lahir']; ?>" class="form-control" type="date" name="tanggal_lahir"  >
                      </div>
                      <label class="form-label col-md-12">Jenis Kelamin</label>
                      <div class="col-md-12">
                      <input value="<?php echo $row['jenis_kelamin']; ?>" class="form-control" type="text" name="jenis_kelamin"  >
                      </div>
                      <label class="form-label col-md-12">Alamat</label>
                      <div class="col-md-12">
                      <input value="<?php echo $row['alamat']; ?>" class="form-control" type="text" name="alamat"  >
                      </div>
                      <label class="form-label col-md-12">Agama</label>
                      <div class="col-md-12">
                      <input value="<?php echo $row['agama']; ?>" class="form-control" type="text" name="agama"  >
                      </div>
                      <label class="form-label col-md-12">Status Perkawinan</label>
                      <div class="col-md-12">
                      <input value="<?php echo $row['status_perkawinan']; ?>" class="form-control" type="text" name="status_perkawinan"  >
                      </div>
                      <label class="form-label col-md-12"> Pekerjaan</label>
                      <div class="col-md-12">
                      <input value="<?php echo $row['pekerjaan']; ?>" class="form-control" type="text" name="pekerjaan"  >
                      </div>
                      <label class="form-label col-md-12">Kewarganegaraan</label>
                      <div class="col-md-12">
                      <input value="<?php echo $row['kewarganegaraan']; ?>" class="form-control" type="text" name="kewarganegaraan"  >
                      </div>
                      <label class="form-label col-md-12">Golongan Darah</label>
                      <div class="col-md-12">
                      <input value="<?php echo $row['gol_darah']; ?>" class="form-control" type="text" name="gol_darah"  >
                      </div>
                      <label class="form-label col-md-12"> Tanggal Pembuatan</label>
                      <div class="col-md-12">
                      <input value="<?php echo $row['tgl_pembuatan']; ?>" class="form-control" type="date" name="tgl_pembuatan"  >
                      </div>
                      <form action="<?= site_url('Ktp/updateStatus'); ?>" method="post">
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
                      <button type="button" class="btn btn-primary" onclick="submitEditForm(<?php echo $row['id_ktp']; ?>)">Save Changes</button>
                    </div>
                      <script>
                          function submitEditForm(id_ktp) {
                              var formData = $('#editForm-' + id_ktp).serialize();

                              $.ajax({
                                  url: '<?php echo base_url('ktp/edit/'); ?>' + id_ktp, // Perbaikan URL
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
                                              window.location.href = '<?php echo base_url('dataktp'); ?>';
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
                                          window.location.href = '<?php echo base_url('dataktp'); ?>';
                                          $('#modal-edit-' + id_ktp).modal('hide'); 
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
            const tableBody = document.getElementById("sampleTable"); // Ganti "sampleTable" dengan id dari tabel Anda

            searchInput.addEventListener("input", function () {
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
    <!--PAGINATION-->
    <script>
      document.addEventListener("DOMContentLoaded", function () {
  const table = document.getElementById("sampleTable");
  const rows = table.getElementsByTagName("tr");
  const perPage = 5; // Ubah jumlah data yang ingin ditampilkan per halaman menjadi 5
  let currentPage = 1;

  function showPage(page) {
    for (let i = 1; i < rows.length; i++) {
      rows[i].style.display = "none";
    }
    const startIndex = (page - 1) * perPage + 1;
    const endIndex = Math.min(startIndex + perPage - 1, rows.length - 1);

    for (let i = startIndex; i <= endIndex; i++) {
      rows[i].style.display = "table-row";
    }
  }

  function updatePaginationInfo() {
    const info = document.getElementById("sampleTable_info");
    const totalEntries = rows.length - 1; // Total jumlah data dikurangi 1 untuk mengabaikan baris header.
    const firstEntry = (currentPage - 1) * perPage + 1;
    const lastEntry = Math.min(currentPage * perPage, totalEntries);

    info.textContent = `Showing ${firstEntry} to ${lastEntry} of ${totalEntries} entries`;
  }

  function handlePaginationClick(event) {
    const target = event.target;
    if (target.tagName === "A" && !target.parentElement.classList.contains("disabled")) {
      if (target.getAttribute("data-dt-idx") === "previous") {
        if (currentPage > 1) {
          currentPage--;
          showPage(currentPage);
          updatePaginationInfo();
        }
      } else if (target.getAttribute("data-dt-idx") === "next") {
        if (currentPage < Math.ceil((totalEntries - 1) / perPage)) {
          currentPage++;
          showPage(currentPage);
          updatePaginationInfo();
        }
      }
    }
  }

  // Tambahkan event listener untuk pagination
  const pagination = document.getElementById("sampleTable_paginate");
  pagination.addEventListener("click", handlePaginationClick);

  // Tampilkan halaman pertama saat halaman dimuat
  showPage(currentPage);
  updatePaginationInfo();
});

    </script>
    <?php echo $this->include('layout/footer.php'); ?>
  </body>
</html>