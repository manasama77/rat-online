<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>Buka RAT </h1>
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
				</div>
				<div class="box-body table-responsive">
					<table class="table table-hover" id="table" style="min-height: 300px; width: 100%;">
						<thead>
							<tr>
								<th class="text-center">#</th>
								<th class="text-center">ID RAT</th>
								<th>Tahun Buku</th>
								<th>Periode RAT</th>
								<!-- <th>Ketua Sidang</th> -->
								<th>Status</th>
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
										<!-- <td><?=$key->nama;?></td> -->
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
										<td class="text-center">
											<button type="button" class="btn btn-primary" onclick="bukaRAT('<?=$key->id;?>', '<?=$key->kode_rat;?>');"><i class="fa fa-check"></i> Buka RAT</button>
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