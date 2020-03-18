<script>
	$(document).ready(function(){
		$('#table').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true,
      'scrollX'			: false,
      'order'				: [[0, 'desc']],
      'columnDefs'	: 
			[
			{
				"targets": [1, 2],
				"orderable": false,
				"class": 'text-center'
			},
			{
				"targets": [0],
				"class": 'text-center'
			}
			]
    });
	});

	function deleteOM(id, nama)
	{
		let ask = confirm(`Delete ${nama}`);

		if(ask == true){
			window.location.replace(`<?=site_url();?>admin/anggota/destroy/${id}`);
		}

	}

	function resetOM(id, nama)
	{
		$('#name_reset').text(nama);
		$('#id_anggota_reset').val(id);
		$('#modal-reset').modal('show');
	}
</script>