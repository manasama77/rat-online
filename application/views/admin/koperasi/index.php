<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>Data Koperasi </h1>
</section>

<!-- Main content -->
<section class="content">

	<div class="row">

		<div class="col-md-6 col-sm-6 col-xs-12">

			<?php
			if($this->session->flashdata('success')){
			?>
				<div class="alert alert-info">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<strong><?=$this->session->flashdata('success');?></strong>
				</div>
			<?php } ?>
			
			<form class="form" id="form" action="<?=site_url('admin/koperasi/update');?>" method="post">
				<div class="box box-danger">
					<div class="box-header">
						<h3 class="box-title">Data Koperasi</h3>
					</div>
					<div class="box-body">
						<div class="form-group">
							<label for="nama_koperasi">Nama Koperasi</label>
							<input type="text" class="form-control" id="nama_koperasi" name="nama_koperasi" placeholder="Nama Koperasi" value="<?=$nama_koperasi;?>">
						</div>
						<div class="form-group">
							<label for="alamat">Alamat</label>
							<textarea class="form-control" id="alamat" name="alamat" placeholder="Alamat"><?=$alamat;?></textarea>
						</div>
						<div class="form-group">
							<label for="no_telp">No Telepon</label>
							<input type="number" class="form-control" id="no_telp" name="no_telp" placeholder="No Telepon" value="<?=$no_telp;?>">
						</div>
						<div class="form-group">
							<label for="nik">NIK</label>
							<input type="text" class="form-control" id="nik" name="nik" placeholder="NIK" value="<?=$nik;?>">
						</div>
					</div>
					<div class="box-footer">
						<button type="submit" class="btn btn-primary btn-block">Save</button>
					</div>
				</div>
			</form>

		</div>

	</div>

</section>
<!-- /.content -->