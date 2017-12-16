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
		$rules = array(
			array(
				'field'	=> 'beratbadan',
				'label'	=> 'Berat Badan',
				'rules'	=> 'trim|required|xss_clean'
			),
			array(
				'field'	=> 'tinggibadan',
				'label'	=> 'Tinggi Badan',
				'rules'	=> 'trim|required|xss_clean'
			),
			array(
				'field'	=> 'usia',
				'label'	=> 'Usia',
				'rules'	=> 'trim|required|xss_clean'
			),
			array(
				'field'	=> 'jeniskelamin',
				'label'	=> 'Jenis Kelamin',
				'rules'	=> 'trim|required|xss_clean'
			),
			array(
				'field'	=> 'aktifitas',
				'label'	=> 'Aktifitas',
				'rules'	=> 'trim|required|xss_clean'
			)
		);
		$this->form_validation->set_rules($rules);

		if($this->form_validation->run() == FALSE){
			if(isset($this->session->userdata['logged_in'])) {
				// set flashdata
				$flash_msg = array(
					'msg'	=> validation_errors(),
					'type'	=> "danger"
				);
				$this->session->set_flashdata('handler_msg',$flash_msg);
				redirect(base_url().'isiform');
			} else {
				// set flashdata
				$flash_msg = array(
					'msg'	=> validation_errors(),
					'type'	=> "danger"
				);
				$this->session->set_flashdata('handler_msg',$flash_msg);

				redirect(base_url().'isiform');
			}
		} else {
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

			(float)$beratbadan = $this->input->post('beratbadan');
			$data['beratbadan'] = $beratbadan;
			(float)$tinggibadan = $this->input->post('tinggibadan');
			$data['tinggibadan'] = $tinggibadan;
			(int)$usia = $this->input->post('usia');
			$data['usia'] = $usia;
			$jeniskelamin = $this->input->post('jeniskelamin');
			$data['jeniskelamin'] = $jeniskelamin;
			$aktifitas = $this->input->post('aktifitas');
			$data['aktifitas'] = $aktifitas;

			// HITUNG BB IDEAL
			(float)$bbideal = ( (int)$tinggibadan - 100 ) - (10/100);
			$data['bbideal'] = $bbideal;
			$data['bbideal_lbs'] = $bbideal*2.2046226218;

			// HITUNG IMT
			(float)$imt = (int)$beratbadan / pow(((int)$tinggibadan/100), 2);
			$data['imt'] = $imt;

			// HITUNG KEBUTUHAN KALORI
			switch($jeniskelamin){
				case 'M':
					(float)$kebutuhan_kalori = 65 + (13.7 * (float)$bbideal) + (5 * (int)$tinggibadan) - (6.8 * (int)$usia);
					break;
				case 'F':
					(float)$kebutuhan_kalori = 655 + (9.6 * (float)$bbideal) + (1.8 * (int)$tinggibadan) - (4.7 * (int)$usia);
					break;
			}
			$data['kebutuhan_kalori'] = $kebutuhan_kalori;

			// KETERANGAN2
			$bb_ket = "tidak ada keterangan";
			if($imt < 18.5){
				$bb_ket = "Berat Badan Kurang";
			}elseif($imt >= 18.5 && $imt <= 24.9) {
				$bb_ket = "Berat Badan Ideal";
			}elseif($imt >= 25 && $imt <= 29.9) {
				$bb_ket = "Berat Badan Lebih";
			}elseif($imt >= 30 && $imt <=39.9) {
				$bb_ket = "Gemuk";
			}else{
				$bb_ket = "Sangat Gemuk";
			}
			$data['bb_ket'] = $bb_ket;

			$histform_id = $this->generateFormId();
			// input form data
			$data_form = array(
				'histform_id' 	=> $histform_id,
				'user_id' 		=> $data['user_id'],
				'berat_badan' 	=> $beratbadan,
				'tinggi_badan' 	=> $tinggibadan,
				'usia' 			=> $usia,
				'jenis_kelamin'	=> $jeniskelamin,
				'job' 			=> $aktifitas,
				'created_by' 	=> $data['username']
			);
			$this->Default_md->add('tb_hist_formpakar',$data_form);

			// input form result data
			$data_result = array(
				'histform_id' 		=> $histform_id,
				'bb_ideal' 			=> $bbideal,
				'imt' 				=> $imt,
				'kebutuhan_kalori' 	=> $kebutuhan_kalori,
				'created_by' 		=> $data['username']
			);
			$this->Default_md->add('tb_hist_formpakar_result',$data_result);

			$this->load->view('template/header',$data);
			$this->load->view('hitungkalori',$data);
		}
	}

	function generateFormId() {
		$this->load->model('Hist_formpakar_md');
		$max_id = $this->Hist_formpakar_md->maxId();
		$next_id = $max_id->id + 1;
		$next_formid = "FP".str_pad($next_id, 4, '0', STR_PAD_LEFT);
		return $next_formid;
	}
}
