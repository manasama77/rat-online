<script>
	$(document).ready(function(){
		if(<?=$sudah_polling;?> > 0){
			$('#id_anggota').attr('disabled', true);
			$('#submit_polling').attr('disabled', true);
		}
	});

	function deleteOM(id, id_rat, nama_file)
	{
		let c = confirm(`Hapus Berkas ${nama_file} ?`);

		if(c == true){
			window.location.replace(`<?=site_url();?>admin/rat/delete_file/${id_rat}/${id}`);
		}

	}

	function uploadOM(id)
	{
		$('#id_rat_upload').val(id);
		$('#modal-upload').modal('show');
	}
</script>