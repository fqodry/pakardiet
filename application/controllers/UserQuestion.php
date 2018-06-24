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
			$lastUpdated = strtotime($userData->modified_date);
			$lastUpdated2w = strtotime("+2 weeks", $lastUpdated);

			if($today > $lastUpdated2w){
				// set flashdata
				$flash_msg = array(
					'msg'		=> "<i class='fa fa-close'></i>&nbsp;Oops, silahkan update profile Anda (Berat Badan, Tinggi Badan, dan Usia) <a href='myprofile/editProfile'>Click Here</a>",
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

		if($kebutuhan_kalori >= 1000 && $kebutuhan_kalori <= 1200){
			$menuAnjuranEnergi = '1137,5 kkal';
			$menuAnjuranProtein = '40 gr';
			$menuAnjuranLemak = '25 gr';
			$menuAnjuranKarbo = '182 gr';
			$menuAnjuran = '';
			$menuAnjuran .= '<tr><td rowspan="3">Pagi</td><td>Bubur Ayam</td><td>200 gr</td></tr>
                            <tr><td>Lalapan Selada</td><td>Sekehendak</td></tr>
                            <tr><td>Minyak Kelapa</td><td>5 gr</td></tr>

                            <tr><td>Snack (Pk. 10.00)</td><td>Jambu Biji (tanpa gula)</td><td>-</td></tr>

                            <tr><td rowspan="6">Siang</td><td>Nasi Putih</td><td>100 gr</td></tr>
                            <tr><td>Ikan Pindang</td><td>40 gr</td></tr>
                            <tr><td>Orek Tempe</td><td>50 gr</td></tr>
                            <tr><td>Sayur Asem</td><td>100 gr</td></tr>
                            <tr><td>Pisang</td><td>50 gr</td></tr>
                            <tr><td>Minyak Kelapa</td><td>5 gr</td></tr>

                            <tr><td>Snack (Pk. 16.00)</td><td>Puding Mangga</td><td>-</td></tr>

                            <tr><td rowspan="6">Malam</td><td>Nasi Putih</td><td>100 gr</td></tr>
                            <tr><td>Ayam Bakar (Tanpa Kulit)</td><td>40 gr</td></tr>
                            <tr><td>Pepes Tahu</td><td>110 gr</td></tr>
                            <tr><td>Tumis Kangkung</td><td>100 gr</td></tr>
                            <tr><td>Jeruk</td><td>100 gr</td></tr>
                            <tr><td>Minyak Kelapa</td><td>5 gr</td></tr>';
		} elseif($kebutuhan_kalori > 1200 && $kebutuhan_kalori <= 1400){
			$menuAnjuranEnergi = '1300 kkal';
			$menuAnjuranProtein = '49 gr';
			$menuAnjuranLemak = '30 gr';
			$menuAnjuranKarbo = '202 gr';
			$menuAnjuran = '';
			$menuAnjuran .= '<tr><td rowspan="4">Pagi</td><td>Nasi Putih</td><td>100 gr</td></tr>
                            <tr><td>Telur Balado</td><td>55 gr</td></tr>
                            <tr><td>Acar Timun Wortel</td><td>Sekehendak</td></tr>
                            <tr><td>Minyak Kelapa</td><td>5 gr</td></tr>

                            <tr><td>Snack (Pk. 10.00)</td><td>Selada Buah</td><td>-</td></tr>

                            <tr><td rowspan="6">Siang</td><td>Nasi Putih</td><td>100 gr</td></tr>
                            <tr><td>Semur Ayam</td><td>40 gr</td></tr>
                            <tr><td>Tumis Tempe Cabe Hijau</td><td>50 gr</td></tr>
                            <tr><td>Sayur Sop</td><td>100 gr</td></tr>
                            <tr><td>Pepaya</td><td>50 gr</td></tr>
                            <tr><td>Minyak Kelapa</td><td>5 gr</td></tr>

                            <tr><td>Snack (Pk. 16.00)</td><td>Puding Buah</td><td>1 ptg/cup</td></tr>

                            <tr><td rowspan="6">Malam</td><td>Nasi Putih</td><td>100 gr</td></tr>
                            <tr><td>Ikan Bakar Kecap</td><td>40 gr</td></tr>
                            <tr><td>Pepes Jamur</td><td>110 gr</td></tr>
                            <tr><td>Tumis Kacang Panjang</td><td>100 gr</td></tr>
                            <tr><td>Jeruk</td><td>100 gr</td></tr>
                            <tr><td>Minyak Kelapa</td><td>5 gr</td></tr>';
		} elseif($kebutuhan_kalori > 1400 && $kebutuhan_kalori <= 1600){
			$menuAnjuranEnergi = '1562,5 kkal';
			$menuAnjuranProtein = '55,5 gr';
			$menuAnjuranLemak = '36,5 gr';
			$menuAnjuranKarbo = '245,5 gr';
			$menuAnjuran = '';
			$menuAnjuran .= '<tr><td rowspan="5">Pagi</td><td>Nasi Putih</td><td>100 gr</td></tr>
                            <tr><td>Omelet</td><td>55 gr</td></tr>
                            <tr><td>Kering Tempe</td><td>25 gr</td></tr>
                            <tr><td>Sayur Sop</td><td>100 gr</td></tr>
                            <tr><td>Minyak Kelapa</td><td>5 gr</td></tr>

                            <tr><td>Snack (Pk. 10.00)</td><td>Setup Pisang</td><td>50 gr</td></tr>

                            <tr><td rowspan="6">Siang</td><td>Nasi Putih</td><td>200 gr</td></tr>
                            <tr><td>Pepes Ikan</td><td>40 gr</td></tr>
                            <tr><td>Tumis Kacang Merah</td><td>20 gr</td></tr>
                            <tr><td>Sayur Asem</td><td>100 gr</td></tr>
                            <tr><td>Melon</td><td>50 gr</td></tr>
                            <tr><td>Minyak Kelapa</td><td>10 gr</td></tr>

                            <tr><td>Snack (Pk. 16.00)</td><td>Jus Melon Stroberi</td><td>1 gls</td></tr>

                            <tr><td rowspan="6">Malam</td><td>Nasi Putih</td><td>100 gr</td></tr>
                            <tr><td>Ayam Cabe Hijau</td><td>40 gr</td></tr>
                            <tr><td>Sop Tofu</td><td>110 gr</td></tr>
                            <tr><td>Tumis Brokoli</td><td>100 gr</td></tr>
                            <tr><td>Pisang</td><td>110 gr</td></tr>
                            <tr><td>Minyak Kelapa</td><td>5 gr</td></tr>';
		} elseif($kebutuhan_kalori > 1600 && $kebutuhan_kalori <= 1800){
			$menuAnjuranEnergi = '1787,5 kkal';
			$menuAnjuranProtein = '59,5 gr';
			$menuAnjuranLemak = '41,5 gr';
			$menuAnjuranKarbo = '285,5 gr';
			$menuAnjuran = '';
			$menuAnjuran .= '<tr><td rowspan="5">Pagi</td><td>Nasi Putih</td><td>100 gr</td></tr>
                            <tr><td>Fuyunghai</td><td>55 gr</td></tr>
                            <tr><td>Tahu Asam Manis</td><td>55 gr</td></tr>
                            <tr><td>Acar Timun</td><td>Sekehendak</td></tr>
                            <tr><td>Minyak Kelapa</td><td>5 gr</td></tr>

                            <tr><td>Snack (Pk. 10.00)</td><td>Pisang Bakar Cokelat</td><td>50 gr</td></tr>

                            <tr><td rowspan="6">Siang</td><td>Nasi Putih</td><td>150 gr</td></tr>
                            <tr><td>Kembung Pesmol</td><td>40 gr</td></tr>
                            <tr><td>Tahu Bacem</td><td>110 gr</td></tr>
                            <tr><td>Sayur Asem</td><td>100 gr</td></tr>
                            <tr><td>Pisang</td><td>50 gr</td></tr>
                            <tr><td>Minyak Kelapa</td><td>10 gr</td></tr>

                            <tr><td>Snack (Pk. 16.00)</td><td>Kroket Sayuran</td><td>1 ptg</td></tr>

                            <tr><td rowspan="6">Malam</td><td>Nasi Putih</td><td>150 gr</td></tr>
                            <tr><td>Ayam Saus Tomat</td><td>40 gr</td></tr>
                            <tr><td>Tahu Bumbu Kuning</td><td>110 gr</td></tr>
                            <tr><td>Tumis Sawi Jagung</td><td>100 gr</td></tr>
                            <tr><td>Jeruk</td><td>110 gr</td></tr>
                            <tr><td>Minyak Kelapa</td><td>5 gr</td></tr>';
		} elseif($kebutuhan_kalori > 1800 && $kebutuhan_kalori <= 2000){
			$menuAnjuranEnergi = '1975 kkal';
			$menuAnjuranProtein = '67 gr';
			$menuAnjuranLemak = '58,5 gr';
			$menuAnjuranKarbo = '272 gr';
			$menuAnjuran = '';
			$menuAnjuran .= '<tr><td rowspan="5">Pagi</td><td>Nasi Uduk</td><td>150 gr</td></tr>
                            <tr><td>Telur Dadar</td><td>55 gr</td></tr>
                            <tr><td>Semur Tahu</td><td>110 gr</td></tr>
                            <tr><td>Lalapan</td><td>Sekehendak</td></tr>
                            <tr><td>Minyak Kelapa</td><td>10 gr</td></tr>

                            <tr><td>Snack (Pk. 10.00)</td><td>Bubur Kacang Hijau</td><td>20 gr</td></tr>

                            <tr><td rowspan="6">Siang</td><td>Nasi Putih</td><td>150 gr</td></tr>
                            <tr><td>Kakap Asam Manis</td><td>40 gr</td></tr>
                            <tr><td>Sop Tofu</td><td>110 gr</td></tr>
                            <tr><td>Cah Brokoli</td><td>100 gr</td></tr>
                            <tr><td>Semangka</td><td>150 gr</td></tr>
                            <tr><td>Minyak Kelapa</td><td>10 gr</td></tr>

                            <tr><td>Snack (Pk. 16.00)</td><td>Risoles</td><td>1 ptg</td></tr>

                            <tr><td rowspan="6">Malam</td><td>Nasi Putih</td><td>150 gr</td></tr>
                            <tr><td>Ayam Teriyaki</td><td>40 gr</td></tr>
                            <tr><td>Tahu Saus Tomat</td><td>110 gr</td></tr>
                            <tr><td>Stup Buncis + Wortel</td><td>100 gr</td></tr>
                            <tr><td>Apel</td><td>100 gr</td></tr>
                            <tr><td>Minyak Kelapa</td><td>10 gr</td></tr>';
		} elseif($kebutuhan_kalori > 2000 && $kebutuhan_kalori <= 2200){
			$menuAnjuranEnergi = '2112,5 kkal';
			$menuAnjuranProtein = '69 gr';
			$menuAnjuranLemak = '63,5 gr';
			$menuAnjuranKarbo = '292 gr';
			$menuAnjuran = '';
			$menuAnjuran .= '<tr><td rowspan="5">Pagi</td><td>Nasi Goreng</td><td>150 gr</td></tr>
                            <tr><td>Telur Ceplok</td><td>55 gr</td></tr>
                            <tr><td>Kering Tempe</td><td>50 gr</td></tr>
                            <tr><td>Acar Timun</td><td>Sekehendak</td></tr>
                            <tr><td>Minyak Kelapa</td><td>10 gr</td></tr>

                            <tr><td>Snack (Pk. 10.00)</td><td>Bubur Sum Sum</td><td>1 cup sedang</td></tr>

                            <tr><td rowspan="6">Siang</td><td>Nasi Putih</td><td>250 gr</td></tr>
                            <tr><td>Kakap Tempura</td><td>40 gr</td></tr>
                            <tr><td>Tahu Saus Tomat</td><td>110 gr</td></tr>
                            <tr><td>Sop Kimlo</td><td>100 gr</td></tr>
                            <tr><td>Jus Jambu Biji</td><td>90 gr</td></tr>
                            <tr><td>Minyak Kelapa</td><td>10 gr</td></tr>

                            <tr><td>Snack (Pk. 16.00)</td><td>Panada</td><td>1 buah</td></tr>

                            <tr><td rowspan="6">Malam</td><td>Nasi Putih</td><td>150 gr</td></tr>
                            <tr><td>Empal Daging</td><td>35 gr</td></tr>
                            <tr><td>Pepes Tahu</td><td>110 gr</td></tr>
                            <tr><td>Sayur Asem</td><td>100 gr</td></tr>
                            <tr><td>Melon</td><td>180 gr</td></tr>
                            <tr><td>Minyak Kelapa</td><td>10 gr</td></tr>';
		} elseif($kebutuhan_kalori > 2200 && $kebutuhan_kalori <= 2400){
			$menuAnjuranEnergi = '2330 kkal';
			$menuAnjuranProtein = '76,5 gr';
			$menuAnjuranLemak = '64,5 gr';
			$menuAnjuranKarbo = '337 gr';
			$menuAnjuran = '';
			$menuAnjuran .= '<tr><td rowspan="5">Pagi</td><td>Nasi Goreng</td><td>150 gr</td></tr>
                            <tr><td>Telur Orak Arik</td><td>55 gr</td></tr>
                            <tr><td>Tempe Goreng Tepung</td><td>50 gr</td></tr>
                            <tr><td>Lalapan</td><td>Sekehendak</td></tr>
                            <tr><td>Minyak Kelapa</td><td>10 gr</td></tr>

                            <tr><td>Snack (Pk. 10.00)</td><td>Banana Milkshake</td><td>1 gelas</td></tr>

                            <tr><td rowspan="6">Siang</td><td>Nasi Putih</td><td>250 gr</td></tr>
                            <tr><td>Rendang Daging</td><td>35 gr</td></tr>
                            <tr><td>Martabak Tahu</td><td>110 gr</td></tr>
                            <tr><td>Sayur Sop</td><td>100 gr</td></tr>
                            <tr><td>Jeruk</td><td>50 gr</td></tr>
                            <tr><td>Minyak Kelapa</td><td>10 gr</td></tr>

                            <tr><td>Snack (Pk. 16.00)</td><td>Macaroni Schotel</td><td>1 ptg</td></tr>

                            <tr><td rowspan="6">Malam</td><td>Nasi Putih</td><td>250 gr</td></tr>
                            <tr><td>Semur Ayam</td><td>40 gr</td></tr>
                            <tr><td>Krecek</td><td>20 gr</td></tr>
                            <tr><td>Tumis Sawi Jagung</td><td>100 gr</td></tr>
                            <tr><td>Pear</td><td>85 gr</td></tr>
                            <tr><td>Minyak Kelapa</td><td>10 gr</td></tr>';
		} elseif($kebutuhan_kalori > 2400 && $kebutuhan_kalori <= 2600) {
			$menuAnjuranEnergi = '2517,5 kkal';
			$menuAnjuranProtein = '79,5 gr';
			$menuAnjuranLemak = '74,5 gr';
			$menuAnjuranKarbo = '355 gr';
			$menuAnjuran = '';
			$menuAnjuran .= '<tr><td rowspan="5">Pagi</td><td>Nasi Goreng</td><td>200 gr</td></tr>
                            <tr><td>Telur Ceplok</td><td>55 gr</td></tr>
                            <tr><td>Kering Tempe</td><td>50 gr</td></tr>
                            <tr><td>Lalapan</td><td>Sekehendak</td></tr>
                            <tr><td>Minyak Kelapa</td><td>10 gr</td></tr>

                            <tr><td rowspan="2">Snack (Pk. 10.00)</td><td>Makaroni Schotel</td><td>1 ptg/cup</td></tr>
                            <tr><td>Susu Sapi</td><td>200 gr</td></tr>

                            <tr><td rowspan="6">Siang</td><td>Nasi Putih</td><td>250 gr</td></tr>
                            <tr><td>Opor Ayam</td><td>40 gr</td></tr>
                            <tr><td>Tahu Bacem</td><td>110 gr</td></tr>
                            <tr><td>Tumis Labu Siam Jagung</td><td>100 gr</td></tr>
                            <tr><td>Pisang</td><td>50 gr</td></tr>
                            <tr><td>Minyak Kelapa</td><td>15 gr</td></tr>

                            <tr><td>Snack (Pk. 16.00)</td><td>Bolu Karamel</td><td>1 ptg sdg</td></tr>

                            <tr><td rowspan="6">Malam</td><td>Nasi Putih</td><td>250 gr</td></tr>
                            <tr><td>Dendeng Balado</td><td>35 gr</td></tr>
                            <tr><td>Rolade Tempe</td><td>100 gr</td></tr>
                            <tr><td>Bening Bayam</td><td>100 gr</td></tr>
                            <tr><td>Pepaya</td><td>110 gr</td></tr>
                            <tr><td>Minyak Kelapa</td><td>15 gr</td></tr>';
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
