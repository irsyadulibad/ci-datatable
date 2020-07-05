$(document).ready(function(){
	var baseUrl = $('#base-url').data('url'); //Mengambil data value base_url dri elemen html
	var table = $('#table-example4');
	table.DataTable({
		'processing': true,
		'serverSide': true,
		'ordering': true, //set true agar bisa sorting
		'order': [[0, 'asc']], //default sortingnya berdasarkan field ke 0 (pertama)
		'ajax': {
			'url': table.data('url'), //URL untuk ambil JSON
			'type': 'post'
		},
		'deferRender': true,
		'aLengthMenu': [[5, 10, 50], [5, 10, 50]], //Combobox Limit
		'columns': [
			{'data': 'name'}, //Tampilkan Name
			{'data': 'parent'}, //Tampilkan Address
			{'render': function(data, type, row){ //Tampilkan kolom Action
				var html = '<a class="btn btn-sm badge-success float-left mr-2" href="' + baseUrl + 'edit/' + row.id + '">Edit</a>';
				html += '<a class="btn btn-sm badge-danger float-left" href="' + baseUrl + 'delete/' + row.id + '">Delete</a>';
				return html;
				}
			}
		]
	});
});
