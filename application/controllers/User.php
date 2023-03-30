<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$email=$this->session->userdata('email');
		
		date_default_timezone_set("Asia/Dhaka");
		$this->load->model('login');

		if($email=='')
		{
			redirect('welcome','refresh');
		}

		else
		{
			$user_id=$this->session->userdata('user_id');
			$data = array('updated_at' => date('Y-m-d h:i:s'),'status'=>1);
			$this->db->where('id', $user_id);
			$this->db->update('login', $data);
			$this->session->set_userdata('status',1);			
		}
	}
	public function index()
	{
		
		$this->load->view('profile');
	}

	public function status_change()
	{
		$status=$this->input->post('status');

		
		$user_id=$this->session->userdata('user_id');

		$data['status']=$status;
		$this->login->status_change($data,$user_id);

		$result=$this->login->get_status($user_id);

		 $this->session->set_userdata('status',$result[0]['status']);



	}



	
}
