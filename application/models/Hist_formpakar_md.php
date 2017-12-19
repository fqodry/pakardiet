<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hist_formpakar_md extends CI_Model {

	public function __construct() {
		parent::__construct();
		$this->table = 'tb_hist_formpakar';
	}

	function maxId(){
		$this->db->select_max('id');
		$query = $this->db->get($this->table);
		if($query->num_rows() == 1){
			return $query->row();
		}else{
			return false;
		}
	}
}