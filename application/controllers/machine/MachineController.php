<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Controllername extends CI_Controller{
    public function index(){
        $this->load->view('machine/index');
    }
}