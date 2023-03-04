<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Login extends MX_Controller {


	function __construct()
	{
		$this->load->model('login_model');
		date_default_timezone_set('Asia/Dhaka');
		if($this->session->userdata('language_select')=='bangla')
		{
			$this->lang->load('front', 'bangla');
		}
		else
		{
			$this->lang->load('front', 'english');
		}

		$this->session->set_userdata('logged_in');

	}
	public function index()
	{
		$this->form_validation->set_error_delimiters('<div>', '</div>');
		
		//Validating Name Field
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run() == FALSE) 
		{
			$this->load->view('index');
		} else 
		{

			$val = array( 
				'username' => $this->input->post('username'),
				'password' => $this->encryptIt($this->input->post('password'))
			);
			
			$result = $this->login_model->log_in($val);

			if ($result == TRUE) {

				$test['message']="Successfully Logged In";

				$username= $this->input->post('username');
				$data=$this->login_model->read_user_information($username);

				if($data[0]->role!=0)
				{
					$hospital_info=$this->login_model->select_with_where2('*,flag','hospital_id="'.$data[0]->hospital_id.'"','hospital');

					$session_data = array(
						'username' => $data[0]->username,
						'id' => $data[0]->id,
						'role' => $data[0]->role,
						'hospital_id' => $data[0]->hospital_id,
						'branch_id' => $data[0]->branch_id,
						'doc_id' => $data[0]->doc_id,
						'hospital_head_report'=>$hospital_info[0]['hospital_head_report'],
						'hospital_title_eng_report'=>$hospital_info[0]['hospital_title_eng_report'],
						'hospital_title_ban_report'=>$hospital_info[0]['hospital_title_ban_report'],
						'address_report'=>$hospital_info[0]['address_report'],
						'others_report'=>$hospital_info[0]['others_report'],
						'hospital_logo'=>$hospital_info[0]['hospital_logo'],
						'dashboard_img'=>$hospital_info[0]['dashboard_img']

					);

				// "<pre>";print_r($session_data);die();

					$this->session->set_userdata('logged_in', $session_data);

					$val=$this->login_model->select_with_where2('*','hospital_id="'.$this->session->userdata['logged_in']['hospital_id'].'"','expire_date');

					$msg_date_1=date('Y-m-d', strtotime($this->decryptIt_expire($val[0]['msg_date_1'])));
					$msg_date_2=date('Y-m-d', strtotime($this->decryptIt_expire($val[0]['msg_date_2'])));
					$msg_date_3=date('Y-m-d', strtotime($this->decryptIt_expire($val[0]['msg_date_3'])));

					$expire_date=date('Y-m-d', strtotime($this->decryptIt_expire($val[0]['expire_date'])));

		// echo "<pre>";print_r($expire_date);die();

					if(date('Y-m-d') == $msg_date_1)
					{


						$this->session->set_userdata("msg","আসসালা মুয়ালাইকুম সফটওয়্যার মাসিক বিল বাকি থাকার কারণে 3 দিনের মধ্যে স্বয়ংক্রিয়ভাবে সফটওয়্যার বন্ধ হয়ে যাবে  Hot-Line: 01624-794910");

					// $this->session->set_userdata("msg","You have only 3 days left to expire license");


					}
					else if(date('Y-m-d') == $msg_date_2)
					{

						$this->session->set_userdata('msg',"আসসালা মুয়ালাইকুম সফটওয়্যার মাসিক বিল বাকি থাকার কারণে 2 দিনের মধ্যে স্বয়ংক্রিয়ভাবে সফটওয়্যার বন্ধ হয়ে যাবে  Hot-Line: 01624-794910");

					}
					else if(date('Y-m-d') == $msg_date_3)
					{

						$this->session->set_userdata('msg',"আসসালা মুয়ালাইকুম সফটওয়্যার মাসিক বিল বাকি থাকার কারণে 1 দিনের মধ্যে স্বয়ংক্রিয়ভাবে সফটওয়্যার বন্ধ হয়ে যাবে  Hot-Line: 01624-794910");

					}

					else if(date('Y-m-d') >= $expire_date)
					{


						$this->session->set_userdata("warn_msg","Your software license is expired");

						$this->session->unset_userdata('logged_in')['id'];

						redirect('login','refresh');
					}

				}
				else
				{

				$hospital_info=$this->login_model->select_with_where2('*','hospital_id="'.$data[0]->hospital_id.'"','hospital');

				if(!empty($hospital_info)){
				    
				    $hos_logo=$hospital_info[0]['hospital_logo'];
				    $dashboard_img=$hospital_info[0]['dashboard_img'];
				    
				}

				// "<pre>";print_r($data);die();

					$session_data = array(
						'username' => $data[0]->username,
						'id' => $data[0]->id,
						'role' => $data[0]->role,
						'hospital_id' => $data[0]->hospital_id,
						'doc_id' => $data[0]->doc_id,
						'branch_id' => $data[0]->branch_id,
						'hospital_logo'=>$hos_logo,
						'dashboard_img'=>$dashboard_img
					);


					$this->session->set_userdata('logged_in', $session_data);
				}

				redirect('admin'); 

			}
			else
			{
				$test['message']="Username and Password dont match";
				$this->load->view('index',$test);

			}

			
		}

	}

	public	function decryptIt_expire($string) 
	{
		$output ="";
		$output=openssl_decrypt(base64_decode($string),"AES-256-CBC",  hash('sha256',"encryptedexpiredaterecently"), 0, substr(hash('sha256','This is my secret iv'), 0, 16));

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
		$secret_iv = 'This is my secret iv';
        // hash
		$key = hash('sha256', $secret_key);

        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
		$iv = substr(hash('sha256', $secret_iv), 0, 16);

		$output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
		$output = base64_encode($output);

		return $output;
	}



}

?>