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

			//get last Kode Bahan
			$max_id = $this->Default_md->maxId("tb_bahan");
			$next_id = (int)$max_id->id + 1;
			$data['kode_bahan'] = "BAH" . str_pad($next_id, 4, '0', STR_PAD_LEFT);

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

	function bahanMakananAddHandler(){
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

			$kode_bahan = $this->input->post('bahanCode');
			$nama_bahan = $this->input->post('bahanName');
			$urt_bahan = $this->input->post('bahanUrt');
			$berat_bahan = $this->input->post('bahanWeight');
			$kalori_bahan = $this->input->post('bahanCalories');
			$protein_bahan = $this->input->post('bahanProtein');
			$lemak_bahan = $this->input->post('bahanFat');
			$karbo_bahan = $this->input->post('bahanCarbo');

			if(empty($kode_bahan) || empty($nama_bahan) || empty($urt_bahan) || empty($berat_bahan) || empty($kalori_bahan)){
				$flash_msg = array(
					'msg'		=> "<i class='fa fa-close'></i>&nbsp;Oops, tolong isi semua field yang wajib diisi.",
					'type'	=> "danger"
				);
				$this->session->set_flashdata('handler_msg',$flash_msg);

				redirect(base_url().'Masterdata/bahanMakananAdd');
			}else{
				$data_bahan = array(
					'bahan_code' => $kode_bahan,
					'bahan_name' => $nama_bahan,
					'urt' => $urt_bahan,
					'weight' => $berat_bahan,
					'calories' => $kalori_bahan,
					'protein' => $protein_bahan,
					'fat' => $lemak_bahan,
					'carbo' => $karbo_bahan,
					'bahan_golongan' => 'GOL01',
					'bahan_kategori' => 'K02',
					'is_olahan' => 1,
					'created_by' => $data['username'],
					'created_date' => date('Y-m-d H:i:s')
				);
				$bahan_detail = $this->Default_md->getSingle("tb_bahan", array('is_enabled'=>1, 'bahan_code'=>$kode_bahan));
				if(empty($bahan_detail)){
					$this->Default_md->add("tb_bahan", $data_bahan);
				}else{
					$this->Default_md->edit("tb_bahan", array('bahan_code'=>$kode_bahan), $data_bahan);
				}

				$flash_msg = array(
					'msg'		=> "<i class='fa fa-check'></i>&nbsp;Sukses Menambah Data Bahan Makanan.",
					'type'	=> "success"
				);
				$this->session->set_flashdata('handler_msg',$flash_msg);

				redirect(base_url().'Masterdata/bahanMakanan');
			}
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