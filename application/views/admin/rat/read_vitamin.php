<script>
	$(document).ready(function(){
		$('#id_respon').val('<?=$id_respon;?>');

		if('<?=$bisa_respon;?>' == 'belum' || '<?=$bisa_respon;?>' == 'berakhir'){
			$('#id_respon').attr('disabled', true);
			$('#ket_respon').attr('disabled', true);
			$('#submit_respon').attr('disabled', true);
		}
	});
</script>