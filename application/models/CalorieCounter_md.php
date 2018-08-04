<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CalorieCounter_md extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	function getAllBahan($conditions=array()){
		$this->db->select('*');
		$this->db->from('tb_bahan');
		$this->db->where($conditions);
		$this->db->order_by('bahan_name','asc');
		$query=$this->db->get();
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
	}
}