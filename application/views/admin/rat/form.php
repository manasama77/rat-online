<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>Regis RAT </h1>
</section>

<!-- Main content -->
<section class="content">

	<?php
	if($this->session->flashdata('success')){
		?>

		<div class="row">
			<div class="col-md-6 col-sm-6 col-xs-12">
				<div class="alert alert-info">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<strong><?=$this->session->flashdata('success');?></strong>
				</div>
			</div>
		</div>

	<?php } ?>

	<div class="row">

		<div class="col-md-6 col-sm-6 col-xs-12">

			<form action="<?=site_url('admin/rat/store');?>" method="post">
				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">RAT Info</h3>
					</div>
					<div class="box-body">
						<div class="form-group">
							<label for="nama">Kode RAT</label>
							<input type="text" class="form-control" id="kode_rat" name="kode_rat" placeholder="Kode RAT" value="<?=($this->session->flashdata('kode_rat_temp'))?$this->session->flashdata('kode_rat_temp'):NULL;?>" required>
						</div>
						<div class="form-group">
							<label for="th_buku">Tahun Buku</label>
							<input type="number" class="form-control" id="th_buku" name="th_buku" placeholder="Tahun Buku" value="<?=($this->session->flashdata('th_buku_temp'))?$this->session->flashdata('th_buku_temp'):NULL;?>" min="2000" max="9999">
						</div>
						<div class="form-group">
							<label for="rat_mulai">RAT Mulai</label>
							<input type="text" class="form-control" id="rat_mulai" name="rat_mulai" placeholder="RAT Mulai" value="<?=($this->session->flashdata('rat_mulai_temp'))?$this->session->flashdata('rat_mulai_temp'):NULL;?>">
						</div>
						<div class="form-group">
							<label for="rat_akhir">RAT Akhir</label>
							<input type="text" class="form-control" id="rat_akhir" name="rat_akhir" placeholder="RAT Akhir" value="<?=($this->session->flashdata('rat_akhir_temp'))?$this->session->flashdata('rat_akhir_temp'):NULL;?>">
						</div>
						<div class="form-group">
							<label for="kata_pengantar">Kata Pengantar</label>
							<textarea class="form-control" id="kata_pengantar" name="kata_pengantar"><?=($this->session->flashdata('kata_pengantar_temp'))?$this->session->flashdata('kata_pengantar_temp'):NULL;?></textarea>
						</div>
					</div>
					<div class="box-footer">
						<button type="submit" name="uploadFile" class="btn btn-primary btn-block" id="submit">Regiser</button>
						<a href="<?=site_url('admin/rat');?>" class="btn btn-default btn-block">Kembali Ke List RAT</a>
					</div>
				</div>
			</form>

		</div>

	</div>

</section>
<!-- /.content -->