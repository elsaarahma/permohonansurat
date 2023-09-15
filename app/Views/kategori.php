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
          <h1>Data Kategori Surat</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><i class="bi bi-house-door fs-6"> </i></li>
          <li class="breadcrumb-item active"><a href="/kategori">Kategori Surat</a></li>
        </ul>
      </div>
      
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">  
              <div class="table-responsive">
                <h2>Kategori Surat</h2>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"><i class="bi bi-plus-lg"></i>Tambah Data</button>
                <!-- Modal Tambah Kategori Surat-->
                  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Tambah Kategori Surat</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>                        
                          <div class="modal-body">
                          <form class="form-horizontal" method="POST" name="kategori" action="kategori/Kategori/addData">
                            <label class="form-label col-md-12">Kategori Surat</label>
                            <div class="col-md-12">
                              <input class="form-control" type="text" id="kategori_surat" name="kategori_surat" placeholder="Kategori Surat">
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button class="btn btn-primary" onclick="addData()"><i class="bi bi-check-circle-fill me-2"></i>Save Change</button>
                              <script>
                      <?php if (session()->getFlashdata('success')) : ?>
                          Swal.fire({
                              title: 'Sukses',
                              text: '<?= session()->getFlashdata('success') ?>',
                              icon: 'success'
                          }).then(() => {
                              window.location.href = '<?= base_url('kategori'); ?>';
                          });
                      <?php elseif (session()->getFlashdata('error')) : ?>
                          Swal.fire({
                              title: 'Gagal',
                              text: '<?= session()->getFlashdata('error') ?>',
                              icon: 'error'
                          }).then(() => {
                              window.location.href = '<?= base_url('kategori'); ?>';
                          });
                      <?php endif; ?>
                </script>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                 </form>
                 <!-- search dan show entries-->
                 <div class="d-flex justify-content-between mb-3">
                  <div class="dataTables_length" id="showEntries">
                    <label for="showEntriesSelect" class="form-label"> Show Entries
                      <select class="form-select form-select-sm" id="showEntriesSelect">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                      </select>
                    </label>
                  </div>
                  <form action="/kategori/search" method="get"></form>
                  <div class="col-md-3 text-end">
                    <div class="input-group col-md-5">
                    <input type="text" class="form-control form-control-sm"  name="keyword" id="searchInput" placeholder="Search...">
                    <button class="btn btn-outline-secondary" id="searchButton">Search</button>
                  </div>
                </div>
                </form>
                </div>
                 </div>
                </div>
                <!--tampilan tabel kategori-->
              <div class="table-responsive"></div>
              <table class="table table-hover table-bordered" id="sampleTable">
                <thead>
                  <tr>
                    <th width="80px">No</th>
                    <th>Nama Kategori</th>
                    <th width="250px">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $nomor = 1; 
                  foreach ($kategori as $row): ?>
                    <tr>
                      <td><?php echo $nomor++; ?></td>
                      <td><?php echo $row['kategori_surat']; ?></td>
                      <td>
                        <button class="btn btn-warning btn" data-toggle="modal" data-target="#modal-edit-<?php echo $row['id_kategori_surat']; ?>"><i class="bi bi-pen-fill"></i>Edit</button>
                        <button class="btn btn-danger btn-sm" onclick="deleteData(<?php echo $row['id_kategori_surat']; ?>)">
                        <i class="bi bi-trash"></i> Hapus</button>
                      <script>
                        function deleteData(id_kategori_surat) {
                            Swal.fire({
                                title: 'Konfirmasi',
                                text: 'Apakah Anda yakin ingin menghapus data ini?',
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonText: 'Hapus',
                                cancelButtonText: 'Batal',
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    fetch(`/kategori/delete/${id_kategori_surat}`, { // Ganti dengan URL yang sesuai
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
            <!-- Modal Edit Kategori Surat -->
            <?php foreach ($kategori as $row): ?>
            <div class="modal fade" id="modal-edit-<?php echo $row['id_kategori_surat']; ?>" tabindex="-1" role="dialog" aria-labelledby="modal-editLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="modal-editLabel">Edit Kategori Surat</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form method="POST" action="<?php echo base_url('/kategori/Kategori/edit') ?>" class="form-horizontal">
                    <div class="modal-body">
                      <input type="hidden" value="<?php echo $row['id_kategori_surat']; ?>" name="id_kategori_surat">
                      <label class="form-label col-md-12">Kategori Surat</label>
                      <div class="col-md-12">
                      <input value="<?php echo $row['kategori_surat']; ?>" class="form-control" type="text" name="kategori_surat" placeholder="Kategori Surat">
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Save Change</button>
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
        const tableBody = document.getElementById("sampleTable"); // Ganti "tableBody" dengan id body tabel Anda

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

   <?php include ('layout/footer.php')?>
  </body>
</html>