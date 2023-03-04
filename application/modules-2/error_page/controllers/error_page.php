<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class error_page extends MX_Controller {  


	function __construct()
	{
	
	}
	public function index()
	{
		$this->load->view('index');

	}


	public	function decryptIt_expire($string) 
	{
		$output ="";
		$output=openssl_decrypt(base64_decode($string),"AES-256-CBC",  hash('sha256',"tianodoncharadukitenoperibi"), 0, substr(hash('sha256','This is my secret iv'), 0, 16));

		// echo "<pre>";print_r($output);

		return $output;
	}




	public function pass_gen()
	{
		$pass=$this->encryptIt('123456');
		echo $pass;
	}



	function encryptIt($string) 
	{
		$output = false;
		$encrypt_method = "AES-256-CBC";
		$secret_key = 'Lf6Q5htqdgnSn0AABqlsSddj1QNu0fJs';

        // $secret_key = 'tianodoncharadukitenoperibi';
		$secret_iv = 'This is my secret iv';
        // hash
		$key = hash('sha256', $secret_key);

        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
		$iv = substr(hash('sha256', $secret_iv), 0, 16);

		$output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
		$output = base64_encode($output);

        // "<pre>";print_r($output);die();

		return $output;
	}



}

?>