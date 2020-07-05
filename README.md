# ci-datatables
CodeIgniter 3 datatables's Library

<br/>

## Deskripsi

Library untuk membuat Server Side datatables agar menjadi **mudah** dan **singkat**


Persyaratan:
* Codeigniter 3
* JQuery 3.3 +
* datatables 1.10+  (tersedia pada folder ```/application/assets/js/```)


Cara Instalasi:
* Taruh file datatables.php, (pada repositori ini terletak pada ```/application/libraries/Datatables.php```)
* Pada controller load dulu library ci-datatables ( ```$this->load->library('Datatables', 'datatables'); ```)

Untuk contoh:
* Bisa lihat file ```/application/controllers/Json.php```
* Bisa download / clone repositori ini untuk menjalankan demo pada lokal (Juga telah disediakan file .sql untuk diimport)
<br/>

## Dokumentasi

#### PHP (CodeIgniter)

1. **Select Table**\
  Memilih table default **$this->datatables->table(nama_table)** :
  ```php
  echo $this->datatables->table();
  ```
2. **Get All**\
  Memilih data pada semua kolom untuk ditampilkan **$this->datatables->draw()** :
  ```php
  echo $this->datatables->draw();
  ```
3. **Select Field**\
  Menampilkan data pada kolom yang dipilih **$this->datatables->select('table1, table2, tableN')** :
  ```php
  $this->datatables->select('id, name');
  echo $this->datatables->draw();
  ```
4. **Where Clause**\
  Menampilkan data yang telah ditentukan valuenya pada kolom teretentu **$this->datatables->where(array('field' => 'data')** :
  ```php
  $this->datatables->where(['field' => 'data']);
  echo $this->datatables->draw();
  ```
5. **Join Clause**\
  Memilih dan menggabungkan kolom dari table lain sesuai dengan kondisi yang telah ditentukan **$this->datatables->join(table, condition, type[optional])** :
  ```php
  $this->datatables->where('peoples', 'peoples.id = parent.user_id', 'INNER JOIN');
  echo $this->datatables->draw();
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
	table.datatables({
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
$this->datatables->where(['field1' => 'data1', 'field2' => 'data2', 'fieldN' => 'dataN']);
```
* Anda juga dapat melakukan select as dengan contoh sebagai berikut:
```php
$this->datatables->select('user.name as uname');
```
* Anda dapat menambahkan header agar data yang ditampilkan dapat dipastikan tipenya adalah JSON (optional) :
```php
header('Content-Type': 'application/json');
```
<br/>

## Author's Profile:

Github: [https://github.com/irsyadulibad]\
Website: [http://irsyadulibad.my.id]\
Facebook: [https://facebook.com/irsyadulibad.dev]
