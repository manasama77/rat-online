<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>Detail RAT </h1>
</section>

<!-- Main content -->
<section class="content">

	<div class="row">

		<div class="col-md-12 col-sm-12 col-xs-12">
			
			<div class="box box-danger">
				<div class="box-header">
					<h3 class="box-title">
						RAT - [KODE RAT]<br>
						<small>Tahun Buku [TAHUN]
					</h3>
					<div class="pull-right">
						<a href="<?=site_url('admin/rat');?>" class="btn btn-default btn-sm">
							<i class="fa fa-chevron-left"></i> Kembali ke list RAT
						</a>
					</div>
				</div>
				<div class="box-body table-responsive">
					<table class="table table-hover" id="table" style="min-height: 300px; width: 100%;">
						<thead>
							<tr>
								<th class="text-center">#</th>
								<th class="text-center"><i class="fa fa-cogs"></i></th>
								<th class="text-center">ID RAT</th>
								<th>Tahun Buku</th>
								<th>Periode RAT</th>
								<th>Status</th>
							</tr>
						</thead>
						<tbody>
							<?php
							if($arr->num_rows() > 0){
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
														<a href="javascript:;" onclick="editOM('<?=$key->id;?>', '<?=$key->kode_rat;?>');" title="Edit">
															<i class="fa fa-pencil"></i> Edit
														</a>
													</li>
													<li>
														<a href="javascript:;" onclick="deleteOM('<?=$key->id;?>', '<?=$key->kode_rat;?>');" title="Delete">
															<i class="fa fa-trash"></i> Delete
														</a>
													</li>
													<li class="divider"></li>
													<li>
														<?php
														if($key->status_rat == 0 || $key->status_rat == 2){
														?>
															<a href="javascript:;" onclick="lihatOM('<?=$key->id;?>');" title="Lihat">
																<i class="fa fa-eye"></i> Lihat
															</a>
														<?php
														}elseif($key->status_rat == 1){
														?>
															<a href="javascript:;" onclick="masukOM('<?=$key->id;?>');" title="Masuk">
																<i class="fa fa-eye"></i> Masuk
															</a>
														<?php
														}
														?>
													</li>
												</ul>
											</div>
										</td>
										<td><?=$key->kode_rat;?></td>
										<td><?=$key->th_buku;?></td>
										<td>
											<?=$rat_mulai_obj->createFromFormat('Y-m-d', $key->rat_mulai)->format('d-M-Y');?> s/d 
											<?=$rat_akhir_obj->createFromFormat('Y-m-d', $key->rat_akhir)->format('d-M-Y');?>
										</td>
										<td>
											<?php
											if($key->status_rat == 0){
												echo 'Poling Ketua Sidang';
											}elseif($key->status_rat == 1){
												echo 'Aktif/ Berlangsung';
											}elseif($key->status_rat == 2){
												echo 'Close / Selesai';
											}
											?>
										</td>
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

<form action="<?=site_url('admin/list_kode/update');?>" method="post">
	<div class="modal fade" id="modal-edit">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Edit <span id="name_edit"></span></h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="group_list_text_e">Group List</label>
						<input type="text" class="form-control" id="group_list_text_e" name="group_list_text_e">
					</div>
					<div class="form-group">
						<label for="id_list_e">ID List</label>
						<input type="number" class="form-control" id="id_list_e" name="id_list_e">
					</div>
					<div class="form-group">
						<label for="keterangan_e">Keterangan</label>
						<input type="text" class="form-control" id="keterangan_e" name="keterangan_e">
					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" id="id_e" name="id_e">
					<input type="hidden" id="group_list_e" name="group_list_e">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="primary" class="btn btn-primary">Save changes</button>
				</div>
			</div>
		</div>
	</div>
</form>