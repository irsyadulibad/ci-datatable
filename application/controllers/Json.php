<?php
defined('BASEPATH') OR exit('No Direct Script Access Allowed');

class Json extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->library('datatable');
	}
	
	public function example1(){
/*
| Select semua data pada table
|
| $this->datatable->process('Nama Table');
*/
		header('Content-Type: application/json');
		echo $this->datatable->process('peoples');
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
		$this->datatable->where(['id' => 3]);
		echo $this->datatable->process('peoples');
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
		$this->datatable->select('id, name, address');
		echo $this->datatable->process('peoples');
	}
}
?>