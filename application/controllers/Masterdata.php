<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Masterdata extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Default_md');
		$this->load->helper('form');
	}

	public function index(){
		$this->bahanMakanan();
	}

	function bahanMakanan(){
		if(isset($this->session->userdata['logged_in'])) {
			$data['title'] = "Pakar Diet - My Profile";
			$data['user_id'] = $this->session->userdata['logged_in']['user_id'];
			$data['username'] = $this->session->userdata['logged_in']['username'];
			$data['first_name'] = $this->session->userdata['logged_in']['first_name'];
			$data['last_name'] = $this->session->userdata['logged_in']['last_name'];
			$user_role = $this->session->userdata['logged_in']['user_role'];

			if(!empty($user_role) && $user_role == 'ROLE_ADMIN') {
				$data['admin_zone'] = true;
			} else {
				$data['admin_zone'] = false;
			}

			$user = $this->Default_md->getSingle("tb_user",array('user_id'=>$data['user_id']));
			$data['user'] = $user;
			$user_detail = $this->Default_md->getSingle("tb_user_detail",array('user_id'=>$data['user_id']));
			$data['user_detail'] = $user_detail;
			$hist_formpakar = $this->Default_md->getAll("tb_hist_formpakar",array('user_id'=>$data['user_id']));
			$data['hist_formpakar'] = $hist_formpakar;
			$bahan_olahan = $this->Default_md->getAll("tb_bahan",array('is_olahan'=>1, 'is_enabled'=>1));
			$data['bahan_olahan'] = $bahan_olahan;

			$this->load->view('template/header',$data);
			$this->load->view('masterdata/bahanmakanan/bahan-list',$data);
		} else {
			$flash_msg = array(
				'msg'	=> "<i class='fa fa-close'></i>&nbsp;Error, please login first",
				'type'	=> "danger"
			);
			$this->session->set_flashdata('handler_msg',$flash_msg);

			redirect(base_url().'login');
		}
	}

	function bahanMakananAdd(){
		if(isset($this->session->userdata['logged_in'])) {
			$data['title'] = "Pakar Diet - My Profile";
			$data['user_id'] = $this->session->userdata['logged_in']['user_id'];
			$data['username'] = $this->session->userdata['logged_in']['username'];
			$data['first_name'] = $this->session->userdata['logged_in']['first_name'];
			$data['last_name'] = $this->session->userdata['logged_in']['last_name'];
			$user_role = $this->session->userdata['logged_in']['user_role'];

			if(!empty($user_role) && $user_role == 'ROLE_ADMIN') {
				$data['admin_zone'] = true;
			} else {
				$data['admin_zone'] = false;
			}

			$user = $this->Default_md->getSingle("tb_user",array('user_id'=>$data['user_id']));
			$data['user'] = $user;
			$user_detail = $this->Default_md->getSingle("tb_user_detail",array('user_id'=>$data['user_id']));
			$data['user_detail'] = $user_detail;
			$data['formAdd'] = base_url()."Masterdata/bahanMakananAddHandler";

			$this->load->view('template/header',$data);
			$this->load->view('masterdata/bahanmakanan/bahan-add',$data);
		} else {
			$flash_msg = array(
				'msg'	=> "<i class='fa fa-close'></i>&nbsp;Error, please login first",
				'type'	=> "danger"
			);
			$this->session->set_flashdata('handler_msg',$flash_msg);

			redirect(base_url().'login');
		}
	}
}