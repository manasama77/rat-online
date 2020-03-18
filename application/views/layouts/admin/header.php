<header class="main-header">
	<!-- Logo -->
	<a href="../../index2.html" class="logo">
		<!-- mini logo for sidebar mini 50x50 pixels -->
		<span class="logo-mini"><b>RAT</b></span>
		<!-- logo for regular state and mobile devices -->
		<span class="logo-lg"><b>RAT</b> Online</span>
	</a>
	<!-- Header Navbar: style can be found in header.less -->
	<nav class="navbar navbar-static-top">
		<!-- Sidebar toggle button-->
		<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</a>

		<div class="navbar-custom-menu">
			<ul class="nav navbar-nav">
				<!-- User Account: style can be found in dropdown.less -->
				<li class="dropdown user user-menu">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<img src="<?=base_url();?>assets/img/foto/<?=$this->session->userdata(UNQ.'foto');?>" class="user-image" alt="User Image">
						<span class="hidden-xs"><?=$this->session->userdata(UNQ.'nama');?></span>
					</a>
					<ul class="dropdown-menu">
						<!-- User image -->
						<li class="user-header">
							<img src="<?=base_url();?>assets/img/foto/<?=$this->session->userdata(UNQ.'foto');?>" class="img-circle" alt="User Image">
							<p>
								<?=$this->session->userdata(UNQ.'nama');?>
								<small>Role <?=strtoupper($this->session->userdata(UNQ.'nama_jabatan'));?></small>
							</p>
						</li>
						<!-- Menu Footer-->
						<li class="user-footer">
							<div class="pull-left">
								<a href="#" class="btn btn-default btn-flat">Change Password</a>
							</div>
							<div class="pull-right">
								<a href="<?=base_url();?>logout/admin" class="btn btn-default btn-flat">Sign out</a>
							</div>
						</li>
					</ul>
				</li>
			</ul>
		</div>
	</nav>
</header>