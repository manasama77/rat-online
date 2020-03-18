<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>Detail RAT </h1>
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
	if($this->session->flashdata('file_error')){
		?>

		<div class="row">
			<div class="col-md-6 col-sm-6 col-xs-12">
				<div class="alert alert-info">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<strong><?=$this->session->flashdata('file_error');?></strong>
				</div>
			</div>
		</div>

	<?php } ?>

	<?php
	if($arr->row()->status_rat == 0){
	?>
		<div class="row">
			<div class="col-md-4 col-sm-12 col-xs-12">
				
				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">
							Polling Ketua Sidang
						</h3>
						<div class="pull-right">
							<a href="<?=site_url('admin/rat');?>" class="btn btn-default btn-sm">
								<i class="fa fa-chevron-left"></i> Kembali ke list RAT
							</a>
						</div>
					</div>
					<div class="box-body">
						<?php
						if($bisa_polling == 'belum'){
						?>
							<div class="alert alert-info">
								<strong>Polling Belum Dimulai</strong>
							</div>
						<?php }elseif($bisa_polling == 'berakhir'){ ?>
							<div class="alert alert-info">
								<strong>Polling Berakhir</strong>
							</div>
						<?php }else{ ?>
							<form action="<?=site_url('admin/rat/store_polling');?>" method="post">
								<div class="form-group">
									<label for="">Pilih Ketua Sidang</label>
									<select class="form-control" id="id_anggota" name="id_anggota" required>
										<option value=""></option>
										<?php
										if($arr_anggota->num_rows() > 0){
											foreach ($arr_anggota->result() as $keya) {
												if($keya->id != $this->session->userdata(UNQ.'id')){
													echo '<option value="'.$keya->id.'">'.$keya->nama.'</option>';
												}
											}
										}
										?>
									</select>
								</div>
								<div class="form-group">
									<input type="hidden" id="id_rat" name="id_rat" value="<?=$arr->row()->id;?>">
									<button type="submit" id="submit_polling" class="btn btn-primary btn-block">Submit</button>
								</div>
							</form>
						<?php } ?>
					</div>
				</div>

			</div>

			<div class="col-md-4 col-sm-12 col-xs-12">
				
				<div class="box box-success">
					<div class="box-header">
						<h3 class="box-title">
							Quick Count - Polling Ketua Sidang<br>
							<small>
								Periode Polling: 
								<?=$polling_mulai_obj->createFromFormat('Y-m-d', $arr->row()->polling_mulai)->format('d-M-Y');?> s/d 
								<?=$polling_akhir_obj->createFromFormat('Y-m-d', $arr->row()->polling_akhir)->format('d-M-Y');?>
							</small>
						</h3>
					</div>
					<div class="box-body">
						<table class="table">
							<thead>
								<tr>
									<th>Nama</th>
									<th>Vote</th>
								</tr>
							</thead>
							<tbody>
								<?php
								foreach ($qc as $key) {
								?>
									<tr>
										<td><?=$key['nama'];?></td>
										<td><?=number_format($key['vote'], 0);?></td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>

			</div>
		</div>
	<?php
	}else{
	?>

		<div class="row">

			<div class="col-md-12 col-sm-12 col-xs-12">
				
				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">
							RAT - <?=$arr->row()->kode_rat;?><br>
							<small>Tahun Buku <?=$arr->row()->th_buku;?></small>
						</h3>
						<div class="pull-right">
							<a href="<?=site_url('admin/rat');?>" class="btn btn-default btn-sm">
								<i class="fa fa-chevron-left"></i> Kembali ke list RAT
							</a>
						</div>
					</div>
					<div class="box-body">
						<div class="row">
							<div class="col-md-8 col-sm-12">
								<h4 class="text-left">Kata Pengantar</h4>
								<hr style="margin-top:-7px;">
								<p><?=$arr->row()->kata_pengantar;?></p>
							</div>
							<div class="col-md-4 col-sm-12">
								<h4 class="text-center">Berkas Laporan RAT</h4>
								<hr style="margin-top:-7px;">
								<ul>
									<?php
									if($arr_file->num_rows() == 0){
										echo '<li>Belum ada file</li>';
									}else{
										foreach ($arr_file->result() as $keyf) {
									?>
										<li>
											<a href="<?=site_url();?>admin/rat/read/<?=$arr->row()->id;?>/<?=$keyf->id;?>">[<?=$keyf->jenis_laporan;?>] <?=$keyf->nama_laporan;?></a>&nbsp;
											<?php
											if(in_array($this->session->userdata(UNQ.'id_jabatan'), ['0', '1'])){
											?>
												<a href="javascript:;" onclick="deleteOM('<?=$keyf->id;?>', '<?=$arr->row()->id;?>', '<?=$keyf->nama_laporan;?>')" class="label label-danger" title="Delete File RAT"><i class="fa fa-trash"></i></a>
											<?php } ?>
											<?php
											if($keyf->flag_respon == 'ya'){
											?>
												<ul>
													<li>Setuju: <?=number_format($keyf->setuju, 0);?></li>
													<li>Menolak: <?=number_format($keyf->menolak, 0);?></li>
													<li>Abstain: <?=number_format($keyf->abstain, 0);?></li>
													<li>Belum Menilai: <?=number_format($keyf->belum_menilai, 0);?></li>
												</ul>
											<?php } ?>
										</li>
									<?php } ?>
								<?php } ?>
								</ul>
								<?php
								if(in_array($this->session->userdata(UNQ.'id_jabatan'), ['0', '1'])){
								?>
									<hr>
									<button type="button" onclick="uploadOM('<?=$arr->row()->id;?>')" class="btn btn-success btn-block">Upload Laporan RAT</button>
								<?php } ?>
							</div>
						</div>
					</div>
					<!-- <div class="box-footer">

					</div> -->
				</div>

			</div>

		</div>

	<?php } ?>

</section>
<!-- /.content -->

<div class="modal fade" id="modal-upload">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Upload Laporan RAT</h4>
			</div>
			<form action="<?=site_url('admin/rat/upload');?>" method="post" enctype="multipart/form-data">
				<div class="modal-body">
					<div class="form-group">
						<label for="">Jenis Laporan</label>
						<select class="form-control" id="id_jenis_laporan" name="id_jenis_laporan">
							<?php foreach ($arr_jenis_laporan->result() as $keyjl): ?>
								<option value="<?=$keyjl->id_list;?>"><?=$keyjl->keterangan;?></option>
							<?php endforeach ?>
						</select>
					</div>
					<div class="form-group">
						<label for="">Nama Laporan</label>
						<input type="text" class="form-control" id="nama_file" name="nama_file" required>
					</div>
					<div class="form-group">
						<label for="">File</label>
						<input type="file" class="form-control" id="file" name="file" accept="application/pdf" required>
					</div>
					<div class="form-group">
						<label for="">Dapat direspon ?</label>
						<select class="form-control" id="flag_respon" name="flag_respon">
							<option value="ya">Ya</option>
							<option value="tidak">Tidak</option>
						</select>
					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" id="id_rat_upload" name="id_rat_upload">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Upload</button>
				</div>
			</form>
		</div>
	</div>
</div>