<!-- Content Header (Page header) -->
<section class="content-header">
	<h1><?=$title;?> </h1>
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

	<form action="<?=site_url('admin/rat/store_penutupan');?>" method="post">

		<div class="row">

			<div class="col-md-10 col-sm-10 col-xs-12">

				<div class="box box-primary">
					<div class="box-body">
						<div class="form-group">
							<label for="kata_pengantar">Berita Acara</label>
							<textarea class="form-control" id="berita_acara" name="berita_acara" rows="22" placeholder="Masukan Berita Acara..."><?=($this->session->flashdata('berita_acara_temp'))?$this->session->flashdata('berita_acara_temp'):NULL;?></textarea>
						</div>
					</div>
				</div>

			</div>

			<div class="col-md-8 col-sm-8 col-xs-12">

				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">Rangkuman</h3>
					</div>
					<div class="box-body">
						<div class="table-responsive">
							<table class="table table-bordered">
								<tbody>
									<tr>
										<td width="130px;">Ketua Pengurus</td>
										<td><?=$res_pengurus['ketua_pengurus_nama'];?> (<?=$res_pengurus['ketua_pengurus_vote'];?> voter)</td>
									</tr>
									<tr>
										<td>Sekertaris</td>
										<td><?=$res_pengurus['sekertaris_nama'];?> (<?=$res_pengurus['sekertaris_vote'];?> voter)</td>
									</tr>
									<tr>
										<td>Bendahara</td>
										<td><?=$res_pengurus['bendahara_nama'];?> (<?=$res_pengurus['bendahara_vote'];?> voter)</td>
									</tr>
									<tr>
										<td colspan="2">
											<?php
											foreach ($arr_file->result() as $keyf) {
												if($keyf->flag_respon == 'ya'){
													?>
													<li>
														<?php
														?>
														<b>[<?=$keyf->jenis_laporan;?>] <?=$keyf->nama_laporan;?></b>
														<ul>
															<li>Setuju: <?=number_format($keyf->setuju, 0);?></li>
															<li>Menolak: <?=number_format($keyf->menolak, 0);?></li>
															<li>Abstain: <?=number_format($keyf->abstain, 0);?></li>
															<li>Belum Menilai: <?=number_format($keyf->belum_menilai, 0);?></li>
														</ul>
													</li>
												<?php } ?>
											<?php } ?>

										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<div class="box-footer">
						<input type="hidden" id="id_rat" name="id_rat" value="<?=$id_rat;?>">
						<input type="hidden" id="id_ketua_pengurus" name="id_ketua_pengurus" value="<?=$res_pengurus['ketua_pengurus_id'];?>">
						<input type="hidden" id="id_sekertaris" name="id_sekertaris" value="<?=$res_pengurus['sekertaris_id'];?>">
						<input type="hidden" id="id_bendahara" name="id_bendahara" value="<?=$res_pengurus['bendahara_id'];?>">
						<?php
						if($res_pengurus['ketua_pengurus_id'] == NULL || $res_pengurus['sekertaris_id'] == NULL || $res_pengurus['bendahara_id'] == NULL){
							$disabled = 'disabled';
						}else{
							$disabled = '';
						}
						?>
						<button type="submit" class="btn btn-primary btn-block" id="submit" <?=$disabled;?>>Tutup RAT</button>
					</div>
				</div>

			</div>

		</div>

	</form>

</section>
<!-- /.content