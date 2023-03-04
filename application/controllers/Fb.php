<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fb extends CI_Controller {

	
	public function index()
	{
	    //print_r($this->facebook->is_authenticated());die();
	    
		if ($this->facebook->is_authenticated())
		{
			// User logged in, get user details
			$user = $this->facebook->request('get', '/me?fields=id,name,email');
			if (!isset($user['error']))
			{
				$data['user'] = $user;
			}

			var_dump($user);

		}
	}

		
}
