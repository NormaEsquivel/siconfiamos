$(document).ready(function(){
		// Call template init (optional, but faster if called manually)
		$.template.init();

		// Table sort - DataTables
		var table = $('#sorting-advanced');
		table.dataTable({
			"oLanguage": {
		    	"sProcessing": "Procesando",
				"sSearch": "Buscar:",
				"sZeroRecords": "No hay carros",
				"sLengthMenu": "Mostrar _MENU_ clientes",
				"sInfo": "Mostrando clientes del _START_ al _END_ de _TOTAL_",
				"oPaginate": {
					"sPrevious": "Anterior",
					"sNext": "Siguiente"					
				}
			},
			'aoColumnDefs': [
				{ 'bSortable': false, 'aTargets': [ 2] }
			],
			'sPaginationType': 'two_button',
			'sDom': '<"dataTables_header"lfr>t<"dataTables_footer"ip>',
			'fnInitComplete': function( oSettings )
			{
				// Style length select
				table.closest('.dataTables_wrapper').find('.dataTables_length select').addClass('select blue-gradient glossy').styleSelect();
				tableStyled = true;
			}
		});
});