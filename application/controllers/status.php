<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Status extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$email=$this->session->userdata('email');
		
		date_default_timezone_set("Asia/Dhaka");
$this->load->model('login');


	}



	public function check_inactive_user()
	{
		$user_id=$this->session->userdata('user_id');
		$result=$this->login->get_status($user_id);

		$datetime2=strtotime($result[0]['updated_at']);


		$datetime1 = date('Y-m-d h:i:s');
	$datetime1 = strtotime($datetime1);
		//echo 'now-'.$datetime1;
	   //echo '</br>pre-'.$datetime2.'  ';

		$minutes=(($datetime1-$datetime2)/60);
		echo $minutes;
		if($minutes>=1)
		{
			$user_id=$this->session->userdata('user_id');

			$dat['status']=2;
			$this->login->status_change($dat,$user_id);

			$res=$this->login->get_status($user_id);

			$this->session->set_userdata('status',$res[0]['status']);
		}
	}


	public function close_browser()
	{
		$user_id=$this->session->userdata('user_id');

		$dat['status']=3;
		$this->login->status_change($dat,$user_id);
		
	}



	
}
