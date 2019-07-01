$(document).ready(function(){
$('#peoples-table').DataTable({
	'processing': true,
	'serverSide': true,
	'ordering': true,
	'order': [[0, 'asc']],
	'ajax': {
		'url': 'http://192.168.43.133:8003/ss-datatables/table/data',
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