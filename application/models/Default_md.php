<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Default_md extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	function getAll($tablename,$conditions=array()){
		$this->db->select('*');
		$this->db->where($conditions);
		$query=$this->db->get($tablename);
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
	}

	function getSingle($tablename,$conditions=array()){
		$this->db->select('*');
		$this->db->where($conditions);
		$this->db->limit(1);
		$query=$this->db->get($tablename);
		if($query->num_rows() == 1){
			return $query->row();
		}else{
			return false;
		}
	}

	function add($tablename,$data=array()){
		$this->db->insert($tablename,$data);
	}

	function edit($tablename,$conditions=array(),$data=array()){
		$this->db->where($conditions);
		$this->db->update($tablename,$data);
	}

	function delete($tablename,$conditions=array()){
		$this->db->where($conditions);
		$this->db->delete($tablename);
	}
}