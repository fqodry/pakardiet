<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



/**

 * Codery Common Function Helpers

 *

 * @package		CodeIgniter

 * @subpackage	Helpers

 * @category	Helpers

 * @author		Solihin a.k.a @mosolihin dan di edit oleh Firman Qodry a.k.a @frmnqdr

 */



// ------------------------------------------------------------------------



/**

 * Format Rupiah

 *

 * Format rupiah dari angka bilangan

 * first parameter either as a string or an array.

 *

 * @access	public

 * @param	string

 * @return	string

 */

if ( ! function_exists('format_rupiah'))

{

	function format_rupiah($price) 

	{
		// jika empty value
		if(empty($price))
		{
			$price = 0;
		}

		$idr = "Rp " . number_format($price, 0, "", ".") . ",-";
		//$idr = number_format($price, 0, "", ".") . ",-";

		return $idr;

	}

}



if ( ! function_exists('format_uang'))

{

	function format_uang($price) 

	{

		$idr = number_format($price, 0, "", ".") . ",-";

		return $idr;

	}

}



// ------------------------------------------------------------------------



/**

 * Format Tanggal FULL (Hari - Bulan - Tahun)

 * 

 * Format umum tanggal di indonesia

 * parameter dari string date

 *

 * @access	public

 * @param string date

 * @return	string

 */

if ( ! function_exists('format_tanggal'))

{

	function format_tanggal($date) 

	{	

		if ( isset($date) ) { 

			$t = explode('-',$date);

		} else {

			$t = explode('-', date('Y-m-d')); 

		} 

		

		$year = $t[0];


		$bulan	= array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");

		$kode_bulan = (integer) $t[1];

		$month= $bulan[$kode_bulan];

		

		return $t[2].' '.$month.' '.$year;

	}

}

/**

 * Format Tanggal (Bulan - Tahun)

 * 

 * Format umum tanggal di indonesia

 * parameter dari string date

 *

 * @access	public

 * @param string date

 * @return	string

 */

if ( ! function_exists('format_tanggal_bt'))

{

	function format_tanggal_bt($date) 

	{	

		if ( isset($date) ) { 

			$t = explode('-',$date);

		} else {

			$t = explode('-', date('Y-m-d')); 

		} 

		

		$year = $t[0];


		$bulan	= array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");

		$kode_bulan = (integer) $t[1];

		$month= $bulan[$kode_bulan];

		

		return $month.' '.$year;

	}

}

/**

*	Format Tanggal (Only Hari)

*

*	Format hari umum di Indonesia

*	parameter create

*/

if( ! function_exists('format_hari')) {

	function format_hari() {

  		$array_hr = array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu');

  		$array_bln = array('', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', "September", 'Oktober', 'November', 'Desember');
 	

 		$hari = $array_hr[date('N')];

 		$bulan = $array_bln[date('n')];

		//return $hari . ", " . date('d') . " " . $bulan . " " . date('Y');
		return $hari;

	}

}




// ------------------------------------------------------------------------



/**

 * Format Serialisasi String dan sebaliknya

 * 

 *

 * @access	public

 * @param string

 * @return	serialied array

 */

if ( ! function_exists('string_to_serial'))

{

	function string_to_serial($string){

		$string = str_replace(' ', '', $string);

		$arrayFromString = explode(',', $string);

		return serialize( $arrayFromString );

	}

}



if ( ! function_exists('serial_to_string'))

{

	function serial_to_string($serial){

		$array = unserialize($serial);

		$stringFromArray = implode(' , ', $array);

		return $stringFromArray;

	}

}





// ------------------------------------------------------------------------



/**

 * Fungsi kirim satu email

 * 

 *

 * @access	public

 * @param 	array('recipient','subject','message','sender');

 * @return	string

 */

if ( ! function_exists('send_single_mail'))

{

	function send_single_mail($param=array())

	{	

		$to 	 = $param['recipient'];

		$subject = $param['subject'];

		$message = $param['message'];

		$from 	 = $param['sender'];

		

		$headers = "MIME-version: 1.0\r\n";

		$headers .= "content-type: text/plain; charset=UTF-8\r\n";

		$headers = "From:" . $from;

		

		return $kirim 	 = mail($to,$subject,$message,$headers);

		/* if ($kirim) echo "Mail Sent."; else echo "Failed"; */

	}

}



// ------------------------------------------------------------------------



/**

 * Format Kirim banyak email

 * 

 *

 * @access	public

 * @param 	array('recipient'=array(),'subject','message','sender');

 * @return	string

 */

function send_multiple_mail($param){



	$address = $param['recipient'];

	$subject = $param['subject'];

	$message = $param['message'];

	$from 	 = $param['sender'];

	

	$mailheaders = "MIME-version: 1.0\r\n";

	$mailheaders .= "content-type: text/plain; charset=UTF-8\r\n";

	$mailheaders .= "From: ".$from." \r\n";



	foreach( $address as $add => $toEmail ){

		$kirim = mail($toEmail, $subject, $message, $mailheaders);

	}
}

/**

 * Format Angka

 *

 * Format Angka

 * first parameter either as a string or an array.

 *

 * @access	public

 * @param	string

 * @return	string

 */

if( ! function_exists('format_angka')) {

	function format_angka($number) {

		$angka = number_format($number, 0, "", ".");

		return $angka;
	}
}

