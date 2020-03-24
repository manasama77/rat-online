<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>Pemilihan Pengurus <?=$arr->row()->kode_rat;?> - <?=$arr->row()->th_buku;?></h1>
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

	<form action="<?=site_url('admin/rat/store_vote_pengurus');?>" method="post">

		<div class="row">

			<div class="col-md-4 col-sm-4 col-xs-12">

				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">
							Vote Pengurus<br>
							<small>
								Periode RAT: 
								<?=$rat_mulai_obj->createFromFormat('Y-m-d', $arr->row()->rat_mulai)->format('d-M-Y');?> s/d 
								<?=$rat_akhir_obj->createFromFormat('Y-m-d', $arr->row()->rat_akhir)->format('d-M-Y');?>
							</small>
						</h3>
					</div>
					<div class="box-body">
						<div class="form-group">
							<label for="id_ketua_pengurus">Ketua Pengurus</label>
							<select class="form-control select2" id="id_ketua_pengurus" name="id_ketua_pengurus" data-placeholder="Ketua Pengurus" required>
								<option value=""></option>
								<?php
								foreach ($arr_anggota->result() as $aa) {
									echo '<option value="'.$aa->id.'">'.$aa->nama.'</option>';
								}
								?>
							</select>
						</div>
						<div class="form-group">
							<label for="id_sekertaris">Sekertaris</label>
							<select class="form-control select2" id="id_sekertaris" name="id_sekertaris" data-placeholder="Sekertaris" required>
								<option value=""></option>
								<?php
								foreach ($arr_anggota->result() as $aa) {
									echo '<option value="'.$aa->id.'">'.$aa->nama.'</option>';
								}
								?>
							</select>
						</div>
						<div class="form-group">
							<label for="id_bendahara">Bendahara</label>
							<select class="form-control select2" id="id_bendahara" name="id_bendahara" data-placeholder="Bendahara" required>
								<option value=""></option>
								<?php
								foreach ($arr_anggota->result() as $aa) {
									echo '<option value="'.$aa->id.'">'.$aa->nama.'</option>';
								}
								?>
							</select>
						</div>
					</div>
					<div class="box-footer">
						<input type="hidden" id="id_rat" name="id_rat" value="<?=$arr->row()->id;?>">
						<button type="submit" class="btn btn-primary btn-block" id="submit_polling">Submit</button>
					</div>
				</div>

			</div>

		</div>

		<div class="row">

			<div class="col-md-4 col-sm-12 col-xs-12">
				
				<div class="box box-success">
					<div class="box-header">
						<h3 class="box-title">
							Quick Count - Vote Ketua Pengurus
						</h3>
					</div>
					<div class="box-body">
						<table class="table">
							<thead>
								<tr>
									<th>Nama</th>
									<th>Voter</th>
								</tr>
							</thead>
							<tbody>
								<?php
								foreach ($qc_1 as $key) {
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

			<div class="col-md-4 col-sm-12 col-xs-12">
				
				<div class="box box-success">
					<div class="box-header">
						<h3 class="box-title">
							Quick Count - Vote Sekertaris
						</h3>
					</div>
					<div class="box-body">
						<table class="table">
							<thead>
								<tr>
									<th>Nama</th>
									<th>Voter</th>
								</tr>
							</thead>
							<tbody>
								<?php
								foreach ($qc_2 as $key) {
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

			<div class="col-md-4 col-sm-12 col-xs-12">
				
				<div class="box box-success">
					<div class="box-header">
						<h3 class="box-title">
							Quick Count - Vote Bendahara
						</h3>
					</div>
					<div class="box-body">
						<table class="table">
							<thead>
								<tr>
									<th>Nama</th>
									<th>Voter</th>
								</tr>
							</thead>
							<tbody>
								<?php
								foreach ($qc_3 as $key) {
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

	</form>

</section>
<!-- /.content