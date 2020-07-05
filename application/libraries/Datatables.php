<?php
/*

* Server Side Datatable Library For CodeIgniter 3
* CodeIgniter Framework
* Code by: Ahmad Irsyadul Ibad
* Website: http://irsyadulibad.my.id
* Github: https://github.com/irsyadulibad
* Documentation is only available in Indonesian language :D

<===========================================================================>

~ Silahkan dikembangkan agar library ini dapat membantu bagi semua pengguna CodeIgniter
~ J A N G A N  L U P A  B E R K A R Y A ~

*/
class Datatables{
	private $db;
	private $input;
	private $table;
	private $alias = [];
	private $whereFields = [];
	private $whereData;
	private $joins = [];

	public function __construct(){
		$ci = &get_instance();
		$this->db = $ci->db;
		$this->input = $ci->input;
	}

	public function table($table){
		$this->table = $table;
		return $this;
	}

	public function select($fields){
		$this->db->select($fields);
		$this->set_alias($fields);
		return $this;
	}

	public function where($data){
		$this->db->where($data);
		foreach($data as $field => $value){
			$this->whereFields[] = $field;
		}
		$this->whereData = $data;
		return $this;
	}

	public function join($table, $cond, $type = ''){
		$this->joins[] = ['table' => $table, 'cond' => $cond, 'type' => $type];
		$this->db->join($table, $cond, $type);
		return $this;
	}

	public function draw(){
		$keyword = $this->input->post('search')['value'];
		if(!is_null($keyword)) $this->get_filtering($keyword);
		$this->get_ordering();
		$result = $this->get_result();
		$paging = $this->get_paging($keyword);

		return json_encode([
			'draw' => $this->input->post('draw'),
			'recordsTotal' => $paging['total'],
			'recordsFiltered' => $paging['filtered'],
			'data' => $result
		]);
	}

	private function set_alias($data){
		foreach(explode(',', $data) as $val){
			if(stripos($val, 'as')){
				$alias = trim(preg_replace('/(.*)\s+as\s+(\w*)/i', '$2', $val));
				$field = trim(preg_replace('/(.*)\s+as\s+(\w*)/i', '$1', $val));
				$this->alias[$alias] = $field;
			}
		}
	}

	private function do_join(){
		foreach($this->joins as $join){
			$this->db->join($join['table'], $join['cond'], $join['type']);
		}
	}

	private function get_filtering($keyword){
		$fields = $this->input->post('columns');

		$this->db->group_start();
		for($i = 0; $i < count($fields); $i++){
			$where = false;
			$field = $fields[$i]['data'];
			foreach($this->whereFields as $data){
				$where = ($field == $data) ? true : false;
			}
			if($where) continue;
			if(array_key_exists($field, $this->alias)){
				$field = $this->alias[$field];
				($i < 1) ? $this->db->like($field, $keyword) : $this->db->or_like($field, $keyword);
			}else{
				($i < 1) ? $this->db->like($field, $keyword) : $this->db->or_like($field, $keyword);
			}
		}
		$this->db->group_end();
	}

	private function get_ordering(){
		$orderField = $this->input->post('order')[0]['column'];
		$orderAD = $this->input->post('order')[0]['dir'];
		$orderColumn = $this->input->post('columns')[$orderField]['data'];
		$this->db->order_by($orderColumn, $orderAD);
	}

	private function get_result(){
		$this->get_limiting();
		return $this->db->get($this->table)->result_array();
	}

	private function get_limiting(){
		$limit = $this->input->post('length', true);
		$start = $this->input->post('start', true);
		$this->db->limit($limit, $start);
	}

	private function get_paging($keyword){
		if(count($this->joins) > 0) $this->do_join();
		if(!is_null($this->whereData)) $this->where($this->whereData);
		$total = $this->db->count_all_results($this->table);

		if(count($this->joins) > 0) $this->do_join();
		if(!is_null($this->whereData)) $this->where($this->whereData);

		return [
			'total' => $total,
			'filtered' => $this->db->get($this->table)->num_rows()
		];
	}
}
