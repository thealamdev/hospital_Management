<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model
{

    public function log_in($val) 
    {

        $condition = "username =" . "'" . $val['username'] . "' AND " . "password =" . "'" . $val['password'] . "'";
        $this->db->select('*');
        $this->db->from('login');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
        return true;
        } else {
        return false;
                }
    }

    public function read_user_information($username)
     {

        $condition = "username=" . "'" . $username . "'";
        $this->db->select('*');
        $this->db->from('login');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
        return $query->result();
        } else {
        return false;
                }
    }

     public function select_with_where2($selector, $condition, $tablename)
    {
        $this->db->select($selector);
        $this->db->from($tablename);
        $where = '('.$condition . ')';
        $this->db->where($where);
        $result = $this->db->get();
        return $result->result_array();
    }

    

    ////// Basic Model Function Starts ///////
   

}
?>
