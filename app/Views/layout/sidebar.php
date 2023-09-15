<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
  <div class="app-sidebar__user">
    <img class="app-sidebar__user-avatar" src="" alt="Image">
    <div>
      <p class="app-sidebar__user-name"><?php echo session()->get('username');?></p>
      <p class="app-sidebar__user-designation"></p>
    </div>
  </div> 
  <ul class="app-menu"> 
    <li><a class="app-menu__item  <?php echo $menu['menu_active']=="Dashboard"?"is-expanded":"";?>" href="/dashboard" i class="app-menu__icon bi bi-speedometer"></i><span class="app-menu__label">Dashboard</span></a></li>
    <li class="treeview <?php echo $menu['menu_active']=="Permohonan Surat"?"is-expanded":"";?>">
      <a class="app-menu__item" href="#" data-toggle="treeview">
        <i class="app-menu__icon bi bi-envelope-paper-fill"></i>
        <span class="app-menu__label">Permohonan Surat</span>
        <i class="treeview-indicator bi bi-chevron-right"></i>
      </a>
      <ul class="treeview-menu">
      <li class="treeview open"><a class="treeview-item <?php echo $menu['sub_menu_active']=="Rekapan"?"active":"";?>" href="/rekapan"><i class="icon bi bi-circle-fill"></i>Rekap Permohonan Surat</a></li></li>
      <li class="treeview open"><a class="treeview-item <?php echo $menu['sub_menu_active']=="Laporan KTP"?"active":"";?>" href="/laporanktp"><i class="icon bi bi-circle-fill"></i>Laporan Pengantar KTP </a></li></li>
      <li class="treeview open"><a class="treeview-item" href="/laporankk"><i class="icon bi bi-circle-fill"></i>Laporan Pengantar KK </a></li></li>
      <li class="treeview open"><a class="treeview-item" href="/laporanwarisan"><i class="icon bi bi-circle-fill"></i>Laporan Keterangan Ahli Waris </a></li></li>
      <li class="treeview open"><a class="treeview-item" href="/laporantanah"><i class="icon bi bi-circle-fill"></i>Laporan Keterangan Tanah </a></li></li>
      <li class="treeview open"><a class="treeview-item" href="/laporanpindah"><i class="icon bi bi-circle-fill"></i>Laporan Pengantar Pindah Keluar </a></li></li>
      <li class="treeview open"><a class="treeview-item" href="/laporandomisili"><i class="icon bi bi-circle-fill"></i>Laporan Keterangan Domisili </a></li></li>
      </ul>
    </li>
    <li class="treeview <?php //echo ($menu_active=="kategori"?"menu-open":"");?>" href="/kategori">
      <a class="app-menu__item  <?php //echo ($menu_active=="kategori"?"active":"");?>"  href="#" data-toggle="treeview">
        <i class="app-menu__icon bi bi-tags-fill"></i>
        <span class="app-menu__label">Kategori Surat</span>
        <i class="treeview-indicator bi bi-chevron-right"></i>
      </a>
      <ul class="treeview-menu">
        <li><a class="treeview-item" href="/kategori"><i class="icon bi bi-circle-fill"></i> Data Kategori Surat</a></li>
        <li><a class="treeview-item" href="/dataktp"><i class="icon bi bi-circle-fill"></i>Data Pengantar KTP </a></li>
        <li><a class="treeview-item" href="/datakk"><i class="icon bi bi-circle-fill"></i> Data Pengantar KK </a></li>
        <li><a class="treeview-item" href="/datawarisan"><i class="icon bi bi-circle-fill"></i> Data Keterangan Ahli Waris </a></li>
        <li><a class="treeview-item" href="/datatanah"><i class="icon bi bi-circle-fill"></i> Data Keterangan Tanah </a></li>
        <li><a class="treeview-item" href="/datapindah"><i class="icon bi bi-circle-fill"></i> Data Pengantar Pindah Keluar</a></li>
        <li><a class="treeview-item" href="/datadomisili"><i class="icon bi bi-circle-fill"></i> Data Keterangan Domisili </a></li>
      </ul>
    </li>
    <li class="treeview">
      <a class="app-menu__item" href="#" data-toggle="treeview">
        <i class="app-menu__icon bi bi-table"></i>
        <span class="app-menu__label">Admin</span>
        <i class="treeview-indicator bi bi-chevron-right"></i>
      </a>
      <ul class="treeview-menu">
        <li><a class="treeview-item" href="table-basic.html"><i class="icon bi bi-circle-fill"></i> Basic Tables</a></li>
        <li><a class="treeview-item" href="table-data-table.html"><i class="icon bi bi-circle-fill"></i> Data Tables</a></li>
      </ul>
    </li>
  </ul>
</aside>
 <!-- Essential javascripts for application to work-->
   <script src="<?php echo base_url();?>assets/themes/admin/docs/js/jquery-3.7.0.min.js"></script>
    <script src="<?php echo base_url();?>assets/themes/admin/docs/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>assets/themes/admin/docs/js/main.js"></script>
    <!-- Page specific javascripts-->
    <script>
      // Enable all alerts on the page
      const alertList = document.querySelectorAll('.alert');
      const alerts = [...alertList].map(element => new bootstrap.Alert(element));
      
      // Enable all popovers on the page
      const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]');
      const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl));
      
      // Enable all tooltips on the page
      const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
      const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
    </script>
    <!-- Google analytics script-->
    <script type="text/javascript">
      if(document.location.hostname == 'pratikborsadiya.in') {
      	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      	m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
      	ga('create', 'UA-72504830-1', 'auto');
      	ga('send', 'pageview');
      }
    </script>
