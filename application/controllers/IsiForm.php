<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class IsiForm extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Default_md');
	}

	public function index(){
		$this->isiForm();
	}

	function isiForm(){
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
			$data['form_pakar'] = base_url() . "isiform/formpakarHandler";
			$data['jobs'] = $this->Default_md->getAll('m_pekerjaan');

			$this->load->view('template/header',$data);
			$this->load->view('isiform',$data);
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

	function formpakarHandler() {
		$this->load->library('form_validation');
		// $rules = array(
		// 	array(
		// 		'field'	=> 'beratbadan',
		// 		'label'	=> 'Berat Badan',
		// 		'rules'	=> 'trim|required|xss_clean|decimal'
		// 	),
		// 	array(
		// 		'field'	=> 'tinggibadan',
		// 		'label'	=> 'Tinggi Badan',
		// 		'rules'	=> 'trim|required|xss_clean|decimal'
		// 	),
		// 	array(
		// 		'field'	=> 'usia',
		// 		'label'	=> 'Usia',
		// 		'rules'	=> 'trim|required|xss_clean|decimal'
		// 	),
		// 	array(
		// 		'field'	=> 'jeniskelamin',
		// 		'label'	=> 'Jenis Kelamin',
		// 		'rules'	=> 'trim|required|xss_clean'
		// 	),
		// 	array(
		// 		'field'	=> 'pekerjaan',
		// 		'label'	=> 'Pekerjaan',
		// 		'rules'	=> 'trim|required|xss_clean'
		// 	)
		// );
		// $this->form_validation->set_rules($rules);

		// if($this->form_validation->run() == FALSE){
		// 	if(isset($this->session->userdata['logged_in'])) {
		// 		// set flashdata
		// 		$flash_msg = array(
		// 			'msg'	=> validation_errors(),
		// 			'type'	=> "danger"
		// 		);
		// 		$this->session->set_flashdata('handler_msg',$flash_msg);
		// 		redirect(base_url().'login');
		// 	} else {
		// 		// set flashdata
		// 		$flash_msg = array(
		// 			'msg'	=> validation_errors(),
		// 			'type'	=> "danger"
		// 		);
		// 		$this->session->set_flashdata('handler_msg',$flash_msg);

		// 		redirect(base_url().'isiform');
		// 	}
		// } else {
			$beratbadan = $this->input->post('beratbadan');
			$tinggibadan = $this->input->post('tinggibadan');
			$usia = $this->input->post('usia');
			$jeniskelamin = $this->input->post('jeniskelamin');
			$pekerjaan = $this->input->post('pekerjaan');

			$bbideal = ( (int)$tinggibadan - 100 ) * (10/100);

			echo "bb ideal kamu = ".$bbideal." kg";
		// }
	}


}
