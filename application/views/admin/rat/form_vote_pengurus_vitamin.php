<script>
	$(document).ready(function(){
		if(<?=$sudah_polling;?> > 0){
			$('#id_ketua_pengurus').attr('disabled', true);
			$('#id_sekertaris').attr('disabled', true);
			$('#id_bendahara').attr('disabled', true);
			$('#submit_polling').attr('disabled', true);
		}

		if('<?=$this->session->userdata(UNQ.'id_jabatan');?>' == '0' || '<?=$this->session->userdata(UNQ.'id_jabatan');?>' == '1'){
			$('#id_ketua_pengurus').attr('disabled', true);
			$('#id_sekertaris').attr('disabled', true);
			$('#id_bendahara').attr('disabled', true);
			$('#submit_polling').attr('disabled', true);
		}

	});
</script>