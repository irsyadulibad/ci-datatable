<?php
/*

* Library for Server Side Datatable
* CodeIgniter Framework
* Code by: Ahmad Irsyadul Ibad
* Website: http://irsyadulibad.cf (if still available)
* Github: https://github.com/irsyadulibad
* Documentation is only available in Indonesian language :D

<===========================================================================>

~ Silahkan dikembangkan agar library ini dapat membantu bagi semua pengguna CodeIgniter
~ J A N G A N  L U P A  B E R K A R Y A ~

*/
class datatable{
//	Untuk menyimpan nama table
	private $table;
	

//	Untuk menyimpan nama - nama kolom
	private $where_fields = [];
//	Untuk menyimpan data - data yang diperlukan untuk query where
	private $where_data = null;

//	Dua variabel diatas hanya diisi ketika fungsi where dijalankan

/*
| Fungsi untuk mengambil instansiasi CodeIgniter
*/
	private function _ci(){
		//Mengambil Instansisasi CodeIgniter
		return get_instance();
	}
/*
| -------------------------------------------------------------
|		Select-Function
| Fungsi untuk memilih kolom mana saja yang ingin ditampilkan
|
| Note: Fungsi ini hanya menerima string sebagai parameternya
|			Dilarang mengirimkan parameter selain string
*/
	public function select(string $data){
		$this->_ci()->db->select($data);
	}
/*
| -------------------------------------------------------------
|		Where-Function
|	Fungsi untuk memfilter data sesuai nama field
| dan data yang diinginkan
|
| Note: Fungsi ini hanya menerima array sebagai parameternya
|			Dilarang mengirimkan parameter selain array
*/
	public function where(array $data){
//		Looping tiap - tiap nama field dan value
		foreach($data as $field => $val){
			$this->_ci()->db->where($field, $val);
//		Mengirimkan nama - nama kolom pada variabel
			$this->where_fields[] = $field;
		}
//		Mengirimkan data - data kolom dan valuenya pada variabel
		$this->where_data = $data;
	}
	
	public function process($table){
		$this->table = $table;
		$ci = $this->_ci();
		//Ambil data yang diketik user pada textbox
		$search = htmlspecialchars($ci->input->post('search')['value']);
		//Ambil data limit per halaman
		$limit = $ci->input->post('length', true);
		//Ambil data Start
		$start = $ci->input->post('start', true);
		
		//Mendapatkan seluruh nama fields pada table
		$fields = $ci->db->list_fields($this->table);
		$i = 0;
		// Ordering agar query like tidak bercampur dengan query where
		$ci->db->group_start();
		//Mencari keyword yang diketikan user
		foreach($fields as $field){
			$where = false;
			foreach($this->where_fields as $data){
			/*
				Mengecek apakah ada nama kolom yang sama
			dengan kolom yang diset sebagai filter data
			*/
				if($field == $data) $where = true;
			}
			/*
			Jika where ternyata benar, maka looping langsung lanjut
			Jika ternyata salah, maka lanjutkan kepada query like
			*/
			if($where == true) continue;
			if($i < 1){
				$ci->db->like($field, $search);
			}else{
				$ci->db->or_like($field, $search);
			}
			$i++;
		}
		$ci->db->group_end();
/*
| -------------------------------------------------------------
| 	$order_field menerima post dari datatable kolom mana
| yang akan diurutkan
|
| 	$order_ascdsc menerima post dari datatable untuk menentukan
| jenis sorting, apakah ASC atau DESC
|
| 	$results untuk menampung data hasil query yang telah dilakukan
| dari atas tadi
*/
		$order_field = $ci->input->post('order')[0]['column'];
		$order_ascdsc = $ci->input->post('order')[0]['dir'];
		$ci->db->order_by($ci->input->post('columns', true)[$order_field]['data'], $order_ascdsc);
		$results = $ci->db->get($this->table, $limit, $start)->result_array();
/*
| -------------------------------------------------------------
| Note: Kode dibawah untuk mengulangi lagi query agar bisa diambil
|			hasil filter
*/
		$ci->db->group_start();
		foreach($fields as $field){
			$where = false;
			foreach($this->where_fields as $data){
				if($field == $data) $where = true;
			}
			if($where) continue;
			if($i < 1){
				$ci->db->like($field, $search);
			}else{
				$ci->db->or_like($field, $search);
			}
			$i++;
		}
		$ci->db->group_end();
/*
| 	Cek dulu apakah fungsi where dijalankan
|
| Jika fungsi where dijalankan maka query builder yang dipakai adalah get_where()
| Jika tidak, query builder yang dipakai get() saja
*/
		if(count($this->where_fields) > 0){
			$filter_count = $ci->db->get_where($this->table, $this->where_data)->num_rows();
		}else{
			$filter_count = $ci->db->get($this->table)->num_rows();
		}
/*
| Note: $filter_count berisi jumlah data yang difilter
|			$total berisi total seluruh data yang ditampilkan
*/
		if(count($this->where_fields) > 0){
			$total = $ci->db->get_where($this->table, $this->where_data)->num_rows();
		}else{
			$total = $ci->db->get($this->table)->num_rows();
		}
/*
| -------------------------------------------------------------
| Menyiapkan data - data yang dibutuhkan untuk datatable
*/
		$callback = [
			'draw' => $ci->input->post('draw'),
			'recordsTotal' => $total,
			'recordsFiltered' => $filter_count,
			'data' => $results
		];
/*
| -------------------------------------------------------------
| Mengembalikan hasil array menjadi json
*/
		return json_encode($callback);
	}
}
?>