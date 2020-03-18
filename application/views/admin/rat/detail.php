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
				<div class="box-body">
					<div class="row">
						<div class="col-md-8 col-sm-12">
							<h4 class="text-left">Kata Pengantar</h4>
						</div>
						<div class="col-md-4 col-sm-12">
							<h4 class="text-center">Berkas Laporan RAT</h4>
						</div>
					</div>
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