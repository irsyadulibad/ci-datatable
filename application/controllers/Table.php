<?php
defined('BASEPATH') OR exit('No Direct Script Access Allowed');

class Table extends CI_Controller{
	
	public function index(){
		$data['title'] = 'Server Side Datatables | Example 01';
		
		$this->load->view('templates/header', $data);
		$this->load->view('table/index', $data);
		$this->load->view('templates/footer');
	}
	
	public function example2(){
		$data['title'] = 'Server Side Datatables | Example 02';
		
		$this->load->view('templates/header', $data);
		$this->load->view('table/example2', $data);
		$this->load->view('templates/footer');
	}
	
	public function example3(){
		$data['title'] = 'Server Side Datatables | Example 03';
		
		$this->load->view('templates/header', $data);
		$this->load->view('table/example3', $data);
		$this->load->view('templates/footer');
	}

	public function example4(){
		$data['title'] = 'Server Side Datatables | Example 04';
		
		$this->load->view('templates/header', $data);
		$this->load->view('table/example4', $data);
		$this->load->view('templates/footer');
	}
}
?>
