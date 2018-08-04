<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CalorieCounter extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model(array('Default_md', 'CalorieCounter_md'));
		$this->load->helper('form');
	}

	public function index(){
		$this->penghitungKalori();
	}

	function penghitungKalori(){
		if(isset($this->session->userdata['logged_in'])) {
			$data['title'] = "Pakar Diet - Dashboard";
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

			$data['bahans'] = $this->CalorieCounter_md->getAllBahan(array('is_enabled'=>1, 'is_olahan'=>1));

			$this->load->view('template/header',$data);
			$this->load->view('calorie_counter',$data);
		} else {
			// set flashdata
			$flash_msg = array(
				'msg'		=> "<i class='fa fa-close'></i>&nbsp;Error, please login first",
				'type'	=> "danger"
			);
			$this->session->set_flashdata('handler_msg',$flash_msg);

			redirect(base_url().'login');
		}
	}
}