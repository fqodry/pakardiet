<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MyProfile extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Default_md');
		$this->load->helper('form');
	}

	public function index(){
		$this->myProfile();
	}

	function myProfile(){
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

			// User Chart
			$this->load->model('Hist_formpakar_md');
			$line_chart = '
			<script>
		        if ($("#lineChart").length ){   
		            
		          var ctx = document.getElementById("lineChart");
		          var lineChart = new Chart(ctx, {
		            type: "line",
		            data: {
		              labels: 
		              	[';

		   if(!empty($hist_formpakar)){
		   	foreach($hist_formpakar as $hist_form){
			    	$create = date_create($hist_form->created_date);
			    	$format = date_format($create,"d F Y");
			    	$line_chart .= '"'.$format.'",';
				}
		   }

			$line_chart .= '
						],
		              datasets: [{
		                label: "Berat Saya",
		                backgroundColor: "rgba(38, 185, 154, 0.31)",
		                borderColor: "rgba(38, 185, 154, 0.7)",
		                pointBorderColor: "rgba(38, 185, 154, 0.7)",
		                pointBackgroundColor: "rgba(38, 185, 154, 0.7)",
		                pointHoverBackgroundColor: "#fff",
		                pointHoverBorderColor: "rgba(220,220,220,1)",
		                pointBorderWidth: 1,
		                data: 
		                	[';

		   if(!empty($hist_formpakar)){
		   	foreach($hist_formpakar as $hist_form){
			    	$line_chart .= (float)$hist_form->berat_badan.',';
				}
		   }

    		$line_chart .= ']
		              }, {
		                label: "Berat Ideal Saya",
		                backgroundColor: "rgba(3, 88, 106, 0.3)",
		                borderColor: "rgba(3, 88, 106, 0.70)",
		                pointBorderColor: "rgba(3, 88, 106, 0.70)",
		                pointBackgroundColor: "rgba(3, 88, 106, 0.70)",
		                pointHoverBackgroundColor: "#fff",
		                pointHoverBorderColor: "rgba(151,187,205,1)",
		                pointBorderWidth: 1,
		                data: 
		                	[';

		   if(!empty($hist_formpakar)){
		   	foreach($hist_formpakar as $hist_form){
			    	$hist_formpakar_res = $this->Default_md->getSingle('tb_hist_formpakar_result',array('histform_id'=>$hist_form->histform_id));
			    	$line_chart .= (float)$hist_formpakar_res->bb_ideal.',';
				}
		   }

        	$line_chart .= ']
		              }]
		            },
		          });
		        }
		    </script>
			';
			$data['line_chart'] = $line_chart;

			$this->load->view('template/header',$data);
			$this->load->view('myprofile',$data);
		} else {
			$flash_msg = array(
				'msg'	=> "<i class='fa fa-close'></i>&nbsp;Error, please login first",
				'type'	=> "danger"
			);
			$this->session->set_flashdata('handler_msg',$flash_msg);

			redirect(base_url().'login');
		}
	}

	function editProfile(){
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

			$data['formEditProfile'] = base_url() . "myprofile/editProfileHandler";

			$this->load->view('template/header',$data);
			$this->load->view('editprofile',$data);
		} else {
			$flash_msg = array(
				'msg'	=> "<i class='fa fa-close'></i>&nbsp;Error, please login first",
				'type'	=> "danger"
			);
			$this->session->set_flashdata('handler_msg',$flash_msg);

			redirect(base_url().'login');
		}
	}

	function editProfileHandler(){
		$this->load->library('form_validation');
		$rules = array(
			array(
				'field'	=> 'userFIRSTNAME',
				'label'	=> 'First Name',
				'rules'	=> 'trim|required|xss_clean'
			),
			array(
				'field'	=> 'userLASTNAME',
				'label'	=> 'Last Name',
				'rules'	=> 'trim|required|xss_clean'
			),
			array(
				'field'	=> 'userAGE',
				'label'	=> 'Usia',
				'rules'	=> 'trim|required|numeric|xss_clean'
			),
			array(
				'field'	=> 'userWEIGHT',
				'label'	=> 'Berat Badan',
				'rules'	=> 'trim|required|numeric|xss_clean'
			),
			array(
				'field'	=> 'userHEIGHT',
				'label'	=> 'Tinggi Badan',
				'rules'	=> 'trim|required|numeric|xss_clean'
			),
			array(
				'field'	=> 'userGENDER',
				'label'	=> 'Jenis Kelamin',
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

			$userID = $this->input->post('userID');
			$userNAME = $this->input->post('userNAME');
			$userFIRSTNAME = $this->input->post('userFIRSTNAME');
			$userLASTNAME = $this->input->post('userLASTNAME');
			$userAGE = $this->input->post('userAGE');
			$userWEIGHT = $this->input->post('userWEIGHT');
			$userHEIGHT = $this->input->post('userHEIGHT');
			$userGENDER = $this->input->post('userGENDER');

			$dataUpdateUser = array(
				'first_name' => $userFIRSTNAME,
				'last_name' => $userLASTNAME,
				'modified_by' => $data['username'],
				'modified_date' => date('Y-m-d H:i:s')
			);
			$dataUpdateUserDetail = array(
				'gender' => $userGENDER,
				'weight' => $userWEIGHT,
				'height' => $userHEIGHT,
				'age' => $userAGE
			);

			$this->Default_md->edit('tb_user', array('user_id'=>$userID), $dataUpdateUser);
			$this->Default_md->edit('tb_user_detail', array('user_id'=>$userID), $dataUpdateUserDetail);

			//get last user detail
			$userDetail = $this->Default_md->getSingle('tb_user_detail', array('user_id'=>$userID, 'is_enabled'=>1));

			//add hist user detail
			$dataHistUserDetail = array(
				'user_id'=>$userDetail->user_id,
				'gender'=>$userDetail->gender,
				'weight'=>$userDetail->weight,
				'height'=>$userDetail->height,
				'age'=>$userDetail->age,
				'aktifitas'=>$userDetail->aktifitas,
				'created_by'=>$userID,
				'created_date'=>date('Y-m-d H:i:s')
			);
			$this->Default_md->add('tb_hist_user_detail',$dataHistUserDetail);

			// set flashdata
			$flash_msg = array(
				'msg'		=> "<i class='fa fa-check'></i>&nbsp;Update Profile Successful!",
				'type'	=> "success"
			);
			$this->session->set_flashdata('handler_msg',$flash_msg);
			redirect(base_url().'myprofile');
		}
	}
}