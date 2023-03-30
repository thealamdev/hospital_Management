<?php

class machineModel extends CI_Model {
    public function  insert($data){
      return  $this->db->insert('machine',$data);
    }
    
}