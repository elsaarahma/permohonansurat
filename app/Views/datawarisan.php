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
          <h1>Data Surat Keterangan Ahli Waris</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><i class="bi bi-house-door fs-6"> </i></li>
          <li class="breadcrumb-item active"><a href="/datawarisan">  Data Surat Keterangan Ahli Waris</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">  
              <div class="table-responsive">
                <h2 align="center">Data Surat Keterangan Ahli Waris</h2>
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
                    <a href="/ahliwaris" class="btn btn-primary"><i class="bi bi-plus-lg"></i>Tambah Data</a>
                  </div>
                  <form action="/datawarisan/search" method="get"></form>
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
                    <th scope="col"> Nama Lengkap</th>
                    <th scope="col"> Hubungan Keluarga</th>
                    <th scope="col"> Tempat Lahir</th>
                    <th scope="col"> Tanggal lahir</th>
                    <th scope="col"> Alamat</th>
                    <th scope="col"> Kewarganegaraan</th>
                    <th scope="col"> No KTP</th>
                    <th scope="col"> Nama Almarhum</th>
                    <th scope="col"> Tanggal Pembuatan</th>
                    <th scope="col"> Aksi</th>
                  </tr>
                </thead>
                <tbody>
             <?php $nomor = 1; 
                  foreach ($datawarisan as $row): ?>
                    <tr>
                      <td><?php echo $nomor++; ?></td>
                      <td><?php echo $row['id_kategori_surat']; ?></td>
                      <td><?php echo $row['nama_lengkap']; ?></td>
                      <td><?php echo $row['hubungan_keluarga']; ?></td>
                      <td><?php echo $row['tempat_lahir']; ?></td>
                      <td><?php echo $row['tanggal_lahir']; ?></td>
                      <td><?php echo $row['alamat']; ?></td>
                      <td><?php echo $row['kewarganegaraan']; ?></td>
                      <td><?php echo $row['no_ktp']; ?></td>
                      <td><?php echo $row['nama_almarhum']; ?></td>
                      <td><?php echo $row['tgl_pembuatan']; ?></td>
                      <td>
                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-edit-<?php echo $row['id_waris']; ?>"><i class="bi bi-pen-fill"></i>Edit</button> <br>
                        <button class="btn btn-danger btn-sm" onclick="deleteData(<?php echo $row['id_waris']; ?>)">
                        <i class="bi bi-trash"></i> Hapus</button>
                      <script>
                        function deleteData(id_waris) {
                            Swal.fire({
                                title: 'Konfirmasi',
                                text: 'Apakah Anda yakin ingin menghapus data ini?',
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonText: 'Hapus',
                                cancelButtonText: 'Batal',
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    fetch(`/ahliwaris/delete/${id_waris}`, { // Ganti dengan URL yang sesuai
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
             <!-- Modal Edit Data Surat -->
            <?php foreach ($datawarisan as $row): ?>
              <div class="modal fade" id="modal-edit-<?php echo $row['id_waris']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="modal-editLabel">Edit Pengantar Ahli Waris</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form id="editForm-<?php echo $row['id_waris']; ?>"  class="form-horizontal">
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
                      <label class="form-label col-md-12">Nama Lengkap</label>
                      <div class="col-md-12">
                      <input value="<?php echo $row['nama_lengkap']; ?>" class="form-control" type="text" name="nama_lengkap" >
                      </div>
                      <label class="form-label col-md-12">Hubungan Keluarga</label>
                      <div class="col-md-12">
                      <input value="<?php echo $row['hubungan_keluarga']; ?>" class="form-control" type="text" name="hubungan_keluarga"  >
                      </div>
                      <label class="form-label col-md-12">Tempat Lahir</label>
                      <div class="col-md-12">
                      <input value="<?php echo $row['tempat_lahir']; ?>" class="form-control"  name="tempat_lahir"  >
                      </div>
                      <label class="form-label col-md-12">Tanggal Lahir </label>
                      <div class="col-md-12">
                      <input value="<?php echo $row['tanggal_lahir']; ?>" class="form-control" type="date" name="tanggal_lahir"  >
                      </div> 
                      <label class="form-label col-md-12"> Alamat</label>
                      <div class="col-md-12">
                      <input value="<?php echo $row['alamat']; ?>" class="form-control" type="text" name="alamat"  >
                      </div>
                      <label class="form-label col-md-12">Kewarganegaraan</label>
                      <div class="col-md-12">
                      <input value="<?php echo $row['kewarganegaraan']; ?>" class="form-control" type="text" name="kewarganegaraan"  >
                      </div>
                      <label class="form-label col-md-12">No KTP</label>
                      <div class="col-md-12">
                      <input value="<?php echo $row['no_ktp']; ?>" class="form-control" type="number" name="no_ktp"  >
                      </div>
                      <label class="form-label col-md-12">Nama Almarhum</label>
                      <div class="col-md-12">
                      <input value="<?php echo $row['nama_almarhum']; ?>" class="form-control" type="text" name="nama_almarhum"  >
                      </div>
                      <label class="form-label col-md-12"> Tanggal Pembuatan</label>
                      <div class="col-md-12">
                      <input value="<?php echo $row['tgl_pembuatan']; ?>" class="form-control" type="date" name="tgl_pembuatan"  >
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary" onclick="submitEditForm(<?php echo $row['id_waris']; ?>)">Save Changes</button>
                        <script>
                          function submitEditForm(id_waris) {
                              var formData = $('#editForm-' + id_waris).serialize();

                              $.ajax({
                                  url: '<?php echo base_url('ahliwaris/edit/'); ?>' + id_waris, // Perbaikan URL
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
                                              window.location.href = '<?php echo base_url('datawarisan'); ?>';
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
                                          window.location.href = '<?php echo base_url('datawarisan'); ?>';
                                          $('#modal-edit-' + id_waris).modal('hide'); 
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

   <?php include ('layout/footer.php')?>
  </body>
</html>