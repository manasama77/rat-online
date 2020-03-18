<script>
	$(document).ready(function(){
		$('#table').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autowidth'   : true,
      'scrollX'			: true,
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

	function editOM(id, group_list, id_list, keterangan)
	{
		let name_edit         = $('#name_edit');
		let id_e              = $('#id_e');
		let group_list_text_e = $('#group_list_text_e');
		let group_list_e      = $('#group_list_e');
		let id_list_e         = $('#id_list_e');
		let keterangan_e      = $('#keterangan_e');

		name_edit.text(keterangan);
		id_e.val(id).attr('readonly', true);
		group_list_text_e.val(group_list).attr('readonly', true);
		group_list_e.val(group_list);
		id_list_e.val(id_list).attr('readonly', true);
		keterangan_e.val(keterangan);

		$('#modal-edit').modal('show');

	}

	function deleteOM(id, keterangan)
	{
		let ask = confirm(`Delete ${keterangan}`);

		if(ask == true){
			window.location.replace(`<?=site_url();?>admin/list_kode/destroy/${id}`);
		}

	}
</script>