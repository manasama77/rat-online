<section class="content-header">
	<h1>RAT - <?=$arr_rat->row()->kode_rat;?><br><small>Tahun Buku <?=$arr_rat->row()->th_buku;?></small></h1>
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
			
			<div class="box box-primary">
				<div class="box-header">
					<h3 class="box-title">
						<?=$arr->row()->nama_laporan;?>
					</h3>
					<div class="pull-right">
						<a href="<?=site_url();?>admin/rat/detail/<?=$arr->row()->id_rat;?>" class="btn btn-default btn-sm">
							<i class="fa fa-chevron-left"></i> Kembali ke Detail RAT
						</a>
					</div>
				</div>
				<div class="box-body">
					<div class="row">
						<div class="col-md-12 col-sm-12">
							<object data="<?=base_url();?>assets/pdf/file_rat/<?=$arr->row()->file_laporan;?>" type="application/pdf" width="100%" height="1000px"></object>
						</div>
					</div>
				</div>
				<!-- <div class="box-footer">

				</div> -->
			</div>

		</div>

	</div>

	<?php
	if($arr->row()->flag_respon == 'ya'){
	?>
		<div class="row">

			<div class="col-md-6 col-sm-12 col-xs-12">
				
				<div class="box box-success">
					<div class="box-header">
						<h3 class="box-title">
							Respon
						</h3>
					</div>
					<div class="box-body">
						<div class="row">
							<div class="col-md-12 col-sm-12">

								<?php
								if($bisa_respon == 'belum' || $bisa_respon == 'berakhir'){
									if($bisa_respon == 'belum'){
										$pesan = 'Periode RAT belum di mulai';
									}else{
										$pesan = 'Periode RAT telah berakhir';
									}
									?>
									<div class="alert alert-info">
										<strong><?=$pesan;?></strong>
									</div>
								<?php } ?>


								<form action="<?=site_url('admin/rat/store_respon');?>" method="post">
									<div class="form-group">
										<label for="id_respon">Tanggapan terhadap laporan ini ?</label>
										<select class="form-control" id="id_respon" name="id_respon" required>
											<?php
											foreach ($arr_respon->result() as $keyr) :
												?>
												<option value="<?=$keyr->id_list;?>"><?=$keyr->keterangan;?></option>
												<?php
											endforeach
											?>
										</select>
									</div>
									<div class="form-group">
										<label for="ket_respon">Catatan</label>
										<textarea class="form-control" id="ket_respon" name="ket_respon"><?=$ket_respon;?></textarea>
									</div>
									<div class="form-group">
										<input type="hidden" id="id_rat_respon" name="id_rat_respon" value="<?=$arr_rat->row()->id;?>">
										<input type="hidden" id="id_file_respon" name="id_file_respon" value="<?=$arr->row()->id;?>">
										<button type="submit" id="submit_respon" class="btn btn-primary">Submit</button>
										<a href="<?=site_url();?>admin/rat/detail/<?=$arr->row()->id_rat;?>" class="btn btn-default">
											Kembali ke Detail RAT
										</a>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>

			</div>

		</div>
	<?php } ?>

</section>
<!-- /.content -->