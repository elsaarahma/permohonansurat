<!-- Tautkan file jQuery -->
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="<?php echo base_url();?> assets/themes/admin/docs/js/jquery-3.7.0.min.js"></script>
	<script src="<?php echo base_url();?> assets/themes/admin/docs/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url();?> assets/themes/admin/docs/jsjs/main.js"></script>
    <!-- Tautkan file JavaScript Bootstrap -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <!-- Page specific javascripts-->
    <link rel="stylesheet" href="https://cdn.datatables.net/v/bs5/dt-1.13.4/datatables.min.css">
    <!-- Data table plugin-->
	<script type="text/javascript" src="<?php echo base_url();?> assets/themes/admin/docs/js/plugins/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?> assets/themes/admin/docs/js/bootstrap.min.js"></script>
	<script type="text/javascript">$('#sampleTable').DataTable();</script>
    <script src="<?php echo base_url();?>assets/themes/sweetalert/dist/sweetalert2.all.min.js"></script>
    <!-- Page specific javascripts-->
    <script type="text/javascript" src="<?php echo base_url();?> assets/themes/admin/docs/js/plugins/chart.js"></script>
    <script type="text/javascript">
      const salesData = {
      	type: "line",
      	data: {
      		labels: [
      			"Jan",
      			"Feb",
      			"March",
      			"April",
      			"May",
      			"June",
      		],
      		datasets: [{
      			label: 'Monthly Sales',
      			data: [65, 59, 80, 81, 56, 55, 40],
      			fill: false,
      			borderColor: 'rgb(75, 192, 192)',
      			tension: 0.1
      		}]
      	}
      }
      
      const supportRequests = {
      	type: "doughnut",
      	data: {
      		labels: [
      			'In-Progress',
      			'Complete',
      			'Delayed'
      		],
      		datasets: [{
      			label: 'Support Requests',
      			data: [300, 50, 100],
      			backgroundColor: [
      				'#EFCC00',
      				'#5AD3D1',
      				'#FF5A5E'
      			],
      			hoverOffset: 4
      		}]
      	}
      };
      
      const salesChartCtx = document.getElementById('salesChart');
      new Chart(salesChartCtx, salesData);
      
      const supportChartCtx = document.getElementById('supportRequestChart');
      new Chart(supportChartCtx, supportRequests);
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
