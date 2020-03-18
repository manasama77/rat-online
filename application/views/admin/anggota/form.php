<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>Tambah Anggota </h1>
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

			<form action="<?=site_url('admin/anggota/store');?>" method="post" enctype="multipart/form-data">
				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">Tambah Anggota</h3>
					</div>
					<div class="box-body">
						<div class="form-group">
							<label for="nama">Nama</label>
							<input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" value="<?=($this->session->flashdata('nama_temp'))?$this->session->flashdata('nama_temp'):NULL;?>" required>
						</div>
						<div class="form-group">
							<label for="tempat_lahir">Tempat Lahir</label>
							<input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" placeholder="Tempat Lahir" value="<?=($this->session->flashdata('tempat_lahir_temp'))?$this->session->flashdata('tempat_lahir_temp'):NULL;?>">
						</div>
						<div class="form-group">
							<label for="tanggal_lahir">Tanggal Lahir</label>
							<input type="text" class="form-control" id="tanggal_lahir" name="tanggal_lahir" placeholder="Tanggal Lahir" value="<?=($this->session->flashdata('tanggal_lahir_temp'))?$this->session->flashdata('tanggal_lahir_temp'):NULL;?>">
						</div>
						<div class="form-group">
							<label for="jenis_kelamin">Jenis Kelamin</label>
							<select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
								<option value="laki - laki" 
								<?=($this->session->flashdata('jenis_kelamin_temp') == 'laki - laki')?'selected':'';?>
								>Laki-Laki</option>
								<option value="perempuan" 
								<?=($this->session->flashdata('jenis_kelamin_temp') == 'perempuan')?'selected':'';?>
								>Perempuan</option>
							</select>
						</div>
						<div class="form-group">
							<label for="no_ktp">No KTP</label>
							<input type="number" class="form-control" id="no_ktp" name="no_ktp" placeholder="No KTP" value="<?=($this->session->flashdata('no_ktp_temp'))?$this->session->flashdata('no_ktp_temp'):NULL;?>">
						</div>
						<div class="form-group">
							<label for="alamat">Alamat</label>
							<input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat" value="<?=($this->session->flashdata('alamat_temp'))?$this->session->flashdata('alamat_temp'):NULL;?>">
						</div>
						<div class="form-group">
							<label for="no_telp">No Telepon</label>
							<input type="number" class="form-control" id="no_telp" name="no_telp" placeholder="No Telepon" value="<?=($this->session->flashdata('no_telp_temp'))?$this->session->flashdata('no_telp_temp'):NULL;?>">
						</div>
						<div class="form-group">
							<label for="id_jabatan">Jabatan</label>
							<select class="form-control" id="id_jabatan" name="id_jabatan">
								<option value=""></option>
								<?php
								foreach ($arr_jabatan->result() as $key_jabatan) {
									?>
									<option value="<?=$key_jabatan->keterangan;?>" 
										<?=($this->session->flashdata('id_jabatan_temp') == $key_jabatan->keterangan)?'selected':'';?>
										><?=$key_jabatan->keterangan;?></option>
									<?php } ?>
								</select>
							</div>
							<div class="form-group">
								<label for="user_login">User Login</label>
								<input type="text" class="form-control" id="user_login" name="user_login" placeholder="User Login" value="<?=($this->session->flashdata('user_login_temp'))?$this->session->flashdata('user_login_temp'):NULL;?>">
							</div>
							<div class="form-group">
								<label for="password_login">Password Login</label>
								<input type="password" class="form-control" id="password_login" name="password_login" placeholder="Password Login">
							</div>
							<div class="form-group">
								<label for="foto">Foto</label>
								<input type="file" class="form-control" id="foto" name="foto" placeholder="Foto">
							</div>
						</div>
						<div class="box-footer">
							<button type="submit" name="uploadFile" class="btn btn-primary btn-block" id="submit">Tambah</button>
						</div>
					</div>
				</form>

			</div>

		</div>

	</section>
<!-- /.content -->