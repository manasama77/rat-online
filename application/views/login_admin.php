<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Log In Admin | RAT Online</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.7 -->
	<link rel="stylesheet" href="<?= base_url(); ?>vendor/bootstrap/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?= base_url(); ?>vendor/font-awesome/css/font-awesome.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="<?= base_url(); ?>vendor/Ionicons/css/ionicons.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?= base_url(); ?>assets/css/AdminLTE.min.css">
	<!-- iCheck -->
	<link rel="stylesheet" href="<?= base_url(); ?>vendor/iCheck/square/blue.css">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!-- [if lt IE 9]> -->
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<!-- <![endif] -->

	<!-- Google Font -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition login-page">
	<div class="login-box">
		<div class="login-logo">
			<!-- <a href="../../index2.html"><b>Pekgo</b>Apparel</a> -->
			<img src="<?= base_url('assets/img/logomum.jpg'); ?>" style="max-width: 120px;">
		</div>
		<!-- /.login-logo -->
		<div class="login-box-body">
			<p class="login-box-msg">KSPPS Mitra Usaha Mandiri - Admin Login</p>

			<?php
			if ($this->session->flashdata('logout')) {
			?>
				<div class="alert alert-success">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<strong><?= $this->session->flashdata('logout'); ?></strong>
				</div>
			<?php } ?>

			<?php echo form_open('login/admin'); ?>
			<div class="form-group has-feedback">
				<label for="username">Username</label>
				<input type="text" id="username" name="username" class="form-control" placeholder="Username" value="<?= set_value('username'); ?><?= $this->session->flashdata('username'); ?>" autofocus>
				<span class="fa fa-user form-control-feedback"></span>
				<span class="help-block text-red">
					<?php echo form_error('username'); ?>
					<?= $this->session->flashdata('username_error'); ?>
				</span>
			</div>
			<div class="form-group has-feedback">
				<label for="password">Password</label>
				<input type="password" id="password" name="password" class="form-control" placeholder="Password" autocomplete="current-password">
				<span class="fa fa-lock form-control-feedback"></span>
				<span class="help-block text-red">
					<?php echo form_error('password'); ?>
					<?= $this->session->flashdata('password_error'); ?>
				</span>
			</div>
			<div class="row">
				<!-- /.col -->
				<div class="col-xs-12">
					<button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
				</div>
				<!-- /.col -->
			</div>
			</form>

		</div>
		<!-- /.login-box-body -->
	</div>
	<!-- /.login-box -->

	<!-- jQuery 3 -->
	<script src="<?= base_url(); ?>vendor/jquery/jquery.min.js"></script>
	<!-- Bootstrap 3.3.7 -->
	<script src="<?= base_url(); ?>vendor/bootstrap/js/bootstrap.min.js"></script>
	<!-- iCheck -->
	<script src="<?= base_url(); ?>vendor/iCheck/icheck.min.js"></script>
	<script>
		$(document).ready(function() {

		});
	</script>
</body>

</html>
