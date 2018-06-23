<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class UserQuestion_md extends CI_Model {

	public function __construct() {
		parent::__construct();
		$this->table = 'tb_rulebase AS a';
	}

	function getRulebase($conditions=array()){
		$this->db->select('a.rulebase_id AS rulebase_id, 
			a.k_in AS k_in, 
			a.k_process AS k_process, 
			a.k_out AS k_out, b.question AS k_out_question, 
			a.k_from AS k_from, 
			a.is_finale AS is_finale, a.act_result AS act_result');
		$this->db->from($this->table);
		$this->db->join('m_kegiatan AS b', 'b.code = a.k_out', 'inner');
		$this->db->where($conditions);
		$this->db->limit(1);
		$query=$this->db->get();
		if($query->num_rows() == 1){
			return $query->row();
		}else{
			return false;
		}
	}

	function getRulebaseFinal($conditions=array()){
		$this->db->select('a.rulebase_id AS rulebase_id, 
			a.k_in AS k_in, 
			a.k_process AS k_process, 
			a.k_out AS k_out, 
			a.k_from AS k_from, 
			a.is_finale AS is_finale, a.act_result AS act_result,
			b.act_name AS act_name, b.description AS act_description');
		$this->db->from($this->table);
		$this->db->join('m_aktifitas AS b', 'b.act_id = a.act_result', 'inner');
		$this->db->where($conditions);
		$this->db->limit(1);
		$query=$this->db->get();
		if($query->num_rows() == 1){
			return $query->row();
		}else{
			return false;
		}
	}
}