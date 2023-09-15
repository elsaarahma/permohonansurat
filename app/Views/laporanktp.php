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
          <h1>Laporan Surat Pengantar KTP</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><i class="bi bi-house-door fs-6"> </i></li>
          <li class="breadcrumb-item active"><a href="/laporanktp"> Laporan Surat Pengantar KTP</a></li>
        </ul>
      </div>
      
      <div class="row">
        <div class="col-md-18">
          <div class="tile">
            <div class="tile-body">  
              <div class="table-responsive">
                <h2> Laporan Pengantar KTP</h2>
                  <form action="<?php echo base_url('laporanktp'); ?>" method="post">
                    <input type="date" id="tanggal_awal" name="tanggal_awal" >
                    <input type="date" id="tanggal_akhir" name="tanggal_akhir" >
                    <button type="submit" class="bi bi-search"></button>
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
                  <form action="/dataktp/search" method="get"></form>
                  <div class="col-md-4 text-end">
                    <div class="input-group col-md-5">
                    <input type="text" class="form-control form-control-sm"  name="keyword" id="searchInput" placeholder="Search...">
                    <button class="btn btn-outline-secondary" id="searchButton">Search</button>
                    <div class="print-button-container">
                      <button onclick="window.print()" class="btn btn-outline-secondary shadow print-button">Print <i class="bi bi-printer"></i></button>
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
                   
                  </tr>
                </thead>
                <tbody>
                <?php $nomor = 1; 
                  foreach ($dataktp as $row): ?>
                    <tr>
                      <td><?php echo $nomor++; ?></td>
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
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
              </div>
              </div>
            </div> 
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