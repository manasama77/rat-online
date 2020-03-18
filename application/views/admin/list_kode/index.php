<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>List Kode </h1>
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

		<div class="col-md-6 col-sm-6 col-xs-12">
			
			<div class="box box-danger">
				<div class="box-header">
					<h3 class="box-title">List Kode</h3>
				</div>
				<div class="box-body">
					<table class="table" id="table">
						<thead>
							<tr>
								<th>Group List</th>
								<th class="text-center">Kode</th>
								<th>Keterangan</th>
								<th class="text-center"><i class="fa fa-cogs"></i></th>
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
								</tr>
								<?php
							}else{
								?>
								<?php
								foreach ($arr->result() as $key) {
									?>
									<tr>
										<td><?=$key->group_list;?></td>
										<td class="text-center"><?=$key->id_list;?></td>
										<td><?=$key->keterangan;?></td>
										<td class="text-center">
											<div class="btn-group">
												<button type="button" class="btn btn-info btn-sm" onclick="editOM('<?=$key->id;?>', '<?=$key->group_list;?>', '<?=$key->id_list;?>', '<?=$key->keterangan;?>');" title="Edit">
													<i class="fa fa-pencil"></i>
												</button>
												<button type="button" class="btn btn-danger btn-sm" onclick="deleteOM('<?=$key->id;?>', '<?=$key->keterangan;?>');" title="Delete">
													<i class="fa fa-trash"></i>
												</button>
											</div>
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

		<div class="col-md-6 col-sm-6 col-xs-12">

			<form action="<?=site_url('admin/list_kode/store');?>" method="post">
				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">Tambah Kode</h3>
					</div>
					<div class="box-body">
						<div class="form-group">
							<label for="group_list">Group List</label>
							<select class="form-control" id="group_list" name="group_list">
								<option value="jabatan" 
								<?=($this->session->flashdata('group_list_temp') == 'jabatan')?'selected':'';?>
								>Jabatan</option>
							</select>
						</div>
						<div class="form-group">
							<label for="id_list">ID List</label>
							<input type="number" class="form-control" id="id_list" name="id_list" placeholder="ID List" min="0" value="<?=($this->session->flashdata('id_list_temp'))?$this->session->flashdata('id_list_temp'):NULL;?>">
						</div>
						<div class="form-group">
							<label for="keterangan">Keterangan</label>
							<input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Keterangan" value="<?=($this->session->flashdata('keterangan_temp'))?$this->session->flashdata('keterangan_temp'):NULL;?>">
						</div>
					</div>
					<div class="box-footer">
						<button type="submit" class="btn btn-primary btn-block" id="submit">Tambah</button>
					</div>
				</div>
			</form>

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