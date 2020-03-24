<section class="content-header">
	<h1>Hal List RAT </h1>
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
					<h3 class="box-title">List RAT</h3>
					<div class="pull-right">
						<?php
						if(in_array($this->session->userdata(UNQ.'id_jabatan'), ['0', '1'])){
							?>
							<a href="<?=site_url('admin/rat/create');?>" class="btn btn-primary btn-sm">
								<i class="fa fa-plus"></i> Regis RAT Baru
							</a>
						<?php } ?>
					</div>
				</div>
				<div class="box-body table-responsive">
					<table class="table table-hover" id="table" style="min-height: 300px; width: 100%;">
						<thead>
							<tr>
								<th class="text-center">#</th>
								<th class="text-center">ID RAT</th>
								<th>Tahun Buku</th>
								<th>Periode RAT</th>
								<th>Ketua Sidang</th>
								<th>Status</th>
								<th>Aktif</th>
								<th class="text-center"><i class="fa fa-cogs"></i></th>
							</tr>
						</thead>
						<tbody>
							<?php
							if($arr->num_rows() > 0){

								foreach ($arr->result() as $key) {
									?>
									<tr>
										<td><?=$key->id;?></td>
										<td><?=$key->kode_rat;?></td>
										<td><?=$key->th_buku;?></td>
										<td>
											<?=$rat_mulai_obj->createFromFormat('Y-m-d', $key->rat_mulai)->format('d-M-Y');?> s/d 
											<?=$rat_akhir_obj->createFromFormat('Y-m-d', $key->rat_akhir)->format('d-M-Y');?>
										</td>
										<td><?=$key->nama;?></td>
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
										<td><?=ucwords($key->flag_aktif);?></td>
										<td class="text-center">
											<div class="btn-group">
												<button type="button" class="btn btn-success btn-flat dropdown-toggle" data-toggle="dropdown">Action</button>
												<button type="button" class="btn btn-success btn-flat dropdown-toggle" data-toggle="dropdown">
													<span class="caret"></span>
													<span class="sr-only">Toggle Dropdown</span>
												</button>
												<ul class="dropdown-menu pull-right" role="menu">
													<?php
													if(in_array($this->session->userdata(UNQ.'id_jabatan'), ['0', '1'])){
														?>
														<?php
														if($key->status_rat == '0' && $key->flag_aktif == 'tidak'){
															?>
															<li>
																<a href="<?=site_url();?>admin/rat/edit/<?=$key->id;?>" title="Edit" disabled>
																	<i class="fa fa-pencil"></i> Edit
																</a>
															</li>
															<li>
																<a href="javascript:;" onclick="deleteOM('<?=$key->id;?>', '<?=$key->kode_rat;?>');" title="Delete">
																	<i class="fa fa-trash"></i> Delete
																</a>
															</li>
															<li class="divider"></li>
														<?php } ?>
														<?php
														if($key->status_rat == '0' && $key->flag_aktif == 'tidak'){
															?>
															<li>
																<a href="javascript:;" onclick="aktifkanOM('<?=$key->id;?>', '<?=$key->kode_rat;?>', 'aktifkan');" title="Aktifkan RAT">
																	<i class="fa fa-check"></i> Aktifkan
																</a>
															</li>
															<li class="divider"></li>
														<?php } ?>
														<?php
														if($key->status_rat == '0' && $key->flag_aktif == 'ya'){
															?>
															<li>
																<a href="javascript:;" onclick="aktifkanOM('<?=$key->id;?>', '<?=$key->kode_rat;?>', 'nonaktifkan');" title="Aktifkan RAT">
																	<i class="fa fa-times"></i> Non Aktifkan
																</a>
															</li>
															<li class="divider"></li>
														<?php } ?>
														<?php
														if($key->status_rat == 0){
															if($this->session->userdata('flag_ketua_sidang') == 'ya'){
																?>
																<li>
																	<a href="<?=site_url();?>admin/rat/penetapan/<?=$key->id;?>" title="Tetapkan Ketua Berdasarkan Polling">
																		<i class="fa fa-gavel"></i> Tetapkan Ketua Sidang Berdasarkan Polling
																	</a>
																</li>
																<li class="divider"></li>
																<?php 
															}
														} 
														?>
													<?php } ?>
													<li>
														<?php
														if($key->flag_aktif == 'ya'){
															?>
															<a href="<?=site_url();?>admin/rat/detail/<?=$key->id;?>" title="Lihat">
																<i class="fa fa-eye"></i> Lihat
															</a>
															<?php
														}
														?>
													</li>
												</ul>
											</div>
										</td>
									</tr>
								<?php } ?>

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
<!-- /.content