<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>Anggota </h1>
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

		<div class="col-md-12 col-sm-12 col-xs-12">
			
			<div class="box box-danger">
				<div class="box-header">
					<h3 class="box-title">List Anggota</h3>
					<div class="pull-right">
						<a href="<?=site_url('admin/anggota/create');?>" class="btn btn-primary btn-sm">
							<i class="fa fa-plus"></i> Tambah Anggota
						</a>
					</div>
				</div>
				<div class="box-body table-responsive">
					<table class="table table-hover" id="table" style="min-height: 500px; width:100%;">
						<thead>
							<tr>
								<th class="text-center">#</th>
								<th class="text-center" style="min-width:100px;"><i class="fa fa-cogs"></i></th>
								<th class="text-center" style="min-width:70px;">Foto</th>
								<th>Nama</th>
								<th style="min-width:120px;">TTL</th>
								<th>Jenis Kelamin</th>
								<th>No KTP</th>
								<th>Alamat</th>
								<th>No Telp</th>
								<th>Jabatan</th>
								<th>User Login</th>
							</tr>
						</thead>
						<tbody>
							<?php
							if($arr->num_rows() == 0){
								?>
								<tr>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
								<?php
							}else{
								?>
								<?php
								foreach ($arr->result() as $key) {
									?>
									<tr>
										<td><?=$key->id;?></td>
										<td class="text-center">
											<div class="btn-group">
												<button type="button" class="btn btn-success btn-flat dropdown-toggle" data-toggle="dropdown">Action</button>
												<button type="button" class="btn btn-success btn-flat dropdown-toggle" data-toggle="dropdown">
													<span class="caret"></span>
													<span class="sr-only">Toggle Dropdown</span>
												</button>
												<ul class="dropdown-menu" role="menu">
													<li>
														<a href="<?=site_url();?>admin/anggota/edit/<?=$key->id;?>" title="Edit">
															<i class="fa fa-pencil"></i> Edit
														</a>
													</li>
													<li>
														<a href="javascript:;" onclick="deleteOM('<?=$key->id;?>', '<?=$key->nama;?>');" title="Delete">
															<i class="fa fa-trash"></i> Delete
														</a>
													</li>
													<li>
														<a href="javascript:;" onclick="resetOM('<?=$key->id;?>', '<?=$key->nama;?>');" title="Reset Password">
															<i class="fa fa-key"></i> Reset Password
														</a>
													</li>
												</ul>
											</div>
										</td>
										<td><img src="<?=base_url();?>assets/img/foto/<?=$key->foto;?>" style="max-width: 50px;"></td>
										<td><?=$key->nama;?></td>
										<td><?=$key->tempat_lahir;?>, <?=$key->tanggal_lahir;?></td>
										<td><?=$key->jenis_kelamin;?></td>
										<td><?=$key->no_ktp;?></td>
										<td><?=$key->alamat;?></td>
										<td><?=$key->no_telp;?></td>
										<td><?=$key->nama_jabatan;?></td>
										<td><?=$key->user_login;?></td>
									</tr>
								<?php }?>
							<?php } ?>
						</tbody>
					</table>
				</div>
				<!-- <div class="box-footer">

				</div> -->
			</div>

		</div>

	</div>

</section>
<!-- /.content -->

<form action="<?=site_url();?>admin/anggota/reset" method="post">
	<div class="modal fade" id="modal-reset">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Reset Password <span id="name_reset"></span></h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="reset_password">New Password</label>
						<input type="password" class="form-control" id="reset_password" name="reset_password" required>
					</div>
				</div>
				<div class="modal-footer">
					<input type="text" id="id_anggota_reset" name="id_anggota_reset">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Save changes</button>
				</div>
			</div>
		</div>
	</div>
</form>