<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	
	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function login_check()
	{
		$this->load->model('login');
		$email=$this->input->post('email');
		$pass=$this->input->post('password');

		$result=$this->login->checklogin($email,$pass);

		if(count($result)>0)
		{

			 $data = array(
                'user_id' => $result[0]['id'],
                'email' => $result[0]['email'],
            );

			 $this->session->set_userdata($data);

			$user_id=$this->session->userdata('user_id');

			$dat['status']=1;
			$this->login->status_change($dat,$user_id);

			$res=$this->login->get_status($user_id);

			$this->session->set_userdata('status',$res[0]['status']);
  
			 redirect('user', 'refresh');
		}

		else
		{
			 $this->session->set_userdata('log_err','Email or Password is Incorrect.');
			 $this->load->view('welcome_message');
		}
           

	}

	public function user()
	{
		$this->load->view('profile');
	}
		
}
