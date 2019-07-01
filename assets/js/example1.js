$(document).ready(function(){
	var table = $('#table-example1');
	table.DataTable({
		'processing': true,
		'serverSide': true,
		'ordering': true,
		'order': [[0, 'asc']],
		'ajax': {
			'url': table.data('url'),
			'type': 'post'
		},
		'deferRender': true,
		'aLengthMenu': [[5, 10, 50], [5, 10, 50]],
		'columns': [
			{'data': 'name'},
			{'data': 'email'},
			{'data': 'address'}
		]
	});
});