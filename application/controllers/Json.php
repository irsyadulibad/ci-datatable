<?php
defined('BASEPATH') OR exit('No Direct Script Access Allowed');

class Json extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->library('Datatables', 'datatables');
	}
	
	public function example1(){
/*
| Select semua data pada table
|
| $this->datatable->process('Nama Table');
*/
		header('Content-Type: application/json');
		echo $this->datatables->table('peoples')->draw();
	}
	
	public function example2(){
/*
| Filter Data
|
| $this->datatable->where(associative_array);
|
| Contoh dibawah ini untuk satu where saja
| WHERE `field` = data
|
| 		$this->datatable->where(['field' => 'value']);
|
| Contoh dibawah untuk dua where
| WHERE `field` = data AND `field2` = data2
|
| 		$this->datatable->where(['field' => 'value', 'field' => 'value'])
|
| Note: Fungsi ini hanya menerima parameter array assosiative
| 			Anda juga bisa memfilter banyak kolom sekaligus
|			dengan menambah elemen array
*/
		$this->datatables->table('peoples')->where(['id' => 3]);
		echo $this->datatables->draw();
	}
	
	public function example3(){
/*
| Select Kolom
| Fungsi ini hanya akan menampilkan data dari kolom yang ditulis
|
| $this->datatable->select('filed1, field2, fieldN');
|
| Note: Fungsi ini hanya menerima parameter string saja
| 			Jangan mengirim parameter selain string
*/
		$this->datatables->table('peoples')->select('id, name, address');
		echo $this->datatables->draw();
	}

	public function example4(){
/*
| Select As
*/
		$this->datatables->table('peoples as pe');
		$this->datatables->select('pe.id, pe.name as name, pa.name as parent');

/*
| Join Clause
| $this->datatables->join('table', 'condition', 'type')
| By default parameter type adalah null, anda bisa menambahkan INNER JOIN dll
*/
		$this->datatables->join('parents as pa', 'pe.id = pa.user_id');
		echo $this->datatables->draw();
	}
}
?>
