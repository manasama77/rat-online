<script>
	$(document).ready(function(){
		$('#id_respon').val('<?=$id_respon;?>');

		if('<?=$bisa_respon;?>' == 'belum' || '<?=$bisa_respon;?>' == 'berakhir' || '<?=$this->session->userdata(UNQ.'id_jabatan');?>' == '0' || '<?=$this->session->userdata(UNQ.'id_jabatan');?>' == '1'){
			$('#id_respon').attr('disabled', true);
			$('#ket_respon').attr('disabled', true);
			$('#submit_respon').attr('disabled', true);
		}
	});
</script>