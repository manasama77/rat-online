<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>Penetapan Manual Ketua Sidang </h1>
</section>

<!-- Main content -->
<section class="content">

	<div class="row">

		<div class="col-md-6 col-sm-6 col-xs-12">

			<form action="<?=site_url('admin/rat/store_penetapan_manual');?>" method="post">
				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">Form Penetapan Ketua Sidang</h3>
					</div>
					<div class="box-body">
						<div class="form-group">
							<label for="id_anggota">Anggota</label>
							<select class="form-control" id="id_anggota" name="id_anggota" required>
								<option value=""></option>
								<?php
								foreach ($arr_anggota->result() as $key) {
									echo '<option value="'.$key->id.'">'.$key->nama.'</option>';
								}
								?>
							</select>
						</div>
					</div>
					<div class="box-footer">
						<input type="text" id="id_rat" name="id_rat" value="<?=$id_rat;?>">
						<button type="submit" class="btn btn-primary btn-block" id="submit">Pilih Ketua Sidang</button>
						<a href="<?=site_url('admin/rat');?>" class="btn btn-default btn-block">Kembali Ke List RAT</a>
					</div>
				</div>
			</form>

		</div>

	</div>

</section>
<!-- /.content -->