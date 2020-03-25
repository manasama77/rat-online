<script>
	$(document).ready(function(){
		$('#table').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
      'autoWidth'   : false,
      'scrollX'			: false,
      'order'				: [[0, 'desc']],
      'columnDefs'	: 
			[
			{
				"targets": [1],
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

	function aktifkanOM(id, kode_rat, aktifkan)
	{
		let pesan = '';
		if(aktifkan == 'aktifkan'){
			pesan = 'Aktifkan ';
		}else{
			pesan = 'Non Aktifkan '
		}
		let ask = confirm(`${pesan} ${kode_rat} ?`);

		if(ask == true){
			window.location.replace(`<?=site_url();?>admin/rat/aktifkan/${id}/${aktifkan}`);
		}
	}

	function deleteOM(id, keterangan)
	{
		let ask = confirm(`Delete ${keterangan}`);

		if(ask == true){
			window.location.replace(`<?=site_url();?>admin/rat/destroy/${id}`);
		}

	}
</script>