<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MyProfile extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Default_md');
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
}