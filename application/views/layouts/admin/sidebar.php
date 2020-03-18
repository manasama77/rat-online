<aside class="main-sidebar">
	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">
		<!-- sidebar menu: : style can be found in sidebar.less -->
		<ul class="sidebar-menu" data-widget="tree">
			<li class="header">RAT</li>
			<li>
				<a href="<?=site_url('admin/rat');?>">
					<i class="fa fa-table"></i> <span>RAT Management</span>
				</a>
			</li>
			<li><a href="#"><i class="fa fa-table"></i> <span>Pemilihan Pengurus</span></a></li>
			<li class="header">Rekap</li>
			<li><a href="#"><i class="fa fa-table"></i> <span>Laporan Rekap RAT</span></a></li>

			<?php
			if(in_array($this->session->userdata(UNQ.'id_jabatan'), ['0'])){
			?>
				<li class="header">Master</li>
				<li>
					<a href="<?=site_url('admin/koperasi');?>">
						<i class="fa fa-home"></i> <span>Data Koperasi</span>
					</a>
				</li>
				<li>
					<a href="<?=site_url('admin/list_kode');?>">
						<i class="fa fa-book"></i> <span>List Kode</span>
					</a>
				</li>
				<li>
					<a href="<?=site_url('admin/anggota');?>">
						<i class="fa fa-users"></i> <span>Data Anggota</span>
					</a>
				</li>
			<?php } ?>
		</ul>
	</section>
	<!-- /.sidebar -->
</aside>