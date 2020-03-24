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

	function bukaRAT(id, kode_rat)
	{
		let ask = confirm(`Buka RAT ${kode_rat} & Tetapkan Ketua Sidang berdasarkan Vote ?`);

		if(ask == true){
			window.location.replace(`<?=site_url();?>admin/rat/penetapan/${id}/${kode_rat}`);
		}

	}
</script>