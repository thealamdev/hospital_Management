<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends MX_Controller {
 //public $counter=0;
    function __construct() {
        parent::__construct();
       
    }

	
	public function index($id='')
	{
		
		$this->session->unset_userdata('logged_in','id');
		$this->session->unset_userdata('logged_in','username');
		$this->session->unset_userdata('logged_in','hospital_id');
		$this->session->unset_userdata('logged_in','branch_id');
		$this->session->unset_userdata('logged_in','role');
		$this->session->unset_userdata('logged_in','flag');
		$this->session->unset_userdata('logged_in','hospital_head_report');
		$this->session->unset_userdata('logged_in','hospital_head_money_receipt');
		$this->session->unset_userdata('logged_in','hospital_logo');

		redirect('login','refresh'); 
 
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */