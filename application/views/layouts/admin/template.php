<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?=$title;?></title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.7 -->
	<link rel="stylesheet" href="<?=base_url();?>vendor/bootstrap/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?=base_url();?>vendor/font-awesome/css/font-awesome.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="<?=base_url();?>vendor/Ionicons/css/ionicons.min.css">
	<!-- Datatables -->
	<link rel="stylesheet" href="<?=base_url();?>vendor/datatables.net-bs/css/dataTables.bootstrap.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?=base_url();?>assets/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
  	folder instead of downloading all of them to reduce the load. -->
  	<link rel="stylesheet" href="<?=base_url();?>assets/css/skins/_all-skins.min.css">

  	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
	<link rel="stylesheet" href="<?=base_url();?>vendor/bootstrap-datepicker/css/bootstrap-datepicker.min.css">

<!-- Google Font -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
	<!-- Site wrapper -->
	<div class="wrapper">

		<!-- =============================================== -->
		<?php $this->load->view('layouts/admin/header'); ?>
		<!-- =============================================== -->

		<!-- =============================================== -->
		<?php $this->load->view('layouts/admin/sidebar'); ?>
		<!-- =============================================== -->

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">

			<!-- START CONTENT -->
			<?php $this->load->view('admin/'.$content); ?>
			<!-- END CONTENT -->

		</div>
		<!-- /.content-wrapper -->

		<footer class="main-footer">
			<div class="pull-right hidden-xs">
				<b>Version</b> 1.0.0
			</div>
			<strong>Copyright &copy; 2020 <?=NAMA_PERUSAHAAN;?>.</strong>
		</footer>

	</div>
	<!-- ./wrapper -->

	<!-- jQuery 3 -->
	<script src="<?=base_url();?>vendor/jquery/jquery.min.js"></script>
	<!-- Bootstrap 3.3.7 -->
	<script src="<?=base_url();?>vendor/bootstrap/js/bootstrap.min.js"></script>
	<!-- SlimScroll -->
	<script src="<?=base_url();?>vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	<!-- FastClick -->
	<script src="<?=base_url();?>vendor/fastclick/fastclick.js"></script>
	<script src="<?=base_url();?>vendor/jquery-validation/jquery.validate.min.js"></script>
	<script src="<?=base_url();?>vendor/jquery-validation/additional-methods.min.js"></script>
	<script src="<?=base_url();?>vendor/jquery-blockui/jquery.blockUI.js"></script>
	<script src="<?=base_url();?>vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
	<script src="<?=base_url();?>vendor/bootstrap-datepicker/locales/bootstrap-datepicker.id.min.js"></script>
	<script src="<?=base_url();?>vendor/datatables.net/js/jquery.dataTables.min.js"></script>
	<script src="<?=base_url();?>vendor/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
	<script src="<?=base_url();?>assets/js/adminlte.min.js"></script>
	<script>$('.sidebar-menu').tree();</script>

</body>
</html>

<!-- START VITAMIN -->
<?php $this->load->view('admin/'.$vitamin); ?>
<!-- END VITAMIN -->