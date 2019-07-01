# ci-datatable
CodeIgniter Datatable's Library

<br/>

## Deskripsi

Library untuk membuat Server Side Datatable agar menjadi **mudah** dan **singkat**


Persyaratan:
* Codeigniter 3
* JQuery 3.3 +
* Datatable 1.10+  (tersedia pada folder ```/application/assets/js/```)


Cara Instalasi:
* Taruh file datatable.php, (pada repositori ini terletak pada ```/application/libraries/datatable.php```)
* Pada controller load dulu library ci-datatable ( ```$this->load->library('datatable'); ```)

Untuk contoh:
* Bisa lihat file ```/application/controllers/Json.php```
* Bisa download / clone repositori ini untuk menjalankan demo pada lokal (Juga telah disediakan file .sql untuk diimport)
<br/>

## Dokumentasi

#### PHP (CodeIgniter)

1. **Get All**\
  Memilih data pada semua kolom untuk ditampilkan **$this->datatable->process(nama_table)** :
  ```php
  echo $this->datatable->process($table);
  ```
2. **Select Field**\
  Menampilkan data pada kolom yang dipilih **$this->datatable->select('table1, table2, tableN')** :
  ```php
  $this->datatable->select('id, name');
  echo $this->datatable->process($table);
  ```
3. **Where Clause**\
  Menampilkan data yang telah ditentukan valuenya pada kolom teretentu **$this->datatable->where(array('field' => 'data')** :
  ```php
  $this->datatable->where(['field' => 'data']);
  echo $this->datatable->process($table);
  ```
<br/>

#### HTML (Struktur Tabel)
```html
<div id="base-url" data-url="<?= base_url(); ?>"></div>
<table class="table table-bordered" id="table-example3" data-url="<?= base_url('json/example3'); ?>">
	<thead>
		<th>Name</th>
		<th>Address</th>
		<th>Action</th>
	</thead>
	<tbody>
	</tbody>
</table>
```
<br/>

#### Javascript (JQuery)
Untuk menampilkan data dari struktur tabel pada kode HTML di atas :
```javascript
$(document).ready(function(){
	var baseUrl = $('#base-url').data('url'); //Mengambil data value base_url dri elemen html
	var table = $('#table-example3');
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
			{'data': 'address'}, //Tampilkan Address
			{'render': function(data, type, row){ //Tampilkan kolom Action
				var html = '<a class="btn btn-sm badge-success float-left mr-2" href="' + baseUrl + 'edit/' + row.id + '">Edit</a>';
				html += '<a class="btn btn-sm badge-danger float-left" href="' + baseUrl + 'delete/' + row.id + '">Delete</a>';
				return html;
				}
			}
		]
	});
});
```
Untuk melihat contoh lain silahkan clone/download repositori ini untuk dijalankan pada lokal. Telah disediakan 3 contoh tabel  yang berbeda

<br/>

#### Catatan
* Anda juga dapat menambahkan clausa *AND WHERE* dengan menambahkan elemen array:
```php
$this->datatable->where(['field1' => 'data1', 'field2' => 'data2', 'fieldN' => 'dataN']);
```
* Anda dapat menambahkan header agar data yang ditampilkan dapat dipastikan tipenya adalah JSON (optional) :
```php
header('Content-Type': 'application/json');
```
<br/>

## Author's Profile:

Github: [https://github.com/irsyadulibad]\
Website: [http://irsyadulibad.cf] (if it's still available)\
Facebook: [https://facebook.com/irsyadulibad.dev]
