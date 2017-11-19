<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct(){
		parent::__construct();
	}

	public function index() {
		$this->login();
	}

	function login(){
		if(isset($this->session->userdata['logged_in'])) {
			redirect(base_url().'welcome');
		} else {
			$data['title'] = "Sistem Pakar Diet";

			$data['form_login'] = base_url() . 'login/loginProcess';
			$data['form_register'] = base_url() . 'registerProcess';

			$this->load->view('login',$data);
		}
	}

	/**
	*	LOGIN PROCESS AND LOGOUT	
	*/
	function loginProcess(){
		// load bcrypt library
		$this->load->library(array('bcrypt','form_validation'));
		$this->load->model('Default_md');

		// set rules for validation
		$rules = array(
			array(
				'field'	=> 'username',
				'label'	=> 'Username',
				'rules'	=> 'trim|required|max_length[20]'
			),
			array(
				'field'	=> 'password',
				'label'	=> 'Password',
				'rules'	=> 'trim|required|min_length[3]|xss_clean'
			)
		);
		$this->form_validation->set_rules($rules);
		$this->form_validation->set_message('min_length', 'Password minimal 3 karakter.');
		$this->form_validation->set_message('max_length','Username tidak lebih dari 20 karakter.');

		// check if validation run, then check password
		if($this->form_validation->run() == FALSE){
			if(isset($this->session->userdata['logged_in'])) {
				redirect(base_url().'login');
			} else {
				// set flashdata
				$flash_msg = array(
					'msg'		=> validation_errors(),
					'type'	=> "danger"
				);
				$this->session->set_flashdata('handler_msg',$flash_msg);

				redirect(base_url().'login');
			}
		} else {
			$userpwd = $this->input->post('password');
			$userdb = $this->Default_md->getSingle('tb_user',array('username'=>$this->input->post('username'), 'is_enabled'=>1));

			//check input password with password stored on DB, if true go on (set session data, set userdata, redirect to member page) else if false go to login form with error notif 'Invalid email or password'
			if($this->bcrypt->check_password($userpwd,$userdb->password) == TRUE){
				$session_data = array(
					'user_id'		=> $userdb->user_id,
					'username'		=> $userdb->username,
					'is_enabled'	=> $userdb->is_enabled
				);
				// add user data in session
				$this->session->set_userdata('logged_in',$session_data);

				// set flashdata
				$flash_msg = array(
					'msg'		=> "<i class='fa fa-check'></i>&nbsp;Log In Successful",
					'type'	=> "success"
				);
				$this->session->set_flashdata('handler_msg',$flash_msg);
				redirect(base_url().'welcome');
			} else {
				// set flashdata
				$flash_msg = array(
					'msg'		=> "<i class='fa fa-close'></i>&nbsp;<strong>Error: </strong>Invalid Username or Password",
					'type'	=> "danger"
				);
				$this->session->set_flashdata('handler_msg',$flash_msg);
				redirect(base_url().'login');
			}
		}
	}

	function logout() {
		// removing session data
		$sess_array = array(
			'username'	=> ''
		);
		$this->session->unset_userdata('logged_in',$sess_array);

		// clear current session
		// $this->session->sess_destroy();

		// set flashdata
		$flash_msg = array(
			'msg'		=> "<i class='fa fa-check'></i>&nbsp;Logout successful",
			'type'	=> "success"
		);
		$this->session->set_flashdata('handler_msg',$flash_msg);

		redirect(base_url().'login');
	}

	function registerProcess(){
		
	}
}
