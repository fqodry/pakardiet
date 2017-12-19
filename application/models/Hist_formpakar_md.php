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

	function getHistFormPakar($user_id) {
		$query = "
			SELECT
				a.histform_id AS histform_id,
				a.berat_badan AS bb,
				b.bb_ideal AS bbideal,
				a.created_by AS createdBy,
				a.created_date AS createdDate
			FROM
				tb_hist_formpakar a
			JOIN tb_hist_formpakar_result b ON b.histform_id = a.histform_id
			WHERE
				a.user_id = '".$user_id."'";
		$result = $this->db->query($query);
		if($result->num_rows() == 1){
			return $result->row();
		}else{
			return false;
		}
	}
}