<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Model {

	public function checklogin($email,$pass)
	{
		$this->db->select('*');
		$this->db->from('login');
		$this->db->where('email',$email);
		$this->db->where('password',$pass);
		$query = $this->db->get();
        $result = $query->result_array();
        return $result;
	}

	public function status_change($data,$user_id)
	{
		$this->db->where('id', $user_id);
        $this->db->update('login', $data);
    
	}

	public function get_status($user_id)
	{
		$this->db->select('*');
		$this->db->from('login');
		$this->db->where('id',$user_id);
		$query = $this->db->get();
        $result = $query->result_array();
        return $result;
	}



}

/* End of file Login.php */
/* Location: ./application/models/Login.php */