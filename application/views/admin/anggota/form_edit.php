<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>Edit Anggota </h1>
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

	<?php 
	if(!empty($success_msg)){
		echo '<p class="statusMsg">'.$success_msg.'</p>';
	}elseif(!empty($error_msg)){
		echo '<p class="statusMsg">'.$error_msg.'</p>';
	}

	if(!empty($nama_foto)){
		echo '<p class="statusMsg">'.$nama_foto.'</p>';
	}
	?>

	<div class="row">

		<div class="col-md-6 col-sm-6 col-xs-12">

			<form action="<?=site_url('admin/anggota/update');?>" method="post" enctype="multipart/form-data">
				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">Form Anggota</h3>
					</div>
					<div class="box-body">
						<div class="form-group">
							<label for="nama">Nama</label>
							<input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" value="<?=$arr->row()->nama;?>" required>
						</div>
						<div class="form-group">
							<label for="tempat_lahir">Tempat Lahir</label>
							<input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" placeholder="Tempat Lahir" value="<?=$arr->row()->tempat_lahir;?>">
						</div>
						<div class="form-group">
							<label for="tanggal_lahir">Tanggal Lahir</label>
							<input type="text" class="form-control" id="tanggal_lahir" name="tanggal_lahir" placeholder="Tanggal Lahir" value="<?=$tgl_lhr_obj->createFromFormat('Y-m-d', $arr->row()->tanggal_lahir)->format('d-m-Y');?>">
						</div>
						<div class="form-group">
							<label for="jenis_kelamin">Jenis Kelamin</label>
							<select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
								<option value="laki - laki" 
								<?=($arr->row()->jenis_kelamin == 'laki - laki')?'selected':'';?>
								>Laki-Laki</option>
								<option value="perempuan" 
								<?=($arr->row()->jenis_kelamin == 'perempuan')?'selected':'';?>
								>Perempuan</option>
							</select>
						</div>
						<div class="form-group">
							<label for="no_ktp">No KTP</label>
							<input type="number" class="form-control" id="no_ktp" name="no_ktp" placeholder="No KTP" value="<?=$arr->row()->no_ktp;?>">
						</div>
						<div class="form-group">
							<label for="alamat">Alamat</label>
							<input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat" value="<?=$arr->row()->alamat;?>">
						</div>
						<div class="form-group">
							<label for="no_telp">No Telepon</label>
							<input type="number" class="form-control" id="no_telp" name="no_telp" placeholder="No Telepon" value="<?=$arr->row()->no_telp;?>">
						</div>
						<div class="form-group">
							<label for="id_jabatan">Jabatan <?=$arr->row()->id_jabatan;?></label>
							<select class="form-control" id="id_jabatan" name="id_jabatan">
								<option value=""></option>
								<?php
								foreach ($arr_jabatan->result() as $key_jabatan) {
									?>
									<option value="<?=$key_jabatan->id_list;?>" 
										<?=($arr->row()->id_jabatan == $key_jabatan->id_list)?'selected':'';?>
										><?=$key_jabatan->keterangan;?></option>
									<?php } ?>
								</select>
							</div>
							<div class="form-group">
								<label for="foto">Foto</label>
								<input type="file" class="form-control" id="foto" name="foto" placeholder="Foto">
							</div>
						</div>
						<div class="box-footer">
							<input type="text" id="id" name="id" value="<?=$arr->row()->id;?>">
							<input type="text" id="prev_foto" name="prev_foto" value="<?=$arr->row()->foto;?>">
							<button type="submit" class="btn btn-primary btn-block" id="submit">Edit</button>
							<a href="<?=site_url('admin/anggota');?>" class="btn btn-default btn-block">Kembali ke list Anggota</a>
						</div>
					</div>
				</form>

			</div>

		</div>

	</section>
<!-- /.content -->