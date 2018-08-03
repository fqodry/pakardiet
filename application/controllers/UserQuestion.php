<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserQuestion extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model(array('Default_md', 'UserQuestion_md'));
	}

	public function index(){
		$this->userBaseQuestion();
	}

	function userBaseQuestion(){
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

			$userData = $this->Default_md->getSingle('tb_user', array('user_id'=>$data['user_id']));
			$data['form_user_question'] = base_url() . "userquestion/userBaseQuestionHandler";
			$data['jobs'] = $this->Default_md->getAll('m_pekerjaan');
			$data['the_question'] = $this->Default_md->getSingle('m_kegiatan', array('is_parent'=>1));

			//flag alert for update profile
			$today = strtotime("now");
			if(empty($userData->modified_date) || $userData->modified_date == null){
				$lastUpdated = strtotime($userData->created_date);
			}else{
				$lastUpdated = strtotime($userData->modified_date);
			}
			$lastUpdated2w = strtotime("+2 weeks", $lastUpdated);

			if($today > $lastUpdated2w){
				// set flashdata
				$flash_msg = array(
					'msg'		=> "<i class='fa fa-close'></i>&nbsp;Oops, silahkan update profile Anda (Berat Badan, Tinggi Badan, dan Usia) <a href='MyProfile/editProfile'>Click Here</a>",
					'type'	=> "danger"
				);
				$this->session->set_flashdata('handler_msg',$flash_msg);
			}

			$this->load->view('template/header',$data);
			$this->load->view('user_question',$data);
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

	function userBaseQuestionHandler($weight, $height, $age, $gender, $activity){
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

		(float)$beratbadan = $weight;
		$data['beratbadan'] = $beratbadan;
		$data['beratbadan_lbs'] = (int)$beratbadan*2.2046226218;
		(float)$tinggibadan = $height;
		$data['tinggibadan'] = $tinggibadan;
		(int)$usia = $age;
		$data['usia'] = $usia;
		$jeniskelamin = $gender;
		$data['jeniskelamin'] = $jeniskelamin;
		$aktifitas = $activity;
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

		//Penentuan Menu Anjuran Sesuai Kebutuhan Kalori
		$menuAnjuran = '<tr><td colspan="4">no data.</td></tr>';
		$menuAnjuranEnergi = '0 kkal';
		$menuAnjuranProtein = '0 gr';
		$menuAnjuranLemak = '0 gr';
		$menuAnjuranKarbo = '0 gr';

		//Pengelompokan Kalori Kebutuhan Terhadap Kalori Anjuran
		$kalAnjuranCode = 'K1100';
		$listKaloriAnjuran = $this->Default_md->getAll("m_kalori_anjuran", array('is_enabled'=>1));
		foreach($listKaloriAnjuran as $keyA=>$kal){
			if($kebutuhan_kalori >= $kal->kalori_start && $kebutuhan_kalori <= $kal->kalori_end){
				$kalAnjuranCode = $kal->kalori_code;
				$kalAnjuranName = $kal->kalori_name;
				$kalAnjuranValue = $kal->kalori;
			}
		}

		//add kalori anjuran code to user detail
		$data_user_kalori = array('kalori_anjuran_code'=>$kalAnjuranCode);
		$dataUserDetail = $this->Default_md->getSingle('tb_user_detail',array('user_id'=>$data['user_id']));
		if(empty($dataUserDetail)){
			$this->Default_md->add('tb_user_detail',$data_user_kalori);
		}else{
			$this->Default_md->edit('tb_user_detail',array('user_id'=>$data['user_id']),$data_user_kalori);
		}
		

		$listMenuAnjuran = $this->Default_md->getAll("tb_ref_menu_anjuran",array('kalori_code'=>$kalAnjuranCode));

		//Additional Info
		$menuAnjuranEnergi = $kalAnjuranValue.' kkal';

		if(empty($listMenuAnjuran)){
			$menuAnjuran = 'Oops, menu anjuran untuk '.$kalAnjuranName.' belum di atur.';
		}else{
			$menuAnjuran = '';
			$menuAnjuran .= '
				<p>Energi: <strong>'.$menuAnjuranEnergi.'</strong>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;Protein: <strong>'.$menuAnjuranProtein.'</strong></p>
	         <p>Lemak: <strong>'.$menuAnjuranLemak.'</strong>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;Karbohidrat: <strong>'.$menuAnjuranKarbo.'</strong></p>
	         <hr>';

	      //====================================================== SENIN
			$menuAnjuran .= '
				<h2>Senin</h2>
				<table class="table table-hover table-bordered">
				  <thead>
				      <tr>
				          <th>Waktu</th>
				          <th>Menu</th>
				          <th>Porsi</th>
				      </tr>
				  </thead>
				  <tbody>';

			foreach($listMenuAnjuran as $anjuran){
				if(strtolower($anjuran->hari) == 'senin'){
					$menuWaktu = $this->Default_md->getSingle("m_menu_waktu",array('waktu_code'=>$anjuran->waktu_code));
					$bahan = $this->Default_md->getSingle("tb_bahan",array('bahan_code'=>$anjuran->bahan_code));
					$menuAnjuran .= '<tr>';
					$menuAnjuran .= '<td>'.$menuWaktu->waktu_name.'</td>';
					$menuAnjuran .= '<td>'.$bahan->bahan_name.'</td><td>'.$bahan->urt.'</td></tr>';
				}
			}
				      
			$menuAnjuran .= '
					</tbody>
				</table><hr>';

			//====================================================== SELASA
			$menuAnjuran .= '
				<h2>Selasa</h2>
				<table class="table table-hover table-bordered">
				  <thead>
				      <tr>
				          <th>Waktu</th>
				          <th>Menu</th>
				          <th>Porsi</th>
				      </tr>
				  </thead>
				  <tbody>';

			foreach($listMenuAnjuran as $anjuran){
				if(strtolower($anjuran->hari) == 'selasa'){
					$menuWaktu = $this->Default_md->getSingle("m_menu_waktu",array('waktu_code'=>$anjuran->waktu_code));
					$bahan = $this->Default_md->getSingle("tb_bahan",array('bahan_code'=>$anjuran->bahan_code));
					$menuAnjuran .= '<tr>';
					$menuAnjuran .= '<td>'.$menuWaktu->waktu_name.'</td>';
					$menuAnjuran .= '<td>'.$bahan->bahan_name.'</td><td>'.$bahan->urt.'</td></tr>';
				}
			}
				      
			$menuAnjuran .= '
					</tbody>
				</table><hr>';

			//====================================================== RABU
			$menuAnjuran .= '
				<h2>Rabu</h2>
				<table class="table table-hover table-bordered">
				  <thead>
				      <tr>
				          <th>Waktu</th>
				          <th>Menu</th>
				          <th>Porsi</th>
				      </tr>
				  </thead>
				  <tbody>';

			foreach($listMenuAnjuran as $anjuran){
				if(strtolower($anjuran->hari) == 'rabu'){
					$menuWaktu = $this->Default_md->getSingle("m_menu_waktu",array('waktu_code'=>$anjuran->waktu_code));
					$bahan = $this->Default_md->getSingle("tb_bahan",array('bahan_code'=>$anjuran->bahan_code));
					$menuAnjuran .= '<tr>';
					$menuAnjuran .= '<td>'.$menuWaktu->waktu_name.'</td>';
					$menuAnjuran .= '<td>'.$bahan->bahan_name.'</td><td>'.$bahan->urt.'</td></tr>';
				}
			}
				      
			$menuAnjuran .= '
					</tbody>
				</table><hr>';

			//====================================================== KAMIS
			$menuAnjuran .= '
				<h2>Kamis</h2>
				<table class="table table-hover table-bordered">
				  <thead>
				      <tr>
				          <th>Waktu</th>
				          <th>Menu</th>
				          <th>Porsi</th>
				      </tr>
				  </thead>
				  <tbody>';

			foreach($listMenuAnjuran as $anjuran){
				if(strtolower($anjuran->hari) == 'kamis'){
					$menuWaktu = $this->Default_md->getSingle("m_menu_waktu",array('waktu_code'=>$anjuran->waktu_code));
					$bahan = $this->Default_md->getSingle("tb_bahan",array('bahan_code'=>$anjuran->bahan_code));
					$menuAnjuran .= '<tr>';
					$menuAnjuran .= '<td>'.$menuWaktu->waktu_name.'</td>';
					$menuAnjuran .= '<td>'.$bahan->bahan_name.'</td><td>'.$bahan->urt.'</td></tr>';
				}
			}
				      
			$menuAnjuran .= '
					</tbody>
				</table><hr>';

			//====================================================== JUMAT
			$menuAnjuran .= '
				<h2>Jumat</h2>
				<table class="table table-hover table-bordered">
				  <thead>
				      <tr>
				          <th>Waktu</th>
				          <th>Menu</th>
				          <th>Porsi</th>
				      </tr>
				  </thead>
				  <tbody>';

			foreach($listMenuAnjuran as $anjuran){
				if(strtolower($anjuran->hari) == 'jumat'){
					$menuWaktu = $this->Default_md->getSingle("m_menu_waktu",array('waktu_code'=>$anjuran->waktu_code));
					$bahan = $this->Default_md->getSingle("tb_bahan",array('bahan_code'=>$anjuran->bahan_code));
					$menuAnjuran .= '<tr>';
					$menuAnjuran .= '<td>'.$menuWaktu->waktu_name.'</td>';
					$menuAnjuran .= '<td>'.$bahan->bahan_name.'</td><td>'.$bahan->urt.'</td></tr>';
				}
			}
				      
			$menuAnjuran .= '
					</tbody>
				</table><hr>';

			//====================================================== SABTU
			$menuAnjuran .= '
				<h2>Sabtu</h2>
				<table class="table table-hover table-bordered">
				  <thead>
				      <tr>
				          <th>Waktu</th>
				          <th>Menu</th>
				          <th>Porsi</th>
				      </tr>
				  </thead>
				  <tbody>';

			foreach($listMenuAnjuran as $anjuran){
				if(strtolower($anjuran->hari) == 'sabtu'){
					$menuWaktu = $this->Default_md->getSingle("m_menu_waktu",array('waktu_code'=>$anjuran->waktu_code));
					$bahan = $this->Default_md->getSingle("tb_bahan",array('bahan_code'=>$anjuran->bahan_code));
					$menuAnjuran .= '<tr>';
					$menuAnjuran .= '<td>'.$menuWaktu->waktu_name.'</td>';
					$menuAnjuran .= '<td>'.$bahan->bahan_name.'</td><td>'.$bahan->urt.'</td></tr>';
				}
			}
				      
			$menuAnjuran .= '
					</tbody>
				</table><hr>';

			//====================================================== AHAD
			$menuAnjuran .= '
				<h2>Minggu</h2>
				<table class="table table-hover table-bordered">
				  <thead>
				      <tr>
				          <th>Waktu</th>
				          <th>Menu</th>
				          <th>Porsi</th>
				      </tr>
				  </thead>
				  <tbody>';

			foreach($listMenuAnjuran as $anjuran){
				if(strtolower($anjuran->hari) == 'ahad'){
					$menuWaktu = $this->Default_md->getSingle("m_menu_waktu",array('waktu_code'=>$anjuran->waktu_code));
					$bahan = $this->Default_md->getSingle("tb_bahan",array('bahan_code'=>$anjuran->bahan_code));
					$menuAnjuran .= '<tr>';
					$menuAnjuran .= '<td>'.$menuWaktu->waktu_name.'</td>';
					$menuAnjuran .= '<td>'.$bahan->bahan_name.'</td><td>'.$bahan->urt.'</td></tr>';
				}
			}
				      
			$menuAnjuran .= '
					</tbody>
				</table><hr>';
		}

		$data['menuAnjuran'] = $menuAnjuran;
		$data['menuAnjuranEnergi'] = $menuAnjuranEnergi;
		$data['menuAnjuranProtein'] = $menuAnjuranProtein;
		$data['menuAnjuranLemak'] = $menuAnjuranLemak;
		$data['menuAnjuranKarbo'] = $menuAnjuranKarbo;

		// KETERANGAN2
		$bb_ket = "tidak ada keterangan";
		if($imt < 18.5){
			$bb_ket = '<span style="color: aqua;">Berat Badan Kurang</span>';
		}elseif($imt >= 18.5 && $imt <= 24.9) {
			$bb_ket = '<span style="color: green;">Berat Badan Ideal</span>';
		}elseif($imt >= 25 && $imt <= 29.9) {
			$bb_ket = '<span style="color: yellow;">Berat Badan Lebih</span>';
		}elseif($imt >= 30 && $imt <=39.9) {
			$bb_ket = '<span style="color: orange;">Gemuk</span>';
		}else{
			$bb_ket = '<span style="color: red;">Sangat Gemuk</span>';
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
			'aktifitas' 			=> $aktifitas,
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

		$data['hist_formpakar'] = $this->Default_md->getSingle("tb_hist_formpakar",array('histform_id'=>$histform_id));
		$data['aktifitas'] = $this->Default_md->getSingle("m_aktifitas",array('act_id'=>$data['hist_formpakar']->aktifitas));

		$this->load->view('template/header',$data);
		$this->load->view('hitungkalori',$data);
	}

	function userAnswerResponseHandler(){
		if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest'){
			$kodeIn = $_POST['kodeIn'];
			$kodeFrom = $_POST['kodeFrom'];
			$userResponse = $_POST['userResponse'];
			$kodeProcess = 1;

			if($userResponse == "false"){
				$kodeProcess = 0;
			}

			if(empty($kodeFrom)){
				$kodeFrom = null;
			}

			// echo $kodeIn . " - " . $kodeFrom . " - " . $userResponse . " - " . $kodeProcess;

			$rulebase = $this->UserQuestion_md->getRulebase(array('k_in'=>$kodeIn, 'k_process'=>$kodeProcess, 'k_from'=>$kodeFrom));

			if(!empty($rulebase) && $rulebase->is_finale == 0){
				echo json_encode($rulebase);
			}else{
				echo json_encode($rulebase);
			}
		}
	}

	function jxGetFinalRule(){
		if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest'){
			$kodeIn = $_POST['kodeIn'];
			$kodeFrom = $_POST['kodeFrom'];
			$userResponse = $_POST['userResponse'];
			$kodeProcess = 1;
			$userId = $this->session->userdata['logged_in']['user_id'];

			if($userResponse == "false"){
				$kodeProcess = 0;
			}

			$rulebase = $this->UserQuestion_md->getRulebaseFinal(array('k_in'=>$kodeIn, 'k_process'=>$kodeProcess, 'k_from'=>$kodeFrom));

			//get data user
			$dataUser = $this->Default_md->getSingle('tb_user_detail',array('user_id'=>$userId,'is_enabled'=>1));

			//edit user detail, add aktifitas value
			$dataEdit = array('aktifitas'=>$rulebase->act_result);
			$this->Default_md->edit('tb_user_detail',array('user_id'=>$userId),$dataEdit);

			//add history user detail
			$dataHist = array(
				'user_id'=>$userId,
				'gender'=>$dataUser->gender,
				'weight'=>$dataUser->weight,
				'height'=>$dataUser->height,
				'age'=>$dataUser->age,
				'aktifitas'=>$rulebase->act_result,
				'created_by'=>$dataUser->user_id,
				'created_date'=>date('Y-m-d H:i:s')
			);
			$this->Default_md->add('tb_hist_user_detail',$dataHist);

			if($rulebase->is_finale == 1){
				$dataJson = array(
					'userWeight' => $dataUser->weight,
					'userHeight' => $dataUser->height,
					'userAge' => $dataUser->age,
					'userGender' => $dataUser->gender,
					'userActivity' => $rulebase->act_result
				);

				echo json_encode($dataJson);
			}
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
